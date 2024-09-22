

// (async () => {
//     await import('./lib/string.js').catch((error) => console.log('Loading failed' + error));
// })().then(()=>{
//     alert(str.generateUUID());
// });
// import('./lib/string.js').catch((error) => console.log('Loading failed' + error));

// import('./lib/string.js')
//       .then((module) => {
//         alert( module.generateUUID());
//       })
//       .catch((err) => {
//         main.textContent = err.message;
//       });


var base_url = window.location.origin;
loadScript("public/themes/assets/js/lib/string.js");
loadScript("public/themes/assets/js/lib/number.js");
loadScript("public/themes/assets/js/lib/validate.js");
loadScript("public/themes/assets/js/lib/date.js");
loadScript("public/themes/assets/js/script.js");

var version = 7;
$(document).keydown(function(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if ( e.ctrlKey && code == 50) {
        window.open('{{url("docs/page/api.html")}}', '_blank');
    }

    if ( (e.shiftKey && code == 49) || (e.ctrlKey && code == 49)) {
        alert("Versin: "+ version)
    }
});


function loadScript(file)
{
    path = base_url + '/'+ file;
    var script = document.createElement("script");
    script.src = path;
    document.head.appendChild(script)
}

function strip_tags(string)
{
    return string.replace(/(<([^>]+)>)/gi, "");
}
function isJsonString(str) {
    try {
        var o = JSON.parse(str);
        if (o && typeof o === "object") {
            return true;
        }
    }
    catch (e) { }

    return false;
}


(function( $ ){
    $.fn.format = function() {
       return format_thousand($(this).val());
    }; 
 })( jQuery );