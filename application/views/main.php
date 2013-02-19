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
	<?php echo link_tag('assets/core/scroller/css/jquery.jscrollpane.css'); ?>
	<?php echo link_tag('assets/core/scroller/themes/light/css/jquery.jscrollpane.lozenge.css'); ?>
	<?php echo link_tag('assets/main.css'); ?>
	<?php echo link_tag('assets/core/bootstrap/css/bootstrap-responsive.min.css'); // Siempre debe ir de ultimo ?>
</head>
<body data-role="page-main">
	
	
	<div class="visible-desktop">
		<!-- Menu navegacion -->
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
 
					<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
 
					<!-- Be sure to leave the brand out there if you want it shown -->
					<a class="brand" href="#">
						<?php echo img(array(
							'src'=>"assets/images/{company_logo_brand}",
							'width'=>'24px',
							'height'=>'24px'
						))?> {app_title}
					</a>

					<!-- user info -->
					<div class="pull-right">
						<ul class="nav pull-right">
						    <li class="dropdown">
								<!-- Boton usuario -->
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-user icon-white"></i> 
									Bienvenido, {sess_user}
									<b class="caret"></b>
								</a>
								<!-- submenu -->
						        <ul class="dropdown-menu">
						            <li>
										<a data-toggle="modal" data-target="#app-user-config">
											<i class="icon-cog"></i> 
											Configuración
										</a>
									</li>
					           
								    <li class="divider"></li>
					           
								    <li>
										<a href="<?php echo base_url().'auth/users/logout' ?>">
											<i class="icon-off"></i> 
											Cerrar Sesión
										</a>
									</li>
						        </ul><!-- // end .dorpdown-menu -->
						    </li><!-- // end .dropdown -->
						</ul><!-- // end nav pull-right -->
					</div><!-- // end pull-right-->
				
				</div><!-- // end container fluid -->
			</div><!-- // ennd navbar inner -->
		</div><!-- // end navbar -->
	
	
		<!-- Contenido-->
		<div id="wrap" class="container-fluid">
			<div class="row-fluid">
			
				<div class="tabbable">
				
					<!-- PestaNnas -->
					<ul class="nav nav-tabs">
					  <li>
						  <a data-toggle="tab" href="#manuales">
							  <i class="icon-book"></i>
						  </a>
					  </li>
					  <li class="active">
						  <a data-toggle="tab" href="#app">
							  <i class="icon-list"></i>
						  </a>
					  </li>
					</ul>
			
					<!-- Contenido Tabs -->
					<div class="tab-content">
						<div class="tab-pane" id="manuales">
							<div class="span12 doc-content">
								<div class="scroll-pane">
									{doc_content}
								</div>
							</div>
						</div> <!-- end tab manuales -->
			
						<div class="tab-pane active" id="app">
							<div class="span9 app-content">
								<div class="scroll-pane">
									{app_content}
								</div>
							</div>
							<div class="span3 app-menu">
								<div class="scroll-pane">
									{app_menu}
								</div>
							</div>
						</div> 
					</div><!-- // end tab-content -->
				
				</div><!-- // end tabbable -->
			</div><!-- // end row-fluid -->
		</div><!-- // end wrap -->
	
		<!-- Footer -->
	    <div id="footer">
	      <div class="container-fluid">
			  <div class="row-fluid">
				  <div class="span9">
					  <p class="muted credit">{app_copyright} | RIF {company_com_rif}</p>
				  </div>
				  <div class="span3">
				  	<p class="muted credit pull-right"><i class="icon-eye-open"></i> Última actividad {sess_last_activity}</p>
				  </div>
			  </div>
	      </div>
	    </div> 
	
		<!-- // Modals --> 
		<?php $this->load->view('main/config_modals', array('fiscal_year'=>$app_fiscal_year)) ?> 
		<!-- End Sectoin Modal -->
	
		<!-- Precarga -->
		<div id="preloader" style="display:none;">
		  <p>
			  <?php echo img('assets/images/loading.gif')?>  {ajax_loader_message}
		  </p>
		</div>
	</div>
	
	<!-- Mensaje cuando la resolucion es muy pequena -->
	<div class="hidden-desktop">
		<div class="alert alert-block">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <h4>Atención!</h4>
		  {app_title}, está diseñado para ambiente de escritorio con resolución mínima de 1024px, 
		  este mensaje puede ser debido a varias causas:
		  <br /><br />
		  <ol>
		  	<li>Ud. ha cambiado el tamaño de la ventana a una menor de la optimizada.</li>
		  	<li>Ud. está accesando desde un dispositivo móvil.</li>
		  </ol>
		</div>
	</div>
	
	
	<!-- Footer : de esta forma se carga mucho mas rapido la pagina -->
	<?php echo script_tag('assets/core/jquery-1.8.2.min.js')?>
	<?php echo script_tag('assets/core/bootstrap/js/bootstrap.min.js')?>
	<?php echo script_tag('assets/core/scroller/js/jquery.jscrollpane.min.js')?>
	<?php echo script_tag('assets/core/scroller/js/jquery.mousewheel.js')?>
	<?php echo script_tag('assets/core/scroller/js/mwheelIntent.js')?>
	<?php echo script_tag('assets/js/main.js')?>
</body>
</html>
<?php
// Almacena el bufer para usarlo y deshabilitarlo luego
ob_end_flush(); 

// Elimina los espacios en blanco
function comprimir_pagina($buffer) { 
    $busca = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'); 
    $reemplaza = array('>','<','\\1'); 
    return preg_replace($busca, $reemplaza, $buffer); 
} 
?>