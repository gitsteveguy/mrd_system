<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Patient");
$user_id;
$visit_id;
if(isset($_GET['user']))
{
    $user_id= $_GET['user'];
}

?>
<div class="container my-4">
    <div class="row">
        <div class="col">
        <a href="patientedit.php?user=<?php echo $user_id; ?>" class="btn btn-primary d-flex justify-content-center">Edit Patient's Main Details</a>
        </div>
        <div class="col">
        <a href="createvisit.php?user=<?php echo $user_id; ?>" class="btn btn-primary d-flex justify-content-center">Create a new Visit</a>
        </div>
    </div>
</div>
<?php
$visits_per_page = 20;

// Get the total number of visits
$sql = "SELECT COUNT(*) as count FROM `visits` WHERE user_id=$user_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_visits = $row['count'];
$counter = 0;
// Calculate the total number of pages
$total_pages = ceil($total_visits / $visits_per_page);

// Get the current page number
if (isset($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}
?>
<div style="display: flex; justify-content:center;" class="ccntner"><?php 
echo '<div class="container mx-2">';
// Calculate the offset for the SQL query
echo '<div class="row d-flex justify-content-center">';
$offset = ($current_page - 1) * $visits_per_page;
$sql = "SELECT visit_id,date_of_admission,date_of_discharge FROM `visits` WHERE user_id='$user_id' ORDER BY date_of_admission DESC LIMIT $offset, $visits_per_page";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $visit_id = $row['visit_id'];
        $date_of_admission = date("d-m-Y", strtotime($row['date_of_admission']));
        if($row['date_of_discharge']!=''){
        $date_of_discharge = date("d-m-Y", strtotime($row['date_of_discharge']));}
        $counter++;
        if ($counter == 4) {
          echo '</div><div class="row d-flex justify-content-center">';
          $counter = 0;
        }
        if(!isset($date_of_discharge))
        {
            $date_of_discharge="Present";
        }
?>
<div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <div class="card-body">
                  <h5 class="card-title d-flex justify-content-center"><?php echo $date_of_admission . " To " . $date_of_discharge; ?></h5>
                  <a href="visitdetails.php?user=<?php echo $user_id; ?>&visit=<?php echo $visit_id; ?>" class="btn btn-success d-flex justify-content-center">More Details</a>
                </div>
              </div>
            </div>

            <?php 
             }
            } else {
                echo "No visits found";
            }
        
            $conn->close();
            ?>
        
          </div>
        
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
        
              <?php
              // Display pagination links
              for ($i=1; $i<=$total_pages; $i++) {
                  ?>
                  <li class="page-item <?php if($current_page==$i) {echo 'active';} ?>"><a class="page-link" href="patient.php?user=<?php echo $user_id?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                  <?php
              }
              ?>
        
            </ul>
          </nav>
        </div>
        <div>