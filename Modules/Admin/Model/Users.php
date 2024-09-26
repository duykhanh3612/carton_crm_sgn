<?php

namespace Modules\Admin\Model;

use App\Traits\Model\CreateRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use DB;
use Modules\Admin\Model\Rights\ViewGroupPermission;
class Users extends Model
{

    use Notifiable, CreateRule, SoftDeletes;
    protected $table = 'users';
    protected $guarded = [];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const COLLECTION = 'users';
    // protected $dates = ['deleted_at'];

    protected $attributes = [
        'approved' => 0,
    ];
    protected $fillable = [
        'name',
        'email',
        'password',
        '_token',
        'approved',
        'company',
        'country',
        'first_name',
        'full_name',
        'phone',
        'user_name',
        'confirm_password',
        'client_id',
        'user_group_id',
        'id',
        'addons',
        'api_token',
        'logo',
        'group',
        'group_name',
        'avatar',
        'group_id',
        'yp_token',
        'invoiced_token','activated'
    ];
    // protected $guarded = array('confirm_password');

    protected $hidden = [
        'password',
        'remember_token'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        self::created(function ($model) {
            self::updateGroupPermission($model);
        });
        self::updated(function ($model) {
            self::updateGroupPermission($model);
        });
    }
    public static function getIncrementClientId()
    {
        $user = self::orderBy('created_at', 'desc')->first();
        if ($user) {
            return $user->client_id + 1;
        }

        return 1;
    }

    public static function storeRule($params)
    {
        if (!empty($params['id'])) {
            $rule_password = 'nullable';
        } else {
            $rule_password = 'required';
        }

        $validator = Validator::make(
            $params,
            [
                // 'company'          => 'bail|required|max:255',
                // 'country'          => 'bail|required|max:255',
                // 'first_name'       => 'bail|required|max:255',
                // 'last_name'        => 'bail|required|max:255',
                // 'email'            => 'bail|required|email|max:255|unique:' . self::COLLECTION . ',email,' . (!empty($params['id']) ? $params['id'] : "") . ',id',
                // 'phone'            => 'bail|required|max:255',
                'user_name'        => 'bail|required|max:255|unique:' . self::COLLECTION . ',user_name,' . (!empty($params['id']) ? $params['id'] : "") . ',id',
                'password'         => 'bail|' . $rule_password,
                'confirm_password' => 'bail|' . $rule_password . '|same:password',
            ]
        );

        return $validator;
    }

    public function scopeSearch($query)
    {
        $request = request();
        if ($request->_id != '') {
            $query = $query->where('_id', $request->_id);
        }

        if (!empty($request->group_id)) {
            $query = $query->where('group_id', (int) $request->group_id);
        }

        if (!empty($request->corporate_id)) {
            $query = $query->where('client_id', '!=' , (int) $request->corporate_id);
        }
        // $query->whereNull('deleted_at');
        if ($request->keywords != '') {
            $keywords = '%'.cleanSpecialChars($request->keywords).'%';
            $query->where(function ($q) use ($keywords) {
                $q->Where('user_name',  'like', "$keywords")
                ->orWhere('company',  'like', "$keywords")
                ->orWhere('email',  'like', "$keywords")
                ->orWhere('full_name', 'like', "$keywords")
                ->orWhere('phone',  'like', "$keywords");
            });
        }

        $query->orderBy('created_at', 'desc');
        return $query;
    }

    public static function processSave($params, $additions = array()) {
        $id = $params['_id'];
        if ($id) {
            $record = User::find($id);
            if (!$record) {
                return false;
            }
        } else {
            $record = new User();
        }
        unset($params['_id']);

        if (empty($params['password'])) {
            unset($params['password']);
        }

        if (isset($params['approved'])) {
            $params['approved'] = !empty($params['approved']) ? (int) $params['approved'] : 0;
        } else {
            if ($id) {
                $params['approved'] = $record['approved']; // Edit
            } else {
                $params['approved'] = !empty($params['default-approved']) ? 1 : 0; // Add
            }
        }

        // Add fields for special user
        if (!empty($additions)) {
            $params = array_merge($params, $additions);
        }

        $record->fill($params);

        // Get new client id if adding
        if (!$id) {
            $record->client_id = User::getIncrementClientId();
        }
        if (!empty($params['password'])) {
            $record->password = Hash::make($params['password']);
        }
        $record->save();
        if(@$additions['group_id']) {
            $group = Group::query()->where('id' , (int)$additions['group_id'])->first();
            if($group) {
                $users = $group->users ?? [];
                if(!in_array($record->client_id , $users)) {
                    $users[] = "$record->client_id";
                    $group->update(['users' => $users]);
                }
            }
        }
        if (!$id) {
            $view    = "admin.send_mail";
            $subject = env('MAIL_SUBJECT_RESISTRATION', 'Hyperspace Registration');
            SendMailHelper::sendMail($view, $record->toArray(), $subject);
        }

        return true;
    }

    public static function resetTimeForItems($ids) {
        // Update hs time for items
        if (empty($ids)) {
            return false;
        }
        $coreKeys = array();

        foreach ($ids as $id) {
            Item::updateCorporate($id);
            $coreKeys[] = 'download-update-franchise-stock-last-time-client-' . $id;
        }

        // Remove core var of franchise from corporate
        if (!empty($coreKeys)) {
            UserSetting::switchToClientDatabase(auth()->user()->client_id);
            Corevar::whereIn('core_key', $coreKeys)->delete();
        }
    }
    function UserRoles()
    {
        return $this->hasMany(UsersGroup::class,"user_id","id");
    }

    public static function getOption($empty = false, $empty_value = "Select..")
    {
        $options = self::pluck("full_name","id")->toArray();
        if($empty)
        {
            $options = array_replace([''=>$empty_value], $options );
        }
        return $options;
    }
    public static function check_right($function)
    {
        if(is_string($function))
        {
            $function  = Modules::where("file",$function)->first()->id;
        }
        $rights = ViewGroupPermission::where("user_id", auth()->user()->id)->where("function_id",$function)->first();
        if($function != null)
        {

        }
        return $rights;
    }

    public static function updateGroupPermission($model)
    {
        $groups = $model->group;
        $funcs = [];
        if ($groups != "") {
            if (!is_array($groups)) {
                $groups = json_decode($groups);
            }
            foreach ($groups as $group) {
                $group_name = Groups::where("id",$group)->first()->name;
                UsersGroup::updateOrCreate(
                    [
                        'group_id' => $group,
                        'user_id' => $model->id
                    ],
                    [
                        'user_name' => $model->full_name,
                        'group_name' => $group_name ,
                    ]
                );
                $funcs[] = $group_name;
            }
            UsersGroup::where("user_id",$model->id)->whereNotIn("group_id", $groups)->delete();
        }
        if(!empty($funcs))
        {
            DB::table('users')->where('id', $model->id)->update(['group_name' => implode(", ", $funcs)]);
        }
    }

    public static function checkRightsFunction($function = null)
    {
        $user = auth()->user()->id;
        $q = \Modules\Admin\Model\Rights\ModulesFunction::where("user_id", $user);
        if($function != null)
        {
            if(is_string($function))
            {
                $function  = ModuleFunction::where("key",$function)->first()->id;
            }
            $q = $q->where("module_function_id", $function);
            $right = $q->first();
            return $right;
        }
        $rights = $q->get()->keyBy('module_function_id');
        return $rights;
    }

    // public static function checkValidator(Request $request)
    // {
    //     $messages = [
    //         'password.required'  => 'Mật khẩu là bắt buộc',
    //         'confirm_password.required'    => 'Xác nhận mật khẩu là bắt buộc',
    //         'confirm_password.same' => 'Mật khẩu xác nhận không chính xác',
    //         'unique' => ':attribute thì đã tồn tại',
    //     ];
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             // 'password' => 'required|max:255',
    //             // 'confirm_password' => 'required|max:255|same:password'
    //             'password' => 'max:255',
    //             'confirm_password' => 'max:255|same:password'
    //         ],
    //         $messages
    //     );
    //     if ($validator->fails()) {
    //         if(request()->ajax())
    //         {
    //             return response()->json(['code' => 200, 'success' => false, 'error' => $validator->messages()], 200);
    //         }
    //         else{
    //             return ['error' => true,'message'=> $validator->messages()];
    //         }
    //     }

    // }

    public static function checkExists($docs = [], $fields = [])
    {
        $fields = ["user_name","phone","email"];
        $where = [];
        $message = [];
        $exist = false;
        foreach($fields as $key)
        {
            if($docs[$key]!="")
            {
                $where = $key." like '%".$docs[$key]."%'". (@$docs['id']!=""?" and id <> '".@$docs['id']."'":"");
                if(self::whereRaw($where)->count()>0)
                {
                    $exist = true;
                    $message[] = __($key). ' đã tồn tại';
                }
            }
        }
        $result['exist'] =  $exist;
        $result['message'] = implode(", ", $message);
        return  $result;
    }
    public static function beforeUpdate(&$doc)
    {
        if(@$doc['id']=="" && $doc['password']=="")
        {
            $result['success'] = false;
            $result['message'] =  __("password_not_empty");
            return $result;
        }
        if($doc['password']!="")
        {
            if($doc['password'] != $doc['confirm_password'])
            {
                $result['success'] = false;
                $result['message'] =  __("password_confirm_incorrect");
                return $result;
            }

            $doc['password'] = Hash::make($doc['password']);
            unset($doc['confirm_password']);
        }
        else{
            unset($doc['password']);
            unset($doc['confirm_password']);
        }
        return ['success'=>true];
    }
}
