<?php
if(Permission::LevelCheck(90) == false)
{
    Router::Redirect('/Admin');
}
if(Router::GetParamByName('ID') !== NULL)
{
    if(Newsletter::DeleteNewsletter(Router::GetParamByName('ID')) == true)
    {
        Router::Redirect('/Admin/Newsletter');
    }
} else 
{
    Router::Redirect('/Admin/Newsletter');
}




