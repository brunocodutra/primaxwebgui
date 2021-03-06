<?php
/*
  This file is part of primaxwebgui, a free software.
  Use, modification and distribution is subject to the BSD 2-clause license.
  See accompanying file LICENSE.txt for its full text.
 */
    if(!$includedFromPrimax) {
        header("HTTP/1.0 404 Not Found");
        include_once('../404.php'); 
        exit();
    }
    
    $warmUpTime = 10;
    $coolDownTime = 5;
    
    $minResolution = 10;
    $maxResolution = 300;
    
    $minX = 0;
    $maxX = 8.4;
    
    $minY = 0;
    $maxY = 11.6;   
    
    $minSpeed = 0;
    $maxSpeed = 15;
    
    $minContrast = -2000;
    $maxContrast = 1000;
    
    $minBrightness = -200;
    $maxBrightness = 200;
    
    $minGamma = 0.2;
    $maxGamma = 5;
    
    $defaultPort = '0x378';    
    $defaultSpeed = $maxSpeed;
    $defaultContrast = 0;
    $defaultBrightness = 0;
    $defaultGamma = 1.0;
?>