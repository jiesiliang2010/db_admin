<?php

namespace App\Admin\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//举报模块功能
//author:陈国宾
//2020.4.7
class UserReportController extends Controller
{
    //搜索过滤
    private function filter($query,$where){
        if($where['report_process_result']){
            $query->where("a.report_process_result",$where['report_process_result']);
        }

        if($where['is_myself']){
            $query->where("a.report_process_operator_id",Auth::guard("admin")->id());
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

    //举报列表
    public function list(Request $request){
        $where['report_process_result'] = $request->input("report_process_result");
        $where['is_myself'] = $request->input("is_myself");
        $where['report_no'] = $request->input("report_no");
        $where['report_date_s'] = $request->input("report_date_s");
        $where['report_date_e'] = $request->input("report_date_e");
        $where['type'] = $request->input("type");
        $where['user_name'] = $request->input("user_name");
        $where['sale_name'] = $request->input("sale_name");
        $where['report_type'] = $request->input("report_type");

        $query = DB::table("user_report as a");

        $query = $this->filter($query,$where);

        $res = $query->leftJoin("users as b","a.user_id","=","b.id")
        ->leftJoin("salesman as c","a.sale_id","=","c.id")
        ->select("a.*","b.nickname as user_name","c.nickname as sale_name")
        ->paginate(15)
        ->toArray();

        $res = $this->objToArr($res);

        foreach ($res['data'] as &$v){
            $v['report_img'] = explode(",",$v['report_img']);
        }

        return $this->ok($res);
    }

    //举报详情
    public function detail(Request $request){
        $where['report_no'] = $request->input("report_no");

        $query = DB::table("user_report as a");

        $query = $this->filter($query,$where);

        $res = $query->leftJoin("users as b","a.user_id","=","b.id")
        ->leftJoin("salesman as c","a.sale_id","=","c.id")
        ->select("a.*","b.nickname as user_name","c.nickname as sale_name")
        ->first();

        $res = get_object_vars($res);

        $res['report_img'] = explode(",",$res['report_img']);

        return $this->ok($res);
    }

    //处理举报
    public function update(Request $request){
        $where['report_no'] = $request->input("report_no");
        $save['report_process_operator_id'] = Auth::guard("admin")->id();
        $save['report_process_result'] = $request->input("report_process_result");
        $save['report_process_type'] = $request->input("report_process_type");
        $save['report_process_remark'] = $request->input("report_process_remark");
        $save['report_process_date'] = time();

        if(!$where['report_no']){
            return $this->error("没有这个举报单");
        }

        if($save['report_process_type'] <=0 || $save['report_process_result'] <=0){
            return $this->error("请选择正确的处理方式");
        }

        $res = DB::table("user_report")
        ->where($where)
        ->update($save);

        return $this->ok($res);
    }
}
