<?php 
	if (isset($_POST['continuar'])) {
		if (empty(GetPost('aceitar'))) {
			alerta("Você precisa marcar que leu e aceita os termos para continuar");
		}else{
			load(URL_PAINEL.'dados');
		}
	}
	$termo = DBread('termo_compromisso');

?>

<div class="row">
	<div class="col-md-7 center-block p">
		<h2><?php echo $termo[0]['titulo']; ?> </h2>
		<p style="text-align: justify;"><?php echo $termo[0]['descricao']; ?></p>
		<div class="row">
			
		<form method="post">
			<div class="form-group">
				<p style="text-align: justify;"><input type="checkbox" name="aceitar"  class=""> Marcar esta caixa indica que você leu a carta de informação acima, que suas perguntas foram respondidas de maneira satisfatória e que você voluntariamente concorda em participar deste estudo de pesquisa.</p>
			</div>
			<div class="form-group text-right">
				<input type="submit" class="btn btn-primary btn-color" name="continuar" value="Continuar">
			</div>
		</form>
			
	</div>
</div>