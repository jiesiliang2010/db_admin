<template>
    <el-card>
        <template #header>
            <content-header/>
        </template>
        <el-row type="flex" justify="center">
            <lz-form
                ref="form"
                :get-data="getData"
                :submit="onSubmit"
                :form.sync="form"
                :errors.sync="errors"
                :edit-mode="editMode"
            >
                <el-form-item label="部门名称" required prop="name">
                    <el-input v-model="form.name"/>
                </el-form-item>
            </lz-form>
        </el-row>
    </el-card>
</template>

<script>
    import LzForm from "@c/LzForm";
    import {
        editAdminDepartment,
        updateAdminDepartment,
        storeAdminDepartment,
        createAdminDepartment
    } from "@/api/admin-departments";
    import FormHelper from "@c/LzForm/FormHelper";

    export default {
        name: "Form",
        components: {
            LzForm
        },
        mixins: [FormHelper],
        data() {
            return {
                form: {
                    id: "",
                    name: ""
                },
                errors: {}
            };
        },
        methods: {
            async getData() {
                let data;
                if (this.editMode) {
                    ({data} = await editAdminDepartment(this.resourceId));
                    this.fillForm(data.departments);
                } else {
                    ({data} = await createAdminDepartment());
                }
            },
            async onSubmit() {
                if (this.editMode) {
                    await updateAdminDepartment(this.resourceId, this.form);
                } else {
                    await storeAdminDepartment(this.form);
                }
            },
            filterMethod(query, item) {
                return item.name.indexOf(query) > -1;
            }
        }
    };
</script>

<style scoped lang="scss">
    ::v-deep {
        .el-transfer-panel__body {
            height: 300px;
        }

        .el-transfer-panel__list.is-filterable {
            height: 249px;
        }
    }
</style>
