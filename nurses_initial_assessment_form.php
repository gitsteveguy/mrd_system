<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Nurse's Initial Assessment");
$user_id;
$visit_id;
$conphy_id = "";
$conphy = "";
$mobility = "";
$patanymed = "";
$feed = "";
$detonadd = "";
$drugallerg = "";
$date = "";
$time = "";

$sql = "SELECT * FROM FSbNJe9_user_data WHERE role='Doctor'";
$result = $conn->query($sql);

if (isset($_GET['user']) && isset($_GET['visit'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
} else {
    echo "Cannot find required parameters";
}
$sql2 = "SELECT * FROM nurses_initial_assessments WHERE visit_id = ?";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("i", $visit_id);
if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
}
$result2 = $stmt->get_result();
$exnur_ina_form = $result2->fetch_assoc();
if ($result2->num_rows > 0) {
    $conphy_id = $exnur_ina_form['con_phy_id'];
    $conphy = $exnur_ina_form['con_phy_name'];
    $mobility = $exnur_ina_form['mobility'];
    $patanymed = $exnur_ina_form['pat_und_meds'];
    $feed = $exnur_ina_form['feed'];
    $detonadd = $exnur_ina_form['det_on_admission'];
    $drugallerg = $exnur_ina_form['drug_allerg'];
    $date = $exnur_ina_form['date'];
    $time = $exnur_ina_form['time'];
}

if (isset($_POST['submit'])) {
    if ((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles) && !in_array($current_user_role,$table_mod_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles))))
    {
        header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=0");
        exit();
    }
    $conphydat = explode(",",$_POST['conphy']);
    $conphy_id = $conphydat[0];
    $conphy_nam = $conphydat[1];
    $mobility = $_POST['mobility'];
    $patanymed = $_POST['patanymed'];
    $feed = $_POST['feed'];
    $detonadd = $_POST['detonadd'];
    $drugallerg = $_POST['drugallerg'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    if ($result2->num_rows > 0) {
        $sql3 = "UPDATE nurses_initial_assessments SET con_phy_id=?, con_phy_name=?, mobility=?, pat_und_meds=?, feed=?, det_on_admission=?, drug_allerg=?, date=?, time=?, nurse_id=?, nurse_name=?, nurses_sign=?";
        $stmt2 = $conn->prepare($sql3);
        if (!$stmt2) {
            die("Error: " . $conn->error);
        }
        $stmt2->bind_param('issssssssiss', $conphy_id, $conphy_nam, $mobility, $patanymed, $feed, $detonadd, $drugallerg, $date, $time, $current_user_id, $current_user_name, $current_user_sign);
    } else {
        $sql4 = "INSERT INTO nurses_initial_assessments (user_id, visit_id, con_phy_id, con_phy_name, mobility, pat_und_meds, feed, det_on_admission, drug_allerg, date, time, nurse_id, nurse_name, nurses_sign) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($sql4);
        if (!$stmt2) {
            die("Error: " . $conn->error);
        }
        $stmt2->bind_param('iiissssssssiss',$user_id, $visit_id, $conphy_id, $conphy_nam, $mobility, $patanymed, $feed, $detonadd, $drugallerg, $date, $time, $current_user_id, $current_user_name, $current_user_sign);
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
    <h1 class="text-center my-3">Nurse's Initial Assessment</h1>
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
                        <label for="conphy">Consultant Physician</label><br>
                        <select name="conphy" class="form-control" required>
                            <option value="" selected disabled hidden>Select an Option</option>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
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
                        <input type="date" name="date" class="form-control" value="<?php echo $date; ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="time">Time</label><br>
                        <input type="time" name="time" class="form-control" value="<?php echo $time; ?>">
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