<?php

if(Router::GetParamByName('ID') !== NULL)
{
    if(News::DeleteNews(Router::GetParamByName('ID')) == true)
    {
        Router::Redirect('/Admin/News');
    }
} else 
{
    Router::Redirect('/Admin/News');
}




