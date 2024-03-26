<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');?>
<?php
pheader("Visit Details");
$user_id;
$visit_id;
$success;
if (isset($_GET['user']) && isset($_GET['visit'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
} else {
    echo "Cannot find required parameters";
}
$success = isset($_GET['success'])?$_GET['success']:0;
?>
<style>
    .cctainer{
        display: flex;
        justify-content: center;
    }
</style>
<body>
<div class="container">
<h4 class="d-flex justify-content-center my-3">Doctor Records</h4>
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">IP Initial Assesment</h5>
                    <a href="ip_initial_assessment.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Medication Order</h5>
                    <a href="medication_orders.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Treatment Procedure Order</h5>
                    <a href="treatment_procedure.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Vital Chart</h5>
                    <a href="vital_chart_form.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Doctor Observation Chart</h5>
                    <a href="doctor_observation_chart_form.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Panchakarma Consent Form</h5>
                    <a href="panchakarma_consent_form.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Procedure Operative Notes</h5>
                    <a href="procedure_operative_notes.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Discharge Form</h5>
                    <a href="discharge_form.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <h4 class="d-flex justify-content-center my-3">Nurse Records</h4>
    <div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Fall Risk Assessment</h5>
                    <a href="fall_risk_assessment_form.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Nurse's Initial Assessment</h5>
                    <a href="nurses_initial_assessment_form.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Nursing Care Plan</h5>
                    <a href="nursing_care_plan_form.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Medication Administration Chart</h5>
                    <a href="medication_administration_chart_form.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Nurse's Daily Notes</h5>
                    <a href="nurses_daily_notes_form.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Nurse's Daily Record</h5>
                    <a href="nurses_daily_record_form.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Treatment Chart</h5>
                    <a href="treatment_chart_form.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">Add / Edit Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <h4 class="d-flex justify-content-center my-3">Diet Charts</h4>
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Amapachanam Diet</h5>
                    <a href="amapachanam_diet.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">View Diet Plan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Kapha Vatha Diet</h5>
                    <a href="kapha_vatha_diet.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">View Diet Plan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Kapha Diet</h5>
                    <a href="kapha_diet.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">View Diet Plan</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Kapha Pitha Diet</h5>
                    <a href="kapha_pitha_diet.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">View Diet Plan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Kaphokhlesa Diet</h5>
                    <a href="kaphoklesa_diet.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">View Diet Plan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Pitha Diet</h5>
                    <a href="pitha_diet.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">View Diet Plan</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Pitha Vatha Diet</h5>
                    <a href="pitha_vatha_diet.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">View Diet Plan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Snehapanam Diet</h5>
                    <a href="snehapanam_diet.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">View Diet Plan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Vatha Diet</h5>
                    <a href="vatha_diet.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">View Diet Plan</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Diabetic Diet</h5>
                    <a href="diabetic_diet.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">View Diet Plan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center pformnames">Weight Loss Diet</h5>
                    <a href="weight_loss_diet.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">View Diet Plan</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if($success==1) 
{
 ?>
<div class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 11">
 <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" id="liveToast">
 <div class="d-flex text-center">
    <div class="toast-body">
      Records Have been Added / Updated Successfully.
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>
</div>
 <?php 
}
  ?>
  </body>
<script>
    toastshow();
    function toastshow()
    {
    toastupd = document.getElementById('liveToast');
    if(<?php echo $success?>== 1)
    toast = new bootstrap.Toast(toastupd);
    toast.show();
    }
</script>