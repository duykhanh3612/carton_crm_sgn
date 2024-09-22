
<div class="box nav-active-border b-info">
    <?php
    $string = $func->data;
    $data = array();  
    $asArr = explode( ',', $string );  
    if(count($asArr)>0)
    foreach( $asArr as $val ){
        $tmp = explode('=>', $val );
        $data[@$tmp[0] ] = @$tmp[1];
    }

    ?>

    @if(@count(@$center_lang)>1)
    <ul class="nav nav-md">                   
        <li class="nav-item inline">
            <a class="nav-link active" href="javascrip:;" data-toggle="tab" data-target="#tab_details" aria-expanded="true">
                <span class="text-md">
                    <i class="icon fa fa-laptop"></i> {{isset($data['tab_details'])?$data['tab_details']:'Chi tiết chủ đề'}}
                </span>
            </a>
        </li>
    @if(@$center_lang['tab_data'])
        <li class="nav-item inline">
            <a class="nav-link" href="javascrip:;" data-toggle="tab" data-target="#tab_data" aria-expanded="true">
                <span class="text-md">
                    <i class="icon fa fa-newspaper-o"> </i> {{isset($data['tab_data'])?$data['tab_data']:'Data'}}
                </span>
            </a>
        </li>
        @endif              
    @if(@$center_lang['tab_section'])
        <li class="nav-item inline">
            <a class="nav-link" data-toggle="tab" data-target="#tab_section" aria-expanded="true">
                <span class="text-md">
                    <i class="icon fa fa-object-group"></i> {{isset($data['tab_section'])?$data['tab_section']:'Sections'}}
                </span>
            </a>
        </li>
    @endif

    @if(@$center_lang['tab_maps'])
    <li class="nav-item inline">
        <a class="nav-link" id="mapTabLink" href="javascrip:;" data-toggle="tab" data-target="#tab_maps" aria-expanded="false">
            <span class="text-md">
                <i class="icon fa fa-map-marker">
                </i>Bản đồ
            </span>
        </a>
    </li>
    @endif

    @if(@$center_lang['tab_photos'])
        <li class="nav-item inline">
            <a class="nav-link" href="javascrip:;" data-toggle="tab" data-target="#tab_photos" aria-expanded="false">
                <span class="text-md">
                    <i class="icon fa fa-file-image-o"> </i> {{isset($data['tab_photos'])?$data['tab_photos']:'Hình ảnh'}}
                    <!--<span class="label rounded">1</span>-->
                </span>
            </a>
        </li>
    @endif


    @if                                                                (@$center_lang['tab_files'])
        <li class="nav-item inline">
            <a class="nav-link " href="javascrip:;" data-toggle="tab" data-target="#tab_files">
                <span class="text-md">
                    <i class="material-icons">
                        
                    </i>Trường bổ sung
                    <span class="label rounded">1</span>
                </span>
            </a>
        </li>
        @endif
    @if                (@$center_lang['tab_related'])
        <li class="nav-item inline">
            <a class="nav-link  " href="javascrip:;" data-toggle="tab" data-target="#tab_related">
                <span class="text-md">
                    <i class="material-icons">
                        
                    </i>Chủ đề liên quan
                    <!--<span class="label rounded">2</span>-->
                </span>
            </a>
        </li>
        @endif

        @if(@$center_lang['tab_social'])
        <li class="nav-item inline">
            <a class="nav-link" href="javascrip:;" data-toggle="tab" data-target="#tab_social" aria-expanded="false">
                <span class="text-md">
                    <i class="icon fa fa-share-alt"></i>Liên kết mạng xác hội
                </span>
            </a>
        </li>
        @endif
        @if(@$center_lang['tab_extra1'])
        <li class="nav-item inline">
            <a class="nav-link" href="javascrip:;" data-toggle="tab" data-target="#tab_extra1" aria-expanded="false">
                <span class="text-md">
                    <i class="material-icons"> </i>{{@$data['tab_extra1']}}
                </span>
            </a>
        </li>
        @endif
        @if(@$center_lang['tab_extra2'])
        <li class="nav-item inline">
            <a class="nav-link" href="javascrip:;" data-toggle="tab" data-target="#tab_extra2" aria-expanded="false">
                <span class="text-md">
                    <i class="material-icons"> </i>{{@$data['tab_extra2']}}
                </span>
            </a>
        </li>
        @endif
        @if(@$center_lang['tab_extra3'])
        <li class="nav-item inline">
            <a class="nav-link" href="javascrip:;" data-toggle="tab" data-target="#tab_extra3" aria-expanded="false">
                <span class="text-md">
                    <i class="material-icons"> </i>{{@$data['tab_extra3']}}
                </span>
            </a>
        </li>
        @endif


        @if(@$center_lang['tab_seo'])
        <li class="nav-item inline">
            <a class="nav-link" href="javascrip:;" data-toggle="tab" data-target="#tab_seo" aria-expanded="false">
                <span class="text-md">
                    <i class="icon fa fa-line-chart">
                    </i>Thiết lập SEO
                </span>
            </a>
        </li>
        @endif
    </ul>
    @endif

    <div class="tab-content clear b-t">
    @include(alias_admin.'::sys.template.normal.widge.tab_detail')

    @if(@$center_lang['tab_data'])
    @include(alias_admin.'::sys.template.normal.widge.tab_data')
    @endif

    @if(@$center_lang['tab_section'])
    @include(alias_admin.'::sys.template.normal.widge.tab_section')
    @endif
    @if(@$center_lang['tab_photos'])
    @include(alias_admin.'::sys.template.normal.widge.tab_photos')
    @endif
    @if(@$center_lang['tab_related'])
    @include(alias_admin.'::sys.template.normal.widge.tab_related')
    @endif
    @if(@$center_lang['tab_maps'])
    @include(alias_admin.'::sys.template.normal.widge.tab_maps')
    @endif

    @if(@$center_lang['tab_social'])
    @include(alias_admin.'::sys.template.normal.widge.tab_social')
    @endif

    @if(@$center_lang['tab_extra1'])
    @include(alias_admin.'::sys.template.normal.widge.tab_extra1')
    @endif
                
    @if(@$center_lang['tab_extra2'])
    @include(alias_admin.'::sys.template.normal.widge.tab_extra2')
    @endif
                
    @if(@$center_lang['tab_extra3'])
    @include(alias_admin.'::sys.template.normal.widge.tab_extra3')
    @endif

    @if(@$center_lang['tab_seo'])
    @include(alias_admin.'::sys.template.normal.widge.tab_seo')
    @endif


    @if(@$center_lang['none'])
    @include(alias_admin.'::sys.template.normal.widge.tab_none')
    @endif
    <div class="tab-pane">
        <div class="row">
            <?php if($widthctrl[0]!=0):?>
            <div class="col-lg-{{$widthctrl[0]}}" style="padding:0px;">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tùy chỉnh</h5>
                    </div>
                    <div class="ibox-content collapse in">
                        <div class="widgets-container">
                            <?php
                    if(@$left_ctrl)
                        foreach($left_ctrl as $ctrl):
                            $pair['row'] = @$row;
                            $pair['ctrl'] = $ctrl;
                            $pair['lang'] = @$ctrl->language==1?'_'.@$lang:'';
                            $pair['path_base'] = @$path_base;
                            $ctrl_content = view(h::area_admin.'::sys.template.normal.edit.'.$ctrl->type,$pair);
                            ?>
                            <div class="note note-info" style="clear:both;">
                                {!!                                                  @$ctrl_content !!}
                                <div style="clear:both"></div>
                            </div><?php endforeach?>

                        </div>

                    </div>
                </div>
            </div>
            <?php endif?>
            <div class="col-lg-{{$widthctrl[1]}}">
                <div class="tabs-container"></div>
            </div>

            <div class="col-lg-{{$widthctrl[2]}}" style="padding:0px;">
                <div class="ibox float-e-margins">
                    <?php
                if(@$right_ctrl)
                    foreach($right_ctrl as $ctrl):
                        $pair['row'] = @$row;
                        $pair['ctrl'] = $ctrl;
                        $pair['path_base'] = @$path_base;
                        $pair['lang'] = @$ctrl->language==1?_lang:'';
                        $ctrl_content = view(h::area_admin.'::sys/template/normal/edit/'.@$ctrl->type,$pair);
                    ?>
                    <div class="{{@$ctrl->mask=='title'?'mar10_bottom':'note note-info'}} " style="clear:both;">
                        {!!$ctrl_content !!}
                        <div style="clear:both"></div>
                    </div><?php endforeach?>

                </div>
            </div>
        </div>
    </div>
    <div style="clear:both"></div>
    </div>
</div>


<style type="text/css">
    .nav-active-border, .tab-content {
        background-color: #fff;
    }
    .nav, .nav-item, .nav-link {
        border: inherit;
    }

    .nav {
        list-style: outside none none;
        margin-bottom: 0;
        padding-left: 0;
    }
    .inline {
        display: inline-block !important;
    }
    .text-md {
        color: #757575;
        display: block;
        font-size: 13px;
        margin-bottom: 5px;
        margin-top: 5px;
        overflow: hidden;
        text-align: center;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .nav, .nav-item, .nav-link {
        border: inherit;
    }
.nav-tabs {
    border-bottom-width: 0;
    z-index: 1;
}
.nav-tabs .nav-link {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0 !important;
    color: inherit !important;
}
.nav-tabs .nav-link.active, .nav-tabs .nav-link.active:focus, .nav-tabs .nav-link.active:hover, .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
    border-color: rgba(120, 130, 140, 0.13) rgba(120, 130, 140, 0.13) transparent;
}
.tab-content.tab-alt .tab-pane {
    display: block;
    height: 0;
    overflow: hidden;
}
.tab-content.tab-alt .tab-pane.active {
    height: auto;
    overflow: visible;
}
    .nav-active-border .nav-link.active::before, .nav-active-border .nav-link:focus::before, .nav-active-border .nav-link:hover::before {
        border-bottom-color: inherit;
        left: 0;
        right: 0;
    }

    .nav-active-border .nav-link::before {
        border-bottom: 3px solid transparent;
        bottom: 0;
        content: "";
        left: 50%;
        position: absolute;
        right: 50%;
        transition: all 0.2s ease-in-out 0s;
    }
</style>
<link rel="stylesheet" href="{{env_host}}public/plugin/jasny/jasny-bootstrap.min.css" />
<script type="text/javascript" src="{{env_host}}public/plugin/jasny/jasny-bootstrap.min.js" charset="UTF-8"></script>
<script>
    @if($func->layout=='horizontal')
       $('.form-group').each(function(){
            if($(this).hasClass('col-md-6'))
            {
                $(this).find('label').addClass("col-sm-4 form-control-label");
                $(this).find('div').addClass("col-sm-8");

            }
            else{
                $(this).find('label').addClass("col-sm-2 form-control-label");
                    $(this).find('div').addClass("col-sm-10");
            }
       }  );
       
            /* if($('.form-group>label').parent().hasClass('col-md-6'))
            {
                $('.form-group>label').addClass("col-sm-4 form-control-label");
                $('.form-group>div').addClass("col-sm-8");

            }
            else{
                $('.form-group>label').addClass("col-sm-2 form-control-label");
                $('.form-group>div').addClass("col-sm-10");
            }   */
    @endif
</script>
<script>  
    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {

            center: {lat: 22.3038945, lng: 70.80215989999999},

            zoom: 13

        });

        var input = document.getElementById('searchMapInput');

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);



        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.bindTo('bounds', map);



        var infowindow = new google.maps.InfoWindow();

        var marker = new google.maps.Marker({

            map: map,

            anchorPoint: new google.maps.Point(0, -29)

        });



        autocomplete.addListener('place_changed', function() {

            infowindow.close();

            marker.setVisible(false);

            var place = autocomplete.getPlace();



            /* If the place has a geometry, then present it on a map. */

            if (place.geometry.viewport) {

                map.fitBounds(place.geometry.viewport);

            } else {

                map.setCenter(place.geometry.location);

                map.setZoom(17);

            }

            marker.setIcon(({

                url: place.icon,

                size: new google.maps.Size(71, 71),

                origin: new google.maps.Point(0, 0),

                anchor: new google.maps.Point(17, 34),

                scaledSize: new google.maps.Size(35, 35)

            }));

            marker.setPosition(place.geometry.location);

            marker.setVisible(true);



            var address = '';

            if (place.address_components) {

                address = [

                (place.address_components[0] && place.address_components[0].short_name || ''),

                (place.address_components[1] && place.address_components[1].short_name || ''),

                (place.address_components[2] && place.address_components[2].short_name || '')

                ].join(' ');

            }



            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);

            infowindow.open(map, marker);



            /* Location details */

            document.getElementById('location-snap').innerHTML = place.formatted_address;

            document.getElementById('lat-span').innerHTML = place.geometry.location.lat();

            document.getElementById('lon-span').innerHTML = place.geometry.location.lng();

        });

    }    
</script>
             

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmsH3ga0_pRYjsJWn-KEOxVAFNIssKWn0&libraries=places&callback=initMap" async defer></script>

