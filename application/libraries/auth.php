<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Auth {
	
  	/**
  	 * Verifica la sesión
  	 *
  	 * @access	public
  	 * @return	boolean
  	 */	  
	function _is_logged_in()
	{
		$CI =& get_instance();
		$session_data = $CI->session->userdata('logged_in');
		
		if($session_data) 
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
	}
	
  	/**
  	 * Crea las variables de session del usuario
  	 *
  	 * @access	public
  	 * @return	boolean
  	 */		
	function _set_session_userdata($param)
	{
		$CI =& get_instance();
		
		foreach($param->result() as $variable => $value)
		{
			$userdata = array(
				'sess_user' => $value->usuario,
				'sess_name' => $value->nombre,
				'sess_status'=> $value->status,
				'sess_last_activity' => time(),
				'sess_ip_address'=>'',
				'logged_in' => TRUE 
			);
		}
		
		// schema. meru_auth
		/*
		foreach($param->result() as $variable => $value)
		{
			$userdata = array(
				'sess_user' => $value->sys_user,
				'sess_name' => $value->sys_user,
				'sess_status'=> $value->sys_status,
				'sess_last_activity' => time(),
				'sess_ip_address'=>'',
				'logged_in' => TRUE 
			);
		}
		*/
		$CI->session->set_userdata($userdata);
	}
	
  	/**
  	 * Crea las variables de session del usuario
  	 *
  	 * @access	public
  	 * @return	boolean
  	 */
	function _get_session_info($param)
	{
		$CI =& get_instance();
		return $CI->session->userdata($param);
	}
	
  	/**
  	 * Restringe el acceso directo a vistas que solo deben ser llamadas mediante ajax
  	 *
  	 * @access	public
	 * @param {string} callback
  	 * @return	boolean
  	 */
	protected function _is_restricted_by_header()
	{
		if(isset($_GET['callback']))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
   	 * Llamar al template login mediante parser
   	 *
   	 * @access	private
   	 * @return	boolean
   	 */
	function no_direct_access($view,$data="")
	{
		$CI =& get_instance();
		if ($this->_is_restricted_by_header()) 
		{
			$CI->load->view($view,$data);
		}
		else
		{
			// Error Messages:  http://ellislab.com/codeigniter/user-guide/general/errors.html
			show_error( $CI->config->item('is_not_direct_script'), 404, $CI->config->item('app_short_title').' ERROR')	;
		}
		            
	}
	
 	/**
 	 * Eliminar la sesión
 	 *
 	 * @access	public
 	 * @return	boolean
 	 */
 	 function _logout()
	 {
		 $CI =& get_instance();
		 $CI->session->unset_userdata('logged_in');
		 $CI->session->sess_destroy();
		 redirect('.', 'refresh');
 	 }
    
}

/* End of file Someclass.php */