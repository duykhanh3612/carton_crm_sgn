@php
    $map = $row->name;
    $link_map = "http://static.dyndns.top";
@endphp

<div class="form-group {{  $ctrl->width}} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.8.2/ol.min.css" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.8.2/ol.min.js" type="text/javascript"></script>
    <?php if(file_exists('public/plan/'.@$map.'/leaflet.html')&&false):?>
    <iframe src="{{$link_map}}/public/plan/{{@$map}}/openlayers.html" style="width:100%; height:100%" id="frame_quyhoach" frameborder="0"></iframe>

    <?php endif?>


    <?php if(!file_exists('public/plan/'.@$map.'/leaflet.html')):?>
    <div class="panel_thongbao modal-body">
        <!-- <div class="animatelater completionwrap animatenow">
			   <svg class="completion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 96 101">
                  <g class="configurator">
                    <g class="configurator_completion">
                      <g class="stars">
                        <circle id="Oval" class="st0" cx="14" cy="18" r="1"/>
                        <circle id="Oval-Copy-4" class="st0" cx="27" cy="20" r="1"/>
                        <circle id="Oval-Copy-10" class="st0" cx="76" cy="20" r="1"/>
                        <circle id="Oval-Copy-2" class="st0" cx="61.5" cy="12.5" r="1.5"/>
                        <circle id="Oval-Copy-9" class="st0" cx="94" cy="53" r="1"/>
                        <circle id="Oval-Copy-6" class="st0" cx="88" cy="14" r="1"/>
                        <circle id="Oval-Copy-7" class="st0" cx="59" cy="1" r="1"/>
                        <circle id="Oval_1_" class="st0" cx="43" cy="9" r="2"/>
                        <path id="ster-01" class="st0" d="M28.5 3.8L26 6l2.2-2.5L26 1l2.5 2.2L31 1l-2.2 2.5L31 6z"/>
                        <path id="ster-01" class="st0" d="M3.5 50.9l-2.1 2.4 1.7-2.7-2.9-1.2 3.1.8.2-3.2.2 3.2 3.1-.8-2.9 1.2 1.7 2.7z"/>
                        <path id="ster-01" class="st0" d="M93.5 27.8L91 30l2.2-2.5L91 25l2.5 2.2L96 25l-2.2 2.5L96 30z"/>
                        <circle id="Oval-Copy-5" class="st0" cx="91" cy="40" r="2"/>
                        <circle id="Oval-Copy-3" class="st0" cx="7" cy="36" r="2"/>
                        <circle id="Oval-Copy-8" class="st0" cx="7.5" cy="5.5" r=".5"/>
                      </g>
                    </g>
                  </g>
                  <g class="cirkel">
                    <g class="Mask">
                      <path id="path-1_1_" class="st1" d="M49 21c22.1 0 40 17.9 40 40s-17.9 40-40 40S9 83.1 9 61s17.9-40 40-40z"/>
                    </g>
                  </g>
                  <path class="check st2" d="M31.3 64.3c-1.2-1.5-3.4-1.9-4.9-.7-1.5 1.2-1.9 3.4-.7 4.9l7.8 10.4c1.3 1.7 3.8 1.9 5.3.4L71.1 47c1.4-1.4 1.4-3.6 0-5s-3.6-1.4-5 0L36.7 71.5l-5.4-7.2z"/>
                </svg>
           
            </div>-->
        <div class="row">
            <div class="note blockcont text-center col-sm-8 col-sm-offset-2">
                Dữ liệu đang được cập nhật
            </div>
        </div>
    </div>
    <?php endif?>

    <div id="map_quyhoach" style="height: 80vh;"></div>
    <input id="slider" type="range" min="0" max="1" step="0.1" value="1" oninput="layer.setOpacity(this.value)" />
    <?php
	$url =  $link_map."/public/plan/".$map."/metadata.json";
    $meta =  file_get_contents("I:/web/static.dyndns.top/public/plan/".$map."/metadata.json");
	//$meta = file_get_contents($url);
	$m = json_decode($meta);

    ?>

    <script type="text/javascript">
        var mapExtent = ol.proj.transformExtent([<?=@$m->bounds['0']?>, <?=@$m->bounds['1']?>, <?=@$m->bounds['2']?>, <?=@$m->bounds['3']?>], 'EPSG:4326', 'EPSG:3857');
        var mapMinZoom = 15;
        var mapMaxZoom = 22;
        var layer = new ol.layer.Tile({
            extent: mapExtent,
            source: new ol.source.XYZ({
                attributions: [new ol.Attribution({ html: '1-12' })],
                url: "{{$link_map}}/public/plan/{{@$map}}/{z}/{x}/{y}.png",
                tilePixelRatio: 2.000000,
                minZoom: mapMinZoom,
                maxZoom: mapMaxZoom
            })
        });
        var osm = new ol.layer.Tile({
            source: new ol.source.OSM()
        });

        var map = new ol.Map({
            target: 'map_quyhoach',
            layers: [
                osm,
                layer
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([106.697686, 10.798458]),
                zoom: 16
            })
        });
    </script>

    <!---
    <script type="text/javascript">
    var mapExtent = [<?=@$m->bounds['0']?>, <?=@$m->bounds['1']?>, <?=@$m->bounds['2']?>, <?=@$m->bounds['3']?>];
    var mapMinZoom = 0;
    var mapMaxZoom = 6;
    var mapMaxResolution = 1.00000000;
    var tileExtent = [<?=@$m->bounds['0']?>, <?=@$m->bounds['1']?>, <?=@$m->bounds['2']?>, <?=@$m->bounds['3']?>];
    var tileWidth = 512;
    var tileHeight = 512;

    var mapResolutions = [];
    for (var z = 0; z <= mapMaxZoom; z++) {
      mapResolutions.push(Math.pow(2, mapMaxZoom - z) * mapMaxResolution);
    }

    var mapTileGrid = new ol.tilegrid.TileGrid({
      tileSize: [tileWidth, tileHeight],
      extent: tileExtent,
      minZoom: mapMinZoom,
      resolutions: mapResolutions
    });

    var layer = new ol.layer.Tile({
      source: new ol.source.XYZ({
        projection: 'PIXELS',
        tileGrid: mapTileGrid,
          url: "{{$link_map}}/public/plan/{{@$map}}/{z}/{x}/{y}.png"
      })
    });

    var map = new ol.Map({
      target: 'map',
      layers: [
        layer,
      ],
      view: new ol.View({
        projection: ol.proj.get('PIXELS'),
        extent: mapExtent,
        maxResolution: mapTileGrid.getResolution(3)
      })
    });
    map.getView().fit(mapExtent, map.getSize());
    </script>-->
</div>
