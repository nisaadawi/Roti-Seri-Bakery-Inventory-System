<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(fullname) as name FROM users where email = '".$email."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}

	function save_user()
{
    extract($_POST);
    $data = "";
    foreach ($_POST as $k => $v) {
        if (!in_array($k, array('id', 'cpass')) && !is_numeric($k)) {
            if ($k =='password') {
                $v = md5($v);
            }
            if (empty($data)) {
                $data .= " $k='$v' ";
            } else {
                $data .= ", $k='$v' ";
            }
        }
    }

    if (empty($id)) {
        $save = $this->db->query("INSERT INTO users SET $data");
    } else {
        $save = $this->db->query("UPDATE users SET $data WHERE id = $id");
    }

    if ($save) {
        return 1;
    }
}

	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function delete_message(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM contact where ID = ".$id);
		if($delete)
			return 1;
	}
	function delete_categories(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM categories where id = ".$id);
		if($delete)
			return 1;
	}
	function save_page_img(){
		extract($_POST);
		if($_FILES['img']['tmp_name'] != ''){
				$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
				$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
				if($move){
					$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
					$hostName = $_SERVER['HTTP_HOST'];
						$path =explode('/',$_SERVER['PHP_SELF']);
						$currentPath = '/'.$path[1]; 
   						 // $pathInfo = pathinfo($currentPath); 

					return json_encode(array('link'=>$protocol.'://'.$hostName.$currentPath.'/admin/assets/uploads/'.$fname));

				}
		}
	}
	function save_categories(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO categories set $data");
		}else{
			$save = $this->db->query("UPDATE categories set $data where id = $id");
		}

		if($save)
			return 1;
	}

	function save_survey(){
		extract($_POST);
		$respondent_list = implode(',', $respondent);
		$data = "respondent='$respondent_list', ";
		foreach($_POST as $k => $v){
		  if(!in_array($k, array('id', 'respondent')) && !is_numeric($k)){
			$data .= "$k='$v', ";
		  }
		}
		$data = rtrim($data, ', ');
	  
		if(empty($id)){
		  $save = $this->db->query("INSERT INTO survey_set set $data");
		} else {
		  $save = $this->db->query("UPDATE survey_set set $data where id = $id");
		}
	  
		if($save){
		  return 1;
		}
	  }
	  
	function delete_survey(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM survey_set where id = ".$id);
		if($delete){
			return 1;
		}
	}
	
	function save_question(){
		extract($_POST);
			$data = " survey_id=$sid ";
			$data .= ", question='$question' ";
			$data .= ", instruction='$instruction' ";
			$data .= ", type='$type' ";
			if($type != 'textfield_s'){
				$arr = array();
				foreach ($label as $k => $v) {
					$i = 0 ;
					while($i == 0){
						$k = substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
						if(!isset($arr[$k]))
							$i = 1;
					}
					$arr[$k] = $v;
				}
			$data .= ", frm_option='".json_encode($arr)."' ";
			}else{
			$data .= ", frm_option='' ";
			}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO questions set $data");
		}else{
			$save = $this->db->query("UPDATE questions set $data where id = $id");
		}

		if($save)
			return 1;
	}
	function delete_question(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM questions where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function action_update_qsort(){
		extract($_POST);
		$i = 0;
		foreach($qid as $k => $v){
			$i++;
			$update[] = $this->db->query("UPDATE questions set order_by = $i where id = $v");
		}
		if(isset($update))
			return 1;
	}
	function save_answer(){
		extract($_POST);
			foreach($qid as $k => $v){
				$data = " survey_id=$survey_id ";
				$data .= ", question_id='$qid[$k]' ";
				$data .= ", user_id='{$_SESSION['login_id']}' ";
				if($type[$k] == 'check_opt'){
					$data .= ", answer='[".implode("],[",$answer[$k])."]' ";
				}else{
					$data .= ", answer='$answer[$k]' ";
				}
				$save[] = $this->db->query("INSERT INTO answers set $data");
			}
					

		if(isset($save))
			return 1;
	}
	function delete_comment(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM comments where id = ".$id);
		if($delete){
			return 1;
		}
	}

	//new codes inventory starts here
	function delete_ingredient()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM ingredients where id = " .
			$id);
		if ($delete)
			return 1;
	}
	function save_ingredient() {
		extract($_POST);
	
		// Sanitize input values
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id')) && !is_numeric($k)) {
				$_POST[$k] = htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
			}
		}
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO ingredients SET $data");
		} else {
			$save = $this->db->query("UPDATE ingredients SET $data WHERE id = $id");
		}
		if ($save) {
			return 1;
		} else {
			return $this->db->error;
		}
	}
	function save_tracking()
	{
		// Extract the $_POST data
		extract($_POST);

		// Validate and sanitize input
		$id = isset($id) ? intval($id) : null;
		$track_status = isset($track_status) ? $this->db->real_escape_string($track_status) : null;
		$ingredient_code = isset($ingredient_code) ? $this->db->real_escape_string($ingredient_code) : null;

		// Fetch the ingredient details from the ingredients table
		if ($id) {
			$query = "SELECT ingredient_name, current_quantity FROM ingredients WHERE id = '$id'";
			$result = $this->db->query($query);

			if ($result && $result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$ingredient_name = $row['ingredient_name'];
				$current_quantity = $row['current_quantity'];
			} else {
				// Return failure if ingredient_code is invalid
				return json_encode(['status' => 0, 'message' => 'Invalid ingredient code.']);
			}
		}

		$supplier_detail = isset($supplier_detail) ? $this->db->real_escape_string($supplier_detail) : null;

		// Default values for quantity_in and quantity_out
		$quantity_in = isset($quantity_in) ? intval($quantity_in) : 0;
		$quantity_out = isset($quantity_out) ? intval($quantity_out) : 0;

		// Ensure date values are properly formatted (YYYY-MM-DD)
		$date_in = isset($date_in) ? date('Y-m-d', strtotime($date_in)) : null;
		$date_out = isset($date_out) ? date('Y-m-d', strtotime($date_out)) : null;

		// Adjust quantities based on status
		if ($track_status == 'IN') {
			$quantity_out = null;
			$date_out = null;
			$current_quantity += $quantity_in; // Add quantity_in to current_quantity
		} elseif ($track_status == 'OUT') {
			$quantity_in = null;
			$date_in = null;
			if ($quantity_out > $current_quantity) {
				// Check if quantity_out exceeds available stock
				return json_encode(['status' => 0, 'message' => 'Quantity out exceeds current stock.']);
			}
			$current_quantity -= $quantity_out; // Subtract quantity_out from current_quantity
		}

		$description = isset($description) ? $this->db->real_escape_string($description) : null;

		// Prepare data for insertion or update
		$data = "
			track_status = '$track_status',
			ingredient_code = '$ingredient_code',
			ingredient_name = '$ingredient_name',
			supplier_detail = '$supplier_detail',
			quantity_in = " . ($quantity_in !== null ? $quantity_in : 'NULL') . ",
			date_in = " . ($date_in !== null ? "'$date_in'" : 'NULL') . ",
			quantity_out = " . ($quantity_out !== null ? $quantity_out : 'NULL') . ",
			date_out = " . ($date_out !== null ? "'$date_out'" : 'NULL') . ",
			description = " . ($description ? "'$description'" : 'NULL') . "
		";

		if (empty($out_id)) {
			$query = "INSERT INTO in_out_tracking SET $data";
		} else {
			$query = "UPDATE in_out_tracking SET $data WHERE id = $out_id";
		}

		// Execute the tracking query
		if ($this->db->query($query)) {
			// Update the current_quantity in the ingredients table
			$updateIngredientsQuery = "UPDATE ingredients SET current_quantity = $current_quantity WHERE id = $id";
			if ($this->db->query($updateIngredientsQuery)) {
				// Check if current_quantity is 0 and delete from stock table
				if ($current_quantity == 0) {
					$deleteStockQuery = "DELETE FROM ingredients WHERE id = $id";
					if ($this->db->query($deleteStockQuery)) {
						return json_encode(['status' => 1, 'message' => 'Data successfully saved, stock updated, and stock record deleted.']);
					} else {
						return json_encode(['status' => 0, 'message' => 'Failed to delete stock record. Error: ' . $this->db->error]);
					}
				}
				return json_encode(['status' => 1, 'message' => 'Data successfully saved and stock updated.']);
			} else {
				return json_encode(['status' => 0, 'message' => 'Failed to update ingredient stock. Error: ' . $this->db->error]);
			}
		} else {
			return json_encode(['status' => 0, 'message' => 'Failed to save tracking data. Error: ' . $this->db->error]);
		}
	}

	function delete_tracking()
	{
		extract($_POST);
		$out_id = intval($out_id); // Ensure the ID is an integer
		$delete = $this->db->query("DELETE FROM in_out_tracking WHERE out_id = $out_id");
		if ($delete) {
			return json_encode(['status' => 1, 'message' => 'Tracking data successfully deleted.']);
		} else {
			return json_encode(['status' => 0, 'message' => 'Failed to delete tracking data.']);
		}
	}
}