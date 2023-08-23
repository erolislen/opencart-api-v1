<?php
class ModelRestApi extends Model {

	public function getCategories($data = array()) {


		$sql = "SELECT * FROM " . DB_PREFIX . "category c 
				LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) 
				LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) 
				WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
				AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  
				AND c.status = '1' ";
	
		
		if (isset($data['status'])) {
			$sql .= "AND c.status = '" . (int)$data['status'] . "' ";
		}
	
		if (isset($data['orderby'])) {
			$sql .= "ORDER BY " . $data['orderby'] . " ";
		}

		if (isset($data['sort'])) {
			$sql .= $data['sort'] . " ";
		}
		
		if (isset($data['limit'])) {
			$sql .= "LIMIT " . (int)$data['limit'] . " ";
		}
	
		$query = $this->db->query($sql);
	
		return $query->rows;
	}

	public function getCustomers($data = array()) {

		$sql = "SELECT * FROM " . DB_PREFIX . "customer";
		
		if(isset($data['status'])) {
			$sql .= " WHERE status = '" . (int)$data['status'] . "'";
		}
			
		if(isset($data['orderby'])){
			$sql .= " ORDER BY ". $data['orderby'];
		}

		if(isset($data['sort'])){
			$sql .= " " . $data['sort'];
		}

		if(isset($data['limit'])) {
			$sql .= " LIMIT " . (int)$data['limit'];
		}


		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getCustomerAddresses($customer_id) {
		$address_data = array();
	
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");
	
		foreach ($query->rows as $result) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$result['country_id'] . "'");
	
			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';
				$address_format = '';
			}
	
			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$result['zone_id'] . "'");
	
			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}
	
			$address_data[$result['address_id']] = array(
				'address_id'     => $result['address_id'],
				'firstname'      => $result['firstname'],
				'lastname'       => $result['lastname'],
				'company'        => $result['company'],
				'address_1'      => $result['address_1'],
				'address_2'      => $result['address_2'],
				'postcode'       => $result['postcode'],
				'city'           => $result['city'],
				'zone_id'        => $result['zone_id'],
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $result['country_id'],
				'country'        => $country,
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format,
				'custom_field'   => json_decode($result['custom_field'], true)
	
			);
		}
	
		return $address_data;
	}

	public function getCustomerGroups() {

		
		$sql = "SELECT * FROM " . DB_PREFIX . "customer_group cg LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (cg.customer_group_id = cgd.customer_group_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "' ";

	
		if (isset($data['orderby'])) {
			$sql .= "ORDER BY " . $data['orderby'] . " ";
		}

		if (isset($data['sort'])) {
			$sql .= $data['sort'] . " ";
		}
		
		if (isset($data['limit'])) {
			$sql .= "LIMIT " . (int)$data['limit'] . " ";
		}
	
		$query = $this->db->query($sql);
	
		return $query->rows;
	}

	public function getCountries($data = array()) {


		$sql = "SELECT * FROM " . DB_PREFIX . "country";
		
		if(isset($data['status'])) {
			$sql .= " WHERE status = '" . (int)$data['status'] . "'";
		}
			
		if(isset($data['orderby'])){
			$sql .= " ORDER BY ". $data['orderby'];
		}

		if(isset($data['sort'])){
			$sql .= " " . $data['sort'];
		}

		if(isset($data['limit'])) {
			$sql .= " LIMIT " . (int)$data['limit'];
		}


		$query = $this->db->query($sql);
		return $query->rows;
	}

	public function getCurrencies($data = array()) {


		$sql = "SELECT * FROM " . DB_PREFIX . "currency";
		
		if(isset($data['status'])) {
			$sql .= " WHERE status = '" . (int)$data['status'] . "'";
		}
			
		if(isset($data['orderby'])){
			$sql .= " ORDER BY ". $data['orderby'];
		}

		if(isset($data['sort'])){
			$sql .= " " . $data['sort'];
		}

		if(isset($data['limit'])) {
			$sql .= " LIMIT " . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$currency_data[$result['code']] = array(
				'currency_id'   => $result['currency_id'],
				'title'         => $result['title'],
				'code'          => $result['code'],
				'symbol_left'   => $result['symbol_left'],
				'symbol_right'  => $result['symbol_right'],
				'decimal_place' => $result['decimal_place'],
				'value'         => $result['value'],
				'status'        => $result['status'],
				'date_modified' => $result['date_modified']
			);
		}


		return $currency_data;
	}

	public function getLanguages($data = array()) {


		$sql = "SELECT * FROM " . DB_PREFIX . "language";
		
		if(isset($data['status'])) {
			$sql .= " WHERE status = '" . (int)$data['status'] . "'";
		}
			
		if(isset($data['orderby'])){
			$sql .= " ORDER BY ". $data['orderby'];
		}

		if(isset($data['sort'])){
			$sql .= " " . $data['sort'];
		}

		if(isset($data['limit'])) {
			$sql .= " LIMIT " . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
		
		foreach ($query->rows as $result) {
			$language_data[$result['code']] = array(
				'language_id' => $result['language_id'],
				'name'        => $result['name'],
				'code'        => $result['code'],
				'locale'      => $result['locale'],
				'image'       => $result['image'],
				'directory'   => $result['directory'],
				'sort_order'  => $result['sort_order'],
				'status'      => $result['status']
			);
		}


		return $language_data;
	}

	public function getOrderStatuses($data = array()) {
		
		$sql = "SELECT order_status_id, name FROM " . DB_PREFIX . "order_status WHERE language_id = '" . (int)$data['language_id'] . "' ";
		
			
		if(isset($data['orderby'])){
			$sql .= " ORDER BY ". $data['orderby'];
		}

		if(isset($data['sort'])){
			$sql .= " " . $data['sort'];
		}

		if(isset($data['limit'])) {
			$sql .= " LIMIT " . (int)$data['limit'];
		}


		$query = $this->db->query($sql);
		return $query->rows;
		
	}

	public function getManufacturers($data = array()) {


		$sql = "SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

	
		if (isset($data['orderby'])) {
			$sql .= "ORDER BY " . $data['orderby'] . " ";
		}

		if (isset($data['sort'])) {
			$sql .= $data['sort'] . " ";
		}
		
		if (isset($data['limit'])) {
			$sql .= "LIMIT " . (int)$data['limit'] . " ";
		}
	
		$query = $this->db->query($sql);
	
		return $query->rows;
	}

	public function getTotalManufacturers() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "manufacturer");

		return $query->row['total'];
	}

	public function deleteManufacturer($manufacturer_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "manufacturer` WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "manufacturer_to_store` WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "seo_url` WHERE query = 'manufacturer_id=" . (int)$manufacturer_id . "'");

		$this->cache->delete('manufacturer');
	}

	public function getOrder($order_id) {
		$order_query = $this->db->query("SELECT *, (SELECT os.name FROM `" . DB_PREFIX . "order_status` os WHERE os.order_status_id = o.order_status_id AND os.language_id = o.language_id) AS order_status FROM `" . DB_PREFIX . "order` o WHERE o.order_id = '" . (int)$order_id . "'");

		if ($order_query->num_rows) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['payment_country_id'] . "'");

			if ($country_query->num_rows) {
				$payment_iso_code_2 = $country_query->row['iso_code_2'];
				$payment_iso_code_3 = $country_query->row['iso_code_3'];
			} else {
				$payment_iso_code_2 = '';
				$payment_iso_code_3 = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['payment_zone_id'] . "'");

			if ($zone_query->num_rows) {
				$payment_zone_code = $zone_query->row['code'];
			} else {
				$payment_zone_code = '';
			}

			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['shipping_country_id'] . "'");

			if ($country_query->num_rows) {
				$shipping_iso_code_2 = $country_query->row['iso_code_2'];
				$shipping_iso_code_3 = $country_query->row['iso_code_3'];
			} else {
				$shipping_iso_code_2 = '';
				$shipping_iso_code_3 = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['shipping_zone_id'] . "'");

			if ($zone_query->num_rows) {
				$shipping_zone_code = $zone_query->row['code'];
			} else {
				$shipping_zone_code = '';
			}

			$this->load->model('localisation/language');

			$language_info = $this->model_localisation_language->getLanguage($order_query->row['language_id']);

			if ($language_info) {
				$language_code = $language_info['code'];
			} else {
				$language_code = $this->config->get('config_language');
			}

			return array(
				'order_id'                => $order_query->row['order_id'],
				'invoice_no'              => $order_query->row['invoice_no'],
				'invoice_prefix'          => $order_query->row['invoice_prefix'],
				'store_id'                => $order_query->row['store_id'],
				'store_name'              => $order_query->row['store_name'],
				'store_url'               => $order_query->row['store_url'],
				'customer_id'             => $order_query->row['customer_id'],
				'firstname'               => $order_query->row['firstname'],
				'lastname'                => $order_query->row['lastname'],
				'email'                   => $order_query->row['email'],
				'telephone'               => $order_query->row['telephone'],
				'custom_field'            => json_decode($order_query->row['custom_field'], true),
				'payment_firstname'       => $order_query->row['payment_firstname'],
				'payment_lastname'        => $order_query->row['payment_lastname'],
				'payment_company'         => $order_query->row['payment_company'],
				'payment_address_1'       => $order_query->row['payment_address_1'],
				'payment_address_2'       => $order_query->row['payment_address_2'],
				'payment_postcode'        => $order_query->row['payment_postcode'],
				'payment_city'            => $order_query->row['payment_city'],
				'payment_zone_id'         => $order_query->row['payment_zone_id'],
				'payment_zone'            => $order_query->row['payment_zone'],
				'payment_zone_code'       => $payment_zone_code,
				'payment_country_id'      => $order_query->row['payment_country_id'],
				'payment_country'         => $order_query->row['payment_country'],
				'payment_iso_code_2'      => $payment_iso_code_2,
				'payment_iso_code_3'      => $payment_iso_code_3,
				'payment_address_format'  => $order_query->row['payment_address_format'],
				'payment_custom_field'    => json_decode($order_query->row['payment_custom_field'], true),
				'payment_method'          => $order_query->row['payment_method'],
				'payment_code'            => $order_query->row['payment_code'],
				'shipping_firstname'      => $order_query->row['shipping_firstname'],
				'shipping_lastname'       => $order_query->row['shipping_lastname'],
				'shipping_company'        => $order_query->row['shipping_company'],
				'shipping_address_1'      => $order_query->row['shipping_address_1'],
				'shipping_address_2'      => $order_query->row['shipping_address_2'],
				'shipping_postcode'       => $order_query->row['shipping_postcode'],
				'shipping_city'           => $order_query->row['shipping_city'],
				'shipping_zone_id'        => $order_query->row['shipping_zone_id'],
				'shipping_zone'           => $order_query->row['shipping_zone'],
				'shipping_zone_code'      => $shipping_zone_code,
				'shipping_country_id'     => $order_query->row['shipping_country_id'],
				'shipping_country'        => $order_query->row['shipping_country'],
				'shipping_iso_code_2'     => $shipping_iso_code_2,
				'shipping_iso_code_3'     => $shipping_iso_code_3,
				'shipping_address_format' => $order_query->row['shipping_address_format'],
				'shipping_custom_field'   => json_decode($order_query->row['shipping_custom_field'], true),
				'shipping_method'         => $order_query->row['shipping_method'],
				'shipping_code'           => $order_query->row['shipping_code'],
				'comment'                 => $order_query->row['comment'],
				'total'                   => $order_query->row['total'],
				'order_status_id'         => $order_query->row['order_status_id'],
				'order_status'            => $order_query->row['order_status'],
				'affiliate_id'            => $order_query->row['affiliate_id'],
				'commission'              => $order_query->row['commission'],
				'language_id'             => $order_query->row['language_id'],
				'language_code'           => $language_code,
				'currency_id'             => $order_query->row['currency_id'],
				'currency_code'           => $order_query->row['currency_code'],
				'currency_value'          => $order_query->row['currency_value'],
				'ip'                      => $order_query->row['ip'],
				'forwarded_ip'            => $order_query->row['forwarded_ip'],
				'user_agent'              => $order_query->row['user_agent'],
				'accept_language'         => $order_query->row['accept_language'],
				'date_added'              => $order_query->row['date_added'],
				'date_modified'           => $order_query->row['date_modified'],
				'products'			      => $this->getOrderProducts($order_id)
			);
		} else {
			return false;
		}
	}

	public function getOrders($data = array()) {

		$sql = "SELECT o.order_id, CONCAT(o.firstname, ' ', o.lastname) AS customer, (SELECT os.name FROM " . DB_PREFIX . "order_status os WHERE os.order_status_id = o.order_status_id AND os.language_id = '" . (int)$this->config->get('config_language_id') . "') AS order_status, o.shipping_code, o.total, o.currency_code, o.currency_value, o.date_added, o.date_modified 
				FROM `" . DB_PREFIX . "order` o";
	
		$where = array();
	
		if (!empty($data['order_status'])) {
			$where[] = "o.order_status_id = '" . (int)$data['order_status'] . "'";
		}
	
		if (!empty($data['start_date'])) {
			$where[] = "DATE(o.date_added) >= DATE('" . $this->db->escape($data['start_date']) . "')";
		}
	
		if (!empty($data['end_date'])) {
			$where[] = "DATE(o.date_added) <= DATE('" . $this->db->escape($data['end_date']) . "')";
		}
	
		if (!empty($where)) {
			$sql .= " WHERE " . implode(" AND ", $where);
		} else {
			$sql .= " WHERE o.order_status_id > '0'";
		}
			
		if (isset($data['orderby'])) {
			$sql .= "ORDER BY " . $data['orderby'] . " ";
		}

		if (isset($data['sort'])) {
			$sql .= $data['sort'] . " ";
		}
		
		if (isset($data['limit'])) {
			$sql .= "LIMIT " . (int)$data['limit'] . " ";
		}
	
		$query = $this->db->query($sql);
	
		return $query->rows;
	}

	public function getOrderProducts($order_id) {
		$query = $this->db->query("
			SELECT op.*, p.sku, p.upc, p.ean, p.jan, p.isbn, p.mpn
			FROM " . DB_PREFIX . "order_product op
			JOIN " . DB_PREFIX . "product p ON op.product_id = p.product_id
			WHERE op.order_id = '" . (int)$order_id . "'
		");
	
		return $query->rows;
	}

	public function deleteProduct($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_recurring WHERE product_id = " . (int)$product_id);
		$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "coupon_product WHERE product_id = '" . (int)$product_id . "'");

		$this->cache->delete('product');
	}

	public function getProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT *, GROUP_CONCAT(cd.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS category FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) LEFT JOIN " . DB_PREFIX . "category_description cd ON (p2c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_path cp ON (p2c.category_id = cp.category_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY p.product_id");
	
		return $query->row;
	}

	public function getProducts($data = array()) {
		$sql = "SELECT p.*, pd.name as product_name, pd.description, pd.meta_title, pd.meta_description, pd.meta_keyword, pd.tag, c.category_id, cd.name as category_name 
				FROM " . DB_PREFIX . "product p 
				LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
				LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)
				LEFT JOIN " . DB_PREFIX . "category c ON (p2c.category_id = c.category_id)
				LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id)
				WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
	
		if(isset($data['status'])) {
			$sql .= " AND p.status = '" . (int)$data['status'] . "'";
		}
	
		if(isset($data['orderby'])){
			$sql .= " ORDER BY ". $data['orderby'];
		}
	
		if(isset($data['sort'])){
			$sql .= " " . $data['sort'];
		} else {
			$sql .= " DESC";
		}
	
		if(isset($data['limit'])) {
			$sql .= " LIMIT " . (int)$data['limit'];
		}
	
		$query = $this->db->query($sql);
	
		return $query->rows;
	}

	public function getProductsByCategoryId($category_id, $options = array()) {

		$sql = "SELECT * FROM " . DB_PREFIX . "product p 
				LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
				LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) 
				WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
				AND p2c.category_id = '" . (int)$category_id . "'";
		
		if(isset($options['status'])) {
			$sql .= " AND p.status = '" . (int)$options['status'] . "'";
		}
		
		if(isset($options['orderby'])){
			$sql .= " ORDER BY ". $options['orderby'];
		}
		
		if(isset($options['sort'])){
			$sql .= " " . $options['sort'];
		} else {
			$sql .= " DESC";
		}
		
		if(isset($options['limit'])) {
			$sql .= " LIMIT " . (int)$options['limit'];
		}
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}

	public function getCustomerWishlist($customer_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->rows;
	}

	public function getCustomerTotalWishlist($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}



}