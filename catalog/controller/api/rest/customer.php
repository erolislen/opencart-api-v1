<?php
class ControllerApiRestCustomer extends Controller {
	
	public function getCustomer() {
		$this->load->language('api/rest');
	
		$json = array();
	
		if (!isset($_COOKIE['api_token'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
			if (isset($this->request->get['customer_id'])) {

				$this->load->model('account/customer');
				$this->load->model('rest/api');

				$customer = $this->model_account_customer->getCustomer($this->request->get['customer_id']);
	
				if ($customer) {
					$addresses = $this->model_rest_api->getCustomerAddresses($customer['customer_id']);
					
					$customer_data = array(
						'customer_id' => $customer['customer_id'],
						'firstname' => $customer['firstname'],
						'lastname' => $customer['lastname'],
						'email' => $customer['email'],
						'telephone' => $customer['telephone'],
						'newsletter' => $customer['newsletter'],
						'status' => $customer['status'],
						'addresses' => $addresses
					);
	
					$json['customer'] = $customer_data;
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
	
	public function getCustomers() {
		$this->load->language('api/rest');
	
		$json = array();
	
		if (!isset($_COOKIE['api_token'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {

			$this->load->model('rest/api');

			$data = array(
				'limit' => isset($this->request->get['limit']) ? (int)$this->request->get['limit'] : 500,
				'status' => isset($this->request->get['status']) ? (int)$this->request->get['status'] : null,
				'orderby' => isset($this->request->get['orderby']) ? $this->request->get['orderby'] : 'customer_id',
				'sort' => isset($this->request->get['sort']) ? $this->request->get['sort']: 'DESC'
 			);
			
			$customers = $this->model_rest_api->getCustomers($data);
	
			$json['customers'] = array();
			foreach ($customers as $customer) {
				$json['customers'][] = array(
					'customer_id' => $customer['customer_id'],
					'firstname' => $customer['firstname'],
					'lastname' => $customer['lastname'],
					'email' => $customer['email'],
					'telephone' => $customer['telephone'],
					'newsletter' => $customer['newsletter'],
					'status' => $customer['status']
				);
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getCustomerByEmail() {
		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('account/customer');

			if (isset($this->request->get['email'])) {
				$email = $this->request->get['email'];
			} else {
				$email = "";
			}

			$customer = $this->model_account_customer->getCustomerByEmail($email);

			if ($customer) {
				$json['customer'] = $customer;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function deleteCustomer() {
		$this->load->language('api/rest');

		$json = array();
	
		if (!isset($_COOKIE['api_token'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {

			$this->load->model('account/customer');
			$this->load->model('account/address');

			$customer_id = isset($this->request->get['customer_id']) ? (int)$this->request->get['customer_id'] : null;
	
			if (!$customer_id) {
				$json['error']['warning'] = $this->language->get('error_id_missing');
			} else {
				$customer = $this->model_account_customer->getCustomer($customer_id);
				$this->model_account_address->deleteAddressByCustomerId($customer_id);

				if (!$customer) {
					$json['error']['warning'] = $this->language->get('error_not_found');
				} else {
					$this->model_account_customer->deleteCustomer($customer_id);
					$json['success'] = $this->language->get('text_success');
				}
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getCustomerGroup() {

		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('account/customer_group');

			if (isset($this->request->get['customer_group_id'])) {
				$customer_group_id = $this->request->get['customer_group_id'];
			} else {
				$customer_group_id = 0;
			}

			$customer_group = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

			if ($customer_group) {
				$json['customer_group'] = $customer_group;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getCustomerGroups() {
		$this->load->language('api/rest');
	
		$json = array();
	
		if (!isset($_COOKIE['api_token'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {

			$this->load->model('rest/api');

			$data = array(
				'limit' => isset($this->request->get['limit']) ? (int)$this->request->get['limit'] : 500,
				'orderby' => isset($this->request->get['orderby']) ? $this->request->get['orderby'] : 'customer_group_id',
				'sort' => isset($this->request->get['sort']) ? $this->request->get['sort']: 'DESC',
			 );

			$customer_groups = $this->model_rest_api->getCustomerGroups($data);
			if ($customer_groups) {
				$json['customer_groups'] = $customer_groups;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}

		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	
	

}
