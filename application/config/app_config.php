<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Variables de configuración para la aplicación
* 
*/
// Institucion
$config['company_short_name'] = "";
$config['company_long_name'] = "";
$config['company_address'] = "";
$config['company_com_rif'] = "J-0000000-0";
$config['company_gob_rif'] = "G-0000000-0";
// app_logo_brand : 24x24px
$config['company_logo_brand'] = "logo_brand_default_white.png";
// app_logo_medium : Horizontal( 140x80 px), cuadrado(60x60 px)
$config['company_logo_medium'] = "logo_brand_default_white.png"; 

// Aplicacion
$config['app_short_title'] = "MERU"; // Usada en mensajes o ventanas emergentes
$config['app_title'] = $config['app_short_title']." | Administrativo"; 
$config['app_copyright'] = "&copy; ".date("Y").$config['company_address']; 

/**
 * Librerias css 
 */
 $config['css_login'] = 'login.css';
 $config['css_main'] = 'main.css';

/**
 * Tipos de errores y mensajes 
 */ 
 // Mensaje de precarga unico usado por jquery ajaxSend function;
 $config['ajax_loader_message'] = "cargando contenido..."; 
 
 // Mensaje que se muestra al intentar acceder directamente por url a un view
 $config['is_not_direct_script'] = "No es posible acceder directamente a la pág. solicitada.";
	 
/* End of file config_meru_app.php */
/* Location: ./application/config/config_meru_app.php */