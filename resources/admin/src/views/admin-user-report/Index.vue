<template>
    <el-card>
        <template #header>
            <content-header/>
        </template>

        <el-button-group class="mb-3" :gutter="20">
            <search-form :fields="search"/>
        </el-button-group>

        <el-table :data="info" resource="admin-user-report">
            <el-table-column prop="report_no" label="举报单号" />
            <el-table-column prop="type" label="举报类型" />
            <el-table-column prop="report_date" label="举报日期"/>
            <el-table-column prop="report_type" label="举报原因" />
            <el-table-column label="操作" width="150">
                <template #default="{ row, report_no }">
                    <el-button-group>
                        <row-to-edit/>
                        <row-destroy/>
                    </el-button-group>
                </template>
            </el-table-column>
        </el-table>
        <div class="card-footer">
            <pagination :page="page"/>
        </div>
    </el-card>
</template>

<script>
    import SearchForm from '@c/SearchForm'
    import Pagination from '@c/Pagination'
    import { getUserReport } from '@/api/admin-user-report'
    import RowDestroy from '@c/LzTable/RowDestroy'
    import RowToEdit from '@c/LzTable/RowToEdit'

    export default {
        name: 'Index',
        components: {
            RowToEdit,
            RowDestroy,
            SearchForm,
            Pagination,
        },
        data() {
            return {
                search: [
                    {
                        field: 'id',
                        label: '举报单号',
                    },
                    {
                        field: 'name',
                        label: '举报日期',
                    },
                    {
                        field: 'name',
                        label: '',
                    },
                    {
                        field: 'username',
                        label: '用户名',
                    },
                    {
                        field: 'role_name',
                        label: '导购名',
                    },
                    {
                        field: 'role_name',
                        label: '举报类型',
                    },
                    {
                        field: 'permission_name',
                        label: '举报原因',
                    },
                ],
                users: [],
                page: null,
            }
        },
        watch: {
            $route: {
                async handler(newVal) {
                    const {data}  = await getUserReport(newVal.query)
                    this.info = data.data
                    this.page = data
                },
                immediate: true,
            },
        },
    }
</script>
