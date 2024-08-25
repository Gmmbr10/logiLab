<?php

class UsuarioController extends Controller
{

    public $usuario;
    private $model;
    public $formData = ["materia"=>"","aulas"=>[],"dataUso"=>"","turmaDividida"=>""];
    public $resultadoModel;

    public function __construct()
    {

        if (!isset($_SESSION["usuario"])) {

            header("location: home");
        }

        $url = filter_input(INPUT_GET, "url", FILTER_DEFAULT);
        $url = mb_strtolower(mb_substr($url, mb_strlen("usuario/")));
        $url = explode("/", $url);

        if ( isset($_POST["btnAgendar"]) ) {

            $this->model = $this->loadModel("Agendar",$this->pdo());
            $this->resultadoModel = $this->model->getResultado();
            
        }

        $this->loadView("usuario/home");

        if ($url[0] == "sair") {

            session_destroy();
            header("location: ../home");
            return;
        }
    }
}
