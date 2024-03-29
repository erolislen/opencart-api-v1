<?php

class ControllerApiRestOrder extends Controller
{
	private function initializeApiResponse()
	{
		$json = [];
		$this->load->language('api/rest');

		if (!isset($this->session->data['api_id'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		}

		return $json;
	}

	private function sendResponse($json)
	{
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getOrder()
	{
		$json = $this->initializeApiResponse();

		if (!isset($json['error'])) {
			$this->load->model('rest/api');

			$order_id = isset($this->request->get['order_id']) ? $this->request->get['order_id'] : 0;
			$order_info = $this->model_rest_api->getOrder($order_id);

			if ($order_info) {
				$json['order'] = $order_info;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->sendResponse($json);
	}

	public function getOrders()
	{
		$json = $this->initializeApiResponse();

		if (!isset($json['error'])) {
			$this->load->model('rest/api');

			$data = array(
				'limit' => isset($this->request->get['limit']) ? (int)$this->request->get['limit'] : 500,
				'order_status' => isset($this->request->get['order_status']) ? (int)$this->request->get['order_status'] : 1,
				'orderby' => isset($this->request->get['orderby']) ? $this->request->get['orderby'] : 'o.order_id',
				'sort' => isset($this->request->get['sort']) ? $this->request->get['sort'] : 'DESC',
				'start_date' => isset($this->request->get['start_date']) ? $this->request->get['start_date'] : null,
				'end_date' => isset($this->request->get['end_date']) ? $this->request->get['end_date'] : null,
			);

			$orders = $this->model_rest_api->getOrders($data);

			if ($orders) {
				$json['orders'] = $orders;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->sendResponse($json);
	}

	public function getOrderProducts()
	{
		$json = $this->initializeApiResponse();

		if (!isset($json['error'])) {
			$this->load->model('rest/api');

			$order_id = isset($this->request->get['order_id']) ? $this->request->get['order_id'] : 0;

			$order_product = $this->model_rest_api->getOrderProducts($order_id);

			if ($order_product) {
				$json['product'] = $order_product;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->sendResponse($json);
	}

	public function getOrderOptions()
	{
		$json = $this->initializeApiResponse();

		if (!isset($json['error'])) {
			$this->load->model('checkout/order');

			$order_id = isset($this->request->get['order_id']) ? $this->request->get['order_id'] : 0;
			$order_product_id = isset($this->request->get['order_product_id']) ? $this->request->get['order_product_id'] : 0;

			$order_options = $this->model_checkout_order->getOrderOptions($order_id, $order_product_id);

			if ($order_options) {
				$json['order_options'] = $order_options;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->sendResponse($json);
	}

	public function getOrderTotals()
	{
		$json = $this->initializeApiResponse();

		if (!isset($json['error'])) {
			$this->load->model('checkout/order');

			$order_id = isset($this->request->get['order_id']) ? $this->request->get['order_id'] : 0;

			$order_total = $this->model_checkout_order->getOrderTotals($order_id);

			if ($order_total) {
				$json['total'] = $order_total;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->sendResponse($json);
	}

	public function deleteOrder()
	{
		$json = $this->initializeApiResponse();

		if (!isset($json['error'])) {
			$this->load->model('checkout/order');

			$order_id = isset($this->request->get['order_id']) ? (int)$this->request->get['order_id'] : null;

			if (!$order_id) {
				$json['error']['warning'] = $this->language->get('error_not_found');
			} else {
				$order = $this->model_checkout_order->getOrder($order_id);

				if (!$order) {
					$json['error']['warning'] = $this->language->get('error_not_found');
				} else {
					$this->model_checkout_order->deleteOrder($order_id);
					$json['success'] = $this->language->get('text_success');
				}
			}
		}

		$this->sendResponse($json);
	}

	public function editOrderStatus()
	{
		$json = $this->initializeApiResponse();

		if (!isset($json['error'])) {
			$this->load->model('checkout/order');

			$order_id = isset($this->request->post['order_id']) ? $this->request->post['order_id'] : null;
			$order_status_id = isset($this->request->post['order_status_id']) ? $this->request->post['order_status_id'] : null;

			if ($order_id && $order_status_id) {
				$this->model_checkout_order->addOrderHistory($order_id, $order_status_id);
				$json['success'] = $this->language->get('text_success');
			} else {
				$json['error']['warning'] = $this->language->get('error_not_found');
			}
		}

		$this->sendResponse($json);
	}
}
