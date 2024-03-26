<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("submitted");
$username;
    if(empty($_POST['username']))
    {die("username is required");}
    if(empty($_POST['firstname']))
    {die("firstname is required");}
    if(empty($_POST['lastname']))
    {die("lastname is required");}
    $username = $_POST['username'];
    $role = "Patient";
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $date_of_birth = ($_POST['dateofbirth']!="") ? $_POST['dateofbirth'] : NULL;
    $phone_no = $_POST['phoneno'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['bloodgroup'];
    $addressline1 = $_POST['addressline1'];
    $addressline2 = $_POST['addressline2'];
    $addressline3 = $_POST['addressline3'];
    $country = $_POST['country'];
    $pincode = $_POST['pincode'];
    $occupation = $_POST['occupation'];
    $profileimguri = $_POST['profileimageuri'];
    $signuri = $_POST['signimageuri'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    if($profileimguri!=""){
    $profile_img_loc = 'images/users/profile_pics/' . $first_name . '_' . $last_name . '_profie.png';
    $b64pdec = base64_decode($profileimguri);
    $profile_img = imageCreateFromString($b64pdec);
    $mrdno="";
    if (!$profile_img) {
       die('Profile Image is not a valid image');
    }
    if(!imagepng($profile_img, $profile_img_loc, 0))
  {die('pfp did not convert');}
}
else{
  $profile_img_loc="N.A";
}
  if($signuri!=""){
    $sign_img_loc = 'images/users/signatures/' . $first_name . '_' . $last_name . '_sign.png';
    $b64sdec = base64_decode($signuri);
    $sign_img = imageCreateFromString($b64sdec);
    if (!$sign_img) {
        die('Signature is not a valid image');
    }
  if(!imagepng($sign_img, $sign_img_loc, 0))
  {die('sign did not convert');}}
  else{
    $sign_img_loc="N.A";
  }
  if($email=="")
  {$email="N.A";}
   $sql = "INSERT INTO `FSbNJe9_user_data` (username,email,password,first_name,last_name,role,date_of_birth,mrd_no,phone_no,profile_img,gender,address_line_1,address_line_2,address_line_3,address_country,address_pincode,signature_img,occupation,blood_group) 
   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
  die("Error: " . $conn->error);
}

$stmt->bind_param("sssssssssssssssssss", $username, $email, $password, $first_name, $last_name, $role, $date_of_birth,$mrdno,$phone_no, $profile_img_loc, $gender, $addressline1, $addressline2, $addressline3, $country, $pincode, $sign_img_loc, $occupation, $blood_group);
if (!$stmt->execute()) {
  die("Error: " . $stmt->error);
} else {
  echo "New record created successfully";
}

$stmt->close();
$conn->close();
header("Location: mrddashboard.php");
?>