<?php

/** Begin Bootstrap */
//require the application functions file
require_once('functions.php');
//set the homepath URL variable
$homepath = get_homepath();
//kick off the bootstrap
bootstrap();
/** End Bootstrap */

//get the template file
$template = get_template();
if(is_file('../pages/'.$template)){
    include('../pages/'.$template);
}