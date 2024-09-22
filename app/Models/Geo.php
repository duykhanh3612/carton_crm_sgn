<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Cache;
use Form;

class Geo extends Model
{

    /**
     * Country Select
     *
     * @return void
     */
    public static function CountrySelect($options = [], $value = null)
    {
        $country = Cache::remember(@$options['name'], 60, function () {
            return DB::table('geo_country')->pluck('name', 'iso_code_3')->toArray();
        });
        return Form::select(@$options['name'], $country, $value, @$options);
    }
    public static function getCountryOptions()
    {
        $country =  DB::table('geo_country')->orderBy('name', 'asc')->get();
        $arr_country    = \h::array_group_alone($country->toArray(), "country_id", "name", true);
        return $arr_country;
    }
    public static function getCountryName($id)
    {
        $country = md::scalar("geo_country", "country_id='$id'", "name");
        return $country;
    }
    public static function getProvinceName($id)
    {
        $province_name = md::scalar("geo_province", "id='$id'", "name");
        return $province_name;
    }

    public static function getProvince()
    {
        $province =  DB::table('geo_province')->orderBy('name', 'asc')->get();
        $province = convertObject($province);
        return $province;
    }

    public static function getProvinceOptions()
    {
        $province =  DB::table('geo_province')->orderBy('name', 'asc')->get();
        $options[] = "Chọn Tỉnh Thành";
        foreach ($province as $d) {
            $options[$d->id] = $d->name;
        }
        return $options;
    }
    public static function getDistrict($province_id)
    {
        $district =  DB::table('geo_district')->where('province_id', '=', (int)$province_id)->orderBy('name', 'asc')->get();
        $district = convertObject($district);
        return $district;
    }
    public static function getDistrictName($id)
    {
        $province_name = md::scalar("geo_district", "id='$id'", "name");
        return $province_name;
    }

    public static function getDistrictOptions($province_id = 0, $json = false)
    {
        $province = DB::table('geo_district')->where('province_id', '=', $province_id)->orderBy('name', 'asc')->get();
        $province = convertObject($province);
        if (!$json) {
            $options = array();
            $options = ["" => "Chọn Quận Huyện"];
            foreach ($province as $d) {
                $options[$d->id] =  $d->type . ' ' . $d->name;
            }
            return $options;
        } else {
            return response()->json($province);
        }
    }
    public static function getWard($province_id)
    {
        $ward =  DB::table('geo_ward')->where('district_id', '=', (int)$province_id)->orderBy('name', 'asc')->get();
        $ward = convertObject($ward);
        return $ward;
    }
    public static function getWardName($id)
    {
        $province_name = md::scalar("geo_ward", "id='$id'", "name");
        return $province_name;
    }
    public static function getWardOptions($district_id = 0, $json = NULL)
    {
        $ward = DB::table('geo_ward')->where('district_id', '=', (int)$district_id)->orderBy('name', 'asc')->get();
        $ward = convertObject($ward);
        if ($json == NULL) {
            $options = array();
            $options[] = "Chọn Phường Xã";
            foreach ($ward as $d) {
                $options[$d->id] = $d->type . ' ' . $d->name;
            }
            return $options;
        } else {
            return response()->json($ward);
        }
    }

    public function districts()
    {
        return $this->hasMany('District');
    }

    public static function name($id)
    {
        if (!empty($id)) {
            $province = Province::find($id);
            return ($province->name) ? $province->name : '';
        }
        return null;
    }
}
