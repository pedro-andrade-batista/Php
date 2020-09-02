<?php
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelPermissao.php';

class PermissaoDAO{
    function getAllPermissao(){
        $instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		//Faço o select usando prepared statement
		$statement = $conn->prepare("SELECT * FROM permissao");		
		$statement->execute();

		//linhas recebe todas as tuplas retornadas do banco		
		$linhas = $statement->fetchAll();
		
		//Verifico se houve algum retorno, senão retorno null
		if(count($linhas)==0)
				return null;

		//Var que irá armazenar um array de obj do tipo funcionário
		$permissoes;		
		
		foreach ($linhas as $value) {
            $permissao = new Modelpermissao();
            //print_r($value);
			$permissao->setpermissaoFromDataBase($value);			
			$permissoes[]=$permissao;
		}	
		return $permissoes;
	}
	
	function getTipoById($id){
        try{
            $sql = "SELECT tipo FROM permissao where id = :id";

            $instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			$statement = $conn->prepare($sql);

            $statement->bindValue(":id",$id);

            $statement->execute();

            $tipo = $statement->fetchAll();
            
            if(count($tipo) == 0)
                return null;
            
            foreach($tipo as $value){

                return $value["tipo"];
            }
            
        } catch (PDOException $e) {
            echo "Erro ao recuperar o tipo do permissao na base de dados.".$e->getMessage();
        }	
	}
	
	function getIdByType($tipo){
		try{
            $sql = "SELECT id FROM permissao where tipo = :tipo";

            $instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			$statement = $conn->prepare($sql);

            $statement->bindValue(":tipo",$tipo);

            $statement->execute();

            $id = $statement->fetchAll();
            
            if(count($id) == 0)
                return null;
            
            foreach($id as $value){

                return $value["id"];
            }
            
        } catch (PDOException $e) {
            echo "Erro ao recuperar o id do permissao na base de dados.".$e->getMessage();
        }	
	}
}



?>
