<?php
    
    if(isset($POST['productSubmit']))
    {
        if(Token::validateToken($POST['_once_default']) == true) {

                $error = [];
                $DATA['files'] = $_FILES['files']['size'] !== 0 ? $_FILES['files'] : $error['eventCover'] = '<div class="error">Du skal vælge et kajak billede.</div>';
                $DATA['productName'] = Validate::stringBetween($POST['productName'], 2, 45) ? $POST['productName'] : $error['productName'] = '<div class="error">Kajak navn må kun inholde bogstaver og tal. Samt være mellem 2 og 45 tegn.</div>';
                $DATA['productStock'] = Validate::intBetween($POST['productStock'], 1, 5) ? $POST['productStock'] : $error['productStock'] = '<div class="error">Antal må kun indeholde tal og være mellem 1 og 5 tal.</div>';
                if(!empty($POST['productPrice']))
                {
                    $DATA['productPrice'] = Validate::intBetween($POST['productPrice'], 1, 5) ? $POST['productPrice'] : $error['productPrice'] = '<div class="error">Prisen må kun indeholde tal og være mellem 1 og 5 tal.</div>';
                }
                $DATA['productType'] = Validate::intBetween($POST['productType'], 1 , 20) ? $POST['productType'] : $error['productType'] = '<div class="error">Du skal vælge en kajak type.</div>';
                if(sizeof($error) == 0) 
                {
                    $options = array(
                        'validExts' => array(
                            'jpeg',
                            'jpg',
                            'png',
                            'gif'
                        ),
                        'sizes' => array(
                            'normal' => array(
                                'height' => '140',
                                'width' => '93'
                            )
                        ),
                        'path' => 'assets/images/products',
                        'create' => true
                    );
                    $MediaId = Media::ImageHandler($DATA['files'], $options);
                    if(Products::CreateProduct($DATA, $MediaId->mediaId) == true) 
                    {
                        $status = '<a id="successTooltip" href="'.Router::$BASE.'Admin/Products" class="success">Success</a>
                                  <div class="mdl-tooltip mdl-tooltip--large" data-mdl-for="successTooltip">Klik her for at komme tilbage til produkter.</div>';

                        unset($POST);
                    } else 
                    {
                        $status = '<div class="error">Der skete desværre en fejl ved indsættelsen af dataen. Prøv igen.</div>';
                    }
                }
            } else 
            {
                $status = '<div class="error">Dataen gik desværre ikke igennem, prøv igen.</div>';
            }
    }

?>


<div class="create-news">
    <form method="post" enctype="multipart/form-data">
        <?= Token::createTokenInput() ?>
        <input type="text" name="productName" placeholder="Nyheds Titel" value="<?= @$POST['productName'] ?>">
        <?= @$error['productName'] ?>
        <input type="number" name="productStock" placeholder="Kajak antal" value="<?= @$POST['productStock'] ?>">
        <?= @$error['productStock'] ?>
        <input type="number" name="productPrice" placeholder="Kajak pris (Valgfri - Hvis til salg)" value="<?= @$POST['productPrice'] ?>">
        <?= @$error['productPrice'] ?>
        <select name="productType">
            <option value="" style="display:none" selected>Klik for at vælge en kajak type</option>
            <?php
                foreach(Categories::GetAllCategories() as $category) 
                {
                    $selected = !empty($POST['productType'] && $POST['productType'] == $category->kajakTypeId) ? 'selected' : ''; 
                    
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