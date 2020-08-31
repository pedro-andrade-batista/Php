<?php

class ModelDepartamento{
    public $id;
    public $nome;




     /**
     * Popula um obj funcionario com os dados vindos da tabela funcionario. Funciona como um construtor
     *
     * @param um array com dados da tupla proveniente do DB, em que o nome do atributo na entidade é o mesmo do atributo no objeto
     *
     * @return não há retorno.
     */
    public function setDepartamentoFromDataBase($linha){
        $this->setId($linha["id"])
               ->setNome($linha["nome"]);
    }
    public function setDepartamentoFromPOST(){
        $this->setId($_POST["id"])
               ->setNome($_POST["nome"]);
    }


    /**
     * Sets the value of id.
     *
     * @param mixed $id the id 
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }


}


?>