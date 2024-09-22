
  $(document).ready(function() {
      $("button#btnupdateInfor").click(function(){
          var emailagent =  $('#contactEmail').val();
          $(function(){
              var regExp = /[\w\-\._]+@[\w\-\._]+\.\w{2,10}/;
              if(!(regExp.test( emailagent ))){
                  showNoti('Email is invalid', 'Error', 'Err');
                  // $('.message.error3').html('Email is invalid').show();
                  return false;
              }else{
                  var form = $('#updateinfor')[0];
                  var formData = new FormData(form);
                  if ($("#updateinfor")[0].checkValidity())
                      $.ajax({
                          type: "POST",
                          url: "terminal_informtion/updateinfor",
                          processData: false,
                          contentType: false,
                          dateType: "json",
                          data: formData,
                          success: function(message) {
                              console.log(message);
                              if (message == 2) {
                                  showNoti(' Image size is too large, please choose another photo ', 'Error', 'Err');
                                  jQuery('.preview_img').removeAttr('src')
                                  jQuery('.preview_img').show();
                                  $('.file-name p').remove();
                              }else if(message == 1){
                                  showNoti('Update Terminal Information', 'Success', 'Ok');
                                  $('.message.error3').html('Email is invalid').hide();
                              }else{
                                  showNoti(message, 'Error', 'Err');
                              }
                          },
                          error: function(){
                              alert("Error");
                          }
                      });
                  else
                      //Validate Form
                      $("#updateinfor")[0].reportValidity()
              }
          });
      });
   $(".regal-file").uploadFile({
            url: site_url + 'ajax/ajax_attachment',
            fileName: 'myfile',
            formData: {
                'dir': $('.regal-file').data('dir'),
            },
            uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right',
            allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip',
            uploadErrorStr: 'The file is not in the correct directory!',
            maxFileSize: 5240000,
            multiple: true,
            showErrType: 1,
            dragDropStr: "",
            onSubmit: function () {

            },
            onSuccess: function (files, data) {
                if(data == 'Upload failed'){
                    showNoti(data, 'Error', 'Err');
                }else{
                    var ext = data.split('.').pop();
                    var checkUpload = false;
                    if (checkUpload) {
                        if ($('.ajax-file-upload-statusbar').length > 0 && $('#type-regal-file').val() == '') {
                            $('.ajax-file-upload-statusbar').remove();
                        }
                        return;
                    }
                    showAttachment(files, data);
                    $('.ajax-file-upload-statusbar').fadeOut();
                    $('.attachments-wrap i.remove').click(function () {
                        $(this).parent().next().fadeOut();
                        $(this).parent().fadeOut(function () {
                            $(this).remove();
                        });
                    });
                }

            }
        });
        $(".regal-filejett").uploadFile({
            url: site_url + 'ajax/ajax_attachment',
            fileName: 'myfile',
            formData: {
                'dir': $('.regal-file').data('dir'),
            },
            uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right',
            allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip',
            uploadErrorStr: 'File không đúng danh mục!',
            maxFileSize: 5240000,
            multiple: true,
            showErrType: 1,
            dragDropStr: "",
            onSubmit: function () {

            },
            onSuccess: function (files, data) {
                if(data == 'Upload failed'){
                    showNoti(data, 'Error', 'Err');
                }else{
                    var ext = data.split('.').pop();
                    var checkUpload = false;

                    if (checkUpload) {
                        if ($('.ajax-file-upload-statusbar').length > 0 && $('#type-regal-file').val() == '') {
                            $('.ajax-file-upload-statusbar').remove();
                        }
                        return;
                    }
                    showAttachmentjett(files, data);
                    $('.ajax-file-upload-statusbar').fadeOut();
                    $('.attachments-wrap i.remove').click(function () {
                        $(this).parent().next().fadeOut();
                        $(this).parent().fadeOut(function () {
                            $(this).remove();
                        });
                    });
                }
            }
        });
        $(".regal-filePans").uploadFile({
            url: site_url + 'ajax/ajax_attachment',
            fileName: 'myfile',
            formData: {
                'dir': $('.regal-file').data('dir'),
            },
            uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right',
            allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip',
            uploadErrorStr: 'File không đúng danh mục!',
            maxFileSize: 5240000,
            multiple: true,
            showErrType: 1,
            dragDropStr: "",
            onSubmit: function () {

            },
            onSuccess: function (files, data) {
                if(data == 'Upload failed'){
                    showNoti(data, 'Error', 'Err');
                }else{
                    var ext = data.split('.').pop();
                    var checkUpload = false;

                    if (checkUpload) {
                        if ($('.ajax-file-upload-statusbar').length > 0 && $('#type-regal-file').val() == '') {
                            $('.ajax-file-upload-statusbar').remove();
                        }
                        return;
                    }
                    showAttachmentPans(files, data);
                    $('.ajax-file-upload-statusbar').fadeOut();
                    $('.attachments-wrap i.remove').click(function () {
                        $(this).parent().next().fadeOut();
                        $(this).parent().fadeOut(function () {
                            $(this).remove();
                        });
                    });
                }

            }
        });
        $(".regal-filecon").uploadFile({
            url: site_url + 'ajax/ajax_attachment',
            fileName: 'myfile',
            formData: {
                'dir': $('.regal-file').data('dir'),
            },
            uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right',
            allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip',
            uploadErrorStr: 'File không đúng danh mục!',
            maxFileSize: 5240000,
            multiple: true,
            showErrType: 1,
            dragDropStr: "",
            onSubmit: function () {

            },
            onSuccess: function (files, data) {
                if(data == 'Upload failed'){
                    showNoti(data, 'Error', 'Err');
                }else{
                    var ext = data.split('.').pop();
                    var checkUpload = false;

                    if (checkUpload) {
                        if ($('.ajax-file-upload-statusbar').length > 0 && $('#type-regal-file').val() == '') {
                            $('.ajax-file-upload-statusbar').remove();
                        }
                        return;
                    }
                    showAttachmentcon(files, data);
                    $('.ajax-file-upload-statusbar').fadeOut();
                    $('.attachments-wrap i.remove').click(function () {
                        $(this).parent().next().fadeOut();
                        $(this).parent().fadeOut(function () {
                            $(this).remove();
                        });
                    });
                }

            }
        });
        $(".regal-filePolicy").uploadFile({
            url: site_url + 'ajax/ajax_attachment',
            fileName: 'myfile',
            formData: {
                'dir': $('.regal-file').data('dir'),
            },
            uploadButtonClass: 'btn btn-border btn-alt btn-hover border-orange font-orange waves-effect pull-right',
            allowedTypes: 'xls,xlsx,doc,docx,pdf,rar,zip',
            uploadErrorStr: 'File không đúng danh mục!',
            maxFileSize: 5240000,
            multiple: true,
            showErrType: 1,
            dragDropStr: "",
            onSubmit: function () {

            },
            onSuccess: function (files, data) {
                if(data == 'Upload failed'){
                    showNoti(data, 'Error', 'Err');
                }else{
                    var ext = data.split('.').pop();
                    var checkUpload = false;

                    if (checkUpload) {
                        if ($('.ajax-file-upload-statusbar').length > 0 && $('#type-regal-file').val() == '') {
                            $('.ajax-file-upload-statusbar').remove();
                        }
                        return;
                    }
                    showAttachmentPolicy(files, data);
                    $('.ajax-file-upload-statusbar').fadeOut();
                    $('.attachments-wrap i.remove').click(function () {
                        $(this).parent().next().fadeOut();
                        $(this).parent().fadeOut(function () {
                            $(this).remove();
                        });
                    });
                }
            }
        });
    function showNoti(id, mes, mode) {

    var html = '';
    if (!isNaN(id)) html += (id != '' ? '<span class="mes-text">ID: ' + id + '</span>' : '');
    else if (id) html += (id != '' ? '<span class="mes-text">' + (id.split(':')[1] != '' ? id.split(':')[0] : id.split(':')[0]) + (id.split(':')[1] ? ': ' + id.split(':')[1] : '') + '</span>' : '');
    var icon = 'ok';
    if (mode == 'Err') {
        icon = 'remove';
    } else if (mode == 'War') {
        icon = 'circle_exclamation_mark';
    }
    $.amaran({
        delay: 10000,
        position: 'bottom right',
        content: {
            title: mes,
            message: '',
            info: html,
            icon: 'icon32 glyphicons white ' + icon
        },
        theme: 'awesome ' + mode,
        wrapper: '.amaran-wrapper noPrint'
    });
}
  $('body').on('click', '#mtVac', function() {
    var mtVac = document.getElementById('mtVac');
            if (mtVac.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#m3Vac', function() {
    var m3Vac = document.getElementById('m3Vac');
            if (m3Vac.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#barrels', function() {
    var barrels = document.getElementById('barrels');
            if (barrels.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#mtAir', function() {
    var mtAir = document.getElementById('mtAir');
            if (mtAir.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#m3Air', function() {
    var mtAir = document.getElementById('m3Air');
            if (mtAir.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '.addagent', function() {
            if ($("#agentadd")[0].checkValidity())
            {
          var key= $('.line1').length;
          //return false;
        if(key==1){
          var id= $(this).data('id');
          var nameagent =$('[name="nameagent"]').val();
          var emailagent =$('[name="emailagent"]').val();
            $(function(){
                var regExp = /[\w\-\._]+@[\w\-\._]+\.\w{2,10}/;
                if(!(regExp.test( emailagent ))){
                    $('.message.error1').html('Email is invalid').show();
                    return false;
                }else{
                    $.ajax({
                        url:'terminal_informtion/addagent',
                        method: "POST",
                        data: {id: id,
                            name:nameagent,
                            email:emailagent, },
                        success: function(message){
                            $.ajax({
                                    type: "POST",
                                    url: "terminal_informtion/terminalagentrow",
                                    cache : false,
                                    data: {
                                        id: id,

                                    },
                                    async: true,
                                    success: function(res){
                                        $('.message.error1').html('Email is invalid').hide();
                                        $('.terminalagentrow').html(res);
                                        showNoti('Insert Terminal Agent', 'Success', 'Ok');

                                        $(".row0").remove();

                                    },
                                }

                            );

                        },

                    });
                    var string ='<div class="row line1 row'+key+' ">'+
                        '<div class="col-lg-3 col3">'+
                        '<input autocomplete="autocomplete_off_randString"  type="text" class="form-control" name="nameagent" id="terminalagents['+key+'][name]" value ="" placeholder="Name" required>'+
                        '</div> '+
                        '<div class="col-lg-5 col9">'+
                        '<input autocomplete="autocomplete_off_randString"  type="email" class="form-control" name="emailagent" id="terminalagents['+key+'][email]" placeholder="Email" required>'+
                        '</div>'+
                        '<div class="col-lg-4 col1 text-right">'+
                        '<label for="Service" class="form-label">'+
                        '<h4 ><i class="fas fa-trash" style="cursor: pointer;" data-id="0"></i></h4>'+
                        '</label>'+
                        '</div>'+
                        '</div>';
                    $('#agent').html(string);
                }
            });



        }else{
            var string ='<div class="row line1 row'+key+' ">'+
                '<div class="col-lg-3 col3">'+
                '<input autocomplete="autocomplete_off_randString"  type="text" class="form-control" name="nameagent" id="terminalagents['+key+'][name]" value ="" placeholder="Name" required>'+
                '</div> '+
                '<div class="col-lg-5 col9">'+
                '<input autocomplete="autocomplete_off_randString"  type="email" class="form-control" name="emailagent" id="terminalagents['+key+'][email]" placeholder="Email" required>'+
                '</div>'+
                '<div class="col-lg-4 col1 text-right">'+
                '<label for="Service" class="form-label">'+
                '<h4 ><i class="fas fa-trash" style="cursor: pointer;" data-id="0"></i></h4>'+
                '</label>'+
                '</div>'+
                '</div>';
            $('#agent').html(string);
        }

                    }
                     else{
                     //Validate Form
                     $("#agentadd")[0].reportValidity()
                     }
        }).on('click', '.fa-trash', function() {
          var id= $(this).data('id');
          var parent = $(this).closest('.line');
          var parent1 = $(this).closest('.line1');

          if(id==0){
            parent1.remove();

          }else{
         $.alerts.confirm('Will you delete this item?<b', 'Confirm delete', function (r) {
            if (r == true) {
                if (!!id) {

                $.ajax({
                    url:'dashboard/delete_agent',
                    method: "POST",
                    data: {id: id},
                    dateType: "json",
                    cache: false
                 });
                }
                showNoti('Delete Terminal Agent', 'Success', 'Ok');

                parent.remove();

            }}
        );
      }

        })
        .on('click', '.deletesurveyors', function() {
            var id= $(this).data('id');
            var parent = $(this).closest('.line');
            var parent1 = $(this).closest('.line12');
  
            if(id==0){
              parent1.remove();
  
            }else{
           $.alerts.confirm('Will you delete this item?<b', 'Confirm delete', function (r) {
              if (r == true) {
                  if (!!id) {
  
                  $.ajax({
                      url:'terminal_informtion/deletesurveyors',
                      method: "POST",
                      data: {id: id},
                      dateType: "json",
                      cache: false
                   });
                  }
                  showNoti('Delete Terminal Surveyors', 'Success', 'Ok');

                  parent.remove();
  
              }}
          );
        }
  
          }).on('click', '.delinformationBooklet', function() {
            var id= $(this).data('id');
            var informationBooklet= $('.informationBooklet').val();
           
            if(informationBooklet==''){
                showNoti('File does not exist ', 'Error', 'Err');
            return false;

            }

           $.alerts.confirm('Will you delete this item?<b', 'Confirm delete', function (r) {
              if (r == true) {
                  if (!!id) {
  
                  $.ajax({
                      url:'terminal_informtion/delinformationBooklet',
                      method: "POST",
                      data: {id: id},
                      
                      dateType: "json",
                      cache: false
                   });
                  }
                  showNoti('Delete Terminal information booklet', 'Success', 'Ok');
  
                  $(this).find('a').remove();
                  $('.informationBooklet').val()
              }}
          );
        
  
          }).on('click', '.addsurveyors', function() {


            if ($("#frsurveyorsadd")[0].checkValidity()){
            var key1= $('.line12').length;
          //  alert(key);
            //return false;
          if(key1==1){
            var id= $(this).data('id');
            var nameagent =$('[name="namesurveyors"]').val();
            var emailagent =$('[name="emailsurveyors"]').val();
              $(function(){
                  var regExp = /[\w\-\._]+@[\w\-\._]+\.\w{2,10}/;
                  if(!(regExp.test( emailagent ))){
                      $('.message.error').html('Email is invalid').show();
                      return false;
                  }else{
                      $.ajax({
                          url:'terminal_informtion/addsurveyors',
                          method: "POST",
                          data: {id: id,
                              name:nameagent,
                              email:emailagent, },
                          success: function(message){
                              $.ajax({
                                      type: "POST",
                                      url: "terminal_informtion/terminalsurveyors",
                                      cache : false,
                                      data: {
                                          id: id,

                                      },
                                      async: true,
                                      success: function(res){
                                          $('.message.error').html('Email is invalid').hide();
                                          $('.terminalsurveyorsrow').html(res);
                                          showNoti('Insert Terminal Surveyors', 'Success', 'Ok');

                                          $(".rowsurveyors0").remove();
                                      },
                                  }

                              );

                          },

                      });
                      var string ='<div class="row line12 rowsurveyors'+key1+' ">'+
                          '<div class="col-lg-3  col3">'+
                          '<input type="text" class="form-control" name="namesurveyors" id="terminalagents['+key1+'][name]" value = "" placeholder="Name" required>'+
                          '</div> '+
                          '<div class="col-lg-5  col9">'+
                          '<input autocomplete="autocomplete_off_randString"  type="email" class="form-control" name="emailsurveyors" id="terminalagents['+key1+'][email]" placeholder="Email" required>'+
                          '</div>'+
                          '<div class="col-lg-4 text-right  col1">'+
                          '<label for="Service" class="form-label">'+
                          '<h4 ><i class="fas fa-trash deletesurveyors" style="cursor: pointer;"  data-id=""></i></h4>'+
                          '</label>'+
                          '</div>'+
                          '</div>';
                      $('#surveyors').html(string);
                  }
              });
           }else{
              var string ='<div class="row line12 rowsurveyors'+key1+' ">'+
                  '<div class="col-lg-3  col3">'+
                  '<input type="text" class="form-control" name="namesurveyors" id="terminalagents['+key1+'][name]" value = "" placeholder="Name" required>'+
                  '</div> '+
                  '<div class="col-lg-5  col9">'+
                  '<input autocomplete="autocomplete_off_randString"  type="email" class="form-control" name="emailsurveyors" id="terminalagents['+key1+'][email]" placeholder="Email" required>'+
                  '</div>'+
                  '<div class="col-lg-4 text-right  col1">'+
                  '<label for="Service" class="form-label">'+
                  '<h4 ><i class="fas fa-trash deletesurveyors" style="cursor: pointer;"  data-id=""></i></h4>'+
                  '</label>'+
                  '</div>'+
                  '</div>';
              $('#surveyors').html(string);
          }

                }
                       else
                       {
                       //Validate Form
                       $("#frsurveyorsadd")[0].reportValidity();
                       }

          }).on('click', '.deletephase', function() {
            var id= $(this).data('id');
            var parent = $(this).closest('.linephase');

            if(id==''){
              parent.remove();
            }else{

                  $.ajax({
                      url:'terminal_informtion/delete_phase',
                      method: "POST",
                      data: {id: id},
                      dateType: "json",
                      cache: false
                   });
                   showNoti('Detete Terminal Visit Phase', 'Success', 'Ok');

                  parent.remove();

             }
  
          }).on('click', '#preArrival', function() {
    var preArrival = document.getElementById('preArrival');
            if (preArrival.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#internationalShoreFire', function() {
    var internationalShoreFire = document.getElementById('internationalShoreFire');
            if (internationalShoreFire.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#transferEquipment', function() {
    var transferEquipment = document.getElementById('transferEquipment');
            if (transferEquipment.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#transmittedToTanker', function() {
    var transmittedToTanker = document.getElementById('transmittedToTanker');
            if (transmittedToTanker.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#breBerthing', function() {
    var breBerthing = document.getElementById('breBerthing');
            if (breBerthing.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#rudeOilWashingCheck', function() {
            var rude= document.getElementById('rudeOilWashingCheck');
            if (rude.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#tankCleaningCheck', function() {
            var rude= document.getElementById('tankCleaningCheck');
            if (rude.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#preWashCheck', function() {
            var rude= document.getElementById('preWashCheck');
            if (rude.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#gasFreeingCheck', function() {
            var rude= document.getElementById('gasFreeingCheck');
            if (rude.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#slpsOnBoardCheck', function() {
            var rude= document.getElementById('slpsOnBoardCheck');
            if (rude.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#repairsCheck', function() {
            var rude= document.getElementById('repairsCheck');
            if (rude.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#deliveryStoresCheck', function() {
            var rude= document.getElementById('deliveryStoresCheck');
            if (rude.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#expectingBunkersCheck', function() {
            var rude= document.getElementById('expectingBunkersCheck');
            if (rude.checked){
                $(this).val(1);

            }else{
                $(this).val(0);

            }
        }).on('click', '#updateservices', function(e) {
            e.preventDefault(); 
           // alert(1);
            var form =$('form.submitservices').serialize();
            //alert(form);
          //  if ($("#updateInfor")[0].checkValidity())
            $.ajax({
                type: "POST",
                url: "terminal_informtion/processservice",
                
                data: form,
             
                success: function(){
                    showNoti('Update Terminal Services ', 'Success', 'Ok');

                },
                error: function(){
                    alert("Error");
                }
            });
      
        }).on('click', '#updatedefaults', function(e) {
            e.preventDefault(); 
           // alert(1);
            var form =$('form.submitdefaults').serialize();
            //alert(form);
          //  if ($("#updateInfor")[0].checkValidity())
            $.ajax({
                type: "POST",
                url: "terminal_informtion/process",
                
                data: form,
             
                success: function(){
                    showNoti('Update SSSCL defaults ', 'Success', 'Ok');

                },
                error: function(){
                    alert("Error");
                }
            });
      
        })
$(".terminalphasemodal").click(function(){
   // alert(123);

   var id = $(this).data('id');
    $.ajax({
        type: "POST",
        url: "terminal_informtion/terminalphase",
        data: {id: id},
        success: function(output){
            $('#terminalphasemodal').html(output).modal('show');

          //  $('.js-example-basic-single').select2({
               // minimumResultsForSearch: -1
           // });
        },
        error: function(){
            alert("Error");
        }
    });
});
$(".accuracymodal").click(function(){
    alert(123);
  /*  var id = $(this).data('id');
     $.ajax({
         type: "POST",
         url: "terminal_informtion/editaccuracy",
         data: {id: id},
         success: function(output){
             $('#terminalaccuracymodal').html(output).modal('show');
 
           //  $('.js-example-basic-single').select2({
                // minimumResultsForSearch: -1
            // });
         },
         error: function(){
             alert("Error");
         }
     });*/
 });
      $(".editphase").click(function(){
          var id = $(this).data('id');
          $.ajax({
              type: "POST",
              url: "terminal_informtion/editphase",
              data: {id: id},
              success: function(output){
                  $('#terminalphasemodal').html(output).modal('show');

                  //  $('.js-example-basic-single').select2({
                  // minimumResultsForSearch: -1
                  // });
              },
              error: function(){
                  alert("Error");
              }
          });
      });
        function showAttachment(src, dst) {
            $('.informationBooklet').remove();
            var html = '<div>';
            html += '<div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' + src + '" value="' + dst.split('/').pop() + '" type="hidden" name="informationBooklet" id="regal-filename"/><div class="image-small"><div class="no-image" title="' + dst.split('/').pop() + '"><a target="_blank" href="upload/TermDoc/' + dst.split('/').pop() + '" ><img class="imginformationBooklet"  src="assets/img/file_ext/pdf.png" /></a></div></div></div>';
            html += '</div>';
            $('#Attachments-list').html(html);
            var informationBooklet = $('[name="informationBooklet"]').val();
            $.ajax({
                type: "POST",
                url: "terminal_informtion/inforBooklet",
                
                data: {id:$('#idterminaldocument').val() ,informationBooklet:informationBooklet}, 
             
                success: function(){
                    showNoti('Update Terminal information booklet ', 'Success', 'Ok');

                },
                error: function(){
                    alert("Error");
                }
            });

        }
      function showAttachmentjett(src, dst) {
        $('.jettyBerthInformation1').remove();

            var html = '<div>';
            html += '<div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' + src + '" value="' + dst.split('/').pop() + '" type="hidden" name="jettyBerthInformation" id="regal-filename"/><div class="image-small"><div class="no-image" title="' + dst.split('/').pop() + '"><a target="_blank" href="upload/TermDoc/' + dst.split('/').pop() + '" ><img class="imgjettyBerth" src="assets/img/file_ext/pdf.png" /></a></div></div></div>';
            html += '</div>';
            $('#Attachments-listjett').html(html);
            var jettyBerthInformation = $('[name="jettyBerthInformation"]').val();
            $.ajax({
                type: "POST",
                url: "terminal_informtion/jettyBerthInformation",
                
                data: {id:$('#idterminaldocument').val(),jettyBerthInformation:jettyBerthInformation},
             
                success: function(){
                    showNoti('Update Jetty/berth information booklet ', 'Success', 'Ok');

                },
                error: function(){
                    alert("Error");
                }
            });
        }
      
      function showAttachmentPans(src, dst) {
        $('.mooringPans1').remove();

            var html = '<div>';
            html += '<div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' + src + '" value="' + dst.split('/').pop() + '" type="hidden" name="mooringPans" id="regal-filename"/><div class="image-small"><div class="no-image" title="' + dst.split('/').pop() + '"><a target="_blank" href="upload/TermDoc/' + dst.split('/').pop() + '" ><img  class="imgmooringPans" src="assets/img/file_ext/pdf.png" /></a></div></div></div>';
            html += '</div>';
            $('#Attachments-listPans').html(html);

            var mooringPans = $('[name="mooringPans"]').val();
            $.ajax({
                type: "POST",
                url: "terminal_informtion/mooringPans",
                
                data: {id:$('#idterminaldocument').val(),mooringPans:mooringPans},
             
                success: function(){
                    showNoti('Update Mooring plans ', 'Success', 'Ok');

                },
                error: function(){
                    alert("Error");
                }
            });
        
        }
        function showAttachmentcon(src, dst) {
            $('.termsAndConditions1').remove();

            var html = '<div>';
            html += '<div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' + src + '" value="' + dst.split('/').pop() + '" type="hidden" name="termsAndConditions" id="regal-filename"/><div class="image-small"><div class="no-image" title="' + dst.split('/').pop() + '"><a target="_blank" href="upload/TermDoc/' + dst.split('/').pop() + '" ><img class="imgtermsAndConditions" src="assets/img/file_ext/pdf.png" /></a></div></div></div>';
            html += '</div>';
            $('#Attachments-listcon').html(html);
            var termsAndConditions = $('[name="termsAndConditions"]').val();
            $.ajax({
                type: "POST",
                url: "terminal_informtion/termsAndConditions",
                
                data: {id:$('#idterminaldocument').val(),termsAndConditions:termsAndConditions},
             
                success: function(){
                    showNoti('Update Terminal terms and conditions', 'Success', 'Ok');

                },
                error: function(){
                    alert("Error");
                }
            });
        }
        function showAttachmentPolicy(src, dst) {
          $('.privacyPolicy1').remove();
            var html = '<div>';
            html += '<div class="attachments-wrap"><i class="fa fa-close remove"></i><input data-file="' + src + '" value="' + dst.split('/').pop() + '" type="hidden" name="privacyPolicy" id="regal-filename"/><div class="image-small"><div class="no-image" title="' + dst.split('/').pop() + '"><a target="_blank" href="upload/TermDoc/' + dst.split('/').pop() + '" ><img class="imgprivacyPolicy" src="assets/img/file_ext/pdf.png" /></a></div></div></div>';
            html += '</div>';
            $('#Attachments-listPolicy').html(html);
            var privacyPolicy = $('[name="privacyPolicy"]').val();
            $.ajax({
                type: "POST",
                url: "terminal_informtion/privacyPolicy",
                
                data: {id:$('#idterminaldocument').val(),privacyPolicy:privacyPolicy},
             
                success: function(){
                    showNoti('Update Terminal privacy policy', 'Success', 'Ok');

                },
                error: function(){
                    alert("Error");
                }
            });
        }

      });