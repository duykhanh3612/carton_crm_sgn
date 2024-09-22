$(document).ready(function() {
    $('.js-example-basic-single1').select2();


    $('body').on('change', '.image-wrap [type="file"]', function(e) {
        
        var fileInput = $(this);
        var previewImg = fileInput.parent().find('.preview_img');
        var sizefile= this.files[0].size;
        if(sizefile>20000){
            showNoti(' Image size is too large, please choose another photo ', 'Error', 'Err');

            e.fadeOut(function() {
                
                previewImg.remove();
                $('.preview_img').removeAttr('src');

            });

            return false;

        }else{

        var ext = fileInput.val().split('.').pop().toLowerCase();
        var file = e.originalEvent.srcElement.files[0];
        var reader = new FileReader();
        if (ext == 'jpg' || ext == 'png' || ext == 'gif') {
            if (fileInput.parent().find('.flash-div').length) {
                fileInput.parent().find('.flash-div').hide();
            }
            previewImg.fadeOut();
            reader.onloadend = function() {
                previewImg.attr('src', reader.result);
                previewImg.prev('i').hide();
                previewImg.fadeIn(1000);
                if (fileInput.parent().find('.delImageIcon').length) {
                    fileInput.parent().find('.delImageIcon').hide();
                }
                fileInput.parent().find('.file-name div').fadeIn().children('p').text(fileInput.val().split('\\').pop());
                fileInput.parent().find('.file-name div i').click(function() {
                    fileInput.replaceWith(fileInput = fileInput.clone(true));
                    previewImg.fadeOut(function() {
                        previewImg.prev('i').fadeIn();
                        fileInput.parent().find('.file-name div').fadeOut();
                    });
                });
            };
            reader.readAsDataURL(file);
        } else if (ext == 'swf') {
            if (fileInput.parent().find('.flash-div').length) {
                var flashDiv = fileInput.parent().find('.flash-div');
                previewImg = fileInput.parent().find('.preview_img');
                previewImg.fadeOut(function() {
                    previewImg.prev('i').hide();
                });
                flashDiv.find('.flash-file').html('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="120px" height="88px" align="middle"><param name="movie" value=""><param name="wmode" value="transparent"><embed src="" quality="best" wmode="transparent" width="120px" height="88px" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" __idm_id__="19984386"></object>');
                var flashEmb = flashDiv.find('.flash-file object embed');
                reader.onloadend = function() {
                    flashEmb.attr('value', reader.result);
                    flashEmb.attr('src', reader.result);
                    flashDiv.show();
                    if (fileInput.parent().find('.delImageIcon').length) {
                        fileInput.parent().find('.delImageIcon').hide();
                    }
                    fileInput.parent().find('.file-name div').fadeIn().children('p').text(fileInput.val().split('\\').pop());
                    fileInput.parent().find('.file-name div i').click(function() {
                        fileInput.replaceWith(fileInput = fileInput.clone(true));
                        flashDiv.fadeOut(function() {
                            previewImg.prev('i').fadeIn();
                            fileInput.parent().find('.file-name div').fadeOut();
                        });
                    });
                };
                reader.readAsDataURL(file);
            }
        } else {
            fileInput.parent().find('.file-name div').fadeIn().children('p').text(fileInput.val().split('\\').pop());
            fileInput.parent().find('.file-name div i').click(function() {
                fileInput.replaceWith(fileInput = fileInput.clone(true));
                fileInput.parent().find('.file-name div').fadeOut();
            });
        }}
    }).on('click', '.delImageIcon', function() {
      var ele = $(this);
      //  var type = $('#moduleInfo').data('type');
        //var table = $('#moduleInfo').data('table');
        $.alerts.confirm('Bạn có chắc sẽ xóa tệp tin !', 'Xác nhận xóa tệp tin', function(r) {
            if (r == true) {
               // var field = ele.data('field');
              //  var id = ele.data('id');
                var previewImg = ele.parent().find('.preview_img');
            
                showProcess(1);
                $.ajax({
                    url: site_url + 'ajax/delete_image',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: 1,
                        field: 'logo',
                        table: 'terminal'
                    },
                    success: function(string) {
                        if (string == 1) {
                            previewImg.fadeOut(function() {
                                previewImg.prev('i').fadeIn();
                                ele.fadeOut(function() {
                                    $(this).remove();
                                });
                            });
                            showNoti('Tệp tin: ảnh ', 'Xóa hình tệp tin thành công', 'Ok');
                        } else {
                            showNoti('Tệp tin: ảnh ', 'Xóa hình tệp tin thất bại', 'Err');
                        }
                    }
                });
            }
        });
        return false;
    }).on('click', '#shorelines', function(e) {
        e.preventDefault(); 

        var key= $('.line1').length+1;
    
         var string ='<div class="row line1 row0 ">'+
                      '<div class="col-lg-2">'+
                        '<input autocomplete="nope"  type="text" class="form-control" name="surveyors['+key+'][name]" id="surveyors['+key+'][name]" value ="" placeholder="Name" required>'+
                       '</div> '+ 
                      '<div class="col-lg-3">'+
                      '<select class="select2 form-select mb-3" name="surveyors['+key+'][type]" id="surveyors['+key+'][type]" aria-label="Default select example">'+
                      '<option value="0">Select...</option>'+
                      '<option value="1">Loadingarm</option>'+
                      '<option value="2">Hose</option>'+
                      '</select>'+
                       '</div>'+ '<div class="col-lg-2">'+
                       '<select class="select2 form-select mb-3" name="surveyors['+key+'][inch]" id="surveyors['+key+'][inch]" aria-label="Default select example">'+
                      '<option value="0">Select....</option>'+
                      '<option value="4">4”</option>'+
                      '<option value="6">6”</option>'+
                      '<option value="8">8”</option>'+
                      '<option value="10">10”</option>'+
                      '<option value="12">12”</option>'+
                      '<option value="14">14”</option>'+
                      '<option value="16">16”</option>'+
                      '<option value="18">18”</option>'+
                      '<option value="20">20”</option>'+
                      '</select>'+                       
                      '</div>'+
                      '<div class="col-lg-2">'+
                      '<select class="select2 form-select mb-3" name="surveyors['+key+'][fotmat]" id="surveyors['+key+'][fotmat]" aria-label="Default select example">'+
                      '<option value="0">Select...</option>'+
                      '<option value="1">ansi</option>'+
                      '<option value="2">din</option>'+
                      '</select>'+                        
                      '</div>'+ 
                      '<div class="col-lg-2">'+
                       '<input autocomplete="nope"  type="number" class="form-control" name="surveyors['+key+'][numberoflines]" id="surveyors['+key+'][numberoflines]" placeholder="Number of lines" required>'+
                      '</div>'+
                      '<div class="col-lg-1 text-right ">'+
                      '<label for="Service" class="form-label">'+          
                          '<h4 ><i class="fas fa-trash deletesurveyors" style="cursor: pointer;" data-id="0"></i></h4>'+
                      '</label>'+
                    '</div>'+
                   '</div>';
                   $('#shorelinesid').append(string);
                  
                  
      }).on('click', '#btnupdatjeettyadmin', function(e) {
    
        e.preventDefault(); 
         // alert(1);
          var form =$('form.addshorelines').serialize();
          //alert(form);
         if ($("#addshorelines")[0].checkValidity())
          $.ajax({
              type: "POST",
              url: "jettyadministration/process",
              
              data: form,
           
              success: function(){
                 showNoti('Update Shorelines for East jetty', 'Success', 'Ok');
               //  location.reload();

              },
              error: function(){
                  alert("Error");
              }
          });
          $("#addshorelines")[0].reportValidity();

      }).on('click', '.deletesurveyors', function(e) {
    
        var id= $(this).data('id');
        var parent = $(this).closest('.line1');
  
            if(id==0){
              parent.remove();
  
            }else{
           $.alerts.confirm('Will you delete this item?<b', 'Confirm delete', function (r) {
              if (r == true) {
                  if (!!id) {
  
                  $.ajax({
                      url:'jettyadministration/deleteshorline',
                      method: "POST",
                      data: {id: id},
                      dateType: "json",
                      cache: false
                   });
                  }
                  parent.remove();
  
              }}
          );
        }

      }).on('click', '.deletevapourlines', function(e) {
    
        var id= $(this).data('id');
        var parent = $(this).closest('.line1');
  
            if(id==0){
              parent.remove();
  
            }else{
           $.alerts.confirm('Will you delete this item?<b', 'Confirm delete', function (r) {
              if (r == true) {
                  if (!!id) {
  
                  $.ajax({
                      url:'jettyadministration/deletevapourlines',
                      method: "POST",
                      data: {id: id},
                      dateType: "json",
                      cache: false
                   });
                  }
                  parent.remove();
  
              }}
          );
        }

      }).on('click', '.vapourlines', function(e) {
          
        var key= $('.line1').length+1;
        e.preventDefault(); 

         var string ='<div class="row line1 row0 ">'+
                      '<div class="col-lg-2">'+
                        '<input autocomplete="nope"  type="text" class="form-control" name="vapourlines['+key+'][name]" id="vapourlines['+key+'][name]" value ="" placeholder="Name" required>'+
                       '</div> '+ 
                      '<div class="col-lg-3">'+
                      '<select class="select2 form-select mb-3" name="vapourlines['+key+'][type]" id="vapourlines['+key+'][type]" aria-label="Default select example">'+
                      '<option value="0">Select...</option>'+
                      '<option value="1">Loadingarm</option>'+
                      '<option value="2">Hose</option>'+
                      '</select>'+
                       '</div>'+ '<div class="col-lg-2">'+
                       '<select class="select2 form-select mb-3" name="vapourlines['+key+'][inch]" id="vapourlines['+key+'][inch]" aria-label="Default select example">'+
                      '<option value="0">Select....</option>'+
                      '<option value="4">4”</option>'+
                      '<option value="6">6”</option>'+
                      '<option value="8">8”</option>'+
                      '<option value="10">10”</option>'+
                      '<option value="12">12”</option>'+
                      '<option value="14">14”</option>'+
                      '<option value="16">16”</option>'+
                      '<option value="18">18”</option>'+
                      '<option value="20">20”</option>'+
                      '</select>'+                       
                      '</div>'+
                      '<div class="col-lg-2">'+
                      '<select class="select2 form-select mb-3" name="vapourlines['+key+'][fotmat]" id="vapourlines['+key+'][fotmat]" aria-label="Default select example">'+
                      '<option value="0">Select...</option>'+
                      '<option value="1">ansi</option>'+
                      '<option value="2">din</option>'+
                      '</select>'+                        
                      '</div>'+ 
                      '<div class="col-lg-2">'+
                       '<input autocomplete="nope"  type="number" class="form-control" name="vapourlines['+key+'][numberoflines]" id="vapourlines['+key+'][numberoflines]" placeholder="Number of lines" required>'+
                      '</div>'+
                      '<div class="col-lg-1 text-right">'+
                      '<label for="Service" class="form-label">'+          
                          '<h4 ><i class="fas fa-trash deletevapourlines" style="cursor: pointer;" data-id="0"></i></h4>'+
                      '</label>'+
                    '</div>'+
                   '</div>';
                   $('#vapourlinesid').append(string);
                  
                  
      })
    function showProcess(process) {
    if (process == null) {
        processCount = processCount + 1;
    } else {
        processCount = process;
    }
    $('.notiLoading').html('Loading... <span id="processCount">' + processCount + '</span>');
    $('.notiLoading').css({
        'width': 155
    }).slideDown('fast');

}

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
});
function surveyors() {

var key= $('.surveyors1').length+1;
if(key==1){
var string ='<div class="row line1 row0 ">'+
'<div class="col-lg-2">'+
  '<input autocomplete="nope"  type="text" class="form-control" name="surveyors['+key+'][name]" id="surveyors['+key+'][name]" value ="" placeholder="Name" required>'+
 '</div> '+ 
'<div class="col-lg-3">'+
'<select class="select2 form-select mb-3" name="surveyors['+key+'][type]" id="surveyors['+key+'][type]" aria-label="Default select example">'+
'<option value="0">Select...</option>'+
'<option value="1">Loadingarm</option>'+
'<option value="2">Hose</option>'+
'</select>'+
 '</div>'+ '<div class="col-lg-2">'+
 '<select class="select2 form-select mb-3" name="surveyors['+key+'][inch]" id="surveyors['+key+'][inch]" aria-label="Default select example">'+
'<option value="0">Select....</option>'+
'<option value="4">4”</option>'+
'<option value="6">6”</option>'+
'<option value="8">8”</option>'+
'<option value="10">10”</option>'+
'<option value="12">12”</option>'+
'<option value="14">14”</option>'+
'<option value="16">16”</option>'+
'<option value="18">18”</option>'+
'<option value="20">20”</option>'+
'</select>'+                       
'</div>'+
'<div class="col-lg-2">'+
'<select class="select2 form-select mb-3" name="surveyors['+key+'][fotmat]" id="surveyors['+key+'][fotmat]" aria-label="Default select example">'+
'<option value="0">Select...</option>'+
'<option value="1">ansi</option>'+
'<option value="2">din</option>'+
'</select>'+                        
'</div>'+ 
'<div class="col-lg-2">'+
 '<input autocomplete="nope"  type="number" class="form-control" name="surveyors['+key+'][numberoflines]" id="surveyors['+key+'][numberoflines]" placeholder="Number of lines" required>'+
'</div>'+
'<div class="col-lg-1 text-right coldel">'+
'<label for="Service" class="form-label">'+          
    '<h4 ><i class="fas fa-trash deletesurveyors" style="cursor: pointer;" data-id="0"></i></h4>'+
'</label>'+
'</div>'+
'</div>';
$('#shorelinesid').append(string);

}

}
function vapourlines() {
    var key= $('.vapourlines1').length+1;
    if(key==1){

    var string ='<div class="row line1 row0 ">'+
                 '<div class="col-lg-2">'+
                   '<input autocomplete="nope"  type="text" class="form-control" name="vapourlines['+key+'][name]" id="vapourlines['+key+'][name]" value ="" placeholder="Name" required>'+
                  '</div> '+ 
                 '<div class="col-lg-3">'+
                 '<select class="select2 form-select mb-3" name="vapourlines['+key+'][type]" id="vapourlines['+key+'][type]" aria-label="Default select example">'+
                 '<option value="0">Select...</option>'+
                 '<option value="1">Loadingarm</option>'+
                 '<option value="2">Hose</option>'+
                 '</select>'+
                  '</div>'+ '<div class="col-lg-2">'+
                  '<select class="select2 form-select mb-3" name="vapourlines['+key+'][inch]" id="vapourlines['+key+'][inch]" aria-label="Default select example">'+
                 '<option value="0">Select....</option>'+
                 '<option value="4">4”</option>'+
                 '<option value="6">6”</option>'+
                 '<option value="8">8”</option>'+
                 '<option value="10">10”</option>'+
                 '<option value="12">12”</option>'+
                 '<option value="14">14”</option>'+
                 '<option value="16">16”</option>'+
                 '<option value="18">18”</option>'+
                 '<option value="20">20”</option>'+
                 '</select>'+                       
                 '</div>'+
                 '<div class="col-lg-2">'+
                 '<select class="select2 form-select mb-3" name="vapourlines['+key+'][fotmat]" id="vapourlines['+key+'][fotmat]" aria-label="Default select example">'+
                 '<option value="0">Select...</option>'+
                 '<option value="1">ansi</option>'+
                 '<option value="2">din</option>'+
                 '</select>'+                        
                 '</div>'+ 
                 '<div class="col-lg-2">'+
                  '<input autocomplete="nope"  type="number" class="form-control" name="vapourlines['+key+'][numberoflines]" id="vapourlines['+key+'][numberoflines]" placeholder="Number of lines" required>'+
                 '</div>'+
                 '<div class="col-lg-1 text-right coldel">'+
                 '<label for="Service" class="form-label">'+          
                     '<h4 ><i class="fas fa-trash deletevapourlines" style="cursor: pointer;" data-id="0"></i></h4>'+
                 '</label>'+
               '</div>'+
              '</div>';
              $('#vapourlinesid').append(string);
             
    }
    
    }