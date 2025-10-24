<?php 

Class Pessoa {
    private $nome;
    private $cpf;
    private $telefone;
    private $idade;
    private $email;
    private $senha;

    public function __construct($nome, $cpf, $telefone, $idade, $email, $senha) {
        $this->setNome($nome);
        $this->setCPF($cpf);
        $this->setTelefone($telefone);
        $this->setidade($idade);
        $this->email = $email;
        $this->senha = $senha;
    }
    public function setNome($nome) {
        $this->nome = ucwords(strtolower($nome));
    }
    public function getNome() {
        return $this->nome;
    }
    public function setCpf($cpf) {
        $this->cpf = preg_replace('/\D/', '', $cpf);
    }
    public function getCpf() {
        return $this->cpf;
    }
    public function setTelefone($telefone) {
        $this->telefone = preg_replace('/\D/', '', $telefone);
    }
    public function getTelefone() {
        return $this->telefone;
    }
    public function setIdade($idade){
        $this->idade = abs((int)$idade);
    }
    public function getIdade(){
        return $this->idade;
    }

    public function ExibirInfo() {
        return "Nome: $this->nome()\n CPF: $this->cpf \n 
        Telefone: $this->telefone \n Idade: $this->idade \n Email: $this->email \n Senha: $this->senha";
    }
}
$Aluno1 = new Pessoa("hayron", "123.456.789-00", "(11) 91234-5678",
 -19, "teste@gmail.com", 'teste1234',);

 echo $Aluno1->getNome();
 echo $Aluno1->getCpf();

?>