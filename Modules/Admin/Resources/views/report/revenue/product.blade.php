@include("admin::report.revenue.box_product")

<div class="width-100 ng-scope" data-ng-if="reportTypeModel.type == 4">
    <div class="table-responsive">
        <div class="dataTables_wrapper" role="grid">
            <table class="table table-hover table-bordered dataTable ng-scope ng-table"
                   ng-table="productItemReportParams">
                <!-- ngInclude: templates.header -->
                <thead ng-include="templates.header" class="ng-scope">
                    <tr class="ng-scope">
                        <!-- ngRepeat: column in $columns -->
                    </tr>
                    <tr ng-show="show_filter" class="ng-table-filters ng-scope ng-hide">
                        <!-- ngRepeat: column in $columns -->
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th class="text-center ng-binding">Mã hàng hóa</th>
                        <th class="text-left ng-binding">Tên hàng hóa</th>
                        <th class="text-left ng-binding">Danh mục</th>
                        <th class="text-center ng-binding">SL bán</th>
                        <th class="text-center ng-binding">Tiền bán hàng </th>
                        {{-- <th class="text-center ng-binding">SL trả</th>
                        <th class="text-center ng-binding">Tiền trả hàng</th> --}}
                    </tr>
                </thead>
                @foreach ($orders as $r)
                    <tbody data-ng-repeat="item in params.data" class="ng-scope">
                        <tr>
                            <td class="text-center ng-binding">{{ $r->sku }}</td>
                            <td class="text-left ng-binding">{{ @$r->product->name }}</td>
                            <td class="text-left ng-binding">{{ @$r->category_name }}</td>
                            <td class="text-center ng-binding">{{ number_format($r->qty) }}</td>
                            <td class="text-right ng-binding">{{ number_format($r->total_price) }}</td>
                            {{-- <td class="text-center ng-binding">0</td>
                            <td class="text-right ng-binding">0</td> --}}
                        </tr>
                    </tbody>
                @endforeach
            </table>
            <div class="paging">
                {!! $orders->links() !!}
            </div>
        </div>
    </div>
</div>
