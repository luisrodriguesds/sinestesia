<?php 
	if (isset($_POST['continuar'])) {
		if (empty(GetPost('aceitar'))) {
			alerta("Você precisa marcar que leu e aceita os termos para continuar");
		}else{
			load(URL_PAINEL.'dados');
		}
	}
?>

<div class="row">
	<div class="col-md-6 center-block p">
		<h2>Termo de Consentimento Livre e Esclarecido </h2>
		<p>Você está sendo convidado a participar de um questionário e de alguns testes on-line para sinestesia. Sua decisão de participar é voluntária e você pode se recusar a participar, ou escolher parar de participar, a qualquer momento durante o teste. Você pode se recusar a responder a qualquer pergunta. Em outro momento, podemos entrar em contato com certas pessoas para participar de outros estudos, mas a participação continua sendo totalmente voluntária. Qualquer informação pessoal coletada durante este estudo permanecerá estritamente confidencial; nossos bancos de dados de computador são protegidos por senha e mantidos em um servidor seguro. Seu endereço de e-mail é mantido em sigilo e nunca é compartilhado sem qualquer parte externa (a menos que o primeiro dê permissão por escrito). Todos os resultados serão publicados de maneira estatística, sem informações de identificação pessoal. Você não será pessoalmente identificado em nenhum relatório de publicações que resultem deste estudo. Apenas dados anônimos podem ser disponibilizados a pedido de outros pesquisadores. Na conclusão do teste, você será informado da sua pontuação e se essa pontuação indica que você é sinestésico. Quando você terminar o teste, seus resultados entrarão em nosso banco de dados seguro. Por favor, sinta-se à vontade para nos enviar um e-mail [brendasouza@letras.ufc.br] antes de consentir se você tiver alguma dúvida.Você não recebe nenhum benefício direto por estar neste estudo, no entanto este trabalho nos ajudará a entender melhor a condição da sinestesia. Você deve ter 18 anos ou ter uma autorização de um responsável para participar deste estudo. Você pode indicar seu consentimento clicando no botão Continuar e poderá imprimir uma cópia dessas informações para seus registros.</p>
		<div class="row">
			
		<form method="post">
			<div class="form-group">
				<p><input type="checkbox" name="aceitar"  class=""> Marcar esta caixa indica que você leu a carta de informação acima, que suas perguntas foram respondidas de maneira satisfatória e que você voluntariamente concorda em participar deste estudo de pesquisa.</p>
			</div>
			<div class="form-group text-right">
				<input type="submit" class="btn btn btn-special" name="continuar" value="Continuar">
			</div>
		</form>
			
	</div>
</div>