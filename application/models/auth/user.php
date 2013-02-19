<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model 
{
    /**
    * Comprobar si el usuario existe en la base de datos de postgres
	* @param {string} usuario
	* @param {string} clave  
	* @return {boolean} true si la autenticación es existosa
    */
    function is_local($user_name, $user_pass)
	{
		// Forma standard
		/*
    	$sql = "SELECT usuario, nombre, clave FROM usuarios WHERE usuario='".$user_name."' AND clave='".md5($user_pass)."' LIMIT 1";  
		$query = $this->db->query($sql);
		*/
		// Helper de Base de datos de Codeigniter
		$this->db->select('usuario, nombre, status, clave');
		$this->db->where('usuario', $user_name);
		$this->db->where('clave', md5($user_pass));
		$this->db->limit(1);
		$query = $this->db->get('usuarios');
		
		if ($query->num_rows() > 0) return $query;
	    else return FALSE;
    }
	
	/**
	 * Verificar el período fiscal que corresponde y si el usuario tiene permiso para cambiarlo
	 *
	 * @param {string} usuario de session
	 * @return {date} solo el Año fiscal
	 */
	function _fiscal_year($sess_user)
	{
		$this->db->select("ano_pro, (SELECT ano_fiscal  FROM usuarios WHERE usuario='".$sess_user."') as fiscal");
		$this->db->where('sta_pre !=', '0');
		$this->db->order_by("ano_pro", "desc");
		$query = $this->db->get('registrocontrol');
		
 		if ($query->num_rows() > 0) return $query->result_array();
 	    else return FALSE;
	} 
}
