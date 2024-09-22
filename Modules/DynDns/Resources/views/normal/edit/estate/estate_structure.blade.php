 <div class="form-group col-md-2 desktop">
    <label>
        Số tầng
    </label>
    <div class="">
        <input type="number" class="form-control   money_floor title" id="floor" value="{{@$row->floor}}" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-control title" id="floor_hide" name="floor" value="{{@$row->floor}}" autocomplete="off" />
        <ul class="parsley-errors-list" id="parsley-id-4995"></ul>
    </div>
     <script src="{{env_host}}/public/plugin/mask/jquery.mask.min.js" type="text/javascript"></script>
    <script>
        $('.money_floor').mask('###', { reverse: true });
        $('#floor').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#floor_hide').val(value);
        })
    </script>
</div>

<div class="form-group col-md-2 desktop">
    <label>
        Phòng khách     </label>
    <div class="">
        <input type="number" class="form-control   money_livingroom title" id="livingroom" value="{{@$row->livingroom}}" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-control title" id="livingroom_hide" name="livingroom" value="{{@$row->livingroom}}" autocomplete="off" />
        <ul class="parsley-errors-list" id="parsley-id-4995">
                    </ul>
    </div>
    <script>
        $('.money_livingroom').mask('###', { reverse: true });
        $('#livingroom').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#livingroom_hide').val(value);
        })
    </script>
</div>

<div class="form-group col-md-2 desktop">
    <label>
        Phòng ngủ     </label>
    <div class="">
        <input type="number" class="form-control   money_bedrooms title" id="bedrooms" value="{{@$row->bedrooms}}" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-control title" id="bedrooms_hide" name="bedrooms" value="{{@$row->bedrooms}}" autocomplete="off" />
        <ul class="parsley-errors-list" id="parsley-id-4995">
                    </ul>
    </div>
    <script>
        $('.money_bedrooms').mask('###', { reverse: true });
        $('#bedrooms').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#bedrooms_hide').val(value);
        })
    </script>
</div>

<div class="form-group col-md-2 desktop">
    <label>
        Phòng tắm     </label>
    <div class="">
        <input type="number" class="form-control   money_bathrooms title" id="bathrooms" value="{{@$row->bathrooms}}" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-control title" id="bathrooms_hide" name="bathrooms" value="{{@$row->bathrooms}}" autocomplete="off" />
        <ul class="parsley-errors-list" id="parsley-id-4995">
                    </ul>
    </div>
    <script>
        $('.money_bathrooms').mask('###', { reverse: true });
        $('#bathrooms').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#bathrooms_hide').val(value);
        })
    </script>
</div>

<div class="form-group col-md-1 desktop">
    <label>
        WC     </label>
    <div class="">
        <input type="number" class="form-control   money_wc title" id="wc" value="{{@$row->wc}}" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-control title" id="wc_hide" name="wc" value="{{@$row->wc}}" autocomplete="off" />
        <ul class="parsley-errors-list" id="parsley-id-4995">
                    </ul>
    </div>
    <script>
        $('.money_wc').mask('###', { reverse: true });
        $('#wc').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#wc_hide').val(value);
        })
    </script>
</div>

<div class="form-group col-md-1 desktop">
    <label>
        Bếp     </label>
    <div class="">
        <input type="number" class="form-control   money_kitchen title" id="kitchen" value="{{@$row->kitchen}}" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-control title" id="kitchen_hide" name="kitchen" value="{{@$row->kitchen}}" autocomplete="off" />
        <ul class="parsley-errors-list" id="parsley-id-4995">
                    </ul>
    </div>
    <script>
        $('.money_kitchen').mask('###', { reverse: true });
        $('#kitchen').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#kitchen_hide').val(value);
        })
    </script>
</div>

<div class="form-group col-md-2 desktop">
    <label>
        Sân thượng     </label>
    <div class="">
        <input type="number" class="form-control   money_terrace title" id="terrace" value="{{@$row->terrace}}" data-type="number" autocomplete="off" />
        <input type="hidden" class="form-control title" id="terrace_hide" name="terrace" value="{{@$row->terrace}}" autocomplete="off" />
        <ul class="parsley-errors-list" id="parsley-id-4995">
                    </ul>
    </div>
    <script>
        $('.money_terrace').mask('###', { reverse: true });
        $('#terrace').on('change', function () {
            var value = $(this).val().replace(new RegExp(',', 'g'), '');
            $('#terrace_hide').val(value);
        })
    </script>
</div>
