<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit for <?php if(isset($details)) echo $details[0]['fname']."&nbsp;".$details[0]['lname']; ?></title>
<script type="text/javascript">
if(<?php if(isset($details)) echo $details[0]['role_id'];?><2)
{
	alert("Bye Bye It was nice try");
	window.close();
}
/* 	
	   if(<?php $this->session->userdata("role_priority") < $user_list[$i]["role_priority"]?>)
	   { 
	    alert("You have no authority to access");
	  	window.close();
	   }*/
</script>
</head>
<body>

<form action="<?php echo site_url();?>user_controller/register" method="post">
<table width="307" border="0" style="background-color:#00EC3C; padding:10px; margin-top:100px;" align="center">
<?php foreach($details as $detail) { ?>
    <?php if($this->session->userdata("role_priority")==1) {?>
    <tr>
    <td>Role</td>
    <td>
    <select name="role_priority" id="role_priority">
    <option value="3" <?php if($detail['role_name']=='guest') echo 'selected=selected';  ?>>Guest</option>
    <option value="2" <?php if($detail['role_name']=='manager') echo 'selected=selected'; ?>>Manager</option></select>
    <input type="hidden" name="role_id" id="role_id" value="<?php if(isset($details)) echo $detail['role_id'];?>" />
    </td>
  	</tr><?php }?>
    <tr>
    <td>First Name</td>
    <td><input type="text" name="fname" value="<?php if(isset($details)) echo $detail['fname']; ?>" id="fname" required />
    	<input type="hidden" name="user_id" value="<?php if(isset($details)) echo $detail['user_id']; ?>" id="user_id" required /></td>
  	</tr>
    <tr>
    <td>Last Name</td>
    <td><input type="text" name="lname" value="<?php if(isset($details)) echo $detail['lname']; ?>" id="lname" required/></td>
  	</tr>
    <tr>
    <td>Date of Birth</td>
    <td><input type="text" name="dob" value="<?php if(isset($details)) echo $detail['dob']; ?>" id="dob" required/></td>
  	</tr>
    <tr>
    <td>Address</td>
    <td><input type="text" name="address" value="<?php if(isset($details)) echo $detail['address']; ?>" id="address" required/></td>
  	</tr>
    <tr>
    <td>Phone</td>
    <td><input type="text" name="phone" value="<?php if(isset($details)) echo $detail['phone']; ?>" id="phone" required maxlength="10" /></td>
  	</tr>
    <tr>
    <td>Email</td>
    <td><input type="text" name="email" value="<?php if(isset($details)) echo $detail['email']; ?>" id="email" required /></td>
  	</tr>
    <tr>
    <td>User Name</td>
    <td><input type="text" name="username" value="<?php if(isset($details)) echo $detail['username']; ?>" id="username"  required/></td>
  	</tr>
    <tr>
    <td><input type="submit" onclick="setTimeout(window.close(),2000);" name="edit" value="Edit" id="edit" />
    	<input type="button" onclick="window.close();" name="cancel" id="cancel" value="Cancel" />
    </td>
  	</tr>
    <?php }?>
</table>
</form>
<!--<?php var_dump($details);?>-->
</body>
</html>