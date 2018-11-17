import pandas as pd
import math
import geocoder
import requests
import json
import googlemaps
import itertools
import urllib
import numpy as np

API_KEY = 'YOUR_KEY'
gmaps = googlemaps.Client(key=API_KEY)

# generous boundaries of lehman campus
northeast = (40.87466728029151,-73.89279051970848)
southwest = (40.870765, -73.897962)

# create a grid of coords over lehman
lat_range = np.arange(northeast[0], southwest[0], -0.0002)
lng_range = np.arange(northeast[1], southwest[1], -0.0002)
coords_nearby = list(itertools.product(lat_range, lng_range))
coords_nearby = np.array_split(coords_nearby, math.ceil(len(coords_nearby)/100))

# lehman buildings recognized by google maps
buildings = ['Music Building', 'Speech and Theater', 'Fine Arts', 'Gillet Hall', 
             'Davis Hall', 'New Science Building', 'Carman Hall', 
             'Student Life Building', 'Shuster Hall']


# get all nearby addresses
def get_nearby_places(lat,lng,radius,key):
    AUTH_KEY = key
    LOCATION = str(lat) + "," + str(lng)
    RADIUS = radius
    my_url = ('https://maps.googleapis.com/maps/api/place/nearbysearch/json?'
              'location=%s'
              '&rankby=distance'
              '&type=premise'
              '&sensor=false'
              '&key=%s') % (LOCATION, AUTH_KEY)
    
    response = urllib.request.urlopen(my_url)
    json_raw = response.read()
    json_data = json.loads(json_raw)
  
    return json_data

# get all distances/times from origin to points in lehman
def get_dist(lat, lng, dest:list, key):
	AUTH_KEY = key
	ORIGIN = str(lat) + "," + str(lng)
	DESTINATIONS = '|'.join([str(d[0]) + ',' + str(d[1]) for d in dest])
	my_url = ('https://maps.googleapis.com/maps/api/distancematrix/json?'
	          'origins=%s'
	          '&destinations=%s'
	          '&mode=walking'
	          '&units=imperial'
	          '&key=%s') % (ORIGIN, DESTINATIONS, AUTH_KEY)

	response = urllib.request.urlopen(my_url)
	json_raw = response.read()
	json_data = json.loads(json_raw)

	return json_data

# get nearest k lehman buildings
def get_nearby_lehman(lat, lng, k=4, buildings=buildings):
    df = pd.DataFrame()
    address = []
    value = []
    dist = []
    time = []
    for i in range(len(coords_nearby)):
        dists = get_dist(lat, lng, coords_nearby[i], API_KEY)
        addresses = dists['destination_addresses']
        elements = dists['rows'][0].get('elements')
        values = []
        dists = []
        times = []
        for i in range(len(elements)):
            values.append(elements[i]['distance'].get('value'))
            dists.append(elements[i]['distance'].get('text'))
            times.append(elements[i]['duration'].get('text'))
        address.extend(addresses)
        value.extend(values)
        dist.extend(dists)
        time.extend(times)

    df['long_address'] = address
    df['short_address'] = df['long_address'].apply(lambda x: x.split(',')[0])
    df['dist'] = dist
    df['value'] = value
    df['time'] = time

    df = df.sort_values(by=['value']).drop_duplicates(subset=['short_address'])
    lehman = df.loc[df['short_address'].isin(buildings)]
    
    nearest = lehman.reset_index(drop=True)[:k]

    return nearest


def main():
	my_loc = gmaps.geolocate().get('location')
	my_lat = my_loc.get('lat')
	my_lng = my_loc.get('lng')
	near_me = get_nearby_lehman(my_lat, my_lng)
	near_me.to_json('nearest_building.json', orient='index')	

if __name__ == '__main__':
	main()