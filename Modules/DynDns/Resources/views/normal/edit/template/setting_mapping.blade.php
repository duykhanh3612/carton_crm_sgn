@php
$name_id = str_replace(['[', ']', '#'], ['', '', ''], @$ctrl->name . $lang);
@endphp
<div class="form-group {{ $ctrl->width }} desktop ">
    <label>
        {{ $ctrl->title }} @if (@$ctrl->validate == 1)
            <span style="color:#ff0000">(*)</span>
        @endif
    </label>
    <div class="">
        <div style="display:flex">
        <input type="text"
            class="form-control {{ @$ctrl->validate == 1 ? 'validation' : '' }}  {{ @$ctrl->needed == 1 ? 'needed' : '' }}   <?= $lang ?>"
            {{ @$ctrl->read == 1 ? 'readonly' : 'name=' . @$ctrl->name . $lang }} id="<?= @$name_id ?>"
            value="<?= @$row->{$ctrl->value . $lang} ?>" placeholder="{{ $ctrl->att_table }}" />

            <span class="btn btn-template"><i class="fa fa-edit"></i></span>
        </div>
        <textarea id="struct" name="struct"></textarea>
        <div id="popup-template" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary">Save changes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
        <div id="popup-choose-field" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Setting Mapping Fields</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary">Save changes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
    </div>
    @push('script')
    <script>
        $(document).ready(function() {
            $('.btn-template').click(function() {
                $.ajax({
                    url: "http://dyndns.net/api/template",
                    cache: false,
                    contentType: false,
                    type: 'GET',
                    success: function (res) {
                        let html = '';
                        $.each(res.data,function(index, item){
                            html += domHtml(item);
                        });
                        $('#popup-template').find(".modal-body").html(html);
                        $('#popup-template').modal('show');
                    }
                });
            });
            $(document).on('click','.btn-choose-template',function(){
                let id = $(this).data('id');
                $('#popup-template').modal('hide');
                $.ajax({
                    url: "http://dyndns.net/api/template-fields?id=" + id,
                    cache: false,
                    contentType: false,
                    type: 'GET',
                    success: function (res) {
                        let fields = res.data;
                        $.ajax({
                            url: "{{url('api/collection-fields')}}?collection={{$func->table}}",
                            cache: false,
                            contentType: false,
                            type: 'GET',
                            success: function (res) {
                                let html = `<div class="row template-line pt-3 pb-3">
                                        <div class="col-md-4">Fields</div>
                                        <div class="col-md-4">Mapping Field</div>
                                        <div class="col-md-4">Description</div>
                                    </div>`;
                                let fields_data = htmlSelect(res.data);
                                $.each(fields,function( field){
                                    html += domFieldHtml(field, fields_data);
                                });
                                $('#popup-choose-field').find(".modal-body").html(html);
                                $('#popup-choose-field').modal('show');
                            }
                        });

                    }
                });

            });
            $(document).on('change','.field-mapping',function(){
                getStructFields();
            });
            function getStructFields(){
                var fields = {};
                $('.template-field-item').each(function(){
                    let key = $(this).find('.field-name').text();
                    let value =  $(this).find('.field-mapping').find('option:selected').val();
                    fields[key] = value;
                });
                console.log(fields);
                $('#struct').val(JSON.stringify(fields));
            }
            function domHtml(item){
                let html = `
                    <div class="row template-line pt-3 pb-3">
                        <div class="col-md-3">${item.name}</div>
                        <div class="col-md-3"><img src='${item.img}' class="img-fluid" /></div>
                        <div class="col-md-3"><span class="btn btn-choose-template" data-id='${item.id}'>Choose</span></div>
                    </div>
                `;
                return html;
            }
            function domFieldHtml(field, item){
                if(field=="collection"){
                    let html = `
                    <div class="row template-field-item">
                        <div class="col-md-4 field-name">${field}</div>
                        <div class="col-md-4"><select class="field-mapping"><option value='{{$func->table}}'>{{$func->table}}</option></select></div>
                        <div class="col-md-4"></div>
                    </div>
                    `;
                    return html;
                }
                else{
                    let html = `
                    <div class="row template-field-item template-line pt-3 pb-3">
                        <div class="col-md-4 field-name">${field}</div>
                        <div class="col-md-4" field-mapping>${item}</div>
                        <div class="col-md-4"></div>
                    </div>
                    `;
                    return html;
                }

            }
            function htmlSelect(items){
                let html = `<select class="form-control field-mapping">`;
                $.each(items, function(key, item){
                    html += `<option value="${key}">${item}</option>`;
                });
                html += `</select>`;
                return html;
            }
        });
    </script>
    @endpush
    <style type="text/css">
    .template-line{
        border-bottom:  1px dashed #ccc;
    }
    </style>
</div>
