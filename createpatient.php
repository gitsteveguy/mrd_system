<?php
include_once('header.php')
?>
<!DOCTYPE html>
<html lang="en">
<?php
pheader("Create Patient");
?>

<body id="body">
  <h1 class="text-center my-3">Patient Registration Form</h1>
  <div class="container d-flex justify-content-center">
    <form id="create_patient" action="createpatientsubmit.php" method="post">
      <div class="row">
        <div class="col">
          <!--label for="firstname">First Name</label>-->
          <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" required>
        </div>
        <div class="col">
          <!--<label for="lastname">Last Name</label>-->
          <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" required>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <!--<label for="username">Username</label>-->
          <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="col">
          <!--<label for="email">e-Mail</label>-->
          <input type="email" name="email" id="email" class="form-control" placeholder="e-Mail" >
        </div>
      </div>
      <div class="row">
        <div class="col">
          <!--<label for="dateofbirth">Date Of Birth</label>-->
          <input type="text" name="dateofbirth" id="dateofbirth" class="form-control" placeholder="Date Of Birth" onfocus="(this.type='date')" onblur="(this.type='text')">
        </div>
        <div class="col">
          <!--<label for="phoneno">Phone No:</label>-->
          <input type="tel" name="phoneno" id="phoneno" class="form-control" pattern="[0-9]{10}" placeholder="Phone No:" >
        </div>
        <div class="row">
          <div class="col">
            <!--<label for="gender">Gender</label>-->
            <input type="text" name="gender" id="gender" class="form-control" placeholder="Gender" required>
          </div>
          <div class="col">
            <!--<label for="bloodgroup">Blood Group:</label>-->
            <select name="bloodgroup" id="bloodgroup" class="form-control" placeholder="Blood Group" >
              <option value="" selected disabled hidden>Select a Blood Group</option>
              <option value="N.A">None</option>
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <!--label for="addressline1">Address Line 1</label>-->
            <input type="text" name="addressline1" id="addressline1" class="form-control" placeholder="Address Line 1" >
          </div>
          <div class="col">
            <!--label for="addressline2">Address Line 2</label>-->
            <input type="text" name="addressline2" id="addressline2" class="form-control" placeholder="Address Line 2">
          </div>
          <div class="col">
            <!--label for="addressline3">Address Line 3</label>-->
            <input type="text" name="addressline3" id="addressline3" class="form-control" placeholder="Address Line 3">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <!--label for="Country">Country</label>-->
            <input type="text" name="country" id="countryselect" class="form-control" placeholder="Choose a Country" >
          </div>
          <div class="col">
            <!--<label for="pincode">Pincode</label>-->
            <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pincode / Zipcode" >
          </div>
          <div class="col">
            <!--<label for="occupation">Occupation</label>-->
            <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Occupation" >
          </div>
        </div>
        <div class="row">
          <div class="col"></div>
          <div class="col">
            <input type="text" name="password" id="password" class="form-control" placeholder="Password" required>
          </div>
          <div class="col"></div>
        </div>
        <div class="row my-3">
          <div class="col">
            <!--label for="camera">Camera</label>-->
            <video id="preview" width="300" height="300" style="display:flex;"></video>
            <button type="button" class="btn btn-primary" id="startcam">Open Camera</button>
            <button type="button" class="btn btn-primary" id="snap">Take Photo</button>
          </div>
          <div class="col">
            <!--<label for="image url">Last Name</label>-->
            <input id="profileimageuri" name="profileimageuri" type="text" class="form-control">
            <img id="timage" width="300" height="300" style="display:flex"></img>
            <label>Captured Photo</label>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div id="signdiv" style="width:300px;">
              <label class="my-2">Signature</label>
              <input id="signimageuri" name="signimageuri" type="text" class="form-control">
              <canvas id="sign" width="150" height="150" class="form-control"></canvas>
              <button type="button" class="btn btn-primary" id="clearsignbtn">Clear</button>
              <button type="button" class="btn btn-primary" id="signconfirm">Confirm Signature</button>
            </div>
          </div>
          <div class="col"></div>
        
        <div class="col"></div>
        </div>
        <div class="row">
          <div class="col">
            <!--label for="firstname">First Name</label>-->
            <button type="submit" name="submit" class="btn btn-success my-3">Submit</button>
          </div>
        </div>
    </form>
  </div>
  <script src="countryselector.js"></script>
  <script src="takephoto.js"></script>
  <script src="signaturecanvasscripts.js"></script>
</body>
</html>