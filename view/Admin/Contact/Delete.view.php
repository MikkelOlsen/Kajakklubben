<?php

if(Router::GetParamByName('ID') !== NULL)
{
    if(Contact::DeleteMsg(Router::GetParamByName('ID')) == true)
    {
        Router::Redirect('/Admin/Contact');
    }
} else 
{
    Router::Redirect('/Admin/Contact');
}