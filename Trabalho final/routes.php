<?php
/*
Esse script funciona como um front controller, todas as requisições passam primeiro por aqui, também podemos enxergar como um gateway padrão. Isso só é possível graças ao htaccess que faz com que o todas as requisições feitas sejam redirecionadas para cá.
Da forma como esse arquivo de rotas funciona, nós não fazemos “links” para arquivos, nós associamos uma url a um controller.
****Descomentar os print_r abaixo para entender melhor****
*/

//Path é um array onde cada posição é um elemento da URL
$path = explode('/', $_SERVER['REQUEST_URI']);

//Action é a posição do array
$action = $path[sizeOf($path) - 1];
//Caso a ação tenha param GET esse param é ignorado, isso é particularmente útil para trabalhar com AJAX, já que o conteúdo do get será útil apenas para o controller e não para a rota
$action = explode('?', $action);
$action = $action[0];

//Descomentar esse bloco e acessar qualquer url do sistema.
/*echo "<pre>";
echo "A URL digitada<br>";
print_r($_SERVER['REQUEST_URI']);
echo "<br><br>A URL digitada explodida por / e tranformada em um array<br>";
print_r($path);
echo "<br><br>A ultima posição do array, que é a ação que o usuário/sistema quer realizar, é essa ação(string) que é mapeada(roteada) a um método de um controller<br>";
print_r($action);
echo "</pre>";*/
//Todo controller que tiver pelo menos uma rota associada a ele deve aparecer aqui.
include_once $_SESSION["root"].'php/Controller/ControllerLogin.php';
include_once $_SESSION["root"].'php/Controller/ControllerFuncionario.php';
include_once $_SESSION["root"].'php/Controller/ControllerDepartamento.php';


//debug($_SESSION);

//Sequencia de condicionais que verificam se a ação informada está roteada
if ($action == '' || $action == 'index' || $action == 'index.php' || $action == 'login') {
	require_once $_SESSION["root"].'php/View/ViewLogin.php';
}
else if ($action == 'logout') {
	unset($_SESSION["logado"]);
	unset($_SESSION["nomeLogado"]);
	require_once $_SESSION["root"].'php/View/ViewLogin.php';
}
else if ($action == 'postLogin') {
	$cLogin = new ControllerLogin();
	$cLogin->verificaLogin();
}
else if(isset($_SESSION["logado"]) && $_SESSION["logado"]==true){
	if ($action == 'exibeFuncionarios') {
		$cFunc = new ControllerFuncionario();
		$cFunc->getAllFuncionarios();
	}
	else if ($action == 'cadastraFuncionario' && $_SESSION["permissao"] == 1) {
		$cFunc = new ControllerFuncionario();
		$cFunc->getDepartamentos();
	}
	else if ($action == 'postCadastraFuncionario' && $_SESSION["permissao"] == 1) {
		$cFunc = new ControllerFuncionario();
		$cFunc->setFuncionario();
	}
	else if($action == 'exibeDepartamento'){
		$cDepto = new ControllerDepartamento();
		$cDepto->getAllDepartamentos();
	}
	else if($action == 'cadastrarDepartamento' && $_SESSION["permissao"] == 1){
		$cDepto = new ControllerDepartamento();
		require_once $_SESSION["root"].'php/View/ViewCadastrarDepartamento.php';
	}
	else if($action == 'postCadastrarDepartamento' && $_SESSION["permissao"] == 1){
		$cDepto = new ControllerDepartamento();
		$cDepto->setDepartamento(); 
	}
	else if($action == 'EditaFuncionario' && $_SESSION["permissao"] == 1){
		$cFunc = new ControllerFuncionario();
		$_SESSION["funcionario"] = $cFunc->getFuncionarioById($_GET["id"]);
		require_once $_SESSION["root"].'php/View/ViewEditaFuncionario.php';
	}
	else if($action == 'postEditaFuncionario' && $_SESSION["permissao"] == 1){
		$cFunc = new ControllerFuncionario();
		$cFunc->updateFuncionario($_SESSION["funcionario"]);
		$cFunc->getAllFuncionarios();
		
	}
	else if($action == "deleteFuncionario" && $_SESSION["permissao"] == 1){
		require_once $_SESSION["root"].'php/util/deleteFuncionario.php';
	}
}
else {
	echo "Página não encontrada!!!";
	//isso trata todo erro 404, podemos criar uma view mais elegante para exibir o aviso ao usuário.
}

?>