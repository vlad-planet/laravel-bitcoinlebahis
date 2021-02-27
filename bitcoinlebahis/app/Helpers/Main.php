<?php

function makeUrl($type, $code = false)
{
    $url =  "/content/$type";    
    if($code !== false)
        $url.="/$code";
    
    return $url;
        
}