<template>
    <el-card>
        <template #header>
            <div class="top-header-wrap">
                <content-header/>
                <div>
                    <span class="order-status">订单最新状态</span>
                    <el-button type="primary" @click="showLog()" :loading="isLoadingLog">查看日志</el-button>
                    <el-button type="warning" plain @click="returnMoneyFormVisible = true">退货</el-button>
                    <el-button type="primary" @click="showCompensateLog()" :loading="isLoadingLog">查看赔款单</el-button>
                    <!--<el-button type="danger" plain @click="returnFormVisible = true;getCompensateReason();">直接退款</el-button>-->
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
                        <el-input :value="orderDetail.showTotalMoney" placeholder="订单金额"/>
                    </el-form-item>
                    <el-form-item label="店铺底价">
                        <el-input :value="orderDetail.shopTotalMoney" placeholder="店铺底价"/>
                    </el-form-item>
                    <el-form-item label="导购底价">
                        <el-input :value="orderDetail.guideTotalMoney" placeholder="导购底价"/>
                    </el-form-item>
                    <el-form-item label="联系人">
                        <el-input :value="orderDetail.contact" placeholder="联系人"/>
                    </el-form-item>
                    <el-form-item label="联系电话">
                        <el-input :value="orderDetail.tel" placeholder="联系电话"/>
                    </el-form-item>
                    <el-form-item label="收货地址" size="medium">
                        <el-input :value="orderDetail.address" placeholder="收货地址" style="width: 340px;"/>
                    </el-form-item>
                    <el-form-item label="用户ID">
                        <el-input :value="orderDetail.userId" placeholder="用户ID"/>
                    </el-form-item>
                    <el-form-item label="订单类型">
                        <el-input :value="orderDetail.orderType" placeholder="订单类型"/>
                    </el-form-item>
                    <el-form-item label="配送方式">
                        <el-input :value="orderDetail.transType" placeholder="配送方式"/>
                    </el-form-item>
                </el-form>
                <div class="divider-line"></div>
                <!-- 订单商品信息 -->
                <div class="supplier-box" v-for="(item, index) in orderGoods" :key="'goods-' + index">
                    <div class="supplier-title">
                        <span>子订单号：{{ item.subOrderNo }}</span>
                        <span>商家名称：{{ item.supplierName }}</span>
                        <span>店铺名称：{{ item.shopName }}</span>
                        <span>店铺负责人：{{ item.shopChargePerson }}</span>
                        <span>店铺联系方式：{{ item.shopContract }}</span>
                        <span><el-button type="danger" plain
                                         @click="returnFormVisible = true;getCompensateReason(item);">直接退款</el-button> </span>
                    </div>
                    <el-table :data="item.goods">
                        <el-table-column prop="goodsId" label="商品编号"/>
                        <el-table-column prop="goodsName" label="商品名称"/>
                        <el-table-column prop="guideNickName" label="导购昵称"/>
                        <el-table-column prop="specAttr" label="规格"/>
                        <el-table-column prop="num" label="数量"/>
                        <el-table-column prop="saleMoney" label="销售金额"/>
                        <el-table-column prop="payMoney" label="实付金额"/>
                        <el-table-column prop="shopDiscountMoney" label="店铺优惠"/>
                        <el-table-column prop="platformDiscountMoney" label="平台优惠"/>
                        <el-table-column prop="platformBrokerMoney" label="平台佣金"/>
                        <el-table-column prop="shopClearMoney" label="店铺底价"/>
                        <el-table-column prop="guideBrokerMoney" label="导购佣金"/>
                        <el-table-column prop="orderStateAlias" label="子订单状态"/>
                        <el-table-column prop="transCompany" label="物流公司"/>
                        <el-table-column prop="transNo" label="物流单号"/>
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
        <el-dialog title="用户赔款单" width="38%" center :visible.sync="returnFormVisible">
            <el-form :model="returnForm" @submit.navite="newsubmit" label-width="83px">
                <el-form-item>
                    <strong>子订单号:</strong>&nbsp;&nbsp;{{currentPageOrderNo}}&nbsp;&nbsp;<br/>
                    <strong>商家名称:</strong>&nbsp;&nbsp;{{currentPageSupplierName}}&nbsp;&nbsp;<br/>
                    <strong>店铺名称:</strong>&nbsp;&nbsp;{{currentPageShopName}}
                </el-form-item>
                <!--<el-form-item label="商家">
                  <el-select v-model="returnForm.supplier_id" placeholder="请选择商家" @change="selectChange" >
                    <el-option v-for="item in supplierInfo" :label="item.supplier_name" :value="item.supplier_id"/>
                     <el-option label="商家二" value="beijing"/>
                  </el-select>
                </el-form-item>
                <el-form-item label="店铺">
                  <el-select :key="selectedSupplierId" v-model="returnForm.shop_id" placeholder="请选择店铺">
                    <el-option label="店铺二" value="beijing"/>
                    <el-option v-for="item in currentOrderShopInfo" :label="item.shop_name" :value="item.shop_id"/>
                  </el-select>
                </el-form-item>-->
                <!--<el-form-item label="赔款原因">
                  <el-radio-group v-model="returnForm.compensate_reason" @change="compensateChooseReason(this)">
                    <el-radio :value="item.reason_id" v-for="item in compensationReason" :label="item.reason_id">{{item.reason}}</el-radio>
                  </el-radio-group>
                </el-form-item> -->
                <el-form-item label="赔款原因">
                    <el-select :key="selectedSupplierId" @change="compensateChooseReason(this)"
                               v-model="returnForm.compensate_reason" placeholder="赔款原因">
                        <el-option v-for="item in compensationReason" :label="item.reason" :value="item.reason_id"/>
                    </el-select>
                </el-form-item>
                <el-form-item label="赔款描述">
                    <el-input type="textarea" v-model="returnForm.compensate_describe"/>
                </el-form-item>
                <el-form-item label="赔款金额">
                    <el-input type="number" min="0" v-model="returnForm.compensate_amount"/>
                </el-form-item>
                <el-form-item label="赔款承担方">
                    <el-radio-group v-model="returnForm.compensate_object">
                        <el-radio
                            :disabled="this.returnForm.compensate_reason == 1 || this.returnForm.compensate_reason == 2?true:false"
                            :label="1">商家
                        </el-radio>
                        <el-radio
                            :disabled="this.returnForm.compensate_reason == 1 || this.returnForm.compensate_reason == 2?true:false"
                            :label="2">平台
                        </el-radio>
                    </el-radio-group>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer" style="margin-top:-40px;">
                <el-button @click="returnFormVisible = false">取 消</el-button>
                <el-button type="primary" native-type="submit" @click="onSubmit">确 定</el-button>
            </div>
        </el-dialog>
        <el-dialog
            title="提示"
            :visible.sync="centerDialogVisible"
            width="30%" style="text-align:center;" class="mustInputWainingTips">
            <span class="pre-formatted">{{compensateDescTips}}</span>
            <div class="dialog-footer" style="margin-top:30px;">
                <el-button v-if="!isHiddenCancel" @click="centerDialogVisible = false">取 消</el-button>
                <el-button type="primary"
                           @click="statisfySubmitAction==true?doOrderCompensateAction():centerDialogVisible = false">确 定
                </el-button>
            </div>
        </el-dialog>
    </el-card>
</template>

<script>
    import PopConfirm from '@c/PopConfirm'
    import {
        getOrderDetail,
        getOrderLog,
        getOrderSupplier,
        getOrderSupplierShops,
        getCompensateReasonPost,
        doOrderCompensate,
        getOrderTransLog,
        showCompensateLog,
    } from '@/api/order'

    export default {
        name: 'Index',
        components: {
            PopConfirm,
        },
        data() {
            return {
                orderDetail: {},
                orderGoods: [],
                logistics: [],
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
                    supplier_id: '',
                    shop_id: '',
                    compensate_reason: '',
                    compensate_describe: '',
                    compensate_amount: '',
                    compensate_object: '',
                },
                supplierInfo: [],
                shownPersonIndex: 0,
                selectedSupplierPunish: '',
                currentPageOrderId: '',
                currentOrderShopInfo: '',
                selectedSupplierId: '',
                compensationReason: '',
                centerDialogVisible: false,
                compensateDescTips: '请填写赔款描述',
                compensateAmountThreshold: 10,
                supplierUndertakeNotExceed: "点击提交后,系统将退款给用户。\n 点击'确认'继续提交,点击'取消'返回修改",
                platformUndertakeTips: "因赔偿金额由平台承担,需要提交财务审核。\n 点击'确认'继续提交,点击'取消'返回修改",
                compensateFormData: '',
                statisfySubmitAction: false,
                isHiddenCancel: true,
                dataOrderSupplier: [],
                currentPageOrderNo: '',
                currentPageSupplierName: '',
                currentPageShopName: '',
            }
        },
        computed: {
            supplierUndertakeExceed() {
                var tips = "因赔偿金额过高,超过了";
                return tips + this.compensateAmountThreshold + "元,需要提交财务审核。\n点击'确认'继续提交,点击'取消'返回修改";
            },
        },
        methods: {
            async showLog() {
                // this.isLoadingLog = true
                // console.log(this.$route.params.id)
                const {data} = await getOrderLog(this.$route.params.id)
                this.logData = data;
                this.showLogDialog = true
                this.isLoadingLog = false
            },
            async showCompensateLog() {
                const {data} = await showCompensateLog({'order_id': this.$route.params.id});
                console.log(data);
                // this.logData = data;
                // this.showLogDialog = true
                // this.isLoadingLog = false
            },
            async selectChange(supplier_id) {
                this.returnForm.shop_id = '';
                const {data} = await getOrderSupplierShops({
                    supplier_id: supplier_id,
                    order_id: this.currentPageOrderId
                })
                this.currentOrderShopInfo = data;
            },
            async getCompensateReason(item) {
                this.returnForm.supplier_id = item.supplier_id;
                this.returnForm.shop_id = item.shop_id;
                this.currentPageOrderNo = item.orderNo;
                this.currentPageSupplierName = item.supplierName;
                this.currentPageShopName = item.shopName;
                const {data} = await getCompensateReasonPost({})
                this.compensationReason = data;
            },
            compensateChooseReason() {
                var reason_id = this.returnForm.compensate_reason;
                if (reason_id == 1 || reason_id == 2) {
                    this.returnForm.compensate_object = 1;
                }
            },
            async asyncOrderCompensate() {
                const {data} = await doOrderCompensate(this.compensateFormData);
                this.compensateDescTips = '操作成功';
                setTimeout(function () {
                    this.centerDialogVisible = false;
                    this.returnFormVisible = false;
                }.bind(this), 1500);
            },
            doOrderCompensateAction() {
                this.asyncOrderCompensate();
            },
            onSubmit() {
                var supplier_id = this.returnForm.supplier_id;
                var shop_id = this.returnForm.shop_id;
                var reason_id = this.returnForm.compensate_reason;
                var compensate_describe = this.returnForm.compensate_describe.trim();
                var compensate_amount = this.returnForm.compensate_amount;
                var compenate_object = this.returnForm.compensate_object;
                var order_id = this.currentPageOrderId;
                var audit_state = 0;
                var sub_order_no = this.currentPageOrderNo;
                this.compensateFormData = {
                    'supplier_id': supplier_id,
                    'shop_id': shop_id,
                    'reason_id': reason_id,
                    'compensate_describe': compensate_describe,
                    'compensate_amount': compensate_amount,
                    'compenate_object': compenate_object,
                    'order_id': order_id,
                    'audit_state': audit_state,
                    'sub_order_no': sub_order_no,
                };
                if (!supplier_id) {
                    this.compensateDescTips = '请选择商家';
                    this.centerDialogVisible = true;
                    return false;
                }
                ;
                if (!shop_id) {
                    this.compensateDescTips = '请选择店铺';
                    this.centerDialogVisible = true;
                    return false;
                }
                ;
                if (!reason_id) {
                    this.compensateDescTips = '请选择赔款原因';
                    this.centerDialogVisible = true;
                    return false;
                }
                ;
                if (reason_id != '' && reason_id != 1 && reason_id != 2 && compensate_describe == '') {
                    this.compensateDescTips = '请填写赔款描述';
                    this.centerDialogVisible = true;
                    return false;
                }
                if (!compensate_amount) {
                    this.compensateDescTips = '请选择赔款金额';
                    this.centerDialogVisible = true;
                    return false;
                }
                ;
                if (!compenate_object) {
                    this.compensateDescTips = '请选择赔款承担方';
                    this.centerDialogVisible = true;
                    return false;
                }
                ;
                var compensateAmountThreshold = this.compensateAmountThreshold;
                if (compensate_amount < compensateAmountThreshold && compenate_object == 1) {
                    this.isHiddenCancel = false;
                    this.statisfySubmitAction = true;
                    this.compensateDescTips = this.supplierUndertakeNotExceed;
                    this.centerDialogVisible = true;
                    return false;
                }
                if (compensate_amount >= compensateAmountThreshold && compenate_object == 1) {
                    this.isHiddenCancel = false;
                    this.statisfySubmitAction = true;
                    this.compensateDescTips = this.supplierUndertakeExceed;
                    this.centerDialogVisible = true;
                    this.compensateFormData.audit_state = 1;
                    return false;
                }
                if (compenate_object == 2) {
                    //此处表示平台承担
                    this.isHiddenCancel = false;
                    this.statisfySubmitAction = true;
                    this.compensateDescTips = this.platformUndertakeTips;
                    this.centerDialogVisible = true;
                    this.compensateFormData.audit_state = 1;
                }
            },
            paseOrderInfo(order) {
                return {
                    orderNo: order.order_no,
                    orderDate: order.create_date,
                    showTotalMoney: order.show_total_money,
                    shopTotalMoney: order.shop_total_money,
                    guideTotalMoney: order.guide_total_money,
                    contact: order.receiver,
                    tel: order.phone,
                    address: order.receiver_address,
                    userId: order.user_id,
                    orderType: order.order_type_alias,
                    transType: order.order_trans_type_alias,
                };
            },
            paseGoodsDetail(detailList) {
                let struct = []
                detailList.forEach((i) => {
                    let shop = {
                        subOrderNo: i.sub_order_no,
                        supplierName: i.supplier_name,
                        shopName: i.shop_name,
                        goodName: i.goods_name,
                        supplier_id: i.supplier_id,
                        shop_id: i.shop_id,
                        guideNickName: i.guide_nick_name,
                        shopChargePerson: i.shop_charge_person,
                        shopContract: i.shop_contract,
                        goods: [],
                    };
                    i.goodList.forEach((v) => {
                        shop.goods.push({
                            id: v.id,
                            goodsId: v.goods_id,
                            goodsName: v.goods_name,
                            guideNickName: v.guid_nick_name,
                            specAttr: v.spec_attr,
                            num: v.num,
                            saleMoney: v.sale_money,
                            payMoney: v.pay_money,
                            shopDiscountMoney: v.shop_discount_money,
                            platformDiscountMoney: v.platform_discount_money,
                            platformBrokerMoney: v.platform_broker_money,
                            shopClearMoney: v.shop_clear_money,
                            guideBrokerMoney: v.guide_broker_money,
                            orderStateAlias: v.order_state_alias,
                            transCompany: v.trans_company,
                            transNo: v.trans_no,
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
                    const [{data: {order, detailList}}, {data: transLog}] = [await getOrderDetail(newVal.params.id), await getOrderTransLog(newVal.params.id)]
                    // console.log('**',transLog)
                    this.orderDetail = this.paseOrderInfo(order);
                    this.orderGoods = this.paseGoodsDetail(detailList);
                    this.logistics = transLog;
                    this.currentPageOrderId = newVal.params.id;
                    let param = {
                        order_id: newVal.params.id
                    };
                    let dataOrderSupplier = await getOrderSupplier(param);
                    this.supplierInfo = dataOrderSupplier.data;
                    this.currentPageOrderNo = order.order_no;
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

    .pre-formatted {
        white-space: pre;
    }

    .mustInputWainingTips .el-dialog__footer {
        text-align: center;
    }
</style>
