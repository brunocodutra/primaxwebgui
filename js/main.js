function countdown(element, seconds, callback) {
    setTimeout(function() {                  
        currentMinutes = Math.floor(seconds/60);
        currentSeconds = seconds - currentMinutes*60;
    
        $(element).text((currentMinutes < 10 ? '0' : '') + currentMinutes + ':' + (currentSeconds < 10 ? '0' : '') + currentSeconds)
        if(seconds-- <= 0) {
            setTimeout(callback, 0);
            return;
        }
        
        countdown(element, seconds, callback);
    }, 1000);
}
