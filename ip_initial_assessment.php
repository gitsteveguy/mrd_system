<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Visit Details");
$user_id;
$visit_id;
//form data variables//
$temp = "";
$pulse = "";
$pulse_type = "";
$bp = "";
$height = "";
$pain = "";
$weight = "";
$bmi = "";
$built = "";
$gsisx = "";
$wtgain = "";
$nusts = "";
$dpa = "";
$ifvs = "";
$prscd = "";
$hisprsill = "";
$hisprvill = "";
$trtmeddet = "";
$bowhab = "";
$appetite = "";
$micturition = "";
$sleep = "";
$menstr_cycle = "";
$menstr_flow = "";
$menstr_assoc = "";
$uncon = "";
$disor = "";
$bedrid = "";
$builttype = "";
$others = "";
$cpsprevention = "";
$cpscurative = "";
$cpsrehabitative = "";
$cpspromotive = "";
$dietplan = "";
$apralrunmeds = "";
$provdiag = "";
$diagnosis = "";
$investigations = "";
$desired_outcomes = "";
$diifinfoint = "";
$menstrotherdet = "";
$addictions = "";
$sql2;
if (isset($_GET['user']) && isset($_GET['visit'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
} else {
    echo "Cannot find required parameters";
}

$sql = "SELECT * FROM ip_form WHERE visit_id =$visit_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $temp = $row['temperature'];
    $pulse = $row['pulse'];
    $pulse_type = $row['pulse_type'];
    $bp = $row['blood_pressure'];
    $height = $row['height'];
    $pain = $row['pain_assessment'];
    $weight = $row['weight'];
    $bmi = $row['bmi'];
    $built = $row['built'];
    $gsisx = $row['gastric_issues_last_six_months'];
    $wtgain = $row['weight_g_l_last_six_months'];
    $nusts = $row['nutritional_status'];
    $dpa = $row['difficulty_in_phy_acts'];
    $ifvs = $row['intake_of_fo_vit_sup'];
    $diifinfoint = $row['diifinfoint'];
    $prscd = $row['pres_compl_dur'];
    $hisprsill = $row['his_pres_ill'];
    $hisprvill = $row['his_prev_ill'];
    $trtmeddet = $row['treat_med_det'];
    $bowhab = $row['bowel_hab'];
    $appetite = $row['appetite'];
    $micturition = $row['micturition'];
    $sleep = $row['sleep'];
    $menstr_cycle = $row['menstr_cycle'];
    $menstr_flow = $row['menstr_flow'];
    $menstr_assoc = $row['menstr_assoc'];
    $menstrotherdet = $row['menstrotherdet'];
    $uncon = $row['unconscious'];
    $disor = $row['disoriented'];
    $bedrid = $row['bedridden'];
    $builttype = $row['built_type'];
    $others = $row['others'];
    $cpsprevention = $row['cps_prevention'];
    $cpscurative = $row['cps_curative'];
    $cpsrehabitative = $row['cps_rehabilitative'];
    $cpspromotive = $row['cps_promotive'];
    $dietplan = $row['diet_plan'];
    $apralrunmeds = $row['cp_appr_alr_med'];
    $provdiag = $row['provis_diag'];
    $diagnosis = $row['diagnosis'];
    $investigations = $row['investigations'];
    $addictions = $row['addictions'];
    $desired_outcomes = $row['desired_outcome'];
}

if (isset($_POST['submit'])) {
    if ((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles) && !in_array($current_user_role,$table_mod_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles))))
    {
        header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=0");
        exit();
    }
    $temp = $_POST['temperature'];
    $pulse = $_POST['pulse'];
    $pulse_type = $_POST['pulsetype'];
    $bp = $_POST['bp'];
    $height = $_POST['height'];
    $pain = $_POST['painassessment'];
    $weight = $_POST['weight'];
    $bmi = $_POST['bmi'];
    $built = $_POST['built'];
    $gsisx = $_POST['gastric'];
    $wtgain = $_POST['weightgalo'];
    $nusts = $_POST['nutri_stat'];
    $dpa = $_POST['diffinphyact'];
    $ifvs = $_POST['infovisp'];
    $diifinfoint = $_POST['diifinfoint'];
    $prscd = $_POST['prescompndur'];
    $hisprsill = $_POST['hispresill'];
    $hisprvill = $_POST['hisprevill'];
    $trtmeddet = $_POST['treatmeddet'];
    $bowhab = $_POST['bowelhab'];
    $appetite = $_POST['appetite'];
    $micturition = $_POST['micturition'];
    $sleep = $_POST['sleep'];
    $menstr_cycle = isset($_POST['mcycle'])?$_POST['mcycle']:"N.A.";
    $menstr_flow = isset($_POST['mflow'])?$_POST['mflow']:"N.A.";
    $menstr_assoc = isset($_POST['massocwt'])?$_POST['massocwt']:"N.A.";
    $menstrotherdet = $_POST['menstrotherdet'];
    $uncon = isset($_POST['constat'])?"Yes":"No";
    $disor = isset($_POST['mntorient'])?"Yes":"No";
    $bedrid = isset($_POST['mobility'])?"Yes":"No";
    $builttype = $_POST['builttype'];
    $others = $_POST['geother'];
    $cpsprevention = isset($_POST['cpsprevention'])? 1:0;
    $cpscurative = isset($_POST['cpscurative'])? 1:0;
    $cpsrehabitative = isset($_POST['cpsrehabilitative'])? 1:0;
    $cpspromotive =isset($_POST['cpspromotive'])? 1:0;
    $dietplan = $_POST['dietplan'];
    $apralrunmeds = isset($_POST['cpaaumed'])? "Yes":"No";
    $provdiag = $_POST['prodiag'];
    $diagnosis = $_POST['diagnosis'];
    $investigations = $_POST['investgations'];
    $addictions = $_POST['addictions'];
    $desired_outcomes = $_POST['desireout'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $sql2 = "UPDATE ip_form SET temperature=?, pulse=?, pulse_type=?, blood_pressure=?, height=?, pain_assessment=?, weight=?, bmi=?, built=?, gastric_issues_last_six_months=?, weight_g_l_last_six_months=?, nutritional_status=?, difficulty_in_phy_acts=?, intake_of_fo_vit_sup=?, diifinfoint=?, pres_compl_dur=?, his_pres_ill=?, his_prev_ill=?, treat_med_det=?, bowel_hab=?, appetite=?, micturition=?, sleep=?, menstr_cycle=?, menstr_flow=?, menstr_assoc=?, menstrotherdet=?, unconscious=?, disoriented=?, bedridden=?, built_type=?, others=?, cps_prevention=?, cps_curative=?, cps_rehabilitative=?, cps_promotive=?, diet_plan=?, cp_appr_alr_med=?, provis_diag=?, diagnosis=?, investigations=?,addictions=?, desired_outcome=?, doctor_id=?, doctor_name=?, doctors_sign=?  WHERE visit_id=?";
        $stmt = $conn->prepare($sql2);
        if (!$stmt) {
            die("Error: " . $conn->error);
        }
        $stmt->bind_param("ssssssssssssssssssssssssssssssssiiiisssssssissi",$temp,$pulse,$pulse_type,$bp,$height,$pain,$weight,$bmi,$built,$gsisx,$wtgain,$nusts,$dpa,$ifvs,$diifinfoint,$prscd,$hisprsill,$hisprvill,$trtmeddet,$bowhab,$appetite,$micturition,$sleep,$menstr_cycle,$menstr_flow,$menstr_assoc,$menstrotherdet,$uncon,$disor,$bedrid,$builttype,$others,$cpsprevention,$cpscurative,$cpsrehabitative,$cpspromotive,$dietplan,$apralrunmeds,$provdiag,$diagnosis,$investigations,$addictions,$desired_outcomes,$current_user_id,$current_user_name,$current_user_sign,$visit_id);     
    } 
    else {
        $sql = "INSERT INTO ip_form (user_id, visit_id, temperature, pulse, pulse_type, blood_pressure, height, pain_assessment, weight, bmi, built, gastric_issues_last_six_months, weight_g_l_last_six_months, nutritional_status, difficulty_in_phy_acts, intake_of_fo_vit_sup, diifinfoint, pres_compl_dur, his_pres_ill, his_prev_ill, treat_med_det, bowel_hab, appetite, micturition, sleep, menstr_cycle, menstr_flow, menstr_assoc, menstrotherdet, unconscious, disoriented, bedridden, built_type, others, cps_prevention, cps_curative, cps_rehabilitative, cps_promotive, diet_plan, cp_appr_alr_med, provis_diag, diagnosis, investigations, addictions, desired_outcome, doctor_id, doctor_name, doctors_sign)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            die("Error: " . $conn->error);
        }
        
        $stmt->bind_param("iissssssssssssssssssssssssssssssssiiiisssssssiss",$user_id, $visit_id, $temp, $pulse, $pulse_type, $bp, $height, $pain, $weight, $bmi, $built, $gsisx, $wtgain, $nusts, $dpa, $ifvs, $diifinfoint, $prscd, $hisprsill, $hisprvill, $trtmeddet, $bowhab, $appetite, $micturition, $sleep, $menstr_cycle, $menstr_flow, $menstr_assoc, $menstrotherdet, $uncon, $disor, $bedrid, $builttype, $others, $cpsprevention, $cpscurative, $cpsrehabitative, $cpspromotive, $dietplan, $apralrunmeds, $provdiag, $diagnosis, $investigations,$addictions, $desired_outcomes, $current_user_id, $current_user_name, $current_user_sign);           
    }
    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    } else {
        echo "Saved";
        header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=1");
        exit();
    }
}
?>

<body id="body">
    <h1 class="text-center my-3">Initial Assesment</h1>
    <div class="container d-flex justify-content-center">
        <form id="create_patient" action="" method="post">
            <?php  
            if ((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles) && !in_array($current_user_role,$table_mod_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles))))
             {
                 ?>
                 <fieldset disabled="disabled">
                    <?php
             }    
            ?>
            <div class="row my-3">
                <h3>Vital Signs</h3>
                <div class="col">
                    <div class="form-group">
                        <label for="temperature">Temperature</label>
                        <input type="text" class="form-control" name="temperature" maxlength="10" value="<?php echo $temp ?>" >
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="pulse">Pulse</label>
                        <input type="text" class="form-control" name="pulse" maxlength="10" value="<?php echo $pulse ?>" >
                    </div>
                </div>
                <div class="col">
                    <label for="pulsetype">Pulse Type</label>
                    <select name="pulsetype" id="pulsetype" class="form-control" >
                        <option value="" <?php if ($pulse_type === '') {
                                                    echo ' selected';
                                                } ?> >Select the Type</option>
                        <option value="Regular">Regular <?php if ($pulse_type === 'Regular') {
                                                            echo ' selected';
                                                        } ?></option>
                        <option value="Irregular">Irregular <?php if ($pulse_type === 'Irregular') {
                                                                echo ' selected';
                                                            } ?> </option>
                    </select>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <div class="form-group">
                        <label for="bp">Blood Pressure</label>
                        <input type="text" class="form-control" name="bp" maxlength="10" value="<?php echo $bp ?>" >
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="height">Height</label>
                        <input type="text" class="form-control" name="height" maxlength="10" value="<?php echo $height ?>" >
                    </div>
                </div>
                <div class="col">
                    <label for="painassessment">Pain Assesment</label>
                    <select name="painassessment" id="painassessment" class="form-control" >
                        <option value="" <?php if ($pain === '') {
                                                    echo ' selected';
                                                } ?> >Select the Correct Value</option>
                        <option value="0: No Pain" <?php if ($pain === '0: No Pain') {
                                                        echo ' selected';
                                                    } ?>>0: No Pain</option>
                        <option value="2 : Hurts Little Bit" <?php if ($pain === '2 : Hurts Little Bit') {
                                                                    echo ' selected';
                                                                } ?>>2 : Hurts Little Bit</option>
                        <option value="4 : Hurts Little More" <?php if ($pain === '4 : Hurts Little More') {
                                                                    echo ' selected';
                                                                } ?>>4 : Hurts Little More</option>
                        <option value="6 : Hurts Even More" <?php if ($pain === '6 : Hurts Even More') {
                                                                echo ' selected';
                                                            } ?>>6 : Hurts Even More</option>
                        <option value="8 : Hurts a Whole Lot" <?php if ($pain === '8 : Hurts a Whole Lot') {
                                                                    echo ' selected';
                                                                } ?>>8 : Hurts a Whole Lot</option>
                        <option value="10 : Hurts Worst" <?php if ($pain === '10 : Hurts Worst') {
                                                                echo ' selected';
                                                            } ?>>10 : Hurts Worst</option>
                    </select>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="text" class="form-control" name="weight" maxlength="10" value="<?php echo $weight ?>" >
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="bmi">Body Mass Index</label>
                        <input type="text" class="form-control" name="bmi" maxlength="10" value="<?php echo $bmi ?>" >
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <h3 class="my-3">Nutritional Screening</h3>
                <div class="col">
                    <label for="built">Built</label>
                    <select name="built" id="built" class="form-control" >
                        <option value="" <?php if ($built === '') {
                                                    echo ' selected';
                                                } ?> >Select the Correct Option</option>
                        <option value="Normal" <?php if ($built === 'Normal') {
                                                    echo ' selected';
                                                } ?>>Normal</option>
                        <option value="Underweight" <?php if ($built === 'Underweight') {
                                                        echo ' selected';
                                                    } ?>>Underweight</option>
                        <option value="Overweight <?php if ($built === 'Overweight') {
                                                        echo ' selected';
                                                    } ?>">Overweight</option>
                    </select>
                </div>
                <div class="col">
                    <label for="gastric">Gastric Issues in Last 6 Months</label>
                    <select name="gastric" id="gastric" class="form-control" >
                        <option value="" <?php if ($gsisx === '') {
                                                    echo ' selected';
                                                } ?> >Select the Correct Option</option>
                        <option value="Yes" <?php if ($gsisx === 'Yes') {
                                                echo ' selected';
                                            } ?>>Yes</option>
                        <option value="No" <?php if ($gsisx === 'No') {
                                                echo ' selected';
                                            } ?>>No</option>
                    </select>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="weightgalo">Weight Gain or Lost in last 6 Months</label>
                        <input type="text" class="form-control" name="weightgalo" maxlength="10" value="<?php echo $wtgain ?>" >
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <label for="nutri_stat">Nutritional Status</label>
                    <select name="nutri_stat" id="nutri_stat" class="form-control" >
                        <option value="" <?php if ($nusts === '') {
                                                    echo ' selected';
                                                } ?> >Select the Correct Option</option>
                        <option value="Normal" <?php if ($nusts === 'Normal') {
                                                    echo ' selected';
                                                } ?>>Normal</option>
                        <option value="Excess" <?php if ($nusts === 'Excess') {
                                                    echo ' selected';
                                                } ?>>Excess</option>
                        <option value="Malnutrition" <?php if ($nusts === 'Malnutrition') {
                                                            echo ' selected';
                                                        } ?>>Malnutrition</option>
                        <option value="Severe Malnutrition" <?php if ($nusts === 'Severe Malnutrition') {
                                                                echo ' selected';
                                                            } ?>>Severe Malnutrition</option>
                    </select>
                </div>
                <div class="col">
                    <label for="diffinphyact">Difficulty in Physical Activities</label>
                    <select name="diffinphyact" id="diffinphyact" class="form-control" >
                        <option value="" <?php if ($dpa === '') {
                                                    echo ' selected';
                                                } ?> >Select the Correct Option</option>
                        <option value="Yes" <?php if ($dpa === 'Yes') {
                                                echo ' selected';
                                            } ?>>Yes</option>
                        <option value="No" <?php if ($dpa === 'No') {
                                                echo ' selected';
                                            } ?>>No</option>
                    </select>
                </div>
                <div class="col">
                    <label for="infovisp">Intake of any Food or Vitamin Supplements</label>
                    <select name="infovisp" id="infovisp" class="form-control" >
                        <option value="" <?php if ($ifvs === '') {
                                                    echo ' selected';
                                                } ?> >Select the Correct Option</option>
                        <option value="Yes" <?php if ($ifvs === 'Yes') {
                                                echo ' selected';
                                            } ?>>Yes</option>
                        <option value="No" <?php if ($ifvs === 'No') {
                                                echo ' selected';
                                            } ?>>No</option>
                    </select>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="diifinfoint">Difference in food intake in last 6 Months</label>
                        <select name="diifinfoint" id="diifinfoint" class="form-control" >
                        <option value="" <?php if ($diifinfoint === '') {
                                                    echo ' selected';
                                                } ?> >Select the Correct Option</option>
                        <option value="Yes" <?php if ($diifinfoint === 'Yes') {
                                                echo ' selected';
                                            } ?>>Yes</option>
                        <option value="No" <?php if ($diifinfoint === 'No') {
                                                echo ' selected';
                                            } ?>>No</option>
                    </select>
                    </div>
                </div>
            </div>
            <p style="page-break-after: always;"></p>
            <div class="row my-3">
                <div class="col">
                    <div class="form-group">
                        <label for="prescompndur">Presenting Complaints & Duration</label>
                        <textarea class="textarea" maxlength="500" rows="10" cols="30" name="prescompndur" class="form-control" ><?php echo $prscd?></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="hispresill">History of Presenting Illness</label>
                        <textarea class="textarea" maxlength="500" rows="10" cols="30" name="hispresill" class="form-control"  ><?php echo $hisprsill?></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="hisprevill">History of Previous Illnesses</label>
                        <textarea class="textarea" maxlength="500" rows="10" cols="30" name="hisprevill" class="form-control"  ><?php echo $hisprvill?></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="treatmeddet">Treatment / Medication Details</label>
                        <textarea class="textarea" maxlength="500" rows="10" cols="30" name="treatmeddet" class="form-control"  ><?php echo $trtmeddet?></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <label for="bowelhab">Bowel Habbits</label>
                    <input type="text" class="form-control" maxlength="20" name="bowelhab" value="<?php echo $bowhab?>" >
                </div>
                <div class="col">
                    <label for="appetite">Appetite</label>
                    <input type="text" class="form-control" maxlength="20" name="appetite" value="<?php echo $appetite?>" >
                </div>
                <div class="col">
                    <label for="micturition">Micturition</label>
                    <input type="text" class="form-control" maxlength="20" name="micturition" value="<?php echo $micturition?>" >
                </div>
                <div class="col">
                    <label for="sleep">Sleep</label>
                    <input type="text" class="form-control" maxlength="20" name="sleep" value="<?php echo $sleep?>" >
                </div>
            </div>
            <?php
            $sql3 = "SELECT * FROM FSbNJe9_user_data WHERE user_id =$user_id";
            $result2 = $conn->query($sql3);
            $row2 = $result2->fetch_assoc();
            if ($row2['gender'] != "Male" && $row2['gender'] != "male") {
            ?>
                <div class="row my-3">
                    <h3 class="my-3">Menstruation Details</h3>
                    <div class="col">
                        <label for="mcycle">Menstruation Cycle</label>
                        <select name="mcycle" id="mcycle" class="form-control" >
                            <option value="" <?php if($menstr_cycle==""){echo "selected";}?> >Select the Type</option>
                            <option value="Regular" <?php if($menstr_cycle=="Regular"){echo "selected";}?>>Regular</option>
                            <option value="Irregular"  <?php if($menstr_cycle=="Irregular"){echo "selected";}?>>Irregular</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="mflow">Menstruation Flow</label>
                        <select name="mflow" id="mflow" class="form-control" >
                            <option value="" <?php if($menstr_flow==""){echo "selected";}?> >Select the Type</option>
                            <option value="Normal" <?php if($menstr_flow=="Normal"){echo "selected";}?>>Normal</option>
                            <option value="Less" <?php if($menstr_flow=="Less"){echo "selected";}?>>Less</option>
                            <option value="More" <?php if($menstr_flow=="More"){echo "selected";}?>>More</option>
                            <option value="Irregular" <?php if($menstr_flow=="Irregular"){echo "selected";}?>>Irregular</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="massocwt">Menstruation Associated With</label>
                        <select name="massocwt" id="massocwt" class="form-control" >
                            <option value="" <?php if($menstr_assoc==""){echo "selected";}?> >Select the Option</option>
                            <option value="Nill" <?php if($menstr_assoc=="Nill"){echo "selected";}?>>Nill</option>
                            <option value="Pain" <?php if($menstr_assoc=="Pain"){echo "selected";}?>>Pain</option>
                            <option value="Clot" <?php if($menstr_assoc=="Clot"){echo "selected";}?>>Clot</option>
                            <option value="Muscle Cramps" <?php if($menstr_assoc=="Muscle Cramps"){echo "selected";}?>>Muscle Cramps</option>
                            <option value="White Discharge" <?php if($menstr_assoc=="White Discharge"){echo "selected";}?>>White Discharge</option>
                        </select>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="menstrotherdet">Other Details Regarding Menstruation</label>
                        <textarea class="textarea" maxlength="500" rows="10" cols="30" name="menstrotherdet" class="form-control"  ><?php echo $menstrotherdet?></textarea>
                    </div>
                </div>
                </div>
            <?php
            }
            ?>
            <div class="row my-3">
                <h3 class="my-3">General Examination</h3>
                <div class="col">
                    <input type="checkbox" class="form-check-input" name="constat" id="constat" <?php if($uncon=="Yes"){echo "checked";}?>>
                    <label for="constat">Unconscious
                        <style>
                            label {
                                display: inline;
                            }
                        </style>
                    </label>
                </div>
                <div class="col">
                    <input type="checkbox" class="form-check-input" name="mntorient" id="mntorient" <?php if($disor=="Yes"){echo "checked";}?>>
                    <label for="mntorient">Disoriented
                        <style>
                            label {
                                display: inline;
                            }
                        </style>
                    </label>
                </div>
                <div class="col">
                    <input type="checkbox" class="form-check-input" name="mobility" id="mobility" <?php if($bedrid=="Yes"){echo "checked";}?>>
                    <label for="mobility">Bedridden
                        <style>
                            label {
                                display: inline;
                            }
                        </style>
                    </label>
                </div>
                <div class="col">
                    <label for="builttype">Built Type</label>
                    <select name="builttype" id="builttype" class="form-control" >
                    <option value="" <?php if($builttype==""){echo "selected";}?> >Select a Built type</option>  
                    <option value="Well" <?php if($builttype=="Well"){echo "selected";}?>>Well</option>
                        <option value="Moderate" <?php if($builttype=="Moderate"){echo "selected";}?>>Moderate</option>
                        <option value="Poor" <?php if($builttype=="Poor"){echo "selected";}?>>Poor</option>
                    </select>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="geother">Allergies & Others</label>
                        <textarea class="textarea" maxlength="200" rows="5" cols="20" name="geother" class="form-control" ><?php echo $others; ?></textarea>
                    </div>
                </div>
            </div>
            <p style="page-break-after: always;"></p>
            <div class="row my-3">
                <h4 class="my-3">Care Plan Strategy</h4>
                <div class="col">
                    <input type="checkbox" class="form-check-input" name="cpsprevention" id="cpsprevention" <?php if($cpsprevention==1){echo "checked";}?>>
                    <label for="cpsprevention">Prevention
                        <style>
                            label {
                                display: inline;
                            }
                        </style>
                    </label>
                </div>
                <div class="col">
                    <input type="checkbox" class="form-check-input" name="cpscurative" id="cpscurative" <?php if($cpscurative==1){echo "checked";}?>>
                    <label for="cpscurative">Curative
                        <style>
                            label {
                                display: inline;
                            }
                        </style>
                    </label>
                </div>
                <div class="col">
                    <input type="checkbox" class="form-check-input" name="cpsrehabilitative" id="cpsrehabilitative" <?php if($cpsrehabitative==1){echo "checked";}?>>
                    <label for="cpsrehabilitative">Rehabilitative
                        <style>
                            label {
                                display: inline;
                            }
                        </style>
                    </label>
                </div>
                <div class="col">
                    <input type="checkbox" class="form-check-input" name="cpspromotive" id="cpspromotive" <?php if($cpspromotive==1){echo "checked";}?>>
                    <label for="cpspromotive">Promotive
                        <style>
                            label {
                                display: inline;
                            }
                        </style>
                    </label>
                </div>
            </div>
            <div class="row my-3">
                <h4 class="my-3">Care Plan </h4>
                <div class="col">
                    <select name="dietplan" class="form-control" id="dietplan" >
                        <option value="" <?php if($dietplan==""){echo "selected";}?> >Select Diet Plan</option>
                        <option value="Hypertention" <?php if($dietplan=="Hypertention"){echo "selected";}?>>Hypertention</option>
                        <option value="Madhumeha" <?php if($dietplan=="Madhumeha"){echo "selected";}?>>Madhumeha</option>
                        <option value="Obesity" <?php if($dietplan=="Obesity"){echo "selected";}?>>Obesity</option>
                        <option value="Virechana" <?php if($dietplan=="Virechana"){echo "selected";}?>>Virechana</option>
                        <option value="Vasthi" <?php if($dietplan=="Vasthi"){echo "selected";}?>>Vasthi</option>
                        <option value="Snehapana" <?php if($dietplan=="Snehapana"){echo "selected";}?>>Snehapana</option>
                        <option value="Vata" <?php if($dietplan=="Vata"){echo "selected";}?>>Vata</option>
                        <option value="Pitha" <?php if($dietplan=="Pitha"){echo "selected";}?>>Pitha</option>
                        <option value="Kapha" <?php if($dietplan=="Kapha"){echo "selected";}?>>Kapha</option>
                        <option value="General" <?php if($dietplan=="General"){echo "selected";}?>>General</option>
                    </select>
                </div>
                <div class="col">
                    <input type="checkbox" class="form-check-input" name="cpaaumed" id="cpaaumed" <?php if($apralrunmeds=="Yes"){echo "checked";}?>>
                    <label for="cpaaumed">Approve Already Undergoing Medicines
                        <style>
                            label {
                                display: inline;
                            }
                        </style>
                    </label>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <div class="form-group">
                        <label for="prodiag">Provisional Diagnosis</label>
                        <textarea class="textarea" maxlength="200" rows="5" cols="30" name="prodiag" class="form-control" ><?php echo $provdiag; ?></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="diagnosis">Diagnosis</label>
                        <textarea class="textarea" maxlength="200" rows="5" cols="30" name="diagnosis" class="form-control" ><?php echo $diagnosis; ?></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="investgations">Investigations (If Any)</label>
                        <textarea class="textarea" maxlength="200" rows="5" cols="30" name="investgations" class="form-control"> <?php echo $investigations; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <div class="form-group">
                        <label for="addictions">Addictions (If Any)</label>
                        <textarea class="textarea" maxlength="200" rows="5" cols="30" name="addictions" class="form-control"> <?php echo $addictions; ?></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="desireout">Desired Outcome</label>
                        <textarea class="textarea" maxlength="200" rows="5" cols="30" name="desireout" class="form-control" > <?php echo $desired_outcomes; ?></textarea>
                    </div>
                </div>
            </div>
            
            <button type="submit" name="submit" class="btn btn-primary my-3 mx-2">Save</button>
            <a href="visitdetails.php?user=<?php echo $user_id ?>&visit=<?php echo $visit_id ?>" class="btn btn-danger">Cancel</a>
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