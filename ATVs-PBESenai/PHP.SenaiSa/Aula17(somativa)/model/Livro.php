<?php

class Livro {
    private $titulo;
    private $genero_literario;
    private $autor;
    private $ano_publicacao;
    private $qtde;

    public function __construct($titulo, $genero_literario, $autor, $ano_publicacao, $qtde){
        $this->titulo = $titulo;
        $this->genero_literario = $genero_literario;
        $this->autor = $autor;
        $this->ano_publicacao = $ano_publicacao;
        $this->qtde = $qtde;
    }

     
    public function getAnoPublicacao()
    {
        return $this->ano_publicacao;
    }

     
    public function setAnoPublicacao($ano_publicacao)
    {
        $this->ano_publicacao = $ano_publicacao;

        return $this;
    }

     
    public function getTitulo()
    {
        return $this->titulo;
    }

     
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

     
    public function getGeneroLiterario()
    {
        return $this->genero_literario;
    }

     
    public function setGeneroLiterario($genero_literario)
    {
        $this->genero_literario = $genero_literario;

        return $this;
    }

     
    public function getAutor()
    {
        return $this->autor;
    }

     
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    
    public function getQtde()
    {
        return $this->qtde;
    }

     
    public function setQtde($qtde)
    {
        $this->qtde = $qtde;

        return $this;
    }
}