<?php

if(Router::GetParamByName('EMAIL') !== NULL)
{
    if(Validate::email(Router::GetParamByName('EMAIL')) == true) 
    {
        
            if(News::CreateNewsletter(Router::GetParamByName('EMAIL')) == true)
            {
                echo json_encode(['err' => false]);
            }
            else 
            {
                echo json_encode(['err' => true, 'msg' => 'Denne email er allerede tilmeldt.']);
            }
    } 
    else 
    {
        echo json_encode([
            'err' => true, 
            'msg' => 'Dette er ikke en gyldig email.'
            ]);
    }
}
else 
{
    echo json_encode(['err' => true, 'msg' => 'Der skete en fejl, genindlæs siden og prøv igen.']);
}

