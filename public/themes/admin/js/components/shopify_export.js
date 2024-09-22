$(document).ready(function () {
  shopify.setFields(shopify_filter_fields || []);
  shopify.setData(shopify_filter_select_data || {});
  shopify.setHeaders(shopify_export_headers || []);
  shopify.init();
});


const ShopifyExport = function ($fields, $headers) {
  const self = this;
  this.__toOperator = ' - ';
  this.operators = {
    'string': ['contain', 'is', 'start with', 'end with'],
    'number': ['=', '>', '>=', '<', '<='],
    'date': ['is', 'before', 'after'],
    'select': ['is', 'is not'],
    'select-multiple': ['in', 'not in']
  };
  this.format = 'MMM DD , YYYY';
  this.startDate = moment().subtract(90, 'd');
  this.endDate = moment();
  this.fields = $fields || [];
  this.defaultFields = this.fields.filter(function (item) {
    return item['default'];
  });
  this.headers = $headers || [];
  this.__selectData = {};
  this.setFields = function ($fields) {
    this.fields = $fields;
    this.defaultFields = this.fields.filter(function (item) {
      return item['default'];
    });
  };
  this.setHeaders = function ($headers) {
    this.headers = $headers;
  };
  this.setData = function($data , $key){
    if($key) {
      this.__selectData[$key] = $data;
    }
    else {
      this.__selectData = $data;
    }
  };
  this.container = $('#shopify_export_order');
  this.fieldsContainer = $('#shopify_export_order .filter-wrapper');
  this.headerSelect = $('#shopify_export_order #export_headers');
  this.headerSelectedContainer = $('#shopify_export_order #export_selected_headers');
  this.__select2Options = function ($field) {
    let options = {
      width: '100%',
      minimumResultsForSearch: 10,
      closeOnSelect: true
    };
    if ($field['href']) {
      options.ajax = {
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
          let query = {
            q: params.term,
            search: params.term,
            page: params.page || 1
          }
          return query;
        }
      };
    }
    options.data = self.__getSelectData($field);
    return options;
  };
  this.__getSelectData = function($field){
    let result = [];
    if ($field['data'] instanceof Array) {
      $field['data'].forEach(function (item) {
        if(item instanceof Object) {
          result.push({id:item.id , text : item.text });
        }
        else {
          result.push({id:item , text : item });
        }
      });
    }
    if ($field['data'] instanceof Object) {
      for (let key in $field['data']) {
        result.push({id:key , text : $field['data'][key] });
      }
    }
    if(typeof $field['data'] === 'string') {
      let _data = self.__selectData[$field['data']];
      if (_data instanceof Array) {
        _data.forEach(function (item) {
          if(item instanceof Object) {
            result.push({id:item.id , text : item.text });
          }
          else {
            result.push({id:item , text : item });
          }
        });
      }
      if (_data instanceof Object) {
        for (let key in _data) {
          result.push({id:key , text : _data[key] });
        }
      }
    }
    return result;
  };
  this.__dateRangeOptions = function () {
    return {
      minDate: self.startDate,
      maxDate: self.endDate,
      startDate: self.startDate,
      endDate: self.endDate,
      locale: {
        format: self.format
      }
    };
  };
  this.__dateRangeCallback = function (start, end) {
    this.element.attr('value', start.format(self.format) + self.__toOperator + end.format(self.format));
  };
  this.__addField = function ($field, $operator) {
    const type = $field['type'] || 'string';
    const row = $('<div class="field-row" data-field="' + $field['field'] + '"></div>');
    if (!$operator && $field['new_operator']) {
      $operator = $field['new_operator'];
    }
    row.append('<label>' + $field['label'] + ' :</label>');
    if (['date-range'].indexOf(type) === -1) {
      row.append(this.__getOperatorInput(type, $operator));
    }
    row.append(this.__getValueInput($field));
    if (type === 'date') {
      row.find('.filter-value').datepicker({
        format: self.format
      });
    }
    if (type === 'select' || type === 'select-multiple') {
      let options = self.__select2Options($field);
      options.dropdownParent = row;
      row.find('.filter-value').select2(options);
    }
    if (type === 'date-range') {
      row.find('.filter-value')
        .attr('value', self.startDate.format(self.format) + self.__toOperator + self.endDate.format(self.format));
      row.find('.filter-value').daterangepicker(this.__dateRangeOptions(), this.__dateRangeCallback);
    } else if ($field['default_value'] !== '' && $field['default_value'] !== null) {
      row.find('.filter-value').attr('value', $field['default_value']);
    }
    row.append('<span class="filter-remove"><i class="fa fa-times"></i></span>');
    self.fieldsContainer.append(row);
  };

  this.__getOperatorInput = function ($type, $operator) {
    const operators = this.operators[$type] ?? null;
    if (operators) {
      const selector = $('<select class="filter-operator"></select>');
      operators.forEach(function (item) {
        selector.append('<option value="' + item + ' " ' + (item === $operator ? 'selected' : '') + '>' + item + '</option>');
      });
      return selector;
    }
    return '';
  };

  this.__getValueInput = function ($field) {
    const type = $field['type'];
    let multiple = '';
    switch (type) {
      case 'date-range' :
        return '<input class="date-range filter-value" />';
      case 'date' :
        return '<input class="date-picker filter-value" />';
      case 'number':
        return '<input class="filter-value" type="number" />';
      case 'select-multiple':
        multiple = ' multiple ';
      case 'select':
        let inputData = '';
        if ($field['href']) {
          inputData = ' data-ajax--url="' + $field['href'] + '" data-placeholder="Please Select ..."';
        }
        let input = $('<select class="filter-value '+ ($field['href'] ? 'ajax' : 'local') +'" ' + inputData + (multiple || '') + '></select>');

        return input;
      default :
        return '<input class="filter-value" />';
    }
    return '';
  };
  this.__buildDefault = function () {
    self.defaultFields.forEach(function (item) {
      const defaultOperators = item['default_operators'];
      if (defaultOperators instanceof Array) {
        defaultOperators.forEach(function (operator) {
          self.__addField(item, operator);
        });
      } else {
        self.__addField(item, defaultOperators);
      }
    });
  };

  this.__buildHeader = function () {
    // self.headerSelect.html('').multiselect('destroy');
    self.headerSelectedContainer.html('');
    self.headers.forEach(function ($item) {
      self.headerSelect.append('<option value="' + $item['field'] + '" ' + ($item['selected'] ? 'selected' : '') + '>' + $item['label'] + '</option>');
      if ($item['selected']) {
        self.headerSelectedContainer.append('<li data-field="' + $item['field'] + '">' + $item['label'] + '</li>');
      }
    });
    self.headerSelect.multiselect({
      onChange: self.__headerChange,
      enableFiltering: true,
      includeSelectAllOption: true,
      buttonWidth: '100%',
      filterPlaceholder: 'Search ...',
      enableCaseInsensitiveFiltering: true
    });
    self.headerSelectedContainer.sortable();
  };

  this.__headerChange = function (option, checked) {
    if(!option) {
      if(checked) {
        self.headerSelect.find('option').each(function(){
          if(!self.headerSelectedContainer.find('[data-field="'+this.value+'"]').length){
            self.headerSelectedContainer.append('<li data-field="' + this.value + '">' + this.text + '</li>');
          }
        });
      }
      else {
        self.headerSelectedContainer.empty();
      }
    }
    else {
      let value = option[0].value;
      if (checked) {
        self.headerSelectedContainer.append('<li data-field="' + value + '">' + option[0].text + '</li>');
      } else {
        self.headerSelectedContainer.find('[data-field="' + value + '"]').remove();
      }
    }
  };

  this.__resetSelectData = function(){
    $('#shopify_export_order').find('.filter-value.local').each(function(){
      let ele = $(this);
      let _field = ele.parents('.field-row').data('field');
      let field = self.fields.find(function (item){
        return item.field === _field;
      });
      let _options = self.__select2Options(field);
      let _data = self.__getSelectData(field);
      console.log(field , _options.data , _data);
      ele.select2(_options);
    });
  };

  this.init = function () {
    $('#shopify_export_order').on('click', '.filter-wrapper .field-row span.filter-remove', function () {
      $(this).parents('.field-row').remove();
    });

    $('#shopify_export_order').on('shown.bs.modal', function () {
      self.headerSelect.multiselect('refresh');
      self.container.find('.multiselect-clear-filter i').attr('class', 'fa fa-times');
      self.container.find('.field-row select').each(function(){
        let ele = $(this);
        if(ele.data('old')) {
          ele.empty();
          ele.append(ele.data('old'));
          ele.select2(self.__select2Options({href : ele.data('ajax--url')}));
        }
      });
      self.__resetSelectData();
    });

    $('#shopify_filter_fields').select2({
      dropdownParent: $('#shopify_export_order #shopify_filter_fields_wrapper'),
      width:'100%'
    });

    $('#shopify_filter_fields_wrapper button').on('click', function () {
      const value = $('#shopify_filter_fields').val();
      $('#shopify_filter_fields').select2('val', " ");
      $('#shopify_filter_fields_wrapper .select2-container').toggle();
      if (value) {
        const field = self.fields.find(function (item) {
          return item['field'] === value;
        });
        self.__addField(field);
      }
    });
    $('#shopify_filter_fields_wrapper .select2-container').hide();
    $('#shopify_export_order #btn_export_order').on('click', function(){
      self.export('csv');
    });
    $('#shopify_export_order #btn_export_order_pdf').on('click', function(){
      self.export('pdf');
    });
    this.__buildDefault();
    this.__buildHeader();
  };

  this.__parseFilters = function () {
    const fields = $('#shopify_export_order .filter-wrapper .field-row');
    const filters = [];
    fields.each(function () {
      const filter = $(this);
      const fieldName = filter.data('field');
      const field = self.fields.find(function (item) {
        return item['field'] === fieldName;
      });
      let operator = filter.find('.filter-operator').val()
      filter.find('.filter-operator option[value="' + operator + '"]').attr('selected', true);
      let valueInput = filter.find('.filter-value');
      let value = valueInput.val() + "";
      if (valueInput.prop('tagName') === 'SELECT') {
        let data = [];
        valueInput.find('option:selected').each(function () {
          data.push('<option value="' + this.value + '" selected>' + this.text + '</option>');
        });
        valueInput.data('old' , data);
      }
      else {
        valueInput.attr('value' , value);
      }
      if (!value) {
        return;
      }
      if (field['type'] === 'date-range') {
        let values = value.split(self.__toOperator);
        filters.push({
          field: filter.data('field'),
          operator: '>=',
          value: moment(values[0], self.format).format('YYYY-MM-DD'),
        });
        filters.push({
          field: filter.data('field'),
          operator: '<=',
          value: moment(values[1], self.format).format('YYYY-MM-DD'),
        });
      } else if (field['type'] === 'date') {
        filters.push({
          field: filter.data('field'),
          operator: '<=',
          value: moment(value, self.format).format('YYYY-MM-DD'),
        });
      } else {
        filters.push({
          field: filter.data('field'),
          operator: operator,
          value: value,
        });
      }
    });
    return filters;
  };

  this.__parseHeaders = function () {
    let headers = [];
    self.headerSelectedContainer.find('li').each(function () {
      headers.push({
        'field': $(this).data('field'),
        'label': $(this).text()
      });
    });
    return headers;
  }

  this.export = function ($type) {
    const data = {
      filters: self.__parseFilters(),
      headers: self.__parseHeaders(),
      _token: $('#shopify_export_order form input[name=_token]').val(),
      type : $type
    };
    $.ajax({
      url: $('#shopify_export_order').data('action'),
      method: $('#shopify_export_order').data('method'),
      data: data,
      dataType: 'json',
      beforeSend: function () {
        self.container.modal('hide');
        waitingDialog.show();
      },
      complete: function () {
        waitingDialog.hide();
      },
      success: function (result) {
        if (result.status === 200) {
          downloadURI(result.path, result.file);
        } else {
          $.nError(result.message);
        }
      },
      error : function(err){
        console.log(err);
        if(err.responseJSON) {
          $.nError(err.responseJSON.message);
        }
        else {
          $.nError(err.statusText);
        }
        if(err.status === 419) {
          setTimeout(function(){
            window.location.href = window.location.href;
          },1000);
        }
      }
    });
  };
  return this;
};


const shopify = new ShopifyExport();
