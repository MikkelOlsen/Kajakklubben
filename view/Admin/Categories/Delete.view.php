<?php

if(Router::GetParamByName('ID') !== NULL)
{
    if(Categories::DeleteCategory(Router::GetParamByName('ID')) == true)
    {
        Router::Redirect('/Admin/Categories');
    }
} else 
{
    Router::Redirect('/Admin/Categories');
}




