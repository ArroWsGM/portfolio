/**
 * Created by ArroWs on 10.05.2017.
 */
window.isOldBrowser = false
// Create a list of the features this browser needs.
// Beware of overly simplistic detects!
var features = [];
('Promise' in window) || features.push('Promise')

// If any features need to be polyfilled, construct
// a script tag to load the polyfills and append it
// to the document
if (features.length) {
    window.isOldBrowser = true
    var s = document.createElement('script')

    // Include a `ua` argument set to a supported browser to skip UA identification
    // (improves response time) and avoid being treated as unknown UA (which would
    // otherwise result in no polyfills, even with `always`, if UA is unknown)
    s.src = 'https://polyfill.io/v2/polyfill.min.js?features='+features.join(',')+'&flags=gated,always&ua=chrome/50'
    s.async = false
    document.head.appendChild(s)
}