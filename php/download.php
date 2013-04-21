<!--
  This file is part of primaxwebgui, a free software.
  Use, modification and distribution is subject to the BSD 2-clause license.
  See accompanying file LICENSE.txt for its full text.
-->

<?php
    $pngFile = '../tmp/primaxscan.png';
    if(file_exists($pngFile)) {

        header("Content-type: application/octet-image");
        header("Content-Disposition: attachment; filename=scan.png");
        header("Expires: -1");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        readfile($pngFile); 
        exit();
        
    } 
    
    header("Location: ../404.html");
?>