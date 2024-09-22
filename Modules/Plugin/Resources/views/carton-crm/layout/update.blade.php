@extends('plugin::carton-crm.master')
@section('content')
    <section class="content-wrapper">
        <div class="content-wrapper-box">
            @stack('header')
            {{-- <div class="content-header">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm-6">
                      <h1 class="m-0 text-uppercase font-weight-bold">
                        Chỉnh sửa tin tức
                      </h1>
                    </div>
                  </div>
                </div>
              </div> --}}
            <section class="content">
                <div class="container-fluid">


                    <!-- Tiêu đề -->
                    <div id="productGeneralInfo" class="position-relative">
                        @if (!in_array(request()->segment(2), ['payment']))
                            <h4 class="text-main-blue-3 text-uppercase">Bài viết</h4>
                        @endif
                        <!-- content -->
                        {!! @$content !!}
                        <!-- Button Range -->
                        @if (!in_array(request()->segment(2), ['payment']))
                            <div class="d-flex justify-content-end mt-3 position-absolute"
                                style="gap: 8px;top: 0px; right: 30px;">
                                <!-- Lưu và tiếp tục -->
                                <button class="btn btn-warning" type="button">
                                    <img src="../../dist/img/icon/save.png" alt="" width="15">
                                    Lưu và tiếp tục
                                </button>
                                <!-- Hoàn tất -->
                                <button class="chooseDate text-white border-0" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"
                                        fill="white">
                                        <path
                                            d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z">
                                        </path>
                                    </svg>
                                    Lưu
                                </button>
                                <!-- Hủy -->
                                <button class="btn btn-dark" type="button">
                                    <a href="./order.html" class="text-white d-flex align-items-center" style="gap: 5px">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"
                                            fill="white">
                                            <path
                                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z">
                                            </path>
                                        </svg></a>
                                    Hủy
                                </button>
                            </div>
                        @endif
                    </div>

                </div>
                <!-- /.container-fluid -->
            </section>

        </div>
    </section>
@endsection

<?php if (!empty($routeRemoveItems) || !empty($routeUpdateStatusItems)): ?>
<script>
    let routeRemoveItems = "{{ $routeRemoveItems }}";
    let routeUpdateStatusItems = "{{ $routeUpdateStatusItems }}";
</script>
<?php endif;?>
