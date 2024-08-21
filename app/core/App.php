<?php

class App
{

    public function __construct()
    {

        $url = filter_input(INPUT_GET, "url", FILTER_DEFAULT);

        $url = explode("/", $url);

        $className = ucfirst(strtolower($url[0])) . "Controller";

        $caminho = __DIR__ . "/../controller/";

        if (!file_exists($caminho . $className . ".php")) {

            $className = "NotFoundController";
        }

        $class = $caminho . $className . ".php";

        require_once $class;

        $class = new $className();
    }
}
