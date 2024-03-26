<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Treatment Chart");
$user_id;
$visit_id;
if (isset($_GET['user']) && isset($_GET['visit'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
} else {
    echo "Cannot find required parameters";
}

if(isset($_POST['submit']))
{
    if ((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles) && !in_array($current_user_role,$table_mod_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles))))
    {
        header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=0");
        exit();
    }
    $docna = $_POST['docna'];
    $dates = $_POST['date'];
    $nameotreats = $_POST['nameotreat'];
    $meds = $_POST['med'];
    $tmtrooms = $_POST['tmtroom'];
    $timeins = $_POST['timein'];
    $timeouts = $_POST['timeout'];
    $therapistns = $_POST['therpn'];
    $docremarks = $_POST['docremarks'];
    $agrees = $_POST['agree'];


    foreach ($dates as $key => $date) {
        $docnao = explode(",",$docna[$key]);
        $docnid = $docnao[0];
        $docname = $docnao[1];
        $sqldoc = "SELECT * FROM FSbNJe9_user_data WHERE user_id = ?";
        $stmtdoc = $conn->prepare($sqldoc);
        $stmtdoc->bind_param("i",$docnid);
        $stmtdoc->execute();
        $docdetres = $stmtdoc->get_result();
        $docdet = $docdetres->fetch_assoc();
        $nameotreat = $nameotreats[$key];
        $med = $meds[$key];
        $tmtroom = $tmtrooms[$key];
        $timein = $timeins[$key];
        $timeout = $timeouts[$key];
        $therapistin = explode(",",$therapistns[$key]);
        $therapistid = $therapistin[0];
        $therapistn = $therapistin[1];
        $docremark = $docremarks[$key];
        $agree = ($agrees[$key]=="on")?"Agree":"Disagree";
        $patsign = ($agrees[$key]=="on")? $param_pat_det['signature_img'] :"N.A";
       $sql = "INSERT INTO treatment_charts (user_id, visit_id, date, treat_name, medicine, treat_room, time_in, time_out, therap_id, therap_name, doc_remarks, pat_agree_st, pat_sign, nurse_id, nurse_name, nurses_sign) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissssssissssiss", $user_id, $visit_id, $date, $nameotreat, $med, $tmtroom, $timein, $timeout, $therapistid, $therapistn, $docremark, $agree, $patsign, $docnid, $docname, $docdet['signature_img']);
        $stmt->execute();
    }
        // Redirect to the visit details page
        header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=1");
        exit();
}
?>
<?php 
 if (!((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles)))))
    {
        $sqlto = "SELECT * FROM FSbNJe9_user_data WHERE role='Therapist'";
        $resultto = $conn->query($sqlto);
        $sqldr = "SELECT * FROM FSbNJe9_user_data WHERE role='Doctor'";
        $resultdr = $conn->query($sqldr);
        ?>
<body id="body">
    <h1 class="text-center my-3">Treatment Chart</h1>
    <div class="container d-flex justify-content-center">
        <form method="POST" action="" class="no-print">
            <div id="patient-fields">
                <div class="patient">
                    <div class="row my-2">
                    <div class="col">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date[]" class="form-control" value="" onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="nameotreat">Name of Treatments</label>
                            <textarea class="textarea" name="nameotreat[]" maxlength="400" rows="5" cols="30" class="form-control" value=""></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="med">Medicine</label>
                            <textarea class="textarea" name="med[]" maxlength="400" rows="5" cols="30" class="form-control" value=""></textarea>
                        </div>
                    </div>
                     <div class="col">
                        <div class="form-group">
                            <label for="tmtroom">Treatment Room</label>
                            <input type="text" name="tmtroom[]" class="form-control" maxlength="100" value="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="timein">Time In</label>
                            <input type="time" name="timein[]" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="timeout">Time Out</label>
                            <input type="time" name="timeout[]" class="form-control" value="">
                        </div>
                    </div>
                    </div>
                    <div class="row my-2">
                    <div class="col">
                        <div class="form-group">
                        <label for="therpn">Select Therapist</label>
                                <select name="therpn[]" id="therpn" class="form-control stselew select" multiple>
                                    <option value="0,N.A" selected disabled hidden>None</option>
                                    <?php
                                    if ($resultto->num_rows > 0) {
                                        while ($row = $resultto->fetch_assoc()) {
                                            $ther_full_name = $row['first_name'] . " " . $row['last_name'];
                                    ?> <option value="<?php echo ($row['user_id']) ?>,<?php echo ($ther_full_name) ?>"><?php echo $ther_full_name ?></option><?php }
                                                                                                                                } ?>
                                </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                        <label for="docna">Select Doctor</label>
                                <select name="docna[]" class="form-control stselew select">
                                    <option value="0,N.A" selected disabled hidden>None</option>
                                    <?php
                                    if ($resultdr->num_rows > 0) {
                                        while ($row2 = $resultdr->fetch_assoc()) {
                                            $doc_full_name = $row2['first_name'] . " " . $row2['last_name'];
                                    ?> <option value="<?php echo ($row2['user_id']) ?>,<?php echo ($doc_full_name) ?>"><?php echo $doc_full_name ?></option><?php }
                                                                                                                                } ?>
                                </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="docremarks">Doctor's Remarks</label>
                            <input type="text" name="docremarks[]" class="form-control" maxlength="100" value="">
                        </div>
                    </div>
                    <div class="col">
                        <br>
                <input type="checkbox" hidden class="form-check-input" name="agree[]" checked value ="no" >
                <input type="checkbox" class="form-check-input" name="agree[]" onclick="uncheckprev(this)">
                        <label for="agree[]">I the Patient, <?php echo $param_pat_det['first_name']." ".$param_pat_det['last_name']; ?> Agree
                            <style>
                                label {
                                    display: inline;
                                }
                            </style>
                        </label>
                </div>
                    </div>
                <hr style="width:100%;background-color:white;color:white;height:5px;">
                <br>
                </div>
                </div>
            </div>
            </div>

            <button type="button" class="btn btn-primary my-3 mx-2" onclick="addrow()">Add Treatment</button>
             <button type="button"class="btn btn-danger" onclick="removerow()">Remove Treatment</button>
            <input type="submit"class="btn btn-success" name="submit" value="Submit">
            <a href="visitdetails.php?user=<?php echo $user_id?>&visit=<?php echo $visit_id?>" class="btn btn-danger">Cancel</a>
    </form>

    <?php
    }
    $sqld = "SELECT * FROM FSbNJe9_user_data WHERE role='Nurse'";
    $resultd = $conn->query($sqld);
    $sqlt = "SELECT * FROM FSbNJe9_user_data WHERE role='Therapist'";
    $resultt = $conn->query($sqlt);
    $min_date = $conn->query("SELECT MIN(date) FROM $table_name")->fetch_row();
    $min_time = $conn->query("SELECT MIN(time_out) FROM $table_name")->fetch_row();
    $max_date = $conn->query("SELECT MAX(date) FROM $table_name")->fetch_row();
    $max_time = $conn->query("SELECT MAX(time_out) FROM $table_name")->fetch_row();
    $total_patvisrecords_per_page = 20;
    $nurn = isset($_GET['nurn']) ? $_GET['nurn'] : '';
    $therpn = isset($_GET['therpn']) ? $_GET['therpn'] : '';
    $agrepat = isset($_GET['agrepat']) ? $_GET['agrepat'] : '';
    $sdate = isset($_GET['sdate']) ? $_GET['sdate'] : $min_date[0];
    $ldate = isset($_GET['ldate']) ? $_GET['ldate'] : $max_date[0];
    $stime = isset($_GET['stime']) ? $_GET['stime'] : $min_time[0];
    $ltime =isset($_GET['ltime']) ? $_GET['ltime'] : $max_time[0];

    $sdate = ($sdate=="")?$min_date[0]:$sdate;
    $ldate = ($ldate=="")?$max_date[0]:$ldate;
    $stime = ($stime=="")? $min_time[0] : $stime ;
    $ltime = ($ltime=="")? $max_time[0] : $ltime ;
    $searcho = isset($_GET['searcho']) ? $_GET['searcho'] : '';
    $sql = "SELECT COUNT(*) as count FROM $table_name WHERE visit_id=? AND (treat_name LIKE CONCAT('%', ?, '%') OR medicine LIKE CONCAT('%', ?, '%')  OR treat_room LIKE CONCAT('%', ?, '%') OR doc_remarks LIKE CONCAT('%', ?, '%')) AND (nurse_name LIKE CONCAT('%', ?, '%')) AND (therap_name LIKE CONCAT('%', ?, '%')) AND (pat_agree_st LIKE CONCAT('%', ?, '%')) AND (date BETWEEN ? AND ?) AND (time_out BETWEEN ? AND ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error: " . $conn->error);
    }
    $stmt->bind_param("isssssssssss", $visit_id, $searcho, $searcho, $searcho, $searcho, $nurn, $therpn, $agrepat, $sdate, $ldate, $stime, $ltime);
    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total_patvisrecords = $row['count'];
    // Calculate the total number of pages
    $total_pages = ceil($total_patvisrecords / $total_patvisrecords_per_page);

    // Get the current page number
    if (isset($_GET['page'])) {
        $current_page = $_GET['page'];
    } else {
        $current_page = 1;
    }

    $offset = ($current_page - 1) * $total_patvisrecords_per_page;

    $sql2 = "SELECT * FROM $table_name WHERE visit_id=? AND (treat_name LIKE CONCAT('%', ?, '%') OR medicine LIKE CONCAT('%', ?, '%')  OR treat_room LIKE CONCAT('%', ?, '%') OR doc_remarks LIKE CONCAT('%', ?, '%')) AND (nurse_name LIKE CONCAT('%', ?, '%')) AND (therap_name LIKE CONCAT('%', ?, '%')) AND (pat_agree_st LIKE CONCAT('%', ?, '%')) AND (date BETWEEN ? AND ?) AND (time_out BETWEEN ? AND ?) ORDER BY date DESC, time_out DESC LIMIT $offset, $total_patvisrecords_per_page";
        $stmt2 = $conn->prepare($sql2);
        if (!$stmt2) {
            die("Error: " . $conn->error);
        }
        $stmt2->bind_param("isssssssssss", $visit_id, $searcho, $searcho, $searcho, $searcho, $nurn, $therpn, $agrepat, $sdate, $ldate, $stime, $ltime);
        if (!$stmt2->execute()) {
            die("Error: " . $stmt2->error);
        }
    
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="text-center no-print">Treatment Chart Records</h4>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form class="my-3 no-print" action="" method="GET">
                    <input type="hidden" name="user" value="<?php echo $user_id ?>">
                    <input type="hidden" name="visit" value="<?php echo $visit_id ?>">
                    <div class="row my-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="nurn">Search By Nurse's Name</label>
                                <select name="nurn" class="form-control">
                                    <option value="" selected>None</option>
                                    <?php
                                    if ($resultd->num_rows > 0) {
                                        while ($row = $resultd->fetch_assoc()) {
                                            $nur_full_name = $row['first_name'] . " " . $row['last_name'];
                                    ?> <option value="<?php echo ($nur_full_name) ?>" <?php if ($nur_full_name == $nurn) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $nur_full_name ?></option><?php }
                                                                                                                                } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="sdate">Starting Date</label>
                                <input type="date" name="sdate" class="form-control" value="<?php echo (isset($_GET['sdate']) ? $_GET['sdate'] :''); ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="ldate">End Date</label>
                                <input type="date" name="ldate" class="form-control" value="<?php echo (isset($_GET['ldate']) ? $_GET['ldate'] :''); ?>" onfocus="(this.type='date')" onblur="(this.type='text')">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="stime">Starting Time out</label>
                                <input type="time" name="stime" class="form-control" value="<?php echo (isset($_GET['stime']) ? $_GET['stime'] :''); ?>" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="ltime">End Time in</label>
                                <input type="time" name="ltime" class="form-control" value="<?php echo (isset($_GET['ltime']) ? $_GET['ltime'] :''); ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="therpn">Search By Therapist's Name</label>
                                <select name="therpn" class="form-control">
                                    <option value="" selected>None</option>
                                    <?php
                                    if ($resultt->num_rows > 0) {
                                        while ($row = $resultt->fetch_assoc()) {
                                            $ther_full_name = $row['first_name'] . " " . $row['last_name'];
                                    ?> <option value="<?php echo ($ther_full_name) ?>" <?php if ($ther_full_name == $therpn) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $ther_full_name ?></option><?php }
                                                                                                                                } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="agrepat">Patient's Response</label>
                                <select name="agrepat" class="form-control">
                                    <option value="">None</option>
                                    <option value="Agree" <?php if($agrepat=="Agree"){echo "selected";} ?>>Agree</option>
                                    <option value="Disagree" <?php if($agrepat=="Disagree"){echo "selected";} ?>>Disagree</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search by Treatment Name, Medicine, Treatment Room" name="searcho" value="<?php echo $searcho; ?>">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
                    <a class="btn btn-primary" href="<?php echo $current_file_name?>?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>">Reset Search</a>
                </form>
            </div>
        </div>
        <?php
        $result2 = $stmt2->get_result();
        if ($result2->num_rows > 0) {
        ?>
            <hr style="width:100%;background-color:white;color:white;height:5px;">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered align-middle ltable" style="color:white;">
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
                                    <th scope="col" class="text-center text-nowrap align-middle">Doctor's Name</th>
                                    <th scope="col" class="text-center text-nowrap align-middle">Doctor's Sign</th>
                                    <?php if ((in_array($current_user_role, $table_mod_roles)&&($formeditable=="Yes")) || in_array($current_user_role, $sup_roles)) { ?>
                                        <th scope="col" class="text-center text-nowrap align-middle no-print">Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <?php while ($row2 = $result2->fetch_assoc()) { ?>
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
                                        <td class="text-center"><img src="<?php echo $row2['nurses_sign']; ?>" alt="Nurse's Sign" width="100" height="90"></td>
                                       <?php if ((in_array($current_user_role, $table_mod_roles)&&($formeditable=="Yes")) || in_array($current_user_role, $sup_roles)) { ?>
                                            <td class="text-center no-print"><a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal<?php echo $row2[$primary_key]; ?>" href="deleterecs.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>&tb=<?php echo $table_id?>&recid=<?php echo $row2[$primary_key]; ?>">Delete</a>
                                                <!-- Bootstrap Modal -->
                                                <div class="modal fade" id="confirmModal<?php echo $row2[$primary_key]; ?>" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="color:green!important" id="confirmModalLabel">Confirm Deletion</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p style="color:green!important">Do you really want to delete this record?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <a id="deleteLink" class="btn btn-danger" href="deleterecs.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>&tb=<?php echo $table_id?>&recid=<?php echo $row2[$primary_key]; ?>">Delete</a>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                        <?php } ?>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row no-print">
                <div class="col">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">

                            <?php
                            // Display pagination links
                            for ($i = 1; $i <= $total_pages; $i++) {
                            ?>
                                <li class="page-item <?php if ($current_page == $i) {
                                                            echo 'active';
                                                        } ?>"><a class="page-link" href="<?php echo $current_file_name?>?user=<?php echo $user_id ?>&visit=<?php echo $visit_id ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                            }
                            ?>

                        </ul>
                    </nav>
                </div>
            </div>
    </div>
<?php } else {
?>
    <div class="row">
        <div class="col">
            <h5 class="text-center">No Records Found with the given Search Criteria</h5>
        </div>
    </div>
<?php
        }
?>
    <script>
        function addrow() {
            var patientFields = document.getElementById('patient-fields');
            var patientTemplate = document.querySelector('.patient');
            var newPatient = patientTemplate.cloneNode(true);
            patientFields.appendChild(newPatient);
        }

        function removerow() {
            var patientFields = document.getElementById('patient-fields');
            var patients = patientFields.querySelectorAll('.patient');
            if (patients.length > 1) {
                var lastPatient = patients[patients.length - 1];
                patientFields.removeChild(lastPatient);
            }
        }
        function uncheckprev(e)
        {
            if(e.checked == true)
           { e.previousElementSibling.checked = false; }
            else
            { e.previousElementSibling.checked = true;}
        }
        
   
    $(document).ready(function() {
        var arr = new Array();
        $("#therpn").change(function() {
            $(this).find("option:selected")
            if ($(this).find("option:selected").length > 3) {
                $(this).find("option").removeAttr("selected");
                $(this).val(arr);
                alert('You can only select 3 Therapists');
            }
            else {
                arr = new Array();
                $(this).find("option:selected").each(function(index, item) {
                    arr.push($(item).val());
                });
            }
        });
    });
    </script>
    </div>
</body>