<?php

include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelDepartamento.php';


class DepartamentoDAO{
    function getNameFromId($id){
        try{
            $sql = "SELECT nome FROM departamento WHERE id = :id";

            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();

            $statement = $conn->prepare($sql);
            $statement->bindValue(":id", $id);

            $statement->execute();

            $nome = $statement->fetch();
            return $nome["nome"];

        } catch(PDOException $e){
            echo "Erro ao pegar o nome do departamento.".$e->getMessage();
        }
    }

    function getAllDepartamentos(){	


		//pego uma ref da conexão
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		//Faço o select usando prepared statement
		$statement = $conn->prepare("SELECT * FROM departamento");		
		$statement->execute();

		//linhas recebe todas as tuplas retornadas do banco		
		$linhas = $statement->fetchAll();
		
		//Verifico se houve algum retorno, senão retorno null
		if(count($linhas)==0)
				return null;

		//Var que irá armazenar um array de obj do tipo funcionário
		$departamentos;		
		
		foreach ($linhas as $value) {
			$departamento = new ModelDepartamento();
			$departamento->setDepartamentoFromDataBase($value);			
			$departamentos[]=$departamento;
		}	
		return $departamentos;		
    }
    
    function setDepartamento($depto){			

		try {
			//monto a query
            $sql = "INSERT INTO departamento (		
                id,
                nome) 
                VALUES (
                :id,
                :nome)"
        	;

            //pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);

            $statement->bindValue(":id", $depto->getId());
            $statement->bindValue(":nome", $depto->getNome());
            return $statement->execute();

        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
        }		
    }

    function getNameById($id){
        try{
            $sql = "SELECT nome FROM departamento where id = :id";

            $instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			$statement = $conn->prepare($sql);

            $statement->bindValue(":id",$id);

            $statement->execute();

            $nome = $statement->fetchAll();
            
            if(count($nome) == 0)
                return null;
            
            foreach($nome as $value){

                return $value["nome"];
            }
            
        } catch (PDOException $e) {
            echo "Erro ao recuperar o nome do departamento na base de dados.".$e->getMessage();
        }	

    }
    function getIdByName($nome){
        try{
            $sql = "SELECT id FROM departamento where nome = :nome";

            $instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			$statement = $conn->prepare($sql);

            $statement->bindValue(":nome",$nome);

            $statement->execute();

            $id = $statement->fetchAll();
            
            if(count($id) == 0)
                return null;
            
            foreach($id as $value){

                return $value["id"];
            }
            
        } catch (PDOException $e) {
            echo "Erro ao recuperar o nome do departamento na base de dados.".$e->getMessage();
        }	

    }
}


?>