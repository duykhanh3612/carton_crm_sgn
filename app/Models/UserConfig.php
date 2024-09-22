<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class UserConfig extends Model
{
    const DN_KEY = 'keyword';
    const DN_VAL = 'value';
    const HS_TITLE = 'title';
    const HS_MULTIPLE = 'hs_multiple';
    const HS_SEPARATOR = 'hs_separator';
    const HS_DATA_TYPE = 'hs_data_type';
    const HS_IS_MAP_FIELD = 'is_map_field';
    const HS_WITH_TITLE = 'with_option_title_';
    protected $guarded = [];
    protected $table = 'config';
    protected static $userSettings;
    // protected $primaryKey = 'hs_key';
    protected $fillable = [
        'keyword', 'value', 'content'
    ];

    public static function getAllSettings($reset = false)
    {
        if (empty(static::$userSettings) || $reset) {
            $defaultSettings = config('default_settings')??[];
            $allSettings = self::query()->select([self::DN_VAL, self::DN_KEY])
                ->pluck(self::DN_VAL, self::DN_KEY)->toArray();
            static::$userSettings = array_replace_recursive($defaultSettings, $allSettings);
        }
        return static::$userSettings;
    }
    public static function switchToCurrentDatabase()
    {
        $dbConnection =  env("DB_CONNECTION") ?? "mysql";
        $dbHost = env("DB_HOST") ?? "localhost";
        $dbPort = env("DB_PORT") ?? "3306";
        $dbName = env("DB_DATABASE") ?? "vanke22_h79";
        $dbUser = env("DB_USERNAME") ?? "root";
        $dbPassword = env("DB_PASSWORD") ?? "root";
        Config::set('database.default',  $dbConnection);
        Config::set('database.connections.' . $dbConnection . '.host',  $dbHost);
        Config::set('database.connections.' . $dbConnection . '.port',  $dbPort);
        Config::set('database.connections.' . $dbConnection . '.database', $dbName);
        Config::set('database.connections.' . $dbConnection . '.username',  $dbUser);
        Config::set('database.connections.' . $dbConnection . '.password',  $dbPassword);

        DB::purge($dbConnection);
        DB::reconnect($dbConnection);
    }

    public static function switchToGroupDatabase($group)
    {
        if (file_exists(base_path('public/' . @$group . "/.env"))) {
            $env = parse_ini_file(base_path('public/' . @$group . "/.env"), true, true);
            if (!empty($env)) {
                Config::set('database.default',  $env["DB_CONNECTION"]);
                Config::set('database.connections.' . $env["DB_CONNECTION"] . '.host',  $env["DB_HOST"]);
                Config::set('database.connections.' . $env["DB_CONNECTION"] . '.port',  $env["DB_PORT"]);
                Config::set('database.connections.' . $env["DB_CONNECTION"] . '.database', $env["DB_CONNECTION"] == "sqlite" ? base_path($env["DB_DATABASE"]) : $env["DB_DATABASE"]);
                Config::set('database.connections.' . $env["DB_CONNECTION"] . '.username',  $env["DB_USERNAME"]);
                Config::set('database.connections.' . $env["DB_CONNECTION"] . '.password',  $env["DB_PASSWORD"]);
                DB::purge($env["DB_CONNECTION"]);
                DB::reconnect($env["DB_CONNECTION"]);
            }
        }
    }
    public static function switchToMainDatabase()
    {
        Config::set('database.connections.mongodb.database', 'springboard');
        DB::purge('mongodb');
        DB::reconnect('mongodb');
        self::$userSettings = null;
    }

    public static function switchToClientDatabase($clientId)
    {
        $currentDatabase = config('database.connections.mongodb.database');
        $newDatabase = 'springboard_' . $clientId;
        if ($currentDatabase !== $newDatabase) {
            Config::set('database.connections.mongodb.database', $newDatabase);
            DB::purge('mongodb');
            DB::reconnect('mongodb');
            self::$userSettings = null;
        }
    }

    public static function getUTCMidnight($timezone = 'UTC')
    {
        date_default_timezone_set($timezone);
        $midnight = strtotime('midnight');
        $offset = date('Z');
        $midnight -= $offset;
        $midnight = date(self::HS_ATOM_DATE_FORMAT, $midnight);

        return $midnight;
    }

    /**
     * @param string $prefix Prefix of key on mapping field
     * @param string $keyField Key on return results
     * @param string $type nondimension|category|noncategory
     *
     * @return array
     */
    public static function getMappedFields($prefix, $keyField, $type = '')
    {
        $userSettings = self::getAllSettings();
        $customFields = CustomField::all()->toArray();
        $dimensions = $nonDimensions = $categories = array();

        foreach ($userSettings as $itemKey => $setting) {
            if (strpos($itemKey, $prefix) !== false && !empty($setting['field'])) {
                $key = substr($itemKey, strlen($prefix));
                $spField = $setting['field'];
                $finalField = $spField;
                $customFieldId = '';

                if (is_numeric($spField)) {
                    $index = array_search($spField, array_column($customFields, 'id'));

                    if ($index !== false) {
                        $finalField = $customFields[$index]['key'];
                        $customFieldId = $customFields[$index]['id'];
                    }
                }

                $result = array(
                    'customFieldId' => $customFieldId,
                    $keyField => $key
                );

                if (empty($setting['is_dimension'])) {
                    if (empty($setting['level'])) {
                        $nonDimensions[$finalField] = $result;
                    }
                } else {
                    if ($type != '') {
                        $dimensions[$finalField] = $result;
                    } else {
                        $dimensions[$key] = array(
                            'customFieldId' => $customFieldId,
                            'spField' => $finalField
                        );
                    }
                }

                if (!empty($setting['level'])) {
                    $categories[$finalField][$setting['level']] = $result;
                    $categories[$finalField]['customFieldId'] = $customFieldId;
                }
            }
        }

        switch ($type) {
            case 'nondimension':
                $data = $nonDimensions;
                break;

            case 'category':
                $data = $categories;
                break;

            case 'noncategory':
                $data = array_merge($nonDimensions, $dimensions);
                break;

            default:
                $data = $dimensions;
        }

        return $data;
    }

    public function processSettingMultiLevel($data)
    {
        $userSetting = self::getAllSettings();
        $hsKey = $data['key'];
        $keyIndex = self::HS_KEY;
        $valueIndex = self::HS_VAL;
        $doc = array(
            $keyIndex => $hsKey,
            $valueIndex => array(
                $data['location_id'] => array(
                    $data['value_key'] => $data['value'] ?? ''
                )
            )
        );

        if (!empty($userSetting[$hsKey])) {
            $doc[$valueIndex] = array_replace_recursive($userSetting[$hsKey], $doc[$valueIndex]);
        }

        return $this->createOrSave($doc, array($keyIndex => $hsKey));
    }

    public static function getMapFieldAndType($fieldKey)
    {
        $userSettings = self::getAllSettings();
        $field = '';
        $fieldIsCustom = false;

        if (!empty($fieldKey) && !empty($userSettings[$fieldKey]['field'])) {
            $field = $userSettings[$fieldKey]['field'];
            if (is_numeric($field)) {
                $exist = CustomField::where('id', (int)$field)->first();

                if ($exist) {
                    $fieldIsCustom = true;
                    $field = $exist->key;
                }
            }
        }

        return array($field, $fieldIsCustom);
    }

    public static function getUTCDate($date = 'midnight', $timezone = 'UTC', $format = 'Y-m-d H:i:s')
    {
        $date_time = new \Datetime($date, new \Datetimezone($timezone));
        $date_time->setTimezone(new \Datetimezone('UTC'));
        return $date_time->format($format);
    }
}
