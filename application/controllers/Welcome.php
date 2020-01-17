<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->view('signin');
	}
	public function check_login()
	{
				echo $user_email;exit();

		$user_email= $this->input->post('folio');
		$user_pass= $this->input->post('pass');
		$status= "A";

		$this->db->select('*');
		$this->db->where('Folio_No',$user_email);
		$this->db->where('Password',$user_pass);
		$this->db->where('Status',$status);
		$result = $this->db->get('user')->result_array();		

		if (count($result) == 1) 
		{
			$this->load->library("session");

            $this->session->set_userdata("email","$user_email");
			$this->session->userdata("email");
			// redirect('admin/dashboard'); 
			redirect('index', 'refresh');
		}
		if (count($result) == 0) {
			// Support Session
			echo "<script>alert('Invalid username or password');</script>";
			//$this->load->view('admin/login');
			redirect('admin', 'refresh');
		}
	}
}
