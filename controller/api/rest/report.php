<?php
class ControllerApiRestReport extends Controller {

	public function getStatistics() {

		$this->load->language('api/rest');

		$json = array();

		if (!isset($_COOKIE['api_token'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('report/statistics');

			$statistics = $this->model_report_statistics->getStatistics();

			if ($statistics) {
				$json['statistics'] = $statistics;
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}




}
