<?php
class ControllerApiRestCategory extends Controller {

	public function getCategory() {
		$this->load->language('api/category');
		
		$json = array();
		if (!isset($this->session->data['api_id'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
			if (isset($this->request->get['category_id'])) {

				$this->load->model('catalog/category');

				$category_id = $this->request->get['category_id'];
				$category = $this->model_catalog_category->getCategory($category_id);

				if ($category) {
					$category_data = array(
						'category_id' => $category['category_id'],
						'name' => $category['name'],
						'description' => $category['description'],
						'meta_title' => $category['meta_title'],
						'meta_description' => $category['meta_description'],
						'meta_keyword' => $category['meta_keyword'],
						'image' => $category['image'],
						'top' => $category['top'],
						'sort_order' => $category['sort_order'],
						'status' => $category['status'],
						'parent_id' => $category['parent_id']
					);
					$json['category'] = $category_data;
				} else {
					$json['error']['warning'] = $this->language->get('error_not_found');
				}
			} else if (isset($this->request->get['parent_id'])) {
				$parent_id = $this->request->get['parent_id'];
				$categories = $this->model_catalog_category->getCategories($parent_id);
				$categories_data = array();
				foreach ($categories as $category) {
					$category_data = array(
						'category_id' => $category['category_id'],
						'name' => $category['name'],
						'description' => $category['description'],
						'meta_title' => $category['meta_title'],
						'meta_description' => $category['meta_description'],
						'meta_keyword' => $category['meta_keyword'],
						'image' => $category['image'],
						'top' => $category['top'],
						'sort_order' => $category['sort_order'],
						'status' => $category['status'],
						'parent_id' => $category['parent_id']
					);
					$categories_data[] = $category_data;
				}
				if (!empty($categories_data)) {
					$json['categories'] = $categories_data;
				} else {
					$json['error']['warning'] = $this->language->get('error_not_found');
				}
			} else {
				$json['error']['warning'] = $this->language->get('error_id_missing');
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getCategories() {
		$this->load->language('api/category');
	
		$json = array();
	
		if (!isset($this->session->data['api_id'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {

			$this->load->model('rest/api');

			$data = array(
				'limit' => isset($this->request->get['limit']) ? (int)$this->request->get['limit'] : 500,
				'status' => isset($this->request->get['status']) ? (int)$this->request->get['status'] : null,
				'orderby' => isset($this->request->get['orderby']) ? $this->request->get['orderby'] : 'c.category_id',
				'sort' => isset($this->request->get['sort']) ? $this->request->get['sort']: 'DESC'
 			);
			
			$categories = $this->model_rest_api->getCategories($data);
	
			$json['categories'] = array();
			foreach ($categories as $category) {
				$json['categories'][] = array(
					'category_id' => $category['category_id'],
					'name' => $category['name'],
					'description' => $category['description'],
					'meta_title' => $category['meta_title'],
					'meta_description' => $category['meta_description'],
					'meta_keyword' => $category['meta_keyword'],
					'image' => $category['image'],
					'top' => $category['top'],
					'sort_order' => $category['sort_order'],
					'status' => $category['status'],
					'parent_id' => $category['parent_id']
				);
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function deleteCategory() {
		$this->load->language('api/category');

		$json = array();
	
		if (!isset($this->session->data['api_id'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
			$this->load->model('catalog/category');

			$category_id = isset($this->request->get['category_id']) ? (int)$this->request->get['category_id'] : null;
	
			if (!$category_id) {
				$json['error']['warning'] = $this->language->get('error_id_missing');
			} else {
				$category = $this->model_catalog_category->getCategory($category_id);

				if (!$category) {
					$json['error']['warning'] = $this->language->get('error_not_found');
				} else {
					$this->model_catalog_category->deleteCategory($category_id);
					$json['success'] = $this->language->get('text_success');
				}
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


}
