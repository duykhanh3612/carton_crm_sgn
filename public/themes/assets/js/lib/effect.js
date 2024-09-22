
function ele_change(e, delay_time = 3000)
{
    e.addClass('has-change').delay(delay_time).queue(function () {
        $(this).removeClass('has-change');
    });
}
