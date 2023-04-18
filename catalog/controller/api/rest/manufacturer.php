<?php
class ControllerApiRestManufacturer extends Controller {

	public function getManufacturer() {
		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('catalog/manufacturer');

			if (isset($this->request->get['manufacturer_id'])) {
				$manufacturer_id = $this->request->get['manufacturer_id'];
			} else {
				$manufacturer_id = 0;
			}

			$manufacturer = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

			if ($manufacturer) {
				$json['manufacturer'] = $manufacturer;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getManufacturers() {

		$this->load->language('api/rest');
	
		$json = array();
	
		if (!isset($_COOKIE['api_token'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			$data = array(
				'limit' => isset($this->request->get['limit']) ? (int)$this->request->get['limit'] : 500,
				'status' => isset($this->request->get['order_status']) ? (int)$this->request->get['status'] : 1,
				'orderby' => isset($this->request->get['orderby']) ? $this->request->get['orderby'] : 'm.manufacturer_id',
				'sort' => isset($this->request->get['sort']) ? $this->request->get['sort']: 'DESC',
			 );

			$manufacturers = $this->model_rest_api->getManufacturers($data);
			if ($manufacturers) {
				$json['manufacturers'] = $manufacturers;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getTotalManufacturers() {

		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			$manufacturer_total = $this->model_rest_api->getTotalManufacturers();

			if ($manufacturer_total) {
				$json['manufacturer_total'] = $manufacturer_total;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function deleteManufacturer() {
		$this->load->language('api/rest');

		$json = array();
	
		if (!isset($_COOKIE['api_token'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {

			$this->load->model('catalog/manufacturer');
			$this->load->model('rest/api');

			$manufacturer_id = isset($this->request->get['manufacturer_id']) ? (int)$this->request->get['manufacturer_id'] : null;
	
			if (!$manufacturer_id) {
				$json['error']['warning'] = $this->language->get('error_not_found');
			} else {
				$manufacturer = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

				if (!$manufacturer) {
					$json['error']['warning'] = $this->language->get('error_not_found');
				} else {
					$this->model_rest_api->deleteManufacturer($manufacturer_id);
					$json['success'] = $this->language->get('text_success');
				}
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


}
