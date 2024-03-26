<?php
include_once('header.php');
pheader("Vatha Diet");
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
    <h2 style="text-align: center;"><strong><u>Vatha Diet</u></strong></h2>
<p style="text-align: center;"><strong><u>General Instructions</u></strong></p>
<p style="text-align: center;">Food should be warm and well cooked. Meals should be less in quantity and frequent but regular. Sweet, Sour and Salty foods are preferable. Bitter, Astringent and Pungent tastes are not preferable</p>
<p style="text-align: center;"><strong><u>Fruits</u></strong>:-&nbsp;</p>
<p style="text-align: center;">Sweet fruits, Apricots, Avocado, Banana, Berries, Cherries, Coconut, Dates, Fresh figs, Grape fruit, Grapes, Kiwi, Lemons, Mango, Papaya, Sweet oranges, Peaches, Pineapple, Plums, Cooked apples, Prunes, Pomegranates,.</p>
<p style="text-align: center;"><strong><u>Vegetables</u></strong>&nbsp;:-&nbsp;</p>
<p style="text-align: center;">Cooked Vegetables, Asparagus, Bean sprouts, Carrots, Cucumber, Fennel, Cooked onions, Green beans &nbsp;Moong sprouts, Cooked okra, Olives, Sweet potato, Radish, Tomato(small amounts).</p>
<p style="text-align: center;"><strong><u>Grains</u></strong>:-&nbsp;</p>
<p style="text-align: center;">cooked oats, Rice, Wheat.</p>
<p style="text-align: center;"><strong><u>Legumes</u></strong>&nbsp;:-</p>
<p style="text-align: center;">Soaked and well cooked legumes in moderation, Black lentils, Moong beans, Red lentils, &nbsp;Tofu, Soya beans (small amounts)</p>
<p style="text-align: center;"><strong><u>Nuts</u></strong><u>:</u>-&nbsp;</p>
<p style="text-align: center;">In moderation- Almonds, Black walnuts, Brazil nuts, Cashews,&nbsp;</p>
<p style="text-align: center;"><strong><u>Seeds</u></strong><strong><u>&nbsp;</u></strong>:-&nbsp;</p>
<p style="text-align: center;">Flax, Pumpkin, Sesame, Sunflower</p>
<p style="text-align: center;"><strong><u>Sweeteners</u></strong><strong><u>&nbsp;</u></strong>:-&nbsp;</p>
<p style="text-align: center;">Barley malt syrup, Brown rice syrup, Fructose Fruit juice concentrates, Raw honey, Jaggery, Maple syrup, Molasses, Sugar cane juice.</p>
<p style="text-align: center;"><strong><u>Spices</u></strong><strong><u>&nbsp;</u></strong>:-&nbsp;</p>
<p style="text-align: center;">Black pepper, Coriander, Garlic, Fresh ginger, Mint, Basil, Fennel, All spice, Cardamom, Cloves, Cinnamon, cumin, Fenugreek, Mustard, Saffron, Tamarind, Vanilla, Turmeric, Wintergreen</p>
<p style="text-align: center;"><strong><u>Oils</u></strong><u>: -</u>&nbsp;Sesame oil, All fresh oils</p>
<p style="text-align: center;"><strong><u>Beverages</u></strong><u>:</u>-&nbsp;</p>
<p style="text-align: center;">Apricot juice, Aloe Vera juice, Carrot juice, Cardamom water, Ginger water, coconut milk, Grape juice, Mango juice, Orange juice, Papaya juice, Pineapple juice, Hot milk, Soya milk , Warm water, Asparagus juice, Goose berry juice.</p>
<p style="text-align: center;"><strong><u>Avoid</u></strong>:-&nbsp;</p>
<p style="text-align: center;">Alcohol, Colas, Cold dairy drinks, Carbonated drinks, Hard cheese, Ice cream, Sour cream, Milk powder, and frozen vegetables, Frozen fruits.</p>
<p style="text-align: center;"><strong><u>Reduce</u></strong><strong>:-&nbsp;</strong></p>
<p style="text-align: center;">Apple juice, coffee, Banana shake, Raw onion, Dry ginger, White sugar, Buck wheat, Corn, Granola, Millet, Popcorn, Wheat bran in excess, Brussels sprouts, Celery, Lettuce, Mushrooms, Raw onions, &nbsp;Spinach, Turnips, Pears, uncooked apples,</p>
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

