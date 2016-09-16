<?php 
class Dashboard_summary_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
        function get_months_donation_trends(){
            $dbdefault = $this->load->database('default',TRUE);
            $from_date = date('Y-m-d', strtotime('-30 days'));
            $to_date = date("Y-m-d");
            $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type')
		->from('bloodbanks');
		$query=$this->db->get();
		$result = $query->result();
		foreach($result as $r){
			$config['hostname'] = "$r->host_name";
			$config['username'] = "$r->username";
			$config['password'] = "$r->database_password";
			$config['database'] = "$r->database_name";
			$config['dbdriver'] = 'mysql';
			$config['dbprefix'] = '';
			$config['pconnect'] = TRUE;
			$config['db_debug'] = TRUE;
			$config['cache_on'] = FALSE;
			$config['cachedir'] = '';
			$config['char_set'] = 'utf8';
			$config['dbcollat'] = 'utf8_general_ci';
			$dbt=$this->load->database($config,TRUE);
			$dbt->select("COUNT(*) day_count, donation_date, $r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type", false)
			->from('bb_donation')
                        ->where('bb_donation.status_id > 3')
                        ->where("(donation_date BETWEEN '$from_date' AND '$to_date')")
                        ->group_by('donation_date')
                        ->order_by('donation_date');
			$query=$dbt->get();
			$dashboard[]=$query->result();
		}
		return $dashboard;
        }
        
        function get_todays_donations(){
                $today=date("Y-m-d");
                $dbdefault = $this->load->database('default',TRUE);
		$this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type')
		->from('bloodbanks');
		$query=$this->db->get();
		$result = $query->result();
		foreach($result as $r){
			$config['hostname'] = "$r->host_name";
			$config['username'] = "$r->username";
			$config['password'] = "$r->database_password";
			$config['database'] = "$r->database_name";
			$config['dbdriver'] = 'mysql';
			$config['dbprefix'] = '';
			$config['pconnect'] = TRUE;
			$config['db_debug'] = TRUE;
			$config['cache_on'] = FALSE;
			$config['cachedir'] = '';
			$config['char_set'] = 'utf8';
			$config['dbcollat'] = 'utf8_general_ci';
			$dbt=$this->load->database($config,TRUE);
			$dbt->select("COUNT(*) blood_bank_count, $r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type", false)
			->from('bb_donation')
                        ->where('bb_donation.status_id > 3')
                        ->where("bb_donation.donation_date", $today);
			$query=$dbt->get();
			$dashboard[]=$query->row();
		}
		return $dashboard;            
        }
        
        function get_months_donations(){
            $dbdefault = $this->load->database('default',TRUE);
            $from_date = date('Y-m-d', strtotime('-30 days'));
            $to_date = date("Y-m-d");
            $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type')
		->from('bloodbanks');
		$query=$this->db->get();
		$result = $query->result();
		foreach($result as $r){
			$config['hostname'] = "$r->host_name";
			$config['username'] = "$r->username";
			$config['password'] = "$r->database_password";
			$config['database'] = "$r->database_name";
			$config['dbdriver'] = 'mysql';
			$config['dbprefix'] = '';
			$config['pconnect'] = TRUE;
			$config['db_debug'] = TRUE;
			$config['cache_on'] = FALSE;
			$config['cachedir'] = '';
			$config['char_set'] = 'utf8';
			$config['dbcollat'] = 'utf8_general_ci';
			$dbt=$this->load->database($config,TRUE);
			$dbt->select("COUNT(*) blood_bank_count, $r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type", false)
			->from('bb_donation')
                        ->where('bb_donation.status_id > 3')
                        ->where("(donation_date BETWEEN '$from_date' AND '$to_date')")
                        ->order_by('blood_bank_count');
			$query=$dbt->get();
			$dashboard[]=$query->row();
		}
		return $dashboard;
        }
        
        function get_todays_issues(){          //Issue summary.
            $today=date("Y-m-d");
                $dbdefault = $this->load->database('default',TRUE);
		$this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type')
		->from('bloodbanks');
		$query=$this->db->get();
		$result = $query->result();
		foreach($result as $r){
			$config['hostname'] = "$r->host_name";
			$config['username'] = "$r->username";
			$config['password'] = "$r->database_password";
			$config['database'] = "$r->database_name";
			$config['dbdriver'] = 'mysql';
			$config['dbprefix'] = '';
			$config['pconnect'] = TRUE;
			$config['db_debug'] = TRUE;
			$config['cache_on'] = FALSE;
			$config['cachedir'] = '';
			$config['char_set'] = 'utf8';
			$config['dbcollat'] = 'utf8_general_ci';
			$dbt=$this->load->database($config,TRUE);
			$dbt->select("COUNT(*) blood_bank_count, $r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type", false)
			->from('bb_donation')
                        ->join('blood_inventory','blood_inventory.donation_id = bb_donation.donation_id')
                        ->where('blood_inventory.status_id = 8')
                        ->where("bb_donation.donation_date", $today);
			$query=$dbt->get();
			$dashboard[]=$query->row();
		}
		return $dashboard;            
        }
	
        function get_months_issues(){
            $from_date = date('Y-m-d', strtotime('-30 days'));
            $to_date = date("Y-m-d");
            $dbdefault = $this->load->database('default',TRUE);
            $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type')
		->from('bloodbanks');
		$query=$this->db->get();
		$result = $query->result();
		foreach($result as $r){
			$config['hostname'] = "$r->host_name";
			$config['username'] = "$r->username";
			$config['password'] = "$r->database_password";
			$config['database'] = "$r->database_name";
			$config['dbdriver'] = 'mysql';
			$config['dbprefix'] = '';
			$config['pconnect'] = TRUE;
			$config['db_debug'] = TRUE;
			$config['cache_on'] = FALSE;
			$config['cachedir'] = '';
			$config['char_set'] = 'utf8';
			$config['dbcollat'] = 'utf8_general_ci';
			$dbt=$this->load->database($config,TRUE);
			$dbt->select("COUNT(*) blood_bank_count, $r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type", false)
			->from('bb_donation')
                        ->join('blood_inventory','blood_inventory.donation_id = bb_donation.donation_id')
                        ->where('blood_inventory.status_id = 8')
                        ->where("(donation_date BETWEEN '$from_date' AND '$to_date')");
			$query=$dbt->get();
			$dashboard[]=$query->row();
		}
		return $dashboard;            
        }
                
        function get_current_inventory(){
            $dbdefault = $this->load->database('default',TRUE);
            $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type')
            ->from('bloodbanks');
            $query=$this->db->get();
            $result = $query->result();
            foreach($result as $r){
                $config['hostname'] = "$r->host_name";
                $config['username'] = "$r->username";
                $config['password'] = "$r->database_password";
                $config['database'] = "$r->database_name";
                $config['dbdriver'] = 'mysql';
                $config['dbprefix'] = '';
                $config['pconnect'] = TRUE;
                $config['db_debug'] = TRUE;
                $config['cache_on'] = FALSE;
                $config['cachedir'] = '';
                $config['char_set'] = 'utf8';
                $config['dbcollat'] = 'utf8_general_ci';
                $dbt=$this->load->database($config,TRUE);
                $dbt->select("COUNT(*) blood_bank_count, $r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type", false)
                ->from('bb_donation')
                ->join('blood_inventory','blood_inventory.donation_id = bb_donation.donation_id')
                ->where('blood_inventory.status_id = 7');
                $query=$dbt->get();
                $dashboard[]=$query->row();
            }
            return $dashboard;
        }
        
        function get_months_inventory(){ // Including all that have been 
            $from_date = date('Y-m-d', strtotime('-30 days'));
            $to_date = date("Y-m-d");
            $dbdefault = $this->load->database('default',TRUE);
            $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type')
            ->from('bloodbanks');
            $query=$this->db->get();
            $result = $query->result();
            foreach($result as $r){
                $config['hostname'] = "$r->host_name";
                $config['username'] = "$r->username";
                $config['password'] = "$r->database_password";
                $config['database'] = "$r->database_name";
                $config['dbdriver'] = 'mysql';
                $config['dbprefix'] = '';
                $config['pconnect'] = TRUE;
                $config['db_debug'] = TRUE;
                $config['cache_on'] = FALSE;
                $config['cachedir'] = '';
                $config['char_set'] = 'utf8';
                $config['dbcollat'] = 'utf8_general_ci';
                $dbt=$this->load->database($config,TRUE);
                $dbt->select("COUNT(*) blood_bank_count, $r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type", false)
                ->from('bb_donation')
                ->join('blood_inventory','blood_inventory.donation_id = bb_donation.donation_id')
                ->where('blood_inventory.status_id >= 7')
                ->where("(donation_date BETWEEN '$from_date' AND '$to_date')");
                $query=$dbt->get();
                $dashboard[]=$query->row();
            }
            return $dashboard;
        }
        
        function get_todays_discards(){
            $today=date("Y-m-d");
            $dbdefault = $this->load->database('default',TRUE);
            $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type')
            ->from('bloodbanks');
            $query=$this->db->get();
            $result = $query->result();
            foreach($result as $r){
                $config['hostname'] = "$r->host_name";
                $config['username'] = "$r->username";
                $config['password'] = "$r->database_password";
                $config['database'] = "$r->database_name";
                $config['dbdriver'] = 'mysql';
                $config['dbprefix'] = '';
                $config['pconnect'] = TRUE;
                $config['db_debug'] = TRUE;
                $config['cache_on'] = FALSE;
                $config['cachedir'] = '';
                $config['char_set'] = 'utf8';
                $config['dbcollat'] = 'utf8_general_ci';
                $dbt=$this->load->database($config,TRUE);
                $dbt->select("COUNT(*) blood_bank_count, $r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type", false)
                ->from('bb_donation')
                ->join('blood_inventory','blood_inventory.donation_id = bb_donation.donation_id')
                ->where('blood_inventory.status_id = 9')
                ->where("bb_donation.donation_date", $today);
                $query=$dbt->get();
                $dashboard[]=$query->row();
            }
            return $dashboard;
        }
        function get_bloodbanks_coordinates(){
            $dbdefault = $this->load->database('default',TRUE);
            $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type, district, lattitude, longitude')
            ->from('bloodbanks');
            $query=$this->db->get();
            
            return $query->result();
        }
        function get_months_discards(){
            $from_date = date('Y-m-d', strtotime('-30 days'));
            $to_date = date("Y-m-d");
            $dbdefault = $this->load->database('default',TRUE);
            $this->db->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type')
            ->from('bloodbanks');
            $query=$this->db->get();
            $result = $query->result();
            foreach($result as $r){
                $config['hostname'] = "$r->host_name";
                $config['username'] = "$r->username";
                $config['password'] = "$r->database_password";
                $config['database'] = "$r->database_name";
                $config['dbdriver'] = 'mysql';
                $config['dbprefix'] = '';
                $config['pconnect'] = TRUE;
                $config['db_debug'] = TRUE;
                $config['cache_on'] = FALSE;
                $config['cachedir'] = '';
                $config['char_set'] = 'utf8';
                $config['dbcollat'] = 'utf8_general_ci';
                $dbt=$this->load->database($config,TRUE);
                $dbt->select("COUNT(*) blood_bank_count, $r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type", false)
                ->from('bb_donation')
                ->join('blood_inventory','blood_inventory.donation_id = bb_donation.donation_id')
                ->where('blood_inventory.status_id = 9')
                ->where("(donation_date BETWEEN '$from_date' AND '$to_date')");
                $query=$dbt->get();
		$dashboard[]=$query->row();
            }
            return $dashboard;
        }
        
        
        //Unused methods.
        //login() accepts the username and password, searches the database for match and if found, returns the 
	//query result else returns false
	function login($username, $password){
	   $this -> db -> select('*');
	   $this -> db -> from('user');
	   $this -> db -> where('username', $username);
	   $this -> db -> where('password', MD5($password));
	 
	   $query = $this -> db -> get();
	   if($query -> num_rows() > 0)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
	}
	
        
        
	function get_dashboard_patients(){  //Unused
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
                    if($this->input->post('from_date')){
                        $from_date = $this->input->post('from_date');
                        $to_date = date("Y-m-d");                    
                    }else{
                        $to_date = $this->input->post('to_date');
                        $from_date = date('Y-m-d', strtotime('-30 days'));
                    }
		}
		else{
			$from_date=date("Y-m-d");
			$to_date=$from_date;
		}
		$this->db->select('hospital_id,hospital_name,host_name,username,database_name,database_password')
		->from('hospitals');
		$query=$this->db->get();
		$result = $query->result();
		foreach($result as $r){
			$config['hostname'] = "$r->host_name";
			$config['username'] = "$r->username";
			$config['password'] = "$r->database_password";
			$config['database'] = "$r->database_name";
			$config['dbdriver'] = 'mysql';
			$config['dbprefix'] = '';
			$config['pconnect'] = TRUE;
			$config['db_debug'] = TRUE;
			$config['cache_on'] = FALSE;
			$config['cachedir'] = '';
			$config['char_set'] = 'utf8';
			$config['dbcollat'] = 'utf8_general_ci';
			$dbt=$this->load->database($config,TRUE);
			$dbt->select("$r->hospital_id hospital_id, '$r->hospital_name' hospital_name,
			SUM(CASE WHEN visit_type = 'OP' THEN 1 ELSE 0 END) OP, 
			SUM(CASE WHEN visit_type ='IP' THEN 1 ELSE 0 END) IP",false)
			->from('patient_visit')		 
			->where("(admit_date BETWEEN '$from_date' AND '$to_date')");
			$query=$dbt->get();
			$dashboard[]=$query->row();
		}
		return $dashboard;
	}
        
	function get_dashboard_diagnostics(){
                if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
                    if($this->input->post('from_date')){
                        $from_date = $this->input->post('from_date');
                        $to_date = date("Y-m-d");                    
                    }else{
                        $to_date = $this->input->post('to_date');
                        $from_date = date('Y-m-d', strtotime('-30 days'));
                    }
		}
		else{
			$from_date=date("Y-m-d");
			$to_date=$from_date;
		}
		$this->db->select('hospital_id,hospital_name,host_name,username,database_name,database_password')
		->from('hospitals');
		$query=$this->db->get();
		$result = $query->result();
		foreach($result as $r){
			$config['hostname'] = "$r->host_name";
			$config['username'] = "$r->username";
			$config['password'] = "$r->database_password";
			$config['database'] = "$r->database_name";
			$config['dbdriver'] = 'mysql';
			$config['dbprefix'] = '';
			$config['pconnect'] = TRUE;
			$config['db_debug'] = TRUE;
			$config['cache_on'] = FALSE;
			$config['cachedir'] = '';
			$config['char_set'] = 'utf8';
			$config['dbcollat'] = 'utf8_general_ci';
			$dbt=$this->load->database($config,TRUE);
			$dbt->select("$r->hospital_id hospital_id, '$r->hospital_name' hospital_name,
			COUNT(DISTINCT test.test_id) tests,
			test_area.test_area_id, test_area.test_area",false)
			->from('test')
                        ->join('test_master','test.test_master_id = test_master.test_master_id')
			->join('test_order','test.order_id = test_order.order_id')
                        ->join('test_area','test_area.test_area_id=test_order.test_area_id','left')                        
			->where('test.test_status',2)                                       //Getting only tests approved.
                        ->where("(DATE(test_order.order_date_time) BETWEEN '$from_date' AND '$to_date')")
                        ->group_by('test_area.test_area_id');
			$query=$dbt->get();
                        $results = $query->result();
                        if ($query->num_rows() > 0)
                        {
                            foreach($results as $result){
                                $dashboard[] = $result;                             
                            }                        
                        }else{
                            $dashboard[] = (object) array(
                                'hospital_id' => $r->hospital_id,
                                'hospital_name' => $r->hospital_name,
                                'tests' => '',
                                'test_area_id' => '',
                                'test_area' => ''
                            );
                        }
		}
		return $dashboard;
	}
	
        function get_test_areas(){
            $this->db->select('test_area')
            ->from('test_areas');
            $query=$this->db->get();
            $result = $query->result();
            return $result;
        }
			
}
?>