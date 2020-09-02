<?php 
$titulo="Edita Funcionario";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container" >
	<?php include $_SESSION["root"].'includes/menu.php';?>
		<div id="principal" >
        <h1 class="text-center">Edição de Funcionário</h1>
        <form action="postEditaFuncionario" method="POST">
				<div class="row">
					<?php if(isset($_SESSION["flash"]["msg"])){
							if($_SESSION["flash"]["sucesso"]==false)
								echo"<div class='bg-danger text-center msg'>".$_SESSION["flash"]["msg"]."</div>";
							else{
								echo"<div class='bg-success text-center msg'>".$_SESSION["flash"]["msg"]."</div>";
							}
						} ?>
					<div class="col-md-6">
						<div class="form-group">
							<label for="email">Login:<span class="requerido">*</span></label>
							<input type="login" name="login" class="form-control" id="login" 
								value="<?php if(isset($_SESSION["flash"]["login"]))echo $_SESSION["flash"]["login"];?>">
						</div>
						<div class="form-group">
							<label for="pwd">Senha:<span class="requerido">*</span></label>
							<input type="password" name="senha" class="form-control" id="pwd" value="">
						</div>
						
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="nome">Nome:<span class="requerido">*</span></label>
							<input type="text" name="nome" class="form-control" id="nome" value="<?php if(isset($_SESSION["flash"]["nome"]))echo $_SESSION["flash"]["nome"];?>">
						</div>	
						<div class="form-group">
							<label for="salario">Salario:<span class="requerido">*</span></label>
							<input type="text" name="salario" class="form-control" id="salario" value="<?php if(isset($_SESSION["flash"]["salario"]))echo $_SESSION["flash"]["salario"];?>">
						</div>						
					</div>
					
					<div class="col-md-6">
							<div class="form-group">
								<label for="permissao">Permissão:<span class="requerido">*</span></label>
								<select type="text" name="permissao" class="form-control" id="permissao" >
									<?php foreach($permissoes as $value): ?>
									<option >
										<?=$value->tipo ?>
									</option>
									<?php endforeach;?>
								</select>
									
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="departamento">Departamento:<span class="requerido">*</span></label>
								<select type="text" name="departamento" class="form-control" id="departamento">
									<?php foreach($departamentos as $values) :?>
									<option>
										<?=$values->nome?>
									</option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
					</div>
			  <button type="submit" class="btn btn-default center-block">Submit</button>
			</form>
		</div>
	</div>	
<?php 
	include $_SESSION["root"].'includes/footer.php';
	if(isset($_SESSION["flash"])){
		foreach ($_SESSION["flash"] as $key => $value) {
			unset($_SESSION["flash"][$key]);	
		}
	}
	
?>
