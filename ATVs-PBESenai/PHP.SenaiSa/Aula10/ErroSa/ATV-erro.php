<!--  -->

<?php 
class disciplina {

private $materia;
private $professor;
private $lab;
private $nalunos;
private $nmedia;

private function __construct($materia, $professor, $lab, $nalunos, $nmedia) {
    $this->setMateria($materia);
    $this->setProfessor($professor);
    $this->lab = $lab;
    $this->setNalunos($nalunos);
    $this->setNmedia($nmedia);
}

private function setMateria ($materia) {
    $this->materia = ucwords(strtolower($materia));
}
private function getMateria () {
    return $this->materia;
}

private function setProfessor ($professor) {
    $this->professor = ucwords(strtolower($professor));
}
private function getProfessor () {
    return $this->professor;
}

private function setNalunos ($nalunos) {
    $this->nalunos = abs($nalunos);
}
private function getNalunos () {
    return $this->nalunos;
}

private function setNmedia ($nmedia) {
    $this->nmedia = number_format($nmedia, 2, '.', '');
}
private function getNmedia () {
    return $this->nmedia;
}

public function ativar ($ativar) {
    if ($ativar == true) {
        echo "Essa disciplina está ativa";
    } else {
        echo "Essa disciplina acabou de ser ativada";
        return true;
    }
}

public function obrigatoria ($obrigatoria) {
    if($obrigatoria == true) {
        echo "Essa matéria é obrigatória";
    } else {
        echo "Essa matéria não é obrigatória";
    }
}

}

$disciplina1 = new disciplina("POO", "Samuel", "Sala-01", 40, 6);
$disciplina2 = new disciplina("Internet Das Coisas", "Bruno", "Sala-IOT", 20, 6);
