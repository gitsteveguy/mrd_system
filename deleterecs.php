<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Delete Records");
$user_id;
$visit_id;
$panchformid;
$table_id;
$rec_id;
$panchformtext;
if (isset($_GET['user']) && isset($_GET['visit']) && isset($_GET['tb']) && isset($_GET['recid'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
    $table_id = $_GET['tb'];
    $rec_id = $_GET['recid'];
} else {
    echo "Cannot find required parameters";
    header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=0");
}
if(isset($_GET['panchformid']))
{
    $panchformid = $_GET['panchformid'];
    $panchformtext = "&panchformid=".$panchformid;
}
$tsql2 = "SELECT * FROM forms WHERE form_id=?";
$tstmt2 = $conn->prepare($tsql2);
$tstmt2->bind_param("i",$table_id);
if (!$tstmt2->execute()) {
    die("Error: " . $tstmt2->error);
}
$tresult2 = $tstmt2->get_result();
$table2 = $tresult2->fetch_assoc();
$mod_role= explode(",", $table2['mod_roles']);
if (in_array($current_user_role, $mod_role) || in_array($current_user_role, $sup_roles)) {
    $dsql = "DELETE FROM " . $table2['table_name'] . " WHERE " . $table2['primary_key'] . " = ?";
    $dstmt = $conn->prepare($dsql);
    $dstmt->bind_param("i",$rec_id);
if (!$dstmt->execute()) {
    die("Error: " . $dstmt->error);
}
echo "Executed";
$table2_file=$table2['php_code_file'];
if($panchformid!="")
{

}
header("Location: $table2_file?user=$user_id&visit=$visit_id$panchformtext&success=0");
}
?>