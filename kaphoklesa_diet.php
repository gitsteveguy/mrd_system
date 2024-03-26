<?php
include_once('header.php');
pheader("Kaphokhelsa Diet");
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

    <h2 style="text-align: center;"><strong><u>KAPHOLKLESA DIET</u></strong></h2>
<p style="text-align: center;"><strong><em><u>BREAKFAST</u></em></strong></p>
<p style="text-align: center;"><strong>Idly or Dosa.</strong></p>
<p style="text-align: center;"><strong>&nbsp;</strong></p>
<p style="text-align: center;"><strong><em><u>LUNCH</u></em></strong></p>
<p style="text-align: center;"><strong>Ellu + Uzhunu Porridge + Butter</strong></p>
<p style="text-align: center;"><strong>&nbsp;</strong></p>
<p style="text-align: center;"><strong><em><u>EVENING</u></em></strong></p>
<p style="text-align: center;"><strong>2 Uzhunnu Vada (Fresh and hot) in Ghee, &nbsp;1 Jilebi</strong></p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><strong><em><u>DINNER</u></em></strong></p>
<p style="text-align: center;"><strong>&nbsp;Uzhunnu Porridge + Butter</strong></p>
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
