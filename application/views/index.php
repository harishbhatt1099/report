<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({ 
	dateFormat: 'dd/mm/yy',
	changeMonth : true,
    changeYear : true,	
	yearRange: '-100y:c+nn',
	 });
  });
  </script>

</head>

<body><br />
<br />

		<form action="<?php echo site_url();?>user_controller/login_submit" method="post">
            <table width="305" border="0" align="center" style="background:#B1E2BC; padding:10px;">
            <caption style="color:#00F400; background-color:#000; font-size:24px;">User Login</caption>
              <tr>
                <td width="122" height="36">Enter User Name</td>
                <td width="167"><input type="text" name="username" id="username" required="required" placeholder="User Name" /></td>
              </tr>
              <tr>
                <td height="37">Enter Password</td>
                <td><input type="password" name="password" id="password" required="required" placeholder="Password"/></td>
              </tr>
              <tr>
                <td colspan="2"><input type="submit" name="login" id="lodin" value="Login" /></td>
              </tr>
          </form>
           <tr><td colspan="2"> 
        <?php if(isset($login_error))
		echo "<p align='center' style='color:red; weight:bold;'>".$login_error."</p>";		
		 ?>
</td></tr></table>
<?php if(isset($msg_success))
		{
		?>
        <script language="javascript">
		alert("Successfully Registred \n You can Login now");
		</script>
        <?php }?> 
</body>
</html>