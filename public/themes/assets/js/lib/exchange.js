async function getExchangeACBV1() {
    var dateString = getDate();
    var url = 'https://acb.com.vn/ACBComponent/jsp/html/vn/exchange/getlan.jsp?cmd=EXCHANGE&txtngaynt=' + dateString;

    var res = await send(url);
    var data = $.parseHTML(res);
    if (data[1]) {

        url = 'https://acb.com.vn/ACBComponent/jsp/html/vn/exchange/exporttygiangoaite.jsp?txtngaynt=' + dateString + "&&lannt=" + data[1].innerHTML;
        res = await send(url);
        data = $.parseHTML(res);

        var arr = res.split('<td class="bodertop txbody" align="right">');
        var rate = arr[4].split("</td>");
        rate = rate[0].replace(",", "");
        return rate;
    }

}
async function getExchange() {
    try {
        var dateString = getDatev2();
        var url = 'https://acb.com.vn/api/en/front/v1/currency?currency=VND&effectiveDateTime=' + dateString;
        var res = await send(url);
        // var data = $.parseJSON(res);
        var data = res.reduce(function (result, current) {
            result[current.exchangeCurrency] = result[current.exchangeCurrency] || [];
            if (current.dealType == "ASK" && current.instrumentType == "CASH")
                result[current.exchangeCurrency].push(current);
            return result;
        }, {});
        return data["USD"][0]["exchangeRate"];
    } catch (error) {
        showNoti("Gateway to get ACB Rate is not possible", 'Notification', 'Err');
        hideLoading();
    }
}
async function getExchangeVCB() {
    try {
        var url = "ajax/usd_rates_vcb";
        res = await send(url);
        return res;
    } catch (error) {
        showNoti("Gateway to get VCB Rate is not possible", 'Notification', 'Err');
        hideLoading();
    }
}
