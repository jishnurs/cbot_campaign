<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	* __construct function.
	* 
	* @access public
	* @return void
	*/
	public function __construct()
	{

		parent::__construct();
		$this->load->model('UserModel');

	}

	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/welcome
	*	- or -
	* 		http://example.com/index.php/welcome/index
	*	- or -
	* Since this controller is set as the default controller in
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/welcome/<method_name>
	* @see https://codeigniter.com/user_guide/general/urls.html
	*/
	public function index()
	{
		$this->load->view('home');
	}


	/**
	* login function.
	* 
	* @access public
	* @return void
	*/
	public function login() 
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
				$data['doctorEmails'] = $this->UserModel->getDoctorEmails();

			// user login ok
			$this->load->view('header');
			$this->load->view('login_success',$data);
			$this->load->view('footer');
		}else{

		// create the data object
		$data = new stdClass();


		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == false) {

			// validation not ok, send validation errors to the view
			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('footer');

		} else {

			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ($this->UserModel->resolve_user_login($username, $password)) {

				$user_id = $this->UserModel->get_user_id_from_username($username);
				$user    = $this->UserModel->get_user($user_id);

				// set session user datas
				$_SESSION['user_id']      = (int)$user->id;
				$_SESSION['username']     = (string)$user->username;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
				$_SESSION['is_admin']     = (bool)$user->is_admin;

				$data['doctorEmails'] = $this->UserModel->getDoctorEmails();
				// user login ok
				$this->load->view('header');
				$this->load->view('login_success', $data);
				$this->load->view('footer');

			} else {

			// login failed
				$data->error = 'Wrong username or password.';

			// send error to the view
				$this->load->view('header');
				$this->load->view('login', $data);
				$this->load->view('footer');

			}

		}
		}

	}


	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register() {
		
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library

		
		// set validation rules
		// $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		// $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		// $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		// $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		
		// if ($this->form_validation->run() === false) {
			
			// validation not ok, send validation errors to the view
			// $this->load->view('header');
			// $this->load->view('user/register/register', $data);
			// $this->load->/view('footer');
			
		// } else {
			
			// set variables from the form
			// $username = $this->input->post('username');
			// $email    = $this->input->post('email');
			// $password = $this->input->post('password');

			$username = '';
			$email    = '';
			$password = '';
			
			if ($this->UserModel->create_user($username, $email, $password)) {
				
				// user creation ok
				$this->load->view('header');
				// $this->load->view('user/register/register_success', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				// $this->load->view('user/register/register', $data);
				$this->load->view('footer');
				
			}
			
		// }
		
	}

	public function sendWebsiteOfferEmail()
	{
		$this->form_validation->set_rules('mailTypeId', 'Mail type', 'required|numeric|trim');
		$this->form_validation->set_rules('toEmail', 'To email', 'required|trim');
		$this->form_validation->set_rules('subject', 'Subject', 'required|trim');
		
		$data['doctorEmails'] = $this->UserModel->getDoctorEmails();

		if ($this->form_validation->run() == false) {

			// validation not ok, send validation errors to the view
			$this->load->view('header');
			$this->load->view('login_success',$data);
			$this->load->view('footer');

		}else{
			$mailTypeId = $this->input->post('mailTypeId');

			switch ($mailTypeId) {
				case 1:
					$emailFile = 'email/doctorwebsiteemail';
					break;
				
				default:
					$emailFile = 'Thank you for using the products of CBOT Labs';
					break;
			}
			$emailContents = array(
				'to_email' => $this->input->post('toEmail'), 
				'subject'  => $this->input->post('subject'), 
				'mail_type_id' => $mailTypeId, 
				);
			$status = $this->sendEmailToDoctors($emailContents,$emailFile);
			// if($status){
				$this->load->view('header');
				$this->load->view('login_success',$data);
				$this->load->view('footer');
			// }
		}
	}

	/**
	 * [sendEmailToDoctors description]
	 * @param  [type] $emailContents [description]
	 * @return [type]                [description]
	 */
	public function sendEmailToDoctors($emailContents,$htmlContents)
	{
		// $toEmail = 'jishnu2292@gmail.com';
		// $subject = 'Low cost Premium website from Team Medpicky';
		// $htmlContents = 'email/doctorwebsiteemail';
		// $data = '';

		$toEmail = $emailContents['to_email'];
		$subject = $emailContents['subject'];
		$details = '';

		// $config['protocol'] = 'sendmail';
		// $config['mailpath'] = '/usr/sbin/sendmail';
		// $config['charset'] = 'iso-8859-1';
		// $config['wordwrap'] = TRUE;

		// $this->email->initialize($config);


        $this->email->from('cbotlabs@medpicky.com', 'Medpicky');
		$this->email->to($toEmail);

		$this->email->subject($subject);
		// $this->email->message('Testing the email class.');
		$messageContent = $this->load->view($htmlContents,$details,TRUE);
		$this->email->message($messageContent);

		if($this->email->send()){
			$emailContents['send_status_id'] = 1;
			$data['status_message'] = "Email sent.";
		}else{
			$emailContents['send_status_id'] = 0;
			$data['status_message'] =  "Email not send.";

		}
		$status = $this->UserModel->addWebsiteOfferEmailStatus($emailContents);
		if($status){
			return true;
		}
	}

	/**
	* logout function.
	* 
	* @access public
	* @return void
	*/
	public function logout() {

		// create the data object
		$data = new stdClass();

		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}

			// user logout ok
			$this->load->view('header');
			$this->load->view('logout_success', $data);
			$this->load->view('footer');

		} else {

			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('login');

		}

	}
}
