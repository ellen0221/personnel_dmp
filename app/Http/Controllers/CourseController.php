<?php

namespace App\Http\Controllers;

use App\Course;
use App\Staff;
use App\StaffCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    // 信息显示页
    public function index(Request $request)
    {

        // 搜索功能
        if ($request->isMethod('POST'))
        {
            $keywords = $request->input('keywords');
            $info = Course::where('name', 'like', '%'.$keywords.'%')
                ->orWhere('id', 'like', '%'.$keywords.'%')
                ->paginate(15);
        } else {
            $info = Course::paginate(15);
        }

        return view('info.course.index', [
            'info' => $info,
        ]);
    }

    // 选课情况
    public function detail($id)
    {
        $name = Course::where("id",$id)->value('name');
        $info = StaffCourse::where('course_id', $id)
            ->leftJoin('staff_info as a', 'staff_course.staff_id', '=', 'a.id')
            ->select('staff_course.*', 'a.truename as truename')
            ->get();
        return view('info.course.detail', [
            'info' => $info,
            'course_name' => $name,
        ]);
    }

    // 新增及修改
    public function create(Request $request)
    {
        $info = new Course();

        if ($request->isMethod('POST'))
        {
            $data = $request->input('Info');

            if (isset($data['id'])) {
                $id = $data['id'];
                unset($data['id']);
//                var_dump($id);
                $res = Course::where("id", $id)->update($data);
                if ($res) {
                    return $this->message(1, url('api/course'), 1, '修改成功');
                } else {
                    return $this->message(1, url('api/course/update', ['id' => $id]), 0, '修改失败');
                }
            } else {
                if (Course::create($data)) {
                    return $this->message(1, url('api/course'), 1, '添加成功');
                } else {
                    return $this->message(1, url('api/course'), 0, '添加失败');
                }
            }
        }
        return view('info.course.create', [
            'info' => $info
        ]);
    }

    // 改
    public function update($id)
    {
        $info = Course::find($id);
        return view('info.course.update', [
            'info' => $info
        ]);
    }

    public function up_grade($id)
    {
        $info = StaffCourse::where('staff_course.id', $id)
            ->leftJoin('staff_info as a', 'staff_course.staff_id', '=', 'a.id')
            ->leftJoin('course_info as b', 'staff_course.course_id', '=', 'b.id')
            ->select('staff_course.*', 'a.truename as truename', 'b.name as course_name')
            ->first();
        return view('info.course.grade', [
            'info' => $info,
            'course_name' => $info->course_name,
        ]);
    }

    // 录入培训课程成绩
    public function grade(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $data = $request->input('Info');

            $result = StaffCourse::where('id',$data['id'])->update(['grade' => $data['grade']]);
            if ($result) {
                return $this->message(1, url('api/course/detail', ['id' => $data['course_id']]), 1, '录入成功');
            } else {
                return $this->message(1, url('api/course/detail', ['id' => $data['course_id']]), 0, '录入失败');
            }
        }
    }

    // 删
    public function delete($id)
    {
        $result = Course::find($id);
        $staff = StaffCourse::where('course_id','=',$id)->count();
        $staff && StaffCourse::where('course_id','=',$id)->delete();

        if ($result->delete()) {
            return $this->message(1, url('api/course'), 1, '删除成功');
        } else {
            return $this->message(1, url('api/course'), 0, '删除失败');
        }
    }
}
