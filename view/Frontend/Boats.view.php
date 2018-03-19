<?php
    $categories = Categories::GetAllCategories();
?>

<div class="boats">
<?php
if(sizeof($categories) > 0)
{

?>
    <h2>Bådpark</h2>
    <table class="boats-table" >
        <thead>
            <tr>
                <th>Type:</th>
                <th>Sværhedsgrad:</th>
                <th>Antal:</th>
                <th class="boats-table-image">image</th>
                <th>Til salg:</th>
            </tr>
        </thead>
        <tbody>
        <?php
        
            foreach($categories as $category)
            {
                $products = Products::GetAllProducts($category->kajakTypeId);
                if(sizeof($products) > 0) {
                    echo '<tr class="boats-category">';
                    echo '<td>'.$category->kajakTypeName.'</td>';
                    echo '</tr>';
                    foreach($products as $product) {
                        $price = isset($product->salesPrice) ? number_format($product->salesPrice,0,",",".").' DKK' : '';
                        echo '<tr class="content-row">';
                        echo '<td data-column="Type:">'.$product->kajakName.'</td>';
                        echo '<td data-column="Sværhedsgrad:">'.$category->kajakTypeLevel.'</td>';
                        echo '<td data-column="Antal:">'.$product->kajakStock.'</td>';
                        echo '<td data-column="image"><img src="'.Router::$BASE . $product->filepath .'/140x93_'.$product->filename.'.'.$product->mime.'" alt="'.$product->kajakName.'"></td>';
                        echo '<td data-column="Til Salg:">'.$price.'</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr>';
                    echo '<td class="mdl-data-table__cell--non-numeric">Der er ingen produkter til <b>'.$category->kajakTypeName.'</b></td>';
                    echo '</tr>';
                    echo '<tr></tr>';
                }
            }
            
        
        ?>
            
        </tbody>
    </table>
    <?php
    }
     else 
     {
         echo '<h2>Der er desværre ingen produkter.</h2>';
     }
    ?>
</div>