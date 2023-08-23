<?php
class ControllerApiRestOrder extends Controller {

	public function getOrder() {
		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			$order_info = $this->model_rest_api->getOrder($order_id);

			if ($order_info) {
				$json['order'] = $order_info;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getOrders() { 

		$this->load->language('api/rest');
	
		$json = array();
	
		if (!isset($_COOKIE['api_token'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			$data = array(
				'limit' => isset($this->request->get['limit']) ? (int)$this->request->get['limit'] : 500,
				'order_status' => isset($this->request->get['order_status']) ? (int)$this->request->get['order_status'] : 1,
				'orderby' => isset($this->request->get['orderby']) ? $this->request->get['orderby'] : 'o.order_id',
				'sort' => isset($this->request->get['sort']) ? $this->request->get['sort']: 'DESC',
				'start_date' => isset($this->request->get['start_date']) ? $this->request->get['start_date']: null,
				'end_date' => isset($this->request->get['end_date']) ? $this->request->get['end_date']: null,
			 );

			 $orders = $this->model_rest_api->getOrders($data);

			 if ($orders) {
				$json['orders'] = $orders;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getOrderProducts() {
		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			$order_product = $this->model_rest_api->getOrderProducts($order_id);

			if ($order_product) {
				$json['product'] = $order_product;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getOrderOptions() {
		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('checkout/order');

			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			if (isset($this->request->get['order_product_id'])) {
				$order_product_id = $this->request->get['order_product_id'];
			} else {
				$order_product_id = 0;
			}

			$order_options = $this->model_checkout_order->getOrderOptions($order_id,$order_product_id);

			if ($order_options) {
				$json['order_options'] = $order_options;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getOrderTotals() {
		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('checkout/order');

			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			$order_total = $this->model_checkout_order->getOrderTotals($order_id);

			if ($order_total) {
				$json['total'] = $order_total;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function deleteOrder() {
		$this->load->language('api/rest');

		$json = array();
	
		if (!isset($_COOKIE['api_token'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
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
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}



}
