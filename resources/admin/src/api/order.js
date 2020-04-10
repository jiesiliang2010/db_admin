import Request from '@/plugins/request'

export function getOrderDetail(id) {
  return Request.get(`/order/detail/${id}`)
}

export function getOrderLog(id) {
  return Request.get(`/order-log/${id}`)
}
