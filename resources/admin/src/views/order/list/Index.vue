aaaa<template>
    <el-card>
        <template #header>
            <content-header/>
        </template>

        <el-button-group class="mb-3">
            <search-form :fields="search"/>
            <!--<el-button @click="createDialog = true">添加</el-button>-->
        </el-button-group>

        <el-table :data="OrderList" resource="config-categories" @row-click="openDetails">
            <el-table-column prop="order_no" label="订单号" width="180"/>
            <el-table-column prop="create_at" label="订单日期" :formatter="dateFormat" min-width="100">
            </el-table-column>
            <el-table-column prop="amount" label="订单金额" min-width="150">
            </el-table-column>
            <el-table-column prop="receiver" label="联系人" width="160"/>
            <el-table-column prop="phone" label="联系手机" width="160"/>
            <el-table-column prop="address" label="收货地址" width="160"/>
            <el-table-column prop="city_name" label="收货城市" width="160"/>
        </el-table>
        <div class="card-footer">
            <pagination :page="page"/>
        </div>

        <el-dialog
                title="添加分类"
                :visible.sync="createDialog"
                width="400px"
                append-to-body
        >
            <lz-form
                    style="width: auto;"
                    ref="form"
                    :submit="onStoreCategory"
                    :errors.sync="errors"
                    :form.sync="form"
                    label-position="top"
                    in-dialog
                    disable-redirect
                    disable-stay
            >
                <el-form-item label="名称" required prop="name">
                    <el-input v-model="form.name" autofocus/>
                </el-form-item>
                <el-form-item label="标识" required prop="slug">
                    <el-input v-model="form.slug"/>
                </el-form-item>
            </lz-form>
        </el-dialog>
    </el-card>
</template>

<script>
    import moment from 'moment'
    import SearchForm from '@c/SearchOrder'
    import Pagination from '@c/Pagination'
    import {
        getConfigCategories,
        storeConfigCategory,
        updateConfigCategory,
    } from '@/api/configs'
    import {
        getOrderList
    } from '@/api/order-list'
    import ButtonLink from '@c/ButtonLink'
    import { getMessage } from '@/libs/utils'
    import InputEdit from '@c/quick-edit/InputEdit'
    import LzForm from '@c/LzForm'
    import RowDestroy from '@c/LzTable/RowDestroy'

    export default {
        name: 'Index',
        components: {
            RowDestroy,
            InputEdit,
            ButtonLink,
            SearchForm,
            Pagination,
            LzForm,
        },
        data() {
            return {
                search: [
                    {
                        field: 'order_no',
                        label: '订单号',
                    },
                    {
                        field: 'create_at_start',
                        type:'date-picker',
                        label: '订单开始日期',
                    },
                    {
                        field: 'create_at_end',
                        type:'date-picker',
                        label: '订单截止时间',
                    },
                    {
                        field: 'user_id',
                        label: '用户ID',
                    },
                    {
                        field: 'receiver',
                        label: '联系人',
                    },
                    {
                        field: 'phone',
                        label: '联系电话',
                    },

                ],

                OrderList: [],
                page: null,

                createDialog: false,

                form: {
                    name: '',
                    slug: '',
                },
                errors: {},
            }
        },
        methods: {
            async onStoreCategory() {
                const { data } = await storeConfigCategory(this.form)

                this.createDialog = false
                this.OrderList.unshift(data)
            },
            updateConfigCategory,
            //时间格式化
            dateFormat:function(row, column) {
                var date = row[column.property];
                if (date == undefined) {
                    return "";
                }
                //return moment.unix(date).format("MM/DD/YYYY");
                return moment.unix(date).format("YYYY-MM-DD HH:mm:ss");
            },
            openDetails(row) {
                const order_id = row.id;
                this.$router.push({ path: `order-detail/${order_id}`});
                //this.$router.push({ path: `order-detail/${order_id}`});
                //this.$router.push({path: 'order-detail', query: {id: order_id}});
                //window.location.href = `order-detail/order_id/${order_id}`;
            },
        },
        watch: {
            $route: {
                async handler(newVal) {
                    const { data: { data, meta } } = await getOrderList(newVal.query)
                    this.OrderList = data
                    this.page = meta
                },
                immediate: true,
            },
            createDialog(newVal) {
                if (!newVal) {
                    this.form = {
                        name: '111',
                        slug: '',
                    }
                }
            },
        },

    }
</script>