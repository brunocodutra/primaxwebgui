<?php
/*
  This file is part of primaxwebgui, a free software.
  Use, modification and distribution is subject to the BSD 2-clause license.
  See accompanying file LICENSE.txt for its full text.
 */
    if(empty($includedFromIndex) || !$includedFromIndex) { 
        $refering = parse_url($_SERVER['HTTP_REFERER']);
        if($refering['host'] != $_SERVER['HTTP_HOST']) {
            header("HTTP/1.0 404 Not Found");
            include_once('404.php');  
            exit();
        }
    }
?>

<footer>
    <div class="container">
        <hr>
        <div class="pull-right">
            &copy; brunocodutra 2013
        </div>
    </div>
</footer>
