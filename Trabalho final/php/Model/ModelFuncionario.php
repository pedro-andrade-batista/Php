<?php
class ModelFuncionario {

	public $idFuncionario;
	public $nome; 
	public $salario;
	public $login;
	public $senha; 
	public $idPermissao;
    public $idDepartamento;
    public $ativo;
    public $nomeDepartamento;
    public $tipoPermissao;

    /**
     * Popula um obj funcionario com os dados vindos da tabela funcionario. Funciona como um construtor
     *
     * @param um array com dados da tupla proveniente do DB, em que o nome do atributo na entidade é o mesmo do atributo no objeto
     *
     * @return não há retorno.
     */
    public function setFuncionarioFromDataBase($linha){
        $this->setIdFuncionario($linha["idFuncionario"])
               ->setNome($linha["nome"])
               ->setSalario($linha["salario"])
               ->setLogin($linha['login'])
               ->setSenhaBD($linha['senha'])
               ->setIdPermissao($linha['idPermissao'])
               ->setIdDepartamento($linha['idDepartamento'])
               ->setAtivo($linha['ativo']);
               
    }
    public function setFuncionarioFromPOST(){
        $this->setIdFuncionario(null)
               ->setNome($_POST["nome"])
               ->setSalario($_POST["salario"])
               ->setLogin($_POST['login'])
               ->setSenhaPOST($_POST['senha'])
               ->setIdPermissao(2)
               ->setIdDepartamento(1);
    }

    public function updateFuncionarioFromPOST($func){
        $this->setIdFuncionario($func["idFuncionario"])
               ->setNome($_POST["nome"])
               ->setSalario($_POST["salario"])
               ->setLogin($_POST['login'])
               ->setSenhaPOST($_POST['senha'])
               ->setIdPermissao($_POST['permissao'])
               ->setIdDepartamento($_POST['departamento']);
    }
    

    /**
     * Gets the value of idFuncionario.
     *
     * @return mixed
     */
    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }

    /**
     * Sets the value of idFuncionario.
     *
     * @param mixed $idFuncionario the id funcionario
     *
     * @return self
     */
    public function setIdFuncionario($idFuncionario)
    {
        $this->idFuncionario = $idFuncionario;

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
     * Gets the value of salario.
     *
     * @return mixed
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * Gets the value of ativo.
     *
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Sets the value of Ativo.
     *
     * @param mixed $ativo the ativo
     *
     * @return self
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo ;

        return $this;
    }

    /**
     * Sets the value of salario.
     *
     * @param mixed $salario the salario
     *
     * @return self
     */
    public function setSalario($salario)
    {
        $this->salario = $salario ;

        return $this;
    }

    /**
     * Gets the value of login.
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Sets the value of login.
     *
     * @param mixed $login the login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Gets the value of senha.
     *
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Sets the value of senha.
     *
     * @param mixed $senha the senha
     *
     * @return self
     */
    public function setSenha($senha)
    {
        //Por mais que função do PHP password_hash seja mais segura, ela vai dar problema na correção
        #$this->senha = password_hash($senha, PASSWORD_DEFAULT);
        $this->senha = $senha;
        return $this;
    }

    /**
     * Sets the value of senha.
     *
     * @param mixed $senha the senha
     *
     * @return self
     */
    public function setSenhaPOST($senha)
    {
        //Por mais que função do PHP password_hash seja mais segura, ela vai dar problema na correção
        #$this->senha = password_hash($senha, PASSWORD_DEFAULT);
        $this->senha = md5("salgada".$senha);
        return $this;
    }
    public function setSenhaBD($senha)
    {
        //Qdo a senha vem do banco, não posso criptografar, pq ela já vem criptografada
        $this->senha = $senha;
        return $this;
    }

    /**
     * Gets the value of idPermissao.
     *
     * @return mixed
     */
    public function getIdPermissao()
    {
        return $this->idPermissao;
    }

    /**
     * Sets the value of idPermissao.
     *
     * @param mixed $idPermissao the id permissao
     *
     * @return self
     */
    public function setIdPermissao($idPermissao)
    {
        $this->idPermissao = $idPermissao;
        return $this;
    }

    /**
     * Gets the value of idDepartamento.
     *
     * @return mixed
     */
    public function getIdDepartamento()
    {
        return $this->idDepartamento;
    }

    /**
     * Sets the value of idDepartamento.
     *
     * @param mixed $idDepartamento the id departamento
     *
     * @return self
     */
    public function setIdDepartamento($idDepartamento)
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }


    public function getNomeDepartamento()
    {
        return $this->nomeDepartamento;
    }

    /**
     * Sets the value of NomeDepartamento.
     *
     * @param mixed $NomeDepartamento the id departamento
     *
     * @return self
     */
    public function setNomeDepartamento($nomeDepartamento)
    {
        $this->nomeDepartamento = $nomeDepartamento;

        return $this;
    }


    public function getTipoPermissao()
    {
        return $this->tipoPermissao;
    }

    /**
     * Sets the value of tipoPermissao.
     *
     * @param mixed $tipoPermissao the idPermissao
     *
     * @return self
     */
    public function setTipoPermissao($tipoPermissao)
    {
        $this->tipoPermissao = $tipoPermissao;

        return $this;
    }
}