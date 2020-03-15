<?php
class Redirect
{
    function act($extra)
    {
        $host = $_SERVER["HTTP_HOST"];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

        header("Location: http://{$host}{$uri}/{$extra}");
    }
}
