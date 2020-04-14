import Request from '@/plugins/request'

export function getOrderDetail(id) {
  return Request.get(`/order/detail/${id}`)
}

export function getOrderLog(id) {
  return Request.get(`/order/log-list/${id}`)
}

export function getOrderTransLog(id) {
    return Request.get(`/order/trans-list/${id}`)
}

export function getOrderSupplier(data) {
  return Request.post(`order-detail/getOrderSupplier`,data)
}
export function getOrderSupplierShops(data) {
  return Request.post(`order-detail/getOrderSupplierShops`,data)
}

export function getCompensateReasonPost(data) {
  return Request.post(`order-detail/getCompensateReason`,data)
}

export function doOrderCompensate(data) {
  return Request.post(`order-detail/doOrderCompensate`,data)
}
export function showCompensateLog(data) {
  return Request.post(`order-detail/showCompensateLog`,data)
}
