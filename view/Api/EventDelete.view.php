<?php

if(Router::GetParamByName('ID') !== NULL && Router::GetParamByName('USER') !== NULL)
{
    if(Users::OutEvent(Router::GetParamByName('ID'), Router::GetParamByName('USER')) == true)
    {
        echo json_encode(['err' => false, 'msg' => 'success']);
    }
    else 
    {
        echo json_encode(['err' => true, 'msg' => 'ID Err']);
    }
}
else 
{
    echo json_encode(['err' => true, 'msg' => 'Der skete en fejl, genindlæs siden og prøv igen.']);
}

