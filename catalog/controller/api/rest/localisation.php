<?php
class ControllerApiRestLocalisation extends Controller {

	public function getCountry() {
		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('localisation/country');

			if (isset($this->request->get['country_id'])) {
				$country_id = $this->request->get['country_id'];
			} else {
				$country_id = 0;
			}

			$country = $this->model_localisation_country->getCountry($country_id);

			if ($country) {
				$json['country'] = $country;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	public function getCountries() {

		$this->load->language('api/rest');
	
		$json = array();
	
		if (!isset($_COOKIE['api_token'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			$data = array(
				'limit' => isset($this->request->get['limit']) ? (int)$this->request->get['limit'] : 500,
				'status' => isset($this->request->get['order_status']) ? (int)$this->request->get['status'] : 1,
				'orderby' => isset($this->request->get['orderby']) ? $this->request->get['orderby'] : 'country_id',
				'sort' => isset($this->request->get['sort']) ? $this->request->get['sort']: 'DESC',
			 );

			$countries = $this->model_rest_api->getCountries($data);
			if ($countries) {
				$json['countries'] = $countries;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getCurrencyByCode() {

		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('localisation/currency');

			if (isset($this->request->get['currency'])) {
				$currency = $this->request->get['currency'];
			} else {
				$currency = "";
			}


			$currency = $this->model_localisation_currency->getCurrencyByCode($currency);

			if ($currency) {
				$json['currency'] = $currency;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getCurrencies() {

		$this->load->language('api/rest');
	
		$json = array();
	
		if (!isset($_COOKIE['api_token'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			$data = array(
				'limit' => isset($this->request->get['limit']) ? (int)$this->request->get['limit'] : 500,
				'status' => isset($this->request->get['order_status']) ? (int)$this->request->get['status'] : 1,
				'orderby' => isset($this->request->get['orderby']) ? $this->request->get['orderby'] : 'currency_id',
				'sort' => isset($this->request->get['sort']) ? $this->request->get['sort']: 'DESC',
			 );

			$currencies = $this->model_rest_api->getCurrencies($data);
			if ($currencies) {
				$json['currencies'] = $currencies;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getZone() {
		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('localisation/zone');

			if (isset($this->request->get['zone_id'])) {
				$zone_id = $this->request->get['zone_id'];
			} else {
				$zone_id = 0;
			}

			$zone = $this->model_localisation_zone->getZone($zone_id);

			if ($zone) {
				$json['zone'] = $zone;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getZonesByCountryId() {
		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('localisation/zone');

			if (isset($this->request->get['country_id'])) {
				$country_id = $this->request->get['country_id'];
			} else {
				$country_id = 0;
			}

			$zones = $this->model_localisation_zone->getZonesByCountryId($country_id);

			if ($zones) {
				$json['zones'] = $zones;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getLanguage() {
		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('localisation/language');

			if (isset($this->request->get['language_id'])) {
				$language_id = $this->request->get['language_id'];
			} else {
				$language_id = 0;
			}

			$language = $this->model_localisation_language->getLanguage($language_id);

			if ($language) {
				$json['language'] = $language;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getLanguages() {

		$this->load->language('api/rest');
	
		$json = array();
	
		if (!isset($_COOKIE['api_token'])) {
			$json['error']['warning'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			$data = array(
				'limit' => isset($this->request->get['limit']) ? (int)$this->request->get['limit'] : 500,
				'status' => isset($this->request->get['order_status']) ? (int)$this->request->get['status'] : 1,
				'orderby' => isset($this->request->get['orderby']) ? $this->request->get['orderby'] : 'language_id',
				'sort' => isset($this->request->get['sort']) ? $this->request->get['sort']: 'DESC',
			 );

			$languages = $this->model_rest_api->getLanguages($data);
			if ($languages) {
				$json['languages'] = $languages;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}
	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getOrderStatus() {
		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('localisation/order_status');

			if (isset($this->request->get['order_status_id'])) {
				$order_status_id = $this->request->get['order_status_id'];
			} else {
				$order_status_id = 0;
			}
			

			$order_status = $this->model_localisation_order_status->getOrderStatus($order_status_id);

			if ($order_status) {
				$json['order_status'] = $order_status;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getOrderStatuses() {
		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('rest/api');

			$data = array(
				'limit' => isset($this->request->get['limit']) ? (int)$this->request->get['limit'] : 500,
				'status' => isset($this->request->get['order_status']) ? (int)$this->request->get['status'] : 1,
				'orderby' => isset($this->request->get['orderby']) ? $this->request->get['orderby'] : 'order_status_id',
				'sort' => isset($this->request->get['sort']) ? $this->request->get['sort']: 'DESC',
				'language_id' => isset($this->request->get['language_id']) ? $this->request->get['language_id']: $this->config->get('config_language_id'),
			 );

			$order_statuses = $this->model_rest_api->getOrderStatuses($data);

			if ($order_statuses) {
				$json['order_statuses'] = $order_statuses;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


}
