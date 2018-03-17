<?php

if(Router::GetParamByName('ID') !== NULL)
{
    if(sizeof(Categories::DeleteCheck(Router::GetParamByName('ID'))) == 0)
    {
        if(Categories::DeleteCategory(Router::GetParamByName('ID')) == true)
        {
            Router::Redirect('/Admin/Categories');
        }
    }
    else 
    {
        echo '<div class="error">Du kan ikke slette en kajak type, hvor der er tilknyttede kajakker.</div>';
        echo '<a href="'. Router::$BASE . 'Admin/Categories" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Klik her for at komme tilbage</a>';
    }
} 
else 
{
    Router::Redirect('/Admin/Categories');
}




