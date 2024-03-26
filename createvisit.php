<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Create a Visit");

$user_id;
if(isset($_GET['user']))
{
    $user_id= $_GET['user'];
}

if (isset($_POST['submit'])) {
    $date_of_adm = $_POST['dateofadmm'];
    $room_no = $_POST['roomno'];
    $sql = "INSERT INTO `visits` (user_id,date_of_admission,room_no) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
if (!$stmt) {
  die("Error: " . $conn->error);
}
$stmt->bind_param("iss",$user_id,$date_of_adm,$room_no);
if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
  } else {
    header("Location: patient.php?user=$user_id");;
  }
}
?>
<div class="container my-3">
    <div class="row">
        <div class="col-md-12">
            <h2>Create a new Visit</h2>
            <form method="post" action="">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <input type="text" name="dateofadmm" id="dateofadmm" class="form-control" placeholder="Date Of Admission" required onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                        <input type="text" name="roomno" id="roomnof" class="form-control" placeholder="Room No:">
                        </div>
                    </div>
                </div>
               
                <button type="submit" name="submit" class="btn btn-primary my-3 mx-2">Create a Visit</button>
                <a href="patient.php?user=<?php echo $user_id?>" class="btn btn-danger">Cancel</a>
            </form>
            </div>
                </div>
</div>