<?php

class CadastrarController extends Controller
{

    private $model;
    public $resultadoModel;
    public $formData = ["nome"=>"","email"=>"","senha"=>""];
    private $banco;

    public function __construct()
    {
        if (isset($_POST["btnCad"])) {

            $this->model = $this->loadModel("Cadastrar",$this->pdo());;
            $this->resultadoModel = $this->model->getResultados();
            $this->formData = $this->model->getFormDados();
        }

        $this->loadView("cadastrar");
    }
}
