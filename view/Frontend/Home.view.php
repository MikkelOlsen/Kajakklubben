<a id="baseURL" style="display:hidden;" href="<?= Router::$BASE ?>"></a>
<div class="home">
    <div class="home-info">
        <h2>Om Klubben</h2>
        <p>
        Velkommen til Kajakklubben Pagaj
        </p>
        <p>
        Klubben blev stiftet i slutningen af 2015 og har lige siden oplevet en stor fremgang i medlemstallet. Vi lægger vægt på, at være en kajakklub for alle. Vi ønsker at skabe en god motionskultur og et godt fællesskab i klubben gennem hyggelige fællesture og sociale arrangementer.
        </p>
        <p>
        KKP ligger i Århus Havn. Går du fra Banegården, tager det cirka 10 minutter til fods at komme til kajakklubben.
        Århus Havn tilbyder perfekt rovand til begynderinstruktion og almindelige ture eller træning. Der er ingen store bølger i kanalen, hvilket gør det meget begyndervenligt.
        </p>
        <p>
        Vi glæder os til at se dig på vandet!
        </p>
    </div>
    <div class="home-aside">
        <form method="post" action="<?= Router::$BASE ?>Soeg">
            <input type="search" class="search" name="search" placeholder="Søg på sitet"> 
        </form>
        <div class="home-news">
            <img src="./assets/images/news.jpg" alt="">
            <div class="home-news-text">
                <h2>Nyheder</h2>
                <?php $NEWS = News::GetAllNewsByDate();
                if(sizeof($NEWS) > 0)
                {
                    for($i=0;$i<2;$i++)
                    {
                        echo '<p>'.strftime('%d/%m', strtotime($NEWS[$i]->newsStartDate)).' - '.preg_replace('/\s+?(\S+)?$/', ' ...', substr($NEWS[$i]->newsTitle, 0, 20)).'</p>';
                    }
                }
                else
                {
                    echo '<p>Der er desværre ingen nyheder.</p>';
                }
                ?>
                <a href="<?= Router::$BASE . 'Nyheder' ?>">Nyheder >></a>
            </div>
        </div>
        <form id="newsletter" method="post">
            <input id="newsletterEmail" type="text" name="newsLetter" placeholder="Tilmeld dig til nyhedsbrevet">
        </form>
        <div class="home-news">
            <img src="./assets/images/img01.jpg" alt="">
            <div class="home-news-text">
                <h2>2016</h2>
                <p>Juli</p>
                <?php $EVENT = Events::GetAllEventsByDate();
                if(sizeof($EVENT) > 0)
                {
                    for($i=0;$i<2;$i++)
                    {
                        echo '<p>'.strftime('%m.', strtotime($EVENT[$i]->eventStartDate)).' '.preg_replace('/\s+?(\S+)?$/', ' ...', substr($EVENT[$i]->eventTitle, 0, 20)).'</p>';
                    }
                }
                else 
                {
                    echo '<p>Der er desværre ingen arrangementer.</p>';
                }
                ?>
                <a href="<?= Router::$BASE . 'Arrangementer' ?>">Arrangementer >></a>
            </div>
        </div>
    </div>
    <div class="home-products">
    <?php
        $sales = Products::GetAllSales();
        if(sizeof($sales) > 0)
        {
        echo '<h2>Brugte kajakker</h2>';
        echo '<div class="home-products-box">';

        
            foreach($sales as $sale)
            {
                echo '<div class="product">';
                echo '<img src="'.Router::$BASE. $sale->filepath . '/140x93_'.$sale->filename.'.'.$sale->mime.'" alt="'.$sale->kajakName.'">';
                echo '<a href="'.Router::$BASE.'Baadpark" >'.$sale->kajakName.' <br> '.number_format($sale->salesPrice,0,",",".").' DKK</a>';
                echo '</div>';
            }
        echo '</div>';
        }
        else 
        {
            echo '<h2>Vi har desværre ingen brugte kajakker.</h2>';
        }
        ?>
            
        
    </div>
</div>
