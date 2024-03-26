<?php
include_once('header.php');
pheader("Kapha Diet");
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

    <p style="text-align: center;"><strong><u>AYURVEDIC DIET - Kapha</u></strong></p>
<p style="text-align: center;"><strong><u>General Instructions:-&nbsp;</u></strong></p>
<p style="text-align: center;">Prefer bitter, pungent and astringent food. Reduce Sweet, Salty and Sour foods .Foods should be warm light and dry. Cold, heavy, Fatty, Oily foods are not good. &nbsp;Foods should be less in quantity and less in frequency, avoid Day time sleeping.&nbsp;</p>
<p style="text-align: center;"><strong><u>Fruits:</u></strong><strong><u>&nbsp;-</u></strong>&nbsp;</p>
<p style="text-align: center;">Apples, Apricots, Berries, Cherries, Cranberries, Dried figs, Ripe mango, Peaches, Pear, Persimmon, Pomegranate, Prunes, Quince.</p>
<p style="text-align: center;"><strong><u>Vegetables:-</u></strong>&nbsp;</p>
<p style="text-align: center;">Raw pungent bitter or Astringent vegetables, Asparagus, Bean sprouts, Beets, Broccoli, Brussels sprouts, &nbsp;Cabbage, Carrots, Cauliflower, Celery, Fresh corn, Eggplant, Garlic, Green beans, Horse radish, Green leafy vegetables, Lettuce, Onions, Parsley, Peas, Peppers, White potatoes, Radish, Spinach, Sprouts of all kinds, Mushrooms.</p>
<p style="text-align: center;"><strong><u>G</u></strong><strong><u>rains: -</u></strong>&nbsp;</p>
<p style="text-align: center;">Amaranth, Barley, Buck wheat, Corn, Low fat granola, Dry oats, Oat bran, Popcorn, Quinoa, Rye, Basmati rice.</p>
<p style="text-align: center;"><strong><u>Legumes;-</u></strong>&nbsp;</p>
<p style="text-align: center;">Aduki beans, Black beans, Black eyed peas, Lima beans, Pinto beans, Red lentils, Tofu, White beans.</p>
<p style="text-align: center;"><strong><u>Nuts: -</u></strong>&nbsp; &nbsp;Well soaked almonds in small quantity occasionally</p>
<p style="text-align: center;"><strong><u>Seeds: -</u></strong>&nbsp;Flax, Pumpkin, Sunflower, Sesame etc. Occasionally</p>
<p style="text-align: center;"><strong><u>Sweeteners:</u></strong><strong><u>&nbsp;-</u></strong>&nbsp;Raw honey.</p>
<p style="text-align: center;"><strong><u>Spices:-</u></strong></p>
<p style="text-align: center;">Black pepper, Chili pepper , Garlic, All spice, Ajawan, Asafetida , Basil, Caraway, Cardamom, Cinnamon, cloves, Coriander, Cumin, Fenugreek, Ginger, Mint, Mustard seeds, Nutmeg, Pippali, Saffron, Vanilla, Turmeric, Wintergreen.</p>
<p style="text-align: center;"><strong><u>Dairy:</u></strong><strong><u>&nbsp;-</u></strong>&nbsp;Fresh goats milk, Fresh yogurt (diluted)</p>
<p style="text-align: center;"><strong><u>Oils:</u></strong><strong><u>&nbsp;</u></strong><strong><u>-</u></strong>&nbsp;Small amounts of almond, Corn, Sunflower, Olive, sesame</p>
<p style="text-align: center;"><strong><u>Beverages :-&nbsp;</u></strong></p>
<p style="text-align: center;">Apple juice, Apricot juice, Berry juice, Carrot juice, Cranberry juice, Hot spiced goat milk, pear juice, pomegranate juice, Prune juices, Low salt vegetables juices.</p>
<p style="text-align: center;"><strong><u>Avoid :-</u></strong>&nbsp;</p>
<p style="text-align: center;">Carbonated drinks, Cold dairy drinks, Coconut milk, highly salted drinks, Lemonade, Psyllium, Black walnuts, Brazil nuts, Cashews, peanuts, All dairy which is not fresh and having high fat content, Ice cream, Almond extract, Cooked oats, pickled vegetables, Sour and very sweet fruits,&nbsp;</p>
<p style="text-align: center;"><strong><u>Reduce</u></strong><u>:</u>- &nbsp;</p>
<p style="text-align: center;">Alcohol, Oranges, Tomato, Tomato juice, Apricot oil, Avocado oil, Coconut oil, Safflower oil, Tamarind, Fruit juice concentrates, Soya products, Coconut, Avocado, Water melon, Brown rice, Melons, Dates, Sweet juicy or heavy vegetables, Sweet potatoes, Grape fruit, Banana, Fresh figs, Plums, White rice.</p>

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