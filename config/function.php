<?php 

function  getURL($url)
{
    $link = explode('/', $url);
    
    $current = end($link);
    $result = explode('.', $current);

    return $result[0];
}

?>