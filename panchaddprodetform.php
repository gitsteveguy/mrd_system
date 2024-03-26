<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Panchakarma Procedure Details");
$user_id;
$visit_id;
$panchmformid;
if (isset($_GET['user']) && isset($_GET['visit']) && isset($_GET['panchformid'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
    $panchmformid = $_GET['panchformid'];
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
    $dates = $_POST['date'];
    $times = $_POST['time'];
    $procedures = $_POST['procedure'];
    $durations = $_POST['duration'];
    $protypes = $_POST['protype'];

    foreach ($dates as $key => $date) {
        $time = $times[$key];
        $procedure = $procedures[$key];
        $duration = $durations[$key];
        $protype = $protypes[$key];

        $sql = "INSERT INTO panchakarma_consent_proc_form (panch_con_form_id,visit_id, user_id, date, time, proced_details, duration, proc_type, doctor_id, doctor_name, doctors_sign) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiisssisiss", $panchmformid, $visit_id, $user_id, $date, $time, $procedure, $duration, $protype,$current_user_id, $current_user_name, $current_user_sign);
        $stmt->execute();
    }
        // Redirect to the visit details page
        header("Location: visitdetails.php?user=$user_id&visit=$visit_id&success=1");
        exit();
}
?>
<body id="body">
<?php 
 if (!((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles)))))
    {
        ?>
    <h1 class="text-center my-3">Panchakarma Procedure Details</h1>
    <div class="container d-flex justify-content-center">
        <form method="POST" action="">
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
                            <label for="time">Time</label>
                            <input type="time" name="time[]" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="procedure">Procedure</label>
                            <textarea class="textarea" maxlength="200" name="procedure[]" class="form-control" value=""></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="duration">Duration (In Days)</label>
                            <input type="number" name="duration[]" min="0" max="100" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col">
                    <label for="protype">Procedure Type</label>
                    <select name="protype[]" id="protype[]" class="form-control" required>
                        <option value=""  selected disabled hidden>Select Type</option>
                        <option value="Regular">Regular</option>
                        <option value="Modified">Modified</option>
                    </select>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <button type="button" class="btn btn-primary my-3 mx-2" onclick="addrow()">Add Procedure</button>
             <button type="button"class="btn btn-danger" onclick="removerow()">Remove Procedure</button>
            <input type="submit"class="btn btn-success" name="submit" value="Submit">
            <a href="panchakarma_consent_form.php?user=<?php echo $user_id?>&visit=<?php echo $visit_id?>" class="btn btn-danger">Cancel</a>
    </form>

    <?php
    }
    $sqld = "SELECT * FROM FSbNJe9_user_data WHERE role='Doctor'";
    $resultd = $conn->query($sqld);
    $min_date = $conn->query("SELECT MIN(date) FROM $table_name")->fetch_row();
    $min_time = $conn->query("SELECT MIN(time) FROM $table_name")->fetch_row();
    $max_date = $conn->query("SELECT MAX(date) FROM $table_name")->fetch_row();
    $max_time = $conn->query("SELECT MAX(time) FROM $table_name")->fetch_row();
    $total_patvisrecords_per_page = 20;
    $docn = isset($_GET['docn']) ? $_GET['docn'] : '';
    $sdate = isset($_GET['sdate']) ? $_GET['sdate'] : $min_date[0];
    $ldate = isset($_GET['ldate']) ? $_GET['ldate'] : $max_date[0];
    $stime = isset($_GET['stime']) ? $_GET['stime'] : $min_time[0];
    $ltime =isset($_GET['ltime']) ? $_GET['ltime'] : $max_time[0];

    $sdate = ($sdate=="")?$min_date[0]:$sdate;
    $ldate = ($ldate=="")?$max_date[0]:$ldate;
    $stime = ($stime=="")? $min_time[0] : $stime ;
    $ltime = ($ltime=="")? $max_time[0] : $ltime ;
    $searcho = isset($_GET['searcho']) ? $_GET['searcho'] : '';
    $sql = "SELECT COUNT(*) as count FROM $table_name WHERE visit_id=? AND (proced_details LIKE CONCAT('%', ?, '%') OR duration = ? OR proc_type LIKE CONCAT('%', ?, '%')) AND (doctor_name LIKE CONCAT('%', ?, '%')) AND (date BETWEEN ? AND ?) AND (time BETWEEN ? AND ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error: " . $conn->error);
    }
    $stmt->bind_param("isissssss", $visit_id, $searcho, $searcho, $searcho, $docn, $sdate, $ldate, $stime, $ltime);
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

    $sql2 = "SELECT * FROM $table_name WHERE visit_id=? AND (proced_details LIKE CONCAT('%', ?, '%') OR duration = ? OR proc_type LIKE CONCAT('%', ?, '%')) AND (doctor_name LIKE CONCAT('%', ?, '%')) AND (date BETWEEN ? AND ?) AND (time BETWEEN ? AND ?) ORDER BY date DESC, time DESC LIMIT $offset, $total_patvisrecords_per_page";
        $stmt2 = $conn->prepare($sql2);
        if (!$stmt2) {
            die("Error: " . $conn->error);
        }
        $stmt2->bind_param("isissssss", $visit_id, $searcho, $searcho, $searcho, $docn, $sdate, $ldate, $stime, $ltime);
        if (!$stmt2->execute()) {
            die("Error: " . $stmt2->error);
        }
    
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="text-center no-print">Panchakarma Procedure Records</h4>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form class="my-3 no-print" action="" method="GET">
                    <input type="hidden" name="user" value="<?php echo $user_id ?>">
                    <input type="hidden" name="visit" value="<?php echo $visit_id ?>">
                    <input type="hidden" name="panchformid" value="<?php echo $panchmformid ?>">
                    <div class="row my-2">
                        <div class="col">
                            <div class="form-group">
                                <label for="docn">Search By Doctor's Name</label>
                                <select name="docn" class="form-control">
                                    <option value="" selected>None</option>
                                    <?php
                                    if ($resultd->num_rows > 0) {
                                        while ($row = $resultd->fetch_assoc()) {
                                            $doc_full_name = $row['first_name'] . " " . $row['last_name'];
                                    ?> <option value="<?php echo ($doc_full_name) ?>" <?php if ($doc_full_name == $docn) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $doc_full_name ?></option><?php }
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
                                <label for="stime">Starting Time</label>
                                <input type="time" name="stime" class="form-control" value="<?php echo (isset($_GET['stime']) ? $_GET['stime'] :''); ?>" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="ltime">End Time</label>
                                <input type="time" name="ltime" class="form-control" value="<?php echo (isset($_GET['ltime']) ? $_GET['ltime'] :''); ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search by Procedure Details, Duration, Procedure Type" name="searcho" value="<?php echo $searcho; ?>">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
                    <a class="btn btn-primary" href="<?php echo $current_file_name?>?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>&panchformid=<?php echo $panchmformid; ?>"> Reset Search</a>
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
                                    <?php if (in_array($current_user_role, $table_mod_roles) || in_array($current_user_role, $sup_roles)) { ?>
                                        <th scope="col" class="text-center text-nowrap align-middle no-print">Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <?php while ($row2 = $result2->fetch_assoc()) { ?>
                                <tbody>
                                    <tr>
                                        <td class="text-center text-nowrap"><?php echo date("d-m-Y", strtotime($row2['date'])); ?></td>
                                        <td class="text-center text-nowrap"><?php echo date('g:i a', strtotime($row2['time'])); ?></td>
                                        <td class="text-center"><?php echo $row2['proced_details']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['duration']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['proc_type']; ?></td>
                                        <td class="text-center text-nowrap"><?php echo $row2['doctor_name']; ?></td>
                                        <td class="text-center"><img src="<?php echo $row2['doctors_sign']; ?>" alt="Doctor's Sign" width="100" height="90"></td>
                                        <?php if (in_array($current_user_role, $table_mod_roles) || in_array($current_user_role, $sup_roles)) { ?>
                                            <td class="text-center no-print"><a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal<?php echo $row2[$primary_key]; ?>" href="deleterecs.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>&panchformid=<?php echo $panchmformid?>&tb=<?php echo $table_id?>&recid=<?php echo $row2[$primary_key]; ?>">Delete</a>
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
                                                                <a id="deleteLink" class="btn btn-danger" href="deleterecs.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>&panchformid=<?php echo $panchmformid?>&tb=<?php echo $table_id?>&recid=<?php echo $row2[$primary_key]; ?>">Delete</a>
                                                                
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
    </script>
    </div>
</body>