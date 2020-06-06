<?php
require_once __DIR__ . "/../processing/Brightness.php";
require_once __DIR__ . "/../processing/Contrast.php";
require_once __DIR__ . "/../Request.php";


$request = new Request();
$response = $request->getBody();
$mode = $response['mode'];

switch ($mode) {
    case "brightness":
        $brighness = null;
        $brighness = new brightness($response['brightness'], $response['img_src'], true);
        $result = $brighness->adjustBrightness();
        echo $result;
        break;
    case "contrast":
        $contrast = null;
        $contrast = new contrast($response['contrast'], $response['img_src'], true);
        $result = $contrast->adjustContrast();
        echo $result;
        break;
}