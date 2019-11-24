<?php

namespace App\Http\Controllers;

use App\Department;
use App\DepartmentPost;
use App\Post;
use App\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // 信息显示页
    public function index(Request $request)
    {
        // 搜索功能
        if ($request->isMethod('POST'))
        {
            $keywords = $request->input('keywords');
            $info = Department::where('name', 'like', '%'.$keywords.'%')
                    ->orWhere('id', 'like', '%'.$keywords.'%')
                    ->paginate(10);
        } else {
            $info = Department::paginate(10);
        }
        return view('info.department.index', [
            'info' => $info,
        ]);
    }

    // 新增及修改
    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->input('Info');
            $this->checkData($data);

            if (isset($data['id'])) {
                $dep = Department::find($data['id']);
                $dep->name = $data['name'];
                $dep->introduction = $data['introduction'];
                $res = $dep->save();
            } else {
                $info = new Department();
                $info->name = $data['name'];
                $info->introduction = $data['introduction'];
                $res = $info->save();
            }
            if ($res) {
                return $this->message(1, url('api/department'), 1, '操作成功！');
            } else {
                return $this->message(1, url('api/department'), 0, '操作失败！');
            }
        } else {
            return view('info.department.create', [
                'info' => ''
            ]);
        }
    }

    public function update($id)
    {
        $info = Department::find($id);
        return view('info.department.update', [
            'info' => $info
        ]);
    }

    // 具体岗位
    public function detail($id)
    {
        $info = Post::where('department_id',$id)->get();
        return view('info.department.detail', [
            'info' => $info,
        ]);
    }

    // 删除
    public function delete($id)
    {
        $result = Department::find($id);
        $post = $result->post()->where('department_id',$id)->delete();

        if ($result->delete() && $post) {
            return $this->message(1, url('api/department'), 1, '删除成功！');
        } else {
            return $this->message(1, url('api/department'), 0, '删除失败！');
        }
    }

    public function checkData(&$data)
    {
        if (!$data['name']) {
            return $this->message(1, url('api/department'), 0, '名称为必填项！');
        }
    }

}
