import Request from '@/plugins/request'

export function getOrderList(params = {}) {
  return Request.post('order-list', { params });
}


