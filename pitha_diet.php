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
    <p style="text-align: center;"><strong><u>PITHA&nbsp; DIET</u></strong></p>
<h2 style="text-align: center;"><strong><u>General Instructions</u></strong></h2>
<p style="text-align: center;">Bitter and Astringent tastes are generally good. &nbsp;Vegetarian foods are more preferable. Foods should not be too oily. Sour, Pungent, Salty foods are generally not good. &nbsp;Eating late at night should be avoided. Avoid fried and overly cooked food.&nbsp;</p>
<p style="text-align: center;"><strong><u>Fruits :-</u></strong>&nbsp;&nbsp;</p>
<p style="text-align: center;">Sweet fruits, Apples, Berries, coconut, Dates, Dried fruits, Soaked figs, Grapes, Sweet mango, Ripe melons, Oranges, Sweet pear, Pineapple, Sweet plums, Sweet pomegranate, Water melon,</p>
<p style="text-align: center;"><strong><u>Vegetables:-</u></strong>&nbsp;&nbsp;</p>
<p style="text-align: center;">Sweet, Bitter or Astringent vegetables, Asparagus, Bean sprouts , Broccoli, Brussels sprouts, Cabbage, Cauliflower, Chicory, Fresh corn, Cucumber, Green beans, Leafy greens, Lettuce, Okra, peas, Sweet potatoes, Sprouts of all kinds.</p>
<p style="text-align: center;"><strong><u>Grains:</u></strong><u>-</u>&nbsp;</p>
<p style="text-align: center;">Barley, Oats, Cooked rice, Basmati rice, Rice cakes, White rice, Wheat, Wheat granola.</p>
<p style="text-align: center;"><strong><u>Legumes</u></strong><u>:-</u>&nbsp;</p>
<p style="text-align: center;">Black beans, Kidney beans, Common lentils, Mung beans, Soya beans, Soya products, Tofu, White beans.</p>
<p style="text-align: center;"><strong><u>Nuts</u></strong><u>: -</u>&nbsp;Almonds, Coconut</p>
<p style="text-align: center;"><strong><u>Seeds</u></strong><u>: -</u>&nbsp;Pumpkin, Sunflower.</p>
<p style="text-align: center;"><strong><u>Spices:-</u></strong>&nbsp;</p>
<p style="text-align: center;">Black pepper, Cardamom, Coriander, Cumin, Fennel, Mint, Saffron, Turmeric, Vanilla, Winter green.</p>
<p style="text-align: center;"><strong><u>Dairy</u></strong><u>:-</u>&nbsp;</p>
<p style="text-align: center;">Unsalted butter, Fresh cottage cheese, Fresh paneer, Fresh soft cheese ghee, Fresh cows milk, Fresh goat milk, Fresh yogurt with water.</p>
<p style="text-align: center;"><strong><em>Avoid</em></strong><em>:-</em>&nbsp;</p>
<p style="text-align: center;">Salted butter, Any dairy which is not fresh, Buttermilk, Hard cheese, ice cream , Sour cream, Undiluted Yogurt.</p>
<p style="text-align: center;"><strong><u>Oils&nbsp;</u></strong><u>:-</u>&nbsp;In moderate quantity( Coconut, Safflower, Soya oil).</p>
<p style="text-align: center;"><strong><u>Beverages</u></strong><u>&nbsp;:-</u>&nbsp;</p>
<p style="text-align: center;">Apple juice, Apricot juice, Sweet berry juice, Aloe Vera juice, Asparagus juice, Sweet cherry juice, Coconut milk, Cool fresh dairy, Goat milk, Grape juice, Mango juice, Pear juice.&nbsp;</p>
<p style="text-align: center;"><strong><u>Avoid&nbsp;</u></strong>:-&nbsp;</p>
<p style="text-align: center;">Alcohol, Cherries, Frozen fruits, Unripe grapes, Sour oranges, Salted drinks, Tamarind, Peanuts, Sour fruits, Unripe apples, Sour apricots, Sour berries, Unripe, Sour pineapple.</p>
<p style="text-align: center;"><strong><u>&nbsp;</u></strong></p>
<p style="text-align: center;"><strong><u>&nbsp;</u></strong></p>
<p style="text-align: center;"><strong><u>Reduce</u></strong>:-&nbsp;</p>
<p style="text-align: center;">Banana drinks, Egg, Chicken, Carrot juice, Tomato juices. Cloves, Fenugreek, Mustard seeds, Nutmeg, Raw honey, Jaggery, Molasses, White sugar, Black walnuts, Cashews, Pine nuts, Black lentils, Red lentils. Amaranth, Buck wheat, Corn, Millet, Dry oats, Oat bran, Oat granola, Popcorn, Brown rice, Rye, Tomatoes. Pickled vegetables, Beets, Eggplant, Garlic, Radish,Black tea, Coffee,&nbsp;</p>
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

