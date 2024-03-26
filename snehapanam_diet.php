<?php
include_once('header.php');
pheader("Snehapanam Diet");
$user_id;
$visit_id;
if (isset($_GET['user']) && isset($_GET['visit'])) {
    $user_id = $_GET['user'];
    $visit_id = $_GET['visit'];
} else {
    echo "Cannot find required parameters";
}
?>
<div class="container my-5">
    <form method="post">
    <textarea name="diettextarea" id="diettextarea" cols="30" rows="10">
    <h2 style="text-align: center;">Diet during Snehapanam<strong>&nbsp;</strong></h2>
<p style="text-align: center;"><strong>Day &nbsp; 1</strong></p>
<p style="text-align: center;"><strong>Breakfast: -</strong>None</p>
<p style="text-align: center;"><strong>Lunch:</strong>&nbsp;<strong>-</strong>Rice soup &amp; Steamed Vegetables</p>
<p style="text-align: center;"><strong>Dinner: -</strong>2 multigrain chapathy, mixed vegetable curry, veg Clear soup.</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><strong>Day &nbsp; 2</strong></p>
<p style="text-align: center;"><strong>Breakfast: -</strong>None</p>
<p style="text-align: center;"><strong>Lunch: -</strong>Rice soup &amp; Steamed Vegetables</p>
<p style="text-align: center;"><strong>Dinner: -</strong>Veg. Fried rice, &nbsp;Pine apple curry, Sweet corn soup.&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><strong>Day &nbsp; 3</strong></p>
<p style="text-align: center;"><strong>Breakfast: -</strong>None</p>
<p style="text-align: center;"><strong>Lunch:</strong>Rice soup &amp; Steamed Vegetables</p>
<p style="text-align: center;"><strong>Dinner: -</strong>Carrot rice, &nbsp;Green gram curry. &nbsp;Pumpkin soup.</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><strong>Day &nbsp; 4</strong></p>
<p style="text-align: center;"><strong>Breakfast: -</strong>None</p>
<p style="text-align: center;"><strong>Lunch:</strong>&nbsp;Rice soup &amp; Steamed Vegetables</p>
<p style="text-align: center;"><strong>Dinner:</strong>Vegetable &nbsp; pulav, &nbsp;Ladies finger curry, &nbsp;Beetroot soup.</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><strong><u>NB : &nbsp;Drink Ginger Water</u></strong></p>
    </textarea>  
    </form>
</div>
<script src="tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#diettextarea',
        branding: false,
        promotion: false,
        plugins: 'table code insertdatetime lists advlist',
  toolbar: 'table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol code insertdatetime bullist numlist'
      });
    </script>


