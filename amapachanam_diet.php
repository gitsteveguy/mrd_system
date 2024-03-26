<?php
include_once('header.php');
pheader("Amapachanam Diet");
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

    <p style="text-align: center;"><strong><u>Amapachanam Diet</u></strong></p>
<p style="text-align: center;"><strong><u>Day 1</u></strong></p>
<p style="text-align: center;">Break fast: &nbsp;&nbsp;Appam, Sambar, Green Tea / mix Vegetable Juice</p>
<p style="text-align: center;">Lunch&nbsp; &nbsp; &nbsp; : &nbsp;Carrot Rice, Greemgram Curry, Snake gourd Thoran</p>
<p style="text-align: center;">Dinner &nbsp; &nbsp; :&nbsp;Pumpkin Soup, Chappathy, Mix. Veg. Salad</p>
<p style="text-align: center;"><strong><u>Day 2</u></strong></p>
<p style="text-align: center;">Break fast: &nbsp; &nbsp; Puttu, Vegetable Curry, Carrot &nbsp;Juice &nbsp; &nbsp;</p>
<p style="text-align: center;">Lunch &nbsp; &nbsp; &nbsp; : &nbsp; &nbsp;Vegetable Rice, Cauliflower Thoran, Dal Curry</p>
<p style="text-align: center;">Dinner &nbsp; &nbsp; &nbsp;:&nbsp;Tomato Soup, Green Salad, Steamed Banana</p>
<p style="text-align: center;"><strong><u>Day 3</u></strong></p>
<p style="text-align: center;">&nbsp;Breakfast &nbsp; &nbsp; &nbsp;: &nbsp;Idiyappam, Kadala Curry, Cucumber Juice &nbsp;</p>
<p style="text-align: center;">Lunch&nbsp;: &nbsp;Plain Rice, Olan, Cabbage Thoran</p>
<p style="text-align: center;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Dinner: &nbsp;Sweet corn Soup, Sprouts Salad, Vegetable Noodles (Clear Veg. Soup)</p>
<p style="text-align: center;"><strong><u>Day 4</u></strong></p>
<p style="text-align: center;">Break fast: &nbsp;&nbsp;Vegetable Uppuma, Steamed Banana, Mix Vegetable Juice &nbsp; &nbsp;&nbsp;</p>
<p style="text-align: center;">Lunch&nbsp; &nbsp; &nbsp; &nbsp;: &nbsp; Tomato Rice, Erissery, Beans Thoran</p>
<p style="text-align: center;">Dinner &nbsp; &nbsp; &nbsp;:&nbsp;Cucumber Soup, Aviyal, Jeera Rice</p>
<p style="text-align: center;"><strong><u>Day 5</u></strong></p>
<p style="text-align: center;">Break fast: &nbsp; &nbsp;Bread Toast with Honey, Steamed Apple</p>
<p style="text-align: center;">Lunch &nbsp; &nbsp; &nbsp; : &nbsp; &nbsp;Vegetable Pulavu, Small Onion Curry, Cucumber Thoran</p>
<p style="text-align: center;">Dinner &nbsp; &nbsp; &nbsp;:&nbsp;Chappathy, Tomato Masala, Beetroot Soup</p>
<p style="text-align: center;"><strong>Drinks &nbsp; : &nbsp; Herbal Tea</strong></p>
<p style="text-align: center;"><strong>&nbsp;No Oil, No Lemon, No Milk (Milk Products), No Tamarind, No Raw Fruits</strong></p>

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