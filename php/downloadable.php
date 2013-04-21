<?php
/*
  This file is part of primaxwebgui, a free software.
  Use, modification and distribution is subject to the BSD 2-clause license.
  See accompanying file LICENSE.txt for its full text.
 */
    $refering=parse_url($_SERVER['HTTP_REFERER']);
    if($refering['host'] != $_SERVER['HTTP_HOST']) {
        header("location:../404.php"); 
        die();
    }
    
    echo (file_exists('../tmp/primaxscan.png') ? 1 : 0);
    exit();
?>
