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
					echo "<th id='salario'>Salário</th>";
					echo "<th id='login'>Login</th>";
					echo "<th id='permissao'>Permissão</th>";
					echo "<th id='departamento'>Departamento</th>";
					if($_SESSION["permissao"] == 1) // Para nao exibir os icones de edição ou de exclusao de funcionario
						echo "<th></th>";
				echo "</tr>";
				foreach ($funcionarios as $value) {
					//print_r($value);
					echo "<tr>";
						echo "<td class='nome'>".$value->getNome()."</td>";
						echo "<td class='salario'>".$value->getSalario()."</td>";
						echo "<td class='login'>".$value->getLogin()."</td>";
						echo "<td class='permissao'>".$value->getTipoPermissao()."</td>";
						echo "<td class='departamento'>".$value->getNomeDepartamento()."</td>";
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

		$("#nome").click(function(e){
			sortTable(e.target.innerText,0);
		})

		$("#salario").click(function(e){
			sortTable(e.target.innerText,1);
		})

		$("#login").click(function(e){
			sortTable(e.target.innerText,2);
		})

		$("#permissao").click(function(e){
			sortTable(e.target.innerText,3);
		})

		$("#departamento").click(function(e){
			sortTable(e.target.innerText,4);
		})

    });

	function sortTable(id,child){
		let valores = []
		id = id.normalize("NFD").replace(/[^a-zA-Zs]/g, "").toLowerCase() //retira os caracteres especiais e coloca em caixa baixa
		for(var i = 0; i < $("."+id).length;i++){
			valores.push($("."+id)[i].innerText)
		}
		valores.sort()

		let ordenado = []
		for(var i = 0; i < $("."+id).length;i++){
			for(var j = 0; j < $("tr").length;j++){
				if($("tr")[j].childNodes[child].innerText == valores[i]){
					ordenado.push($("tr")[j]);
				}
			}
		}
		for(var i = 0;i < ordenado.length;i++){
			$(ordenado[i]).remove()
			$("tbody").append(ordenado[i])
			
		}
	}
</script>