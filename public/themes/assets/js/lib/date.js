function day_of_week() {
    var dt = new Date(); // current date of week
    var currentWeekDay = dt.getDay();
    var lessDays = currentWeekDay == 0 ? 6 : currentWeekDay - 1;
    var mo = new Date(new Date(dt).setDate(dt.getDate() - lessDays));
    var tu = new Date(new Date(mo).setDate(mo.getDate() + 1));
    var we = new Date(new Date(mo).setDate(mo.getDate() + 2));
    var th = new Date(new Date(mo).setDate(mo.getDate() + 3));
    var fr = new Date(new Date(mo).setDate(mo.getDate() + 4));
    var sa = new Date(new Date(mo).setDate(mo.getDate() + 5));
    var su = new Date(new Date(mo).setDate(mo.getDate() + 6));
    $(".day_of_week").html("");
    $(".day_of_week").append(`<li data-value="${format_date(mo)}">Monday <small>${format_dispay_date(mo)}</small></li>`);
    $(".day_of_week").append(`<li data-value="${format_date(tu)}">Tuseday <small>${format_dispay_date(tu)}</small></li>`);
    $(".day_of_week").append(`<li data-value="${format_date(we)}">Wednesday <small>${format_dispay_date(we)}</small></li>`);
    $(".day_of_week").append(`<li data-value="${format_date(th)}">Thursday <small>${format_dispay_date(th)}</small></li>`);
    $(".day_of_week").append(`<li data-value="${format_date(fr)}">Friday <small>${format_dispay_date(fr)}</small></li>`);
    $(".day_of_week").append(`<li data-value="${format_date(sa)}">Saturday <small>${format_dispay_date(sa)}</small></li>`);
    $(".day_of_week").append(`<li data-value="${format_date(su)}">Sunday <small>${format_dispay_date(su)}</small></li>`);
}
function isDateInThisWeek(date) {
    const todayObj = new Date();
    const todayDate = todayObj.getDate();
    const todayDay = todayObj.getDay();

    // get first date of week
    const firstDayOfWeek = new Date(todayObj.setDate(todayDate - todayDay));

    // get last date of week
    const lastDayOfWeek = new Date(firstDayOfWeek);
    lastDayOfWeek.setDate(lastDayOfWeek.getDate() + 6);

    const currentObj = new Date(date);
    // console.log(863, date, firstDayOfWeek, lastDayOfWeek);
    // if date is equal or within the first and last dates of the week
    return currentObj >= firstDayOfWeek && currentObj <= lastDayOfWeek;
}

function date(format, value) {
    date = new Date(value);
    switch(format)
    {
        case "m/d/Y":
            return [
                padTo2Digits(date.getMonth() + 1),
                padTo2Digits(date.getDate()),
                date.getFullYear(),
            ].join('/');;
            break;
        default:
            return value;
            break;
    }
}

function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}

function formatDate(date) {
    return [
        padTo2Digits(date.getDate()),
        padTo2Digits(date.getMonth() + 1),
        date.getFullYear(),
    ].join('/');
}