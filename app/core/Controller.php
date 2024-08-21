<?php

class Controller
{

    private $typeHeaderAndFooter = "default";

    protected function loadView(String $viewPath)
    {

        if (isset($_SESSION["usuario"])) {

            $this->typeHeaderAndFooter = "logged";
        }

        $this->loadHeader($this->typeHeaderAndFooter);
        require_once __DIR__ . "/../view/" . $viewPath . ".php";
        $this->loadFooter($this->typeHeaderAndFooter);
    }

    protected function loadModel(String $modelPath, PDO $banco = null)
    {
        $modelName = $modelPath . "Model";
        require_once __DIR__ . "/../model/" . $modelName . ".php";
        return new $modelName($banco);
    }

    private function loadHeader(String $type)
    {

        switch ($type) {
            case "logged":
                require_once __DIR__ . "/../view/templates/logged/header.php";
                break;
            case "default":
            default:
                require_once __DIR__ . "/../view/templates/default/header.php";
                break;
        }
    }

    private function loadFooter(String $type)
    {

        switch ($type) {
            case "logged":
                require_once __DIR__ . "/../view/templates/logged/footer.php";
                break;
            case "default":
            default:
                require_once __DIR__ . "/../view/templates/default/footer.php";
                break;
        }
    }

    public function pdo()
    {
        require_once __DIR__ . "/conexao.php";
        return $pdo;
    }
}
