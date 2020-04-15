<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGoodsSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_specs', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('id', true)->comment('规格ID');
            $table->integer('goods_id', false, true)->index('idx_goods_id')->comment('商品ID');
            $table->char('goods_no', 20)->index('idx_goods_no')->index('')->comment('商品编号');
            $table->string('sku_name', 30)->default('')->nullable(false)->comment('规格名');
            $table->string('sku_value', 10)->default('')->nullable(false)->comment('规格值');
            $table->integer('price', false, true)->default(0)->nullable(false)->comment('价格');
            $table->integer('number', false, true)->default(0)->nullable(false)->comment('库存数量');
            $table->integer('guide_rebate')->default(0)->nullable(false)->comment('导购折扣');
            $table->string('image_url', 200)->nullable(false)->default('')->comment('规格图片');
            $table->tinyInteger('is_delete')->nullable(false)->default(0)->comment('是否删除（0：否；1：是）');
            $table->timestamp('updated_at')->useCurrent()->comment('更新时间');
            $table->timestamp('created_at')->comment('创建时间');
        });
        DB::statement("ALTER TABLE `goods_specs` comment'商品规格表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_skus');
    }
}
