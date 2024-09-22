<?php

namespace Modules\Modules\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SymlinkController extends Controller
{

    function symlink(Request $request)
    {
        $routeCollection = [
            [
                'name' => "Symlink Modules",
                'uri' => 'symlink/modules',
                'note' => ''
            ],
            [
                'name' => "Symlink Api",
                'uri' => 'symlink/api',
                'note' => ''
            ],
            [
                'name' => "Symlink Order Assets",
                'uri' => 'symlink/module/order',
                'note' => ''
            ],
        ];
        $routeCollection = json_decode(json_encode($routeCollection));
        echo "<table style='width:100%'>";
        echo "<tr>";
        echo "<td width='10%'><h4>Link</h4></td>";
        echo "<td width='10%'><h4>Route</h4></td>";
        echo "<td width='10%'><h4>Name</h4></td>";
        echo "</tr>";
        foreach ($routeCollection as $value) {
            echo "<tr>";
            echo "<td>" . $value->name . "</td>";
            echo "<td><a href='" . $value->uri . "' target='_blank'>link</a></td>";
            echo "<td>" . $value->note . "</td>";
            echo "</tr>";
        }
    }

    function routes()
    {
        $routeCollection = \Route::getRoutes();
        echo "<table style='width:100%'>";
        echo "<tr>";
        echo "<td width='10%'><h4>HTTP Method</h4></td>";
        echo "<td width='10%'><h4>Route</h4></td>";
        echo "<td width='10%'><h4>Name</h4></td>";
        echo "<td width='70%'><h4>Corresponding Action</h4></td>";
        echo "</tr>";
        foreach ($routeCollection as $value) {
            echo "<tr>";
            echo "<td>" . $value->methods()[0] . "</td>";
            echo "<td>" . $value->uri() . "</td>";
            echo "<td>" . $value->getName() . "</td>";
            echo "<td>" . $value->getActionName() . "</td>";
            echo "</tr>";
        }
    }
}
