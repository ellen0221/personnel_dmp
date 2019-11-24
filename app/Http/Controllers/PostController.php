<?php

namespace App\Http\Controllers;

use App\Department;
use App\DepartmentPost;
use App\Post;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    // 信息显示页
    public function index(Request $request)
    {
        // 搜索功能
        if ($request->isMethod('POST'))
        {
            $staff = $request->input('post');
            if (is_numeric($staff['id']))
            {
                $result = Post::where('id', 'like', '%'.$staff['id'].'%')->get();
                return view('info.post.findindex', [
                    'info' => $result,
                ]);
            } else {
                $res = Post::where('name', 'like', '%'.$staff['id'].'%')->get();
                return view('info.post.findindex', [
                    'info' => $res,
                ]);
            }

        } else {
            $post = Post::leftjoin('department_info as a', 'post_info.department_id', '=', 'a.id')
                ->select('a.name as dep_name', 'post_info.*')
                ->paginate(15);
            return view('info.post.index', [
                'info' => $post,
            ]);
        }
    }

    // 新增及修改
    public function create(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $data = $request->input('Info');
            $this->checkData($data);

            if (isset($data['id'])) {
                $post = Post::find($data['id']);
                $post->name = $data['name'];
                $post->introduction = $data['introduction'];
                $post->level = $data['level'] ? $data['level'] : 0;
                $post->department_id = $data['department_id'];
                $res = $post->save();
            } else {
                $info = new Post();
                $info->name = $data['name'];
                $info->introduction = $data['introduction'];
                $info->level = $data['level'] ? $data['level'] : 0;
                $info->department_id = $data['department_id'];
                $res = $info->save();
            }
            if ($res) {
                return $this->message(1, url('api/post'), 1, '操作成功！');
            } else {
                return $this->message(1, url('api/post'), 0, '操作失败！');
            }
        }
        return view('info.post.create', [
            'info' => '',
            'dep' => Department::all(),
        ]);
    }

    // 修改
    public function update($id)
    {
        $info = Post::find($id);
        return view('info.post.update', [
            'info' => $info,
            'dep' => Department::all(),
        ]);
    }

    // 删除
    public function delete($id)
    {
        $result = Post::find($id)->delete();

        if ($result) {
            return $this->message(1, url('api/post'), 1, '删除成功！');
        } else {
            return $this->message(1, url('api/post'), 0, '删除失败！');
        }
    }

    // 信息验证
    public function checkData(&$data)
    {
        if (!$data['name']) {
            return $this->message(1, url('api/post'), 0, '名称为必填项！');
        }
        if (!$data['department_id']) {
            return $this->message(1, url('api/post'), 0, '所属部门为必填项！');
        }
    }
}
