<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>primax</title>

        <meta name="author" content="Bruno Dutra" />
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <link rel="stylesheet/less" type="text/css" href="css/main.less">
        <script src="js/vendor/less.min.js"></script>
        
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <?php
            require($DOCUMENT_ROOT."navbar.php");
        ?>

        <div id="content">
            <div class="container">

                <div id="top-controller" class="row">
                    <button id="buttonOnOff" class="span3 btn btn-large btn-danger" type="button">Off</button>
                    <div class="span9"></div>
                </div>
                
                <div class="row">
                    <div id="frame" class="span12">
                        <img id="image"></img>
                    </div>
                </div>
                
                <div id="bottom-controller" class="row">
                    <button id="preview" class="span3 btn btn-large control disabled" type="button">Preview</button>
                    <button id="scan" class="span3 btn btn-large control disabled" type="button">Scan</button>
                    <div class="span3"></div>
                    <button id="save" class="span3 btn btn-inverse btn-large control disabled" type="button">Save Image</button>
                </div>
            
            </div>
            <div class="footer-push"></div>
        </div>
        
        <?php
            require($DOCUMENT_ROOT."footer.php");
        ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <script type="text/javascript">
        
            function enableControls(flag) {
                if(flag)
                    $('.control').removeClass('disabled');
                else
                    $('.control').addClass('disabled');                    
            }
            
            function setOn(element) {
                $(element).removeClass('btn-danger').removeClass('btn-warning').removeClass('disabled').addClass('btn-success');
                $(element).text('On');
                $(element).click(turnOff);
            }
            
            function turnOn() {
                self = this;
                $(self).unbind('click');
                $(self).removeClass('btn-danger').addClass('btn-warning').addClass('disabled');
                $(self).text('Turning On...');
                
                $.get('php/primax.php?op=turnLampOn', function(data) {
                    if(data >= 0) {
                        countdown(self, data, function() {setOn(self); enableControls(true);});
                    } else {
                        setOff(self);
                    }
                });
            }
            
            function setOff(element) {
                $(element).removeClass('btn-success').removeClass('btn-warning').removeClass('disabled').addClass('btn-danger');
                $(element).text('Off');
                $(element).click(turnOn);
            }
            
            function turnOff() {
                self = this;
                enableControls(false);
                $(self).unbind('click');
                $(self).removeClass('btn-success').addClass('btn-warning').addClass('disabled');
                $(self).text('Turning Off...');
                                
                $.get('php/primax.php?op=turnLampOff', function(data) {
                    if(data >= 0) {
                        countdown(self, data, function() {setOff(self);});
                    } else {
                        setOn(self);
                        enableControls(true);
                    }
                });
            }
            
            function centerElement(element, parent) {
                $(element).css('margin-left', ($(parent).outerWidth() - $(element).width())/2);
            }
            
            function preview() {
                $("#image").hide();
                $("#image").css('margin-left', '0');
                $("#image").one('load', function() {centerElement($("#image"), $("#frame")); $("#image").show();});
                $("#image").attr('src', 'php/primax.php?op=scan&resolution=20');
            }
            
            $(window).resize(function() {centerElement($("#image"), $("#frame"));});
            $("#buttonOnOff").click(turnOn);
            $("#preview").click(preview);
            
        </script>
    </body>
</html>
