<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {	

	function __construct(){
		parent::__construct();
		$this->load->model('dashboard_model');
	}

	public function home()
	{			
            $this->load->helper('form');
            $this->data['title']="Bloodbanks";
            $this->load->view('templates/header',$this->data);
            $this->data['dashboard_bloodbanks']=$this->dashboard_model->get_dashboard_bloodbanks();
            $this->data['dashboard_available']=$this->dashboard_model->get_dashboard_available();
            $this->load->view('pages/home',$this->data);
            $this->load->view('templates/footer');
	}
        
        public function index(){
            $this->load->helper('form');
            $this->data['title']="Bloodbanks";
            $this->load->model('dashboard_summary_model');
            $this->load->model('dashboard_detailed_model');
            $this->data['todays_donations'] = $this->dashboard_summary_model->get_todays_donations();
            $this->data['months_donations'] = $this->dashboard_summary_model->get_months_donations();
            $this->data['todays_issues'] = $this->dashboard_summary_model->get_todays_issues();
            $this->data['months_issues'] = $this->dashboard_summary_model->get_months_issues();
            $this->data['current_inventory'] = $this->dashboard_summary_model->get_current_inventory();
            $this->data['months_inventory'] = $this->dashboard_summary_model->get_months_inventory(); //Top 10 collections                       
            $this->data['todays_discards'] = $this->dashboard_summary_model->get_todays_discards();
            $this->data['months_discards'] = $this->dashboard_summary_model->get_months_discards();
            $this->data['map_pins'] = $this->dashboard_summary_model->get_bloodbanks_coordinates(); //Current inventory
            $this->data['months_donation_trends'] = $this->dashboard_summary_model->get_months_donation_trends();
            $this->data['current_inventory_detailed'] = $this->dashboard_detailed_model->get_current_inventory_detailed();
            $this->load->view('pages/dashboard', $this->data);
        }
        
        function bloodbank_inventory_detailed()
        {
            $this->load->helper('form');
            $this->data['title']="Bloodbanks";
            $this->load->view('templates/header',$this->data);
            $this->data['dashboard_available']=$this->dashboard_model->get_dashboard_available();
            $this->load->view('pages/blood_available_detailed',$this->data);
            $this->load->view('templates/footer');
        }
        
	function login()
	{	
		if(!$this->session->userdata('logged_in')){
			
		$this->data['title']="Login";

		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('password', 'Password', 
	    'trim|required|xss_clean|callback_check_database');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/login');
		}
		else{
			redirect('home/dashboard', 'refresh');
		}
		
		$this->load->view('templates/footer');
		}
		else {
			redirect('home/dashboard','refresh');
		}
	}
        
	function hospitals()
	{					
		$this->load->helper('form');
                    $this->data['title']="Home";
                    $this->load->view('templates/header',$this->data);
                    $this->data['dashboard_patients']=$this->dashboard_model->get_dashboard_patients();
                    $this->data['dashboard_diagnostics']=$this->dashboard_model->get_dashboard_diagnostics();
                    $this->data['test_areas'] = $this->dashboard_model->get_test_areas();
                    $this->load->view('pages/home',$this->data);
                    $this->load->view('templates/footer');
	}
	
	
	function check_database($password){
	   //Field validation succeeded.  Validate against database
	   $username = $this->input->post('username');
	 
	   //query the database
	   if($this->input->post('password')=='tsdme2015' && $username = "dmetelangana")
	   {
	       $this->session->set_userdata('logged_in',1);
	     return TRUE;
	   }
	   else
	   {
	     $this->form_validation->set_message('check_database','Invalid username or password');
	     return false;
	   }
	 }

	 function logout()
	 {
	   $this->session->sess_destroy();
	   redirect('home/login', 'refresh');
	 }
         
         function load_map(){
              $this->load->view('pages/blood_banks_locations');
         }
}