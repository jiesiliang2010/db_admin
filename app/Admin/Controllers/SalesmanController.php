<?php

namespace App\Admin\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//导购审核模块功能
//author:陈国宾
//2020.4.9
class SalemanController extends Controller
{
    //搜索过滤
    private function filter($query,$where){
        if($where['salesman_no']){
            $query->where("a.salesman_no",$where['salesman_no']);
        }

        if($where['realname']){
            $query->where("a.realname",$where['realname']);
        }

        if($where['nickname']){
            $query->where("a.nickname",$where['nickname']);
        }

        if($where['id_card']){
            $query->where("a.id_card",$where['id_card']);
        }

        if($where['gender']){
            $query->where("a.gender",$where['gender']);
        }

        if($where['tel']){
            $query->where("a.tel",$where['tel']);
        }

        return $query;
    }

    //导购列表
    public function list(Request $request){
        $where['realname'] = $request->input("realname");
        $where['nickname'] = $request->input("nickname");
        $where['id_card'] = $request->input("id_card");
        $where['gender'] = $request->input("gender");
        $where['tel'] = $request->input("tel");

        $query = DB::table("salesman as a");

        $query = $this->filter($query,$where);

        $res = $query->select("a.*")
            ->paginate(15);

        return $this->ok($res);
    }

    //导购详情
    public function detail(Request $request){
        $where['salesman_no'] = $request->input("salesman_no");

        $query = DB::table("salesman as e");

        $query = $this->filter($query,$where);

        $query = DB::table("salesman as a");

        $query = $this->filter($query,$where);

        $res = $query->select("a.*")
            ->first();

        return $this->ok($res);
    }

    //处理导购状态,记录日志
    public function update(Request $request){
        $insert ['salesman_id'] = $request->input("salesman_id");
        $insert['type'] = $request->input("type");
        $insert['operator_id'] = Auth::guard("admin")->id();
        $insert['remark'] = $request->input("remark");

        $save['status'] = $insert['type']!=3?:1;

        DB::beginTransaction();
        $save_res = DB::table("salesman")
            ->where("id",$insert['salesman_id'])
            ->save($save);

        $log_res = DB::table("salesman_log")
            ->insert($insert);

        if($save_res && $log_res){
            DB::commit();
            return $this->ok(1);
        }

        DB::rollBack();
        return $this->error("操作失败");
    }
}
