<?php

class HomeController {
    public function Home(IRequest $request, $router)
    {
        return $router->getViewContent("Home", [
            "errors" => [],
            "img_src" => ""
        ]);
    }

    public function postHome(IRequest $request, $router)
    {
        $errors = [];
        $response = $request->getBody();

        if (isset($response['image']['name'])) {
            $Ext = pathinfo($response['image']['name'], PATHINFO_EXTENSION);
            $Ext = strtolower($Ext);
            $IMG_src = '';

            if (!in_array($Ext, ['jpg', 'png', 'jpeg']))
                $errors['type_error'] = "You can only upload images";
            else if ($response['image']['size'] > 5 * 1024 * 1024)
                $errors['size_err'] = 'File size can not be more than 5MB';
            else if ($response['image']['error'] === 0) {
                $dest = __DIR__ . "/../public";
                $filename = filter_var($response['image']['name'], FILTER_SANITIZE_SPECIAL_CHARS);
                move_uploaded_file($response['image']['tmp_name'], "{$dest}/{$filename}");
                $IMG_src = "{$dest}/{$filename}";

                $idx = strrpos($IMG_src, "/");
                $IMG_src = substr($IMG_src, $idx + 1);
            }
            if (count($errors) > 0)
                return $router->getViewContent("/Home", [
                    "errors" => $errors,
                ]);
            else
                return $router->getViewContent("/Editor", [
                    "img_src" => $IMG_src,
                ]);
        } else if (strlen($response['download']) > 0) {
            $src = __DIR__ . $response['image'];
            $size = filesize($src);
            $idx = strrpos($response['image'], "/") + 1;
            $len = strpos($response['image'], "_") + 1 - $idx;
            $ext = substr($response['image'], strrpos($response['image'], ".") + 1);
            $file_name = substr($response['image'], $idx, $len - 1);
            $file_name .= "Edited.{$ext}";

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . $size); //Absolute URL
            ob_clean();
            flush();
            readfile($src); //Absolute URL

        } else if (isset($response['image'])) {
            $dest = __DIR__ . "/../public/edited";
            $IMG_src = $response['image'];
            $idx = strrpos($IMG_src, "/");
            $IMG_src = substr($IMG_src, $idx + 1);
            rename($dest . "/{$IMG_src}", __DIR__ . "/../public/{$IMG_src}");

            return $router->getViewContent("Editor", [
                "img_src" => $IMG_src
            ]);
        }
    }
    public function demo(IRequest $request, $router)
    {
        return $router->getViewContent("Demo", [
            "errors" => [],
            "img_src" => ""
        ]);
    }
    public function about(IRequest $request, $router)
    {
        return $router->getViewContent("About", [
            "errors" => [],
            "img_src" => ""
        ]);
    }
}