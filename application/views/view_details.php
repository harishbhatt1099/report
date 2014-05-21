<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../css/style.css" rel="stylesheet" type="text/css" />
<title><?php $tit=strtoupper($details[0]["fname"]);
			 $tit2=strtoupper($details[0]["lname"]);	
				echo $tit."&nbsp;".$tit2;?></title>
</head>

<body onload="setTimeout('window.close()',5000)">
<table width="274" border="1" style="text-transform:capitalize;color:#FFF;background-color:#999; padding:10px;">
<?php foreach($details as $detail)
{?>
	<tr><td scope="rows" style="font-weight:bold;">Role</th><td><?php echo $detail["role_name"];?></td>  </tr>  
    <tr><td scope="rows" style="font-weight:bold;">First Name</th><td><?php echo $detail["fname"];?></td>  </tr>  
    <tr><td scope="rows" style="font-weight:bold;">Last Name</th><td><?php echo $detail["lname"];?></td>  </tr>
    <tr><td scope="rows" style="font-weight:bold;">Date Of Birth</th><td><?php echo $detail["dob"];?></td>  </tr>
    <tr><td scope="rows" style="font-weight:bold;">Address</th><td><?php echo $detail["address"];?></td>  </tr>
    <tr><td scope="rows" style="font-weight:bold;">phone</th><td><?php echo $detail["phone"];?></td>  </tr>  
    <tr><td scope="rows" style="font-weight:bold;">Email</th><td><?php echo $detail["email"];?></td>  </tr>
    <tr><td scope="rows" style="font-weight:bold;">User Name</th><td><?php echo $detail["username"];?></td>  </tr>
<?php }?>    
</table>
<!--<?php var_dump($details);?>-->
</body>
</html>