<?php

include_once $_SESSION["root"].'php/DAO/FuncionarioDAO.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';
include_once $_SESSION["root"].'php/DAO/PermissaoDAO.php';

class ControllerFuncionario {
	function getAllFuncionarios(){
		$funcDAO = new FuncionarioDAO();
		$funcionarios=$funcDAO->getAllFuncionarios();
		
		include_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';
	}
	function setFuncionario(){
		$funcDAO = new FuncionarioDAO();
		$funcionario = new ModelFuncionario();
		$funcionario->setFuncionarioFromPOST();
		$funcionario->setIdDepartamento($funcDAO->getIdDepartamentobyName($_POST["departamento"]));
		$funcionario->setIdPermissao($funcDAO->getIdPermissaobyTipo($_POST["permissao"]));

		
		$resultadoInsercao = $funcDAO->setFuncionario($funcionario);
			
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Funcionário Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;
			
		}
		else{
			$_SESSION["flash"]["msg"]="O Login já existe no banco";
			$_SESSION["flash"]["sucesso"]=false;
			//Var temp de feedback	
			$_SESSION["flash"]["nome"]=$funcionario->getNome();
			$_SESSION["flash"]["login"]=$funcionario->getLogin();
			$_SESSION["flash"]["salario"]=$funcionario->getSalario();
		}
		//header("Location:cadastraFuncionario");
		//include_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
		$this->getDepartamentos();
	}
	function updateFuncionario($func){
		$funcDAO = new FuncionarioDAO();
		$deptoDAO = new DepartamentoDAO();
		$permDAO = new PermissaoDAO();
		$funcionario = new ModelFuncionario();
		$funcionario->updateFuncionarioFromPOST($func);

		$funcionario->setIdDepartamento($deptoDAO->getIdByName($_POST["departamento"]));
		$funcionario->setIdPermissao($permDAO->getIdByType($_POST["permissao"]));


		if(empty($_POST["senha"])){
			$funcionario->setSenha($func["senha"]);
		}

		$resultadoInsercao = $funcDAO->updateFuncionario($funcionario);

		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Funcionário Atualizado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;

		}
		else{
			echo "nao deu certo";
		}
	}

	function getFuncionarioById($id){
		$funcDAO = new FuncionarioDAO();
		$deptoDAO = new DepartamentoDAO();
		$permDAO = new PermissaoDAO();
		
		$funcRetornado = $funcDAO->getFuncionarioDAOById($id);
		
		//Criado para não exibir os id's na view e sim o nome de cada deportamento e permissao
		$funcRetornado["nomeDepartamento"] = $deptoDAO->getNameById($funcRetornado["idDepartamento"]);
		$funcRetornado["tipoPermissao"] = $permDAO->getTipoById($funcRetornado["idPermissao"]);

		


		$_SESSION["flash"]["nome"]=$funcRetornado["nome"];
		$_SESSION["flash"]["login"]=$funcRetornado["login"];
		$_SESSION["flash"]["salario"]=$funcRetornado["salario"];
		$_SESSION["flash"]["senha"]=$funcRetornado["senha"];
		$_SESSION["flash"]["permissao"]=$funcRetornado["tipoPermissao"];
		$_SESSION["flash"]["departamento"]=$funcRetornado["nomeDepartamento"];
		
		return $funcRetornado;
	}

	function getDataForView($value){
		$deptoDAO = new DepartamentoDAO();
		$permDAO = new PermissaoDAO();
		$permissoes = $permDAO->getAllPermissao();
		$departamentos=$deptoDAO->getAllDepartamentos();
		//print_r($departamentos);
		
		if($value == "cadastro")
			require_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
		else if($value == "editar")
		require_once $_SESSION["root"].'php/View/ViewEditaFuncionario.php';
	}

}



?>