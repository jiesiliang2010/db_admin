<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\DB;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('id', true)->comment('商品ID');
            $table->string('name', 50)->nullable(false)->default('')->comment('商品名称');
            $table->tinyInteger('status')->nullable(false)->default(0)->comment('商品状态（0：已创建待审核；1：审核拒绝；2：审核通过并上架；3：下架）');
            $table->integer('start_sale_time')->default(0)->nullable(false)->comment('商品开售时间');
            $table->integer('stop_sale_time')->default(0)->nullable(false)->comment('商品停售时间');
            $table->integer('category_id')->default(null)->nullable(false)->comment('商品直接所属分类ID');
            $table->tinyInteger('type')->default(0)->nullable(false)->comment('商品类型：0：普通商品；1：服务类商品');
            $table->tinyInteger('is_delete')->nullable(false)->default(0)->comment('是否删除（0：否；1：是）');
            $table->timestamp('updated_at')->useCurrent()->comment('更新时间');
            $table->timestamp('created_at')->comment('创建时间');
        });
        DB::statement("ALTER TABLE `goods` comment'商品表' ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
