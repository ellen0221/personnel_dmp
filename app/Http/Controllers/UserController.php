<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Course;
use App\Reward;
use App\Salary;
use App\Staff;
use App\StaffCourse;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\elementType;

class UserController extends Controller
{
    // 职工登录验证
    public function staffauthenticate(Request $request)
    {
        $login = $request->input('staff');

        if (Auth::guard('staff')->attempt(['username' => $login['username'], 'password' => $login['password']]))
        {
            return redirect('/api/staff/index');
        } else {
            return view('auth.login', [
                'error' => '用户名或密码错误',
            ]);
        }
    }

    // 个人信息
    public function index()
    {
        $check = Auth::guard('staff')->check();
        if ($check)
        {
            $staff_id = Auth::guard('staff')->user()->staff_id;
            $info = Staff::find($staff_id);
            ($info->department->name) && $data['department_name'] = $info->department->name;
            ($info->post_id) && $data['post_name'] = $info->post->name;
            return view('staff.index', [
                'information' => $info,
                'data' => $data,
            ]);
        } else {
            return redirect('/');
        }
    }

    // 个人信息 - 修改
    public function edit(Request $request)
    {
        $check = Auth::guard('staff')->check();
        if ($check)
        {
            $staff_id = Auth::guard('staff')->user()->staff_id;
            if ($request->isMethod('POST')) {
                $info = $request->input('info');
                $res = Staff::where('id',$staff_id)->update($info);
                if ($res) {
                    return view('staff.index', [
                        'success' => '修改成功',
                        'information' => Staff::find($staff_id),
                    ]);
                } else {
                    return view('staff.edit', [
                        'error' => '修改失败',
                        'information' => Staff::find($staff_id),
                    ]);
                }
            } else {
                $info = Staff::find($staff_id);
                ($info->department->name) && $data['department_name'] = $info->department->name;
                ($info->post_id) && $data['post_name'] = $info->post->name;
                return view('staff.edit', [
                    'info' => $info,
                    'data' => $data,
                ]);
            }
        } else {
            return redirect('/');
        }
    }

    // 工资 - 查看
    public function salary()
    {
        if (Auth::guard('staff')->check())
        {
            $id = Auth::guard('staff')->user()->staff_id;
            $result = Staff::find($id)->salary()->get();
            return view('staff.salary', [
                'information' => $result,
            ]);
        } else {
            return redirect('/');
        }

    }

    // 奖惩记录 - 查看
    public function reward()
    {
        if (Auth::guard('staff')->check())
        {
            $staff_id = Auth::guard('staff')->user()->staff_id;
            $staff = Staff::find($staff_id);
            $info = $staff->reward()->get();
                return view('staff.reward', [
                    'info' => $info,
                ]);
        } else {
            return redirect('/');
        }
    }

    // 课程
    public function course()
    {
        if (Auth::guard('staff')->check())
        {
            $course = Course::paginate(10);

            return view('staff.select', [
                'info' => $course,
            ]);
        } else {
            return redirect('/');
        }

    }

    // 选课
    public function selected($id)
    {
        if (Auth::guard('staff')->check())
        {
            $staff_id = Auth::guard('staff')->user()->staff_id;
            $check = DB::table('staff_course')->where("staff_id",$staff_id)->where('course_id', $id)->count();
            if ($check)
            {
                return view('staff.course', [
                    'error' => '您已经选了这门课！',
                    'info' => Course::all(),
                ]);
            } else {
                $result = StaffCourse::create([
                    'staff_id' => $staff_id,
                    'course_id' => $id,
                    'created_at' => date("Y-m-d H:i:s")
                ]);
                if ($result) {
                    return view('staff.course', [
                        'success' => '选课成功！',
                        'info' => Course::all(),
                    ]);
                }
            }
        } else {
            return redirect('/');
        }
    }

    // 选课记录
    public function record()
    {
        if (Auth::guard('staff')->check())
        {
            $id = Auth::guard('staff')->user()->staff_id;
            $course = DB::table('staff_course as a')
                ->leftjoin('course_info as b', 'a.course_id', '=', 'b.id')
                ->where('a.staff_id',$id)
                ->select('a.created_at', 'a.grade', 'b.name', 'b.teacher', 'b.introduction', 'b.book', 'b.start_time', 'b.end_time')
                ->get();
            return view('staff.course', [
                'info' => $course,
            ]);
        } else {
            return redirect('/');
        }
    }

    // 修改密码
    public function reset(Request $request)
    {
        if (Auth::guard('staff')->check())
        {
            if ($request->isMethod('POST')) {
                $info = $request->input('Info');
                $id = Auth::guard('staff')->user()->staff_id;
                if (Auth::guard('staff')->attempt(['staff_id' => $id, 'password' => $info['password']]))
                {
                    $result = Users::where('staff_id','=',$id)
                        ->update(['password' => bcrypt($info['newpassword'])]);
                    if (Admin::find($id)) {
                        $result1 = Admin::where('staff_id', $id)
                            ->update(['password' => bcrypt($info['newpassword'])]);
                    }
                    if ($result)
                    {
                        $this->logout($request);
                    }
                } else {
                    return view('staff.reset', [
                        'error' => '修改失败--旧密码不正确',
                    ]);
                }
            }
            return view('staff.reset');
        } else {
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }


//    public function create()
//    {
//        $users = new Users();
//        $users->staff_id = 1;
//        $users->username = "xujing";
//        $users->password = crypt("19980824", "test");
//        $res = $users->save();
//        if ($res) {
//            return "create success and id={$res}";
//        } else {
//            return "error";
//        }
//    }
}
