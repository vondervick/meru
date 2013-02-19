<?php ob_start('comprimir_pagina') ?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1">
    <!-- Ajuste el ancho de la vista para la anchura del dispositivo para móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{app_title}</title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php echo link_tag('assets/images/favicon.ico', 'shortcut icon', 'image/x-icon'); ?>
    <?php echo link_tag('assets/core/bootstrap/css/bootstrap.min.css'); ?>
    <?php echo link_tag('assets/login.css'); ?>
    <?php echo link_tag('assets/core/bootstrap/css/bootstrap-responsive.min.css'); ?>
</head>
<body id="login">
	
	<!-- Formulario acceso -->
	<div class="container">
		<?php echo form_open('auth/users/validate', array('class'=>'form-login') ); ?>
			<h1>
				<?php echo img(array(
					'src'=>"assets/images/{company_logo_medium}",
					'alt'=>"{app_title}",
					'width'=>'140px',
					'height'=>'80px'
				))?>
				<span class="app-descrip">{app_title}</span>
			</h1>
			<?php  if(validation_errors()) echo '<div class="alert alert-error">'.validation_errors().'</div>'; ?>
			<input type="text" class="input-block-level" name="user_name" placeholder="Usuario de Sistema" required>
			<input type="password" class="input-block-level" name="user_pass" placeholder="Contraseña" required>
			<div class="align-center">
				<button type="submit" class="btn btn-large btn-info" name="login" id="login">
					Acceder <i class="icon-chevron-right icon-white"></i>
				</button>
			</div>
		<?php echo form_close(); ?>
	</div>
	
	<!-- Footer -->
    <div class="form-login-footer">
      <div class="container">
        <p>{app_copyright} | RIF {company_com_rif}</p>
      </div>
    </div>
    <script src="<?php echo base_url() ?>assets/core/jquery-1.8.2.min.js"></script>
</body>
</html>
<?php
// Una vez que el búfer almacena nuestro contenido utilizamos "ob_end_flush" para usarlo y deshabilitar el búfer
ob_end_flush(); 
// Función para eliminar todos los espacios en blanco
function comprimir_pagina($buffer) { 
    $busca = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'); 
    $reemplaza = array('>','<','\\1'); 
    return preg_replace($busca, $reemplaza, $buffer); 
} 
?>