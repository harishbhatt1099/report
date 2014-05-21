 <script type="text/javascript">
$(document).on('change','#status1',function(){
  $("#stsu").submit();
});
 </script> 
  <?php if($this->session->userdata("role_priority")>1)
  {
  ?>
<span id="msg" style="margin-left:720px;">&nbsp;</span>
<table width="925" border="1">
  <caption>
    Your Task
  </caption>
  <tr>
    <th width="111" height="47" scope="col">Project Name</th>
    <th width="82" scope="col">Task</th>
    <th width="77" scope="col">Start</th>
    <th width="95" scope="col">End</th>
    <th width="77" scope="col">Assign By</th>
    <th width="110" scope="col">Assign To</th>
    <th width="81" scope="col">Remark</th>
    <th width="80" scope="col">Prioroty</th>
    <th width="154" scope="col">Action</th>
  </tr>
  <?php    
  foreach($your_report as $row){ 
  ?> 
  <tr>
    <td><?php echo $row["project_name"]; ?></td>
	<td><?php echo $row["task"]; ?></td>
    <td><?php $date=explode("-",$row["start_date"]); echo $date[2]."-".$date[1]."-".$date[0]; ?></td>
    <td><?php $date=explode("-",$row["end_date"]); echo $date[2]."-".$date[1]."-".$date[0]; ?></td>
    <td><?php echo $row["assign_by"]; ?></td>
    <td><?php echo $row["fname"]."&nbsp;".$row['lname']; ?></td>
    <td><?php echo $row["remark"]; ?></td>
    <td><?php echo $row["priority"]; ?></td> 
    <td> 
    <form action="<?php echo site_url().'user_controller/user_response';?>" method="post" >
    <input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>" />
    <?php if($row["status"]=="pending"){?>
    <select name="action" required id="action">
    <option value="" >Pending</option>
    <option  value="complete">Complete</option>
    </select>
    
    <input type="submit" name="submit" id="submit" value="Reply" />
    </form>
    <?php }else{ ?>
    <span style="color:#0C0">Done</span><?php } ?> 
    
     </td> 
  </tr>
  <?php } ?>
</table>
<?php /*?><?php var_dump($your_report);?><?php */?>

<?php }else{ ?>
<div style="margin:0px 0xp 0xp 0px;">
        <form action="<?php echo site_url().'user_controller/status_reply';?>" method="post" id="stsu">
  		<select name="status1" id="status1" class="reg_input" required>
    	<option value="">View According Status</option>
        <option value="pending ">Pending</option>
        <option value="assign">Assign</option>
        <option value="complete">Completed</option>        
        <option value="awaiting client response">Awaiting Client Response</option>  
        <input type="submit" style="display:none" name="status2" id="status2" value="submit" />      
        </select></form>
        </div>  
<span id="admin_msg" style="margin-left:180px; display:none;">&nbsp;</span>
<table width="1004" border="0" id="task_report_admin" cellspacing="5px" cellpadding="5px">
  <caption style="font-size:20px; color:#75FFFF;">
   Current Task Report
  </caption>  		
  <tr>
   <th width="168" height="47" scope="col">Project Name</th>
    <th width="138" scope="col">Task</th>
    <th width="122" scope="col">Start</th>
    <th width="121" scope="col">End</th>
    <th width="154" scope="col">Assign By</th>
    <th width="175" scope="col">Assign To</th>
    <th width="95" scope="col">Remark</th>
    <th width="69" scope="col">Prioroty</th>
    <th width="69" scope="col">status</th>
  </tr>
  <?php foreach($task_report as $row){ ?>
  <tr>
    <td><?php echo $row["project_name"]; ?></td>
	<td><?php echo $row["task"]; ?></td>
    <td><?php $date=explode("-",$row["start_date"]); 	echo $date[2]."-".$date[1]."-".$date[0]; ?></td>
    <td><?php $date=explode("-",$row["end_date"]); 	echo $date[2]."-".$date[1]."-".$date[0]; ?></td>
    <td><?php echo $row["assign_by"]; ?></td>
    <td><?php echo $row["fname"]."&nbsp;".$row['lname']; ?></td>
    <td><?php echo $row["remark"]; ?></td>
    <td><?php echo $row["priority"]; ?></td>  
	<?php if($row["status"]=="pending") {?>
    <td style=" background-color:#F00;"><?php echo $row["status"]; ?></td> 
    <?php }else {?>   
    <td style=" background-color:#008000;"><?php echo $row["status"]; ?></td> 
    <?php } ?>   
  </tr>
  <?php } ?>
</table>
<?php } //var_dump($task_report); ?>


