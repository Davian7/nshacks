<?php
/**
 * Created by IntelliJ IDEA.
 * User: jeff
 * Date: 11/17/18
 * Time: 3:12 AM
 */
$CONFIG['database']['host'] = 'jeffrey.gq';
$CONFIG['database']['user'] = 'jeffreym_hackathon';
$CONFIG['database']['pass'] = 'lehman2018';
$CONFIG['database']['db'] = 'jeffreym_hackathon';
$CONFIG['database']['port'] = 3306;

$CONFIG['site']['name'] = 'iAssist';
$CONFIG['site']['desc'] = 'Helping Accessible';
$CONFIG['google']['api_key'] = 'AIzaSyA7xAjMq9O83M2WKh__rJtoUgZapQifq4g';

$connection = mysqli_connect($CONFIG['database']['host'],$CONFIG['database']['user'],$CONFIG['database']['pass'],$CONFIG['database']['db'],$CONFIG['database']['port']);

?>