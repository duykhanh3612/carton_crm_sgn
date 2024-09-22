<div class="form-group {{ $rowClass ?? 'col-md-12' }}" >
    <div class="col-md-12">
       <table class="data-table">
        <tr>
            @foreach ($fields as $col)
            <td class="text-center">{{ $col['text'] }}</td>
            @endforeach
        </tr>

            @if(!empty($fields))
            @foreach($data as $r)
            <tr>
                @foreach ($fields as $col)
                    <td>{{ $r->{$col['field']} }}</td>
                @endforeach
            @endforeach
        </tr>
            @endif

       </table>
    </div>
    <style type="text/css">
        .data-table{
            border:  1px solid #dee2e6;
        }
        .data-table tr td,   .data-table tr th{
            border:  1px solid #dee2e6;
            padding: 5px;
        }

        </style>
</div>

