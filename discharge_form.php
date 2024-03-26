<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Discharge Summary");
$user_id;
$visit_id;
$prakriti="";
$vikriti="";
$roansf="";
$diagnosis="";
$invegres="";
$ppoot="";
$medadm="";
$condis="";
$advices="";
$dismeds="";
if (isset($_GET['user']) && isset($_GET['visit'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
} else {
    echo "Cannot find required parameters";
}

$sql = "SELECT * FROM discharge_summary WHERE visit_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$visit_id);
if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
  }
$result = $stmt->get_result();
$exdis_form = $result->fetch_assoc();
if($result->num_rows > 0)
{
    $prakriti = $exdis_form['prakriti'];
    $vikriti = $exdis_form['vikriti'];
    $roansf = $exdis_form['reas_admsn_finds'];
    $diagnosis = $exdis_form['diagnosis'];
    $invegres = $exdis_form['investig_res'];
    $ppoot = $exdis_form['proc_per_tmts'];
    $medadm = $exdis_form['medications_adms'];
    $condis = $exdis_form['condition_discharge'];
    $advices = $exdis_form['advices'];
    $dismeds = $exdis_form['discharge_meds'];
}

if(isset($_POST['submit']))
{
    if ((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles) && !in_array($current_user_role,$table_mod_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles))))
    {
        header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=0");
        exit();
    }
    $prakriti = $_POST['prakriti'];
    $vikriti = $_POST['vikriti'];
    $roansf = $_POST['roansf'];
    $diagnosis = $_POST['diagnosis'];
    $invegres = $_POST['invegres'];
    $ppoot = $_POST['ppoot'];
    $medadm = $_POST['medadm'];
    $condis = $_POST['condis'];
    $advices = $_POST['advices'];
    $dismeds = $_POST['dismeds'];

    if($result->num_rows > 0)
    {
        $sql2 = "UPDATE discharge_summary SET prakriti=?, vikriti=?, reas_admsn_finds=?, diagnosis=?, investig_res=?, proc_per_tmts=?, medications_adms=?, condition_discharge=?, advices=?, discharge_meds=?, doctor_name=?, doctors_sign=?, doctor_id=?";
        $stmt2 = $conn->prepare($sql2);
        if (!$stmt2) {
            die("Error: " . $conn->error);
        }
        $stmt2->bind_param('ssssssssssssi',$prakriti, $vikriti, $roansf, $diagnosis, $invegres, $ppoot, $medadm, $condis, $advices, $dismeds, $current_user_name, $current_user_sign, $current_user_id);
    }
    else
    {
        $sql2 = "INSERT INTO discharge_summary (visit_id, user_id, prakriti, vikriti, reas_admsn_finds, diagnosis, investig_res, proc_per_tmts, medications_adms, condition_discharge, advices, discharge_meds, doctor_name, doctors_sign, doctor_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($sql2);
        if(!$stmt2){
            die("Error: ". $conn->error);
        }
        $stmt2->bind_param('iissssssssssssi',$visit_id, $user_id, $prakriti, $vikriti, $roansf, $diagnosis, $invegres, $ppoot, $medadm, $condis, $advices, $dismeds, $current_user_name, $current_user_sign, $current_user_id);
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
    <h1 class="text-center my-3">Discharge Summary</h1>
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
                                <label for="prakriti">Prakriti</label>
                                <input type="text" name="prakriti" maxlength="50" class="form-control" value="<?php echo $prakriti ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="vikriti">Vikriti</label>
                                <input type="text" name="vikriti" maxlength="50" class="form-control" value="<?php echo $vikriti ?>">
                            </div>
                        </div>               
                    </div>
                    <div class="row my-4">
                    <div class="col">
                            <div class="form-group">
                                <label for="roansf">Reason for Admission & Significant Findings</label>
                                <textarea class="textarea" name="roansf" rows="4" maxlength="350" cols="25"><?php echo $roansf ?></textarea>
                            </div>
                        </div>
                         <div class="col">
                            <div class="form-group">
                                <label for="diagnosis">Diagnosis</label><br>
                                <textarea class="textarea" name="diagnosis" rows="4" maxlength="350" cols="25"><?php echo $diagnosis ?></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="invegres">Investigation Results</label><br>
                                <textarea class="textarea" name="invegres" rows="4" maxlength="350" cols="25"><?php echo $invegres ?></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="ppoot">Procedure Performed / Other Treatments (if any)</label>
                                <textarea class="textarea" name="ppoot" rows="4" maxlength="350" cols="25"><?php echo $ppoot ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                    <div class="col">
                            <div class="form-group">
                                <label for="medadm">Medications Administered</label>
                                <textarea class="textarea" name="medadm" rows="4" maxlength="1000" cols="25"><?php echo $medadm ?></textarea>
                            </div>
                        </div>
                         <div class="col">
                            <div class="form-group">
                                <label for="condis">Condition at the time of Discharge</label>
                                <textarea class="textarea" name="condis" rows="4" maxlength="350" cols="25"><?php echo $condis ?></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="advices">Advices</label>
                                <textarea class="textarea" name="advices" rows="4" maxlength="350" cols="25"><?php echo $advices ?></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="dismeds">Discharge Medicines</label>
                                <textarea class="textarea" name="dismeds" rows="4" maxlength="1000" cols="25"><?php echo $dismeds ?></textarea>
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