$(document).ready(function () {
  channelAdvisor.init();
});


const ChannelAdvisor = function () {
  const self = this;
  this.format = 'yyyy-mm-dd';
  this.container = $('#ca_export_orders');
  this.picker = $('#ca_export_orders #checkout_date_picker');
  this.input = $('#ca_export_orders #checkout_date');
  this.date = this.picker.data('date') || moment().format(this.format);
  this.init = function () {
    self.picker.datepicker({
      format: self.format,
      endDate: moment().toDate()
    });
    self.picker.on('changeDate', function () {
      self.input.val(
        self.picker.datepicker('getFormattedDate')
      );
      self.date = self.picker.datepicker('getFormattedDate');
    });
    self.date = self.picker.datepicker('getFormattedDate');
    self.container.find('#btn_ca_export_order').on('click', self.export);
  };

  this.export = function () {
    var action = self.container.find('input[name=ca_export_action]:checked').val();
    var field = self.container.find('select[name=ca_date_field]').val();
    const data = {
      date: self.date,
      field: field,
      action: action,
      _token: $('#ca_export_orders input[name=_token]').val()
    };
    $.ajax({
      url: $('#ca_export_orders').data('action'),
      method: $('#ca_export_orders').data('method'),
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
          if (action == 1 || action == 3) {
            downloadURI(result.path, result.file);
          } else {
            $.nSuccess(result.message);
          }
        } else {
          $.nError(result.message);
        }
      },
      error : function(err){
        if(err.responseJSON && err.responseJSON.message){
          $.nError(err.responseJSON.message);
        }
        else {
          $.nError(err.statusText);
        }
        if(err.statusCode === 419) {
          window.location.href = window.location.href;
        }
      }
    });
  };
  return this;
};


const channelAdvisor = new ChannelAdvisor();
