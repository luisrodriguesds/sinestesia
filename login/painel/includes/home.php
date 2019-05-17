<?php 
	if (isset($_POST['continuar'])) {
		if (empty(GetPost('nome')) || empty(GetPost('email'))) {
			load(URL_PAINEL.'termo');
		}else{
			load(URL_PAINEL.'termo');
		}
	}
?>
<div class="row">
	<div class="col-md-6 center-block p">
		<p>
			Você gostaria de compartilhar seus resultados com um pesquisador?
		</p>
		<p>
				Se você estiver participando de algum teste específico, 
				digite o nome e o email do pesquisador que o direcionou até este site. 
				Caso contrário, deixe as barras de resposta em branco e clique em continuar.
		</p>
		<form method="post">
			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="nome" class="form-control" value="<?php echo GetPost('nome'); ?>" name="nome" id="nome">	
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" value="<?php echo GetPost('email'); ?>" name="email" id="email">
			</div>
			<div class="form-group text-right">
				<input type="submit" class="btn btn btn-special" name="continuar" value="Continuar">
			</div>
		</form>
	</div>
</div>