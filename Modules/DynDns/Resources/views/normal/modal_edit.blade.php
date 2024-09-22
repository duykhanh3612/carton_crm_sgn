<div class="page-content-wrapper animated fadeInRight">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <div class="page-content">
        <div class="wrapper-content ">
            <form id="frm-post" name="form_admin" action="" method="post" enctype="multipart/form-data">

                    @include('admin::adminui.sys.template.normal.widge.edit_list')


            </form>
            <div class="row">
                {!! @$button !!}
            </div>

        </div>
    </div>
</div>



