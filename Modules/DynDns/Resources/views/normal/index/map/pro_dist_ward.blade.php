<td>
    @php
        $location = array(
            App\Model\Geo::getWardName(@$row->ward_id) ,
            (App\Model\Geo::getDistrictName(@$row->district_id)!=''?'Quận '.App\Model\Geo::getDistrictName(@$row->district_id):'')   ,
            App\Model\Geo::getProvinceName(@$row->province_id)
        );
        echo implode(', ',array_filter($location));
    @endphp
</td>