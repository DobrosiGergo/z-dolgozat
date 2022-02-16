<?php

function isAuth()
{
    $status = false;

    $status = App\Controllers\SessionController::isAuth();

    return  $status;
}
