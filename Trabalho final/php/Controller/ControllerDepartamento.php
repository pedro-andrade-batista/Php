<?php
include_once $_SESSION["root"].'php/DAO/DepartamentoDAO.php';
include_once $_SESSION["root"].'php/Model/ModelDepartamento.php';

class ControllerDepartamento{
    function getAllDepartamentos(){
		$deptoDAO = new DepartamentoDAO();
		$departamentos= $deptoDAO->getAllDepartamentos();
		include_once $_SESSION["root"].'php/View/ViewExibeDepartamento.php';
    }
    function setDepartamento(){
		$deptoDAO = new DepartamentoDAO();
		$departamento = new ModelDepartamento();
		$departamento->setDepartamentoFromPOST();
		$resultadoInsercao = $deptoDAO->setDepartamento($departamento);
			
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Departamento Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;			
		}
		else{
			$_SESSION["flash"]["msg"]="O id do departamento já existe no banco";
			$_SESSION["flash"]["sucesso"]=false;
			//Var temp de feedback	
			$_SESSION["flash"]["nome"]=$departamento->getNome();
			$_SESSION["flash"]["id"]=$departamento->getId();
		}
		include_once $_SESSION["root"].'php/View/ViewCadastrarDepartamento.php';
	}
}


?>