<?php

Route::group(array('before' => 'auth'), function()
{
    Route::get('dashboard', function()
    {
        return 'Dashboard routes...';
    });
});