<?php 
include('connect.php');
$current_user_id;
$current_user;
$formphps = array();
if(basename($_SERVER['PHP_SELF'])!="login.php")
{
    if(!isset($_SESSION)) {
        session_start();
   }
   if(!isset( $_SESSION['user_id']))
   {
    header("Location: login.php");
    exit;
   }
  $current_user_id = $_SESSION['user_id'];
  $current_file_name = basename($_SERVER['PHP_SELF']);
 $prosql = "SELECT * FROM FSbNJe9_user_data WHERE user_id = $current_user_id";
 $result = $conn->query($prosql);
 $current_user = $result->fetch_assoc();
 $current_user_name = $current_user['first_name']." ".$current_user['last_name'];
$current_user_sign = $current_user['signature_img'];
$current_user_role = $current_user['role'];
$param_pat_det;
$param_pat_visit_det;
$user_id;
$visit_id;
$formphps = array();
$fpsql= "SELECT php_code_file FROM forms";
$rfpforms = $conn->query($fpsql);
if ($rfpforms) {
    // Fetch each row and extract the first name
    while ($row = $rfpforms->fetch_assoc()) {
      $formphps[] = $row['php_code_file'];
    }}
$formeditable;
if(isset($_GET['visit'])){
    $visit_id2 = $_GET['visit'];
$vissql2 = "SELECT * FROM visits WHERE visit_id = ?";
    $stmtpatvisdet2 = $conn->prepare($vissql2);
$stmtpatvisdet2->bind_param("i",$visit_id2);
if (!$stmtpatvisdet2->execute()) {
    die("Error: " . $stmtpatvisdet2->error);
  }
$resultpatvisdet2 = $stmtpatvisdet2->get_result();
$param_pat_visit_det2 = $resultpatvisdet2->fetch_assoc();
$formeditable = $param_pat_visit_det2['staff_editable'];
}
$csql = "SELECT * FROM super_constants WHERE const_id = 1";
$sup_role_row = $conn->query($csql)->fetch_assoc();
$sup_roles = explode(",", $sup_role_row['value']);
$tsql = "SELECT * FROM forms WHERE php_code_file=?";
$tstmt = $conn->prepare($tsql);
$tstmt->bind_param("s",$current_file_name);
if (!$tstmt->execute()) {
    die("Error: " . $tstmt->error);
}
$tresult = $tstmt->get_result();
$table = $tresult->fetch_assoc();
if($tresult->num_rows > 0){
    $table_id = $table['form_id'];
    $table_name = $table['table_name'];
    $primary_key = $table['primary_key'];
$table_submit_roles = explode(",", $table['submit_perm_roles']);
$table_mod_roles = explode(",", $table['mod_roles']);
}
 if($current_user['role']!="superadmin" && $current_user['role']!="Nurse" && $current_user['role']!="Doctor" && $current_user['role']!="Admin" && $current_user['role']!="Receptionist")
 {
    header("Location: login.php");
 }
}
?>