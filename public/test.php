<?php

echo($_COOKIE['abc'] ?? 'NONE');

setcookie('abc', 'test2-' . $_SERVER['HTTP_HOST'], time() + 86400, '/', '.' . $_SERVER['HTTP_HOST'], false, true);

die;

/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 01.06.18
 * Time: 15:58
 */

echo phpinfo();