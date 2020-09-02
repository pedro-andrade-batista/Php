<?php

class ModelPermissao{
    public $id;
    public $tipo;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Sets the value of tipo.
     *
     * @param mixed $tipo the id funcionario
     *
     * @return self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function setpermissaoFromDataBase($value){
        $this->setId($value["id"])
            ->setTipo($value["tipo"]);
    }
}



?>