<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Autenticar usuarios de la app
 *
 * @package	Meru
 * @subpackage	Auth
 * @category	Seguridad
 * @author	Juan Carlos Dominguez
 */
class Users extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth/user');
	}
	
   	/**
   	 * Funcion de la clase, o metodo, que debe ser llamado por defecto
   	 *
   	 * @access	public
   	 * @return	boolean
   	 */	
	function index()
	{
		$this->validate();
	}
   	
	/**
   	 * Llamar al template login mediante parser
   	 *
   	 * @access	private
   	 * @return	boolean
   	 */
	protected function _show_template_login()
	{
		$data = array(
			'app_title' => $this->config->item('app_title'),
			'app_copyright' => $this->config->item('app_copyright'),
			'company_com_rif' => $this->config->item('company_com_rif'),
			'company_logo_medium' => $this->config->item('company_logo_medium')
	    );
		$this->parser->parse('login', $data);
	}
	
   	/**
   	 * Llamar al template main mediante parser
   	 *
   	 * @access	private
   	 * @return	boolean
   	 */
	protected function _show_template_main()
	{	
		$sess_user = $this->auth->_get_session_info('sess_user');
		$sess_name = $this->auth->_get_session_info('sess_name');
		$sess_last_activity = $this->auth->_get_session_info('sess_last_activity');
		
		$data = array(
			'company_logo_brand' => $this->config->item('company_logo_brand'),
			'company_com_rif' => $this->config->item('company_com_rif'),
			
			'app_title' => $this->config->item('app_title'),
			'app_copyright' => $this->config->item('app_copyright'),
			
			
			'ajax_loader_message'=> $this->config->item('ajax_loader_message'),

			'sess_user' => $sess_user,
			'sess_name' => $sess_name,
			'sess_last_activity' => date('d/m/Y H:i:s', $sess_last_activity),
			
	      	'doc_content' => $this->load->view('docs/manual.php', '', TRUE),
		  	'app_menu' => $this->load->view('app/menu', '', TRUE),
			'app_content' => $this->load->view('app/content', '', TRUE),
			'app_fiscal_year' => $this->user->_fiscal_year($sess_user) 
	    );
		$this->parser->parse('main', $data);
	}
	
	
	/**
	 * Verifica los campos del formulario login antes de ir a la bd
	 *
	 * El uso de xss_clean -> http://ellislab.com/codeigniter/user-guide/libraries/security.html
	 *
	 * @access	public
	 * @return	string
	 */
	 function validate()
	 {
	 	if( ! $this->auth->_is_logged_in()) 
		{
			$rules = $this->form_validation;
   		 	$rules->set_rules('user_name', 'Usuario', 'trim|required|xss_clean');
    		$rules->set_rules('user_pass', 'Contraseña', 'trim|required|xss_clean|callback_validate_db_user'); // callback_funcion que valida el usuario 
    		$rules->set_error_delimiters('',''); // opcional si no se quiere <p> como tag del error
			
			// Se valido el formulario correctamente
			if($rules->run())
			{
				$this->_show_template_main();
			}
			else
			{
				$this->_show_template_login();
			}							
		}
		else
		{
			// Ya ha iniciado sesion
			$this->_show_template_main();
		}
	 }
	 
	/**
	 * Verificar si el usuario existe en ldap o postrges
	 *
	 * @access	public
	 * @param	string
	 * @return	boolean
	 */
	 function validate_db_user($user_pass)
	 {
		  $user_name = $this->input->post('user_name');
		  
		  // Cargar el modelo
		  $this->load->model('auth/user');
		  $checked_user = $this->user->is_local($user_name, $user_pass);
		  
		  // Si existe el usuario, creamos la session
		  if($checked_user)
		  {
              $this->auth->_set_session_userdata($checked_user);
              return TRUE;
          }
          else 
		  {
              $this->form_validation->set_message('validate_db_user', '<strong>Error!</strong> La información no es válida.');
              return FALSE;
          }
	 }
	 
  	/**
  	 * Eliminar la sesión
  	 *
  	 * @access	public
  	 * @return	boolean
  	 */
  	 function logout()
 	 {
 		 return $this->auth->_logout();
  	 }
}