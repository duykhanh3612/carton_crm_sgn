function validatePhone(phone) {
    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
    if (filter.test(phone) && phone.length <=12) {
        return true;
    }
    else {
        return false;
    }
}

function validateEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if( regex.test(email)){
        return true;
    }
    else {
        return false;
    }
 }


 function strip_tags(str, allow = ''){
    // making sure the allow arg is a string containing only tags in lowercase (<a><b><c>)
    // allow = (((allow || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');

    // var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;
    // var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
    // return str.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
    //     return allow.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 :'';
    // }).replace(/(\r\n|\n|\r)/gm,"").replace(/&nbsp;/g, '').trim();

    return str.replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').trim();
}
