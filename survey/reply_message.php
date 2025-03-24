<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM contact where ID = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'new_message.php';
?>