   @push('modal')
    <div id="simple_field_grid_gallery_base_path"></div>
    <link rel="stylesheet" href="{{env_host}}/public/plugin/lightbox2/src/css/lightbox.css" />
    <script type="text/javascript" src="{{env_host}}/public/plugin/lightbox2/src/js/lightbox.js" charset="UTF-8"></script>



    <script>
            $(document).on('click', '.roadtrips', function () {

                var id = $(this).attr('data-id');
                var form_data = new FormData();
                form_data.append("_token", '{{ csrf_token() }}');
                form_data.append("id", id);
                form_data.append("ctrl", $(this).attr('data-json'));
                $.ajax({
                    url: "{{url('admin/'.request()->segment(2).'/simple_field_gallery_base_path/')}}/"+id,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'POST',
                    success: function (data) {
                        $('#simple_field_grid_gallery_base_path').html(data);
                                        


                    }
                });

                function lazyload() {
                    if ($(window).outerWidth() < 992) {
                        $("img:not(.show-pc)").each(function (image) {
                            var src = $(this).attr("data-src");
                            $(this).attr("src", src);
                        });
                    } else {
                        $("img:not(.show-mobile)").each(function (image) {
                            var src = $(this).attr("data-src");
                            $(this).attr("src", src);
                        });
                    }
                }
                $(document).ready(function () {
                    lazyload();
                });
                $(window).on("resize", function () {
                    lazyload();
                });

                $('.roadtrips').removeAttr('data-lightbox');
                $('.mdb-lightbox a').removeAttr('data-lightbox');
                $(this).attr('data-lightbox', "roadtrip");
                $(this).attr('href', $(this).attr('data-href'));
                $('#myModal' + id + ' a').attr('data-lightbox', "roadtrip");
                $(this).click();

            });
    </script>
    @endpush
