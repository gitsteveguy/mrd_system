<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connect.php');
include_once('header.php');
pheader("Edit Visit");

$user_id;
if(isset($_GET['user']) && isset($_GET['visit']))
{
    $user_id= $_GET['user'];
    $visit_id = $_GET['visit'];
}
$doa="";
$dod="";
$rmno="";
$doa = $param_pat_visit_det['date_of_admission'];
$dod = $param_pat_visit_det['date_of_discharge'];
$rmno = $param_pat_visit_det['room_no'];
?>
<div class="container my-3">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit Visit</h2>
            <form id="cvisedit" method="post" action="edit_core_visit_submission.php">
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
                        <input type="text" name="dateofadmm" id="dateofadmm" class="form-control" placeholder="Date Of Admission" value="<?php echo $doa?>" required onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                        <input type="text" name="dateofdis" id="dateofdis" class="form-control" placeholder="Date Of Discharge" value="<?php echo $dod?>" onfocus="(this.type='date')" onblur="(this.type='text')">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                        <input type="text" name="roomno" id="roomnof" class="form-control" value="<?php echo $rmno?>" placeholder="Room No:">
                        <input type="hidden" name="userid" value="<?php echo $user_id ?>">
                        <input type="hidden" name="visitid" value="<?php echo $visit_id ?>">
                    </div>
                    </div>
                </div>
                
                <button type="submit" name="update" class="btn btn-primary my-3 mx-2">Update</button>
                <a href="visitdetails.php?user=<?php echo $user_id?>&visit=<?php echo $visit_id?>" class="btn btn-danger">Cancel</a>
                <?php  
             if ((!in_array($current_user_role, $table_submit_roles) && !in_array($current_user_role,$sup_roles) && !in_array($current_user_role,$table_mod_roles))||(($formeditable=="No") && (!in_array($current_user_role,$sup_roles))))
             {
                 ?>
                 </fieldset>
                    <?php
             }    
            ?>
            </form>
            <!-- Bootstrap Modal -->
            <div class="modal fade" id="recfreezwarn" tabindex="-1" aria-labelledby="recfreezwarn" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="color:green!important" id="confirmModalLabel">Confirm Discharge</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p style="color:green!important">By Confirming Discharge date the Data of this visit can no longer be edited by the staff unless admin allows it</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="confirm" class="btn btn-primary" id="confirmButton">Confirm</button>
                                                            </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
            </div>
                </div>
</div>
</body>
<script>
console.log("begin");
  $('#cvisedit').submit(function(event) {
    
    event.preventDefault(); // Prevent the default form submission
    var dateValue = $('#dateofdis').val();
    console.log(dateValue);
   if (dateValue) {
      $('#recfreezwarn').modal('show');
      $('#confirmButton').on('click', function() {
    // Close the modal
    $('#recfreezwarn').modal('hide');
    // Submit the form
    $('#cvisedit')[0].submit();
  })
    } else {
      // If the date input field is empty, submit the form directly
      $('#cvisedit')[0].submit();
    } 
    
  });

  // Optional: Close the modal and submit the form when the confirm button is clicked
  
</script>