<?php

namespace Modules\Admin\Model;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Model\Order\OrderDetail;
use DB;
use Carbon\Carbon;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];
    protected $owner = "orders.created_by";
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            //   self::updateSummary($model);
            DB::table("orders")->where('id', $model->id)->update(['status' => 1]);
        });
        self::updated(function ($model) {
            if (intval($model->status) == 0) {
                DB::table("orders")->where('id', $model->id)->update(['status' => 1]);
            }
            // self::updateLog($model);
        });
    }
    public static function renderCode()
    {
        $prefix = "PX";
        $id = DB::table('orders')->max('id') + 1;
        $code = $prefix . str_pad($id, 6, '0', STR_PAD_LEFT);
        return $code;
    }
    public function scopeFilter($q, $params = [])
    {
        if (request('keywords')) {
            $keyword = "%" . request('keywords') . "%";
            $q = $q->where(function ($query) use ($keyword) {
                $query->where("code", "like", $keyword)->orWhereIn("customer_id", function ($q) use ($keyword) {
                    $q->select("id")->from("customers")->where("full_name", "like", $keyword)
                        ->orWhere("phone", "like", $keyword)
                        ->orWhere("code", "like", $keyword);
                });
            });
        }
        if (request('min_price') > 0 and request('min_price')) {
            $q = $q->where("price", ">=", request("min_price"))->where("price", "<=", request('max_price'));
        }
        if (request('min_area') > 0 and request('max_area')) {
            $q = $q->where("area", ">=", request("min_area"))->where("area", "<=", request('max_area'));
        }

        if (isset($params['min_price']) && isset($params['province_id'])) {
            $q = $q->where("province_id", $params['province_id']);
        }

        if (isset($params['status'])) {
            $q = $q->where("status", $params['status']);
        }
        if (isset($params['cashier'])) {
            $q = $q->where("cashier", $params['cashier']);
        }
        if (isset($params['saler_id'])) {
            $q = $q->where("saler_id", $params['saler_id']);
        }
        if (isset($params['customer_id'])) {
            $q = $q->where("customer_id", $params['customer_id']);
        }
        if (isset($params['date']['form']) && isset($params['date']['to'])) {

            $q = $q->where("date", ">=", $params['date']['form'] . " 00:00:00");
            $q = $q->where("date", "<=", $params['date']['to'] . " 23:59:59");
        }
        if (!isAdmin() && isset($this->owner)) {
            // $q->where($this->owner, auth()->user()->id)->orWhere('saler_id', auth()->user()->id);
        }
        $q = $q->where("deleted", 0);
        if (!empty(request("sort_field"))) {
            $q = $q->orderByRaw("orders.id desc");
        } else {
            $q = $q->orderBy(request("sort_field") ?? "id", request("sort_order") ?? "asc");
        }
        return $q;
    }
    public function scopeReport($q, $params = [])
    {
        $request = request();

        if ($request->fromDate && $request->toDate) {

            $formDate = date("Y-m-d", strtotime(str_replace('/', '-', $request->fromDate)));
            $toDate = date("Y-m-d", strtotime(str_replace('/', '-', $request->toDate)));
            $q = $q->where("date", ">=",  $formDate . " 00:00:00");
            $q = $q->where("date", "<=", $toDate . " 23:59:59");
        } else {
            switch ($request->filter_type) {
                case 1:
                    $date_range = $this->getStartAndEndDate();
                    $q = $q->where("date", ">=", $date_range['startDate'] . " 00:00:00");
                    $q = $q->where("date", "<=", $date_range['endDate'] . " 23:59:59");
                    break;
                case 2:
                    $date_range  = date("Y-m");
                    $q = $q->where("date", 'like', $date_range . "%");
                    break;
                case 3:
                    $date_range = $this->getQuarterRange();
                    $q = $q->where("date", ">=", $date_range['startDate'] . " 00:00:00");
                    $q = $q->where("date", "<=", $date_range['endDate'] . " 23:59:59");
                    break;
            }
        }
        // $q = $q->where("deleted", 0)->where('status', '<>', 5);
        $q = $q->where("deleted", 0)->whereIn('status', [2, 3, 4]);
        return $q;
    }

    public function scopeReportToday($q, $params = [])
    {

        if ($params == "in_day") {
            $q = $q->where("date", "like", date("Y-m-d") . "%");
        } else
            $q = $q->whereIn("id", function ($q) {
                $q->select('id')->from("orders")->where("date", "like", date("Y-m-d") . "%");
            });

        $q = $q->where("deleted", 0)->where("status", "<>", 5);
        return $q;
    }
    public function scopeSummary($q, $params = [])
    {
        $q = $q->where("deleted", 0)->where("status", "<>", 5);
        switch ($params['type']) {
            case 'week':
                $date_range = $this->getStartAndEndDate();
                $q = $q->where("date", ">=", $date_range['startDate'] . " 00:00:00");
                $q = $q->where("date", "<=", $date_range['endDate'] . " 23:59:59");
                break;
            case 'last_week':
                $date_range = $this->getStartAndEndDate(date('W') - 1);
                $q = $q->where("date", ">=", $date_range['startDate'] . " 00:00:00");
                $q = $q->where("date", "<=", $date_range['endDate'] . " 23:59:59");
                break;
            case 'month':
                $date_range  = date("Y-m");
                $q = $q->where("date", 'like', $date_range . "%");
                break;
            case 'last_month':
                $date_range  = date("Y") . "-" . (date('m') - 1);
                $q = $q->where("date", 'like', $date_range . "%");
                break;
            case 'between':
                $q = $q->where("date", ">=", $params['startDate'] . " 00:00:00");
                $q = $q->where("date", "<=", $params['endDate'] . " 23:59:59");
                break;
        }
        return $q;
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, "order_id", "id");
    }
    public function customer($fields = null)
    {
        if ($fields != null) {
            return $this->BelongsTo(Customer::class, "customer_id", "id")->select($fields);
        } else return $this->BelongsTo(Customer::class, "customer_id", "id");
    }
    public function sale()
    {
        return $this->BelongsTo(Users::class, "saler_id", "id");
    }
    public function store()
    {
        return $this->BelongsTo(Store::class, "store_id", "id");
    }
    function getQuarterRange($quarter = null, $year = null)
    {
        if ($quarter == null) {
            $curMonth = date("m", time());
            $quarter = ceil($curMonth / 3);
        }
        if ($year == null)
            $year = date('Y');

        $startDate = date('Y-m-d', strtotime($year . '-' . (($quarter * 3) - 2) . '-1'));
        $endDate = date('Y-m-d', strtotime(date('Y-m-d', strtotime($startDate)) . '+3 month - 1 day'));
        return ['startDate' => $startDate, 'endDate' => $endDate];
    }
    public function getStartAndEndDate($week = "", $year = "")
    {
        if ($week == "") {
            $week = date("W");
        }
        if ($year == "") {
            $year = date("Y");
        }
        $dto = new \DateTime();
        if (strpos(",", $week) !== true) {
            $week = explode(",", $week)[0];
        }
        $dto->setISODate($year, $week);
        $ret['startDate'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['endDate'] = $dto->format('Y-m-d');
        return $ret;
    }
    function quarter_day($time = "")
    {

        $time = $time ? strtotime($time) : time();
        $date = intval(date("j", $time));
        $month = intval(date("n", $time));
        $year = intval(date("Y", $time));

        // get selected quarter as number between 1 and 4
        $quarter = ceil($month / 3);

        // get first month of current quarter as number between 1 and 12
        $fmonth = $quarter + (($quarter - 1) * 2);

        // map days in a year by month
        $map = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        // check if year is leap
        if (((($year % 4) == 0) && ((($year % 100) != 0) || (($year % 400) == 0)))) $map[1] = 29;

        // get total number of days in selected quarter, by summing the relative portion of $map array
        $total = array_sum(array_slice($map, ($fmonth - 1), 3));

        // get number of days passed in selected quarter, by summing the relative portion of $map array
        $map[$month - 1] = $date;
        $day = array_sum(array_slice($map, ($fmonth - 1), ($month - $fmonth + 1)));

        return "Day $day on $total of quarter $quarter, $year.";
    }

    public static function updateLog($content, $content_changed, $title = "")
    {
        $content_result = [];
        try {
            if ($title == "") {
                $title = self::getMessageLog($content, $content_changed,  $content_result);
            }
            $data = [
                'order_id' => $content_changed->id,
                'user_id' => auth()->user()->id,
                'owner' => 'user',
                'user_name'  => auth()->user()->user_name,
                'user_full_name' => auth()->user()->full_name,
                'content' => json_encode($content),
                'content_changed' => json_encode($content_changed),
                'content_result' => json_encode($content_result),
                'title' => $title
            ];
            OrderLog::create($data);
        } catch (\Throwable $e) {
            write_log($e->getMessage(), "EstateUpdateLog");
        }
    }
    public static function getMessageLog($content, $content_changed, &$content_result)
    {
            // Convert data if needed
        $content = convert_data($content, true);
        $content_changed = convert_data($content_changed, true);

        $ignored_fields = ["created_at", "updated_at", "created_by", "deleted","items"];

        // Merge the keys of both arrays to loop once and handle additions, deletions, and updates in one go
        $all_keys = array_unique(array_merge(array_keys($content), array_keys($content_changed)));

        foreach ($all_keys as $key) {
            $old_value = \Arr::get($content, $key);
            $new_value = \Arr::get($content_changed, $key);

            // Handle deleted fields (present in old content but missing in changed content)
            if (!array_key_exists($key, $content_changed)) {
                $content_result['deleted'][$key] = $old_value;
                continue;
            }

            // Handle added fields (present in changed content but missing in old content)
            if (!array_key_exists($key, $content)) {
                $content_result['add'][$key] = $new_value;
                continue;
            }

            // Handle updated fields (value changed and not in the ignored fields)
            if ($old_value != $new_value && !in_array($key, $ignored_fields)) {
                $content_result['update'][$key] = $new_value;
            }
        }

        // Generate message for added and deleted entries
        $title = "";
        $result = [];

        foreach ($content_result as $action => $items) {

            foreach ($items as $key => $value) {
                $old_value = \Arr::get($content, $key);
                $new_value = \Arr::get($content_changed, $key);
                if($key == "items")
                {

                }
                else{
                    if ($action == 'deleted') {
                        $title .= "Xóa dữ liệu: " . $value . "\n";
                    } elseif ($action == 'add') {
                        $title .= "Thêm dữ liệu: " . $value . "\n";
                    }
                    else{
                        if ($key == "status") {
                            $status = OrderStatus::pluck("name", "id")->toArray(); // Cache status names
                            $old_status = @$status[$old_value] ?? '';
                            $new_status = @$status[$new_value] ?? '';
                            $result[] = trans($key) . " : '" . $old_status . "'=>'" . $new_status . "'";
                        } else {
                            $result[] = trans($key) . " : '" . $old_value . "'=>'" . $new_value . "'";
                        }
                    }
                }

            }
        }
        // Combine title and result updates
        if (!empty($result)) {
            $title .= "Điều chỉnh thông tin: \n" . implode(", \n", $result);
        }

        return $title ?: '';
    }
    public static function updateSummary($model)
    {
        $items =  OrderDetail::where('order_id',  $model->id)->get();
        $order = Order::where('id', $model->id)->first();
        if (!empty($items)) {
            $totalQty = 0;
            $total = 0;
            $subTotal = 0;
            $discount = 0;
            foreach ($items as $item) {
                $subTotal +=  convert_decimal($item->total_price);
                $totalQty += $item->qty;
            }

            $data_summary = [
                'discount_code' => $model->discount_code,
                'discount_value' => $model->discount_value,
                'subTotal' => $subTotal,
                'qty' => $totalQty,
            ];
            //Handel auto cal shipment
            // $shipment = Shipment::getFee($model->shipping_district, $subTotal);
            // $data_summary['shipping_fee'] = $shipment['fee'];
            $shipment['fee'] = convert_decimal($order->shipping_fee);
            $data_summary['total'] = convert_decimal($data_summary['subTotal']) + convert_decimal(@$model['vat'])  + convert_decimal(@$shipment['fee']) - convert_decimal($order->discount_value);
            $data_summary['debt'] =  $data_summary['total'] - intval($order->total_paid);
            \App\Helpers\LogHelper::write($data_summary, "updateSummary");
            DB::table("orders")->where('id', $model->id)->update($data_summary);
        }
    }

    public static function getWeeklySales($type = null, $return = "")
    {
        $q = new self();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = date('Y-m-d', strtotime($startOfWeek . " +6 day"));
        if ($type == "last_week") {
            $startOfWeek = date('Y-m-d', strtotime($startOfWeek . " -7 day"));
            $endOfWeek = date('Y-m-d', strtotime($startOfWeek . " +6 day"));
        }

        $query = Db::table(DB::raw("(select '1' as weekday   UNION select '2' as weekday  UNION   select '3' as weekday  UNION select '4' as weekday UNION  select '5' as weekday UNION select '6' as weekday  UNION select '7' as weekday) as n"))
            ->selectRaw("n.weekday,m.sale_date,IFNULL(m.total_sales,0) as total_sales");
        $query->leftJoin(DB::raw(
            "(
                select WEEKDAY(date)+1 AS weekday, DATE(date) AS sale_date, SUM(total) AS total_sales
                from orders
                where date >= '$startOfWeek' and date <=  '$endOfWeek 11:59:59' and deleted=0 and status <> 5
                group by DATE(date) ORDER BY(sale_date)) as m"
        ), function ($q) {
            $q->on("n.weekday", "=", "m.weekday");
        });

        if ($return  == "array") {
            return $query->get()->pluck("total_sales")->toArray();
        } elseif ($return  == "string") {
            return implode(",", $query->get()->pluck("total_sales")->toArray());
        } else {
            return  $query->get();
        }
    }
}
