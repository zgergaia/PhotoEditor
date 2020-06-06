<?php
require_once __DIR__ . "/../processing/Crop.php";
require_once __DIR__ . "/../processing/Brightness.php";

class EditController {
    public function editor(IRequest $request, $router) {
        $response = $request->getBody();
        $mode = $response['mode'];
        $Ext = substr($response['img_src'], strrpos($response['img_src'], ".") + 1);
        $result = "";
        switch ($mode) {
            case "crop":
                $crop = null;
                $crop = new crop($response['X'], $response['Y'], $response['Width'], $response['Height'], $response['img_src']);
                $result = $crop->cropimage();

                if(count($crop->errors) !== 0) {
                    return $router->getViewContent("Editor", [
                        "errors" => $crop->errors,
                        "img_src" => $result
                    ]);
                } else {
                    return $router->getViewContent("Edited", [
                        "img_src" => $result
                    ]);
                }
                break;

            case "brightness":
                $brighness = null;
                $brighness = new brightness($response['brightness'], $response['img_src']);
                $result = $brighness->adjustBrightness();

                if(count($brighness->errors) !== 0) {
                    return $router->getViewContent("Editor", [
                        "errors" => $brighness->errors,
                        "img_src" => $result
                    ]);
                } else {
                    return $router->getViewContent("Edited", [
                        "img_src" => $result
                    ]);
                }
                break;
            case "contrast":
                $contrast = null;
                $contrast = new brightness($response['contrast'], $response['img_src']);
                $result = $contrast->adjustBrightness();

                if(count($contrast->errors) !== 0) {
                    return $router->getViewContent("Editor", [
                        "errors" => $contrast->errors,
                        "img_src" => $result
                    ]);
                } else {
                    return $router->getViewContent("Edited", [
                        "img_src" => $result
                    ]);
                }
                break;
        }
    }
}