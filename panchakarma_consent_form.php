<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Panchakarma Consent Form");
$user_id;
$visit_id;
$panchagreest="";
$date="";
$resnosign="";
$nmofnxtkin = "";
$kinsignloc="";
$panch_form_id="";
if (isset($_GET['user']) && isset($_GET['visit'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
} else {
    echo "Cannot find required parameters";
}
$sql2 = "SELECT * FROM FSbNJe9_user_data WHERE user_id = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i",$user_id);
if (!$stmt2->execute()) {
    die("Error: " . $stmt2->error);
  }
  $result2 = $stmt2->get_result();
$fetched_user = $result2->fetch_assoc();
$first_name= $fetched_user['first_name'];
$last_name = $fetched_user['last_name'];
$sql = "SELECT * FROM panchakarma_consent_form WHERE visit_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$visit_id);
if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
  }
$result = $stmt->get_result();
$exispanch_form = $result->fetch_assoc();
if($result->num_rows > 0)
{
    $panch_form_id = $exispanch_form['panch_form_id'];
    $panchagreest=$exispanch_form['agreestat'];
    $date = $exispanch_form['date'];
    $time = $exispanch_form['time'];
    $resnosign = $exispanch_form['reas_not_sign'];
    $nmofnxtkin = $exispanch_form['name_kin'];
    $kinsignloc = $exispanch_form['kin_sign_loc'];
}

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $resnosign = $_POST['reanosign'];
    $panchagreest=isset($_POST['agreepanch'])?"agreed":"disagree";
    $nmofnxtkin = $_POST['nameofnextkin'];
    $signuri = $_POST['signimageuri'];
    $kinsignloc = 'images/users/signatures/' . $first_name . '_' . $last_name . '_kin_sign.png';
    $b64sdec = base64_decode($signuri);
    $sign_img = imageCreateFromString($b64sdec);
    if (!$sign_img) {
        die('Base64 value is not a valid image');
    }
    if(!imagepng($sign_img, $kinsignloc, 0))
    {die('sign did not convert');}
    if($result->num_rows > 0)
    {
        $sql3 = "UPDATE panchakarma_consent_form SET agreestat=?, date=?, time=?, reas_not_sign=?, name_kin=?, kin_sign_loc=?, doctor_id=?, doctor_name=?, doctors_sign=? WHERE visit_id=?";
        $stmt3 = $conn->prepare($sql3);
        if (!$stmt3) {
            die("Error: " . $conn->error);
        }
        $stmt3->bind_param('ssssssissi', $panchagreest, $date, $time, $resnosign, $nmofnxtkin, $kinsignloc,$current_user_id,$current_user_name,$current_user_sign,$visit_id);
    }
    else
    {
        $sql3 = "INSERT INTO panchakarma_consent_form (visit_id, user_id, agreestat, date, time, reas_not_sign, name_kin, kin_sign_loc, doctor_id, doctor_name, doctors_sign) VALUES (?, ? ,?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt3 = $conn->prepare($sql3);
        if(!$stmt3){
            die("Error: ". $conn->error);
        }
        $stmt3->bind_param("iissssssiss",$visit_id, $user_id, $panchagreest, $date, $time, $resnosign, $nmofnxtkin, $kinsignloc, $current_user_id, $current_user_name, $current_user_sign);
    }
    if (!$stmt3->execute()) {
        die("Error: " . $stmt3->error);
    } else {
        echo "Saved";
    }
    header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=1");
    exit();
}
?>

<body id="body">
    <h1 class="text-center my-3">Panchakarma Consent Form</h1>
    <div class="container my-2">
        <p>
        <ol>
            <li>I voluntarily request my physician Dr.SHANTHI FRANKLIN & her associates, Paricharakas and other health care providers as is deemed necessary, to treat my condition with the panchakarma/Parasurgical/therapeutic procedures which has been explained to me.</li>
            <li>The nature of my condition, the nature of the Panchakarma/Parasurgical/ Therapeutic procedure to be done, and the nature and degree of risks and benefits associated with undergoing and in abstaining from the above mentioned procedure have been explained to me, to my satisfaction, by my physician. It has been explained to me that during the course of procedure unforeseen conditions may be revealed that necessitate the extension of the original procedure (s) or shift to different procedure(s).</li>
            <li>Alternatives to the present procedure and the nature and degree of risks and benefits associated with each of those alternatives have been explained to me by my physician and I have decided to have this procedure instead of any of those alternatives.</li>
            <li>I am aware that, there may be risks and hazards continuing in my present condition without treatment even though there are risks and hazards related to the performance of the surgical/Parasurgical/Therapeutic procedures planned for me. I realise that the Surgical/ Parasurgical/Therapeutic procedures is potential for, infection, blood loss, allergies..etc in some cases. I also realise that other specific risks which are mentioned in the attachment sheet(s) may occur in connection with this particular procedure.</li>
            <li>I have been informed that, with any procedure there is possibility of unexpected complications, and hence guarantees or promises cannot be made to me concerning the results of any procedure or treatment.</li>
            <li>I consent the hospital authority for disposal of any body parts which may be removed from me and I also authorise the hospital to use and retain such body parts for further pathological diagnosis and any other scientific /educational use.</li>
            <li>I authorize the presence, assistance and training of medical/ Nursing/Paramedical students to the procedure room, as is approved by my physician.</li>
            <li>I consent to take photograph or video of my suggested procedures for medical/ scientific/educational purpose so long as my identity is not revealed by the picture or description accompanying them.</li>
            <li>I understand that I have the right to withhold/refuse permission for items (3, 6, 7 & 8) enumerated above. If I withhold my permission for any item, I have crossed them out and signed my initials. Otherwise, I have authorized them.</li>
            <li>I do hereby consent to undergo blood test for various purposes if necessary. Information regarding the same is provided to me.</li>
        </ol>
        </p>
    </div>
    <div class="container d-flex justify-content-center">
        <form method="POST" action="">
        <?php  
            if ((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles) && !in_array($current_user_role,$table_mod_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles))))
             {
                 ?>
                 <fieldset disabled="disabled">
                    <?php
             }    
            ?>
            <div class="row my-2">
                <div class="col">
                    <div class="form-group">
                        <input type="checkbox" class="form-check-input" name="agreepanch" id="agreepanch" <?php if($panchagreest){echo "checked";}?>>
                        <label for="agreepanch">I certify that I have read and fully understand the contents of this form, I have been given the opportunity to ask questions and have received satisfactory answers, and that all blanks and statements requiring insertion or completion were filled in before I signed below.
                            <style>
                                label {
                                    display: inline;
                                }
                            </style>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <div class="col">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" class="form-control" value="<?php echo $date; ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="time" name="time" class="form-control" value="<?php echo $time; ?>">
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col">
                    <div class="form-group">
                        <label for="reanosign">Reason for Not Signing by Patient</label>
                        <input type="text" name="reanosign" maxlength="200" class="form-control" value="<?php echo $resnosign; ?>">
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <div class="col">
                    <div class="form-group">
                        <label for="nameofnextkin">Name of Next of Kin</label>
                        <input type="text" name="nameofnextkin" class="form-control" value="<?php echo $nmofnxtkin; ?>">
                    </div>
                </div>
                <div class="col">
                    <div id="signdiv">
                        <label class="my-2">Signature of Kin</label>
                        <input id="signimageuri" name="signimageuri" type="text" class="form-control">
                        <canvas id="sign" width="150" height="150" class="form-control"></canvas>
                        <button type="button" class="btn btn-primary" id="clearsignbtn">Clear</button>
                        <button type="button" class="btn btn-primary" id="signconfirm">Confirm Signature</button>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <?php 
            if($kinsignloc)
            {
            ?>
            <div class="row my-2">
                <div class="col"></div>
                <div class="col">
                    <h2>Exisiting Kin's Sign</h2><br>
                    <img src="<?php echo $kinsignloc ?>" alt="">
                </div>
                <div class="col"></div>
            </div>
            <?php
            }
            ?>
            <input type="submit" class="btn btn-success" name="submit" value="Submit">
            <a href="visitdetails.php?user=<?php echo $user_id ?>&visit=<?php echo $visit_id ?>" class="btn btn-danger">Cancel</a>
            <?php  
             if($formeditable=="No" && !in_array($current_user_role,$sup_roles))
             {
                 ?>
                 </fieldset>
                    <?php
             }    
            ?>
           <?php
           if($result->num_rows > 0) 
           {
            ?>
            <a href="panchaddprodetform.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>&panchformid=<?php echo $panch_form_id; ?>" class="btn btn-primary">Add/View Procedure Details</a>
        <?php } ?>
        </form>
        <script src="signaturecanvasscripts.js"></script>
</body>