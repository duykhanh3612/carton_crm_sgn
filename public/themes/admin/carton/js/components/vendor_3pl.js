$(document).ready(function () {
  $('body').on('click', '#ls_custom_client_form button.submit-form', vendor3PL.submitChangeClient);
});


const Vendor3PL = function ($fields, $headers) {
  const self = this;
  this.submitChangeClient = function (event) {
    let ele = $(event.target);
    let form = ele.parents('.modal').find('form');
    form.find('.error').removeClass('error');
    let data = {};
    form.serializeArray().forEach(function (input) {
      data[input.name] = input.value.trim();
    });
    let valid = true;
    for (let i in data) {
      if (!data[i]) {
        form.find(`input[name=${i}]`).addClass('error');
        valid = false;
      }
    }
    if (!valid) {
      $.nError('Client ID and Client Secret are required!');
      return;
    }
    form.submit();
  };
  return this;
};


const vendor3PL = new Vendor3PL();
