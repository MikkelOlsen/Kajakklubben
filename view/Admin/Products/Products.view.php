<a href="<?= Router::$BASE . 'Admin/Products/Create' ?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Opret Kajak</a>


<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Type</th>
      <th>Sværhedsgrad</th>
      <th>Antal</th>
      <th></th>
      <th>Pris</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
      <?php
        foreach(Categories::GetAllCategories() as $category)
        {
            $products = Products::GetAllProducts($category->kajakTypeId);
            if(sizeof($products) > 0) {
                echo '<tr>';
                echo '<td class="mdl-data-table__cell--non-numeric"><b>'.$category->kajakTypeName.'</b></td>';
                echo '</tr>';
                foreach($products as $product) {
                    $price = isset($product->salesPrice) ? number_format($product->salesPrice,0,",",".").' DKK' : '';
                    echo '<tr>';
                    echo '<td class="mdl-data-table__cell--non-numeric">'.$product->kajakName.'</td>';
                    echo '<td>'.$category->kajakTypeLevel.'</td>';
                    echo '<td>'.$product->kajakStock.'</td>';
                    echo '<td><img src="'.Router::$BASE . $product->filepath .'/140x93_'.$product->filename.'.'.$product->mime.'" alt="'.$product->kajakName.'"></td>';
                    echo '<td>'.$price.'</td>';
                    echo '<td><a href="'.Router::$BASE.'Admin/Products/Edit/'.$product->kajakId.'"><i class="material-icons">mode_edit</i></td>';
                    echo '<td><a href="'.Router::$BASE.'Admin/Products/Delete/'.$product->kajakId.'" class="delete"><i class="material-icons">delete</i></td>';
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