<template>
  <el-card>
    <template #header>
      <div class="top-header-wrap">
        <content-header/>
        <div>
          <span class="order-status">订单最新状态</span>
          <el-button type="primary" @click="showLog()" :loading="isLoadingLog">查看日志</el-button>
          <el-button type="warning" plain @click="returnFormVisible = true">退货</el-button>
          <el-button type="danger" plain @click="returnMoneyFormVisible = true">直接退款</el-button>
        </div>
      </div>
    </template>
    <el-container>
      <div style="flex: 1;">
        <!-- 订单详情 -->
        <el-form ref="form" :inline="true" label-width="90px">
          <el-form-item label="订单号">
            <el-input :value="orderDetail.orderNo" placeholder="订单号"/>
          </el-form-item>
          <el-form-item label="预定日期">
            <el-input :value="orderDetail.orderDate" placeholder="预定日期"/>
          </el-form-item>
          <el-form-item label="订单金额">
            <el-input :value="orderDetail.orderMoney" placeholder="订单金额"/>
          </el-form-item>
          <el-form-item label="订单底价">
            <el-input :value="orderDetail.orderBaseMoney" placeholder="订单底价"/>
          </el-form-item>
          <el-form-item label="联系人">
            <el-input :value="orderDetail.contact" placeholder="联系人"/>
          </el-form-item>
          <el-form-item label="联系手机">
            <el-input :value="orderDetail.tel" placeholder="联系手机"/>
          </el-form-item>
          <el-form-item label="收货地址" size="medium">
            <el-input :value="orderDetail.address" placeholder="收货地址" style="width: 340px;"/>
          </el-form-item>
          <el-form-item label="收件人">
            <el-input :value="orderDetail.recipient" placeholder="收件人"/>
          </el-form-item>
          <el-form-item label="配送方式">
            <el-input :value="orderDetail.distribution" placeholder="配送方式"/>
          </el-form-item>
        </el-form>
        <div class="divider-line"></div>
        <!-- 订单商品信息 -->
        <div class="supplier-box" v-for="(item, index) in orderGoods" :key="'goods-' + index">
          <div class="supplier-title">
            <span>供应商名称：{{ item.supplierName }}</span>
            <span>店铺名称：{{ item.shopName }}</span>
          </div>
          <el-table :data="item.goods" resource="admin-users">
            <el-table-column prop="id" label="商品编号"/>
            <el-table-column prop="spec" label="规格"/>
            <el-table-column prop="num" label="数量"/>
            <el-table-column prop="money" label="金额"/>
            <el-table-column prop="lowMoney" label="底价"/>
            <el-table-column prop="saleMoney" label="优惠金额"/>
            <el-table-column prop="guideMan" label="导购员"/>
            <el-table-column label="操作" width="150">
              <template #default="{ row }">
                <el-button-group>
                  <el-button size="small" :id="row.id">操作</el-button>
                </el-button-group>
              </template>
            </el-table-column>
          </el-table>
        </div>
        <div class="divider-line"></div>
        <!-- 订单物流信息 -->
        <div class="logistics-box" v-for="(item, index) in logistics" :key="'logistics-' + index">
          <div class="supplier-title">
            <span>物流公司：{{ item.company }}</span>
            <span>物流单号：{{ item.no }}</span>
          </div>
          <el-timeline :reverse="true">
            <el-timeline-item
              v-for="(it, idx) in item.info"
              :key="idx"
              :timestamp="it.timestamp">
              {{ it.content }}
            </el-timeline-item>
          </el-timeline>
        </div>
      </div>
    </el-container>

    <!-- 订单操作日志 -->
    <el-dialog title="订单操作日志" :visible.sync="showLogDialog">
      <el-table :data="logData" style="max-height: 400px; overflow-y: scroll;">
        <el-table-column property="date" label="日期"/>
        <el-table-column property="content" label="操作内容"/>
        <el-table-column property="remark" label="备注"/>
        <el-table-column property="people" label="操作人"/>
      </el-table>
    </el-dialog>

    <!-- 退款弹窗 -->
    <el-dialog title="退款" width="30%" center :visible.sync="returnMoneyFormVisible">
      <el-form :model="returnMoneyForm" label-width="80px">
        <el-form-item label="退款金额">
          <el-input v-model="returnMoneyForm.money" autofocus/>
        </el-form-item>
        <el-form-item label="退款理由">
          <el-input type="textarea" v-model="returnMoneyForm.reason"/>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="returnMoneyFormVisible = false">取 消</el-button>
        <el-button type="primary" @click="returnMoneyFormVisible = false">确 定</el-button>
      </div>
    </el-dialog>

    <!-- 退货弹窗 -->
    <el-dialog title="赔款单" width="30%" center :visible.sync="returnFormVisible">
      <el-form :model="returnForm" label-width="60px">
        <el-form-item label="商家">
          <el-select v-model="returnForm.merchants" placeholder="请选择商家">
            <el-option label="商家一" value="shanghai"/>
            <el-option label="商家二" value="beijing"/>
          </el-select>
        </el-form-item>
        <el-form-item label="店铺">
          <el-select v-model="returnForm.shop" placeholder="请选择店铺">
            <el-option label="店铺一" value="shanghai"/>
            <el-option label="店铺二" value="beijing"/>
          </el-select>
        </el-form-item>
        <el-form-item label="金额">
          <el-input v-model="returnForm.money"/>
        </el-form-item>
        <el-form-item label="原因">
          <el-input type="textarea" v-model="returnForm.reason"/>
        </el-form-item>
        <el-form-item label="承担方">
          <el-radio-group v-model="returnForm.resource">
            <el-radio label="商家"/>
            <el-radio label="公司"/>
          </el-radio-group>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="returnFormVisible = false">取 消</el-button>
        <el-button type="primary" @click="returnFormVisible = false">确 定</el-button>
      </div>
    </el-dialog>
  </el-card>
</template>

<script>
import PopConfirm from '@c/PopConfirm'
import {
  getOrderDetail,
  getOrderLog
} from '@/api/order'

export default {
  name: 'Index',
  components: {
    PopConfirm,
  },
  data() {
    return {
      orderDetail: {
        orderNo: '',
        orderDate: '',
        orderMoney: '',
        contact: '',
        tel: '',
        orderBaseMoney: '',
        address: '',
        recipient: '',
        salesman: '',
        distribution: '',
      },
      orderGoods: [{
        id: 1,
        supplierName: '苹果',
        shopName: '葡萄',
        goods: [{
          id: 1,
          spec: '黄色',
          num: 2,
          money: '20',
          lowMoney: '10',
          saleMoney: '15',
        }],
      }, {
        id: 2,
        supplierName: '香蕉',
        shopName: '西瓜',
        goods: [{
          id: 1,
          spec: '黄色',
          num: 2,
          money: '20',
          lowMoney: '10',
          saleMoney: '15',
        }],
      }],
      logistics: [{
        id: '2',
        company: '圆通',
        no: 'u987f9a79',
        info: [{
          content: '快递公司开始揽收',
          timestamp: '2018-04-11',
        }, {
          content: '快递到达【上海市】虹口区',
          timestamp: '2018-04-13',
        }, {
          content: '正在派件',
          timestamp: '2018-04-15',
        }],
      }, {
        id: '1',
        company: '顺丰',
        no: 'u987f9a79',
        info: [{
          content: '快递公司开始揽收',
          timestamp: '2018-04-11',
        }, {
          content: '快递到达【上海市】虹口区',
          timestamp: '2018-04-13',
        }, {
          content: '正在派件',
          timestamp: '2018-04-15',
        }],
      }],
      showLogDialog: false,
      logData: [],
      isLoadingLog: false,
      returnMoneyFormVisible: false,
      returnMoneyForm: {
        money: '',
        reason: '',
      },
      returnFormVisible: false,
      returnForm: {
        money: '',
        reason: '',
      },
    }
  },
  methods: {
    async showLog() {
      // this.isLoadingLog = true
      // console.log(this.$route.params.id)
      // const { data } = await getOrderLog(this.$route.params.id)

      this.logData = [{
        date: '2016-05-02',
        content: '用户来电号码为xxx',
        remark: '上海市普陀区金沙江路 1518 弄',
        people: '王小虎',
      }, {
        date: '2016-05-02',
        content: '用户来电号码为xxx',
        remark: '上海市普陀区金沙江路 1518 弄',
        people: '王小虎',
      }, {
        date: '2016-05-02',
        content: '用户来电号码为xxx',
        remark: '上海市普陀区金沙江路 1518 弄',
        people: '王小虎',
      }]
      this.showLogDialog = true
      this.isLoadingLog = false
    },
    paseOrderInfo(order){
        return {
            orderNo: order.order_no,
            orderDate: order.create_date,
            orderMoney: order.amount,
            contact: order.receiver,
            tel: order.phone,
            orderBaseMoney: order.base_amount,
            address: order.receiver_address,
            recipient: order.receiver,
            distribution: order.trans_type,
        };
    },
    paseGoodsDetail(detailList){
        let struct = []
        detailList.forEach((i) => {
            let shop = {
                id: i.supplier_name,
                supplierName: i.supplier_name,
                shopName: i.shop_name,
                goods:[],
            };
            i.goodList.forEach((v) => {
                shop.goods.push({
                    id: v.goods_id,
                    spec: v.spec_attr,
                    num: v.num,
                    money: v.goods_amount,
                    lowMoney: v.supplier_amount,
                    saleMoney: v.discount_amount,
                    guideMan: v.guide_name,
                })
            })
            struct.push(shop)
        })
        return struct
    },
  },
  watch: {
    $route: {
      async handler(newVal) {
        // console.log(newVal.params.id)
        const { data } = await getOrderDetail(newVal.params.id)
          // console.log(data.detailList);
          this.orderDetail = this.paseOrderInfo(data.order);
          this.orderGoods = this.paseGoodsDetail(data.detailList);
        // 将请求结果赋值
      },
      immediate: true,
    },
  },
}
</script>

<style scoped lang="scss">
.top-header-wrap {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.divider-line {
  width: 100%;
  height: 1px;
  background: #DCDFE6;
  margin-bottom: 20px;
}

.supplier-box {
  margin-bottom: 20px;
}

.supplier-title {
  margin-bottom: 20px;

  span {
    color: #606266;
    font-size: 14px;
    margin-right: 20px;
  }
}

.order-status {
  margin-right: 20px;
  color: #606266;
}
</style>
