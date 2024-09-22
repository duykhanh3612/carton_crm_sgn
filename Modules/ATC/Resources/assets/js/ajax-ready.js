$(document).ready(function() {
    if ($('.user-branch-btn .dropdown-menu').length && $.cookie('branch')) {
        $('.user-branch-btn .dropdown-menu li').removeClass('active');
        $('.user-branch-btn .dropdown-menu li[data-branch="' + $.cookie('branch') + '"]').addClass('active');
        if ($('.user-branch-btn .dropdown-menu li.active[data-branch="' + $.cookie('branch') + '"]').length) {
            $('.user-branch span').text('CN ' + $('.user-branch-btn .dropdown-menu li.active').text());
        } else {
            $.cookie('branch', $('#coso').val(), {
                path: '/',
                expires: 3600 * 24 * 30
            });
        }
    } else {
        $.cookie('branch', $('#coso').val(), {
            path: '/',
            expires: 3600 * 24 * 30
        });
    }

    if ($('.tab-content').length && $('.tab-pane .table thead').length) {
        $('.tab-pane .table').stickyTableHeaders({
            fixedOffset: $('#page-header').height()
        });
    } else {
        var module = $('#act').val();
        var variable = document.getElementById("approved-check");
        if (module == 'customer_purchase_order') {
            if (variable != null){
                $('.mainTable').stickyTableHeaders({
                    fixedOffset: 293
                });
            }

        }else{
            $('.mainTable').stickyTableHeaders({
                fixedOffset: $('#page-header').height() + ($('.group-process').length && $('#info-order').length && !$('#info-order').hasClass('in') ? 77 : ($('.group-process').length && $('#info-order').hasClass('in') || $('.group-process').length && !$('#info-order').length ? 32 : 0))
            });
        }

    }

    if (!$('.dd-list').length) {
        $('.nestable-menu').hide();
    }

    $('.money').autoNumeric('init', {
        'mDec': 0
    });

    if ($('.input-switch-alt').length) {
        $('.input-switch-alt').simpleCheckbox();
        $('.switch-toggle:not(.disabled)').click(function() {
            var id = $(this).prev().data('id');
            var status = $(this).prev().is(':checked') ? 1 : 0;
            var field = $(this).prev().data('field');
            var table = $('#moduleInfo').data('table');
            if (id == '' || id == null) {
                id = $('#id').val();
            }
            $.ajax({
                url: site_url + 'ajax/change_status',
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    table: table,
                    field: field,
                    status: status
                }
            });
        });
    }

    if ($('.cat_treeview').length) {
        $('.cat_treeview').treeview();
    }

    if ($('#date_added').length) {
        var format = $(this).data('format');
        if (format == '' || format == null) {
            format = 'YYYY-MM-DD HH:mm:ss';
        }
        $('#date_added').datetimepicker({
            format: format,
            locale: 'vi',
            icons: {
                time: 'glyph-icon icon-clock-o',
                date: 'glyph-icon icon-calendar',
                up: 'glyph-icon icon-chevron-up',
                down: 'glyph-icon icon-chevron-down',
                previous: 'glyph-icon icon-chevron-left',
                next: 'glyph-icon icon-chevron-right'
            }
        });
    }

    if ($('.date').length) {
        $('.date').each(function() {
            var dateFormat = $(this).data('format');
            if (dateFormat == '' || dateFormat == null) {
                dateFormat = 'yyyy-mm-dd';
            }
            $(this).datepicker({
                format: dateFormat,
                language: 'vi',
                autoclose: true,
                todayHighlight: true
            });
        });
    }

    if ($('.date_time').length) {
        $('.date_time').each(function() {
            var dateFormat = $(this).data('format');
            if (dateFormat == '' || dateFormat == null) {
                dateFormat = 'YYYY-MM-DD HH:mm:ss';
            }
            $(this).datetimepicker({
                format: dateFormat,
                locale: 'vi',
                icons: {
                    time: 'glyph-icon icon-clock-o',
                    date: 'glyph-icon icon-calendar',
                    up: 'glyph-icon icon-chevron-up',
                    down: 'glyph-icon icon-chevron-down',
                    previous: 'glyph-icon icon-chevron-left',
                    next: 'glyph-icon icon-chevron-right'
                }
            });
        });
    }

    if ($('#datepicker .input-daterange').length) {
        $('#datepicker .input-daterange').datepicker({
            format: 'yyyy-mm-dd',
            language: 'vi',
            autoclose: true,
            todayHighlight: true
        });
    }

    $('#page-content .tooltip-button, #page-content .tooltip-link').tooltip({
        container: '#page-content'
    });

    $('.tooltip-button, .tooltip-link').tooltip({
        container: 'body'
    });

    if ($('.select2').length) {

        if($(act).val()!="modules_template")
            $('.select2').chosen({
                placeholder_text_single: 'Select an option',
                disable_search_threshold: 10
            });

        if ($('.chosen-search').length && !$('.chosen-search i').length) {
            $('.chosen-search').append('<i class="glyph-icon icon-search"></i>');
        }
        $('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    }

    if ($('select.form-control').length&&$(act).val()!="modules_template") {
        $('select.form-control').chosen({
            disable_search: true,
            disable_search_threshold: 10
        });
        if ($('.chosen-search').length && !$('.chosen-search i').length) {
            $('.chosen-search').append('<i class="glyph-icon icon-search"></i>');
        }
        $('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    }

    if ($('.delRestoreLink .bin').length || $('.delRestoreLink .refresh').length) {
        $('#cmdBtnDelRestore').show();
    } else {
        $('#cmdBtnDelRestore').hide();
    }

    if ($('.modal .modal-body').length) {
        $('.modal .modal-body').css({
            'max-height': $(window).outerHeight(true) - ($('.modal .modal-header').length ? 60 : 0) - 55 + 'px',
            'overflow-y': 'auto'
        });
    }

    if ($('.month').length) {
        $('.month').each(function() {
            var dateFormat = $(this).data('format');
            if (dateFormat == '' || dateFormat == null) {
                dateFormat = 'yyyy-mm';
            }
            $(this).datepicker({
                format: dateFormat,
                language: 'vi',
                startView: 'months',
                minViewMode: 'months'
            });
        });
    }

    /*$('.mceEditor').editable({
        inlineMode: false,
        pastedImagesUploadURL: 'ajax/upload_image',
        imageUploadURL: site_url + 'ajax/upload_image',
        buttons: $.merge(['fullscreen'], $.Editable.DEFAULTS.buttons)
    });

    $('[href="http://editor.froala.com"]').parent().remove();*/

    // dev 20181214 ...
    // hardware design report
    $('.hwds_select_approver, .hwds_select_status').each(function() {
        $(this).next().find('.chosen-single div i').remove();
    })
    // ... #dev 20181214
});

function sendRequest(data,url){
    return new Promise((resolve, reject) => {
        $.ajax({
            url:'ajax/'+ url,
            type: "POST",
            data: data,
            success: function(res) {
                if (res != null) {

                    res = JSON.parse(res);
                    resolve(res.data);


                } else {
                    reject({});
                }
            },
            timeout: 20000,
            error: function(jqXHR, textStatus, errorThrown) {
               console.log("error send")
            },
        });
    })
}



function call_component()
{
    /* department_employee */
    $.ajax('/ajax/SelectDepartment?searchTerm=&limit=false', {
		dataType: 'json',
		success: function (data, status, xhr) {
			tag_group = $(".department_employee").find(".dropdown-menu");
			$.each(data, function (k, v) {
				tag_group.append(`<li class="depart" data-id="${v.id}" data-value="${v.text}"><a href="#">${v.text}</a></li>`);
			});
		},
		error: function (jqXhr, textStatus, errorMessage) {
			$('p').append('Error: ' + errorMessage)
		}
	})

	$(".department_employee").each(function(){
		tag_group = $(this);
		var staff = tag_group.find("input[type=hidden]").val();
		if(staff!="")
		{
			$.ajax('/ajax/GetUsers?searchTerm='+staff, {
			dataType: 'json',
			success: function (data, status, xhr) {
					tag_group.find(".title").html(data.id + "-" + data.text);
				},
				error: function (jqXhr, textStatus, errorMessage) {
					$('p').append('Error: ' + errorMessage)
				}
			})
		}
	});


    $(document).on('click', ".filter-show-data", function(e) {
        var tag = $(this).closest('.department_employee');
		if($(this).closest('.filter').find("input").val()!="")
		{
			$(this).closest('.filter').find(".filter-show-data-cancel").show();
			$(this).hide();
			let depart = $(this).closest('.filter').find("input").attr("data-depart");
            tag.find('.dropdown > .dropdown-menu > li.depart').hide();
            tag.find(".dropdown > .dropdown-menu > li.user[data-depart="+depart+"]");
			if(tag.find('.dropdown > .dropdown-menu > li.user[data-depart='+depart+']').length==0)
			{
				$.ajax('/ajax/UserDepartment?searchTerm='+depart, {
					dataType: 'json',
					success: function (data, status, xhr) {

						tag_group = tag.find(".dropdown-menu");
						$.each(data, function (k, v) {
							tag_group.append(`<li class="user" data-depart="${depart}" data-id="${v.id}" data-value="${v.text}"><a href="#">${v.id}-${v.text}</a></li>`)
						})
					},
					error: function (jqXhr, textStatus, errorMessage) {
						$('p').append('Error: ' + errorMessage)
					}
				})
			}
			else
			{
				tag.find('.dropdown > .dropdown-menu > li.user[data-depart='+depart+']').show();
			}
		}
	});
	$(document).on('click','.filter-show-data-cancel',function(){
		$(this).hide();
		$(this).closest('.filter').find(".filter-show-data").show();

		$('.department_employee > .dropdown > .dropdown-menu > li.depart').show();
		$('.department_employee > .dropdown > .dropdown-menu > li.user').hide();
		$("input[name=filter]").val('');
	});
	$(document).on('click','.depart',function(){
        var tag = $(this).closest('.department_employee');
		tag.find("input[name=filter]").val($(this).data("value"));
		tag.find("input[name=filter]").attr("data-depart",$(this).data("id"));
		tag.find(".filter-show-data").trigger("click");
	});
	$(document).on('click','.user',function(){
		id = $(this).closest(".dropdown-menu").attr("data-id");
		$(this).closest(".dropdown").removeClass("open");
		$(id).val($(this).data('id'));
		$(this).closest(".dropdown").find(".title").html($(this).data('id') + "-" + $(this).data('value'))
	});
	$(document).on('click', '.department_employee .dropdown-menu', function (e) {
		e.stopPropagation();
	});

	$("input[name=filter]").on("keyup", function() {
		var value = $(this).val().toLowerCase();
        var depart = $(this).attr("data-depart");
		var tag = $(".dropdown-menu > li.user[data-depart="+depart+"]");
		$(tag).filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

    /* End department employee */
}
if($("component").length>0)
{
    call_component();
}

