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
        include_once('../404.php'); 
        exit();
    }
        
    if(file_exists('../tmp/.lock') && file_get_contents('../tmp/.lock') !== session_id()) {
        header("HTTP/1.1 303 See Other");
        include_once('../303.php');
        exit();
    }

    $includedFromPrimax = true;
    require_once('primax_constants.php');
    
    function tiff2png($tifFile) 
    {
        $pngFile = str_replace('.tif', '.png', $tifFile);
        exec("convert ".$tifFile." ".$pngFile);
        
        return $pngFile;
    }

    function turnLampOn($port)
    {
        if(file_exists('../tmp/.lock')) {
            return 0;
        }
    
        if($_SESSION['busy'])
            return -2;
            
        $_SESSION['busy'] = true;
        exec("./primaxscan --port='".$port."' --lamp=on", $output, $return);
        $_SESSION['busy'] = false;
        if($return || file_put_contents('../tmp/.lock', session_id()) === false)
            return -1;

        global $warmUpTime;
        return $warmUpTime;
    }
    
    function turnLampOff($port)
    {        
        if(!file_exists('../tmp/.lock')) {
            return 0;
        }
        
        if($_SESSION['busy'])
            return -2;
            
        $_SESSION['busy'] = true;
        exec("./primaxscan --port='".$port."' --lamp=off", $output, $return);
        $_SESSION['busy'] = false;
        if($return || unlink('../tmp/.lock') === false)
            return -1;
        
        global $coolDownTime;
        return $coolDownTime;
    }
        
    function scan($port, $resolution, $x, $y, $dx, $dy, $speed, $contrast, $brightness, $gamma)
    {
        global $minResolution;
        global $maxResolution;
        global $minX;
        global $maxX;
        global $minY;
        global $maxY;
        global $minSpeed;
        global $maxSpeed;
        global $minContrast;
        global $maxContrast;
        global $minBrightness;
        global $maxBrightness;
        global $minGamma;
        global $maxGamma;
        
        $resolution = min(max($resolution, $minResolution), $maxResolution);
        $x = min(max($x, $minX), $maxX);
        $y = min(max($y, $minY), $maxY);
        $dx = min(max($dx, 0), $maxX - $x);
        $dy = min(max($dy, 0), $maxY - $y);
        $speed = min(max($speed, $minSpeed), $maxSpeed);
        $contrast = min(max($contrast, $minContrast), $maxContrast);
        $brightness = min(max($brightness, $minBrightness), $maxBrightness);
        $gamma = min(max($gamma, $minGamma), $maxGamma);
        $tifFile = '../tmp/primaxscan.tif';
        $pngFile = '../tmp/primaxscan.png';
        $broken = '../img/broken_image.png';
        
        header("Content-type: image/png");
        header("Expires: -1");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        
        if($_SESSION['busy'])
            readfile($broken);
        
        $_SESSION['busy'] = true;
        
        unlink($tifFile);
        unlink($pngFile);

        exec("./primaxscan --port='".$port."' --speed=".$speed." --Scanner=".$maxResolution." --contrast=".$contrast." --brightness=".$brightness." --gamma=".$gamma." --Compression=none --RGB -p".$x."x".$y." -d".$dx."x".$dy." -r ".$resolution." -f ".$tifFile, $output, $return);
        
        if($return || !file_exists($tifFile))
            $pngFile = $broken;
        else
            $pngFile = tiff2png($tifFile);
            
        $_SESSION['busy'] = false;
        
        readfile($pngFile);
    }
    
    if(isset($_GET['op']))
    {
        $op = $_GET['op'];
        $port = isset($_GET['port']) ? $_GET['port'] : $defaultPort;
        
        if($op === "turnLampOn")
        {
            echo turnLampOn($port);
            exit();
        }
        else if($op === "turnLampOff")
        {
            echo turnLampOff($port);
            exit();
        }
        else if($op === "scan" && isset($_GET['resolution']))
        {
            if(!file_exists('../tmp/.lock')) {
                header("HTTP/1.0 403 Forbidden");
                include_once('../403.php'); 
                exit();
            }
        
            $resolution = $_GET['resolution'];
            $x = isset($_GET['x']) ? $_GET['x'] : 0;
            $y = isset($_GET['y']) ? $_GET['y'] : 0;
            $dx = isset($_GET['dx']) ? $_GET['dx'] : $maxX - $x;
            $dy = isset($_GET['dy']) ? $_GET['dy'] : $maxY - $y;
            $speed = isset($_GET['speed']) ? $_GET['speed'] : $defaultSpeed;
            $contrast = isset($_GET['contrast']) ? $_GET['contrast'] : $defaultContrast;
            $brightness = isset($_GET['brightness']) ? $_GET['brightness'] : $defaultBrightness;
            $gamma = isset($_GET['gamma']) ? $_GET['gamma'] : $defaultGamma;
        
            echo scan($port, $resolution, $x, $y, $dx, $dy, $speed, $contrast, $brightness, $gamma);
            exit();
        }
    }
    else
    {
        header("HTTP/1.0 404 Not Found");
        include_once('../404.php');
        exit();
    }
?>