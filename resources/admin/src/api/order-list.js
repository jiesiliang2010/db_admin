import Request from '@/plugins/request'

export function getOrderList(params = {}) {
  return Request.get('order-list', { params });
}


