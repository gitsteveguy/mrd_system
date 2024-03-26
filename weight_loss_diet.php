<?php
include_once('header.php');
pheader("Weight Loss Diet");
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
    <h2 style="text-align: center;">WEIGHT LOSS DIET CHART</h2>
<table style="border-collapse: collapse; border-color: rgb(0, 0, 0); width: 100%; height: 595.179px; margin-left: auto; margin-right: auto;" border="1">
<tbody>
<tr style="height: 54.3984px;">
<td style="border-color: rgb(0, 0, 0); width: 23.6762%; height: 54.3984px;">
<p>BREAKFAST</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 43.9957%; height: 54.3984px;">
<p style="text-align: center;">&nbsp;LUNCH</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 27.618%; height: 54.3984px;">
<p>DINNER</p>
</td>
</tr>
<tr style="height: 92.7969px;">
<td style="border-color: rgb(0, 0, 0); width: 23.6762%; height: 92.7969px; text-align: center;">
<p>Idiyappam+ Veg kuruma</p>
<p>Without potato</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 43.9957%; height: 92.7969px; text-align: center;">
<p>Chappathi +Pumpkin curry&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 27.618%; height: 92.7969px; text-align: center;">
<p>Mixed Veg Soup + Steamed veggies</p>
</td>
</tr>
<tr style="height: 92.7969px;">
<td style="border-color: rgb(0, 0, 0); width: 23.6762%; height: 92.7969px; text-align: center;">
<p>Wheat puttu+ steamed banana</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 43.9957%; height: 92.7969px; text-align: center;">
<p>Rice porridge + Steamed veggies without potato</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 27.618%; height: 92.7969px; text-align: center;">
<p>Pumpkin soup&nbsp;</p>
<p>+Steamed veggies</p>
</td>
</tr>
<tr style="height: 76.7969px;">
<td style="border-color: rgb(0, 0, 0); width: 23.6762%; height: 76.7969px; text-align: center;">
<p>Appam + Ulli chutney</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 43.9957%; height: 76.7969px; text-align: center;">
<p>Lemon rice +vegetable salad with carrot, onion,cucumber</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 27.618%; height: 76.7969px; text-align: center;">
<p>Carrot Soup+Steamed veggies</p>
</td>
</tr>
<tr style="height: 115.195px;">
<td style="border-color: rgb(0, 0, 0); width: 23.6762%; height: 115.195px; text-align: center;">
<p>Uppuma+ Pazham</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 43.9957%; height: 115.195px; text-align: center;">
<p>1 cup Rice+ Unripe banana upperi +Rasam without tomato</p>
<p>&nbsp;</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 27.618%; height: 115.195px; text-align: center;">
<p>Cucumber Soup+ Steamed apple</p>
</td>
</tr>
<tr style="height: 54.3984px;">
<td style="border-color: rgb(0, 0, 0); width: 23.6762%; height: 54.3984px; text-align: center;">
<p>Oats porridge</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 43.9957%; height: 54.3984px; text-align: center;">
<p>Chappathi+ Green gram curry</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 27.618%; height: 54.3984px; text-align: center;">
<p>Steamed veggies+ Pumpkin soup&nbsp;</p>
</td>
</tr>
<tr style="height: 54.3984px;">
<td style="border-color: rgb(0, 0, 0); width: 23.6762%; height: 54.3984px; text-align: center;">
<p>Wheat &nbsp;bread + honey</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 43.9957%; height: 54.3984px; text-align: center;">
<p>1cup rice + Palak+ Bittergourd thoran</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 27.618%; height: 54.3984px; text-align: center;">
<p>Steamed banana+ Beetroot soup</p>
</td>
</tr>
<tr style="height: 54.3984px;">
<td style="border-color: rgb(0, 0, 0); width: 23.6762%; height: 54.3984px; text-align: center;">
<p>Banana stuffed carrot puttu</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 43.9957%; height: 54.3984px; text-align: center;">
<p>Broken wheat porridge + Ulli chutney</p>
</td>
<td style="border-color: rgb(0, 0, 0); width: 27.618%; height: 54.3984px; text-align: center;">
<p>Okra Soup + Steamed apple</p>
</td>
</tr>
</tbody>
</table>
<p style="text-align: center;"><strong>&nbsp;&nbsp;</strong></p>
<p style="text-align: center;"><em>No Coffee,Tea, Milk&amp; Milk products, Dry fruits, Non veg items.</em></p>
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


