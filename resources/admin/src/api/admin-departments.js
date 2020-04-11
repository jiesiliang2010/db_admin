import Request from '@/plugins/request'

export function getAdminDepartments(params = {}) {
  return Request.get('admin-departments', { params })
}

export function storeAdminDepartment(data) {
  return Request.post('admin-departments', data)
}

export function destroyAdminDepartment(id) {
  return Request.delete(`admin-departments/${id}`)
}

export function updateAdminDepartment(id, data) {
  return Request.put(`admin-departments/${id}`, data)
}

export function editAdminDepartment(id) {
  return Request.get(`admin-departments/${id}/edit`)
}

export function createAdminDepartment() {
  return Request.get('admin-departments/create')
}
