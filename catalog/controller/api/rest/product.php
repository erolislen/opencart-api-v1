<?php
class ControllerApiRestProduct extends Controller {

	
	public function getProduct() {

		$this->load->language('api/rest');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			if (isset($this->request->get['product_id'])) {
				$product_id = $this->request->get['product_id'];
			} else {
				$product_id = 0;
			}

			$product = $this->model_rest_api->getProduct($product_id);

			if ($product) {
				$json['product'] = $product;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getProducts() { 

		$this->load->language('api/rest');
	
		$json = array();
	
		if (!isset($this->session->data['api_id'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			$data = array(
				'limit' => isset($this->request->get['limit']) ? (int)$this->request->get['limit'] : 500,
				'status' => isset($this->request->get['status']) ? (int)$this->request->get['status'] : 1,
				'orderby' => isset($this->request->get['orderby']) ? $this->request->get['orderby'] : 'p.product_id',
				'sort' => isset($this->request->get['sort']) ? $this->request->get['sort']: 'DESC',

			 );

			 $products = $this->model_rest_api->getProducts($data);

			 if ($products) {
				$json['products'] = $products;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getProductImages() {

		$this->load->language('api/rest');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('catalog/product');

			if (isset($this->request->get['product_id'])) {
				$product_id = $this->request->get['product_id'];
			} else {
				$product_id = 0;
			}

			$images = $this->model_catalog_product->getProductImages($product_id);

			if ($images) {
				$json['images'] = $images;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getProductAttributes() {

		$this->load->language('api/rest');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('catalog/product');

			if (isset($this->request->get['product_id'])) {
				$product_id = $this->request->get['product_id'];
			} else {
				$product_id = 0;
			}

			$product_attributes = $this->model_catalog_product->getProductAttributes($product_id);

			if ($product_attributes) {
				$json['product_attributes'] = $product_attributes;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getProductOptions() {

		$this->load->language('api/rest');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('catalog/product');

			if (isset($this->request->get['product_id'])) {
				$product_id = $this->request->get['product_id'];
			} else {
				$product_id = 0;
			}

			$product_options = $this->model_catalog_product->getProductOptions($product_id);

			if ($product_options) {
				$json['product_options'] = $product_options;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getPopularProducts() {

		$this->load->language('api/rest');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('catalog/product');

			$limit = isset($this->request->get['limit']) ? $this->request->get['limit'] : 500;

			$popular_products = $this->model_catalog_product->getPopularProducts($limit);

			if ($popular_products) {
				$json['popular_products'] = $popular_products;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getProductsByCategoryId() { 

		$this->load->language('api/rest');
	
		$json = array();
	
		if (!isset($this->session->data['api_id'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			
			if (isset($this->request->get['category_id'])) {
				$category_id = $this->request->get['category_id'];
			} else {
				$category_id = 0;
			}

			$data = array(
				'limit' => isset($this->request->get['limit']) ? (int)$this->request->get['limit'] : 500,
				'status' => isset($this->request->get['status']) ? (int)$this->request->get['status'] : 1,
				'orderby' => isset($this->request->get['orderby']) ? $this->request->get['orderby'] : 'p.product_id',
				'sort' => isset($this->request->get['sort']) ? $this->request->get['sort']: 'DESC',

			 );

			 $products = $this->model_rest_api->getProductsByCategoryId($category_id,$data);

			 if ($products) {
				$json['products'] = $products;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function deleteProduct() {
		$this->load->language('api/rest');

		$json = array();
	
		if (!isset($this->session->data['api_id'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {

			$this->load->model('catalog/product');
			$this->load->model('rest/api');

			$product_id = isset($this->request->get['product_id']) ? (int)$this->request->get['product_id'] : 0;
	
			if (!$product_id) {
				$json['error']['warning'] = $this->language->get('error_not_found');
			} else {
				$product = $this->model_catalog_product->getProduct($product_id);

				if (!$product) {
					$json['error']['warning'] = $this->language->get('error_not_found');
				} else {
					$this->model_rest_api->deleteProduct($product_id);
					$json['success'] = $this->language->get('text_success');
				}
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


}
