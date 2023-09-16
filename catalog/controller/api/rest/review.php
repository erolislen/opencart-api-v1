<?php
class ControllerApiRestReview extends Controller {

	
	public function getReviewsByProductId() {

		$this->load->language('api/rest');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('catalog/review');

			if (isset($this->request->get['product_id'])) {
				$product_id = $this->request->get['product_id'];
			} else {
				$product_id = 0;
			}

			$reviews = $this->model_catalog_review->getReviewsByProductId($product_id);

			if ($reviews) {
				$json['reviews'] = $reviews;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getTotalReviewsByProductId() {

		$this->load->language('api/rest');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('catalog/review');

			if (isset($this->request->get['product_id'])) {
				$product_id = $this->request->get['product_id'];
			} else {
				$product_id = 0;
			}

			$reviews = $this->model_catalog_review->getTotalReviewsByProductId($product_id);

			if ($reviews) {
				$json['reviews'] = $reviews;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}




}
