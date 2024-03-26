<?php
include('connect.php');
include_once('header.php');
pheader("Doctor's Observation Chart");
$user_id;
$visit_id;
if (isset($_GET['user']) && isset($_GET['visit'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
} else {
    echo "Cannot find required parameters";
}
?>
<body class="">
    <div class="container mx-2">
<form id="create_patient" action="" method="post">
            <div class="row my-3">
                <h2 class="text-center">IP Initial Assessment</h2>
                <h3>Vital Signs</h3>
                <div class="col">
                    <div class="form-group">
                        <label for="temperature">Temperature</label>
                        <input type="text" class="form-control" name="temperature" value="30 Degree" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="pulse">Pulse</label>
                        <input type="text" class="form-control" name="pulse" value="60" required>
                    </div>
                </div>
                <div class="col">
                    <label for="pulsetype">Pulse Type</label>
                    <select name="pulsetype" id="pulsetype" class="form-control" required>
                        <option value="" selected disabled hidden>Select the Type</option>
                        <option value="Regular">Regular <?php if ($pulse_type === 'Regular') { echo ' selected'; } ?></option>
                        <option value="Irregular">Irregular <?php if ($pulse_type === 'Irregular') { echo ' selected'; } ?> </option>
                    </select>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <div class="form-group">
                        <label for="bp">Blood Pressure</label>
                        <input type="text" class="form-control" name="bp" value="<?php echo $bp ?>" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="height">Height</label>
                        <input type="text" class="form-control" name="height" value="<?php echo $height ?>" required>
                    </div>
                </div>
                <div class="col">
                    <label for="painassessment">Pain Assesment</label>
                    <select name="painassessment" id="painassessment" class="form-control" required>
                        <option value="" <?php if ($pain === '') { echo ' selected'; } ?> disabled hidden>Select the Correct Value</option>
                        <option value="0: No Pain" <?php if ($pain === '0: No Pain') { echo ' selected'; } ?>>0: No Pain</option>
                        <option value="2 : Hurts Little Bit"<?php if ($pain === '2 : Hurts Little Bit') { echo ' selected'; } ?> >2 : Hurts Little Bit</option>
                        <option value="4 : Hurts Little More" <?php if ($pain === '4 : Hurts Little More') { echo ' selected'; } ?>>4 : Hurts Little More</option>
                        <option value="6 : Hurts Even More" <?php if ($pain === '6 : Hurts Even More') { echo ' selected'; } ?>>6 : Hurts Even More</option>
                        <option value="8 : Hurts a Whole Lot" <?php if ($pain === '8 : Hurts a Whole Lot') { echo ' selected'; } ?>>8 : Hurts a Whole Lot</option>
                        <option value="10 : Hurts Worst"  <?php if ($pain === '10 : Hurts Worst') { echo ' selected'; } ?>>10 : Hurts Worst</option>
                    </select>
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="text" class="form-control" name="weight" value="<?php echo $weight ?>" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="bmi">Body Mass Index</label>
                        <input type="text" class="form-control" name="bmi" value="<?php echo $bmi ?>" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
             <h3 class="my-3">Nutritional Screening</h3>
             <div class="col">
                    <label for="built">Built</label>
                    <select name="built" id="built" class="form-control" required>
                        <option value="" <?php if ($built === '') { echo ' selected'; } ?> disabled hidden>Select the Correct Option</option>
                        <option value="Normal" <?php if ($built === 'Normal') { echo ' selected'; } ?>>Normal</option>
                        <option value="Underweight" <?php if ($built === 'Underweight') { echo ' selected'; } ?>>Underweight</option>
                        <option value="Overweight <?php if ($built === 'Overweight') { echo ' selected'; } ?>">Overweight</option>
                    </select>
                </div>
                <div class="col">
                    <label for="gastric">Gastric Issues in Last 6 Months</label>
                    <select name="gastric" id="gastric" class="form-control" required>
                        <option value="" <?php if ($gsisx === '') { echo ' selected'; } ?> disabled hidden>Select the Correct Option</option>
                        <option value="Yes" <?php if ($gsisx === 'Yes') { echo ' selected'; } ?>>Yes</option>
                        <option value="No" <?php if ($gsisx === 'No') { echo ' selected'; } ?>>No</option>
                    </select>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="weightgalo">Weight Gain or Lost in last 6 Months</label>
                        <input type="text" class="form-control" name="weightgalo" value="<?php echo $wtgain ?>" required>
                    </div>
                </div>
            </div>
            <div class="row my-3">
             <div class="col">
                    <label for="nutri_stat">Nutritional Status</label>
                    <select name="nutri_stat" id="nutri_stat" class="form-control" required>
                        <option value="" <?php if ($nusts === '') { echo ' selected'; } ?> disabled hidden>Select the Correct Option</option>
                        <option value="Normal" <?php if ($nusts === 'Normal') { echo ' selected'; } ?>>Normal</option>
                        <option value="Excess" <?php if ($nusts === 'Excess') { echo ' selected'; } ?>>Excess</option>
                        <option value="Malnutrition" <?php if ($nusts === 'Malnutrition') { echo ' selected'; } ?>>Malnutrition</option>
                        <option value="Severe Malnutrition" <?php if ($nusts === 'Severe Malnutrition') { echo ' selected'; } ?>>Severe Malnutrition</option>
                    </select>
                </div>
                <div class="col">
                    <label for="diffinphyact">Difficulty in Physical Activities</label>
                    <select name="diffinphyact" id="diffinphyact" class="form-control" required>
                        <option value="" <?php if ($dpa === '') { echo ' selected'; } ?> disabled hidden>Select the Correct Option</option>
                        <option value="Yes" <?php if ($dpa === 'Yes') { echo ' selected'; } ?>>Yes</option>
                        <option value="No" <?php if ($dpa === 'No') { echo ' selected'; } ?>>No</option>
                    </select>
                </div>
                <div class="col">
                    <label for="infovisp">Intake of any Food or Vitamin Supplements</label>
                    <select name="infovisp" id="infovisp" class="form-control" required>
                        <option value="" <?php if ($ifvs === '') { echo ' selected'; } ?> disabled hidden>Select the Correct Option</option>
                        <option value="Yes" <?php if ($ifvs === 'Yes') { echo ' selected'; } ?>>Yes</option>
                        <option value="No" <?php if ($ifvs === 'No') { echo ' selected'; } ?>>No</option>
                    </select>
                </div>
               </div>
               <div class="row my-3">
               <div class="col">
                        <div class="form-group">
                            <label for="prescompndur">Presenting Complaints & Duration</label>
                            <textarea class="textarea" maxlength="500" rows="10" cols="30" name="prescompndur" class="form-control" value=""></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="hispresill">History of Presenting Illness</label>
                            <textarea class="textarea" maxlength="500" rows="10" cols="30" name="hispresill" class="form-control" value=""></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="hisprevill">History of Previous Illnesses</label>
                            <textarea class="textarea" maxlength="500" rows="10" cols="30" name="hisprevill" class="form-control" value=""></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="treatmeddet">Treatment / Medication Details</label>
                            <textarea class="textarea" maxlength="500" rows="10" cols="30" name="treatmeddet" class="form-control" value=""></textarea>
                        </div>
                    </div>
               </div>
               <div class="row my-3">
                <div class="col">
                <label for="bowelhab">Bowel Habbits</label>
                <input type="text" class="form-control" maxlength="20"name="bowelhab" value="" required>
                </div>
                <div class="col">
                <label for="appetite">Appetite</label>
                <input type="text" class="form-control" maxlength="20"name="appetite" value="" required>
                </div>
                <div class="col">
                <label for="micturition">Micturition</label>
                <input type="text" class="form-control" maxlength="20"name="micturition" value="" required>
                </div>
                <div class="col">
                <label for="sleep">Sleep</label>
                <input type="text" class="form-control" maxlength="20"name="sleep" value="" required>
                </div>
               </div>
               <?php
               $sql3="SELECT * FROM FSbNJe9_user_data WHERE user_id =$user_id";
               $result2 = $conn->query($sql3);
               $row2 = $result2->fetch_assoc();
               if($row2['gender']!="Male" && $row2['gender']!="male" )
               {
               ?>
               <div class="row my-3">
               <h3 class="my-3">Menstruation Details</h3>
                <div class="col">
                <label for="mcycle">Menstruation Cycle</label>
                    <select name="mcycle" id="mcycle" class="form-control" required>
                        <option value="" selected disabled hidden>Select the Type</option>
                        <option value="Regular">Regular</option>
                        <option value="Irregular">Irregular</option>
                    </select>
                </div>
                <div class="col">
                <label for="mflow">Menstruation Flow</label>
                    <select name="mflow" id="mflow" class="form-control" required>
                        <option value="" selected disabled hidden>Select the Type</option>
                        <option value="Normal">Normal</option>
                        <option value="Less">Less</option>
                        <option value="More">More</option>
                        <option value="Irregular">Irregular</option>
                    </select>
                </div>
                <div class="col">
                <label for="massocwt">Menstruation Associated With</label>
                    <select name="massocwt" id="massocwt" class="form-control" required>
                        <option value="" selected disabled hidden>Select the Option</option>
                        <option value="Nill">Nill</option>
                        <option value="Pain">Pain</option>
                        <option value="Clot">Clot</option>
                        <option value="Muscle Cramps">Muscle Cramps</option>
                        <option value="White Discharge">White Discharge</option>
                    </select>
                </div>
               </div>
               <?php
             }
             ?>
             <div class="row my-3">
             <h3 class="my-3">General Examination</h3>
                <div class="col">
                <input type="checkbox" class="form-check-input" name="constat" id="constat">
                        <label for="constat">Unconscious
                            <style>
                                label {
                                    display: inline;
                                }
                            </style>
                        </label>
                </div>
                <div class="col">
                <input type="checkbox" class="form-check-input" name="mntorient" id="mntorient">
                        <label for="mntorient">Disoriented
                            <style>
                                label {
                                    display: inline;
                                }
                            </style>
                        </label>
                </div>
                <div class="col">
                <input type="checkbox" class="form-check-input" name="mobility" id="mobility">
                        <label for="mobility">Bedridden
                            <style>
                                label {
                                    display: inline;
                                }
                            </style>
                        </label>
                </div>
                <div class="col">
                <label for="builttype">Built Type</label>
                    <select name="builttype" id="builttype" class="form-control" required>
                        <option value="" selected disabled hidden>Select the Option</option>
                        <option value="Well">Well</option>
                        <option value="Moderate">Moderate</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>
                <div class="col">
                        <div class="form-group">
                            <label for="geother">Others</label>
                            <textarea class="textarea" maxlength="200" rows="5" cols="20" name="geother" class="form-control" value=""></textarea>
                        </div>
                    </div>
             </div>
             <div class="row my-3">
             <h4 class="my-3">Care Plan Strategy</h4>
             <div class="col">
                <input type="checkbox" class="form-check-input" name="cpsprevention" id="cpsprevention">
                        <label for="cpsprevention">Prevention
                            <style>
                                label {
                                    display: inline;
                                }
                            </style>
                        </label>
                </div>
             <div class="col">
                <input type="checkbox" class="form-check-input" name="cpscurative" id="cpscurative">
                        <label for="cpscurative">Curative
                            <style>
                                label {
                                    display: inline;
                                }
                            </style>
                        </label>
                </div>
                <div class="col">
                <input type="checkbox" class="form-check-input" name="cpsrehabilitative" id="cpsrehabilitative">
                        <label for="cpsrehabilitative">Rehabilitative
                            <style>
                                label {
                                    display: inline;
                                }
                            </style>
                        </label>
                </div>
                <div class="col">
                <input type="checkbox" class="form-check-input" name="cpspromotive" id="cpspromotive">
                        <label for="cpspromotive">Promotive
                            <style>
                                label {
                                    display: inline;
                                }
                            </style>
                        </label>
                </div>
             </div>
             <div class="row my-3">
             <h4 class="my-3">Care Plan </h4>
             <div class="col">
             <select name="dietplan" class="form-control" id="dietplan">
<option value="" selected disabled hidden>Select Diet Plan</option>
<option value="Hypertention">Hypertention</option>
<option value="Madhumeha">Madhumeha</option>
<option value="Madhumeha">Obesity</option>
<option value="Obesity">Virechana</option>
<option value="Vasthi">Vasthi</option>
<option value="Snehapana">Snehapana</option>
<option value="Vata">Vata</option>
<option value="Pitha">Pitha</option>
<option value="Kapha">Kapha</option>
<option value="General">General</option>
</select>
             </div>
             <div class="col">
                <input type="checkbox" class="form-check-input" name="cpaaumed" id="cpaaumed">
                        <label for="cpaaumed">Approve Already Undergoing Medicines
                            <style>
                                label {
                                    display: inline;
                                }
                            </style>
                        </label>
                </div>
             </div>
             <div class="row my-3">
                <div class="col">
                <div class="form-group">
                            <label for="prodiag">Provisional Diagnosis</label>
                            <textarea class="textarea" maxlength="200" rows="5" cols="30" name="prodiag" class="form-control" value=""></textarea>
                        </div>
                </div>
                <div class="col">
                <div class="form-group">
                            <label for="investgations">Investigations (If Any)</label>
                            <textarea class="textarea" maxlength="200" rows="5" cols="30" name="prodiag" class="form-control" value=""></textarea>
                        </div>
                </div>
                <div class="col">
                <div class="form-group">
                            <label for="desireout">Desired Outcome</label>
                            <textarea class="textarea" maxlength="200" rows="5" cols="30" name="desireout" class="form-control" value=""></textarea>
                        </div>
                </div>
             </div>
            </form>
            </div>
</body>