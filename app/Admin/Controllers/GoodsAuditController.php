<?php

namespace App\Admin\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//商品审核模块功能
//author:陈国宾
//2020.4.10
class GoodsAuditController extends Controller
{
    //搜索过滤
    private function filter($query,$where){
        if($where['goods_name']){
            $query->where("a.goods_name",$where['goods_name']);
        }

        if($where['goods_no']){
            $query->whereIn("a.goods_no",explode(",",$where['goods_no']));
        }

        if($where['goods_id']){
            $query->where("a.id",$where['goods_id']);
        }
        return $query;
    }

    //商品列表
    public function list(Request $request){
        $where['goods_name'] = $request->input("goods_name");
        $where['goods_no'] = $request->input("goods_no");

        $query = DB::table("goods as a");

        $query = $this->filter($query,$where);

        //获取商品基础信息
        $goods = $query->join("goods_sku as b","a.id","=","b.goods_id")
            ->paginate(15)
            ->toArray();

        $goods = $this->objToArr($goods);

        $goods['data'] = array_column($goods['data'],null,"id");

        $goodsId = array_column($goods['data'],"id");

        //获取商品图片
        $goodsImgs = DB::table("goods_images")
            ->selectRaw("group_concat(`image_url`) as image_url,goods_id")
            ->whereIn("goods_id",$goodsId)
            ->groupBy("goods_id")
            ->get()
            ->toArray();

        $goodsImgs = $this->objToArr($goodsImgs);

        $goodsImgs = array_column($goodsImgs,null,"goods_id");

        foreach ($goods['data'] as $k=>&$v){
            $v['images'] = $goodsImgs[$k]['image_url'];
        }

        return $this->ok($goods);
    }

    //商品详情
    public function detail(Request $request){
        $where['goods_id'] = $request->input("goods_id");

        $query = DB::table("goods as a");

        $query = $this->filter($query,$where);

        //获取商品基础信息
        $goods = $query->join("goods_sku as b","a.id","=","b.goods_id")
            ->first();

        $goods = get_object_vars($goods);

        //获取商品图片
        $goodsImgs = DB::table("goods_images")
            ->selectRaw("group_concat(`image_url`) as image_url")
            ->where("goods_id",$where['goods_id'])
            ->groupBy("goods_id")
            ->first();

        $goods['images'] = get_object_vars($goodsImgs)['image_url'];

        return $this->ok($goods);
    }

    //处理商品状态,记录日志   //写到这
    public function update(Request $request){
        $insert ['salesman_id'] = $request->input("salesman_id");
        $insert['type'] = $request->input("type");
        $insert['operator_id'] = Auth::guard("admin")->id();
        $insert['remark'] = $request->input("remark");
        $insert['measures'] = $request->input("measures");

        $save['status'] = $insert['type']!=3?:1;

        switch ($insert['measures']){
            case 1:
                $save["end_time"] = strtotime("+24 hour");
                break;
            case 2:
                $save["end_time"] = strtotime("+1 week");
                break;
            case 3:
                $save["end_time"] = strtotime("+100 year");
                break;
        }

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
