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
		$Server_request = $_REQUEST['request'];
		
		
		switch($Server_request)  {
    case 'insert_user' :
					$create_data = json_decode(file_get_contents("php://input"));
					$parameter=array();	
					$parameter['id'] = NULL;
					$parameter['name']  =   $create_data->create_user_name;
					$parameter['desig'] =   $create_data->create_user_desig;
					$parameter['doj']   =   $create_data->create_user_doj;	
				
					$select_result= $dbclss->insert($parameter);
					print_r($select_result);
				
				break;

    case 'get_users' :
					$select_result= $dbclss->select();
					print_r($select_result);
				break;

    case 'view_user' :
					$data = json_decode(file_get_contents("php://input")); 
					$request_id      = $data->prod_index;   
					$select_result= $dbclss->select_per_id($request_id);
					print_r($select_result);
				break;
				
				
	 case 'update_user' :              
					$update_data = json_decode(file_get_contents("php://input")); 
				    $user_id    =   $update_data->id; 
					$parameter=array();	
					$parameter['name_data']  =   $update_data->user_name;
					$parameter['desig_data'] =   $update_data->desig;
					$parameter['doj_data']   =   $update_data->doj;
					
					$select_result= $dbclss->update_data($parameter,$user_id );
				break;  
			
			
    case 'delete_user' :
					$data = json_decode(file_get_contents("php://input")); 
					$request_id  = $data->prod_index;
					$select_result= $dbclss->delete_data($request_id);
				
            break;  
			
	 		
}


/********************
		if($Server_request=='all')
		{
			echo $select_result= $dbclss->select();
			
		}else if($Server_request=='per_id')
		{
				 $request_id = $_REQUEST['request_id'];
			echo $select_result= $dbclss->select_per_id($request_id);
		}
		else if($Server_request=='save_user')
		{
			
			print_r($_POST);
			exit;
			//$select_result= $dbclss->update_data();
		}
		
	******************/	
		
		//echo "<pre>";
		//echo $select_result;
		//echo "</pre>";
		//var_dump($select_result);
		
		/*
		if(isset($_POST['row_id']))
		{
			$update_result= $dbclss->update_data($_POST,$_POST['row_id'],'manoj_tb');
		}
*/		
?>	
