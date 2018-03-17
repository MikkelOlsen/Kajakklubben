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
                <p>07/04 Nye kajakker til salg</p>
                <p>15/02 Pagaj-medlemmer vinder...</p>
                <a href="<?= Router::$BASE . 'Nyheder' ?>">Nyheder >></a>
            </div>
        </div>
        <form id="newsletter" method="post">
            <input id="newsletterEmail" type="text" name="newsLetter" placeholder="Tilmeld dig til nyhedsbrevet">
        </form>
        <div class="home-news">
            <img src="./assets/images/news.jpg" alt="">
            <div class="home-news-text">
                <h2>Nyheder</h2>
                <p>07/04 Nye kajakker til salg</p>
                <p>15/02 Pagaj-medlemmer vinder...</p>
                <a href="<?= Router::$BASE . 'Nyheder' ?>">Nyheder >></a>
            </div>
        </div>
    </div>
    <div class="home-products">
        <h2>Brugte kajakker</h2>
        <div class="home-products-box">
            <div class="product">
                <img src="./assets/images/kajak01.jpg" alt="">
                <a href="" >Blå Kajak <br> 799 DKK</a>
            </div>
            <div class="product">
                <img src="./assets/images/kajak02.jpg" alt="">
                <a href="" >Blå Kajak <br> 799 DKK</a>
            </div>
            <div class="product">
                <img src="./assets/images/kajak03.jpg" alt="">
                <a href="" >Blå Kajak <br> 799 DKK</a>
            </div>
        </div>
    </div>
</div>
