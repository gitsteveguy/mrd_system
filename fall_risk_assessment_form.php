<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Fall Risk Assessment");
$user_id;
$visit_id;
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
$time = "";
$date = "";
if (isset($_GET['user']) && isset($_GET['visit'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
} else {
    echo "Cannot find required parameters";
}

$sql = "SELECT * FROM fall_risk_assesments WHERE visit_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $visit_id);
if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
}
$result = $stmt->get_result();
$exfallr_form = $result->fetch_assoc();
if ($result->num_rows > 0) {
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
    $time = $exfallr_form['time'];
    $date = $exfallr_form['date'];
}

if (isset($_POST['submit'])) {
    if ((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles) && !in_array($current_user_role,$table_mod_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles))))
    {
        header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=0");
        exit();
    }
    $prefallhis = isset($_POST['prefallhis']) ? "Yes" : "No";
    $vulcpa = isset($_POST['vulcpa']) ? "Yes" : "No";
    $viimp = isset($_POST['viimp']) ? "Yes" : "No";
    $muswek = isset($_POST['muswek']) ? "Yes" : "No";
    $phydisop = isset($_POST['phydisop']) ? "Yes" : "No";
    $gaisofpat = isset($_POST['gaisofpat']) ? "Yes" : "No";
    $balnmobis = isset($_POST['balnmobis']) ? "Yes" : "No";
    $lwblbp = isset($_POST['lwblbp']) ? "Yes" : "No";
    $almtstop = isset($_POST['almtstop']) ? "Yes" : "No";
    $posmedsd = isset($_POST['posmedsd']) ? "Yes" : "No";
    $aldrabwlsymp = isset($_POST['aldrabwlsymp']) ? "Yes" : "No";
    $protype = $_POST['protype'];
    $otrep = $_POST['otrep'];
    $preacttak = $_POST['preacttak'];
    $time = $_POST['time'];
    $date = $_POST['date'];

    if ($result->num_rows > 0) {
        $sql2 = "UPDATE fall_risk_assesments SET prev_fall_his=?, vuln_cat_pat=?, vis_imp=?, phy_dis=?, muscle_weak=?, gait_instable=?, balance_mob=?, low_bp=?, alt_ment_st_pat=?, pos_med_side_fx=?, alc_dru_wtdr_syms=?, procedure_type=?, oth_rev_pt=?, prvn_acts_tak=?, time=?,date=?, nurse_name=?, nurses_sign=?, nurse_id=?";
        $stmt = $conn->prepare($sql2);
        if (!$stmt) {
            die("Error: " . $conn->error);
        }
        $stmt->bind_param('ssssssssssssssssssi', $prefallhis, $vulcpa, $viimp, $phydisop,$muswek, $gaisofpat, $balnmobis, $lwblbp, $almtstop,$posmedsd, $aldrabwlsymp, $protype, $otrep, $preacttak, $time,$date, $current_user_name, $current_user_sign, $current_user_id);
    } else {
        $sql = "INSERT INTO fall_risk_assesments (user_id, visit_id, prev_fall_his, vuln_cat_pat, vis_imp, phy_dis, muscle_weak, gait_instable, balance_mob, low_bp, alt_ment_st_pat, pos_med_side_fx, alc_dru_wtdr_syms, procedure_type, oth_rev_pt, prvn_acts_tak, time, date, nurse_name, nurses_sign, nurse_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Error: " . $conn->error);
        }
        $stmt->bind_param('iissssssssssssssssssi', $user_id, $visit_id, $prefallhis, $vulcpa, $viimp, $phydisop,$muswek, $gaisofpat, $balnmobis, $lwblbp, $almtstop, $posmedsd, $aldrabwlsymp, $protype, $otrep, $preacttak, $time, $date, $current_user_name, $current_user_sign, $current_user_id);
        $stmt->execute();
    }
    if (!$stmt->execute()) {
        die("Error: " . $stmt2->error);
    } else {
        echo "Saved";
    }
    header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=1");
    exit();
}
?>

<body id="body">
    <h1 class="text-center my-3">Fall Risk Assessment</h1>
    <div class="container mx-5 w-100 px-2">
        <form method="POST" action="">
        <?php  
            if ((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles) && !in_array($current_user_role,$table_mod_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles))))
             {
                 ?>
                 <fieldset disabled="disabled">
                    <?php
             }    
            ?>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="checkbox" class="form-check-input" name="prefallhis" <?php if($prefallhis=="Yes"){echo "checked";} ?> id="prefallhis">
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
                        <input type="checkbox" class="form-check-input" name="vulcpa" id="vulcpa" <?php if($vulcpa=="Yes"){echo "checked";} ?>>
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
                        <input type="checkbox" class="form-check-input" name="viimp" id="viimp" <?php if($viimp=="Yes"){echo "checked";} ?>>
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
                        <input type="checkbox" class="form-check-input" name="phydisop" id="phydisop" <?php if($phydisop=="Yes"){echo "checked";} ?>>
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
                        <input type="checkbox" class="form-check-input" name="muswek" id="muswek" <?php if($muswek=="Yes"){echo "checked";} ?>>
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
                        <input type="checkbox" class="form-check-input" name="gaisofpat" id="gaisofpat" <?php if($gaisofpat=="Yes"){echo "checked";} ?>>
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
                        <input type="checkbox" class="form-check-input" name="balnmobis" id="balnmobis" <?php if($balnmobis=="Yes"){echo "checked";} ?>>
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
                        <input type="checkbox" class="form-check-input" name="lwblbp" id="lwblbp" <?php if($lwblbp=="Yes"){echo "checked";} ?>>
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
                        <input type="checkbox" class="form-check-input" name="almtstop" id="almtstop" <?php if($almtstop=="Yes"){echo "checked";} ?>>
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
                        <input type="checkbox" class="form-check-input" name="posmedsd" id="posmedsd" <?php if($posmedsd=="Yes"){echo "checked";} ?>>
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
                        <input type="checkbox" class="form-check-input" name="aldrabwlsymp" id="aldrabwlsymp" <?php if($aldrabwlsymp=="Yes"){echo "checked";} ?>>
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
                        <option value="Regular" <?php if($protype=="Regular"){echo "Selected";} ?>>Low</option>
                        <option value="Modified" <?php if($protype=="Modified"){echo "Selected";} ?>>Moderate</option>
                        <option value="High" <?php if($protype=="High"){echo "Selected";} ?>>High</option>
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
                        <input type="time" class="form-control" name="time" value="<?php echo $time ?>" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" name="date" value="<?php echo $date ?>" required>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-success" name="submit" value="Submit">
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