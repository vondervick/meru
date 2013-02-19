<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Autenticar usuarios de la app
 *
 * @package	Meru
 * @subpackage	Admin
 * @category	Formularios
 * @author	Juan Carlos Dominguez
 */

class Config extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
	}
   	
	/**
   	 * Llamar al template login mediante parser
   	 *
   	 * @access	private
   	 * @return	boolean
   	 */
	function gerencias()
	{
		$data['test']="gerencias ";
		//$this->auth->no_direct_access($this->load->view('admin/gerencias',$data,true));  
		$this->auth->no_direct_access('admin/gerencias', $data);          
	}
	
	function compras()
	{
		$data['test']="compras ";
		//$this->auth->no_direct_access($this->load->view('admin/gerencias',$data,true));  
		$this->auth->no_direct_access('admin/gerencias', $data);          
	}
	
	
}