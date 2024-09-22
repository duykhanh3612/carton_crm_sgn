jQuery(document).ready(function ($) {


  $('body').prepend(`<div class="toast__container"></div>`);
  $.notify = (options) => {
    let allowTypes = ['success', 'warning', 'danger'];
    options.type = options.type && allowTypes.find(type => type === options.type.trim().toLowerCase()) ? options.type : 'default';
    options.message = options.message ? options.message : '';
    options.timeOut = options.timeOut ? options.timeOut : 2000;
    let toast = $(document.createElement('div'));
    toast.addClass('toast__cell')
        .append(`<div class="toast toast--${options.type}">
<div class="toast__content">
<p class="toast__message">${options.message}</p>
</div>
<div class="toast__close">
<i class="fa fa-times"></i>
</div>
</div>`);
    let btnClose = toast.find('.toast__close');
    btnClose.click(e => {
      e.preventDefault();
      toast.remove();
    })
    $('.toast__container').prepend(toast);
    let timeOut = setTimeout(() => {
      toast.fadeOut();
      clearTimeout(timeOut);
    }, options.timeOut);
    let timeOutRemove = setTimeout(() => {
      toast.remove();
      clearTimeout(timeOutRemove);
    }, options.timeOut + 1000);
  }
  $.nSuccess = (message) => {
    $.notify({
      type: 'success',
      message: message,
    });
  }
  $.nError = (message) => {
    $.notify({
      type: 'danger',
      message: message,
    });
  }
  $.nWarning = (message) => {
    $.notify({
      type: 'danger',
      message: message,
    });
  }
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  //change Tab
  $.changeTab = function (tabs) {
    $(tabs).each(function () {
      if ($(this).data('group').substr($(this).data('group').length - 1) == $('#current_tab').val()) {
        $(this).parents('ul').find('li').removeClass('active');
        $(this).parents('li').addClass('active');
        $('#main-tab').removeClass(function (index, css) {
          return (css.match(/(^|\s)group-\S+/g) || []).join(' ');
        });
        var temp = $(this).data('group');
        $('#main-tab').addClass(temp);
      }
    });
  };
  tabLinks = $('#full-size-menu li a');
  $.changeTab(tabLinks);
  tabLinks.click(function () {
    $('#current_tab').val($(this).data('group').substr($(this).data('group').length - 1));
    const params = getDataTableParams();
    const strParam = $.param(params);

    //change url browser
    const newUrl = $('.paginateCustom #path').val() + '?' + strParam;
    window.history.pushState(null, null, newUrl);

    //call changeTab function
    $.changeTab(this);
  });

  //Pagination change page
  $('.jsAutoLoad .paginate_button a').click(function () {
    const temp = $(this).data('href');
    if (temp) {
      const params = getDataTableParams();
      delete (params.page);
      const strParam = $.param(params);
      window.location.href = temp + '&' + strParam;
    }
  });

  //Pagination Limit
  $('.jsAutoLoad select.limit-changed').change(function(){
    const params = getDataTableParams();
    params.page = 1;
    params.limit = this.value;
    const strParam = $.param(params);
    //change url browser
    const newUrl = $('.paginateCustom #path').val() + '?' + strParam;
    window.location.href = newUrl;
  });

  // Filter
  $("#keywords").change(datatableChange);
  // Filter
  $("#filterWebOrder").click(function (e) {
    if ($(this).attr("ischecked") == "false") {
      $(this).attr("ischecked", "true");
      $(this).prop("checked", true);
    } else {
      $(this).attr("ischecked", "false");
      $(this).removeAttr("checked").prop('checked' , false);
    }
    datatableChange();
  });
  //checkAll
  $('#checkAll').click(function () {
    if (this.checked) {
      $('.checkBox').each(function () {
        this.checked = true;
      });
    } else {
      $('.checkBox').each(function () {
        this.checked = false;
      });
    }
  });
  $.fn.submitDataAjax = function (params) {
    var self = this;
    self.attr('disabled', 'disabled');
    //Submit ajax
    $.ajax({
      url: params.url,
      type: params.method,
      data: params.data,
      dataType: 'JSON',
      error: function error(response) {
        if (response.status === 419) {
          $.notify({
            type: 'danger',
            message: 'CSRF Token is expired! <br>This page will be refreshed.'
          });
          setTimeout(function () {
            window.location.href = window.location.href;
          }, 1000);
        }
        console.log(response);
      },
      success: function success(response) {
        return params.success(response);
      },
      complete: function complete(response) {
        self.removeAttr('disabled');
      }
    });
  };


  function initUpdateSetting() {
    $('.update-user-setting').change(function () {
      const ele = $(this);
      let validate = true;
      const validate_rule = ele.data('rule');
      switch (validate_rule) {
        case 'email' :
          validate = !ele.val() || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(ele.val());
      }
      if (validate) {
        ele.removeClass('error');
      } else {
        ele.addClass('error');
        return;
      }
      let hs_multiple = ele.prop('multiple');
      const hs_separator = ele.data('separator');
      const hs_data_type = ele.data('type');
      const hs_core_var = ele.data('corevarkey');
      const with_option_text = ele.data('with_option_text');
      if (hs_multiple == true) {
        hs_multiple = 1;
      } else {
        hs_multiple = 0;
      }
      let keyType = ele.attr('keyType');
      let hsVal = {};
      let hsTitle = {};

      if (typeof keyType !== typeof undefined && keyType !== false) {
        hsVal[keyType] = ele.val();
      } else {
        hsVal = ele.val();
      }

      if (with_option_text) {
        ele.find("option").each(function (index, item) {
          if (hsVal === item.value || ($.isArray(hsVal) && hsVal.indexOf(item.value) >= 0)) {
            hsTitle[item.value] = item.text;
          }
        });
      }
      const data = {
        'hs_key': this.id,
        'hs_val': hsVal,
        'hs_title': hsTitle,
        'hs_multiple': hs_multiple,
        'hs_separator': hs_separator,
        'hs_data_type': hs_data_type,
        'is_map_field': keyType,
        'validate_rule': validate_rule,
        'hs_core_var': hs_core_var,
      };
      ele.submitDataAjax({
        'url': '/update-user-setting',
        'method': 'POST',
        'data': data,
        'success': function success(res) {
          if (res.status === 200) {
            let item = $('#' + data['hs_key']).parents('td').find('.map-field-addition-setting');
            if (res.deleted === true) {
              item.addClass("d-none");
              item.find('select').prop('selectedIndex', 0);
            } else {
              item.removeClass("d-none");
            }
            if (ele.hasClass("refresh")) {
              window.location.reload()
            }
          }
          if (res.status === 422) {
            ele.addClass('error');
          }
        }
      });
    });
    $('.update-eloquent').change(function () {
      const ele = $(this);
      let validate = true;
      const validate_rule = ele.data('rule');
      switch (validate_rule) {
        case 'email' :
          validate = !ele.val() || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(ele.val());
      }
      if (validate) {
        ele.removeClass('error');
      } else {
        ele.addClass('error');
        return;
      }
      let hs_multiple = ele.prop('multiple');
      const hs_separator = ele.data('separator');
      const hs_data_type = ele.data('type');
      const hs_core_var = ele.data('corevarkey');
      const with_option_text = ele.data('with_option_text');
      if (hs_multiple == true) {
        hs_multiple = 1;
      } else {
        hs_multiple = 0;
      }
      let keyType = ele.attr('keyType');
      let hsVal = {};
      let hsTitle = {};

      if (typeof keyType !== typeof undefined && keyType !== false) {
        hsVal[keyType] = ele.val();
      } else {
        hsVal = ele.val();
      }

      if (with_option_text) {
        ele.find("option").each(function (index, item) {
          if (hsVal === item.value || ($.isArray(hsVal) && hsVal.indexOf(item.value) >= 0)) {
            hsTitle[item.value] = item.text;
          }
        });
      }
      const data = {
        'hs_key': this.id,
        'hs_val': hsVal,
        'hs_title': hsTitle,
        'hs_multiple': hs_multiple,
        'hs_separator': hs_separator,
        'hs_data_type': hs_data_type,
        'is_map_field': keyType,
        'validate_rule': validate_rule,
        'hs_core_var': hs_core_var,
      };
      ele.submitDataAjax({
        'url': $('#update-eloquent-link').val(),
        'method': 'POST',
        'data': data,
        'success': function success(res) {
          if (res.status === 200) {
            if(res.type=="create"){
              $('#update-eloquent-link').val(res.link);
            }
            let item = $('#' + data['hs_key']).parents('td').find('.map-field-addition-setting');
            if (res.deleted === true) {
              item.addClass("d-none");
              item.find('select').prop('selectedIndex', 0);
            } else {
              item.removeClass("d-none");
            }
            if (ele.hasClass("refresh")) {
              window.location.reload()
            }
          }
          if (res.status === 422) {
            ele.addClass('error');
          }
        }
      });
    });
  }
  initUpdateSetting();







  //init DataTable
  table = $('#invoicesTable.sortable').DataTable({
    "bPaginate": false,
    "bInfo": false,
    "bFilter": false,
    "dom": '<"hidden"ilp<"clear">>',
    "columnDefs": [{"targets": 0, "width": "20px"}, {
      "targets": 'unorderable',
      "orderable": false
    }, {"targets": 'orderable', "orderable": true}],
    "aaSorting": [parseInt($('#sort_column').val()), $('#sort_order').val()]
  })
  table.on('order.dt', function () {
    var sort = table.order();
    $('#sort_column').val(sort[0][0]);
    $('#sort_field').val($('#invoicesTable.sortable tr th').eq(parseInt(sort[0][0])).attr('data-field'));
    if ($('#sort_order').val() == 'desc') {
      $('#sort_order').val('asc');
    } else {
      $('#sort_order').val('desc');
    }
    var group = $('#full-size-menu li.active a').data('group');
    let currentTab = group ? group.substr($('#full-size-menu li.active a').data('group').length - 1) : '';
    var params = getDataTableParams();
    params.page = 1;
    const path = $('.paginateCustom #path').val();
    const strParam = $.param(params);
    window.location.href = path + '?' + strParam;
  });
  $('.please-wait').click(function (e) {
    e.preventDefault();
    waitingDialog.show('Please wait...');
    if ($(this).attr('href')) {
      window.location.href = $(this).attr('href');
    }
  })
  $('.form-please-wait').submit(function (e) {
    waitingDialog.show('Please wait...');
  })
  $('.processingModalLink').click(function () {
    if ($(this).data('form')) {
      $('#processingModal #processingModalForm').attr('action', $(this).data('href'));
      $('#processingModal #processingModalForm').attr('method', $(this).data('method') ? $(this).data('method') : 'POST');
      if ($(this).data('submit')) {
        $('#processingModal #processingModalForm #processingModalSubmit').attr('type', 'submit');
      } else {
        $('#processingModal #processingModalForm #processingModalSubmit').attr('type', 'button');
      }
      $('#processingModal #processingModalTitle').html($(this).data('title'));
      $('#processingModal #processingModalBody').html($(this).data('body'));
      $('#processingModal #processingModalForm #processingModalSubmit').html($(this).data('submit-title'));
      $('#processingModal #processingModalForm #processingModalCancel').html($(this).data('cancel-title'));
    }
  });
  $('#processingModal #processingModalForm').submit(function () {
    $('#processingModal').hide();
    waitingDialog.show('Please wait...');
  });
  $('.has-dependency-div').change(function () {
    hasDependencyDivChange(this);
  });
  $('.has-dependency-div').each(function () {
    hasDependencyDivChange(this);
  });

  function hasDependencyDivChange(that) {
    let showValue = $(that).val();
    let showId = that.id;
    $('.dependency-div').each(function () {
      let parent = $(this).data('parent');
      if (parent == showId) {
        let dataShow = $(this).data('show');
        let dataHide = $(this).data('hide');
        if ((dataShow === 'not empty' && showValue && showValue.length) || dataShow == showValue || (Array.isArray(dataShow) && (dataShow.includes(showValue) || dataShow.includes(parseInt(showValue))))) {
          $(this).addClass('show');
        } else {
          $(this).removeClass('show');
        }
        if (dataHide !== undefined) {
          if (showValue == dataHide || (Array.isArray(dataHide) && (dataHide.includes(showValue) || dataHide.includes(parseInt(showValue))))) {
            $(this).removeClass('show');
          } else {
            $(this).addClass('show');
          }
        }
      }
    })
  }

  function handleCheckboxAction(data, url , ele) {
    $(this).submitDataAjax({
      'url': url,
      'method': 'POST',
      'data': data,
      'success': function success(res) {
        if(!res || !res.success) {
          ele.prop('checked' , !ele.prop('checked'));
          $.nError(res.message || 'Can not update item.');
        }
        else {
          validateRequired();
        }
      },
    });
  }

  $('th.checkboxWrapper').on('click', 'input, label', function (e) {
    e.stopPropagation();
  });
  $('th.checkboxWrapper input').click(function (e) {
    let that = this;
    let id = that.id;
    let url = $(that).data('url');
    let field = $(that).data('field');
    let ids = [];
    let value = 0;
    if (that.checked) {
      value = 1;
      $(that).parents('table').find('td input[id^=' + id + ']').each(function () {
        this.checked = true;
        ids.push($(this).val());
      });
    } else {
      $(that).parents('table').find('td input[id^=' + id + ']').each(function () {
        this.checked = false;
        ids.push($(this).val());
      });
    }
    const data = {
      'field': field,
      'ids': ids,
      'value': value
    };
    handleCheckboxAction(data, url);
  });
  $('td.checkboxWrapper input').click(function (e) {
    let url = $(this).data('url');
    let field = $(this).data('field');
    let ids = [];
    ids.push($(this).val());
    let value = 0;
    if (this.checked) {
      value = 1;
    }
    const data = {
      'field': field,
      'ids': ids,
      'value': value
    };
    handleCheckboxAction(data, url , $(this));

  });
  $('.sync-selected, .connect-selected').click(function (e) {
    let url = $(this).data('href');
    if (url) {
      $('#form-update-selected-content').html('');
      $('#form-update-selected').attr('action', url);
      let checked = false;
      $('#invoicesTable td.checkbox .checkInput input').each(function () {
        if (this.checked) {
          checked = true;
          $('#form-update-selected-content').append($(this).clone().removeAttr('id').hide());
        }
      });
      if (checked) {
        waitingDialog.show('Please wait...');
        $('#form-update-selected').submit();
      } else {
        alert('Please select rows.');
      }
    }
  });
  $('.sync-selected-receipt-fulfill').click(function (e) {
    let url = $(this).data('href');
    if (url) {
      $('#form-update-selected-content').html('');
      $('#form-update-selected').attr('action', url);
      let checked = false;
      $('#invoicesTable td.checkbox .checkInput input').each(function () {
        if (this.checked) {
          checked = true;
          $('#form-update-selected-content').append($(this).clone().removeAttr('id').hide());
        }
      });
      waitingDialog.show('Please wait...');
      $('#form-update-selected').submit();

    }
  });

  validateRequired();
  if($('.hs-datepicker').length){
    $('.hs-datepicker').datepicker();
  }
  if($('select.multiselect.multiselect-custom').length){
     $('select.multiselect.multiselect-custom').multiselect({
        buttonWidth: '400px',
        includeSelectAllOption: true
     });
  }

  $('.add-user-setting-relationship').submit(function (e) {
    e.preventDefault();
    var that = this;
    let leftType = $(this).find('#left_val').prop('type');
    let rightType = $(this).find('#right_val').prop('type');
    let leftVal = $(this).find('#left_val').val();
    let leftTitle = $(this).find('#left_title').val();
    let leftDataType = $(this).find('#left_data_type').val();
    let rightVal = $(this).find('#right_val').val();
    let rightTitle = $(this).find('#right_title').val();
    let rightDataType = $(this).find('#right_data_type').val();
    let doNotUnique = $(this).find('#do_not_unique').val();
    let relationshipModel = $(this).find('#relationship_collection_model').val();
    var relationshipTable = $(this).find('#relationship_table').val();
    if (leftType == 'select-one') {
      leftTitle = $("#left_val option:selected").html();
    } else {
      leftTitle = leftVal;
      leftVal = $.trim(leftVal);
      leftVal = leftVal.toLowerCase().replace(/\s/g, '_');
    }

    if (rightType == 'select-one') {
      rightTitle = $("#right_val option:selected").html();
    } else {
      rightTitle = rightVal;
      rightVal = $.trim(rightVal);
      rightVal = rightVal.toLowerCase().replace(/\s/g, '_');
    }
    if (doNotUnique) {
      doNotUnique = 0;
    }
    const data = {
      'left_val': leftVal,
      'left_title': leftTitle,
      'left_data_type': leftDataType,
      'right_val': rightVal,
      'right_title': rightTitle,
      'right_data_type': rightDataType,
      'do_not_unique': doNotUnique,
      'relationship_collection_model': relationshipModel
    };
    $(this).submitDataAjax({
      'url': '/add-user-setting-relationship',
      'method': 'POST',
      'data': data,
      'success': function success(res) {
        if (res.status === 200) {
          let data = res.data;
          if (relationshipTable) {
            let html = '<tr><td>' + data.left_title + '</td><td>' + data.right_title + '</td><td><a href="javascrript:;" class="remove-user-setting-relationship" data-href="/remove-user-setting-relationship?relationship_collection_model=' + relationshipModel + '&do_not_unique=' + doNotUnique + '&left_val=' + data.left_val + '&right_val=' + data.right_val + '">Remove</a></td></tr>';
            $('.' + relationshipTable + ' tbody').append(html);
            $(that).modal('hide');
            removeUserSettingRelationship();
          }
        }
      }
    });
  });

  $('.add-user-setting-relationship-netsuite').submit(function (e) {
    e.preventDefault();
    var that = this;
    let leftType = $(this).find('#left_val').prop('type');
    let rightType = $(this).find('#right_val').prop('type');
    let leftVal = $(this).find('#left_val').val();
    let leftTitle = $(this).find('#left_title').val();
    let leftDataType = $(this).find('#left_data_type').val();
    let rightVal = $(this).find('#right_val').val();
    let rightTitle = $(this).find('#right_title').val();
    let rightDataType = $(this).find('#right_data_type').val();
    let doNotUnique = $(this).find('#do_not_unique').val();
    let relationshipModel = $(this).find('#relationship_collection_model').val();
    var relationshipTable = $(this).find('#relationship_table').val();
    if (leftType == 'select-one') {
      leftTitle = $("#left_val option:selected").html();
    } else {
      leftTitle = leftVal;
      leftVal = $.trim(leftVal);
      leftVal = leftVal.toLowerCase().replace(/\s/g, '_');
    }

    if (rightType == 'select-one') {
      rightTitle = $("#right_val option:selected").html();
    } else {
      rightTitle = rightVal;
      rightVal = $.trim(rightVal);
      rightVal = rightVal.toLowerCase().replace(/\s/g, '_');
    }
    if (doNotUnique) {
      doNotUnique = 0;
    }
    const data = {
      'left_val': leftVal,
      'left_title': leftTitle,
      'left_data_type': leftDataType,
      'right_val': rightVal,
      'right_title': rightTitle,
      'right_data_type': rightDataType,
      'do_not_unique': doNotUnique,
      'relationship_collection_model': relationshipModel
    };
    $(this).submitDataAjax({
      'url': '/add-user-setting-relationship-netsuite',
      'method': 'GET',
      'data': data,
      'success': function success(res) {
        if (res.status === 200) {
          let data = res.data;
          if (relationshipTable) {
            let html = '<tr><td>' + data.left_title + '</td><td>' + data.right_title + '</td><td><a href="javascrript:;" class="remove-user-setting-relationship" data-href="/remove-user-setting-relationship?relationship_collection_model=' + relationshipModel + '&do_not_unique=' + doNotUnique + '&left_val=' + data.left_val + '&right_val=' + data.right_val + '">Remove</a></td></tr>';
            $('.' + relationshipTable + ' tbody').append(html);
            $(that).modal('hide');
            removeUserSettingRelationship();
          }
        }
      }
    });
  });

  function removeUserSettingRelationship() {
    $('.remove-user-setting-relationship').click(function () {
      var that = this;
      $(this).submitDataAjax({
        'url': $(that).data('href'),
        'method': 'GET',
        'success': function success(res) {
          if (res.status === 200) {
            $(that).parents('tr').remove();
          }
        }
      });
    });
  }

  $('input[min]').change(function (e) {
    e.preventDefault();
    let elm = e.target;
    let pattern = /(\d+)/;
    if (elm.value < 0 || !pattern.test(elm.value)) {
      $.nError(`This field must be greater than ${elm.min}`)
      elm.value = 0;
      $(elm).change();
    }
  });


  removeUserSettingRelationship();
  if($('select.update-user-setting-multiselect').length){
    let options = {
      enableFiltering : true,
      filterPlaceholder: 'Search ...',
      enableCaseInsensitiveFiltering: true,
      dropUp:false,
      maxHeight:300,
      templates : {
        filterClearBtn: '<div class="input-group-append"><button class="multiselect-clear-filter input-group-text" type="button"><i class="fa fa-times"></i></button></div>'
      },
      onChange: function (option, checked) {
        var that = this.$select;
        let hs_multiple = $(that).prop('multiple');
        const hs_separator = $(that).data('separator');
        const hs_data_type = $(that).data('type');
        let hs_empty_array = $(that).data('empty-array');
        if (hs_multiple == true) {
          hs_multiple = 1;
        } else {
          hs_multiple = 0;
        }
        if (hs_empty_array == true) {
          hs_empty_array = 1;
        } else {
          hs_empty_array = 0;
        }
        let keyType = $(that).attr('keyType');
        let hsVal = {};

        if (typeof keyType !== typeof undefined && keyType !== false) {
          hsVal[keyType] = $(that).val();
        } else {
          hsVal = $(that).val();
        }
        const data = {
          'hs_key': that.attr('id'),
          'hs_val': hsVal,
          'hs_multiple': hs_multiple,
          'hs_separator': hs_separator,
          'hs_data_type': hs_data_type,
          'is_map_field': keyType,
          'hs_empty_array' : hs_empty_array,
        };
        $(that).submitDataAjax({
          'url': '/update-user-setting',
          'method': 'POST',
          'data': data,
          'success': function success(res) {
            if (res.status === 200) {
              let item = $('#' + data['hs_key']).parents('td').find('.map-field-addition-setting');
              if (res.deleted === true) {
                item.addClass("d-none");
                item.find('select').prop('selectedIndex', 0);
              } else {
                item.removeClass("d-none");
              }
            }
          }
        });
      }
    };
    $('select.update-user-setting-multiselect').each(function(){
      // Get data options .... we can use select data to customize this select
      // option case in data should be enable_html for enableHtml
      let selectData = $(this).data();
      console.log(selectData);
      let selectOptions = {};
      for( var i in selectData) {
        if(i === 'multiselect') {
          continue;
        }
        let optionKey =  i.replace(/(\_\w)/g, m => m.toUpperCase()); // Capture all the letters after "_" and uppercase it
        optionKey = optionKey.replace(/(\_)/g, ''); // Capture all the  "_" and remove it
        selectOptions[optionKey] = selectData[i];
      }
      selectOptions = {...options , ...selectOptions }; // Merge with default options
      console.log(selectOptions);
      $(this).multiselect(selectOptions);
    });
  }
  if($('select.select-select2').length){
  $('select.select-select2').select2({
      ajax: {
        dataType: 'json',
        delay: 350,
        processResults: function (data, params) {
          params.page = params.page || 1;
          return {
            results: data.data,
            pagination: {
              more: params.page < data.last_page
            }
          };
        },
        data: function (params) {
          var query = {
            search: params.term,
            page: params.page || 1
          }
          // Query parameters will be ?search=[term]&page=[page]
          return query;
        }
      },
      width: '100%',
      minimumResultsForSearch: 10,
      closeOnSelect:false,
      allowClear:true,
      placeholder:'Please Select ...'
    });
  }

  let locations = {};
  $('.inventory-location').each((index, input) => {
    let spLocationId = input.name.replace('netsuite_inventory_', '');
    locations[spLocationId] = input.value;
  }).change((e) => {
    let spLocationId = e.target.name.replace('netsuite_inventory_', '');
    let id = Object.values(locations).find(id => parseInt(id) === parseInt(e.target.value));
    if (id !== undefined) {
      let location = $(e.target).children(':selected').text();
      alert(`${location} already selected. Please choose another location.`);
      e.target.value = "";
      $(e.target).trigger('change');
    } else {
      locations[spLocationId] = e.target.value;
    }
  });

  $('#modalShopForm').submit(function (e) {
    let modal = $('#modalShop');
    e.preventDefault();
    let form = new FormData(this);
    $(this).find('button[type=submit]').prop('disabled', true);
    let feedback = $(this).find('.invalid-feedback');
    feedback.prev('input').removeClass('is-invalid');
    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: form,
      processData: false,
      contentType: false,
      success: () => {
        this.reset();
        modal.modal('hide');
      },
      error: (res) => {
        feedback.text(res.responseJSON.message);
        feedback.prev('input').addClass('is-invalid');
      },
      complete: () => {
        $(this).find('button[type=submit]').prop('disabled', false);
      }
    });
  });
  $('#modalMappingBrandForm').submit(function (e) {
    let modal = $('#modalMappingBrand');
    e.preventDefault();
    let form = new FormData(this);
    $(this).find('button[type=submit]').prop('disabled', true);
    let feedback = $(this).find('.invalid-feedback');
    feedback.prev('input').removeClass('is-invalid');
    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: form,
      processData: false,
      contentType: false,
      success: (res) => {
        let html = '';
        let table = $('table[data-table=iconic_brand_custom_field]'),
            route = table.data('init-remove');
        route = route.substr(0, route.length - 1);
        for (let item of res) {
          html += `<tr>
                            <td>${item.iconic}</td>
                            <td>${item.netsuite}</td>
                            <td style="text-align: center">
                                <button data-remove="${route}${item.id}"
                                        class="btn btn-blue">Remove
                                </button>
                            </td>
                        </tr>`
        }
        table.find('tbody').html(html);
        modal.modal('hide');
      },
      error: (res) => {
        feedback.text(res.responseJSON.message);
        feedback.prev('input').addClass('is-invalid');
      },
      complete: () => {
        $(this).find('button[type=submit]').prop('disabled', false);
      }
    });
  });
  $('.select2-ajax').each((index, item) => {
    item = $(item);
    initSelect2(item);
  });
  $('.modal').on('show.bs.modal', function () {
    let form = $(this).find('form')[0];
    if (form) {
      form.reset()
    }
    let feedback = $(this).find('.invalid-feedback');
    if (feedback) {
      feedback.prev('input').removeClass('is-invalid');
    }
    if ($(this).find('select[data-select2-id]').length) {
      $(this).find('select[data-select2-id]').each((index, item) => {
        $(item).val(null).trigger('change');
      })
    }
  });

  $('*[data-dependency=true]').each(function (index, item) {
    $(item).change(function () {
      let item = $(`*[data-required-parent=${this.id}]`);
      item.select2('destroy');
      initSelect2(item);
    })
  });

  $(document).on('click', 'button[data-remove]', function () {
    $(this).prop('disabled', true);
    $.ajax({
      url: $(this).data('remove'),
      type: 'DELETE',
      processData: false,
      contentType: false,
      success: () => {
        $(this).parent()
            .parent().remove();
      },
      error: (res) => {
      },
      complete: () => {
        $(this).prop('disabled', false);
      }
    })
  })

  $('body').on('change', ".update-setting-group", function (event) {
    const ele = $(this);
    let hs_multiple = ele.prop('multiple');
    const hs_separator = ele.data('separator');
    const hsVal = ele.val();
    const hsGroup = ele.data('group');
    const hsLevel = ele.data('level');
    if (hs_multiple == true) {
      hs_multiple = 1;
    } else {
      hs_multiple = 0;
    }
    const data = {
      hs_key: this.id,
      hs_val: hsVal,
      hs_group: hsGroup,
      hs_level: hsLevel,
      hs_separator: hs_separator,
      hs_multiple: hs_multiple
    };
    ele.submitDataAjax({
      'url': '/update-user-setting-group',
      'method': 'POST',
      'data': data,
      'success': function success(res) {
        if (res.status === 200) {
          $(`[data-group=${hsGroup}]`).each(function (index, item) {

            if ($(item).data('level') > hsLevel) {
              $(item).val('');
              if ($(item).data('url')) {
                item.options = [];
              }
            }
          });
          const nextLevel = hsLevel + 1;
          const nextElement = $(`[data-group=${hsGroup}][data-level=${nextLevel}]`);
          if (nextElement.length && nextElement.data('url')) {
            nextElement.submitDataAjax({
              url: nextElement.data('url'),
              data: {group: hsGroup, level: nextLevel, parent_value: hsVal},
              success: function (result) {
                if (result.status === 200) {
                  let options = '';
                  for (var i in result.results) {
                    options += `<option value="${i}">${result.results[i]}</option>`;
                  }
                  nextElement.html(options);
                }
              }
            });
          }
        }
      }
    });
  });

  $('.add-user-setting-mapping').submit(function (e) {
    e.preventDefault();
    var ele = $(e.target);
    var mappingKey = ele.data('mapping_key');
    var dataType = ele.data('right_value_type');
    var deleteEmpty = ele.data('delete_empty') || 1;
    var group = ele.data('group');
    var leftInput = $('#' + mappingKey + 'left_value');
    var leftValue = leftInput.val();
    if (leftInput.hasClass('text-lowercase')) {
      leftValue = leftValue.toLowerCase();
    }
    var leftTitle = $('#' + mappingKey + 'left_value option:selected').html() || leftValue;
    var leftDefaultValue = leftInput.find("option:first-child").val() || "";
    var rightDefaultValue = "";
    if (group) {
      var rightValue = {};
      var rightTitle = {};
      var groupInputs = ele.find('.setting-mapping-group-input');
      groupInputs.each(function () {
        var item = $(this);
        rightDefaultValue = item.find("option:first-child").val() || "";
        var itemLevel = item.data('level');
        rightValue[itemLevel] = item.val();
        if (item.val()) {
          rightTitle[itemLevel] = item.find('option:selected').html() || item.val();
        } else {
          rightTitle[itemLevel] = '';
        }

      });
    } else {
      var rightInput = $('#' + mappingKey + 'right_value');
      rightDefaultValue = rightInput.find("option:first-child").val() || "";
      var rightValue = rightInput.val();
      if (rightValue) {
            if($.isArray(rightValue)){
                if($.inArray( 'all', rightValue ) != -1){
                    rightValue = ['all'];
                    var rightTitle = 'Select All';
                }else{
                    if($('#' + mappingKey + 'right_value option:selected').length > 1){
                        var rightTitle = '';
                        $('#' + mappingKey + 'right_value option:selected').each(function(){
                            if(rightTitle){
                                rightTitle = rightTitle + ', ' + $(this).html();
                            }else{
                                rightTitle = $(this).html();
                            }
                        });
                    }else{
                        var rightTitle = $('#' + mappingKey + 'right_value option:selected').html() || rightValue;
                    }
                }
            }else{
                 var rightTitle = $('#' + mappingKey + 'right_value option:selected').html() || rightValue;
            }
      } else {
        var rightTitle = '';
      }
    }
    var table = $("#table_setting_mapping_" + mappingKey);
    var isDelete = deleteEmpty && !rightValue;
    if (!leftValue || (leftInput[0].tagName.toLowerCase() === 'select' && leftValue === '0')) {
      return;
    }
    if (mappingKey == 'netsuite_order_shipping_address_custom_mapping') {
      var checkAddress = rightValue.split('\n');
      if (checkAddress.length < 6) {
        $.nError('Your entry is missing required fields.');
        return;
      }
    }
    const data = {
      mapping_key: mappingKey,
      left_value: leftValue,
      left_title: leftTitle,
      right_value: rightValue,
      right_title: rightTitle,
      delete_empty: deleteEmpty,
      hs_data_type: dataType
    };
    $(this).submitDataAjax({
      url: '/add-user-setting-mapping',
      method: 'POST',
      data: data,
      dataType: 'json',
      success: function (res) {
        ele.modal('hide');
        leftInput.val(leftDefaultValue).trigger("change");
        if (group) {
          $(".setting-mapping-group-input").val(rightDefaultValue).trigger("change");
        } else {
          rightInput.val(rightDefaultValue).trigger("change");
        }
        if (res.status === 200) {
          if (isDelete) {
            table.find("tr.mapping-row[data-mapping_key='" + mappingKey + "'][data-left_value='" + leftValue + "']").remove();
          } else {
            appendSettingMapping(table, data, group);
          }
        }
      }
    });
  });

  $(".setting-mapping-group-input").change(function (event) {
    var ele = $(this);
    var level = ele.data('level');
    if(isNaN(level)) {
      return;
    }
    var table = ele.parents('table.table');
    table.find('.setting-mapping-group-input').each(function () {
      if ($(this).data('level') > level) {
        $(this).html('<option value="">Please Select ...</option>').val("").trigger("change");
      }
    });
    var nextLevel = level + 1;
    var nextInput = table.find(`.setting-mapping-group-input[data-level=${nextLevel}]`);
    if (nextInput.length) {
      nextInput.submitDataAjax({
        url: nextInput.data('url'),
        data: {level: nextLevel, parent_value: ele.val()},
        success: function (result) {
          if (result.status === 200) {
            let options = '';
            for (var i in result.results) {
              options += `<option value="${i == 0 ? '' : i}">${result.results[i]}</option>`;
            }
            nextInput.html(options);
          }
        }
      });
    }
  });

  if($('select.local-select2').length){
    $('select.local-select2').select2({
      dropdownAutoWidth: true,
      closeOnSelect:false,
    });
  }

  $('.text-lowercase').on('keyUp', function () {
    this.value = this.value.toLowerCase();
  });

  $('.nav.nav-tabs li').on('click', function () {
    $(this).parent('ul').find('>li').removeClass('active');
    $(this).addClass('active');
  });

  $('.netsuite-custom-field').on('change', function () {
    var ele = $(this);
    var group = ele.data('group');
    var groupName = ele.data('name');
    if (!ele.val() || ele.val() === "0") {
      $(`.netsuite-custom-field-value[data-parent=${group}]`).remove();
    } else {
      ele.submitDataAjax({
        url: '/netsuite/custom-field-input-value',
        data: {id: ele.val()},
        success: function (result) {
          result.group = group;
          result.groupName = groupName;
          applyNSCustomFieldInputValue(result);
        }
      });
    }
  });

  $('#invoicesTable').on('change' , '.update-gift-card-shopify-id' , function(){
    var ele = $(this);
    ele.submitDataAjax({
      url : ele.data('url'),
      method:'post',
      data:{
        id : ele.data('id'),
        shopify_id : ele.val()
      },
      success:function(){}
    });
  });

  $('.file-upload-modal-link').click(function(){
    var href = $(this).data('href');
    var accept = $(this).data('accept');
    var format = $(this).data('format');
    var note = $(this).data('note');
    var dialogClass = $(this).data('dialogclass');
    var successMessage = $(this).data('successmessage');
    var modalTitle = $(this).data('modaltitle');
    $('#fileUploadModal form#fileUploadModalForm').attr('action', href);
    $('#fileUploadModal a#fileUploadModalSampleFile').attr('href', format);
    if(accept){
        $('#fileUploadModal input#file_from_modal').attr('accept', accept);
    }
    $('#fileUploadModal label#fileUploadModalNote').html(note);
    if(dialogClass){
        $('#fileUploadModal .modal-dialog').addClass(dialogClass);
    }
    if(successMessage){
         $('#fileUploadModal #successMessage').html(successMessage);
    }else{
         $('#fileUploadModal #successMessage').html('');
    }
    if(modalTitle){
        $('#fileUploadModal #fileUploadModalTitle').html(modalTitle);
    }else{
        $('#fileUploadModal #fileUploadModalTitle').html('');
    }
  });
  $('#fileUploadModalSubmit').click(function(){
    if( document.getElementById("file_from_modal").files.length == 0 ){
      alert('Please select a file.');
      return false;
    }
    $('#fileUploadModal').modal('hide');
    var successMessage = $('#fileUploadModal #successMessage').html();
    waitingDialog.show('Please wait...');
    $('#fileUploadModalForm').ajaxSubmit({
      error: function(res) {
        window.location.reload();
      },
      success: function(res) {
            if(successMessage){
                alert(successMessage);
            }else{
                alert('Existing products have been connected successfully.');
            }
        window.location.reload();
      }
    });
  });

  $('.datatable-filter:not([type=radio])').on('change' , datatableChange);

  $('.datatable-filter[type=radio]').on('click' , function (event){
    const checked = $(this).attr('ischecked') === 'true';
    if(checked) {
      $(this).removeAttr('checked').prop('checked' , false);
      $(this).attr('ischecked' , 'false');
    }
    else {
      $(this).prop('checked' , true);
      $(this).attr('ischecked' , 'true');
    }
    datatableChange();
  });
  $('.js-remove-item').click(function () {
    const id = $(this).data('itemId');
    const ids = [id];
    processItems(ids, 'delete');
  });

  $('.js-remove-items').click(function () {
    let ids = getValueCheckboxSelected('.listItemids');
    if (ids.length) {
      processItems(ids, 'delete');
    } else {
      alert('Please select at least one user');
    }
  });
  $('.js-disable-items').click(function () {
    let ids = getValueCheckboxSelected('.listItemids');
    if (ids.length) {
      processItems(ids, 'disable');
    } else {
      alert('Please select at least one user');
    }
  });
  $('.js-enable-items').click(function () {
    let ids = getValueCheckboxSelected('.listItemids');
    if (ids.length) {
      processItems(ids, 'enable');
    } else {
      alert('Please select at least one user');
    }
  });

  $('select.bs-multiselect').multiselect({
    enableFiltering : true,
    filterPlaceholder: 'Search ...',
    enableCaseInsensitiveFiltering: true,
    dropUp:false,
    maxHeight:300,
    templates : {
      filterClearBtn: '<div class="input-group-append"><button class="multiselect-clear-filter input-group-text" type="button"><i class="fa fa-times"></i></button></div>'
    },
  });
  $('.select-date-modal-link').click(function(){
    var href = $(this).data('href');
    var note = $(this).data('note');
    var dialogClass = $(this).data('dialogclass');
    var successMessage = $(this).data('successmessage');
    var modalTitle = $(this).data('modaltitle');
    $('#selectDateModal form#selectDateModalForm').attr('action', href);
    $('#fileUploadModal label#selectDateModalNote').html(note);
    if(dialogClass){
        $('#selectDateModal .modal-dialog').addClass(dialogClass);
    }
    if(successMessage){
         $('#selectDateModal #selectDateModalMessage').html(successMessage);
    }else{
         $('#selectDateModal #selectDateModalMessage').html('');
    }
    if(modalTitle){
        $('#selectDateModal #selectDateModalTitle').html(modalTitle);
    }else{
        $('#selectDateModal #selectDateModalTitle').html('');
    }
  });
  $('#selectDateModalSubmit').click(function(){
    var validDate = validateDate(document.getElementById("selectDateModalInput").value);
    if(!validDate){
        alert('Please select a date.');
        return false;
    }
    $('#selectDateModal').modal('hide');
    var successMessage = $('#selectDateModal #selectDateModalMessage').html();
    waitingDialog.show('Please wait...');
    $('#selectDateModalForm').ajaxSubmit({
      error: function(res) {
        var errorMessage = res.responseText;
        alert(errorMessage);
        window.location.reload();
      },
      success: function(res) {
        if(successMessage){
            alert(successMessage);
        }
        window.location.reload();
      }
    });
  });

  // Support right input is select
  $('.setting-mapping-one-one').on('change' , '.setting-mapping-one-one-input' , function(event){
    let input = $(event.target);
    let container = input.parents('.setting-mapping-one-one');
    let mappingKey = container.data('key');
    let dataType = container.data('data-type');
    let leftValue = input.data('left-value');
    let leftTitle = input.data('left-title');
    let rightValue = input.val();
    let rightTitle = input.find('option:selected').html() || rightValue;
    if(rightValue) {
      let exist = false;
      container.find(`.setting-mapping-one-one-input[data-left-value!=${leftValue}]`).each(function(){
        if(this.value === rightValue) {
          exist = true;
          return false; // break jquery each
        }
      });
      if(exist) {
        alert('This option have been selected.');
        input.val('');
        if(/select2/.test(input.attr('class'))) {
          input.select2();
        }
        return false;
      }
    }
    const data = {
      mapping_key: mappingKey,
      left_value: leftValue,
      left_title: leftTitle,
      right_value: rightValue,
      right_title: rightTitle,
      delete_empty: 1,
      hs_data_type: dataType
    };
    $(this).submitDataAjax({
      url: '/add-user-setting-mapping',
      method: 'POST',
      data: data,
      dataType: 'json',
      success: function (res) {

      },
      error : function(){
        window.location.href = window.location.href;
      }
    });
  });
});

function getValueCheckboxSelected(element) {
  let arrayValue = [];
  $(element+':checked').each(function(){
    const id = $(this).val();
    arrayValue.push(id);
  });
  return arrayValue;
}

function processItems(ids, type) {
  let url = '';
  if (type == 'delete') {
    url = routeRemoveItems;
  } else {
    url = routeUpdateStatusItems;
  }
  if (confirm('Are you sure you want to ' + type + '?')) {
    $(this).submitDataAjax({
      'url': url,
      'method': 'POST',
      'data': {'ids': ids, 'type': type},
      'success': function success(res) {
        if (res.status === 200) {
          window.location.reload();
        }
      }
    });
  }
}

function appendSettingMapping($table, $data, $group) {
  $data.left_title = $data.left_title.replace(/\n/g, '<br>\n');
  if (!$group) {
    $data.right_title = $data.right_title.replace(/\n/g, '<br>\n');
  }
  var exists = $table.find("tr.mapping-row[data-mapping_key='" + $data.mapping_key + "'][data-left_value='" + $data.left_value + "']");
  if (exists.length) {
    if ($group) {
      var index = 1;
      for (i in $data.right_title) {
        exists.children().eq(index).html($data.right_title[i] || "");
        index++;
      }
    } else {
      exists.children().eq(1).html($data.right_title);
    }
  } else {
    var tr = $('<tr class="mapping-row" data-mapping_key="' + $data.mapping_key + '" data-left_value="' + $data.left_value + '"></tr>"');
    tr.append('<td>' + $data.left_title + '</td>');
    if ($group) {
      for (i in $data.right_title) {
        tr.append('<td>' + $data.right_title[i] + '</td>');
      }
    } else {
      tr.append('<td>' + $data.right_title + '</td>');
    }
    tr.append('<td><a href="javascript:void(0);" onclick="removeSettingMapping(this)">Remove</a></td>');
    $table.find("tbody").append(tr);
  }
}

function removeSettingMapping(ele) {
  var row = $(ele).parents('tr.mapping-row');
  var data = row.data();
  data.action = 'delete';
  $(this).submitDataAjax({
    url: '/add-user-setting-mapping',
    method: 'POST',
    data: data,
    dataType: 'json',
    success: function (res) {
      if (res.status === 200) {
        row.remove();
      }
    }
  });
}

function initSelect2(item) {
  let idField = item.data('id'),
      textField = item.data('text'),
      url = item.data('r-select2'),
      limit = item.data('limit') | 15,
      filters = item.data('filters'),
      from = item.data('from');
  console.log(filters);
  if (from && idField && textField && url) {
    filters = parseFilters(filters);
    item.select2({
      ajax: {
        url,
        dataType: 'json',
        delay: 250,
        data: (params) => {
          return {
            q: params.term,
            from,
            filters,
            key: idField,
            value: textField,
            page: params.page
          };
        },
        processResults: function (data, params) {
          params.page = params.page || 1;
          return {
            results: $.map(data.data, function (item) {
              return {
                text: item[textField],
                id: item[idField]
              }
            }),
            pagination: {
              more: (params.page * limit) < data.total
            }
          };
        },
      }
    });
  }
}

function parseFilters(filters) {
  if (!filters) filters = {};
  filters = JSON.parse(JSON.stringify(filters));
  for (const key of Object.keys(filters)) {
    let pattern = /^#(.+)/;
    if (pattern.test(filters[key])) {
      filters[key] = $(filters[key]).val();
    }
  }
  return JSON.stringify(filters);
}

function buildNSCustomFieldInputValue($data) {
  var row = $(`<div class="row dependency-div show netsuite-custom-field-value" data-parent="${$data.group}" data-show="1">
        <div class="col-md-12">
            <div class="form-group">
                <label for="${$data.group}_value">${$data.groupName} value: </label>

            </div>
        </div>
    </div>`);
  var input = $(`<input type="text" name="${$data.group}_value"
            id="${$data.group}_value"
            data-group="${$data.group}"
            data-level="3" class="form-control update-setting-group " accept="">`);
  if ($data.type === 'select') {
    input = $(`<select data-group="${$data.group}" data-level="3"
                name="${$data.group}_value" id="${$data.group}_value"
                class="form-control update-setting-group"></select>`);
    var defaultValue = false;
    for (var i in $data.values) {
      if (defaultValue === false) {
        defaultValue = i;
      }
      var option = $(`<option value="${i}">${$data.values[i]}</option>`);
      if (defaultValue === i) {
        option.prop('selected', 'selected');
      }
      input.append(option);
    }
  }
  row.find('.form-group').append(input);
  return row;
}

function applyNSCustomFieldInputValue($data) {
  var inputId = $data.group + '_value';
  // Check exists
  var input = $('#' + inputId);
  var newInput = buildNSCustomFieldInputValue($data);
  if (input.length) {
    input.parents('.netsuite-custom-field-value').replaceWith(newInput);
  } else {
    var container = $('.netsuite-custom-field-container[data-group="' + $data.group + '"]');
    container.append(newInput);
  }
}

function buildSettingMenu() {
  var numberMenu = 4;
  if(window.innerWidth < 1000) {
    numberMenu = 3;
  }
  if(window.innerWidth < 780) {
    numberMenu = 2;
  }
  if(window.innerWidth < 450) {
    numberMenu = 1;
  }
  if(numberMenu === currentNumberMenu){
    return;
  }
  else {
    currentNumberMenu = numberMenu;
  }
  console.log('start build menu carousel');
  var counter = 0;
  var items = [];
  var item;
  var keys = Object.keys(settingMenus);
  for (var key in settingMenus) {
    if (counter % numberMenu === 0) {
      item = $('<li class="carousel-item" style="width:100%"><ul data-target="#setting-menu" data-slide-to="0"></ul></li>');
    }
    var menu = settingMenus[key];
    var nav = $('<li class="' + (menu.current ? 'current' : '') + '"></li>');
    var link;
    if(menu.current) {
      item.addClass('active');
    }
    if(menu.disabled) {
      link = $('<a href="javascript:;" data-toggle="modal" data-target="#generalNotActive" title="'+menu.title+'">'+menu.label+'</a>');
    }
    else {
      link = $('<a href="' + menu.href + '" title="'+menu.title+'">'+menu.label+'</a>');
    }
    nav.append(link);
    item.find('ul').append(nav);
    counter++;
    if((counter !== 0 && counter % numberMenu === 0) || counter === keys.length - 1){
      items.push(item);
    }
  }
  $('#setting-menu>ul').html('');
  for(var i =0 ; i < items.length ; i++) {
    $('#setting-menu>ul').append(items[i]);
  }
  $('#setting-menu').carousel('dispose');
  $('#setting-menu').carousel({interval: 0});
}

function getDataTableParams(){
  const weborder = $("#filterWebOrder").prop("checked") === true ? 1 : 0;
  const params = {
    'page': $('.current_page').val(),
    'current_tab': $('#current_tab').val(),
    'limit': $('select.limit-changed').val(),
    'keywords': $('#nameFilter,#keywords').val(),
    'weborder': weborder,
    'sort_column': $('#sort_column').val(),
    'sort_field': $('#sort_field').val(),
    'sort_order': $('#sort_order').val(),
  };
  $('.datatable-filter').each(function(){
    if(this.type === 'radio' || this.type === 'checkbox') {
      params[this.name] = this.checked ? 1 : null;
    }
    else {
      params[this.name] = $(this).val();
    }
  });
  return params;
}

function datatableChange(){
  const params = getDataTableParams();
  const strParam = $.param(params);
  //change url browser
  const newUrl = $('.paginateCustom #path').val() + '?' + strParam;
  window.location.href = newUrl;
}

function downloadURI(uri, name) {
  var link = document.createElement("a");
  // If you don't know the name or want to use
  // the webserver default set name = ''
  link.setAttribute('download', name);
  link.href = uri;
  document.body.appendChild(link);
  link.click();
  link.remove();
}

$('.franchise_update_setting').click(function(e) {
    let url = $(this).data('href');
    if (url) {
        waitingDialog.show('Please wait...');
        const ele = $(this);
        let data = {};
        $('.update-user-setting-custom').each(function() {
            let id = $(this).attr('name');
            let obj = get_data_setting("#" + id);
            data[id] = obj;
        })
        $('.franchise_update_setting_result').html('');
        $.ajax({
            'url': '/web-store/franchise/update',
            'type': 'POST',
            'data': data,
            'success': function success(res) {
                waitingDialog.hide();
                if (res.status === 200) {
                    $.notify({
                        type: 'success',
                        message: res.message,
                    });
                }
                if (res.status === 422) {
                    $.notify({
                        type: 'danger',
                        message: res.message,
                    });
                }
            }
        });
    }
});

function get_data_setting(e) {
    let ele = $(e);
    let validate = true;
    const validate_rule = ele.data('rule');
    switch (validate_rule) {
        case 'email':
            validate = !ele.val() || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(ele.val());
    }
    if (validate) {
        ele.removeClass('error');
    } else {
        ele.addClass('error');
        return;
    }
    let hs_multiple = ele.prop('multiple');
    const hs_separator = ele.data('separator');
    const hs_data_type = ele.data('type');
    const with_option_text = ele.data('with_option_text');
    if (hs_multiple == true) {
        hs_multiple = 1;
    } else {
        hs_multiple = 0;
    }
    let keyType = ele.attr('keyType');
    let hsVal = {};
    let hsTitle = {};

    if (typeof keyType !== typeof undefined && keyType !== false) {
        hsVal[keyType] = ele.val();
    } else {
        hsVal = ele.val();
    }

    if (with_option_text) {
        ele.find("option").each(function(index, item) {
            if (hsVal === item.value || ($.isArray(hsVal) && hsVal.indexOf(item.value) >= 0)) {
                hsTitle[item.value] = item.text;
            }
        });
    }
    const data = {
        'hs_key': ele.attr('id'),
        'hs_val': hsVal,
        'hs_title': hsTitle,
        'hs_multiple': hs_multiple,
        'hs_separator': hs_separator,
        'hs_data_type': hs_data_type,
        'is_map_field': keyType,
        'validate_rule': validate_rule,
    };
    return data;
}

function validateDate(date) {
    var matches = /^(\d{4})[-\/](\d{2})[-\/](\d{2})$/.exec(date);
    if (matches == null) return false;
    var d = matches[3];
    var m = matches[2] - 1;
    var y = matches[1] ;
    var composedDate = new Date(y, m, d);
    return composedDate.getDate() == d &&
            composedDate.getMonth() == m &&
            composedDate.getFullYear() == y;
}

function validateRequired() {
  $('.validation_required').each(function (e) {
    let url = $(this).data('url');
    if (url) {
      $('#form-update-selected-content').html('');
      $('#form-update-selected').attr('action', url);
      $('#invoicesTable td.checkbox .checkInput input').each(function () {
        $('#form-update-selected-content').append($(this).clone().removeAttr('id').attr('checked', 'checked').hide());
      });
      $('#form-update-selected').ajaxSubmit({
        dataType: 'json',
        success: function (res) {
          if (res.status === 200) {
            let inValidClass = res.inValidClass;
            if (res.ids != 'undefined' && res.ids) {
              $('#invoicesTable td.checkbox .checkInput input').each(function () {
                let id = $(this).val();
                if ($.inArray(id, res.ids) != -1) {
                  $(this).parents('tr').addClass(inValidClass);
                } else {
                  $(this).parents('tr').removeClass(inValidClass);
                }
              });
            } else {
              $('#invoicesTable td.checkbox .checkInput input').each(function () {
                $(this).parents('tr').removeClass(inValidClass);
              });
            }
          }
        }
      });
    }
  })
}
