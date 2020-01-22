<?php 

function  getURL($url)
{
    $link = explode('/', $url);
    
    $current = end($link);
    $result = explode('.', $current);

    return $result[0];
}

function base_url($atRoot=TRUE, $parse=FALSE, $prefix=''){

    if ($atRoot) {
        
        $base_url = 'http://localhost'.getRootFolder($_SERVER['REQUEST_URI']);

    }
    else $base_url = 'http://localhost/'.$prefix;

    if ($parse) {
        $base_url = parse_url($base_url);
        if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
    }

    return $base_url;
}

function getRootFolder($url)
{
    $link = explode('/', $url);

    return '/'.$link[1].'/'.$link[2].'/';
}

?>