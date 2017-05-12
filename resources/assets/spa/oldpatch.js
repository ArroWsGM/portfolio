/**
 * Created by ArroWs on 10.05.2017.
 */
window.isOldBrowser = false


var isOldChrome = function(){
    var ua = window.navigator.userAgent;
    if(ua.match(/chrome\/\d{2}/i)) {
        return (parseInt(ua.match(/chrome\/\d{2}/i)[0].split('/')[1]) < 45 )
    } else if(ua.match(/firefox\/\d{2}/i)) {
        return (parseInt(ua.match(/firefox\/\d{2}/i)[0].split('/')[1]) < 44 )
    } else if(ua.match(/presto\//i)) {
        return true
    } else {
        return false
    }
}

if(isOldChrome())
    isOldBrowser = true

function loadScript(url, callback){

    var script = document.createElement("script");

    if (script.readyState){  //IE
        script.onreadystatechange = function(){
            if (script.readyState === "loaded" ||
                script.readyState === "complete"){
                script.onreadystatechange = null;
                callback();
            }
        };
    } else {  //Others
        script.onload = function(){
            callback();
        };
    }

    script.src = url;
    document.getElementsByTagName("body")[0].appendChild(script);
}

function loadScripts(){
    loadScript(_baseURL + '/spa/vendor.js', function(){
        loadScript(_baseURL + '/spa/app.js', function(){
            console.log('app.js loaded')
        })
    })
}

// Create a list of the features this browser needs.
// Beware of overly simplistic detects!
var features = [];
('Promise' in window) || features.push('Promise')

// If any features need to be polyfilled, construct
// a script tag to load the polyfills and append it
// to the document
if (features.length) {
    isOldBrowser = true
    // Include a `ua` argument set to a supported browser to skip UA identification
    // (improves response time) and avoid being treated as unknown UA (which would
    // otherwise result in no polyfills, even with `always`, if UA is unknown)
    var src = 'https://polyfill.io/v2/polyfill.min.js?features='+features.join(',')+'&flags=gated,always&ua=chrome/50';
    loadScript(src, loadScripts)
} else {
    loadScripts()
}