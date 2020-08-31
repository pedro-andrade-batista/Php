<?php
$titulo="Exibir Funcionários";
include $_SESSION["root"].'includes/header.php';

?>
<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Funcionários	</h1>
			<table class="table table-striped">
			<?php 
				//$funcionarios foi criado no controller que chamou essa classe;
				echo "<tr>";
					echo "<th id='nome'>Nome</th>";
					echo "<th>Salário</th>";
					echo "<th>Login</th>";
					echo "<th>Permissão</th>";
					echo "<th id='departamento'>Departamento</th>";
					if($_SESSION["permissao"] == 1) // Para nao exibir os icones de edição ou de exclusao de funcionario
						echo "<th></th>";
				echo "</tr>";
				foreach ($funcionarios as $value) {
					//print_r($value);
					echo "<tr>";
						echo "<td>".$value->getNome()."</td>";
						echo "<td>".$value->getSalario()."</td>";
						echo "<td>".$value->getLogin()."</td>";
						echo "<td>".$value->getTipoPermissao()."</td>";
						echo "<td>".$value->getNomeDepartamento()."</td>";
						if($_SESSION["permissao"] == 1){
							echo "<td><a href=deleteFuncionario?id=".$value->getIdFuncionario()."><i class='fa fa-trash'></i></a></td>";
							echo "<td><a href=EditaFuncionario?id=".$value->getIdFuncionario()."><i class='fa fa-pencil'></i></a></td>";
						}

					echo "</tr>";
				}
			?>
			</table>
		</div>
	</div>	
</body>
<!-- add no footer -->
<?php 
	include $_SESSION["root"].'includes/footer.php';
	if(isset($_SESSION["flash"])){
		foreach ($_SESSION["flash"] as $key => $value) {
			unset($_SESSION["flash"][$key]);	
		}
	}?>
<!-- fim footer -->

<script>		


	$(document).ready(function () {
        $('.visualizarFuncionario').addClass('active');

		$("#nome").click(function(){
			console.log($("tbody td").text());
		})

    });
</script>