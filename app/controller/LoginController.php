<?php

class LoginController extends Controller
{

    private $model;
    private $banco;
    public $resultadoModel;
    public $formDados = ["email"=>"","senha"=>""];

    public function __construct()
    {

        if (isset($_POST["btnLogin"])) {

            $this->banco = $this->pdo();
            $this->model = $this->loadModel("Login", $this->banco);
            $this->resultadoModel = $this->model->getResultado();
            $this->formDados = $this->model->getFormDados();
        }

        $this->loadView("login");
    }
}
