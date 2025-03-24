<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
    $login = $crud->login();
    if($login)
        echo $login;
}
if($action == 'logout'){
    $logout = $crud->logout();
    if($logout)
        echo $logout;
}
if($action == 'save_user'){
    $save = $crud->save_user();
    if($save)
        echo $save;
}
if($action == 'save_page_img'){
    $save = $crud->save_page_img();
    if($save)
        echo $save;
}
if($action == 'delete_user'){
    $save = $crud->delete_user();
    if($save)
        echo $save;
}
if($action == 'delete_message'){
    $save = $crud->delete_message();
    if($save)
        echo $save;
}
if($action == "save_categories"){
    $save = $crud->save_categories();
    if($save)
        echo $save;
}
if($action == 'delete_categories'){
    $save = $crud->delete_categories();
    if($save)
        echo $save;
}
if($action == "save_survey"){
    $save = $crud->save_survey();
    if($save)
        echo $save;
}
if($action == "delete_survey"){
    $delete = $crud->delete_survey();
    if($delete)
        echo $delete;
}
if($action == "save_question"){
    $save = $crud->save_question();
    if($save)
        echo $save;
}
if($action == "delete_question"){
    $delsete = $crud->delete_question();
    if($delsete)
        echo $delsete;
}


if($action == "action_update_qsort"){
    $save = $crud->action_update_qsort();
    if($save)
        echo $save;
}
if($action == "save_answer"){
    $save = $crud->save_answer();
    if($save)
        echo $save;
}
if($action == "update_user"){
    $save = $crud->update_user();
    if($save)
        echo $save;
}

//new codes inventory starts here
if ($action == "save_ingredient") {
	$save = $crud->save_ingredient();
	if ($save)
		echo $save;
}
if ($action == "delete_ingredient") {
	$save = $crud->delete_ingredient();
	if ($save)
		echo $save;
}
if ($action == "save_tracking") {
	$save = $crud->save_tracking();
	if ($save)
		echo $save;
}
if ($action == 'delete_tracking') {
	$save = $crud->delete_tracking();
	if ($save)
		echo $save;
}


if (isset($_GET['action']) && $_GET['action'] === 'fetch_top_products') {
    include 'db_connect.php';


    $query = "SELECT product_name, SUM(sales) as total_sales
              FROM sales
              GROUP BY product_name
              ORDER BY total_sales DESC
              LIMIT 5";


    $result = $conn->query($query);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data['product_names'][] = $row['product_name'];
        $data['sales'][] = $row['total_sales'];
    }
    echo json_encode($data);
    exit;
}


if ($_GET['action'] == 'fetch_ingredient_trends') {
    $ingredients = ['Flour', 'Sugar', 'Egg', 'Chocolate', 'Butter'];
    $ingredient_usage = [];
   
    foreach ($ingredients as $ingredient) {
        $qry = $conn->query("SELECT SUM(sales) as total_sales FROM sales WHERE product_name = '$ingredient'");
        $row = $qry->fetch_assoc();
        $ingredient_usage[] = $row['total_sales'];
    }


    echo json_encode([
        'ingredients' => $ingredients,
        'usage' => $ingredient_usage
    ]);
}


if ($action == 'upload_sales_file') {
    if (isset($_FILES['sales_file'])) {
        $file = $_FILES['sales_file']['tmp_name'];


        if (($handle = fopen($file, "r")) !== false) {
            $header = fgetcsv($handle, 1000, ",");
            $table_name = "sales_" . time(); // Example: dynamic table name
            $columns = array_map(function ($col) {
                return "`$col` VARCHAR(255)";
            }, $header);


            $create_table_query = "CREATE TABLE `$table_name` (" . implode(",", $columns) . ")";
            if ($conn->query($create_table_query)) {
                // Insert data into the newly created table
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    $placeholders = implode(",", array_fill(0, count($data), "?"));
                    $query = "INSERT INTO `$table_name` VALUES ($placeholders)";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param(str_repeat("s", count($data)), ...$data);
                    $stmt->execute();
                }
                echo 1;
            } else {
                echo 0;
            }
            fclose($handle);
        }
    }
}


ob_end_flush();
?>



