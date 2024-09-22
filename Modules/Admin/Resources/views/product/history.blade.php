

@php
$logs = !empty($record)?get_data("product_log",["product_id"=>$record->id],"**","id desc"):[]    ;
@endphp
@if(!empty($logs))



<table id="customers">
    <thead>
    <tr>
        <th>STT</th>
        <th>Ngày</th>
        <th>Người thay đổi</th>
        <th>Ghi chú</th>
      </tr>
    </thead>
    <tbody>
    @foreach($logs as $log)
    <tr>
      <th>{{$loop->index + 1}}</th>
      <th>{{date("d/m/Y H:i:A",strtotime($log->created_at))}}</th>
      <th>{{$log->user_full_name}}</th>
      <th>{{$log->title}}</th>
    </tr>
    @endforeach
    </tbody>
  </table>
@endif

<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tbody tr:nth-child(even){background-color: #f2f2f2;}

#customers tbody tr:hover {background-color: #ddd;}

#customers thead th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: var(--secondary_bg_color);
  color: white;
}
</style>




