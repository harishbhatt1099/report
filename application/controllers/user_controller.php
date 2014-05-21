<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_controller extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->helper("url");	
		$this->load->library("session");
		$this->output->cache(0);	
	}
	
	public function index()
	{
		$this->load->view('index');
	}
	
	public function register()
	{
		if($this->input->post("edit"))
		{
			$this->load->model('user_model');
			$result["result"]=$this->user_model->edit_form_submit();
			if(!$result)
			{
				$data['message']="<b style='color:#ff0000'>Sorry you have no writes of updation</b>";
				$this->load->view("current_user_details",$data);
			}
			
		}
		if($this->input->post("register"))
		{
		$this->load->model('user_model');
		$result["result"]=$this->user_model->register_form_submit();
		if(!empty($result))
						  {
							$data['message']="<b style='color:#00ff00;'>Successfully Registred</b>";
							$data['task_report']=$this->user_model->get_assign_details();
				     		$data['employee']=$this->user_model->user_list();								
							$this->load->view("show_user_list",$data);
						  }
		}
	}
	
	 public function home() {				
        
		if ($this->is_logged_in()) {
				//echo "inside session if";exit();
            $query = $this->db->get_where('roles', array('role_id' => $this->session->userdata('user_id')));
            $result=$query->row_array();
			//var_dump($result);
			
			if($result['role_priority']<2)
			{
			$result['project']=$this->user_model->get_details("project");	
     		$result['employee']=$this->user_model->user_list();		
			$result['employer']=$this->user_model->get_details("employer");
			$result['task_report']=$this->user_model->get_assign_details();
			$this->load->view("current_user_details",$result);
			}
			else
			{
			$result['your_report']=$this->user_model->your_assign_details();	
			//$this->load->view("excel_reoprt",$result);
			$this->load->view("current_user_details",$result);
			}
		
            } else {
			     $this->load->view('index');
			}
	    }
	
	public function login_submit()
	{	
		$user=$this->input->post("username");
		$pass=$this->input->post("password");

		$this->load->model('user_model');
		$result["result"]=$this->user_model->get_user_details($user,$pass);
		
		if(!$result['result'])
		{
			$msg["login_error"]="User name and password does not match";
			$this->load->view("index",$msg);
		}
		else
		{
		if($result['result']['role_priority']<2)
			{
			$result['project']=$this->user_model->get_details("project");	
     		$result['employee']=$this->user_model->user_list();		
			$result['employer']=$this->user_model->get_details("employer");
			$result['task_report']=$this->user_model->get_assign_details();
			$this->load->view("current_user_details",$result);
			}
			else
			{
			$result['your_report']=$this->user_model->your_assign_details();	
			//$this->load->view("excel_reoprt",$result);
			$this->load->view("current_user_details",$result);
			}
		}
	}
	
	public function view_details()
	{
     	if(!$this->is_logged_in())
		{ redirect("User_controller/index"); }
		else
		{
		$this->load->model('user_model');
		$detail["details"]=$this->user_model->view_details($this->uri->segment(3));
		$this->load->view("view_details",$detail);
		}
	}
	
	public function edit_form()
	{
		if(!$this->is_logged_in())
		{
			 redirect("User_controller/index","refresh"); 
		}
		else{
		$this->load->model('user_model');
		$detail["details"]=$this->user_model->view_details($this->uri->segment(3));
		$this->load->view("edit_form",$detail);
		}
	}
	
	public function logout()
	{
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Content-Type: application/xml; charset=utf-8");
		$this->load->library('session');
		$this->session->unset_userdata(array("user_id"=>'',"fname"=>''));
		$this->session->unset_userdata("lname");
		$this->session->unset_userdata("username");
		$this->session->unset_userdata("role_priority");
		$this->session->sess_destroy();
		redirect("user_controller/index","refresh");
	
	}
	
	public function change_password()
	{
     	if(!$this->is_logged_in())
		{ redirect("user_controller/index"); }
		else
		{
		$c_name=$this->input->post("c_name");	
		$n_name=$this->input->post("n_name");
		$cn_name=$this->input->post("cn_name");		
			if(strcmp($c_name,$this->session->userdata("password")))
			{
				if(!strcmp($n_name,$cn_name))
				{
					$this->user_model->change_password();
					echo "<b style='color:#00ff00;'>Password Successfully Changed</b>";	
					
				}	
				else
				{
					echo "<b style='color:#ff0000;'>New password and confirm password are not match</b>";		
				}
			}
			else
			{
			echo "<b style='color:#ff0000;'>Current Password Wrong Entered</b>";	
			}
		}
	}
	
	public function status_reply(){	
	$result['project']=$this->user_model->get_details("project");	
	$result['employee']=$this->user_model->user_list();		
	$result['employer']=$this->user_model->get_details("employer");
	//$result['task_report']=$this->user_model->get_assign_details($status);	
	$result['task_report']=$this->user_model->get_pending_details();
	$this->load->view("current_user_details",$result);	
	}
	
	public function show_project_list(){
	$result['project']=$this->user_model->get_details("project");	
	$result['employee']=$this->user_model->user_list();		
	$result['employer']=$this->user_model->get_details("employer");
	$result['task_report']=$this->user_model->get_assign_details();	
	$result['pending_report']=$this->user_model->get_pending_details();
	$this->load->view("show_project_list",$result);	
	}
	
	public function show_employer_list(){
	$result['project']=$this->user_model->get_details("project");	
	$result['employee']=$this->user_model->user_list();		
	$result['employer']=$this->user_model->get_details("employer");
	$result['task_report']=$this->user_model->get_assign_details();	
	$result['pending_report']=$this->user_model->get_pending_details();
	$this->load->view("show_employer_list",$result);	
	}
	
	public function show_user_list(){
	$result['project']=$this->user_model->get_details("project");	
	$result['employee']=$this->user_model->user_list();		
	$result['employer']=$this->user_model->get_details("employer");
	$result['task_report']=$this->user_model->get_assign_details();	
	$result['pending_report']=$this->user_model->get_pending_details();
	$this->load->view("show_user_list",$result);	
	}
	
	public function assign(){
		
		$result["assign"]=$this->user_model->assign();
		if(isset($result['assign'])){
			$emp_name=strtoupper($this->input->post("emp_name"));
			$result['message']="<b style='color:#00ff00;'>New task suceesfully assign to $emp_name</b>";
		
		}
		else{
			$result['message']="<b style='color:red;'>Task could not be assigned</b>";
			}
			//var_dump($result);exit();
		$result['project']=$this->user_model->get_details("project");	
     	$result['employee']=$this->user_model->user_list();		
		$result['employer']=$this->user_model->get_details("employer");
		$result['task_report']=$this->user_model->get_assign_details();	
		$this->load->view("current_user_details",$result);	
		}
		
	public function project_add($table){
		$this->user_model->add_details($table);
		$result['project']=$this->user_model->get_details("project");	
		$result['employee']=$this->user_model->user_list();		
		$result['employer']=$this->user_model->get_details("employer");	
		if($this->input->post("projectname"))
		{
			$pname=$this->input->post("projectname");
			$result['message']="<b style='color:#00ff00;'>New Project  $pname  successfully Added</b>";
			$result['task_report']=$this->user_model->get_assign_details();
		$empl_name=$this->input->post('empl_name');
		$this->load->view("show_project_list",$result);
		}
		elseif($this->input->post("empl_name"))
		{
			$empl_name=$this->input->post("empl_name");
			$result['message']="<b style='color:#00ff00;'>New Employer  $empl_name  successfully Added</b>";
			$result['task_report']=$this->user_model->get_assign_details();
			$empl_name=$this->input->post('empl_name');
			$this->load->view("show_employer_list",$result);
		}
		
		}	
		
	public function user_response(){
		//var_dump($_REQUEST);exit();
		$this->user_model->user_response();
		$result['your_report']=$this->user_model->your_assign_details();	
		//$this->load->view("excel_reoprt",$result);
		$result["result"]=$this->user_model->current_user();
		$this->load->view("current_user_details",$result);
		
	}
	
	public function fetch_username(){
		$id=$this->input->post("id");
		$this->db->select("fname,lname");	
		$this->db->where("user_id",$id);
		$query=$this->db->get("user");
		$a= $query->row_array();
		echo $a["fname"]." ".$a["lname"];	
	}
	
	public function delete($table,$id)
	{
		$this->user_model->delete($table,$id);
		if($table=="employer")
		redirect("user_controller/show_employer_list","refresh");
		else
		redirect("user_controller/show_project_list","refresh");
	}
	
	public function is_logged_in() {
        $uid = $this->session->userdata('user_id');
        if (!empty($uid))
            return TRUE;
        else
            return FALSE;
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */