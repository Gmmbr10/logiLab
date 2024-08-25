<?php

class AgendarModel
{

    private $pdo;
    private $erros;
    private $resultado;
    private $lab;

    public function __construct(PDO $conexao)
    {

        $this->pdo = $conexao;

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $this->verificarDados($dados);

        if (!empty($this->erros)) {

            $this->resultado["resultado"] = "erro";
            $this->resultado["erros"] = $this->erros;
            return;
        }

        $this->escolherLab($dados["materia"]);

        if ($this->diaEmUso($dados["dataUso"], $this->lab) == false) {

            $this->agendar($dados);
            $this->resultado["resultado"] = "sucesso";
            $this->resultado["mensagem"][] = "Laboratório {$this->lab} agendado para " . date("d m Y",strtotime($dados["dataUso"]));
            return;
        }

        if (empty($this->aulasIguais($this->getDiaEmUso($dados["dataUso"]), $dados["aulas"]))) {

            $this->agendar($dados);
            $this->resultado["resultado"] = "sucesso";
            $this->resultado["mensagem"][] = "Laboratório {$this->lab} agendado para " . date("d m Y",strtotime($dados["dataUso"]));
            return;
        }
        
        var_dump($this->lab);

        switch ($this->lab) {
            case 1:
                $this->lab = 4;
                break;
            case 4:
                $this->lab = 1;
                break;
            case 2:
                $this->lab = 3;
                break;
            case 3:
                $this->lab = 2;
                break;
            default:
                break;
        }
        
        var_dump($this->lab);

        if ($this->diaEmUso($dados["dataUso"], $this->lab) == false) {

            $this->agendar($dados);
            $this->resultado["resultado"] = "sucesso";
            $this->resultado["mensagem"][] = "Laboratório {$this->lab} agendado para " . date("d m Y",strtotime($dados["dataUso"]));
            return;
        }

        if (empty($this->aulasIguais($this->getDiaEmUso($dados["dataUso"]), $dados["aulas"]))) {

            $this->agendar($dados);
            $this->resultado["resultado"] = "sucesso";
            $this->resultado["mensagem"][] = "Laboratório {$this->lab} agendado para " . date("d m Y",strtotime($dados["dataUso"]));
            return;
        }

        $this->resultado["resultado"] = "alerta";
        $this->resultado["mensagem"][] = "Não foi possível realizar o agendamento do laboratório!<br>Caso no dia tenha algum laboratório disponível, faça o uso do mesmo";
        return;
    }

    private function escolherLab(string $materia)
    {

        if ($materia == "adm" || $materia == "comum") {
            $this->lab = [1, 4][array_rand([1, 4])];
        } else {
            $this->lab = [2, 3][array_rand([2, 3])];
        }
    }

    private function getDiaEmUso(string $data, int $lab = null)
    {
        $dataFormatada = date("Y-m-d", strtotime($data));

        $sql = $this->pdo->prepare("SELECT * FROM agenda WHERE data = ? and lab = ?");
        $sql->execute(array($dataFormatada,$lab));
        $result = $sql->fetchAll();

        return $result;
    }

    private function diaEmUso(string $data, int $lab)
    {

        $dataFormatada = date("Y-m-d", strtotime($data));

        $sql = $this->pdo->prepare("SELECT * FROM agenda WHERE data = ? and lab = ?");
        $sql->execute(array($dataFormatada, $lab));
        $result = $sql->fetchAll();

        if (empty($result)) {
            return false;
        }

        return true;
    }

    private function aulasIguais(array $aulasAgendadas, array $aulasParaAgendar)
    {

        var_dump($aulasAgendadas);
        var_dump($aulasParaAgendar);

        $idAgenda = [];
        foreach ($aulasAgendadas as $aulaAgendada) {
            $arrayAulasAgendadas = explode(",", $aulaAgendada["aula"]);

            foreach ($aulasParaAgendar as $aula) {
                if (in_array($aula, $arrayAulasAgendadas)) {
                    // var_dump($this->lab);
                    // var_dump($arrayAulasAgendadas);
                    // var_dump($aula);
                    $idAgenda[] = $aulaAgendada["id"];
                    break;
                }
            }
        }

        return $idAgenda;
    }

    private function agendar(array $dados)
    {
        $aulas = "";
        foreach ($dados["aulas"] as $aula) {
            if (!empty($aulas)) {
                $aulas .= ",";
            }
            $aulas .= $aula;
        }

        $data = date("Y-m-d", strtotime($dados["dataUso"]));

        $sql = $this->pdo->prepare("INSERT INTO agenda (lab,aula,data,id_usuario) values (?,?,?,?)");
        $sql->execute(array($this->lab, $aulas, $data, $_SESSION["usuario"]["id"]));
    }

    private function verificarDados(array $dados)
    {

        if (empty($dados["materia"])) {

            $this->erros[] = "Selecione a base da sua matéria";
        }

        if (empty($dados["dataUso"])) {

            $this->erros[] = "Selecione a data de uso do laboratório";
        }

        if (empty($dados["aulas"])) {

            $this->erros[] = "Selecione a(s) aula(s) de uso do laboratório";
        }

        if (empty($dados["turmaDividida"])) {

            $this->erros[] = "Selecione se sua aula tem turma dividida";
        }
    }

    public function getResultado()
    {
        return $this->resultado;
    }
}
