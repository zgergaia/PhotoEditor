<?php

class Router{
    /**
     * @var IRequest
     */
    public $request = null;
    public $routes = [];
    public $postRoutes = [];

    public function __construct(IRequest $request) {
        $this->request = $request;
    }

    public function get($path, $callback) {
        $this->routes[$path] = $callback;
    }

    public function post($path, $callback) {
        $this->postRoutes[$path] = $callback;
    }
    public function getViewContent(string $callback, $params = []) {
        foreach ($params as $key => $value)
            $$key = $value; //goes to home.php

        ob_start();
        include_once __DIR__ . "/view/{$callback}.php";
        return ob_get_clean(); //returns flushed cache
    }

    public function __destruct() {
        $pathInfo = $this->request->getPath();

        if($this->request->getMethod() === "get") {
            $callback = $this->routes[$pathInfo] ?? false;
        } else {
            $callback = $this->postRoutes[$pathInfo] ?? false;
        }

        if(!$callback)
            $content = "Error 404 - Page not Found";
        else {
            if(is_string($callback)) {
                $content = $this->getViewContent($callback);
            } else
                $content = call_user_func($callback, $this->request, $this);
            }
        include_once __DIR__ . "/view/layout.php";
    }
}