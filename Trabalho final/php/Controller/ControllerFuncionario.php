<?php

include_once $_SESSION["root"].'php/DAO/FuncionarioDAO.php';
include_once $_SESSION["root"].'php/Model/ModelFuncionario.php';

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
		include_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
	}
	function updateFuncionario($func){
		$funcDAO = new FuncionarioDAO();
		$funcionario = new ModelFuncionario();
		$funcionario->updateFuncionarioFromPOST($func);


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
		$funcRetornado = $funcDAO->getFuncionarioDAOById($id);
		/*
		echo "<pre>";
		print_r ($funcRetornado);
		echo "</pre>";
		*/
		$_SESSION["flash"]["nome"]=$funcRetornado["nome"];
		$_SESSION["flash"]["login"]=$funcRetornado["login"];
		$_SESSION["flash"]["salario"]=$funcRetornado["salario"];
		$_SESSION["flash"]["senha"]=$funcRetornado["senha"];
		$_SESSION["flash"]["permissao"]=$funcRetornado["idPermissao"];
		$_SESSION["flash"]["departamento"]=$funcRetornado["idDepartamento"];
		return $funcRetornado;
	}

	function getDepartamentos(){
		$deptoDAO = new DepartamentoDAO();		
		$departamentos=$deptoDAO->getAllDepartamentos();
		//print_r($departamentos);
		
		require_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
	}

}



?>