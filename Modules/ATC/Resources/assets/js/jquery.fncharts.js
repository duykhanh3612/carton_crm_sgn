function visit_month() {
    var m = $('.visit_month.select_month').val();
    var y = $('.visit_month.select_year').val();
    $.ajax({
        url: site_url + 'online/visit_month',
        type: 'POST',
        cache: false,
        async: true,
        dataType: 'json',
        data: {
            month: m,
            year: y
        },
        success: function(string) {
            eval('var series = [' + string.series + ']');
            $('#visit_month').highcharts({
                chart: {
                    type: 'column',
                    borderRadius: 0,
                    backgroundColor:'transparent'
                },
                title: {
                    text: 'Lượt truy cập tháng'
                },
                subtitle: {
                    text: accounting.formatMoney(string.total, '', 0) + ' lượt'
                },
                xAxis: {
                    categories: string.categories
                },
                yAxis: {
                    title: {
                        text: 'Số lượt'
                    }
                },
                series: [{
                    name: string.month + '/' + string.year,
                    data: series
                }],
                tooltip: {
                    formatter: function() {
                        return '<b>Ngày ' + (this.point.x + 1) +'</b><br/>'+ this.point.y + ' lượt';
                    }
                },
                credits: {
                    enabled: false
                }
            });
        }
    });
}

function visit_month_status() {
    var m = $('.visit_month.select_month').val();
    var y = $('.visit_month.select_year').val();
    $.ajax({
        url: site_url + 'online/visit_month_status',
        type: 'POST',
        cache: false,
        async: true,
        dataType: 'json',
        data: {
            month: m,
            year: y
        },
        success: function(string) {
            $('#visit_month_status').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    borderRadius: 0,
                    backgroundColor:'transparent'
                },
                title: {
                    text: 'Phân tích trình duyệt sử dụng'
                },
                tooltip: {
                    pointFormat: '<b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '{point.percentage:.1f} %'
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'trình duyệt',
                    data: string.series
                }],
                credits: {
                    enabled: false
                }
            });
        }
    });
}


function visit_year() {
    var y = $('.visit_year.select_year').val();
    $.ajax({
        url: site_url + 'online/visit_year',
        type: 'POST',
        cache: false,
        async: true,
        dataType: 'json',
        data: {
            year: y
        },
        success: function(string) {
            eval('var series = [' + string.series + ']');
            $('#visit_year').highcharts({
                chart: {
                    type: 'column',
                    borderRadius: 0,
                    backgroundColor:'transparent'
                },
                title: {
                    text: 'Lượt truy cập năm'
                },
                subtitle: {
                    text: accounting.formatMoney(string.total, '', 0) + ' lượt'
                },
                xAxis: {
                    categories: string.categories
                },
                yAxis: {
                    title: {
                        text: 'Số lượt'
                    }
                },
                series: [{
                    name: string.year,
                    data: series
                }],
                tooltip: {
                    formatter: function() {
                        return '<b>Tháng ' + (this.point.x + 1) +'</b><br/>'+ accounting.formatMoney(this.point.y, '', 0) + ' lượt';
                    }
                },
                credits: {
                    enabled: false
                }
            });
        }
    });
}

function visit_year_status() {
    var y = $('.visit_year.select_year').val();
    $.ajax({
        url: site_url + 'online/visit_year_status',
        type: 'POST',
        cache: false,
        async: true,
        dataType: 'json',
        data: {
            year: y
        },
        success: function(string) {
            $('#visit_year_status').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    borderRadius: 0,
                    backgroundColor:'transparent'
                },
                title: {
                    text: 'Phân tích trình duyệt sử dụng'
                },
                tooltip: {
                    pointFormat: '<b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '{point.percentage:.1f} %'
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'trình duyệt',
                    data: string.series
                }],
                credits: {
                    enabled: false
                }
            });
        }
    });
}

function visit_city() {
    var m = $('.visit_city.select_month').val();
    var y = $('.visit_city.select_year').val();
    $.ajax({
        url: site_url + 'online/visit_city',
        type: 'POST',
        cache: false,
        async: true,
        dataType: 'json',
        data: {
            month: m,
            year: y
        },
        success: function(string) {
            eval('var series = [' + string.series + ']');
            $('#visit_city').highcharts({
                chart: {
                    type: 'column',
                    borderRadius: 0,
                    backgroundColor:'transparent'
                },
                title: {
                    text: 'Lượt truy cập theo thành phố'
                },
                subtitle: {
                    text: accounting.formatMoney(string.total, '', 0) + ' lượt'
                },
                xAxis: {
                    categories: string.categories
                },
                yAxis: {
                    title: {
                        text: 'Số lượt'
                    }
                },
                series: [{
                    name: string.year,
                    data: series
                }],
                tooltip: {
                    formatter: function() {
                        return accounting.formatMoney(this.point.y, '', 0) + ' lượt';
                    }
                },
                credits: {
                    enabled: false
                }
            });
        }
    });
}

function visit_country() {
    var m = $('.visit_country.select_month').val();
    var y = $('.visit_country.select_year').val();
    $.ajax({
        url: site_url + 'online/visit_country',
        type: 'POST',
        cache: false,
        async: true,
        dataType: 'json',
        data: {
            month: m,
            year: y
        },
        success: function(string) {
            eval('var series = [' + string.series + ']');
            $('#visit_country').highcharts({
                chart: {
                    type: 'column',
                    borderRadius: 0,
                    backgroundColor:'transparent'
                },
                title: {
                    text: 'Lượt truy cập theo quốc gia'
                },
                subtitle: {
                    text: accounting.formatMoney(string.total, '', 0) + ' lượt'
                },
                xAxis: {
                    categories: string.categories
                },
                yAxis: {
                    title: {
                        text: 'Số lượt'
                    }
                },
                series: [{
                    name: string.year,
                    data: series
                }],
                tooltip: {
                    formatter: function() {
                        return accounting.formatMoney(this.point.y, '', 0) + ' lượt';
                    }
                },
                credits: {
                    enabled: false
                }
            });
        }
    });
}

function visit_backlink() {
    var m = $('.visit_backlink.select_month').val();
    var y = $('.visit_backlink.select_year').val();
    $.ajax({
        url: site_url + 'online/visit_backlink',
        type: 'POST',
        cache: false,
        async: true,
        dataType: 'json',
        data: {
            month: m,
            year: y
        },
        success: function(string) {
            eval('var series = [' + string.series + ']');
            $('#visit_backlink').highcharts({
                chart: {
                    type: 'column',
                    borderRadius: 0,
                    backgroundColor:'transparent'
                },
                title: {
                    text: 'Lượt truy cập theo nguồn'
                },
                subtitle: {
                    text: accounting.formatMoney(string.total, '', 0) + ' lượt'
                },
                xAxis: {
                    categories: string.categories
                },
                yAxis: {
                    title: {
                        text: 'Số lượt'
                    }
                },
                series: [{
                    name: string.year,
                    data: series
                }],
                tooltip: {
                    formatter: function() {
                        return accounting.formatMoney(this.point.y, '', 0) + ' lượt';
                    }
                },
                credits: {
                    enabled: false
                }
            });
        }
    });
}

$(function() {
    visit_month();
    visit_month_status();
    visit_year();
    visit_year_status();
    visit_city();
    visit_country();
    visit_backlink();
});