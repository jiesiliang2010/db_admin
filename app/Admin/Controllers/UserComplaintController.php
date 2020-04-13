<?php

namespace App\Admin\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//举报申诉模块功能
//author:陈国宾
//2020.4.8
class UserComplaintController extends Controller
{
    //搜索过滤
    private function filter($query,$where){
        if($where['complaint_process_result']){
            $query->where("e.complaint_process_result",$where['complaint_process_result']);
        }

        if($where['is_myself']){
            $query->where("e.complaint_process_operator_id",Auth::guard("admin")->id());
        }

        if($where['report_no']){
            $query->where("a.report_no",$where['report_no']);
        }

        if($where['report_date_s']){
            $query->where("a.report_date",">=",strtotime($where['report_date_s']));
        }

        if($where['report_date_e']){
            $query->where("a.report_date","<=",strtotime($where['report_date_e']));
        }

        if($where['complaint_date_s']){
            $query->where("e.complaint_date",">=",strtotime($where['complaint_date_s']));
        }

        if($where['complaint_date_e']){
            $query->where("e.complaint_date","<=",strtotime($where['complaint_date_e']));
        }

        if($where['type']){
            $query->where("a.type",$where['type']);
        }

        if($where['user_name']){
            $query->where("b.nickname",$where['user_name']);
        }

        if($where['sale_name']){
            $query->where("c.nickname",$where['sale_name']);
        }

        if($where['report_type']){
            $query->where("a.report_type",$where['report_type']);
        }

        return $query;
    }

    //申诉列表
    public function list(Request $request){
        $where['complaint_process_result'] = $request->input("complaint_process_result");
        $where['is_myself'] = $request->input("is_myself");
        $where['report_no'] = $request->input("report_no");
        $where['report_date_s'] = $request->input("report_date_s");
        $where['report_date_e'] = $request->input("report_date_e");
        $where['type'] = $request->input("type");
        $where['user_name'] = $request->input("user_name");
        $where['sale_name'] = $request->input("sale_name");
        $where['report_type'] = $request->input("report_type");
        $where['complaint_date_s'] = $request->input("complaint_date_s");
        $where['complaint_date_e'] = $request->input("complaint_date_e");

        $query = DB::table("report_complaint as e");

        $query = $this->filter($query,$where);

        $res = $query->leftJoin("user_report as a","e.report_id","=","a.id")
            ->leftJoin("users as b","a.user_id","=","b.id")
            ->leftJoin("salesman as c","a.sale_id","=","c.id")
            ->select("e.*","a.*","b.nickname as user_name","c.nickname as sale_name")
            ->paginate(15)
            ->toArray();

        $res = $this->objToArr($res);

        foreach ($res['data'] as &$v){
            $v['report_img'] = array_values(json_decode($v['report_img'],true)[0]);
        }

        return $this->ok($res);
    }

    //申诉详情
    public function detail(Request $request){
        $where['report_no'] = $request->input("report_no");

        $query = DB::table("report_complaint as e");

        $query = $this->filter($query,$where);

        $res = $query->leftJoin("user_report as a","e.report_id","=","a.id")
            ->leftJoin("users as b","a.user_id","=","b.id")
            ->leftJoin("salesman as c","a.sale_id","=","c.id")
            ->select("e.*","a.*","b.nickname as user_name","c.nickname as sale_name")
            ->first();

        $res = get_object_vars($res);

        $res['report_img'] = array_values(json_decode($res['report_img'],true)[0]);

        return $this->ok($res);
    }

    //处理申诉
    public function update(Request $request){
        $where['report_id'] = $request->input("report_id");
        $save['complaint_process_date'] = time();
        $save['complaint_process_operator_id'] = Auth::guard("admin")->id();
        $save['complaint_process_result'] = $request->input("complaint_process_result");
        $save['complaint_process_remark'] = $request->input("complaint_process_remark");

        if(!$where['report_id']){
            return $this->error("没有这个申诉单");
        }

        if($save['report_process_result'] <=0){
            return $this->error("请选择正确的处理方式");
        }

        $res = DB::table("report_complaint")
            ->where($where)
            ->update($save);

        return $this->ok($res);
    }
}
