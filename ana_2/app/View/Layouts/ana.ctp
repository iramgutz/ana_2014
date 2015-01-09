<!DOCTYPE html>
<html lang="en" ng-app="ana">

<head>

	<meta charset="UTF-8">
	
	<title>Bienvenidos al Micrositio de ANA Seguros</title>

	<?php 

		echo $this->Html->css(
			[
				'reset',
				'bootstrap', 
				'bootstrap-responsive'
			]
		);

	?>

	<link rel="stylesheet" type="text/css" href="<?php echo $this->Html->url('/' , true); ?>/css/{{ $root.css_name }}.css" />

	<?php 

		echo $this->Html->script(
			[
				'//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
				'bootstrap', 
				'bootstrap.min',
				'https://code.angularjs.org/1.3.6/angular.min.js',
				'https://code.angularjs.org/1.2.27/angular-route.min.js',
				'app.js',
				'app.controllers.js',
				'app.filters.js',
				'app.services.js'
			]
		);

	?>

</head>

<body class="{{ $root.class_body }}">

	<iframe frameborder="0" src="http://pix.headwaydigital.com/pixels/233109/1217093.html">
	</iframe>

	<div class="container-fluid area">
		<div class="row-fluid">
			<div class="span12 flash">
			</div>
		</div>		
		<img src="images/slogan.jpg" 
		alt="Con Ana seguros,estas en buenas manos" class="slogan">

		<div class="row-fluid aire"  ng-view >

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>

		</div>

		<div class="row-fluid aire">
			<div class="span4 verde  aire">
				<p class="red-text exeption"> Protégete hoy mismo</p>
				<h1 class="exeption">Teléfono: 5322 8200 EXT 8367 y 8368 
				</h1>
			</div>
			<div class="span4 verde  aire">
				<p class="red-text">Beneficios</p>
				<h1>ANA Seguros protege tu coche y a todas
					las persona que viajan en el.
					Con ANA Seguros tenemos opciones
					para que no pagues deducible.
					ANA Seguros te asesora y protege
					contra abusos indebidos.
				</h1>
			</div>
			<div class="span4 verde aire">
				<p class="red-text">ANA Asistencia</p>
				<h1>Todas nuestras pólizas incluyen apoyo de:
					Servicio de Grua
					Cambio de llanta
					Pasar corriente
					Envío de gasolina, cerrajero
					o refacciones 
				</h1>
			</div>
		</div>
	</div>
	<div class="aire">
		<p class="center">
			Estrategia de Marketing Integral para ANA Seguros diseñada, implementada y operada por
			<a target="_blank" href="http://www.clicker360.com">clicker360</a>
		</p>
		<p class="center">
			<a target="_blank" href="">Aviso de privacidad</a>
		</p>
	</div>
</body>
</html>
<?php echo $this->element('sql_dump'); ?>