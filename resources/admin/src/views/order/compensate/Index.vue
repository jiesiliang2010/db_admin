<template>
  <el-card>
    <template #header>
      <content-header/>
    </template>
    <el-row>
      <el-table
        :data="tableData"
        border
        style="width: 100%">
        <el-table-column
          prop="id"
          label="赔款单号"/>
        <el-table-column
          prop="date"
          label="申请日期"/>
        <el-table-column
          prop="money"
          label="申请金额"/>
        <el-table-column
          prop="name"
          label="承担方"/>
        <el-table-column
          prop="reason"
          label="赔款原因"/>
        <el-table-column label="操作">
          <template #default="{ row }">
            <el-button type="primary" size="mini" plain @click="handleShowDetail(row)">查看</el-button>
          </template>
        </el-table-column>
      </el-table>
      <div class="card-footer">
        <pagination :page="page"/>
      </div>
    </el-row>

    <el-dialog title="赔款单详情" center :visible.sync="showDetail" width="40%">
      <el-form :model="form" label-width="90px">
        <el-form-item label="商家">
          <el-input :value="form.supplier"/>
        </el-form-item>
        <el-form-item label="店铺">
          <el-input :value="form.shop"/>
        </el-form-item>
        <el-form-item label="赔款原因">
          <el-input :value="form.reason"/>
        </el-form-item>
        <el-form-item label="赔款描述">
          <el-input type="textarea" :value="form.desc"/>
        </el-form-item>
        <el-form-item label="赔款金额">
          <el-input :value="form.money"/>
        </el-form-item>
        <el-form-item label="赔款承担方">
          <el-input :value="form.name"/>
        </el-form-item>
      </el-form>
      <el-dialog
        title="提示"
        :visible.sync="auditVisible"
        append-to-body
        center
        width="30%">
        <span>审核通过后，系统将打款给用户。</span>
        <span slot="footer" class="dialog-footer">
          <el-button @click="auditVisible = false">取 消</el-button>
          <el-button type="primary" :loading="auditLoading" @click="auditConfirm">确 定</el-button>
        </span>
      </el-dialog>
      <el-dialog
        title="提示"
        :visible.sync="rejectVisible"
        append-to-body
        center
        width="30%">
        <el-form :model="rejectForm" label-width="70px">
          <el-form-item label="驳回原因">
            <el-input type="textarea" v-model="rejectForm.reason"/>
          </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
          <el-button @click="rejectVisible = false">取 消</el-button>
          <el-button type="primary" :loading="rejectLoading" @click="rejectConfirm">确 定</el-button>
        </span>
      </el-dialog>
      <div slot="footer" class="dialog-footer">
        <el-button type="primary" @click="auditVisible = true">审 核</el-button>
        <el-button type="danger" @click="rejectVisible = true">驳 回</el-button>
      </div>
    </el-dialog>
  </el-card>
</template>

<script>
import Pagination from '@c/Pagination'
// import { getOrderDetail } from '@/api/order'

export default {
  name: 'Index',
  components: {
    Pagination,
  },
  data() {
    return {
      tableData: [],
      page: null,
      showDetail: false,
      form: {},
      auditVisible: false,
      auditLoading: false,
      rejectVisible: false,
      rejectLoading: false,
      rejectForm: {
        reason: '',
      },
    }
  },
  methods: {
    handleShowDetail(row) {
      this.form = this.tableData.find(item => item.id === row.id)
      this.showDetail = true
    },
    async auditConfirm() {
      this.auditLoading = true
      // Request audit interface imported from '@/api/order'
      // await this.getXXXX(this.form.id)
      this.$message({
        message: '审核成功',
        type: 'success',
      })
      this.auditLoading = false
      this.auditVisible = false
      this.showDetail = false
    },
    async rejectConfirm() {
      this.rejectLoading = true
      // Request reject interface imported from '@/api/order'
      // await this.postXXXX(this.form.id, this.rejectForm.reason)
      this.$message({
        message: '驳回成功',
        type: 'success',
      })
      this.rejectLoading = false
      this.rejectVisible = false
      this.showDetail = false
    },
  },
  watch: {
    $route: {
      async handler(newVal) {
        // Request compensate interface imported from '@/api/order'
        // const { data: { data, meta } } = await getXXXX(newVal.params.id)
        // this.tableData = data
        // this.page = meta
        // Delete following data after fetching the real data.
        this.tableData = [
          {
            id: '1',
            date: '2016-05-02',
            money: '20',
            name: '公司1',
            reason: '不想要了',
            supplier: '商家名字1',
            shop: '店铺名字1',
            desc: '赔款描述1',
          }, {
            id: '2',
            date: '2016-05-04',
            money: '87',
            name: '王小虎2',
            reason: '上海市普陀区金沙江路 1517 弄',
            supplier: '商家名字2',
            shop: '店铺名字2',
            desc: '赔款描述2',
          }, {
            id: '3',
            date: '2016-05-01',
            money: '4000',
            name: '王小3',
            reason: '上海市普陀区金沙江路 1519 弄',
            supplier: '商家名字3',
            shop: '店铺名字3',
            desc: '赔款描述3',
          },
        ]
        this.page = {
          current_page: 1,
          from: 1,
          last_page: 1,
          per_page: 15,
          to: 2,
          total: 2,
        }
      },
      immediate: true,
    },
  },
}
</script>
