<?php
include_once('header.php');
pheader("Pitha Vatha");
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
    <h2 style="text-align: center;"><strong><u>Pitha Vatha Diet</u></strong><strong>&nbsp;</strong></h2>
<p style="text-align: center;"><strong><u>General Instructions</u></strong></p>
<p style="text-align: center;">Sweet taste is preferable. Don&rsquo;t eat when angry or mentally upset. Foods served should be of moderate temperature</p>
<p style="text-align: center;"><strong><u>Fruits</u></strong><strong><u>:</u></strong><u>-&nbsp;</u></p>
<p style="text-align: center;">Sweet fruits, Sweet apricots, Cooked apples, Sweet avocado, Coconut, Dates, Berries, Grapes, Sweet mangoes, Sweet pineapple, Sweet oranges, Prunes.</p>
<p style="text-align: center;"><strong><u>Vegetables</u></strong><u>:-&nbsp;</u></p>
<p style="text-align: center;">Asparagus, Cooked onions, Artichoke, Bean sprouts, , Cucumber, Green beans, cooked okra, Sweet potato, Pumpkin</p>
<p style="text-align: center;"><strong><u>Grains</u></strong><u>: -</u>&nbsp;Cooked oats, cooked rice, Wheat, Barley, Brown rice</p>
<p style="text-align: center;"><strong><u>Legumes</u></strong><u>: -</u>&nbsp;Adzuki beans, Black beans, Mung beans, Soya beans, Tofu, Soaked and</p>
<p style="text-align: center;">Well cooked legumes.</p>
<p style="text-align: center;"><strong><u>Nuts</u></strong><strong><u>: -</u></strong>&nbsp;Almonds, Coconut, Cashew nut</p>
<p style="text-align: center;"><strong><u>Seeds</u></strong><u>: -</u>&nbsp;Pumpkin, seeds, Sunflower seeds&nbsp;</p>
<p style="text-align: center;"><strong><u>Sweetners</u></strong><u>:-&nbsp;</u></p>
<p style="text-align: center;">Barley malt syrup, Brown rice syrup, Maple syrup, Fructose, Sugar cane juice.&nbsp;</p>
<p style="text-align: center;"><strong><u>Spices</u></strong><u>:-&nbsp;</u></p>
<p style="text-align: center;">Black pepper, Cardamom, Coriander, Vanilla, Mint, winter, Green, Saffron, Turmeric, Garlic (less quantity), Fresh ginger</p>
<p style="text-align: center;"><strong><u>Dairy</u></strong><u>: -</u>&nbsp;Unsalted butter, Fresh milk, Ghee, Fresh yogurt diluted with water.</p>
<p style="text-align: center;"><strong><u>Oils</u></strong><u>: -</u>Coconut oil, Soya oil, Olive oil, Sesame oil, Safflower oil</p>
<p style="text-align: center;"><strong><u>Beverages</u></strong><u>:-&nbsp;</u></p>
<p style="text-align: center;">Apricot juice, Asparagus juice, Aloe Vera juice, Mango juice, Coconut milk, Grape juice, Sweet orange juice, Sweet fruit juices, Vatha tea, Pitha tea.</p>
<p style="text-align: center;"><strong><u>Avoid</u></strong><u>:-&nbsp;</u></p>
<p style="text-align: center;">Alcohol, Coffee, Colas, Carbonated drinks, Recycled oils, Any oil which is not fresh, Corn oil, Salted butter, Hard cheese, Ice creams, Undiluted Yogurt</p>
<p style="text-align: center;">Any dairy which is not fresh, Raw onion, Peanuts, Dry frozen legumes, Cold dry cereals, Corn, Millet, Dry oats, Popcorn, , D ried and Frozen vegetables, Pickled Vegetables, Raw onions, Frozen fruits, White sugar, Saccharine.</p>
<p style="text-align: center;"><strong><u>Reduce</u></strong><strong><u>:-</u></strong><u>&nbsp;</u></p>
<p style="text-align: center;">Tomato juice, Chilly, Nutmeg, Asafetida, Dry ginger, honey, Chia seeds, flax seeds, Kidney beans, Lima beans, Red lentils, Egg plant, Tomatoes, Turnips, Beets, &nbsp;Raw water melon, Sesame seeds, Papaya, Papaya juice.</p>
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

