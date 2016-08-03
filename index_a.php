<?php
	error_reporting(E_ALL);
	ini_set('display_errors',1);
	require_once('data_function.php');

	if (class_exists('dbclass')) 
		{
		   $dbclss = new dbclass();
		}
		else
		{
			echo "NO dbclss";
		}
		
		$select_result= $dbclss->select();
		
		/*
		if(isset($_POST['row_id']))
		{
			$update_result= $dbclss->update_data($_POST,$_POST['row_id'],'manoj_tb');
		}
*/		
?>	

<html>
	<head></head>
	<title>Grid View
	</title>
	<body>
			<form id="fm1" method="POST">
				<table border="1">
					<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Designation</th>
						<th>Date Of Joining</th>
						<th>Action</th>
					<tr>	
					</thead>
					
					<tbody>
					<?php
					for($i=0;$i<count($select_result);$i++)
					{
			
					?>
						<tr>
							
						<td><?php echo $select_result[$i]['id'];?></td>
						<td id="name_<?php echo $select_result[$i]['id'];?>"><?php echo $select_result[$i]['name'];?></td>
						<td id="desig_<?php echo $select_result[$i]['id'];?>"><?php echo $select_result[$i]['desig'];?></td>
						<td id="doj_<?php echo $select_result[$i]['id'];?>"><?php echo  $new_date = date("d-m-Y", strtotime($select_result[$i]['doj']));?></td>
						<td id="edit_<?php echo $select_result[$i]['id'];?>"> <label style="color:cyan;cursor:pointer;" onclick="edit('<?php echo $select_result[$i]['id'];?>')">EDIT</label></td>
						</tr>
					<?php	
					}
					?>	
					<input type="hidden" id="row_id" name="row_id" />
					</tbody>
				</table>
			</form>
	</body>
</html>

<script type="text/javascript">
	function edit(id)
	{
		
		
		if(id>0)
		{
			document.getElementById("name_"+id).innerHTML = '<input type="text" name="name_data" value="'+document.getElementById("name_"+id).innerHTML+'"'+'>';
			document.getElementById("desig_"+id).innerHTML = '<input type="text" name="desig_data" value="'+document.getElementById("desig_"+id).innerHTML+'"'+'>';
			document.getElementById("doj_"+id).innerHTML = '<input type="text" name="doj_data" value="'+document.getElementById("doj_"+id).innerHTML+'"'+'>';
			document.getElementById("edit_"+id).innerHTML ='<label style="color:cyan;cursor:pointer;" onclick="save('+id+')">SAVE</label>';
		}
	}
	
	function save(new_id)
	{
		
		document.getElementById("row_id").value=new_id;
		document.getElementById("fm1").submit();		
	}
</script>