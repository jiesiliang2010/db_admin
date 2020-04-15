import Request from '@/plugins/request'

export function getUserReport(params = {}) {
  return Request.get('userReport/list',{ params })
}

// export function storeAdminUser(data) {
//   return Request.post('admin-users', data)
// }

