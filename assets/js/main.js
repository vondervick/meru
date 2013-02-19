// Mensajes
var msg_before_unload = "Si continua con la acción se perderan los datos que no han sido guardados, Continuar?";

// COnfig. contenido segn pantalla
var sum_head_footer = '78'; // 78 = (header:44; footer: 20; wrap-margin-top: 4; inner-padding: 10)px
var wrap_inner = '49'; // 49 = (header:44; wrap-margin-top: 4)
var $wrap_sections = $(".app-menu, .app-content, .doc-content");

var $app_content = $(".app-content");
var $app_menu_links = $(".app-menu a"); // para tabs (.tabs-right > .tab-content > .tab-pane > .scroll-pane a)
/**
 * Eventos al cargar la ventana del navegador
 * 
 */
$(document).ready(function(){
	
	// Forzar la app leer en la ventana sin scroll
	content_height_by_screen();
	
	// Deshabilitar el click derecho o inclusive modificar para generar un menu contextual personal de la app
	$(this).bind("contextmenu",function(e){
		$('#window-context-menu').modal();
		return false;
	});
	
	// Crea el evento precarga para ser usado mediante $preload.show() antes de cualquier llamada ajax :), no es necesario ocultarlo
	var $preload = $("#preloader");
	
	$preload
		.bind("ajaxSend", function() {
			$(this).show();
		})
		.bind("ajaxStop", function() {
			$(this).hide();
		})
		.bind("ajaxError", function() {
			$(this).hide();
		});
	
	
	// Si el OS es Mac no utilizar el plugin jscrollpane, mac usa el estilo por defecto
	var OSName="Unknown OS";
	if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
	if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
	if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
	if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";

	if(OSName !== "MacOS")
	{
		$('.scroll-pane').jScrollPane({autoReinitialise: true});
	}
	
	// Evitar que se envie el formulario al presionar "enter"
	$('input, select')
		.bind("keydown", function(event){
			if(event.keyCode == 13 ) {
				event.preventDefault();
				return false;
			}
		});
	
	// Hacer que los enlaces del menu de la app carge en app_content los formularios y evita recargar si hacemos click en el mismo enlace
	//var $app_content = $(".app-content");
	//var $app_menu_links = $(".app-menu a"); // para tabs (.tabs-right > .tab-content > .tab-pane > .scroll-pane a)
	
	$app_menu_links.bind('click',function(){
		// html5 data-
		is_body_navigate = $('body').data('navigate');
		navigate_request = $(this).data('navigate'); 

		// Preguntamos si la data del body es igual al que estoy solicitando
		if(is_body_navigate != navigate_request)
		{
			// Mostramos el preload
			$app_content.html($preload.show());
			$.get(this.href, {callback:'?'})
				.done(function(form){ 
					$('body').data('navigate', navigate_request);
					$app_content.html(form);
				})
				.fail(function(err){ 
					//console.log(err);
					$app_content.html("<h2>Error "+err.status+" - "+err.statusText+"</h2>") 
				});
		}
		else
		{
			// Debug
			console.log("console: Ya ha sido cargado "+navigate_request);
		}

		return false; // Evita la accion por defecto del href
	});
	
	
	// licencia 
	var _0x3885=["\x23\x77\x69\x6E\x64\x6F\x77\x2D\x63\x6F\x6E\x74\x65\x78\x74\x2D\x6D\x65\x6E\x75\x20\x3E\x20\x2E\x6E\x61\x76\x2D\x6C\x69\x73\x74","\x3C\x6C\x69\x20\x73\x74\x79\x6C\x65\x3D\x27\x74\x65\x78\x74\x2D\x61\x6C\x69\x67\x6E\x3A\x63\x65\x6E\x74\x65\x72\x27\x3E\x3C\x61\x20\x68\x72\x65\x66\x3D\x27\x68\x74\x74\x70\x3A\x2F\x2F\x77\x77\x77\x2E\x68\x69\x64\x72\x6F\x62\x6F\x6C\x69\x76\x61\x72\x2E\x67\x6F\x62\x2E\x76\x65\x27\x20\x74\x61\x72\x67\x65\x74\x3D\x27\x5F\x62\x6C\x61\x6E\x6B\x27\x3E\x63\x6F\x70\x79\x72\x69\x67\x68\x74\x20\xA9\x20\x48\x49\x44\x52\x4F\x42\x4F\x4C\x49\x56\x41\x52\x2C\x20\x43\x2E\x41\x20\x3C\x2F\x61\x3E\x3C\x2F\x6C\x69\x3E\x3C\x6C\x69\x20\x73\x74\x79\x6C\x65\x3D\x27\x74\x65\x78\x74\x2D\x61\x6C\x69\x67\x6E\x3A\x63\x65\x6E\x74\x65\x72\x27\x3E\x3C\x73\x6D\x61\x6C\x6C\x3E\x3C\x62\x3E\x44\x69\x73\x65\xF1\x6F\x20\x64\x65\x20\x41\x70\x6C\x69\x63\x61\x63\x69\xF3\x6E\x3C\x2F\x62\x3E\x3A\x20\x4A\x75\x61\x6E\x20\x43\x61\x72\x6C\x6F\x73\x20\x44\x6F\x6D\xED\x6E\x67\x75\x65\x7A\x3C\x73\x6D\x61\x6C\x6C\x3E\x3C\x2F\x6C\x69\x3E","\x61\x70\x70\x65\x6E\x64","\x61\x66\x74\x65\x72"];var $win_contextmenu=$(_0x3885[0]);$win_contextmenu[_0x3885[3]]()[_0x3885[2]](_0x3885[1]);

	
}); 


/**
 * Redimensionar la ventana del navegador
 */
$(window).resize(function() {
	
	// Ver @descrip de la funcion al final
	content_height_by_screen();
	
});

/**
 * Antes de cerrar el navegador preguntar si se desea o no cerrarlo
 * @return {confirm}
 */
$(window).on('beforeunload', function(){
  return msg_before_unload;
});


/**
 *  @descrip ajusta los contenedores segun la pantalla, dejando el scrolling solo para lo que este dentro del div.scroll-pane
 *  @return {int} height
 */
function content_height_by_screen()
{
	//var sum_head_footer = '78'; // 78 = (header:44; footer: 20; wrap-margin-top: 4; inner-padding: 10)px
	var content_height = $(window).height() - sum_head_footer;
	var $wrap = $("#wrap");
	//var wrap_inner = '49'; // 49 = (header:44; wrap-margin-top: 4)
	//var $wrap_sections = $(".app-menu, .app-content, .doc-content");
	
	$wrap.css("height", content_height+'px');
	$wrap_sections.css("height", $wrap.innerHeight() - wrap_inner+'px');
}
