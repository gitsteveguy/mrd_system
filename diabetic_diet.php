<?php
include_once('header.php');
pheader("Diabetic Diet");
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

    <p style="text-align: center;"><strong><u>DIABETIC DIET CHART</u></strong></p>
<div class="row" style="text-align: center;">
<div class="col">
<table style="border-collapse: collapse; border-color: rgb(0, 0, 0); height: 622px; width: 99.8413%;" border="1">
<tbody>
<tr>
<td style="border-color: rgb(0, 0, 0); width: 32.8537%;">
<p><strong>BREAKFAST</strong></p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 41.247%;">
<p><strong>LUNCH</strong></p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 25.9792%;">
<p style="text-align: center;"><strong>DINNER</strong></p>
</td>
</tr>
<tr>
<td style="border-color: rgb(0, 0, 0); width: 32.8537%;">
<p>Oats puttu + vegetable curry (without potato)</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 41.247%;">
<p>1 cup of rice + Veg.thoran</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 25.9792%;">
<p>Mixed Veg Soup + Steamed veggies</p>
</td>
</tr>
<tr>
<td style="border-color: rgb(0, 0, 0); width: 32.8537%;">
<p>Rava upuma</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 41.247%;">
<p>Sprout salad + Buttermilk</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 25.9792%;">
<p>Pumpkin soup&nbsp;</p>
<p>+Steamed veggies</p>
</td>
</tr>
<tr>
<td style="border-color: rgb(0, 0, 0); width: 32.8537%;">
<p>Ragi dosa + chutney</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 41.247%;">
<p>Ash gourd with less coconut &amp; less oil + Chappathy</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 25.9792%;">
<p>Carrot Soup+Steamed veggies</p>
</td>
</tr>
<tr>
<td style="border-color: rgb(0, 0, 0); width: 32.8537%;">
<p>Appam +Onion curry</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 41.247%;">
<p>Spinach thoran ( Less Coconut and less oil ) + 1 chapathy</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 25.9792%;">
<p>Cucumber Soup+ Steamed apple</p>
</td>
</tr>
<tr>
<td style="border-color: rgb(0, 0, 0); width: 32.8537%;">
<p>Wheat Puttu with Steamed banana</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 41.247%;">
<p>1 Cup of Plain Rice + Mixed Veg. Thoran</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 25.9792%;">
<p>Steamed veggies+ Pumpkin soup&nbsp;</p>
</td>
</tr>
<tr>
<td style="border-color: rgb(0, 0, 0); width: 32.8537%;">
<p>Raggi puttu</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 41.247%;">
<p>Sprout salad + &frac12; fruit plate</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 25.9792%;">
<p>Steamed banana+ Beetroot soup</p>
</td>
</tr>
<tr>
<td style="border-color: rgb(0, 0, 0); width: 32.8537%;">
<p>Idiyappam + Veg. Curuma</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 41.247%;">
<p>Chappathy+ &nbsp;vegetable curry</p>
<p>&nbsp;</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 25.9792%;">
<p>Okra Soup + Steamed apple</p>
</td>
</tr>
</tbody>
</table>
</div>
<div class="col">&nbsp;</div>
</div>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">Less quantity salt, sugar,oil</p>
<p style="text-align: center;">Avoid milk &amp; milk products</p>
<p style="text-align: center;">After 7.30 no food allowded</p>

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
