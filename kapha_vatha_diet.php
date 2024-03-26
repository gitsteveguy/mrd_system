<?php
include_once('header.php');
pheader("Kapha Vatha Diet");
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

    <h2 style="text-align: center;"><strong><u>AYURVEDIC DIET- KAPHA VATHA</u></strong></h2>
<p style="text-align: center;"><strong><u>General Instructions</u></strong></p>
<p style="text-align: center;">Foods should be warm and fresh.</p>
<p style="text-align: center;"><strong><u>Fruits:-</u></strong></p>
<p style="text-align: center;">Apricots, Berries, Cherries, Peaches, Grapes, Figs, Mango, Prunes, Cooked apples, Gooseberry, Pomegranates</p>
<p style="text-align: center;"><strong><u>Vegetables</u></strong><u>:</u><u>&nbsp;-</u>&nbsp;Use all these vegetables after boiling</p>
<p style="text-align: center;">Asparagus, Green beans, Radish, Garlic, Pepper, Snake guard, Ash guard, Cucumber, Beets, Bean sprouts, Mung sprouts, Alfalfa sprouts, Carrots, Cooked onions, Tomatoes (small quantity), green leafy vegetables like spinach</p>
<p style="text-align: center;"><strong><u>Grains</u></strong><u>: -</u>&nbsp;Amaranth, Oats, Wheat, Rice, Quinoa</p>
<p style="text-align: center;"><strong><u>Legumes</u></strong><u>: -</u>&nbsp;Aduki beans, Mung beans, Tofu, Black beans, Lima beans,</p>
<p style="text-align: center;"><strong><u>Nuts</u></strong><u>: -</u>&nbsp;Moderate quantity of almonds, Cashews, Coconut, Pine nut</p>
<p style="text-align: center;"><strong><u>Seeds</u></strong><u>: -</u>&nbsp;Flax, Pumpkin, Sunflower seeds</p>
<p style="text-align: center;"><strong><u>Sweetners</u></strong><u>: -</u>&nbsp; &nbsp; Raw, Honey, Fruit juice concentrates, Jaggery, Barley malt syrup, Fructose</p>
<p style="text-align: center;"><strong><u>Spices</u></strong><u>:-</u>&nbsp;&nbsp;Black pepper, Coriander, Garlic, Allspice, Caraway, Cardamom, Cloves, Cumin, Fenugreek, Fresh ginger, Turmeric, Wintergreen, Vanilla, Saffron, Cinnamon, Asafetida, Mint</p>
<p style="text-align: center;"><strong><u>Dairy: -</u></strong>&nbsp;Goats milk, All dairy products in small quantity</p>
<p style="text-align: center;"><strong><u>Oils</u></strong><u>: -</u>&nbsp;Coconut oil, Sunflower oil, sesame oil, &nbsp; and almond oil (Small &nbsp;amounts) &nbsp; &nbsp;&nbsp;</p>
<p style="text-align: center;"><strong><u>Beverages</u></strong><u>&nbsp;:-</u>&nbsp;Apricot juice, Gooseberry juice, Asparagus juice, Carrot juice, Warm water, Ginger water, Cardamom water.</p>
<p style="text-align: center;"><strong><u>Avoid</u></strong><u>:-&nbsp;</u></p>
<p style="text-align: center;">Alcohol, Colas, Carbonated drinks, Cool drinks, All dairy products which are not fresh, Ice cream, Hard cheese, Milk powder, White sugar, Brown rice syrup, Molasses, Psyllium seeds, Cold cereals, Popcorn, Buck wheat, Millet, Frozen Vegetables, Pickled vegetables, Cold frozen fruits.</p>
<p style="text-align: center;"><strong><u>&nbsp;</u></strong></p>
<p style="text-align: center;"><strong><u>Reduce:-</u></strong><u>&nbsp;</u>Tomato juice, Avocado, Safflower oil, Tamarind, dry ginger, Almond extract, Kidney beans, Red<strong>&nbsp;</strong>lentils, Soya beans<strong>,</strong>&nbsp;Avocado<strong>,</strong> Water melon, Uncooked apples, Cabbage, Cauliflower, Peanuts, Black walnuts.&nbsp;</p>
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


