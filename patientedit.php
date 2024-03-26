<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
$id;
if (isset($_GET['user'])) {
    $id = $_GET['user'];
    $sql = "SELECT * FROM FSbNJe9_user_data WHERE user_id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $mrd_no = $row['mrd_no'];
    $address_line_1 = $row['address_line_1'];
    $address_line_2 = $row['address_line_2'];
    $address_line_3 = $row['address_line_3'];
    $phone = $row['phone_no'];
    $email = $row['email'];
} else {
    header("Location: mrddashboard.php");
}

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mrd_no = $_POST['mrd_no'];
    $address_line_1 = $_POST['addressline1'];
    $address_line_2 = $_POST['addressline2'];
    $address_line_3 = $_POST['addressline3'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

if($email=="")
{$email="N.A";}
    $sql = "UPDATE FSbNJe9_user_data SET first_name=?, last_name=?, mrd_no=?, address_line_1=?,address_line_2=?,address_line_3=?, phone_no=?, email=? WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi",$first_name,$last_name,$mrd_no,$address_line_1,$address_line_2,$address_line_3,$phone,$email,$id);
    if (!$stmt) {
        die("Error: " . $conn->error);
    }
    if (!$stmt->execute()) {
        echo "Error updating record: " . $conn->error;
    }
    if(isset($_FILES['pfp']))
    {
        $pname = $_FILES['pfp']['name'];
        $pext = explode('.',$pname)[1];
        if($pext!="")
        {
        echo $pext;
        $profile_img_loc = 'images/users/profile_pics/' . $first_name . '_' . $last_name . '_profie.'.$pext;
        $sql2 = "UPDATE FSbNJe9_user_data SET profile_img=? WHERE user_id=?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("si",$profile_img_loc,$id);
        $stmt2->execute();
        move_uploaded_file($_FILES['pfp']['tmp_name'],$profile_img_loc);
        }
    }
    if(isset($_FILES['sign']))
    {
        $sname = $_FILES['sign']['name'];
        $siext = explode('.',$sname)[1];
        echo $siext;
        if($siext!="")
        {
        $sign_img_loc = 'images/users/signatures/' . $first_name . '_' . $last_name . '_sign.'.$siext;
        $sql3 = "UPDATE FSbNJe9_user_data SET signature_img=? WHERE user_id=?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param("si",$sign_img_loc,$id);
        if (!$stmt3->execute()) {
            echo "Error updating record: " . $conn->error;
        }
        move_uploaded_file($_FILES['sign']['tmp_name'],$sign_img_loc);
    }}
    header("Location: patient.php?user=$id");
    
}

pheader("Edit Patient");

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit Patient</h2>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>" >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="mrd_no">MRD No</label>
                            <input type="text" class="form-control" name="mrd_no" value="<?php echo $mrd_no; ?>" >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" >
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="addressline1">Address Line 1</label>
                            <input type="text" class="form-control" name="addressline1"  value="<?php echo $address_line_1; ?>"></input>
                        </div>
                    </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="addressline2">Address Line 2</label>
                                <input type="text" class="form-control" name="addressline2"  value="<?php echo $address_line_2; ?>"></input>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="addressline3">Address Line 3</label>
                                <input type="text" class="form-control" name="addressline3"  value="<?php echo $address_line_3; ?>"></input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="pfp">Upload Profile Photo</label>
                                <input type="file" class="form-control" accept="image/*" name="pfp">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="sign">Upload Signature</label>
                                <input type="file" class="form-control" accept="image/*" name="sign">
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <a href="patient.php?user=<?php echo $id?>" class="btn btn-danger">Cancel</a>
            </form>
</div>