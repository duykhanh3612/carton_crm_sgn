@push('js')
    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="{{asset("module/order/index.js")}}" ></script>

    <style type="text/css">
        .item-detail {
            cursor: pointer;
        }

        .item-detail.expand::before {
            /* font-family: FontAwesome; */
            content: "\f056" !important;
        }
        .status {
            padding: 5px 10px;
            margin-bottom: 0;
        }
        .status.key_1 {
            background: #ABBBC3;
            color: #fff;
        }
        .status.key_1::before {
            content: "\f007";
            font-family: "Font Awesome 6 Free";
            font-size:14px;
            margin-right: 10px;
        }
        .status.key_2 {
            background: #D15B47;
            color: #fff;
        }
        .status.key_2::before {
            content: "\f507";
            font-family: "Font Awesome 6 Free";
            font-size:14px;
            margin-right: 10px;
        }
        .status.key_3 {
            background: #428BCA;
            color: #fff;
        }
        .status.key_3::before {
            content: "\f0d1";
            font-family: "Font Awesome 6 Free";
            font-size:14px;
            margin-right: 10px;
        }
        .status.key_4 {
            background: #9585BF;
            color: #fff;
        }
        .status.key_4::before {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-size:14px;
            margin-right: 10px;
        }
        .status.key_5 {
            background: #000;
            color: #fff;
        }
        .status.key_5::before {
            content: "\f1f8";
            font-family: "Font Awesome 6 Free";
            font-size:14px;
            margin-right: 10px;
        }
    </style>
    <div class="modal" id="modelOrderPrint">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="form-horizontal">
                    <div class="modal-header no-padding">
                        <div class="table-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" ng-click="closeModal();">
                                <span class="white">&times;</span>
                            </button>
                            {{__('Create_New_Customer')}}
                        </div>
                    </div>

                    <div class="modal-body no-padding">

                    </div>
                    <div class="modal-footer">
                        <div class="pull-right">
                            <button class="btn" type="reset" ng-click="closeModal()">
                                <i class="icon-undo bigger-110"></i>
                                {{__('BACK')}}
                            </button>
                            &nbsp; &nbsp; &nbsp;
                            <button type="submit" class="btn btn-primary" id="createCustomer">
                                <i class="icon-ok bigger-110"></i>
                                {{__('Save')}}
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
