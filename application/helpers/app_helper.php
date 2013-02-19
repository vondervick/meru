<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Genera la inclusion de los archivos javascript
 * Basado en el original link_tag de codeigniter
 * 
 * Author(s): Juan Carlos Dominguez
 * 
 * @access   public
 * @param    {mixed}    javascript sources or an array
 * @param    {string}    language
 * @param    {string}    type
 * @param    {boolean}   should index_page be added to the javascript path 
 * @return   {string}
 */    
 if ( ! function_exists('script_tag'))
 {
     function script_tag($src = '', $language = 'javascript', $type = 'text/javascript', $index_page = FALSE)
     {
         $CI =& get_instance();

         $script = '<script ';
        
         if(is_array($src))
         {
             foreach($src as $v)
             {
                 if ($k == 'src' AND strpos($v, '://') === FALSE)
                 {
                     if ($index_page === TRUE)
                     {
                         $script .= ' src="'.$CI->config->site_url($v).'"';
                     }
                     else
                     {
                         $script .= ' src="'.$CI->config->slash_item('base_url').$v.'"';
                     }
                 }
                 else
                 {
                     $script .= "$k=\"$v\"";
                 }
             }
            
             $script .= ">\n";
         }
         else
         {
             if ( strpos($src, '://') !== FALSE)
             {
                 $script .= ' src="'.$src.'" ';
             }
             elseif ($index_page === TRUE)
             {
                 $script .= ' src="'.$CI->config->site_url($src).'" ';
             }
             else
             {
                 $script .= ' src="'.$CI->config->slash_item('base_url').$src.'" ';
             }
                
             $script .= 'language="'.$language.'" type="'.$type.'"';
            
             $script .= '>'."\n";
         }

        
         $script .= '</script>';
        
         return $script;
     }
 }

/**
 *
 * Crea un campo de fecha sencillo
 * 
 * Author(s): Juan Carlos Dominguez
 * 
 * @access   public
 * @param    {string}    nombre
 * @param    {string}    fecha actual
 * @param    {datetime}    formato 
 * @return   {string}
 */    
if ( ! function_exists('date_single') )
{
	//$dt = date('dd/mm/yyyy');
    function date_single($name = '', $data_date = '', $data_date_format = 'dd/mm/yyyy')
    {
        $CI =& get_instance();
		$input = '<div class="input-append date date-picker" data-date="'.$data_date.'" data-date-format="'.$data_date_format.'">';
	  	$input.= '<input type="text" name="'.$name.'"><span class="add-on"><i class="icon-th"></i></span></div>';
		return $input;
	}   
}

/**
 *
 * convierte una cadena a slug o permalink (Esto Cadena -> esto-cadena )
 * 
 * Author(s) url: http://code.seebz.net/p/to-permalink/
 * 
 * @access   public
 * @param    {string}    cadena a convertir
 * @return   {string}
 */  
if( ! function_exists('to_permalink') )
{
	function to_permalink($str)
	{
		$CI =& get_instance();
		if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
			$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
		$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
		$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
		$str = strtolower( trim($str, '-') );
		return $str;
	}
}