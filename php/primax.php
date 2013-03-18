<?php
    require_once('primax_constants.php');
    
    function tiff2png($tifFile) 
    {
        $pngFile = str_replace('.tif', '.png', $tifFile);
        exec("convert ".$tifFile." ".$pngFile);
        
        return $pngFile;
    }

    function turnLampOn($port)
    {
        //exec("primaxscan --port='".$port."' --lamp=on", $output, $return);
        $return = 0;
        if($return)
            return -1;

        global $warmUpTime;
        return $warmUpTime;
    }
    
    function turnLampOff($port)
    {
        //exec("primaxscan --port='".$port."' --lamp=off", $output, $return);
        $return = 0;
        if($return)
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
        
        /*exec("primaxscan 
            --port='".$port."' 
            --speed=".$speed." 
            --Scanner=".$maxResolution." 
            --contrast=".$contrast." 
            --brightness=".$brightness." 
            --gamma=".$gamma." 
            --Compression=none 
            --RGB 
            -p".$x."x".$y." 
            -d".$dx."x".$dy." 
            -r ".$resolution." 
            -f ".$tifFile, $output, $return);*/
        $return = 0;
        
        if($return || !file_exists($tifFile))
            $pngFile = '../img/broken_image.png';
        else
            $pngFile = tiff2png($tifFile);
        
        header("Content-type: image/png");
        header("Expires: -1");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
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
        header("Location: ../404.html");
        exit();
    }
?>