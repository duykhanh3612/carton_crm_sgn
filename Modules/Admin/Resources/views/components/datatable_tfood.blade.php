<tfoot>
    <tr>
        <td colspan="{{count($theads)+ count(config("admin.".request()->segment(2).".tfirst")??[])+1}}">
            @isset($tfoots)
            @foreach($tfoots as $foot)

                @if($foot["type"] == "paging")
                <div class="paging" style="float:right">
                    {!! $records->links() !!}
                </div>
                @endif
            @endforeach
            @endisset
        </td>
    </tr>
</tfoot>
