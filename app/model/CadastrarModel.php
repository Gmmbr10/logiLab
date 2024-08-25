<?php

class CadastrarModel
{

    private $erros;
    private $resultado;
    private $formDados;
    private $tamanhoMinimoSenha = 5;
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

        if ($this->verificarEmail()) {

            $this->resultado["resultado"] = "erro";
            $this->resultado["erros"][] = "Já existe uma conta com este email";
            return;
        }

        $senhaCrip = password_hash($this->formDados["senha"], PASSWORD_DEFAULT);

        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome,email,senha,tipo) VALUES (?,?,?,'comum')");
        $sql->execute(array($this->formDados["nome"], $this->formDados["email"], $senhaCrip));

        $this->resultado["resultado"] = "sucesso";
        $this->resultado["mensagem"][] = "Usuário cadastrado com sucesso!";

        $this->formDados["nome"] = "";
        $this->formDados["email"] = "";
        $this->formDados["senha"] = "";

        return;
    }

    private function verificarDados()
    {

        if (empty($this->formDados["nome"])) {

            $this->erros[] = "Preencha o campo nome!";
        }

        if (empty($this->formDados["email"])) {

            $this->erros[] = "Preencha o campo email!";
        }

        if (empty($this->formDados["senha"])) {

            $this->erros[] = "Preencha o campo senha!";
        } else if (mb_strlen($this->formDados["senha"]) <= $this->tamanhoMinimoSenha) {

            $this->erros[] = "A senha deve ser maior que {$this->tamanhoMinimoSenha} dígitos";
        }
    }

    private function verificarEmail()
    {
        $sql = $this->pdo->prepare("select * from usuarios where email = ?");
        $sql->execute(array($this->formDados["email"]));
        $result = $sql->fetchAll();

        if (!empty($result)) {

            return true;
        }

        return false;
    }

    public function getResultados()
    {
        return $this->resultado;
    }

    public function getFormDados()
    {
        return $this->formDados;
    }
}
