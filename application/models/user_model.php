<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
	public function register_form_submit()
	{
		$fname=$this->input->post("fname");	
		$lname=$this->input->post("lname");	
		$dob=$this->input->post("dob");
		$dob=explode("/",$dob);
		$dob=$dob[2].'-'.$dob[1].'-'.$dob[0];
		$address=$this->input->post("address");	
		$phone=$this->input->post("phone");	
		$email=strtolower($this->input->post("email"));	
		$username=strtolower($this->input->post("username"));	
		$password=$this->input->post("password");	
		$data=array("fname"=>$fname,"lname"=>$lname,"dob"=>$dob,"address"=>$address,"phone"=>$phone,"email"=>$email,"username"=>$username,"password"=>$password);
		$this->db->insert('user', $data);
		$role=array("role_name"=>"Employee","role_priority"=>2);
		$this->db->insert('roles', $role);
	}
	
	function get_user_details($user, $pass)
	{
		$user=strtolower($user);
		$this->db->select("*");
		$this->db->from("user");
		$this->db->join("roles","roles.role_id = user.user_id and user.password =  '$pass' and (user.username=  '$user' or user.email= '$user')");
		//$this->db->where("username",$user);
		//$this->db->where("password",$pass);
		$query = $this->db->get();
		if($query->num_rows == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
							'user_id'=>$row->user_id,
							'fname' => $row->fname,
							'lname' => $row->lname,
							'username' => $row->username,
							'role_priority'=>$row->role_priority,
							'password'=>$row->password
						  );
        $this->session->set_userdata($data);
		return  $query->row_array() ;
		}
	}
	
	function get_user_list()
	{
		$user=$this->session->userdata('user_id');
		$this->db->select("*");
		$this->db->from("roles");
		$this->db->join("user","user.user_id =roles.role_id and user.user_id!=$user");
		$query=$this->db->get();
		var_dump($query);
		exit;
		foreach ($query->result() as $row)
		{
		return $query->result_array(); 	
		}
	}
	
	function view_details($user_id)
	{
		$this->db->select("*");
		$this->db->from("roles");
		$this->db->join("user","user.user_id =roles.role_id and user.user_id=$user_id");
		$query=$this->db->get();
		/*var_dump($query);
		exit;*/
		foreach ($query->result() as $row)
		{
		return $query->result_array(); 	
		}
	}
	
	function edit_form_submit()
	{
		if($this->session->userdata("role_priority")<2)
		{
			$role_id=$this->input->post("role_id");
			$role_priority=$this->input->post("role_priority");
			if($role_priority==2)
				$role_name="manager";
			if($role_priority==3)
				$role_name="guest";
			$data=array("role_priority"=>$role_priority,"role_name"=>$role_name);
			//print_r($data);
			//exit;
			$this->db->where("role_id",$role_id);
			$this->db->update("roles",$data);
			//for user info update
			echo $user_id=$this->input->post("user_id");
			echo $fname=$this->input->post("fname");
			echo $lname=$this->input->post("lname");		
			echo $dob=$this->input->post("dob");
			echo $address=$this->input->post("address");
			echo $email=$this->input->post("email");
			echo $phone=$this->input->post("phone");
			echo $username=$this->input->post("username");
			$data=array("fname"=>$fname,"lname"=>$lname,"dob"=>$dob,"address"=>$address,"email"=>$email,"phone"=>$phone,"username"=>    																													  $username);
			$this->db->where("user_id",$user_id);
			$this->db->update("user",$data);
			return;
			
		}
		else
		{
			echo $user_id=$this->input->post("user_id");
			echo $fname=$this->input->post("fname");
			echo $lname=$this->input->post("lname");		
			echo $dob=$this->input->post("dob");
			echo $address=$this->input->post("address");
			echo $email=$this->input->post("email");
			echo $phone=$this->input->post("phone");
			echo $username=$this->input->post("username");
			$data=array("fname"=>$fname,"lname"=>$lname,"dob"=>$dob,"address"=>$address,"email"=>$email,"phone"=>$phone,"username"=>    																													  $username);
			$this->db->where("user_id",$user_id);
			$this->db->update("user",$data);


		}
	}
	
	public function user_list()
	{
		$this->db->select("*");
		$this->db->from("roles");
		$this->db->join("user","user.user_id =roles.role_id and roles.role_priority!='1'");
		$query=$this->db->get();
		//var_dump($query->result_array());
		return $query->result_array(); 	
			
	}
	
	public function get_details($table)
	{
		$query=$this->db->get("$table");
		return $query->result_array();
	}
	
	public function assign()
	{
		$project_name=$this->input->post("project_name");		
		$task=$this->input->post("task");		
		$assign_start_date=$this->input->post("assign_start_date");		
		$dob=explode("/",$assign_start_date);
		$assign_start_date=$dob[2].'-'.$dob[1].'-'.$dob[0];
		$assign_end_date=$this->input->post("assign_end_date");
		$dob=explode("/",$assign_end_date);
		$assign_end_date=$dob[2].'-'.$dob[1].'-'.$dob[0];		
		$assign_by=$this->input->post("assign_by");		
		$assign_to=$this->input->post("assign_to");		
		$remark=$this->input->post("remark");	
		$priority=$this->input->post("priority");
		$status=$this->input->post("status");
		$data=array(
		"project_name"=>$project_name,
		"task"=>$task,
		"start_date"=>$assign_start_date,
		"end_date"=>$assign_end_date,
		"assign_by"=>$assign_by,
		"assign_to"=>$assign_to,
		"remark"=>$remark,
		"priority"=>$priority,
		"status"=>$status);
		//var_dump($data);exit();
		if($this->db->insert("assign_project",$data))
		return true;
		else
		return false;			
	}
	
	public function add_details($table)
	{
	//var_dump($_REQUEST);	
		if($this->input->post("projectname"))
		{
			$this->db->insert("$table",array("project_name"=>$this->input->post("projectname")));
		}
		elseif($this->input->post("empl_name"))
		{
			$this->db->insert("$table",array("employer_name"=>$this->input->post("empl_name")));
		}
	}
	
	public function get_assign_details()
	{
		$this->db->select("*");
		$this->db->from("user");
		$this->db->join("assign_project","user.user_id=assign_project.assign_to");
		$this->db->order_by("assign_project.id","DESC");
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function get_pending_details()
	{
		$this->db->select("*");
		$this->db->from("assign_project");
		$this->db->join("user","user.user_id=assign_project.assign_to");
		$this->db->where("assign_project.status",$this->input->post("status1"));
		$this->db->order_by("assign_project.id","DESC");
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function your_assign_details()
	{
		$this->db->select("*");
		$this->db->from("user");
		$this->db->join("assign_project","user.user_id=assign_project.assign_to and user.user_id=".$this->session->userdata("user_id"));
		$this->db->order_by("assign_project.id","DESC");
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function user_response()
	{
		$status=$this->input->post("action");
		$id=$this->input->post("id");
		//var_dump($_REQUEST);
		//exit();		
		$this->db->where("id",$id);
		$this->db->update("assign_project",array("status"=>$status));
		return;
	}
	
	public function current_user()
	{
		$user_id=$this->session->userdata("user_id");
		$this->db->select("*");
		$this->db->from("user");
		$this->db->join("roles","roles.role_id = user.user_id and user.user_id='$user_id'");
		//$this->db->where("username",$user);
		//$this->db->where("password",$pass);
		$query = $this->db->get();
		return $query->row_array();	
		
	}
	
	public function change_password()
	{
		$data=array("password"=>$this->input->post("n_pass"));
		$this->db->where("user_id",$this->session->userdata("user_id"));
		//$this->db->where("password",$n_pass);		
		$this->db->update("user",$data);
		
	}
	
	public function delete($table,$id)
	{
		$this->db->delete($table,array("id" => $id));
	}
	
}
