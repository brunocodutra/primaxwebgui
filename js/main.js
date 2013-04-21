/*
  This file is part of primaxwebgui, a free software.
  Use, modification and distribution is subject to the BSD 2-clause license.
  See accompanying file LICENSE.txt for its full text.
 */

function countdown(element, seconds, callback) {
    seconds = Math.floor(seconds);
    setTimeout(function() {          
        if(seconds <= 0) {
            setTimeout(callback, 0);
            return;
        } else {
            countdown(element, seconds - 1, callback);
        }
        
        currentMinutes = Math.floor(seconds/60);
        currentSeconds = seconds - currentMinutes*60;
    
        $(element).text((currentMinutes < 10 ? '0' : '') + currentMinutes + ':' + (currentSeconds < 10 ? '0' : '') + currentSeconds);
    }, 1000);
}
