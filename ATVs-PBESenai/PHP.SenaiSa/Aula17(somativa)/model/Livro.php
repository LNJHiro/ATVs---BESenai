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

    /**
     * Get the value of ano_publicacao
     */ 
    public function getAnoPublicacao()
    {
        return $this->ano_publicacao;
    }

    /**
     * Set the value of ano_publicacao
     *
     * @return  self
     */ 
    public function setAnoPublicacao($ano_publicacao)
    {
        $this->ano_publicacao = $ano_publicacao;

        return $this;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of genero_literario
     */ 
    public function getGeneroLiterario()
    {
        return $this->genero_literario;
    }

    /**
     * Set the value of genero_literario
     *
     * @return  self
     */ 
    public function setGeneroLiterario($genero_literario)
    {
        $this->genero_literario = $genero_literario;

        return $this;
    }

    /**
     * Get the value of autor
     */ 
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     *
     * @return  self
     */ 
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get the value of qtde
     */ 
    public function getQtde()
    {
        return $this->qtde;
    }

    /**
     * Set the value of qtde
     *
     * @return  self
     */ 
    public function setQtde($qtde)
    {
        $this->qtde = $qtde;

        return $this;
    }
}