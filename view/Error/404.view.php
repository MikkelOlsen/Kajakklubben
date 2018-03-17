<?php
  if(isset(Router::$Params['PAGE']))
  {
    echo '<h3>Siden "'.Router::GetParamByName('PAGE').'" eksistere desværre ikke. :(</h3>';
  } else 
  {
    echo '<h3>Siden du ledte efter eksistere desværre ikke. :(</h3>';
  }
?>