"use strict";
const Corporate = function(){
  const self = this;
  this.formUrl = '';
  this.locationUrl = '';
  this.modalSelector = '#corporate_reroute_order_modal';
  this.rerouteBtnSelector = '#btn_corporate_reroute_order';
  this.selectAccountSelector = '#corporate_reroute_account';
  this.selectAccountLocationSelector = '#corporate_reroute_account_location';
  this.orderIdSelector = '#corporate_reroute_order_id';
  this.__proto__.setFormUrl = function(url){
    self.formUrl = url;
  };
  this.__proto__.setLocationUrl = function(url){
    self.locationUrl = url;
  };
  this.__proto__.openModal = function(){
    if(! $('.listItemids:checked').length ||  $('.listItemids:checked').length > 1) {
      alert('Please select one order.');
      return;
    }
    const id = $('.listItemids:checked').val();
    if(self.formUrl) {
      $.ajax({
        url : self.formUrl,
        data : {id},
        beforeSend : function(){
          waitingDialog.show();
        },
        success : function(result){
          self.modal.find('.modal-body').html(result);
          self.modal.find('select').select2({
            allowSearch:true,
          });
          setTimeout(function (){
            self.modal.modal('show');
          } , 500);
        },
        complete : function(){
          waitingDialog.hide();
        },
        error : function(error) {
          if(error.responseJSON && error.responseJSON.message) {
            $.nError(error.responseJSON.message);
          }
          else {
            $.nError(error.statusText);
          }
        }
      });
    }
    else {
      alert('Error! Please contact administrator.');
    }
  };
  this.__proto__.selectAccountHandle = function(event){
    const ele = $(event.target);
    let clientId = ele.val();
    if(!clientId) {
      self.setLocations();
      return;
    }
    $.ajax({
      url : self.locationUrl,
      data:{'client_id' : clientId},
      dataType:'json',
      success : function(result){
        self.setLocations(result.data);
      },
      error : function(){
        self.setLocations();
      }
    });
  };
  this.__proto__.setLocations = function($locations){
    $locations = $locations || {};
    const ele = $(self.selectAccountLocationSelector);
    ele.html('<option value="">Please Select...</option>');
    ele.val('');
    for(let i in $locations) {
      ele.append(`<option value="${i}">${$locations[i]}</option>`)
    }
    ele.select2('destroy');
    ele.select2({
      allowSearch: true,
    });
  };
  this.__proto__.rerouteOrder = function(){
    const clientId = $(self.selectAccountSelector).val();
    const locationId = $(self.selectAccountLocationSelector).val();
    if(!clientId || !locationId) {
      $.nError('Please select Account and Location to route.');
      return;
    }
    const data = self.modal.find('form').serialize();
    self.modal.modal('hide');
    $.ajax({
      url:self.modal.find('form').attr('action'),
      method : 'post',
      dataType : 'json',
      data : data,
      success : function(result){
        if(result.success) {
          $.nSuccess('Re-route order successfully!');
          setTimeout(function (){
            window.location.href = window.location.href;
          } , 500);
        }
        else {
          $.nError(result.message);
        }
      },
      error : function(error){
        console.log(error);
        if(error.responseJSON) {
          $.nError(error.responseJSON.message);
        }
        else {
          $.nError(error.statusText);
        }
      },
      beforeSend : function(){
        waitingDialog.show();
      },
      complete : function(){
        waitingDialog.hide();
      }
    });
  };
  this.__proto__.init = function(){
    self.modal = $(self.modalSelector);
    $('#corporate_reroute_button').on('click' , self.openModal);
    self.modal.on('change' , this.selectAccountSelector ,self.selectAccountHandle);
    $(self.rerouteBtnSelector).on('click' , self.rerouteOrder);
  };
  return this;
};

const corporate = new Corporate();
