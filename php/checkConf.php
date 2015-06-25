<?php
/**
 * Created by PhpStorm.
 * User: jumon
 * Date: 24/06/15
 * Time: 15:41
 */

$result = array();

$confFile = parse_ini_file("../config.ini",true);
$startFolder = $confFile['scanDir']['startFolder'];

$result['scanDir']['error'] = false;
if(!$startFolder){
    $result['scanDir']['error'] = true;
    $result['scanDir']['errMessage'] = "unable to define start folder (please check config file)";
}

if(!is_dir($startFolder)){
    $result['scanDir']['error'] = true;
    $result['scanDir']['errMessage'] = "startFolder is not a directory";
}

echo json_encode($result);