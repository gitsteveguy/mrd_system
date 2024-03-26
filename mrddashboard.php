<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php')
?>

<!DOCTYPE html>
<html lang="en">

<?php
pheader("MRD Dashboard");
$search = isset($_GET['search']) ? $_GET['search'] : '';
?>
<h2 class="d-flex justify-content-center">MRD Dashboard</h2>
<div class="container my-3">
    <div class="row">
        <div class="col">
        <a href="createpatient.php" class="btn btn-primary d-flex justify-content-center">Create a new Patient</a>
        </div>
        <?php 
        if($current_user_role=="superadmin"||$current_user_role=="Admin")
        {
        ?>
        <div class="col">
        <a href="createstaff.php" class="btn btn-primary d-flex justify-content-center">Create a new Staff</a>
        </div>
        <?php } ?>
    </div>
</div>
<form class="my-3" action="mrddashboard.php" method="GET">
<h2 class="d-flex justify-content-center">Patients</h2>
  <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Search by first name, last name, or MRD no" name="search" value="<?php echo $search; ?>">
    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
  </div>
</form>
<div class="container">
  <div class="row my-3">

    <?php
    // Set the number of patients to display per page
    $patients_per_page = 20;

    // Get the total number of patients
    $sql = "SELECT COUNT(*) as count FROM `FSbNJe9_user_data` WHERE role='Patient'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_patients = $row['count'];
    $counter = -1;
    // Calculate the total number of pages
    $total_pages = ceil($total_patients / $patients_per_page);

    // Get the current page number
    if (isset($_GET['page'])) {
        $current_page = $_GET['page'];
    } else {
        $current_page = 1;
    }

    // Calculate the offset for the SQL query
    $offset = ($current_page - 1) * $patients_per_page;

    // Get the patients for the current page
    $sql = "SELECT user_id, first_name, last_name, profile_img FROM `FSbNJe9_user_data` WHERE role='Patient' LIMIT $offset, $patients_per_page";
    if(isset($_GET['search']))
    {
       $sql = "SELECT user_id, first_name, last_name, profile_img FROM `FSbNJe9_user_data` WHERE role='Patient' AND (first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR mrd_no LIKE '%$search%')";
    }
    $result = $conn->query($sql);
    $fpd=1;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $user_id = $row['user_id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $profile_img = $row['profile_img'];
            $counter++;
            if ($counter == 4) {
              echo '</div><div class="row my-3">';
              $counter = 0;
            }
            ?>

            <div class="col-md-3">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" width="304" height="228" src="<?php echo $profile_img; ?>" alt="Profile image">
                <div class="card-body">
                  <h5 class="card-title d-flex justify-content-center"><?php echo $first_name . " " . $last_name; ?></h5>
                  <a href="patient.php?user=<?php echo $user_id; ?>" class="btn btn-success d-flex justify-content-center">More Details</a>
                </div>
              </div>
            </div>

            <?php
        }
    } else {
        echo "No users found";
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
          <li class="page-item <?php if($current_page==$i) {echo 'active';} ?>"><a class="page-link" href="mrddashboard.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php
      }
      ?>

    </ul>
  </nav>
</div>
