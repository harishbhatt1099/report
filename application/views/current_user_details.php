<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/redmond/jquery-ui.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.datetimepicker.css"/ >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/colorbox.css" /> 


<script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   <script src='<?php echo base_url(); ?>assets/js/jquery.colorbox.js'></script>
 
<script type="text/javascript">

  $(function() {
    $( "#datepicker" ).datepicker({ 
	dateFormat: 'dd/mm/yy',
	changeMonth : true,
    changeYear : true,	
	yearRange: '-100y:c+nn',
	maxDate: '-21Y'
	 });
	$('#assign_start_date').datepicker({ minDate: new Date(),
	dateFormat: 'dd/mm/yy',
	changeMonth : true,
    changeYear : true,		
	});
	/*if((new Date).getHours()>=12){
	var dn="PM":}
	else{
	var dn="AM";}*/
	
	/* $( "#assign_start_date" ).datepicker({ 
	dateFormat: 'dd/mm/yy',
	changeMonth : true,
    changeYear : true,	
	});*/
	$('#assign_end_date').datepicker({ minDate: new Date(),
	dateFormat: 'dd/mm/yy',
	changeMonth : true,
    changeYear : true,	
	});
	/* $( "#assign_end_date" ).datepicker({ 
	dateFormat: 'dd/mm/yy',
	changeMonth : true,
    changeYear : true,	
	});*/
	$("#current_user_detail").hide();
	$("#current_user").mouseleave(function(){
												$("#current_user_detail").hide("puff",1000);
  											});
	$("#current_user").click(function()   {
	   									   $("#current_user_detail").show("size",1000);
  											  });									
});
  </script>
 
<script type="text/javascript">
  function to_assign(val, base) {
        $.post(base + 'user_controller/fetch_username',
                {'id': val},
        function(data, status) {
            if (status == "success") {
                $('#emp_name').val(data);
            }
        });
    }
  </script>
  
<script type="text/javascript">
$(document).ready(function(){
$("#change_p").click(function(){
	if($("#c_pass").val()=="")
	{
	$("#c_pass").tooltip({ items: "#c_pass", content: "Please Enter Current Password"});
	$("#c_pass").tooltip("open");	
	$("#c_pass").focus();
	return false;
	}
	if($("#n_pass").val()=="")
	{
	$("#n_pass").tooltip({ items: "#n_pass", content: "Please Enter New Password" });
	$("#n_pass").tooltip("open");	
	$("#n_pass").focus();	
	return false;
	}
	if($("#cn_pass").val()=="")
	{
	$("#cn_pass").tooltip({ items: "#cn_pass", content: "Please Enter Confirm Password"});
	$("#cn_pass").tooltip("open");	
	$("#cn_pass").focus();	
	return false;
	}
	if($("#cn_pass").val()===$("#n_pass").val())
	{
	$.ajax({
	url:"<?=base_url().'user_controller/change_password'; ?>",
	method:"post",
	data:$("#formid").serialize(),
	beforeSend: function () {
		$('#cboxClose').click();
                    $('#overlay123').show();
                    },
	success:function(result){
	$('#overlay123').hide();
	$("#formid").find("input[type=password], textarea").val("");
	$("#div7").hide();
	$("#admin_msg").show();
	$("#admin_msg").html(result);  
	}
	}); 	
	 return false;
	}
	else
	{
	$("#cn_pass").tooltip({ items: "#cn_pass", content: "Confirm Password Not Match With New Password "});
	$("#cn_pass").tooltip("open");	
	$("#cn_pass").focus();
	return false;		
	}
	});
});
</script>  

 <style>
.overlay123{position: fixed;top: 0;left: 0;width: 100%;height:100%;background-color: #000;filter:alpha(opacity=50);-moz-opacity:0.5;-khtml-opacity:0.5;opacity: 0.5;z-index:10000;}
.overlay123 img{position:relative; top:50%;}
</style>

  <script>		$(document).ready(function(){
				$(".inline").colorbox({inline:true, width:"40%"});
				$(".inline2").colorbox({inline:true, width:"40%"});
				$(".inline3").colorbox({inline:true, width:"40%"});
				$(".inline5").colorbox({inline:true, width:"40%"});
				$(".inline6").colorbox({inline:true, width:"40%"});
				$(".inline7").colorbox({inline:true, width:"40%"});
			});
	</script>

<?php if(isset($msg)) echo $msg; ?>
</head>
<body bgcolor="#0066CC">
	<h3 style="text-transform:capitalize; text-indent:50px;">
		Welcome <br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->session->userdata("fname")."&nbsp;".$this->session->userdata("lname");?><br />
		&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=site_url();?>user_controller/home">Home</a>&nbsp; | &nbsp;<a href="<?=site_url();?>user_controller/logout" onclick="location.replace(this.href); return false;">Logout</a>
    </h3>
<div style='display:none' id="div7">
<div id='inline_content7' style='padding:10px; background:#fff;'>
<form  id="formid" method="post">
<table width="360" border="0" align="center">
  <caption style="font-size:32px; background-color:#000; color:#0F0; ">
  Change Password
  </caption><br />
  <tr>
    <td>Current Password</td>
    <td><input class="reg_input" type="password" name="c_pass" id="c_pass"  placeholder="Current Password" /></td>
  </tr>
  <tr>
    <td>New Password</td>
    <td><input class="reg_input" type="password" name="n_pass" id="n_pass" placeholder="New Password" /></td>
  </tr>
  <tr>
    <td>Confirm Password</td>
    <td><input class="reg_input" type="password" name="cn_pass" id="cn_pass" placeholder="Confirm Password" /></td>
  </tr>
   <tr>
    <td colspan="2"><input class="reg_input" type="submit" name="change_p" id="change_p" value="Change Password" /></td>
  </tr>
</table>
</form>
</div>
</div>    
<?php if($this->session->userdata("role_priority")>1){ ?>
<div style="float:right; margin:-102px 280px 0px 0px; padding:5px;">
<button > <a id="menu" class='inline7' href="#inline_content7">Change Password</a></button>
</div>
<div name="current_user" id="current_user" style="cursor:pointer;">My Details</div>
<div id="current_user_detail" >
    <table width="224" border="1">
        <tr>
            <td width="170">Email</td>
            <td width="38"><?php echo $result["email"];?></td>
          </tr>
          <tr>
            <td>First Name</td>
            <td><?php echo $result["fname"];?></td>
          </tr>
          <tr>
            <td>Last Name</td>
            <td><?php echo $result["lname"];?></td>
          </tr>
          <tr>
            <td>Date Of Birth</td>
            <td><?php echo $result["dob"];?></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><?php echo $result["address"];?></td>
          </tr>
          <tr>
            <td>Contact No.</td>
            <td><?php echo $result["phone"];?></td>
          </tr>
    </table>
</div>


<?php }else{ ?>
<?php if(isset($message)){ ?>
<script type="text/javascript">
$(document).ready(function(){
$('#admin_msg').show();
$('#admin_msg').html("<?php echo $message; ?>");
});
</script>
<?php } ?>

<div style="float:right; margin:-90px 50px 0px 0px; padding:5px;">
<button > <a id="menu" class='' name="abcd" href="<?=base_url().'user_controller/show_user_list'; ?>">User</a></button>
<button ><a id="menu" class='inline2' name="abcd" href="#inline_content2">Assign Task</a></button>
<button ><a id="menu" class='' name="abcd" href="<?=base_url().'user_controller/show_project_list'; ?>">Project</a></button>
<button ><a id="menu" class='' href="<?=base_url().'user_controller/show_employer_list'; ?>">Employer</a></button>
<button > <a id="menu" class='inline7' href="#inline_content7">Change Password</a></button>
</div>

<div style='display:none'>
<div id="inline_content" style='padding:10px; background:#fff;'>
<form action="<?php echo site_url()?>user_controller/register" method="post">
<table width="360" border="0" align="center" >
  <caption style="font-size:32px; background-color:#000; color:#0F0; ">
   Add New User Here
  </caption>
  <tr>
    <td>Enter User Name</td>
    <td><input class="reg_input" type="text" name="username" id="username" placeholder="User Name" required/></td>
  </tr>
  <tr>
    <td>Enter Password</td>
    <td><input class="reg_input" type="password" name="password" id="password" placeholder="Password" required/></td>
  </tr>
  <tr>
    <td width="168">Enter First Name</td>
    <td width="250"><input class="reg_input" type="text" name="fname" id="fname" placeholder="First Name" required /></td>
  </tr>
  <tr>
    <td>Enter Last Name</td>
    <td><input class="reg_input" type="text" name="lname" id="lname" placeholder="Last Name" required/></td>
  </tr>
  <tr>
    <td>Date of Birth</td>
    <td><input class="reg_input" type="text" name="dob" id="datepicker" placeholder="Date Of Birth"  required/></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><textarea class="reg_input" name="address" id="address" cols="23" placeholder="Address" required></textarea></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td><input class="reg_input" type="text" name="phone" id="phone" placeholder="Contact Number" maxlength="10" required/></td>
  </tr>
  <tr>
    <td>Enter Email</td>
    <td><input class="reg_input" type="email" name="email" id="email" placeholder="Email" required/></td>
  </tr>
  <tr>
    <td colspan="2"><input class="reg_input" type="submit" name="register" id="register" value="Add" /></td>
  </tr>
</table>
</form></div></div>

<div style='display:none'>
<div id='inline_content2' style='padding:10px; background:#fff;'>
<form action="<?php echo site_url()?>user_controller/assign" method="post">
<table width="360" border="0" align="center">
  <caption style="font-size:32px; background-color:#000; color:#0F0; ">
  Assign Task
  </caption>
  <tr>
    <td>Project Name</td>
    <td>
    <select name="project_name" id="project_name" class="reg_input" required>
    <option value="">Select Project</option>
    <?php foreach($project as $row){ ?>
    <option value="<?php echo $row['project_name']?>"><?php echo $row['project_name']?></option>
    <?php } ?>
    </select></td>
  </tr>
  <tr>
    <td>Task</td>
    <td><input class="reg_input" type="text" name="task" id="task" placeholder="Tast" required/></td>
  </tr>
  <tr>
    <td width="168">Start Date</td>
    <td width="250">

    <input class="reg_input" type="text" name="assign_start_date" id="assign_start_date" placeholder="Start Date" required /></td>
  </tr>
  <tr>
    <td>End Date</td>
    <td><input class="reg_input" type="text" name="assign_end_date" id="assign_end_date" placeholder="End Date" required/></td>
  </tr>
  <tr>
    <td>Assign By</td>
    <td>
    <select name="assign_by" id="assign_by" class="reg_input" required>
    <option value="" disabled="disabled">Select Employer</option>
    <?php foreach($employer as $row){ ?>
    <option value="<?php echo $row['employer_name']?>"><?php echo $row['employer_name']?></option>
    <?php } ?>
    </select>
   </td>
  </tr>
  <tr>
    <td>Assign TO</td>
    <td>
    <select name="assign_to" id="assign_to" class="reg_input" onchange="to_assign(this.value,'<?=site_url() ?>')" style="text-transform:capitalize;" required>
    <option value="" disabled="disabled">Select Employee</option>
    <?php foreach($employee as $row){ ?>
    <option value="<?php echo $row['user_id']?>"><?php echo $row['fname']."&nbsp;".$row['lname'];?></option>
     <?php } ?> </select>
    <input type="hidden" name="emp_name" id="emp_name" value="" />
  
    </td>
  </tr>
  <tr>
    <td>Remark</td>
    <td><textarea class="reg_input" type="text" name="remark" id="remark" placeholder="Remark" ></textarea></td>
  </tr>
   <tr>
    <td>Priority</td>
    <td><select name="priority" id="priority" class="reg_input" required>
    	<option value="">Select-Priority</option>
        <option value="low">Low</option>
        <option value="normal">Normal</option>
        <option value="high">High</option>        
        </select>
    </td>
  </tr>
   <tr>
    <td>Status</td>
    <td><select name="status" id="status" class="reg_input" required>
    	<option value="">Select-Status</option>
        <option value="pending">Pending</option>
        <option value="assign">Assign</option>
        <option value="awaiting client response">Awaiting Client Response</option>        
        </select>
    </td>
  </tr>
  <tr>
    <td colspan="2"><input class="reg_input" type="submit" name="register" id="register" value="Add" /></td>
  </tr>
</table>
</form>
</div>
</div>

<div style='display:none'>
<div id='inline_content3' style='padding:10px; background:#fff;'>
<form action="<?php echo site_url()?>user_controller/project_add/project" method="post">
<table width="360" border="0" align="center">
  <caption style="font-size:32px; background-color:#000; color:#0F0; ">
  Add New Project
  </caption><br />
  <tr>
    <td>Project Name</td>
    <td><input class="reg_input" type="text" name="projectname" id="projectname" placeholder="Project" required/></td>
  </tr>
   <tr>
    <td colspan="2"><input class="reg_input" type="submit" name="add_project" id="add_project" value="Add" /></td>
  </tr>
</table>
</form>
</div>
</div>

<div style='display:none'>
<div id='inline_content5' style='padding:10px; background:#fff;'>
<form action="<?php echo site_url()?>user_controller/project_add/employer" method="post">
<table width="360" border="0" align="center">
  <caption style="font-size:32px; background-color:#000; color:#0F0; ">
  Add Employer Name
  </caption><br />
  <tr>
    <td>Employer Name</td>
    <td><input class="reg_input" type="text" name="empl_name" id="empl_name" placeholder="Full Name" required/></td>
  </tr>
   <tr>
    <td colspan="2"><input class="reg_input" type="submit" name="add_project" id="add_project" value="Add" /></td>
  </tr>
</table>
</form>
</div>
</div>

<div style='display:none'>
<div id='inline_content6' style='padding:10px; background:#fff;'>
<!--<form action="<?php echo site_url()?>user_controller/project_add/employer" method="post">-->
<table border="1" align="center" style="text-transform:capitalize;">
<caption style="font-size:32px; background-color:#000; color:#0F0; ">
  User List
  </caption>
  <tr>
    <th scope="col" class="reg_input">S No.</th>
    <th scope="col" class="reg_input">Name</th>
    <th scope="col" class="reg_input">DOB</th>
    <th scope="col" class="reg_input">Phone</th>
  </tr>
 <?php $i=1; foreach($employee as $row){ ?>
  <tr align="center">
    <td class="reg_input"><?php echo $i; ?></td>
    <td class="reg_input"><?php echo $row['fname']." ".$row['lname']; ?></td>
    <td class="reg_input"><?php echo $row['dob']; ?></td>
    <td class="reg_input"><?php echo $row['phone']; ?></td>
  </tr>
 <?php $i++; } ?>
</table>

<!--</form>-->
</div>
</div>


<?php } ?>
<div>	
<?php $this->load->view("excel_reoprt"); ?>
</div>

 <div id="overlay123" style="display:none; text-align: center;" class="overlay123"><img src="<?=site_url()?>assets/images/ajax-loader.gif" width="50" height="50" /></div>
</body>
</html>
