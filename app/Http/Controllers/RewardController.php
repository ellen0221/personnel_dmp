<?php

namespace App\Http\Controllers;

use App\Reward;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RewardController extends Controller
{
    // 信息显示页
    public function index(Request $request)
    {
        // 搜索功能
        if ($request->isMethod('POST')) {
            $keywords = $request->input('keywords');
            $type = $request->input('type');
            if (!$type) {
                $info = Reward::where('name', 'like', '%' . $keywords . '%')
                    ->orWhere('id', 'like', '%' . $keywords . '%')
                    ->paginate(15);
            } else {
                $info = Reward::where('type', $type)
                    ->where('name', 'like', '%' . $keywords . '%')
                    ->paginate(15);
            }
        } else {
            $info = Reward::paginate(15);
        }

        return view('info.reward.index', [
            'info' => $info,
        ]);
    }

    // 新增及修改
    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->input('Info');
            if ($data['id']) {
                // 修改
                $info = Reward::find($data['id']);
            } else {
                $info = new Reward();
            }
            $info->name = $data['name'];
            $info->type = $data['type'];
            $info->description = $data['description'];
            $info->money = $data['money'];
            $res = $info->save();
            if ($res) {
                return $this->message(1, url('api/reward'), 1, '操作成功！');
            } else {
                return $this->message(1, url('api/reward'), 0, '操作失败！');
            }
        }
        return view('info.reward.create', [
            'info' => ''
        ]);
    }

    // 改
    public function update($id)
    {
        $info = Reward::find($id);
        return view('info.reward.update', [
            'info' => $info
        ]);
    }

    // 具体职工及添加
    public function staff(Request $request, $id=-1)
    {
        if ($id != -1) {
            $info = Reward::where('reward_info.id', $id)
                ->leftJoin('staff_reward as a', 'reward_info.id', '=', 'a.reward_id')
                ->leftJoin('staff_info as b', 'a.staff_id', '=', 'b.id')
                ->select('b.id', 'b.truename')
                ->get();

            return view('info.reward.staff', [
                'info' => $info,
                'id' => $id,
                'name' => Reward::where('id', $id)->value('name'),
            ]);
        }

        if ($request->isMethod('POST')) {
            $data = $request->input('Info');
            if ($data['id']) {
                // 修改
                $info = Reward::find($data['id']);
            } else {
                $info = new Reward();
            }
            $info->name = $data['name'];
            $info->type = $data['type'];
            $info->introduction = $data['description'];
            $info->num = $data['money'];
            $res = $info->save();
            if ($res) {
                return $this->message(1, url('api/reward/staff', ['id' => $id]), 1, '操作成功！');
            } else {
                return $this->message(1, url('api/reward/staff', ['id' => $id]), 0, '操作失败！');
            }
        }
    }

    // 添加职工
    public function staffAdd(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $data = $request->input('staff');
            DB::beginTransaction();
            try {
                $delete = DB::table('staff_reward')->where('reward_id', $id)->delete();
                if (count($data) > 1) {
                    foreach ($data as $v) {
                        DB::table('staff_reward')->insert([
                            'staff_id' => $v,
                            'reward_id' => $id,
                        ]);
                    }
                } else {
                    DB::table('staff_reward')->insert([
                        'staff_id' => $data[0],
                        'reward_id' => $id,
                    ]);
                }
                DB::commit();
            } catch (QueryException $e) {
                DB::rollback();
                return $this->message(1, url('api/reward/staff', ['id' => $id]), 0, '添加失败！');
            }
            return $this->message(1, url('api/reward/staff', ['id' => $id]), 1, '操作成功！');
        } else {
            $staff = Reward::where('reward_info.id', $id)
                ->leftJoin('staff_reward as a', 'reward_info.id', '=', 'a.reward_id')
                ->leftJoin('staff_info as b', 'a.staff_id', '=', 'b.id')
                ->select('b.id')
                ->get()->toArray();
            $staff_ids = array_column($staff, 'id');

            return view('info.reward.addStaff', [
                'name' => Reward::where('id', $id)->value('name'),
                'staff' => Staff::all(),
                'id' => $id,
                'staff_ids' => $staff_ids,
            ]);
        }
    }

    // 删
    public function delete($id)
    {
        $result = Reward::find($id);

        if ($result->delete()) {
            return $this->message(1, url('api/reward'), 1, '删除成功！');
        } else {
            return $this->message(1, url('api/reward'), 0, '删除失败！');
        }
    }

}
