<?php
require_once __DIR__ . "/IRequest.php";

class Request implements IRequest {
    public function __construct() {
        foreach ($_SERVER as $key => $item) {
            $camelCaseKey = $this->toCamelCase($key);
            $this->{$camelCaseKey} = $item;
        }
    }

    public function toCamelCase($string) {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/',$result, $matches);
        foreach ($matches[0] as $match){
            $c = str_replace('_','', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }
        return $result;
    }

    public function getBody() {
        if($this->getMethod() === "get") {
            $body = [];
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $body;
        }
        else if($this->getMethod() === "post") {
            $body = [];
            if(isset($_FILES['image'])) {
                foreach ($_FILES as $key => $value)
                    $body[$key] = $_FILES[$key];
            } else {
                foreach ($_POST as $key => $value)
                    $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $body;
        }
    }

    public function getMethod() {
        return strtolower($this->requestMethod);
    }

    public function getPath() {
        return $this->pathInfo ?? "/";
    }
}