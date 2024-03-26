<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Edit Visit");

$user_id;
$visit_id;
$doa="";
$dod="";
$rmno="";

if (isset($_POST['userid'])) {
    if ((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles) && !in_array($current_user_role,$table_mod_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles))))
  {
      header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=0");
      exit();
  }
    $user_id = $_POST['userid'];
    $visit_id = $_POST['visitid'];
    $date_of_adm = $_POST['dateofadmm'];
    $date_of_dis = $_POST['dateofdis'];
    $room_no = $_POST['roomno'];
    $edit_stat="No";
    $sql = "UPDATE visits SET staff_editable=?, date_of_admission=?,date_of_discharge=?,room_no=? WHERE visit_id=?";
    $stmt = $conn->prepare($sql);
if (!$stmt) {
  die("Error: " . $conn->error);
}
$stmt->bind_param("ssssi", $edit_stat,$date_of_adm,$date_of_dis,$room_no,$visit_id);
if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
  } else {
    header("Location: edit_core_visit.php?user=$user_id&visit=$visit_id");
  }
}
?>
