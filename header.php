<?php
// Get the requested URL
$request_uri = $_SERVER['REQUEST_URI'];

// Extract the base URL without parameters
$base_url = strtok($request_uri, '?');

// Check if the base URL ends with .php
if (strpos($base_url, '.php') !== false) {
    // Remove the .php extension
    $url_without_php = preg_replace('/\.php$/', '', $base_url);

    // Redirect the user to the URL without the .php extension
    $redirect_url = 'http://' . $_SERVER['HTTP_HOST'] . $url_without_php;
    
    // If there are parameters, append them to the redirect URL
    if ($_SERVER['QUERY_STRING']) {
        $redirect_url .= '?' . $_SERVER['QUERY_STRING'];
    }

    header('Location: ' . $redirect_url, true, 301);
    exit();
}
include_once('protect.php');
if (isset($_GET['user'])) {
    $user_id = $_GET['user'];

    $patsql = "SELECT * FROM FSbNJe9_user_data WHERE user_id = ?";
    $stmtpatdet = $conn->prepare($patsql);
$stmtpatdet->bind_param("i",$user_id);
if (!$stmtpatdet->execute()) {
    die("Error: " . $stmtpatdet->error);
  }
$resultpatdet = $stmtpatdet->get_result();
$param_pat_det = $resultpatdet->fetch_assoc();

if(isset($_GET['visit'])){
    $visit_id = $_GET['visit'];
$vissql = "SELECT * FROM visits WHERE visit_id = ?";
    $stmtpatvisdet = $conn->prepare($vissql);
$stmtpatvisdet->bind_param("i",$visit_id);
if (!$stmtpatvisdet->execute()) {
    die("Error: " . $stmtpatvisdet->error);
  }
$resultpatvisdet = $stmtpatvisdet->get_result();
$param_pat_visit_det = $resultpatvisdet->fetch_assoc();

}
} 
 
function pheader($title)
{
    global $user_id;
    global $visit_id;
    global $current_user_name;
    global $param_pat_det;
    global $param_pat_visit_det;
    global $formphps;
    echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>$title</title>
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js\"></script>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\" integrity=\"sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ\" crossorigin=\"anonymous\">
    <script src=\"https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js\" ></script>
    <link href=\"https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"styles.css\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css\">
</head>
<div class=\"header bg-white\">
    <nav>
        <img src=\"images/Site/shinshiva-main-header-image.jpeg\" alt=\"header-logo\" class=\"img-fluid fullimg\"></img>
        <div class=\"justify-content-center d-flex\">
        <h2 class = \"text-success\">MEDICAL RECORDS DATA MANAGEMENT SYSTEM</h2>
        </div>
        <h4 class= \"text-success text-center\"> Welcome $current_user_name</h4>
    </nav>
</div>";
?>
    <div class="row my-2 mx-2 d-flex no-print">
        <div class="col text-start">
            <a href="mrddashboard.php" class="btn btn-primary">Home</a>
        </div>
        <div class="col text-center">
            <div id="google_translate_element"></div>
            <script type="text/javascript">
                function googleTranslateElementInit() {
                    new google.translate.TranslateElement({
                        pageLanguage: 'en',
                    }, 'google_translate_element');
                }
            </script>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        </div>
        <div class="col text-end">
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>
    <?php if(isset($user_id)) {
    ?>
    <div class="row mx-5">
    <?php if(basename($_SERVER['PHP_SELF'])=="patient.php") 
            {
            ?>
        <div class="col" style="background-color: #28a602; border-radius: 8px; ;color:white; padding:5px;">
            <h5 class="text-center">Patient Name : <?php echo $param_pat_det['first_name']." ".$param_pat_det['last_name']; ?></h5> 
        </div>
        <?php 
            }
            else
            { ?>
            <div class="col">
               <a href="patient.php?user=<?php echo $user_id?>" class="btn btn-success" style="display:block!important"><h5>Patient Name : <?php echo $param_pat_det['first_name']." ".$param_pat_det['last_name']; ?></h5></a>
            </div>
          <?php  }
            if(in_array(basename($_SERVER['PHP_SELF']),$formphps)||basename($_SERVER['PHP_SELF'])=="exportall.php")
            {
            ?>
       <div class="col text-center">
            <button type="button" class="btn btn-primary" onclick="window.print()">Print Record</button>
        </div>
        <?php 
            }
            if(basename($_SERVER['PHP_SELF'])=="visitdetails.php"){
                ?>
                <div class="col">
                <a href="exportall.php?user=<?php echo $user_id?>&visit=<?php echo $visit_id ?>" class="btn btn-success" style="display:block!important"><h5>Export All Visit Details</h5></a>
                </div>
                <?php 
            }
            if(isset($visit_id))
            {   
                $doa = $param_pat_visit_det['date_of_admission'];
                $dod = $param_pat_visit_det['date_of_discharge'];
                if($dod!=''){
                $discharge_text = date("d-m-Y", strtotime($dod));}
                else{
                    $discharge_text = "Present"; 
                }
                if(basename($_SERVER['PHP_SELF'])=="visitdetails.php") {
                ?> 
                <div class="col">
                <a href="edit_core_visit.php?user=<?php echo $user_id?>&visit=<?php echo $visit_id?>" class="btn btn-success" style="display:block!important"><h5 class="text-center">Visit: <?php echo (date("d-m-Y", strtotime($doa))." to ".$discharge_text); ?></h5></a>
                </div>
            <?php
                } 
                else {
                    ?>
                    <div class="col">
                       <a href="visitdetails.php?user=<?php echo $user_id?>&visit=<?php echo $visit_id?>" class="btn btn-success" style="display:block!important"><h5 class="text-center">Visit: <?php echo (date("d-m-Y", strtotime($doa))." to ".$discharge_text); ?></h5></a>
                    </div>
                  <?php    
                }
            }
            else
            {
             ?>
             <div class="col"></div>
             <?php } ?>
        </div>
    </div>
<?php
    }
}
?>