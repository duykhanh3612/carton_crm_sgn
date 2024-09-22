 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="m-0 text-uppercase font-weight-bold">
                    {{ @$module->name_vn}}
                </h1>
                @if(auth()->user()->id=="1")
                @include('plugin::devitech.modules.header_right')
                @endif
                <link rel="stylesheet" href="{{ asset('modules/dist/style.css') }}" />
            </div>
        </div>
    </div>
</div>
