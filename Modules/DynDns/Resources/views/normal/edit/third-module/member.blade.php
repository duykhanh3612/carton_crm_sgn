@php
    $list_member = json_decode(@$row->{$ctrl->value}) ;    
@endphp
<div class="form-field">
    <label class="desc"><?=$ctrl->title?>   
        <a class="btn purple btn-member-add">
            <i class="fa fa-plus"></i> &nbsp; Add
        </a>
    </label>
    <small><?=@$ctrl->note?></small>	  
   <div class="row" id="member_content_{{$ctrl->name}}" >
       @if(@$list_member)
       @foreach($list_member as $r)
       <div class="col-sm-2 member-item">
           <div class="contact-box" style="padding:0px">
               <div class="col-sm-12 padding-none panel-image-{{$ctrl->name}}">
                   <div class="text-center panel-image-{{$ctrl->name}}">
                       @if(@$r->image!='')
                       <img src="{{@$path_base.$r->image}}" style="width:100%" />
                       @else
                       <img data src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTkwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk1IiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE5MHgxNDA8L3RleHQ+PC9zdmc+"
                           style="width:100%" />
                       @endif
                   </div>
                   <div class="col-sm-12 hiddenfile">
                       <input type="file" class="fileinput fileinput{{$ctrl->name}}" />
                       <input class="form-control member-field image" placeholder="Image" type="text" value="{{$r->image}}" />
                   </div>
               </div>
               <div class="col-sm-12" style="padding:0px 0px">
                   <h3>
                       <input class="form-control member-field fullname" placeholder="Full name" value="{{$r->fullname}}" />
                   </h3>
                   <h3>
                       <input class="form-control member-field position" placeholder="Position" value="{{$r->position}}" />
                   </h3>
                   <!--<p>
                        <i class="fa fa-map-marker"></i>4030 Prospect Street
                    </p>
                    <address>
                        <strong>Twitter, Inc.</strong>
                        <br />795 Folsom Ave, Suite 600
                        <br />Camden, New Jersey 08102
                        <br />
                        <abbr title="Phone">P:</abbr>856-681-6121
                    </address>-->
               </div>
               <div class="clearfix"></div>

           </div>
       </div>
       @endforeach
       @endif
       <textarea name="{{$ctrl->name}}" id="{{$ctrl->name}}" class="form-control" style="display:none;">{{@$row->{$ctrl->value} }}</textarea>
   </div>
     
   <script>
       $('.btn-member-add').on('click', function () {
           var HTML = '<div class="col-sm-2 member-item">';
           HTML += '     <div class="contact-box" style="padding:0px">';
           HTML += '          <div class="col-sm-12 padding-none panel-image-{{$ctrl->name}}">'
                + '              <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOTAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTkwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijk1IiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE5MHgxNDA8L3RleHQ+PC9zdmc+" style="width:100%">'
                + '           </div>'
                + '           <div class="col-sm-12 hiddenfile">'
                +'                  <input type="file" class="fileinput fileinput{{$ctrl->name}}" />'
                + '                 <input class="form-control member-field image" placeholder="Image"  type="text"/>'
                +'            </div>';
           HTML +=    '     </div>';
           HTML +=    '     <div class="col-sm-12" style="padding:0px 0px">';
           HTML += '          <h3><input name="fullname" class="form-control member-field fullname" placeholder="Full name" /></h3>';
           HTML += '          <h3><input name="position" class="form-control member-field position" placeholder="Position" /> </h3>';
           HTML +=    '     </div>';
           HTML +=    '</div>';
           
           $('#member_content_{{$ctrl->name}}').append(HTML);
       });

       $(document).on('click', '.panel-image-{{$ctrl->name}}', function () {
           $(this).parent().find('.fileinput{{$ctrl->name}}').trigger('click');
       });



       $(document).on('change', '.fileinput', function () {
           var tag_img = $(this).parent().parent().find('img');
           var input_image = $(this).parent().find('.image');
           var input = this;
           if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function (e) {
                   $(tag_img).attr('src', e.target.result);
               }

               reader.readAsDataURL(input.files[0]);
           }

           var formData = new FormData();
           formData.append('image', input.files[0], input.files[0].name);

           $.ajax({
               url: '{{url(request()->segment(1).'/'.request()->segment(2)."/upload_image")}}',
               type: 'POST',
               data: formData,
               async: false,
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
               },
               success: function (data) {
                   var myObj = JSON.parse(data);
                   $(input_image).val(myObj.image);

                   var list = [];
                   $('.member-item').each(function () {
                       var image = $(this).find('.image').val();
                       var fullname = $(this).find('.fullname').val();
                       var position = $(this).find('.position').val();

                       var obj = {
                           fullname: fullname,
                           position: position,
                           image: image
                       };
                       list.push(obj);
                   });
                   $('#{{$ctrl->name}}').val(JSON.stringify(list));

               },
               cache: false,
               contentType: false,
               processData: false
           });

       });

       $(document).on('change', '.member-field', function () {
            var list = [];
            $('.member-item').each(function () {
                var image = $(this).find('.image').val();
                var fullname = $(this).find('.fullname').val();
                var position = $(this).find('.position').val();

                var obj = {
                    fullname: fullname,
                    position: position,
                    image: image
                };
                list.push(obj);
            });
            $('#{{$ctrl->name}}').val(JSON.stringify(list));
        });
   </script>
    <style type="text/css">
        .hiddenfile {
            width: 0px;
            height: 0px;
            overflow: hidden;
        }
    </style>
</div>
