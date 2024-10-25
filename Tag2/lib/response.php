<?php
namespace lib;
abstract class response
{
    public static function error($code)
    {
        include "error/$code.php";
    }
}