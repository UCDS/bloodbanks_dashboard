<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard_detailed_model
 *
 * @author gokul
 */
class Dashboard_detailed_model extends CI_Model{
    //put your code here
    function __construct(){
        parent::__construct();                
    }
    function get_donations_detailed(){        //Donations detailed
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
                        $from_date = date( "Y-m-d", strtotime( date($this->input->post('to_date'))) . "-1 month" );
                    }
		}
		else{
			$from_date=date("Y-m-d");
			$to_date=$from_date;
		}
	
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
			$dbt->select("$r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type,
			SUM(CASE WHEN status_id > 3 AND blood_group = 'A+' THEN 1 ELSE 0 END) Apos, 
			SUM(CASE WHEN status_id > 3 AND blood_group = 'B+' THEN 1 ELSE 0 END) Bpos, 
			SUM(CASE WHEN status_id > 3 AND blood_group = 'O+' THEN 1 ELSE 0 END) Opos, 
			SUM(CASE WHEN status_id > 3 AND blood_group = 'A-' THEN 1 ELSE 0 END) Aneg, 
			SUM(CASE WHEN status_id > 3 AND blood_group = 'B-' THEN 1 ELSE 0 END) Bneg, 
			SUM(CASE WHEN status_id > 3 AND blood_group = 'O-' THEN 1 ELSE 0 END) Oneg,
                        SUM(CASE WHEN status_id > 3 AND blood_group = 'AB+' THEN 1 ELSE 0 END) ABpos,
                        SUM(CASE WHEN status_id > 3 AND blood_group = 'AB-' THEN 1 ELSE 0 END) ABneg,
			SUM(CASE WHEN status_id > 3 THEN 1 ELSE 0 END) total
			",false)
			->from('bb_donation')
			->join('blood_grouping','bb_donation.donation_id = blood_grouping.donation_id')
                        ->where("(donation_date BETWEEN '$from_date' AND '$to_date')");
			$query=$dbt->get();
			$dashboard[]=$query->row();
		}
		return $dashboard;
	}
        
        function get_current_inventory_detailed(){     //Inventory detailed without components.
            $dbdefault = $this->load->database('default',TRUE);
	/*	if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
                    if($this->input->post('from_date')){
                        $from_date = $this->input->post('from_date');
                        $to_date = date("Y-m-d");                    
                    }else{
                        $to_date = $this->input->post('to_date');
                        $from_date = date( "Y-m-d", strtotime( date($this->input->post('to_date'))) . "-1 month" );
                    }
		}
		else{
			$from_date=date("Y-m-d");
			$to_date=$from_date;
		} */
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
			$dbt->select("$r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type,
			SUM(CASE WHEN  blood_inventory.status_id = 7 AND blood_group = 'A+' THEN 1 ELSE 0 END) Apos, 
			SUM(CASE WHEN  blood_inventory.status_id = 7 AND blood_group = 'B+' THEN 1 ELSE 0 END) Bpos, 
			SUM(CASE WHEN  blood_inventory.status_id = 7 AND blood_group = 'O+' THEN 1 ELSE 0 END) Opos, 
			SUM(CASE WHEN  blood_inventory.status_id = 7 AND blood_group = 'A-' THEN 1 ELSE 0 END) Aneg, 
			SUM(CASE WHEN  blood_inventory.status_id = 7 AND blood_group = 'B-' THEN 1 ELSE 0 END) Bneg, 
			SUM(CASE WHEN  blood_inventory.status_id = 7 AND blood_group = 'O-' THEN 1 ELSE 0 END) Oneg,
                        SUM(CASE WHEN  blood_inventory.status_id = 7 AND blood_group = 'AB+' THEN 1 ELSE 0 END) ABpos,
                        SUM(CASE WHEN  blood_inventory.status_id = 7 AND blood_group = 'AB-' THEN 1 ELSE 0 END) ABneg,
			SUM(CASE WHEN  blood_inventory.status_id = 7 THEN 1 ELSE 0 END) total
			",false)
			->from('bb_donation')
			->join('blood_grouping','bb_donation.donation_id = blood_grouping.donation_id')
                        ->join('blood_inventory','bb_donation.donation_id = blood_inventory.donation_id');
			$query=$dbt->get();
			$dashboard[]=$query->row();
		}
		return $dashboard;
	}
        function get_dashboard_available(){   // Inventory detailed with components
		$dbdefault = $this->load->database('default',TRUE);
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
                        $from_date = date( "Y-m-d", strtotime( date($this->input->post('to_date'))) . "-1 month" );
                    }
		}
		else{
			$from_date=date("Y-m-d");
			$to_date=$from_date;
		}
		$dbdefault->select('bloodbank_id,bloodbank_name,host_name,username,database_name,database_password,bloodbank_type')
		->from('bloodbanks');
		$query=$dbdefault->get();
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
			$dbt->select(
					"blood_group,
                                        '$r->bloodbank_name' bloodbank_name,                                       
					SUM(pc) pc,
					SUM(wb) wb,
					SUM(cryo) cryo,
					SUM(fp) fp,
					SUM(ffp) ffp,
					SUM(prp) prp,
					bloodbank_type",false)
				 ->from("(SELECT $r->bloodbank_type bloodbank_type , blood_group,SUM(CASE WHEN component_type='PRP' THEN 1 ELSE 0 END) prp,
					SUM(CASE WHEN component_type='Platelet Concentrate' THEN 1 ELSE 0 END) platelet_concentrate,
					SUM(CASE WHEN component_type='PC' THEN 1 ELSE 0 END) pc,
					SUM(CASE WHEN component_type='WB' THEN 1 ELSE 0 END) wb,
					SUM(CASE WHEN component_type='Cryo' THEN 1 ELSE 0 END) cryo,
					SUM(CASE WHEN component_type='FP' THEN 1 ELSE 0 END) fp,
					SUM(CASE WHEN component_type='FFP' THEN 1 ELSE 0 END) ffp
					FROM blood_donor JOIN bb_donation USING(donor_id) JOIN blood_inventory USING(donation_id) 
					WHERE bb_donation.status_id = 6 AND bb_donation.screening_result=1 AND blood_inventory.status_id = 7 AND expiry_date>='".date("Y-m-d")."'
					GROUP BY blood_group) zxcv",false)
				->group_by('blood_group,bloodbank_type,bloodbank_name');

			$query=$dbt->get();
                        
       //   echo  $dbt->last_query()."<br /><br /><br /><br />";
			$dashboard[]=$query->result();
		}
        //        var_dump($dashboard);
		return $dashboard;
	}
        
        function get_months_issues_detailed(){
            $from_date = date( "Y-m-d", strtotime( date($this->input->post('to_date'))) . "-1 month" );
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
			$dbt->select("$r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type,
			SUM(CASE WHEN blood_group = 'A+' THEN 1 ELSE 0 END) Apos, 
			SUM(CASE WHEN blood_group = 'B+' THEN 1 ELSE 0 END) Bpos, 
			SUM(CASE WHEN blood_group = 'O+' THEN 1 ELSE 0 END) Opos, 
			SUM(CASE WHEN blood_group = 'A-' THEN 1 ELSE 0 END) Aneg, 
			SUM(CASE WHEN blood_group = 'B-' THEN 1 ELSE 0 END) Bneg, 
			SUM(CASE WHEN blood_group = 'O-' THEN 1 ELSE 0 END) Oneg,
                        SUM(CASE WHEN blood_group = 'AB+' THEN 1 ELSE 0 END) ABpos,
                        SUM(CASE WHEN blood_group = 'AB-' THEN 1 ELSE 0 END) ABneg,
			SUM(CASE WHEN blood_inventory.status_id = 8 THEN 1 ELSE 0 END) total
			",false)
			->from('bb_donation')
			->join('blood_grouping','bb_donation.donation_id = blood_grouping.donation_id')
                        ->join('blood_inventory','blood_inventory.donation_id = bb_donation.donation_id')
                        ->where('blood_inventory.status_id = 8')
                        ->where("(donation_date BETWEEN '$from_date' AND '$to_date')");
			$query=$dbt->get();
			$dashboard[]=$query->row();
		}
		return $dashboard;            
        }
        function get_months_discards_detailed(){
            $from_date = date( "Y-m-d", strtotime( date($this->input->post('to_date'))) . "-1 month" );
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
                $dbt->select("$r->bloodbank_id bloodbank_id, '$r->bloodbank_name' bloodbank_name, $r->bloodbank_type bloodbank_type,
			SUM(CASE WHEN blood_group = 'A+' THEN 1 ELSE 0 END) Apos, 
			SUM(CASE WHEN blood_group = 'B+' THEN 1 ELSE 0 END) Bpos, 
			SUM(CASE WHEN blood_group = 'O+' THEN 1 ELSE 0 END) Opos, 
			SUM(CASE WHEN blood_group = 'A-' THEN 1 ELSE 0 END) Aneg, 
			SUM(CASE WHEN blood_group = 'B-' THEN 1 ELSE 0 END) Bneg, 
			SUM(CASE WHEN blood_group = 'O-' THEN 1 ELSE 0 END) Oneg,
                        SUM(CASE WHEN blood_group = 'AB+' THEN 1 ELSE 0 END) ABpos,
                        SUM(CASE WHEN blood_group = 'AB-' THEN 1 ELSE 0 END) ABneg,
			SUM(CASE WHEN blood_inventory.status_id = 8 THEN 1 ELSE 0 END) total
			",false)
			->from('bb_donation')
			->join('blood_grouping','bb_donation.donation_id = blood_grouping.donation_id')
                        ->join('blood_inventory','blood_inventory.donation_id = bb_donation.donation_id')
                ->where('blood_inventory.status_id = 9')
                ->where("(donation_date BETWEEN '$from_date' AND '$to_date')");
                $query=$dbt->get();
                $query=$dbt->get();
		$dashboard[]=$query->row();
            }
            return $dashboard;
        }
}
