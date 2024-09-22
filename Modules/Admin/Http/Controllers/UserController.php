<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\SendMailHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\ClientLog;
use Modules\Admin\Model\Users as User;
use Modules\Admin\Model\Groups;
use Modules\Admin\Model\UsersGroup;
use Modules\Admin\Model\GroupPermission;
use Modules\Admin\Model\Functions;

use Config;
use Auth;
use DB;
class UserController extends BaseController
{
    const MISSING_CLIENT_ERROR_MESSAGE = 'Unable to update this client. Please try again.';
    protected $_middleware   = 'auth';
    protected $_guard        = '';
    protected $_excepted     = array();
    protected $_prefix       = '';
    protected $_pageTitleKey = '';
    protected $_pageTitle    = '';
    protected $_model        = null;
    protected $_key          = '';
    protected $defaultLimit = 10;


    public function index(Request $request)
    {
        request()->limit = $request->limit ? (int) $request->limit : $this->defaultLimit;
        request()->current_tab = $request->current_tab ? $request->current_tab : 1;
        request()->keywords = $request->keywords ? $request->keywords : '';
        $users = User::search()->where('user_group_id', 1)->paginate(request()->limit);
        session(['user_group_id' => 1]);
        return view('admin::user.index', [
            'records' => $users
        ]);
    }
    public function member(Request $request)
    {
        request()->limit = $request->limit ? (int) $request->limit : $this->defaultLimit;
        request()->current_tab = $request->current_tab ? $request->current_tab : 1;
        request()->keywords = $request->keywords ? $request->keywords : '';
        $users = User::search()->where('user_group_id', 2)->paginate(request()->limit);
        session(['user_group_id' => 2]);
        return view('admin::user.index', [
            'records' => $users
        ]);
    }
    public function add(Request $request)
    {
        // $user = new User();
        // return view('admin::user.update', [
        //     'record' => $user,
        //     'action' => route('admin.user.save'),
        // ]);

        if (request()->ajax()) {
            return view("plugin::carton-crm.core.update" );
        } else {
            return \Themes::render("core.update", [], true);
        }
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = [
            'record' => $user,
            'action' => route('admin.user.save'),
        ];
        if (request()->ajax()) {
            return view("plugin::carton-crm.core.update", $data );
        } else {
            return \Themes::render("core.update", $data, true);
        }

    }
    public function createUser()
    {
        $data = [];
        $username = request('username');
        $full_name = request('full_name');
        $roles = request('role');

        if (request('user_name')) {
            $data['user_name'] = request('user_name');
        }
        if (request('full_name')) {
            $data['full_name'] = $full_name;
        }

        $data['activated'] = 1;
        $data['password'] = Hash::make(request("password"));
        $data['confirm_password'] =  request("password");
        $user = User::create($data);
        if (request('role')) {
            $currentRole = UsersGroup::where('user_id', $user->id)->pluck("group_id")->toArray();
            $deleteRole =  array_diff($currentRole, $roles);
            foreach ($roles  as $role) {
                $group = Groups::where("id", $role)->first();
                UsersGroup::updateOrCreate(['user_id' => $user->id, 'group_id' => $role], ['group_name' => $group->name]);
            }

            if (!empty($deleteRole)) {
                UsersGroup::where("user_id", $user->id)->whereIn("group_id", $deleteRole)->delete();
            }
        }
        return response()->json(["success"=>true]);
    }
    public function updateRole()
    {
        $data = [];
        $username = request('username');
        $full_name = request('full_name');
        $roles = request('role');

        if (request('full_name')) {
            $data['full_name'] = $full_name;
        }

        $data['activated'] = (request('active') == "true" ? 1 : 0);

        if (request("newpassword")) {
            $data['password'] = Hash::make(request("newpassword"));
        }

        $user = User::where("user_name", $username)->first();
        $user->update($data);

        if (request('role')) {
            $currentRole = UsersGroup::where('user_id', $user->id)->pluck("group_id")->toArray();
            $deleteRole =  array_diff($currentRole, $roles);
            foreach ($roles  as $role) {
                $group = Groups::where("id", $role)->first();
                UsersGroup::updateOrCreate(['user_id' => $user->id, 'group_id' => $role], ['group_name' => $group->name]);
            }

            if (!empty($deleteRole)) {
                UsersGroup::where("user_id", $user->id)->whereIn("group_id", $deleteRole)->delete();
            }
        }
    }
    public function save(Request $request)
    {
        $logKey = __METHOD__ . '::';
        try {
            $params = $request->all();
            $id = $params['id'];
            $validator = User::storeRule($params);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors($validator);
            }
            if ($id) {
                $record = User::find($id);
                if (!$record) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors([
                            'message' => self::MISSING_CLIENT_ERROR_MESSAGE
                        ]);
                }
            } else {
                $record = new User();
            }
            unset($params['id']);
            if (empty($params['password'])) {
                unset($params['password']);
            }
            $params['approved'] = !empty($params['approved']) ? (int) $params['approved'] : 0;
            $record->fill($params);
            if (!$id) {
                $record->client_id = User::getIncrementClientId();
            }
            if (!empty($params['password'])) {
                $record->password = Hash::make($params['password']);
            }
            if (empty($record->api_token)) {
                $record->api_token = md5(microtime(true));
            }
            $record->save();
            // return redirect()->route('admin.user');
            return redirect(request('back_url'));
        } catch (\Throwable $e) {
            $clientLog = new ClientLog('admin');
            $clientLog->write($e->getMessage(), $logKey);
            return $e->getMessage();
        }
    }
    public function approve(Request $request)
    {
        $logKey = __METHOD__ . '::';
        try {
            $userIds = $request->userIds;
            User::whereIn('id', $userIds)->update(['approved' => 1]);
            return response()->json([
                'status' => 200,
                'UserIds' => $userIds
            ]);
        } catch (\Throwable $e) {
            $clientLog = new ClientLog('admin');
            $clientLog->write($e->getMessage(), $logKey);
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function delete(Request $request)
    {
        $logKey = __METHOD__ . '::';
        try {
            $userIds = $request->userIds;
            // $users = User::whereIn('id', $userIds)->delete();
            DB::table("users")->whereIn('id', $userIds)->delete();
            return response()->json([
                'status' => 200,
                'UserIds' => $userIds
            ]);
        } catch (\Throwable $e) {
            $clientLog = new ClientLog('admin');
            $clientLog->write($e->getMessage(), $logKey);
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function showFormAssign(Request $request, $id)
    {
        $user = User::find($id);
        $addons = config('addons');
        $addonsOptions = array();
        foreach ($addons as $key => $val) {
            $addonsOptions[$key] = $val['label'];
        }
        return view('admin.user.assign', [
            'record' => $user,
            'addons' => $addonsOptions,
            'title' => $user->user_name . "'s ADD-ONS"
        ]);
    }
    public function assign(Request $request)
    {
        $params = $request->all();
        $record = User::find($params['id']);
        $isStorePickup = in_array('store_pickup', $params['addons']);
        $isYotpo = in_array('yotpo', $params['addons']);
        $isInvoiced = in_array('invoiced', $params['addons']);
        if (empty($record->api_token) && $isStorePickup) {
            $params['api_token'] = md5(microtime(true));
        }
        if (empty($record->yp_token) && $isYotpo) {
            $params['yp_token'] = md5(microtime(true));
        }
        if (empty($record->invoiced) && $isInvoiced) {
            $params['invoiced_token'] = md5(microtime(true));
        }
        $record->fill($params);
        $record->save();
        return redirect()->route('admin.user');
    }
    public function forceLogin(Request $request, $id)
    {
        $guard = Config::get('constants.guard.user');
        Auth::guard($guard)->loginUsingId($id);
        return redirect()->route('user.home');
    }

    function editGroup(Request $request, $id)
    {
        $data['record']  = Groups::where("id", $id)->first();
        return view('admin::user.group', $data);
    }

    function updateGroup(Request $request)
    {
        $data = $request->toArray();
        // dd($data);

        $group  = Groups::where("id", $request->id)->first();
        $group->update([
            'name' => $data['name'],
            'permissions' =>  $request->permissions,
            'permissions_name' => $request->permissions_name
        ]);
        $permission = json_decode($request->permissions);
        $functions = Functions::pluck("name", "id")->toArray();
        foreach ($permission as $p) {
            if(isset($p->function_id))
            {
                $per = [
                    'group_name' =>  $data['name'],
                    'function_name' => @$functions[$p->function_id],
                    'read' => $p->pread,
                    'create' => $p->pcreate,
                    'update' => $p->pedit,
                    'delete' => $p->pdelete
                ];
                GroupPermission::updateOrCreate(['group_id' => $request->id, 'function_id' => $p->function_id], $per);
            }

        }
        return redirect()->back();
    }

    function updateGroupPermission(Request $request)
    {
        $group = Groups::where("id", $request->group)->first();
        $modules = \Modules\Admin\Model\Modules::where("id",$request->func)->first();
        $permission = $request->permission;
        $per = [
            'group_name' =>  $group->name,
            'function_name' => $modules->name_en,
            'read' => $permission,
            'create' => $permission,
            'update' => $permission,
            'delete' => $permission
        ];
        GroupPermission::updateOrCreate(['group_id' => $request->group, 'function_id' => $request->func], $per);
        return response()->json(['success'=>true,'data'=>$permission]);
    }

    function permission(Request $request){
        return view("admin::user.permission");
    }
}
