<?php

class LoginModel
{

    private $formDados;
    private $erros;
    private $resultado;
    private $pdo;

    public function __construct(PDO $conexao)
    {

        $this->formDados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $this->verificarDados();

        if (!empty($this->erros)) {

            $this->resultado["resultado"] = "erro";
            $this->resultado["erros"] = $this->erros;
            return;
        }

        $this->pdo = $conexao;
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ? LIMIT 1");
        $sql->execute(array($this->formDados["email"]));

        $result = $sql->fetchAll();

        if (empty($result) || !password_verify($this->formDados["senha"], $result[0]["senha"])) {

            $this->resultado["resultado"] = "erro";
            $this->resultado["erros"][] = "Email ou senha incorreto(s)!";
            return;
        }

        $_SESSION["usuario"] = $result[0];

        header("location: /usuario/home");
    }

    private function verificarDados()
    {

        if (empty($this->formDados["email"])) {

            $this->erros[] = "Preencha o campo email!";
        }

        if (empty($this->formDados["senha"])) {

            $this->erros[] = "Preencha o campo senha!";
        }
    }

    public function getResultado()
    {
        return $this->resultado;
    }

    public function getFormDados()
    {
        return $this->formDados;
    }
}
