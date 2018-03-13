<?php

    
    require_once './init.php';

    Router::init($_SERVER['REQUEST_URI'], ROUTES);
    var_dump(Router::$Params);
    var_dump(Router::$View);
?>
<hr>
<?php
    
?>