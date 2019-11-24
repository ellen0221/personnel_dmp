<?php

namespace App\Http\Controllers;

use App\Department;
use App\Post;
use App\Reward;
use App\Salary;
use App\Staff;
use App\StaffCourse;
use App\Admin;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    // 管理员认证
    public function authenticate(Request $request)
    {
        $login = $request->input('staff');
        if (Auth::attempt(['username' => $login['username'], 'password' => $login['password']])) {
            // 认证通过...
            return redirect('api/info/index');
        } else {
            return view('auth.login', [
                'error' => '用户名或密码错误',
            ]);
        }
    }

    // 职工信息
    public function index($sort = 0, Request $request)
    {
        $result = null;
        // 搜索功能
        if ($request->isMethod('POST')) {
            $keywords = $request->input('keywords');
            $result = Staff::leftjoin('department_info as b', 'staff_info.department_id', '=', 'b.id')
                ->leftJoin('post_info as c', 'staff_info.post_id', '=', 'c.id')
                ->where('staff_info.id', 'like', '%' . $keywords . '%')->orWhere('staff_info.truename', 'like', '%' . $keywords . '%')
                ->select('staff_info.*', 'b.name as dep_name', 'c.name as post_name')
                ->paginate(15);
        } else {
            $result = Staff::leftjoin('department_info as b', 'staff_info.department_id', '=', 'b.id')
                ->leftJoin('post_info as c', 'staff_info.post_id', '=', 'c.id')
                ->select('staff_info.*', 'b.name as dep_name', 'c.name as post_name')
                ->orderBy('id', $sort ? 'esc' : 'desc')
                ->paginate(15);
        }
        return view('info.staff.index', [
            'info' => $result,
            'sort' => $sort,
        ]);
    }

    // 新增及修改
    public function create(Request $request)
    {
        $data = $request->input('Info');
        if ($request->isMethod('POST')) {
            if (isset($data['staff_id'])) {
                $info = Staff::find($data['staff_id']);    //获取该用户数据
                $info->truename = $data['truename'];
                $info->age = $data['age'];
                $info->sex = $data['sex'] ? $data['sex'] : 1;
                $info->post_id = $data['post_id'];
                $dep_id = Post::where('id', $data['post_id'])->value('department_id');
                $info->department_id = $dep_id;
                $info->education = $data['education'];
                if ($info->save()) {
                    return $this->message(1, url('api/info/index'), 1, '修改成功！');
                } else {
                    return $this->message(1, url('api/info/index'), 0, '修改失败！');
                }
            } else {
                $is_exist = Staff::where('username', $data['username'])->count();
                if ($is_exist) {
                    return $this->message(1, url('api/info/create'), 0, '该用户名已存在！');
                }

                $dep_id = Post::where('id', $data['post_id'])->value('department_id');
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $data['department_id'] = $dep_id;
                $staff_id = Staff::insertGetId($data);
                $result = $this->createstaff($staff_id, $data['username']);
                if ($result) {
                    return $this->message(1, url('api/info/index'), 1, '添加成功');
                } else {
                    return $this->message(1, url('api/info/index'), 0, '添加失败！');
                }
            }
        } else {
            $dep_post = Post::leftjoin('department_info as a', 'a.id', '=', 'post_info.department_id')
                ->select('post_info.id', 'post_info.name as post_name', 'a.name as dep_name')
                ->get();

            return view('info.staff.create', [
                'post' => $dep_post,
                'info' => '',
                'message' => '',
            ]);
        }
    }

    // 工资详情
    public function getSalary(Request $request, $id=-1)
    {
        if ($id != -1) {
            $info = Salary::where('staff_id', $id)->get();
            return view('info.staff.salary',[
                'id' => $id,
                'info' => $info,
                'truename' => Staff::where('id',$id)->value('truename'),
            ]);
        }
    }

    // 录入工资
    public function salary(Request $request, $staff_id=-1)
    {
        if ($request->isMethod('POST')) {
            $info = $request->input('Info');
            $info['time'] = $info['time'].'-01';
            $res = Salary::insertGetId($info);
            if ($res) {
                return $this->message(1, url('api/info/salary', ['id' => $info['staff_id']]), 1, '录入成功');
            } else {
                return $this->message(1, url('api/info/salary/add', ['staff_id' => $info['staff_id']]), 0, '录入失败！');
            }
        } else {
            return view('info.staff.addsalary', [
                'id' => $staff_id,
                'truename' => Staff::where('id', $staff_id)->value('truename'),
            ]);
        }
    }

    // 删
    public function delete($id)
    {
        $user = Staff::find($id);
        $login = Users::where('staff_id', $id)->count();
        $admin = Admin::where('staff_id', $id)->count();
        $course = StaffCourse::where('staff_id', $id)->count();
        $reward = DB::table('staff_reward')->where('staff_id', $id)->count();
        $salary = Salary::where('staff_id', $id)->count();

        $login && Users::where('staff_id', $id)->delete();
        $admin && Admin::where('staff_id', $id)->delete();
        $course && StaffCourse::where('staff_id', $id)->delete();
        $reward && DB::table('staff_reward')->where('staff_id', $id)->delete();
        $salary && Salary::where('staff_id', $id)->delete();

        if ($user->delete()) {
            return $this->message(1, url('api/info/index'), 1, '删除成功！');
        } else {
            return $this->message(1, url('api/info/index'), 0, '删除失败！');
        }

    }

    // 详情
    public function detail($id)
    {
        $result = Staff::leftjoin('department_info as b', 'staff_info.department_id', '=', 'b.id')
            ->leftJoin('post_info as c', 'staff_info.post_id', '=', 'c.id')
            ->where('staff_info.id', $id)
            ->select('staff_info.*', 'b.name as dep_name', 'c.name as post_name')
            ->first();
        return view('info.staff.detail', [
            'info' => $result,
        ]);
    }

    // 改
    public function update($id)
    {
        $info = Staff::where('staff_info.id', $id)
            ->leftJoin('post_info as a', 'staff_info.post_id', '=', 'a.id')
            ->leftjoin('department_info as b', 'b.id', '=', 'a.department_id')
            ->select('staff_info.*', 'a.name as post_name', 'b.name as dep_name')
            ->first();
        $dep_post = Post::leftjoin('department_info as a', 'a.id', '=', 'post_info.department_id')
            ->select('post_info.id', 'post_info.name as post_name', 'a.name as dep_name')
            ->get();
        return view('info.staff.update', [
            'info' => $info,
            'post' => $dep_post,
        ]);
    }

    // 修改密码
    public function reset(Request $request)
    {
        $id = Auth::user()->staff_id;
        if ($request->isMethod('POST')) {
            $info = $request->input('Info');
            if (Auth::attempt(['staff_id' => $id, 'password' => $info['password']])) {
                $result = Admin::where('staff_id', '=', $id)
                    ->update(['password' => bcrypt($info['newpassword'])]);
                if ($result) {
                    $this->logout($request);
                    return redirect('');
                }
            } else {
                return $this->message(1, url('reset'), 0, '原密码不正确！');
            }
        }
        return view('info.staff.reset');
    }

    // 创建职工登录信息 默认密码为用户名
    public function createstaff($id, $username)
    {
        $result = new Users();
        $result->staff_id = $id;
        $result->username = $username;
        $result->password = bcrypt($username);

//        var_dump($result);

        if ($result->save()) {
            return true;
        } else {
            return false;
        }
    }

    // 管理员列表显示
    public function admin()
    {
        $admin = DB::select('SELECT staff_info.id,staff_info.name,admin.created_at from admin,staff_info
                             WHERE staff_info.id=admin.staff_id');

        return view('info.admin.index', [
            'info' => $admin,
        ]);
    }

    // 取消管理员
    public function canceladmin($id)
    {
        $isset = Staff::where('id', '=', $id)->value('is_admin');
        if ($isset) {
            Staff::where('id', $id)->update(['is_admin' => 0]);
            Admin::where('staff_id', $id)->delete();
            return $this->message(1, url('api/info/index'), 1, '取消成功！');
        } else {
            return $this->message(1, url('api/info/index'), 0, '取消失败！');
        }
    }

    // 设为管理员
    public function setadmin($id)
    {
        $admin = Admin::where('staff_id', '=', $id)->value('id');
        if ($admin) {
            Admin::find($admin)->delete();
            $res = Staff::where('id', $id)->update(['is_admin' => 0]);
        } else {
            $username = Staff::where('id', $id)->value('username');
            Staff::where('id', $id)->update(['is_admin' => 1]);
            $res = Admin::create([
                'staff_id' => $id,
                'username' => $username,
                'password' => bcrypt($id),
            ]);
        }
        if ($res) {
            return $this->message(1, url('api/info/index'), 1, '设置成功！');
        } else {
            return $this->message(1, url('api/info/index'), 0, '设置失败！');
        }
    }

    // 退出登录
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');
    }

}
