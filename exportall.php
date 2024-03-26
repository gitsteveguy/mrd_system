<?php
include('connect.php');
include_once('header.php');
pheader("Visit Details");
$user_id;
$visit_id;
//form data variables//
//Patient Basic Details//
$first_name;
    $last_name;
    $profile_imgex="";
    $mrd_no ;
    $address_line_1;
    $address_line_2;
    $address_line_3 ;
    $phone;
    $email;
    $sql20 = "SELECT * FROM FSbNJe9_user_data WHERE user_id = '$user_id'";
    $result20 = $conn->query($sql20);
    $row20 = $result20->fetch_assoc();
    
    $first_name = $row20['first_name'];
    $last_name = $row20['last_name'];
    $profile_imgex = $row20['profile_img'];
    $mrd_no = $row20['mrd_no'];
    $address_line_1 = $row20['address_line_1'];
    $address_line_2 = $row20['address_line_2'];
    $address_line_3 = $row20['address_line_3'];
    $phone = $row20['phone_no'];
    $email = $row20['email'];
    $blood_group = $row20['blood_group'];
//ip initial assessment vars & php//
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
$investigations = "";
$desired_outcomes = "";
$sql2;
if (isset($_GET['user']) && isset($_GET['visit'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
} else {
    echo "Cannot find required parameters";
}

$sql = "SELECT * FROM ip_form WHERE visit_id =$visit_id";
$result = $conn->query($sql);
if(isset($result))
{$ip_form=true;}
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
    $investigations = $row['investigations'];
    $desired_outcomes = $row['desired_outcome'];

    //Medication Orders vars & php//
    $sql4 = "SELECT * FROM `medication_orders` WHERE visit_id=? ORDER BY date DESC,time DESC";
    $stmt4 = $conn->prepare($sql4);
    if (!$stmt4) {
        die("Error: " . $conn->error);
    }
    $stmt4->bind_param("i", $visit_id);
    if (!$stmt4->execute()) {
        die("Error: " . $stmt4->error);
    }
    $result4 = $stmt4->get_result();
    if($result4->num_rows > 0){
        $medication_order=true;
    }

    //Treatment Procedure Orders vars & php//
    $sql3 = "SELECT * FROM treat_proc_ord WHERE visit_id=?  ORDER BY date DESC, time DESC";
    $stmt3 = $conn->prepare($sql3);
    if (!$stmt3) {
        die("Error: " . $conn->error);
    }
    $stmt3->bind_param("i", $visit_id);
    if (!$stmt3->execute()) {
        die("Error: " . $stmt3->error);
    }
    $result3 = $stmt3->get_result();
    if($result3->num_rows > 0){
        $treatment_procedure=true;
    }

    //Vital Chart vars & php//
    $sql5 = "SELECT * FROM vital_chart_form WHERE visit_id=?  ORDER BY date DESC, time DESC";
    $stmt5 = $conn->prepare($sql5);
    if (!$stmt5) {
        die("Error: " . $conn->error);
    }
    $stmt5->bind_param("i", $visit_id);
    if (!$stmt5->execute()) {
        die("Error: " . $stmt5->error);
    }
    $result5 = $stmt5->get_result();
    if($result5->num_rows > 0){
        $vital_chart=true;
    }

    //Doctor Observation Chart vars & php//
    $sql6 = "SELECT * FROM doctor_observe_chart_form WHERE visit_id=?  ORDER BY date DESC, time DESC";
    $stmt6 = $conn->prepare($sql6);
    if (!$stmt6) {
        die("Error: " . $conn->error);
    }
    $stmt6->bind_param("i", $visit_id);
    if (!$stmt6->execute()) {
        die("Error: " . $stmt6->error);
    }
    $result6 = $stmt6->get_result();
    if($result6->num_rows > 0){
        $doctor_observation=true;
    }

    //Panchakarma Consent Form vars & php//
    $panchagreest = "";
    $datepanch = "";
    $timepanch = "";
    $resnosign = "";
    $nmofnxtkin = "";
    $kinsignloc = "";
    $panch_form_id = "";
    $patsign = "";
    $sql7 = "SELECT * FROM FSbNJe9_user_data WHERE user_id = ?";
    $stmt7 = $conn->prepare($sql7);
    $stmt7->bind_param("i", $user_id);
    if (!$stmt7->execute()) {
        die("Error: " . $stmt7->error);
    }
    $result7 = $stmt7->get_result();
    $fetched_user = $result7->fetch_assoc();
    $first_name = $fetched_user['first_name'];
    $last_name = $fetched_user['last_name'];
    $patsign = $fetched_user['signature_img'];

    $sql8 = "SELECT * FROM panchakarma_consent_form WHERE visit_id = ?";
    $stmt8 = $conn->prepare($sql8);
    $stmt8->bind_param("i", $visit_id);
    if (!$stmt8->execute()) {
        die("Error: " . $stmt8->error);
    }
    $result8 = $stmt8->get_result();
    $exispanch_form = $result8->fetch_assoc();
    if ($result8->num_rows > 0) {
        $panch_form_id = $exispanch_form['panch_form_id'];
        $panchagreest = $exispanch_form['agreestat'];
        $datepanch = $exispanch_form['date'];
        $timepanch = $exispanch_form['time'];
        $resnosign = ($exispanch_form['reas_not_sign'] != "") ? $exispanch_form['reas_not_sign'] : "";
        $nmofnxtkin = $exispanch_form['name_kin'];
        $kinsignloc = $exispanch_form['kin_sign_loc'];
    }
    if($result8->num_rows > 0){
        $panchkarma_consent_form=true;
    }
}

//Panchakarma Procedure Details vars & php//
$sql9 = "SELECT * FROM panchakarma_consent_proc_form WHERE visit_id=?  ORDER BY date DESC, time DESC";
$stmt9 = $conn->prepare($sql9);
if (!$stmt9) {
    die("Error: " . $conn->error);
}
$stmt9->bind_param("i", $visit_id);
if (!$stmt9->execute()) {
    die("Error: " . $stmt9->error);
}
$result9 = $stmt9->get_result();
if($result9->num_rows > 0){
    $panchkarma_procedure_form=true;
}

//Procedure Operative Notes vars & php//
$datevital = "";;
$timevital = "";
$propef = "";
$sal_step = "";
$keyfinds = "";
$samasams = "";
$suggestionsvital = "";
$remarksvital = "";
$samsar = "";
$pathya = "";
$nursingcare = "";

$sql10 = "SELECT * FROM procedure_operative_notes WHERE visit_id = ?";
$stmt10 = $conn->prepare($sql10);
$stmt10->bind_param("i", $visit_id);
if (!$stmt10->execute()) {
    die("Error: " . $stmt10->error);
}
$result10 = $stmt10->get_result();
$expro_op_from = $result10->fetch_assoc();
if ($result10->num_rows > 0) {
    $datevital = $expro_op_from['date'];
    $timevital = $expro_op_from['time'];
    $propef = $expro_op_from['pro_perf'];
    $sal_step = $expro_op_from['sal_step_pro'];
    $keyfinds = $expro_op_from['key_find_vya'];
    $samasams = $expro_op_from['sam_asam_laks_obs'];
    $suggestionsvital = $expro_op_from['suggestions'];
    $remarksvital = $expro_op_from['remarks'];
    $samsar = $expro_op_from['samsar'];
    $pathya = $expro_op_from['pathya_adv'];
    $nursingcare = $expro_op_from['nursing_care'];
    $procedure_operative_notes = true;
}

//Fall Risk Assessment vars & php//
$prefallhis = "";
$vulcpa = "";
$viimp = "";
$muswek = "";
$phydisop = "";
$gaisofpat = "";
$balnmobis = "";
$lwblbp = "";
$almtstop = "";
$posmedsd = "";
$aldrabwlsymp = "";
$protype = "";
$otrep = "";
$preacttak = "";
$timefall = "";
$datefall = "";

$sql11 = "SELECT * FROM fall_risk_assesments WHERE visit_id = ?";
$stmt11 = $conn->prepare($sql11);
$stmt11->bind_param("i", $visit_id);
if (!$stmt11->execute()) {
    die("Error: " . $stmt11->error);
}
$result11 = $stmt11->get_result();
$exfallr_form = $result11->fetch_assoc();
if ($result11->num_rows > 0) {
    $prefallhis = $exfallr_form['prev_fall_his'];
    $vulcpa = $exfallr_form['vuln_cat_pat'];
    $viimp = $exfallr_form['vis_imp'];
    $muswek = $exfallr_form['muscle_weak'];
    $phydisop = $exfallr_form['phy_dis'];
    $gaisofpat = $exfallr_form['gait_instable'];
    $balnmobis = $exfallr_form['balance_mob'];
    $lwblbp = $exfallr_form['low_bp'];
    $almtstop = $exfallr_form['alt_ment_st_pat'];
    $posmedsd = $exfallr_form['pos_med_side_fx'];
    $aldrabwlsymp = $exfallr_form['alc_dru_wtdr_syms'];
    $protype = $exfallr_form['procedure_type'];
    $otrep = $exfallr_form['oth_rev_pt'];
    $preacttak = $exfallr_form['prvn_acts_tak'];
    $timefall = $exfallr_form['time'];
    $datefall = $exfallr_form['date'];
    $fall_risk_assesment=true;
}

//Nurse's Initial Assessment vars & php//
$conphy_id = "";
$conphy = "";
$mobility = "";
$patanymed = "";
$feed = "";
$detonadd = "";
$drugallerg = "";
$datenia = "";
$timenia = "";

$sql12 = "SELECT * FROM FSbNJe9_user_data WHERE role='Doctor'";
$result12 = $conn->query($sql12);
$sql13 = "SELECT * FROM nurses_initial_assessments WHERE visit_id = ?";
$stmt13 = $conn->prepare($sql13);
$stmt13->bind_param("i", $visit_id);
if (!$stmt13->execute()) {
    die("Error: " . $stmt13->error);
}
$result13 = $stmt13->get_result();
$exnur_ina_form = $result13->fetch_assoc();
if ($result13->num_rows > 0) {
    $conphy_id = $exnur_ina_form['con_phy_id'];
    $conphy = $exnur_ina_form['con_phy_name'];
    $mobility = $exnur_ina_form['mobility'];
    $patanymed = $exnur_ina_form['pat_und_meds'];
    $feed = $exnur_ina_form['feed'];
    $detonadd = $exnur_ina_form['det_on_admission'];
    $drugallerg = $exnur_ina_form['drug_allerg'];
    $datenia = $exnur_ina_form['date'];
    $timenia = $exnur_ina_form['time'];
    $nurse_initial_risk=true;
}
//Nursing Care Plan vars & php//
$sql14 = "SELECT * FROM nursing_care_plan WHERE visit_id=? ORDER BY date DESC, time DESC";
$stmt14 = $conn->prepare($sql14);
if (!$stmt14) {
    die("Error: " . $conn->error);
}
$stmt14->bind_param("i", $visit_id);
if (!$stmt14->execute()) {
    die("Error: " . $stmt14->error);
}
$result14 = $stmt14->get_result();

//Medication Administration Chart//
$sql15 = "SELECT * FROM medication_adm_chart_form WHERE visit_id=? ORDER BY date DESC, time DESC";
$stmt15 = $conn->prepare($sql15);
if (!$stmt15) {
    die("Error: " . $conn->error);
}
$stmt15->bind_param("i", $visit_id);
if (!$stmt15->execute()) {
    die("Error: " . $stmt15->error);
}
$result15 = $stmt15->get_result();

//Nurse Daily Notes vars & php//
$sql16 = "SELECT * FROM nurse_daily_notes WHERE visit_id=? ORDER BY date DESC, time DESC";
$stmt16 = $conn->prepare($sql16);
if (!$stmt16) {
    die("Error: " . $conn->error);
}
$stmt16->bind_param("i", $visit_id);
if (!$stmt16->execute()) {
    die("Error: " . $stmt16->error);
}
$result16 = $stmt16->get_result();

//Nurse Daily Record vars & php//
$sql17 = "SELECT * FROM nurse_daily_records WHERE visit_id=? ORDER BY date DESC, time DESC";
$stmt17 = $conn->prepare($sql17);
if (!$stmt17) {
    die("Error: " . $conn->error);
}
$stmt17->bind_param("i", $visit_id);
if (!$stmt17->execute()) {
    die("Error: " . $stmt17->error);
}
$result17 = $stmt17->get_result();


//Treatment Chart vars & php//
$sql18 = "SELECT * FROM treatment_charts WHERE visit_id=? ORDER BY date DESC, time_out DESC";
        $stmt18 = $conn->prepare($sql18);
        if (!$stmt18) {
            die("Error: " . $conn->error);
        }
        $stmt18->bind_param("i", $visit_id);
        if (!$stmt18->execute()) {
            die("Error: " . $stmt18->error);
        }
        $result18 = $stmt18->get_result();

//Discharge Summary vars & php//
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

$sql19 = "SELECT * FROM discharge_summary WHERE visit_id = ?";
$stmt19 = $conn->prepare($sql19);
$stmt19->bind_param("i",$visit_id);
if (!$stmt19->execute()) {
    die("Error: " . $stmt19->error);
  }
$result19 = $stmt19->get_result();
$exdis_form = $result19->fetch_assoc();
if($result19->num_rows > 0)
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
    $discharge_summary=true;
}
    ?>

<body>
<!--Patent Basic Details -->
<div class="container">
<h1 class="text-center my-3">Patient Details</h1>
<div class="row my-2">
    <div class="col">
        <img src="<?php echo $profile_imgex?>" width="150" height="100" alt="">
    </div>
    <div class="col"></div>
    <div class="col"></div>
</div>
<form method="post" action="">
    <fieldset disabled="disabled">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="mrd_no">MRD No</label>
                            <input type="text" class="form-control" name="mrd_no" value="<?php echo $mrd_no; ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="bloodgroup">Blood Group</label>
                            <input type="text" class="form-control" name="bloodgroup" value="<?php echo $blood_group; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="addressline1">Address Line 1</label>
                            <input type="text" class="form-control" name="addressline1" required value="<?php echo $address_line_1; ?>"></input>
                        </div>
                    </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="addressline2">Address Line 2</label>
                                <input type="text" class="form-control" name="addressline2" required value="<?php echo $address_line_2; ?>"></input>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="addressline3">Address Line 3</label>
                                <input type="text" class="form-control" name="addressline3" required value="<?php echo $address_line_3; ?>"></input>
                            </div>
                        </div>
                    </div>
                    </fieldset>
            </form>
</div>
<p style="page-break-after: always;"></p>

<!--ip initial Assesment -->

<?php if($ip_form) {?>
    <div class="container">
        <h1 class="text-center my-3">Initial Assesment</h1>
        <div class="container d-flex justify-content-center">
            <form id="create_patient" action="" method="post">

                <fieldset disabled="disabled">

                    <div class="row my-3">
                        <h3>Vital Signs</h3>
                        <div class="col">
                            <div class="form-group">
                                <label for="temperature">Temperature</label>
                                <input type="text" class="form-control" name="temperature" maxlength="3" value="<?php echo $temp ?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="pulse">Pulse</label>
                                <input type="text" class="form-control" name="pulse" maxlength="3" value="<?php echo $pulse ?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="pulsetype">Pulse Type</label>
                            <select name="pulsetype" id="pulsetype" class="form-control" required>
                                <option value="" <?php if ($pulse_type === '') {
                                                        echo ' selected';
                                                    } ?> disabled hidden>Select the Type</option>
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
                                <input type="text" class="form-control" name="bp" maxlength="3" value="<?php echo $bp ?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="height">Height</label>
                                <input type="text" class="form-control" name="height" maxlength="3" value="<?php echo $height ?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="painassessment">Pain Assesment</label>
                            <select name="painassessment" id="painassessment" class="form-control" required>
                                <option value="" <?php if ($pain === '') {
                                                        echo ' selected';
                                                    } ?> disabled hidden>Select the Correct Value</option>
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
                                <input type="text" class="form-control" name="weight" maxlength="4" value="<?php echo $weight ?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="bmi">Body Mass Index</label>
                                <input type="text" class="form-control" name="bmi" maxlength="3" value="<?php echo $bmi ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <h3 class="my-3">Nutritional Screening</h3>
                        <div class="col">
                            <label for="built">Built</label>
                            <select name="built" id="built" class="form-control" required>
                                <option value="" <?php if ($built === '') {
                                                        echo ' selected';
                                                    } ?> disabled hidden>Select the Correct Option</option>
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
                            <select name="gastric" id="gastric" class="form-control" required>
                                <option value="" <?php if ($gsisx === '') {
                                                        echo ' selected';
                                                    } ?> disabled hidden>Select the Correct Option</option>
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
                                <input type="text" class="form-control" name="weightgalo" maxlength="4" value="<?php echo $wtgain ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col">
                            <label for="nutri_stat">Nutritional Status</label>
                            <select name="nutri_stat" id="nutri_stat" class="form-control" required>
                                <option value="" <?php if ($nusts === '') {
                                                        echo ' selected';
                                                    } ?> disabled hidden>Select the Correct Option</option>
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
                            <select name="diffinphyact" id="diffinphyact" class="form-control" required>
                                <option value="" <?php if ($dpa === '') {
                                                        echo ' selected';
                                                    } ?> disabled hidden>Select the Correct Option</option>
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
                            <select name="infovisp" id="infovisp" class="form-control" required>
                                <option value="" <?php if ($ifvs === '') {
                                                        echo ' selected';
                                                    } ?> disabled hidden>Select the Correct Option</option>
                                <option value="Yes" <?php if ($ifvs === 'Yes') {
                                                        echo ' selected';
                                                    } ?>>Yes</option>
                                <option value="No" <?php if ($ifvs === 'No') {
                                                        echo ' selected';
                                                    } ?>>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="prescompndur">Presenting Complaints & Duration</label>
                                <textarea class="textarea" maxlength="500" rows="10" cols="30" name="prescompndur" class="form-control"><?php echo $prscd ?></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="hispresill">History of Presenting Illness</label>
                                <textarea class="textarea" maxlength="500" rows="10" cols="30" name="hispresill" class="form-control"><?php echo $hisprsill ?></textarea>
                            </div>
                        </div>
                        <p style="page-break-after: always;"></p>
                        <div class="col">
                            <div class="form-group">
                                <label for="hisprevill">History of Previous Illnesses</label>
                                <textarea class="textarea" maxlength="500" rows="10" cols="30" name="hisprevill" class="form-control"><?php echo $hisprvill ?></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="treatmeddet">Treatment / Medication Details</label>
                                <textarea class="textarea" maxlength="500" rows="10" cols="30" name="treatmeddet" class="form-control"><?php echo $trtmeddet ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col">
                            <label for="bowelhab">Bowel Habbits</label>
                            <input type="text" class="form-control" maxlength="20" name="bowelhab" value="<?php echo $bowhab ?>" required>
                        </div>
                        <div class="col">
                            <label for="appetite">Appetite</label>
                            <input type="text" class="form-control" maxlength="20" name="appetite" value="<?php echo $appetite ?>" required>
                        </div>
                        <div class="col">
                            <label for="micturition">Micturition</label>
                            <input type="text" class="form-control" maxlength="20" name="micturition" value="<?php echo $micturition ?>" required>
                        </div>
                        <div class="col">
                            <label for="sleep">Sleep</label>
                            <input type="text" class="form-control" maxlength="20" name="sleep" value="<?php echo $sleep ?>" required>
                        </div>
                    </div>
                    <?php
                    $sql2 = "SELECT * FROM FSbNJe9_user_data WHERE user_id =$user_id";
                    $result2 = $conn->query($sql2);
                    $row3 = $result2->fetch_assoc();
                    if ($row3['gender'] != "Male" && $row2['gender'] != "male") {
                    ?>
                        <div class="row my-3">
                            <h3 class="my-3">Menstruation Details</h3>
                            <div class="col">
                                <label for="mcycle">Menstruation Cycle</label>
                                <select name="mcycle" id="mcycle" class="form-control" required>
                                    <option value="" <?php if ($menstr_cycle == "") {
                                                            echo "selected";
                                                        } ?> disabled hidden>Select the Type</option>
                                    <option value="Regular" <?php if ($menstr_cycle == "Regular") {
                                                                echo "selected";
                                                            } ?>>Regular</option>
                                    <option value="Irregular" <?php if ($menstr_cycle == "Irregular") {
                                                                    echo "selected";
                                                                } ?>>Irregular</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="mflow">Menstruation Flow</label>
                                <select name="mflow" id="mflow" class="form-control" required>
                                    <option value="" <?php if ($menstr_flow == "") {
                                                            echo "selected";
                                                        } ?> disabled hidden>Select the Type</option>
                                    <option value="Normal" <?php if ($menstr_flow == "Normal") {
                                                                echo "selected";
                                                            } ?>>Normal</option>
                                    <option value="Less" <?php if ($menstr_flow == "Less") {
                                                                echo "selected";
                                                            } ?>>Less</option>
                                    <option value="More" <?php if ($menstr_flow == "More") {
                                                                echo "selected";
                                                            } ?>>More</option>
                                    <option value="Irregular" <?php if ($menstr_flow == "Irregular") {
                                                                    echo "selected";
                                                                } ?>>Irregular</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="massocwt">Menstruation Associated With</label>
                                <select name="massocwt" id="massocwt" class="form-control" required>
                                    <option value="" <?php if ($menstr_assoc == "") {
                                                            echo "selected";
                                                        } ?> disabled hidden>Select the Option</option>
                                    <option value="Nill" <?php if ($menstr_assoc == "Nill") {
                                                                echo "selected";
                                                            } ?>>Nill</option>
                                    <option value="Pain" <?php if ($menstr_assoc == "Pain") {
                                                                echo "selected";
                                                            } ?>>Pain</option>
                                    <option value="Clot" <?php if ($menstr_assoc == "Clot") {
                                                                echo "selected";
                                                            } ?>>Clot</option>
                                    <option value="Muscle Cramps" <?php if ($menstr_assoc == "Muscle Cramps") {
                                                                        echo "selected";
                                                                    } ?>>Muscle Cramps</option>
                                    <option value="White Discharge" <?php if ($menstr_assoc == "White Discharge") {
                                                                        echo "selected";
                                                                    } ?>>White Discharge</option>
                                </select>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="row my-3">
                        <h3 class="my-3">General Examination</h3>
                        <div class="col">
                            <input type="checkbox" class="form-check-input" name="constat" id="constat" <?php if ($uncon == "Yes") {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                            <label for="constat">Unconscious
                                <style>
                                    label {
                                        display: inline;
                                    }
                                </style>
                            </label>
                        </div>
                        <div class="col">
                            <input type="checkbox" class="form-check-input" name="mntorient" id="mntorient" <?php if ($disor == "Yes") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                            <label for="mntorient">Disoriented
                                <style>
                                    label {
                                        display: inline;
                                    }
                                </style>
                            </label>
                        </div>
                        <div class="col">
                            <input type="checkbox" class="form-check-input" name="mobility" id="mobility" <?php if ($bedrid == "Yes") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
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
                            <select name="builttype" id="builttype" class="form-control" required>
                                <option value="" <?php if ($builttype == "") {
                                                        echo "selected";
                                                    } ?> disabled hidden>Select a Built type</option>
                                <option value="Well" <?php if ($builttype == "Well") {
                                                            echo "selected";
                                                        } ?>>Well</option>
                                <option value="Moderate" <?php if ($builttype == "Moderate") {
                                                                echo "selected";
                                                            } ?>>Moderate</option>
                                <option value="Poor" <?php if ($builttype == "Poor") {
                                                            echo "selected";
                                                        } ?>>Poor</option>
                            </select>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="geother">Others</label>
                                <textarea class="textarea" maxlength="200" rows="5" cols="20" name="geother" class="form-control"><?php echo $others; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <h4 class="my-3">Care Plan Strategy</h4>
                        <div class="col">
                            <input type="checkbox" class="form-check-input" name="cpsprevention" id="cpsprevention" <?php if ($cpsprevention == 1) {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                            <label for="cpsprevention">Prevention
                                <style>
                                    label {
                                        display: inline;
                                    }
                                </style>
                            </label>
                        </div>
                        <div class="col">
                            <input type="checkbox" class="form-check-input" name="cpscurative" id="cpscurative" <?php if ($cpscurative == 1) {
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                            <label for="cpscurative">Curative
                                <style>
                                    label {
                                        display: inline;
                                    }
                                </style>
                            </label>
                        </div>
                        <div class="col">
                            <input type="checkbox" class="form-check-input" name="cpsrehabilitative" id="cpsrehabilitative" <?php if ($cpsrehabitative == 1) {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                            <label for="cpsrehabilitative">Rehabilitative
                                <style>
                                    label {
                                        display: inline;
                                    }
                                </style>
                            </label>
                        </div>
                        <div class="col">
                            <input type="checkbox" class="form-check-input" name="cpspromotive" id="cpspromotive" <?php if ($cpspromotive == 1) {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
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
                            <select name="dietplan" class="form-control" id="dietplan" required>
                                <option value="" <?php if ($dietplan == "") {
                                                        echo "selected";
                                                    } ?> disabled hidden>Select Diet Plan</option>
                                <option value="Hypertention" <?php if ($dietplan == "Hypertention") {
                                                                    echo "selected";
                                                                } ?>>Hypertention</option>
                                <option value="Madhumeha" <?php if ($dietplan == "Madhumeha") {
                                                                echo "selected";
                                                            } ?>>Madhumeha</option>
                                <option value="Obesity" <?php if ($dietplan == "Obesity") {
                                                            echo "selected";
                                                        } ?>>Obesity</option>
                                <option value="Virechana" <?php if ($dietplan == "Virechana") {
                                                                echo "selected";
                                                            } ?>>Virechana</option>
                                <option value="Vasthi" <?php if ($dietplan == "Vasthi") {
                                                            echo "selected";
                                                        } ?>>Vasthi</option>
                                <option value="Snehapana" <?php if ($dietplan == "Snehapana") {
                                                                echo "selected";
                                                            } ?>>Snehapana</option>
                                <option value="Vata" <?php if ($dietplan == "Vata") {
                                                            echo "selected";
                                                        } ?>>Vata</option>
                                <option value="Pitha" <?php if ($dietplan == "Pitha") {
                                                            echo "selected";
                                                        } ?>>Pitha</option>
                                <option value="Kapha" <?php if ($dietplan == "Kapha") {
                                                            echo "selected";
                                                        } ?>>Kapha</option>
                                <option value="General" <?php if ($dietplan == "General") {
                                                            echo "selected";
                                                        } ?>>General</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="checkbox" class="form-check-input" name="cpaaumed" id="cpaaumed" <?php if ($apralrunmeds == "Yes") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
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
                                <textarea class="textarea" maxlength="200" rows="5" cols="30" name="prodiag" class="form-control"><?php echo $provdiag; ?></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="investgations">Investigations (If Any)</label>
                                <textarea class="textarea" maxlength="200" rows="5" cols="30" name="investgations" class="form-control"> <?php echo $investigations; ?></textarea>
                            </div>
                        </div>
                         <p style="page-break-after: always;"></p>
                        <div class="col">
                            <div class="form-group">
                                <label for="desireout">Desired Outcome</label>
                                <textarea class="textarea" maxlength="200" rows="5" cols="30" name="desireout" class="form-control"> <?php echo $desired_outcomes; ?></textarea>
                            </div>
                        </div>
                    </div>
                </fieldset>

            </form>
        </div>
    </div>
    <p style="page-break-after: always;"></p>
<?php } ?>
    <!--Medication Records -->
   <?php if($medication_order) { ?> 
    <div>
        <div class="container">
            <hr style="width:100%;background-color:white;color:white;height:5px;">
            <div class="row">
                <div class="col">
                    <h1 class="text-center">Medications Order Records</h1>
                </div>
            </div>
            <?php
            if ($result4->num_rows > 0) {
            ?>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered align-middle" style="color:white;">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center text-nowrap align-middle">Date</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Medicine</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Route / Site</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Dose</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Time</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Anupana</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Remarks</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Doctor's Name</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Doctor's Sign</th>
                                    </tr>
                                </thead>
                                <?php while ($row2 = $result4->fetch_assoc()) { ?>
                                    <tbody>
                                        <tr>
                                            <td class="text-center text-nowrap"><?php echo date("d-m-Y", strtotime($row2['date'])); ?></td>
                                            <td class="text-center"><?php echo $row2['medicine']; ?></td>
                                            <td class="text-center text-nowrap"><?php echo $row2['route_site']; ?></td>
                                            <td class="text-center text-nowrap"><?php echo $row2['dose']; ?></td>
                                            <td class="text-center text-nowrap"><?php echo date('g:i a', strtotime($row2['time'])); ?></td>
                                            <td class="text-center text-nowrap"><?php echo $row2['anupana']; ?></td>
                                            <td class="text-center text-nowrap"><?php echo $row2['remarks']; ?></td>
                                            <td class="text-center text-nowrap"><?php echo $row2['doctor_name']; ?></td>
                                            <td class="text-center"><img src="<?php echo $row2['doctors_sign']; ?>" alt="Doctor's Sign" width="100" height="90"></td>
                                        </tr>
                                    </tbody>
                            <?php }
                            } ?>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <p style="page-break-after: always;"></p>
    <?php } ?>
    <!--Treatment Procedure Records -->
    <?php if($treatment_procedure){?>
    <div class="container">
        <hr style="width:100%;background-color:white;color:white;height:5px;">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Treatment Procedure Records</h1>
            </div>
        </div>
        <?php
        if ($result3->num_rows > 0) {
        ?>

            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered align-middle" style="color:white;">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center text-nowrap align-middle">Date</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Time</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Procedure</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Medicine</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Site / Location</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">No: of Days</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Precautions if any</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Doctor's Name</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Doctor's Sign</th>
                                </tr>
                            </thead>
                            <?php while ($row2 = $result3->fetch_assoc()) { ?>
                                <tbody>
                                    <tr>
                                        <td class="text-center text-nowrap"><?php echo date("d-m-Y", strtotime($row2['date'])); ?></td>
                                        <td class="text-center text-nowrap"><?php echo date('g:i a', strtotime($row2['time'])); ?></td>
                                        <td class="text-center"><?php echo $row2['treat_proced']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['medicine']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['site_loc']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['no_of_days']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['precautions']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['doctor_name']; ?></td>
                                        <td class="text-center"><img src="<?php echo $row2['doctors_sign']; ?>" alt="Doctor's Sign" width="100" height="90"></td>
                                    </tr>
                                </tbody>
                        <?php }
                        } ?>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <p style="page-break-after: always;"></p>
<?php } ?>
    <!--Vital Chart Records -->
    <?php if($vital_chart) {?>
    <div class="container">
        <hr style="width:100%;background-color:white;color:white;height:5px;">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Vital Chart Records</h1>
            </div>
        </div>
        <?php
        if ($result5->num_rows > 0) {
        ?>

            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered align-middle" style="color:white;">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center text-nowrap align-middle">Date</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Time</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Temperature</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Pulse</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">B.P</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Weight</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Remarks</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Doctor's Name</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Doctor's Sign</th>
                                </tr>
                            </thead>
                            <?php while ($row2 = $result5->fetch_assoc()) { ?>
                                <tbody>
                                    <tr>
                                        <td class="text-center text-nowrap"><?php echo date("d-m-Y", strtotime($row2['date'])); ?></td>
                                        <td class="text-center text-nowrap"><?php echo date('g:i a', strtotime($row2['time'])); ?></td>
                                        <td class="text-center"><?php echo $row2['temp']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['pulse']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['bp']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['weight']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['remarks']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['doctor_name']; ?></td>
                                        <td class="text-center"><img src="<?php echo $row2['doctors_sign']; ?>" alt="Doctor's Sign" width="100" height="90"></td>
                                    </tr>
                                </tbody>
                        <?php }
                        } ?>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <p style="page-break-after: always;"></p>
<?php } ?>
    <!--Doctor Observation Chart Records -->
    <?php if($doctor_observation) {?>
    <div class="container">
        <hr style="width:100%;background-color:white;color:white;height:5px;">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Doctor Observation Chart Records</h1>
            </div>
        </div>
        <?php
        if ($result6->num_rows > 0) {
        ?>

            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered align-middle" style="color:white;">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center text-nowrap align-middle">Date</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Time</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Medicine Modification</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Procedure Modification</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Doctor's Name</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Doctor's Sign</th>
                                </tr>
                            </thead>
                            <?php while ($row2 = $result6->fetch_assoc()) { ?>
                                <tbody>
                                    <tr>
                                        <td class="text-center text-nowrap"><?php echo date("d-m-Y", strtotime($row2['date'])); ?></td>
                                        <td class="text-center text-nowrap"><?php echo date('g:i a', strtotime($row2['time'])); ?></td>
                                        <td class="text-center"><?php echo $row2['medmod']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['promod']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['doctor_name']; ?></td>
                                        <td class="text-center"><img src="<?php echo $row2['doctors_sign']; ?>" alt="Doctor's Sign" width="100" height="90"></td>
                                    </tr>
                                </tbody>
                        <?php }
                        } ?>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <p style="page-break-after: always;"></p>
<?php } ?>
    <!--Panchakarma Consent Form -->
   
    <div class="container">
        <hr style="width:100%;background-color:white;color:white;height:5px;">
        <?php if($panchkarma_consent_form){ ?>
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
                <fieldset disabled="disabled">
                    <div class="row my-2">
                        <div class="col">
                            <div class="form-group">
                                <input type="checkbox" class="form-check-input" name="agreepanch" id="agreepanch" <?php if ($panchagreest) {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
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
                                <input type="date" name="date" class="form-control" value="<?php echo $datepanch; ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="time">Time</label>
                                <input type="time" name="time" class="form-control" value="<?php echo $timepanch; ?>">
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
                    </div>
                    <?php
                    if ($kinsignloc) {
                    ?>
                        <div class="row my-2">
                            <div class="col"></div>
                            <div class="col">
                                <h3>Kin's Signature</h3><br>
                                <img src="<?php echo $kinsignloc ?>" width="200" height="200" alt="">
                            </div>
                            <div class="col">
                                <?php if ($patsign) { ?>
                                    <h3>Patient's Signature</h3><br>
                                    <img src="<?php echo $patsign ?>" width="200" height="200" alt="">
                                <?php } ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </fieldset>
            </form>
        </div>
        <p style="page-break-after: always;"></p>
        <?php } ?>
        <!--Panchakarma Procedure Details -->
        <?php if($panchkarma_procedure_form){ ?>
        <div class="container">
            <hr style="width:100%;background-color:white;color:white;height:5px;">
            <div class="row">
                <div class="col">
                    <h1 class="text-center">Panchakarma Procedure Details</h1>
                </div>
            </div>
            <?php
            if ($result9->num_rows > 0) {
            ?>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered align-middle" style="color:white;">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center text-nowrap align-middle">Date</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Time</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Procedure Details</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Duration</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Procedure Type</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Doctor's Name</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Doctor's Sign</th>
                                    </tr>
                                </thead>
                                <?php while ($row2 = $result9->fetch_assoc()) { ?>
                                    <tbody>
                                        <tr>
                                            <td class="text-center text-nowrap"><?php echo date("d-m-Y", strtotime($row2['date'])); ?></td>
                                            <td class="text-center text-nowrap"><?php echo date('g:i a', strtotime($row2['time'])); ?></td>
                                            <td class="text-center"><?php echo $row2['proced_details']; ?></td>
                                            <td class="text-center text-nowrap"><?php echo $row2['duration']; ?></td>
                                            <td class="text-center text-nowrap"><?php echo $row2['proc_type']; ?></td>
                                            <td class="text-center text-nowrap"><?php echo $row2['doctor_name']; ?></td>
                                            <td class="text-center"><img src="<?php echo $row2['doctors_sign']; ?>" alt="Doctor's Sign" width="100" height="90"></td>
                                        </tr>
                                    </tbody>
                            <?php }
                            } ?>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
        <p style="page-break-after: always;"></p>
        <?php } ?>

        <!--Procedure Operative Notes -->
        <?php if($procedure_operative_notes) {?>
        <div class="container">
            <hr style="width:100%;background-color:white;color:white;height:5px;">
            <div class="row">
                <div class="col">
                    <h1 class="text-center">Procedure Operative Notes Records</h1>
                </div>
            </div>
            <div class="container d-flex justify-content-center">
                <form method="POST" action="">
                    <fieldset disabled="disabled">
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
                                    <textarea class="textarea" name="suggestions" rows="4" maxlength="350" cols="25"><?php echo $suggestionsvital ?></textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea class="textarea" name="remarks" rows="4" maxlength="350" cols="25"><?php echo $remarksvital ?></textarea>
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
                                    <input type="date" name="date" class="form-control" value="<?php echo $datevital ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="time">Time</label>
                                    <input type="time" name="time" class="form-control" value="<?php echo $timevital ?>">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <p style="page-break-after: always;"></p>
<?php } ?>
        <!--Fall Risk Assessment -->
        <?php if($fall_risk_assesment) {?>
        <div class="container">
            <hr style="width:100%;background-color:white;color:white;height:5px;">
            <div class="row">
                <div class="col">
                    <h1 class="text-center">Fall Risk Assessment</h1>
                </div>
            </div>
            <div class="container mx-5 w-100 px-2">
                <form method="POST" action="">
                    <fieldset disabled="disabled">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" name="prefallhis" <?php if ($prefallhis == "Yes") {
                                                                                                            echo "checked";
                                                                                                        } ?> id="prefallhis">
                                    <label for="prefallhis">Previous Fall History
                                        <style>
                                            label {
                                                display: inline;
                                            }
                                        </style>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" name="vulcpa" id="vulcpa" <?php if ($vulcpa == "Yes") {
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                                    <label for="vulcpa">Vulnerable Category Patient
                                        <style>
                                            label {
                                                display: inline;
                                            }
                                        </style>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" name="viimp" id="viimp" <?php if ($viimp == "Yes") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                                    <label for="viimp">Visual Impairment
                                        <style>
                                            label {
                                                display: inline;
                                            }
                                        </style>
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" name="phydisop" id="phydisop" <?php if ($phydisop == "Yes") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                    <label for="phydisop">Physical Disability (especially lower limb) of Patient
                                        <style>
                                            label {
                                                display: inline;
                                            }
                                        </style>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" name="muswek" id="muswek" <?php if ($muswek == "Yes") {
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                                    <label for="muswek">Muscle Weakness
                                        <style>
                                            label {
                                                display: inline;
                                            }
                                        </style>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" name="gaisofpat" id="gaisofpat" <?php if ($gaisofpat == "Yes") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                    <label for="gaisofpat">Gait Instability of Patient
                                        <style>
                                            label {
                                                display: inline;
                                            }
                                        </style>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" name="balnmobis" id="balnmobis" <?php if ($balnmobis == "Yes") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                    <label for="balnmobis">Balance & Mobility Issue
                                        <style>
                                            label {
                                                display: inline;
                                            }
                                        </style>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" name="lwblbp" id="lwblbp" <?php if ($lwblbp == "Yes") {
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                                    <label for="lwblbp">Low Blood Pressure
                                        <style>
                                            label {
                                                display: inline;
                                            }
                                        </style>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" name="almtstop" id="almtstop" <?php if ($almtstop == "Yes") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                    <label for="almtstop">Altered Mental Status of Patient
                                        <style>
                                            label {
                                                display: inline;
                                            }
                                        </style>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" name="posmedsd" id="posmedsd" <?php if ($posmedsd == "Yes") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                    <label for="posmedsd">Possibility of Medication(s) side effect
                                        <style>
                                            label {
                                                display: inline;
                                            }
                                        </style>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input" name="aldrabwlsymp" id="aldrabwlsymp" <?php if ($aldrabwlsymp == "Yes") {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                    <label for="aldrabwlsymp">Alcohol or Drug Abuse Withdrawal Symptoms
                                        <style>
                                            label {
                                                display: inline;
                                            }
                                        </style>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <label for="protype">Procedure Type</label>
                                <select name="protype" id="protype" class="form-control" required>
                                    <option value="" selected disabled hidden>Select Type</option>
                                    <option value="Regular" <?php if ($protype == "Regular") {
                                                                echo "Selected";
                                                            } ?>>Low</option>
                                    <option value="Modified" <?php if ($protype == "Modified") {
                                                                    echo "Selected";
                                                                } ?>>Moderate</option>
                                    <option value="High" <?php if ($protype == "High") {
                                                                echo "Selected";
                                                            } ?>>High</option>
                                </select>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="otrep">Other Relevent Point,If Any </label>
                                    <textarea class="textarea" maxlength="300" name="otrep" class="form-control" value=""><?php echo $otrep ?></textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="preacttak">Preventive Actions Taken</label>
                                    <textarea class="textarea" maxlength="300" name="preacttak" class="form-control" value=""><?php echo $preacttak ?></textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="time">Time</label>
                                    <input type="time" class="form-control" name="time" value="<?php echo $timefall ?>" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" name="date" value="<?php echo $datefall ?>" required>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <p style="page-break-after: always;"></p>
        <?php } ?>

        <!--Nurse's Initial Assessment -->
        <?php if($nurse_initial_risk) {?>
        <div class="container">
            <hr style="width:100%;background-color:white;color:white;height:5px;">
            <div class="row">
                <div class="col">
                    <h1 class="text-center">Nurse's Initial Assessment</h1>
                </div>
            </div>
            <div class="container d-flex justify-content-center">
                <form method="POST" action="">
                    <fieldset disabled="disabled">

                        <div class="row my-2">
                            <div class="col">
                                <div class="form-group">
                                    <label for="conphy">Consultant Physician</label><br>
                                    <select name="conphy" class="form-control" required>
                                        <option value="" selected disabled hidden>Select an Option</option>
                                        <?php
                                        if ($result12->num_rows > 0) {
                                            while ($row = $result12->fetch_assoc()) {
                                                $doc_user_id = $row['user_id'];
                                                $doc_full_name = $row['first_name'] . " " . $row['last_name'];
                                        ?> <option value="<?php echo ($doc_user_id . "," . $doc_full_name) ?>" <?php if ($conphy_id == $doc_user_id) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?php echo $doc_full_name ?></option><?php
                                                                                                                                                        }
                                                                                                                                                    } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="mobility">Mobility</label><br>
                                    <input type="text" name="mobility" maxlength="50" class="form-control" value="<?php echo $mobility; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="patanymed">Is the Patient Under any Mediacation for</label>
                                    <input type="text" name="patanymed" maxlength="200" class="form-control" value="<?php echo $patanymed; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="feed">Feed</label><br>
                                    <select name="feed" id="feed" class="form-control" required>
                                        <option value="" selected disabled hidden>Select an Option</option>
                                        <option value="Self" <?php if ($feed == "Self") {
                                                                    echo "Selected";
                                                                } ?>>Self</option>
                                        <option value="Assisted" <?php if ($feed == "Assisted") {
                                                                        echo "Selected";
                                                                    } ?>>Assisted</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row  my-4">
                            <div class="col ">
                                <div class="form-group">
                                    <label for="detonadd">Details on Admission</label>
                                    <textarea class="textarea" name="detonadd" rows="4" maxlength="350" cols="25"><?php echo $detonadd; ?></textarea>
                                </div>
                            </div>
                            <div class="col ">
                                <div class="form-group">
                                    <label for="drugallerg">Drug Allergies If Any</label>
                                    <textarea class="textarea" name="drugallerg" rows="4" maxlength="350" cols="25"><?php echo $drugallerg; ?></textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="date">Date</label><br>
                                    <input type="date" name="date" class="form-control" value="<?php echo $datenia; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="time">Time</label><br>
                                    <input type="time" name="time" class="form-control" value="<?php echo $timenia; ?>">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <p style="page-break-after: always;"></p>
        <?php } ?>

        <!--Nursing Care Plan -->
        <?php
        if ($result14->num_rows > 0) {
        ?>
            <div class="container">
                <hr style="width:100%;background-color:white;color:white;height:5px;">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center">Nursing Care Plan</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered align-middle" style="color:white;">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center text-nowrap align-middle">Date</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Time</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Problem Identified</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Suggestions</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Nurse's Name</th>
                                        <th scope="col" class="text-center text-nowrap align-middle">Nurse's Sign</th>
                                    </tr>
                                </thead>
                                <?php while ($row2 = $result14->fetch_assoc()) { ?>
                                    <tbody>
                                        <tr>
                                            <td class="text-center text-nowrap"><?php echo date("d-m-Y", strtotime($row2['date'])); ?></td>
                                            <td class="text-center text-nowrap"><?php echo date('g:i a', strtotime($row2['time'])); ?></td>
                                            <td class="text-center"><?php echo $row2['prob_ident']; ?></td>
                                            <td class="text-center text-nowrap"><?php echo $row2['suggestions']; ?></td>
                                            <td class="text-center text-nowrap"><?php echo $row2['nurse_name']; ?></td>
                                            <td class="text-center"><img src="<?php echo $row2['nurses_sign']; ?>" alt="Nurse's Sign" width="100" height="90"></td>
                                        </tr>
                                    </tbody>
                            <?php }
                            ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <p style="page-break-after: always;"></p>
            <?php } ?>

            <!--Medication Administration Chart -->
            <?php

                if ($result15->num_rows > 0) {
                ?>
            <div class="container">
                <hr style="width:100%;background-color:white;color:white;height:5px;">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center">Medication Administration Chart</h1>
                    </div>
                </div>
                
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered align-middle" style="color:white;">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center text-nowrap align-middle">Date</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Time</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Medicine Name</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Dose</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Frequency</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Anupanam</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Nurse's Name</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Nurse's Sign</th>

                                        </tr>
                                    </thead>
                                    <?php while ($row2 = $result15->fetch_assoc()) { ?>
                                        <tbody>
                                            <tr>
                                                <td class="text-center text-nowrap"><?php echo date("d-m-Y", strtotime($row2['date'])); ?></td>
                                                <td class="text-center text-nowrap"><?php echo date('g:i a', strtotime($row2['time'])); ?></td>
                                                <td class="text-center"><?php echo $row2['med_name']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['dose']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['frequency']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['anupanam']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['nurse_name']; ?></td>
                                                <td class="text-center"><img src="<?php echo $row2['nurses_sign']; ?>" alt="Nurse's Sign" width="100" height="90"></td>
                                            </tr>
                                        </tbody>
                                <?php }
                                ?>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <p style="page-break-after: always;"></p>
            <?php } ?>

            <!--Nurse Daily Notes -->
            <?php

                if ($result16->num_rows > 0) {
                ?>
            <div class="container">
                <hr style="width:100%;background-color:white;color:white;height:5px;">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center">Nurse Daily Notes</h1>
                    </div>
                </div>
                
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered align-middle" style="color:white;">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center text-nowrap align-middle">Date</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Time</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Nurse's Notes</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Nurse's Name</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Nurse's Sign</th>
                                        </tr>
                                    </thead>
                                    <?php while ($row2 = $result16->fetch_assoc()) { ?>
                                        <tbody>
                                            <tr>
                                                <td class="text-center text-nowrap"><?php echo date("d-m-Y", strtotime($row2['date'])); ?></td>
                                                <td class="text-center text-nowrap"><?php echo date('g:i a', strtotime($row2['time'])); ?></td>
                                                <td class="text-center"><?php echo $row2['nurse_note']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['nurse_name']; ?></td>
                                                <td class="text-center"><img src="<?php echo $row2['nurses_sign']; ?>" alt="Nurse's Sign" width="100" height="90"></td>
                                            </tr>
                                        </tbody>
                                <?php }
                                 ?>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <p style="page-break-after: always;"></p>
            <?php } ?>

            <!--Nurse Daily Notes -->
            <?php
                if ($result17->num_rows > 0) {
                ?>
            <div class="container">
                <hr style="width:100%;background-color:white;color:white;height:5px;">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center">Nurse Record</h1>
                    </div>
                </div>
                
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered align-middle ltable" style="color:white;">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center text-nowrap align-middle">Date</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Time</th>
                                            <th scope="col" class="text-center align-middle">Dissemination Information</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Reassessment</th>
                                            <th scope="col" class="text-center align-middle"> Vital Signs</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Medication</th>
                                            <th scope="col" class="text-center align-middle">Medicated Water</th>
                                            <th scope="col" class="text-center align-middle">Herbal Juice</th>
                                            <th scope="col" class="text-center align-middle">Ginger Water</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Snehapanam</th>
                                            <th scope="col" class="text-center align-middle">Daily Medications</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Nurse's Name</th>
                                            <th scope="col" class="text-center text-nowrap align-middle">Nurse's Sign</th>
                                        </tr>
                                    </thead>
                                    <?php while ($row2 = $result17->fetch_assoc()) { ?>
                                        <tbody>
                                            <tr>
                                                <td class="text-center text-nowrap"><?php echo date("d-m-Y", strtotime($row2['date'])); ?></td>
                                                <td class="text-center text-nowrap"><?php echo date('g:i a', strtotime($row2['time'])); ?></td>
                                                <td class="text-center"><?php echo $row2['dissem_info']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['reassessment']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['vital_signs']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['medication']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['medic_water']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['herb_juice']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['gingwater']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['snehapanam']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['dailymeds']; ?></td>
                                                <td class="text-center text-nowrap"><?php echo $row2['nurse_name']; ?></td>
                                                <td class="text-center"><img src="<?php echo $row2['nurses_sign']; ?>" alt="Nurse's Sign" width="100" height="90"></td>
                                            </tr>
                                        </tbody>
                                <?php }
                                 ?>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <p style="page-break-after: always;"></p>
            <?php } ?>

            <!--Nurse Daily Notes -->
            <?php
               
        if ($result18->num_rows > 0) {
        ?>
            <div class="container">
                <hr style="width:100%;background-color:white;color:white;height:5px;">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center">Treatment Chart Records</h1>
                    </div>
                </div>
                
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="table-responsive">
                        <table id="trchatab" class="table table-sm table-bordered align-middle" style="color:white;">
                        <style>
                                         @media print {
                                        #trchatab{
                                            font-size:6px!important;
                                        }
                                         }
                                    </style>
                        <thead>
                                <tr>
                                    <th scope="col" class="text-center text-nowrap align-middle">Date</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Time In</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Time Out</th>
                                    <th scope="col" class="text-center align-middle">Treatment Name</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Medicine</th>
                                    <th scope="col" class="text-center align-middle">Treatment Room</th>
                                    <th scope="col" class="text-center align-middle">Therapist's Name</th>
                                    <th scope="col" class="text-center align-middle">Doctor's Remarks</th>
                                    <th scope="col" class="text-center align-middle">Patient's Response</th>
                                    <th scope="col" class="text-center align-middle">Patient's Sign</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Nurse's Name</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Nurse's Sign</th>
                                </tr>
                            </thead>
                            <?php while ($row2 = $result18->fetch_assoc()) { ?>
                                <tbody>
                                    <tr>
                                        <td class="text-center text-nowrap"><?php echo date("d-m-Y", strtotime($row2['date'])); ?></td>
                                        <td class="text-center text-nowrap"><?php echo date('g:i a', strtotime($row2['time_in'])); ?></td>
                                        <td class="text-center text-nowrap"><?php echo date('g:i a', strtotime($row2['time_out'])); ?></td>
                                        <td class="text-center"><?php echo $row2['treat_name']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['medicine']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['treat_room']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['therap_name']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['doc_remarks']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['pat_agree_st']; ?></td>
                                        <td class="text-center"><?php if($row2['pat_agree_st']=="Agree") {?><img src="<?php echo $row2['pat_sign']; ?>" alt="Patients's Sign" width="100" height="90"><?php } else {?>N.A <?php } ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['nurse_name']; ?></td>
                                        <td class="text-center"><img src="<?php echo $row2['nurses_sign']; ?>" alt="Nurse's Sign" width="80" height="70"></td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
            <p style="page-break-after: always;"></p>
            <?php } ?>

        <!--Discharge Summary-->
        <?php if($discharge_summary) {?>
            <div class="container">
            <hr style="width:100%;background-color:white;color:white;height:5px;">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center">Discharge Summary</h1>
                    </div>
                </div>
                <div class="container d-flex justify-content-center">
        <form method="POST" action="">
                 <fieldset disabled="disabled">
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
                                <textarea class="textarea" name="medadm" rows="4" maxlength="350" cols="25"><?php echo $medadm ?></textarea>
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
                                <textarea class="textarea" name="dismeds" rows="4" maxlength="500" cols="25"><?php echo $dismeds ?></textarea>
                            </div>
                        </div>
                    </div>
        <input type="submit" class="btn btn-success" name="submit" value="Submit">
        <a href="visitdetails.php?user=<?php echo $user_id?>&visit=<?php echo $visit_id?>" class="btn btn-danger">Cancel</a>
        </fieldset>
    </form>
    </div>
            </div>
            <?php } ?>

</body>