		<footer id="gtco-footer" class="gtco-section" role="contentinfo">
			<div class="gtco-container">
				<div class="row row-pb-md">
					<div class="col-md-7 gtco-widget gtco-footer-paragraph">
						<h3>Bateria de Sinestesia</h3>
						<p>Laboratório de Ciências Cognitivas e Psicolinguística</p>
						<p>Programa de Pós-graduação em Linguística</p>
						<p>Av. da Universidade, 2683 - Benfica, Fortaleza - CE, 60020-181, CH1</p>
						<p>Tel +55 85 3366 7627/ 3366 7333 | E-mail: brendasouza@letras.ufc.br</p>
						<p>Fortaleza-CE</p>
					</div>
					<!-- <div class="col-md-3 gtco-footer-link">
						<div class="row">
							<div class="col-md-12 gtco-footer-paragraph">
								<h3>Contato</h3>
								<p>
									<a href="tel://55 85986918696">+55 85 9 8691 8696</a> <br>
									<a href="#">brendasouza@letras.ufc.br</a>
								</p>
								<p>
									<a href="tel://55 85986918696">+55 85 3366 7627</a> <br>
								</p>
								<p>
									<a href="tel://33667333">+55 85 3366 7333</a>
								</p>
							</div>
						</div>
					</div> -->
					<div class="col-md-5 gtco-footer-paragraph">
						<h3>Apoio</h3>
						<div class="row">
							<div class="col-md-4">
								<img src="<?php echo URLBASE; ?>images/ufc.png" alt="UFC" title="Universidade Federal do Ceará">
							</div>
							<div class="col-md-6 text-right">
								<img src="<?php echo URLBASE; ?>images/cnpq-logo.png" style="width: 200px;" alt="CNPq" title="">
							</div>
						</div>
					</div>
					
					<!-- <div class="col-md-4 gtco-footer-subscribe">
						<form class="form-inline">
						  <div class="form-group">
						    <label class="sr-only" for="exampleInputEmail3">Email address</label>
						    <input type="email" class="form-control" id="" placeholder="Email">
						  </div>
						  <button type="submit" class="btn btn-primary">Send</button>
						</form>
					</div> -->
				</div>
			</div>
			<div class="gtco-copyright">
				<div class="gtco-container">
					<div class="row">
						<div class="col-md-6 text-left">
							<p><small>&copy; <?php echo date('Y'); ?> Todos os direitos resevados  </small></p>
						</div>
						<div class="col-md-6 text-right">
							<p><small>Designed by <a href="http://gettemplates.co/" target="_blank">GetTemplates.co</a> and Developer by <a href="http://luisrodriguesdev.com.br" target="_blank">Luis Rodrigues</a></p>
						</div>
					</div>
				</div>
			</div>
		</footer>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="<?php echo URLBASE; ?>js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="<?php echo URLBASE; ?>js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo URLBASE; ?>js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="<?php echo URLBASE; ?>js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="<?php echo URLBASE; ?>js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="<?php echo URLBASE; ?>js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo URLBASE; ?>js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="<?php echo URLBASE; ?>js/main.js"></script>
	<?php 
		if (isset($url[0]) && $url[0] == 'teste' && isset($url[1]) && $url[1] == 'start') {
	?>
	<script type="text/javascript" src="<?php echo URL_PAINEL; ?>js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="<?php echo URL_PAINEL; ?>js/bootstrap-colorpicker.js"></script>
	<script type="text/javascript" src="<?php echo URL_PAINEL; ?>js/functions.js"></script>

	<?php
		}
	?>
	
	</body>
</html>

