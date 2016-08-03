<?php
include_once("constant.php");
class dbclass
{
	
	public function dbclass() 
	{ 
		
		$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		if(!$conn) 
		{	$this->error("Connection attempt failed");}
		
		$this->conn = $conn;
		return true;		
	}
	
	public function insert($parameter)
	
	{
		$tablename = "manoj_tb";
		$conn = $this->conn;
		foreach ($parameter as $key => $value) 
		{
			switch(gettype($value)) 
			{
			  case 'integer':
			  case 'double':
				$escape = $value;
				$keys[] = $key;
				break;
			  case 'string':
				$escape = "'" . $conn->real_escape_string($value) . "'";
				$keys[] = $key;
				break;
			  case 'NULL':
				$escape = 'NULL';
				$keys[] = $key;
				break;
			  default:
				continue;
			}
				$params[] = $escape;
		}

			$key_string = implode(',', $keys);
			$value_string = implode(',', $params);
			$sql_insert="INSERT INTO {$tablename} ({$key_string}) VALUES ({$value_string})";
			
			$results = mysqli_query($conn, $sql_insert);	
			
			return $results;
			
	}
	
	
	public function select()
	{
		
		$conn = $this->conn;
		
		if(empty($this->conn)){	return false;}
				$sql="SELECT * from manoj_tb";
				$results = mysqli_query($conn, $sql);
				/*
				$count = 0;
				$data  = array();
			    while ( $row = mysqli_fetch_array($results))	
				{	
				$data[$count] = $row;
				$count++;		
				}
				$rec_array = array("records" => array($data));
		 
		 
				//$rec_array=$data;
				return json_encode($rec_array);
				
				*/
				
				$outp = "";
				while($row = mysqli_fetch_array($results)) 
				{
					if ($outp!= "") 
					{
						$outp.= ",";
					}
					$outp .= '{"id":"'. $row["id"].'",';
					$outp .= '"name":"'. $row["name"]. '",';
					$outp .= '"desig":"'. $row["desig"].'",';
					$outp .= '"doj":"'. $row["doj"].'"}'; 
				}
				$outp ='{"records":['.$outp.']}';


				return ($outp);
				
				
		 		
	}
	
	public function select_per_id($editid)
	{
		
		$conn = $this->conn;
		
		if(empty($this->conn)){	return false;}
				$sql="SELECT * from manoj_tb where id = $editid";
				
				$results = mysqli_query($conn, $sql);
				
				$count = 0;
				
			    while ( $row = mysqli_fetch_array($results))	
				{	
					$data[] = array(
                    "id"     => $row['id'],
                    "name"     => $row['name'],
                    "desig"     => $row['desig'],
                    "doj"    => $row['doj']
                   
                    );	
				}
				
				 return json_encode($data); 
				
				
				/*
				$outp = "";
				while($row = mysqli_fetch_array($results)) 
				{
					if ($outp!= "") 
					{
						$outp.= ",";
					}
					$outp .= '{"id":"'. $row["id"].'",';
					$outp .= '"name":"'. $row["name"]. '",';
					$outp .= '"desig":"'. $row["desig"].'",';
					$outp .= '"doj":"'. $row["doj"].'"}'; 
				}
				$outp ='{"editrecords":['.$outp.']}';


				return ($outp);
				*/
				
		 		
	}
	
	public function insert_data($fields,$table)
	{
			$conn = $this->conn;
			$insert_query=$this->insert($fields,$table);
			$results = mysql_query($insert_query,$conn);
			return $insert_query;
	}
	
	public function update_data($parameter,$id)
	{
			$tablename = "manoj_tb";
			$name = $parameter['name_data'];
			$desig = $parameter['desig_data'];
			$doj = $parameter['doj_data'];
			
			
			$conn= $this->conn;
			 $sql_update="UPDATE  {$tablename} SET name ='{$name}',desig='{$desig}',doj='{$doj}' where id = {$id}";			
			
			$results = mysqli_query($conn, $sql_update);	
			
			return $results;

	}
	
	public function delete_data($id)
	{
			$tablename = "manoj_tb";
			$conn= $this->conn;
			$sql_delete="DELETE FROM {$tablename}  where id = {$id}";			
			
			$results = mysqli_query($conn, $sql_delete);	
			
			return $results;

	}
	


	
	
}	