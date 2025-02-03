<?php

function asset1($path, $secure = null)
{
    echo "str";
    return app('url')->asset("public/".$path, $secure);
}