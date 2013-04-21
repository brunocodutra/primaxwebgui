<?php
/*
  This file is part of primaxwebgui, a free software.
  Use, modification and distribution is subject to the BSD 2-clause license.
  See accompanying file LICENSE.txt for its full text.
 */
    if(empty($includedFromIndex) || !$includedFromIndex) { 
        $refering=parse_url($_SERVER['HTTP_REFERER']);
        if($refering['host'] != $_SERVER['HTTP_HOST']) {
            header("location:404.php"); 
            die();
        }
    }
?>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
            <a class="brand" href="./index.php">primax</a>
        </div>
    </div>
</div>