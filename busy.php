<?php
/*
  This file is part of primaxwebgui, a free software.
  Use, modification and distribution is subject to the BSD 2-clause license.
  See accompanying file LICENSE.txt for its full text.
 */
    session_start();
    
    $refering = parse_url($_SERVER['HTTP_REFERER']);
    if($refering['host'] != $_SERVER['HTTP_HOST']) {
        header("HTTP/1.0 404 Not Found");
        include_once('404.php');  
        exit();
    }
    
    if(!file_exists('tmp/.lock') || file_get_contents('tmp/.lock') === session_id()) {
        header("Location: index.php"); 
        exit();
    }
    
    include_once('303.php');
?>