<?php

News::DeleteNews(Router::$Params['ID']);

Router::Redirect('/Admin/News');