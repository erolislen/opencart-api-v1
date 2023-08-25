<?php
class ControllerApiRestWishlist extends Controller {

	public function getWishlist() {

		$this->load->language('api/rest');

		$json = array();

	
		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			if (isset($this->request->get['customer_id'])) {
				$customer_id = $this->request->get['customer_id'];
			} else {
				$customer_id = 0;
			}

			$wishlist = $this->model_rest_api->getCustomerWishlist($customer_id);

			if ($wishlist) {
				$json['wishlist'] = $wishlist;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getTotalWishlist() {

		$this->load->language('api/rest');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			if (isset($this->request->get['customer_id'])) {
				$customer_id = $this->request->get['customer_id'];
			} else {
				$customer_id = 0;
			}

			$wishlist_total = $this->model_rest_api->getCustomerTotalWishlist($customer_id);

			if ($wishlist_total) {
				$json['wishlist_total'] = $wishlist_total;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}





}
