<?php
    $currentProduct = Products::CurrentProduct(Router::GetParamByName('ID'));
    if(isset($POST['productSubmit']))
    {       
        echo 'sub';

                $error = [];
                $DATA['productName'] = Validate::stringBetween($POST['productName'], 2, 45) ? $POST['productName'] : $error['productName'] = '<div class="error">Kajak navn må kun inholde bogstaver og tal. Samt være mellem 2 og 45 tegn.</div>';
                $DATA['productStock'] = Validate::intBetween($POST['productStock'], 1, 5) ? $POST['productStock'] : $error['productStock'] = '<div class="error">Antal må kun indeholde tal og være mellem 1 og 5 tal.</div>';
                if(!empty($POST['productPrice']))
                {
                    $DATA['productPrice'] = Validate::intBetween($POST['productPrice'], 1, 5) ? $POST['productPrice'] : $error['productPrice'] = '<div class="error">Prisen må kun indeholde tal og være mellem 1 og 5 tal.</div>';
                }
                $DATA['productType'] = Validate::intBetween($POST['productType'], 1 , 20) ? $POST['productType'] : $error['productType'] = '<div class="error">Du skal vælge en kajak type.</div>';
                var_dump($error);
                if(sizeof($error) == 0) 
                {
                    echo 'no err';
                    $options = array(
                        'validExts' => array(
                            'jpeg',
                            'jpg',
                            'png',
                            'gif'
                        ),
                        'sizes' => array(
                            'normal' => array(
                                'height' => '93',
                                'width' => '140'
                            )
                        ),
                        'path' => 'assets/images/products',
                        'mediaId' => $currentProduct->fkKajakMedia
                    );
                    if($_FILES['files']['size'] !== 0)
                    {
                        $MediaId = Media::UpdateImg($DATA['files'], $options);
                    }
                    if(Products::UpdateProduct($DATA, Router::GetParamByName('ID')) == true) 
                    {
                        $status = '<a id="successTooltip" href="'.Router::$BASE.'Admin/Products" class="success">Success</a>
                                  <div class="mdl-tooltip mdl-tooltip--large" data-mdl-for="successTooltip">Klik her for at komme tilbage til produkter.</div>';

                                  $currentProduct = Products::CurrentProduct(Router::GetParamByName('ID'));
                    } else 
                    {
                        $status = '<div class="error">Der skete desværre en fejl ved indsættelsen af dataen. Prøv igen.</div>';
                    }
                }

    }

?>
<div class="gallery-edit">

<div class="create-news">
    <form method="post" enctype="multipart/form-data">
        <?= Token::createTokenInput() ?>
        <input type="text" name="productName" placeholder="Nyheds Titel" value="<?= $currentProduct->kajakName ?>">
        <?= @$error['productName'] ?>
        <input type="number" name="productStock" placeholder="Kajak antal" value="<?= $currentProduct->kajakStock ?>">
        <?= @$error['productStock'] ?>
        <input type="number" name="productPrice" placeholder="Kajak pris (Valgfri - Hvis til salg)" value="<?= $currentProduct->salesPrice ?>">
        <?= @$error['productPrice'] ?>
        <select name="productType">
            <?php
                foreach(Categories::GetAllCategories() as $category) 
                {
                    $selected = ($category->kajakTypeId == $currentProduct->kajakTypeId) ? 'selected' : ''; 
                    
                    $level = $category->kajakTypeLevel !== NULL ? '( Sværhedsgrad - '. $category->kajakTypeLevel . ')' : '';
                    echo '<option '.$selected.' value="'.$category->kajakTypeId.'">'.$category->kajakTypeName.' '.$level.'</option>';
                }
            ?>
        </select>
        <?= @$error['productType'] ?>
        <input type="file" name="files" id="file" class="inputfile" />
        <label for="file" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"><span>Klik for at vælge kajakkens billede.</span></label>
        <?= @$error['productMedia'] ?>
        <input name="productSubmit" type="submit" value="Opret Arrangement">
        <?= @$status ?>
    </form>

</div>

<div class="current-img">
    <h3>Nuværende Billede</h3>
    <img src="<?= Router::$BASE . $currentProduct->filepath . '/140x93_' . $currentProduct->filename . '.' . $currentProduct->mime ?>" alt="<?= $currentProduct->kajakName ?>">
</div>
            </div>