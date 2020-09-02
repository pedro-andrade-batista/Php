<?php
//Add a classe responsavel por fazer a conexao com banco de dados
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';
class FuncionarioDAO {
	/*Como o PHP tem inferência de tipo, esse método, assim como outros, poderia ser mais "simples", porém estou fazendo de uma maneira que acho mais didático*/
	function getAllFuncionarios(){	


		//pego uma ref da conexão
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		//Faço o select usando prepared statement
		$statement = $conn->prepare("SELECT * FROM funcionario");		
		$statement->execute();

		//linhas recebe todas as tuplas retornadas do banco		
		$linhas = $statement->fetchAll();
		
		//Verifico se houve algum retorno, senão retorno null
		if(count($linhas)==0)
				return null;

		//Var que irá armazenar um array de obj do tipo funcionário
		$funcionarios;		
		
		foreach ($linhas as $value) {
            $funcionario = new ModelFuncionario();
            $deptoDAO = new DepartamentoDAO();
            
            $funcionario->setFuncionarioFromDataBase($value);
            $funcionario->setTipoPermissao($this->getTipoPermissaobyId($funcionario->getIdPermissao()));
            $funcionario->setNomeDepartamento($deptoDAO->getNameById($funcionario->getIdDepartamento()));
            
            if($funcionario->getAtivo() == 1){
                $funcionarios[]=$funcionario;
            }
		}	
		return $funcionarios;		
    }
    
    function getFuncionarioDAOById($id){
        try{
            $sql = "SELECT * FROM funcionario WHERE idFuncionario = :idFuncionario";

            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            $statement = $conn->prepare($sql);
            
            $statement->bindValue(":idFuncionario",$id);
            $statement->execute();

            $funcionario = $statement->fetch();
            return $funcionario;
            
        }catch (PDOException $e) {
            echo "Erro ao recuperar o funcionario na base de dados.".$e->getMessage();
        }	
    }
	//Retorna 1 se conseguiu inserir;
	function setFuncionario($func){			

		try {
			//monto a query
            $sql = "INSERT INTO funcionario (		
                idFuncionario,
                nome,
                salario,
                login,
                senha,
                idPermissao,
                idDepartamento) 
                VALUES (
                :idFuncionario,
                :nome,
                :salario,
                :login,
                :senha,
                :idPermissao,
                :idDepartamento)"
        	;

            //pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);

            $statement->bindValue(":idFuncionario", $func->getIdFuncionario());
            $statement->bindValue(":nome", $func->getNome());
            $statement->bindValue(":salario", $func->getSalario());
            $statement->bindValue(":login", $func->getLogin());
            $statement->bindValue(":senha", $func->getSenha());
            $statement->bindValue(":idPermissao", $func->getIdPermissao());
            $statement->bindValue(":idDepartamento", $func->getIdDepartamento());
            return $statement->execute();

        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
        }		
	}

	function updateFuncionario($func){
		try {
			//monto a query
            $sql = "UPDATE funcionario		
                SET 
                idFuncionario = :idFuncionario,
                nome = :nome,
                salario = :salario,
                login =:login,
                senha = :senha,
                idPermissao = :idPermissao,
				idDepartamento = :idDepartamento
				WHERE idFuncionario = :idFunc"
        	;

            //pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);

            $statement->bindValue(":idFuncionario", $func->getIdFuncionario());
            $statement->bindValue(":nome", $func->getNome());
            $statement->bindValue(":salario", $func->getSalario());
            $statement->bindValue(":login", $func->getLogin());
            $statement->bindValue(":senha", $func->getSenha());
            $statement->bindValue(":idPermissao", $func->getIdPermissao());
			$statement->bindValue(":idDepartamento", $func->getIdDepartamento());
			$statement->bindValue(":idFunc", $func->getIdFuncionario());
            return $statement->execute();

        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
        }		
    }
    
    function deleteFuncionario($id){
        try{
            $sql = "UPDATE funcionario SET ativo = 0 WHERE idFuncionario = :idFuncionario";

            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            $statement = $conn->prepare($sql);
            
            $statement->bindValue(":idFuncionario",$id);
            $statement->execute();

            $funcionario = $statement->fetch();
            
        }catch (PDOException $e) {
            echo "Erro ao deletar o funcionario na base de dados.".$e->getMessage();
        }
    }

    function getTipoPermissaobyId($value){
        try{
            $sql = "SELECT tipo FROM permissao where id = :id";

            $instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			$statement = $conn->prepare($sql);

            $statement->bindValue(":id",$value);

            $statement->execute();

            $nome = $statement->fetchAll();
            
            if(count($nome) == 0)
                return null;
            
            foreach($nome as $value){

                return $value["tipo"];
            }
            
        } catch (PDOException $e) {
            echo "Erro ao recuperar o tipo de permissao na base de dados.".$e->getMessage();
        }	
    }

    function getIdDepartamentobyName($value){
        try{
            $sql = "SELECT id FROM departamento where nome = :nome";

            $instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			$statement = $conn->prepare($sql);

            $statement->bindValue(":nome",$value);

            $statement->execute();

            $nome = $statement->fetchAll();
            
            if(count($nome) == 0)
                return null;
            
            foreach($nome as $valor){
                return $valor["id"];
            }
            
        } catch (PDOException $e) {
            echo "Erro ao recuperar o tipo de permissao na base de dados.".$e->getMessage();
        }	
    }

    function getIdPermissaobyTipo($value){
        try{
            $sql = "SELECT id FROM permissao where tipo = :tipo";

            $instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			$statement = $conn->prepare($sql);

            $statement->bindValue(":tipo",$value);

            $statement->execute();

            $tipo = $statement->fetchAll();
            
            if(count($tipo) == 0)
                return null;
            
            foreach($tipo as $valor){
                return $valor["id"];
            }
            
        } catch (PDOException $e) {
            echo "Erro ao recuperar o tipo de permissao na base de dados.".$e->getMessage();
        }	
    }
    
}