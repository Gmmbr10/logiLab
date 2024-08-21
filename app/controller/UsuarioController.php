<?php

class UsuarioController extends Controller
{

    public $usuario;

    public function __construct() {

        if ( !isset($_SESSION["usuario"]) ) {

            header("location: home");
        }

        $url = filter_input(INPUT_GET,"url",FILTER_DEFAULT);
        $url = mb_strtolower(mb_substr($url,mb_strlen("usuario/")));
        $url = explode("/",$url);

        if ( $url[0] == "sair" ) {

            session_destroy();
            header("location: ../home");
            return;
        }

        if ( $url[0] == "home" ) {

            $this->loadView("usuario/home");
            return;
        }
        
    }
}
