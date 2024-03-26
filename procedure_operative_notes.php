<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Procedure Operative Notes");
$user_id;
$visit_id;
$date="";;
$time="";
$propef="";
$sal_step="";
$keyfinds="";
$samasams="";
$suggestions="";
$remarks="";
$samsar="";
$pathya="";
$nursingcare="";
if (isset($_GET['user']) && isset($_GET['visit'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
} else {
    echo "Cannot find required parameters";
}
$sql = "SELECT * FROM procedure_operative_notes WHERE visit_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$visit_id);
if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
  }
$result = $stmt->get_result();
$expro_op_from = $result->fetch_assoc();
if($result->num_rows > 0)
{
    $date = $expro_op_from['date'];
    $time=$expro_op_from['time'];
    $propef = $expro_op_from['pro_perf'];
    $sal_step = $expro_op_from['sal_step_pro'];
    $keyfinds = $expro_op_from['key_find_vya'];
    $samasams = $expro_op_from['sam_asam_laks_obs'];
    $suggestions = $expro_op_from['suggestions'];
    $remarks = $expro_op_from['remarks'];
    $samsar = $expro_op_from['samsar'];
    $pathya = $expro_op_from['pathya_adv'];
    $nursingcare = $expro_op_from['nursing_care'];
}

if(isset($_POST['submit']))
{
    if ((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles) && !in_array($current_user_role,$table_mod_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles))))
    {
        header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=0");
        exit();
    }
    $date = $_POST['date'];
    $time = $_POST['time'];
    $propef = $_POST['properform'];
    $sal_step = $_POST['salpro'];
    $keyfinds = $_POST['kfvya'];
    $samasams = $_POST['saaslo'];
    $suggestions = $_POST['suggestions'];
    $remarks = $_POST['remarks'];
    $samsar = $_POST['samsar'];
    $pathya = $_POST['pathya'];
    $nursingcare = $_POST['nursecare'];

    if($result->num_rows > 0)
    {
        $sql2 = "UPDATE procedure_operative_notes SET date=?, time=?, pro_perf=?, sal_step_pro=?, key_find_vya=?, sam_asam_laks_obs=?, suggestions=?, remarks=?, samsar=?, pathya_adv=?, nursing_care=?, doctor_name=?, doctors_sign=?, post_user_id=?";
        $stmt2 = $conn->prepare($sql2);
        if (!$stmt2) {
            die("Error: " . $conn->error);
        }
        $stmt2->bind_param('sssssssssssssi',$date, $time, $propef, $sal_step, $keyfinds, $samasams, $suggestions, $remarks, $samsar, $pathya, $nursingcare, $current_user_name, $current_user_sign, $current_user_id);
    }
    else
    {
        $sql2 = "INSERT INTO procedure_operative_notes (visit_id, user_id, date, time, pro_perf, sal_step_pro, key_find_vya, sam_asam_laks_obs, suggestions, remarks, samsar, pathya_adv, nursing_care, doctor_name, doctors_sign, post_user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($sql2);
        if(!$stmt2){
            die("Error: ". $conn->error);
        }
        $stmt2->bind_param('iisssssssssssssi',$visit_id, $user_id, $date, $time, $propef, $sal_step, $keyfinds, $samasams, $suggestions, $remarks, $samsar, $pathya, $nursingcare, $current_user_name, $current_user_sign, $current_user_id);
    }
    if (!$stmt2->execute()) {
        die("Error: " . $stmt2->error);
    } else {
        echo "Saved";
    }
    header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=1");
    exit();
}
?>

<body id="body">
    <h1 class="text-center my-3">Procedure Operative Notes</h1>
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
                                <label for="properform">Procedure Performed</label>
                                <textarea class="textarea" name="properform" rows="4" maxlength="350" cols="25"><?php echo $propef ?></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="salpro">Salient steps of the Procedure</label>
                                <textarea class="textarea" name="salpro" rows="4" maxlength="350" cols="25"><?php echo $sal_step ?></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kfvya">Key Findings (& Vyapaths if any)</label>
                                <textarea class="textarea" name="kfvya" rows="4" maxlength="350" cols="25"><?php echo $keyfinds ?></textarea>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row my-2">
                    <div class="col">
                            <div class="form-group">
                                <label for="saaslo">Samyak / Asamayak Lakshnas Observed</label>
                                <textarea class="textarea" name="saaslo" rows="4" maxlength="350" cols="25"><?php echo $samasams ?></textarea>
                            </div>
                        </div>
                    <div class="col">
                            <div class="form-group">
                                <label for="suggestions">Suggestions</label>
                                <textarea class="textarea" name="suggestions" rows="4" maxlength="350" cols="25"><?php echo $suggestions ?></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea class="textarea" name="remarks" rows="4" maxlength="350" cols="25"><?php echo $remarks ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                        <h3 class="d-flex justify-content-center">Post Operative / Procedure Care Plan</h3>
                        <div class="col">
                            <div class="form-group">
                                <label for="samsar">Samsarrjanakrama</label>
                                <textarea class="textarea" name="samsar" rows="4" maxlength="350" cols="25"><?php echo $samsar ?></textarea>
                            </div>
                        </div>
                     <div class="col">
                            <div class="form-group">
                                <label for="pathya">Pathyapathya Adviced</label>
                                <textarea class="textarea" name="pathya" rows="4" maxlength="350" cols="25"><?php echo $pathya ?></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="nursecare">Nursing Care</label>
                                <textarea class="textarea" name="nursecare" rows="4" maxlength="350" cols="25"><?php echo $nursingcare ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                    <div class="col">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control" value="<?php echo $date ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" name="time" class="form-control" value="<?php echo $time ?>">
                        </div>
                    </div>
                    </div>
        <input type="submit" class="btn btn-success" name="submit" value="Submit">
        <a href="visitdetails.php?user=<?php echo $user_id?>&visit=<?php echo $visit_id?>" class="btn btn-danger">Cancel</a>
        <?php 
 if ((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles) && !in_array($current_user_role,$table_mod_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles))))
    {
        ?>
        </fieldset>
                    <?php
             }    
            ?>
    </form>
    </div>
</body>