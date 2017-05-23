<?php   
class ControllerCommonMacroDashboard extends Controller {   
	public function index() {
		$this->language->load('common/macro_dashboard');
        
        $this->load->model('catalog/macro_dashboard');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->data['heading_title'] = $this->language->get('heading_title');
        
        $this->data['text_select_a_store'] = $this->language->get('text_select_a_store');
        $this->data['text_sales'] = $this->language->get('text_sales');
        $this->data['text_total_sales'] = $this->language->get('text_total_sales');
        $this->data['text_this_year'] = $this->language->get('text_this_year');
        $this->data['text_this_month'] = $this->language->get('text_this_month');
        $this->data['text_today'] = $this->language->get('text_today');
        $this->data['text_statistics'] = $this->language->get('text_statistics');
        $this->data['text_orders'] = $this->language->get('text_orders');
        $this->data['text_customers'] = $this->language->get('text_customers');
        $this->data['text_reviews'] = $this->language->get('text_reviews');
        $this->data['text_sales_chart'] = $this->language->get('text_sales_chart');
        $this->data['text_last_orders'] = $this->language->get('text_last_orders');
        $this->data['text_order_id'] = $this->language->get('text_order_id');
        $this->data['text_customer'] = $this->language->get('text_customer');
        $this->data['text_status'] = $this->language->get('text_status');
        $this->data['text_order_date'] = $this->language->get('text_order_date');
        $this->data['text_total'] = $this->language->get('text_total');
        $this->data['text_best_sellers'] = $this->language->get('text_best_sellers');
        $this->data['text_category_inventory'] = $this->language->get('text_category_inventory');
        $this->data['text_total_categories'] = $this->language->get('text_total_categories');
        $this->data['text_active_categories'] = $this->language->get('text_active_categories');
        $this->data['text_product_inventory'] = $this->language->get('text_product_inventory');
        $this->data['text_total_products'] = $this->language->get('text_total_products');
        $this->data['text_in_stock'] = $this->language->get('text_in_stock');
        $this->data['text_affiliates'] = $this->language->get('text_affiliates');
        
        $this->data['text_active_products'] = $this->language->get('text_active_products');
        $this->data['text_downloadable'] = $this->language->get('text_downloadable');
        $this->data['text_out_of_stock'] = $this->language->get('text_out_of_stock');
        
        
        $this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['text_day'] = $this->language->get('text_day');
		$this->data['text_week'] = $this->language->get('text_week');
		$this->data['text_month'] = $this->language->get('text_month');
		$this->data['text_year'] = $this->language->get('text_year');
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['entry_range'] = $this->language->get('entry_range');

		// Check install directory exists
		if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
			$this->data['error_install'] = $this->language->get('error_install');
		} else {
			$this->data['error_install'] = '';
		}

		// Check image directory is writable
		$file = DIR_IMAGE . 'test';

		$handle = fopen($file, 'a+'); 

		fwrite($handle, '');

		fclose($handle); 		

		if (!file_exists($file)) {
			$this->data['error_image'] = sprintf($this->language->get('error_image'), DIR_IMAGE);
		} else {
			$this->data['error_image'] = '';

			unlink($file);
		}

		// Check image cache directory is writable
		$file = DIR_IMAGE . 'cache/test';

		$handle = fopen($file, 'a+'); 

		fwrite($handle, '');

		fclose($handle); 		

		if (!file_exists($file)) {
			$this->data['error_image_cache'] = sprintf($this->language->get('error_image_cache'), DIR_IMAGE . 'cache/');
		} else {
			$this->data['error_image_cache'] = '';

			unlink($file);
		}

		// Check cache directory is writable
		$file = DIR_CACHE . 'test';

		$handle = fopen($file, 'a+'); 

		fwrite($handle, '');

		fclose($handle); 		

		if (!file_exists($file)) {
			$this->data['error_cache'] = sprintf($this->language->get('error_image_cache'), DIR_CACHE);
		} else {
			$this->data['error_cache'] = '';

			unlink($file);
		}

		// Check download directory is writable
		$file = DIR_DOWNLOAD . 'test';

		$handle = fopen($file, 'a+'); 

		fwrite($handle, '');

		fclose($handle); 		

		if (!file_exists($file)) {
			$this->data['error_download'] = sprintf($this->language->get('error_download'), DIR_DOWNLOAD);
		} else {
			$this->data['error_download'] = '';

			unlink($file);
		}

		// Check logs directory is writable
		$file = DIR_LOGS . 'test';

		$handle = fopen($file, 'a+'); 

		fwrite($handle, '');

		fclose($handle); 		

		if (!file_exists($file)) {
			$this->data['error_logs'] = sprintf($this->language->get('error_logs'), DIR_LOGS);
		} else {
			$this->data['error_logs'] = '';

			unlink($file);
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/macro_dashboard', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['token'] = $this->session->data['token'];

/* Store */
        $this->data['config_store_id'] = 0;
        $this->data['config_store'] = $this->config->get('config_name');

        if (isset($this->request->post['macro_dashboard_store'])) {
			$this->data['macro_dashboard_store'] = $this->request->post['macro_dashboard_store'];
            $macro_dashboard_store_id =  $this->request->post['macro_dashboard_store'];
		} else {
			$this->data['macro_dashboard_store'] = '';
            $macro_dashboard_store_id = '';
		}
        
/* Store - End */        

        $this->load->model('setting/store');

		$this->data['stores'] = $this->model_setting_store->getStores();

		$this->load->model('sale/order');

		$this->data['total_sale'] = $this->currency->format($this->model_sale_order->getTotalSales(), $this->config->get('config_currency'));
		$this->data['total_sale_year'] = $this->currency->format($this->model_sale_order->getTotalSalesByYear(date('Y')), $this->config->get('config_currency'));
//		$this->data['total_order'] = $this->model_sale_order->getTotalOrders();

		$this->load->model('sale/customer');

		$this->data['total_customer'] = $this->model_sale_customer->getTotalCustomers();
		$this->data['total_customer_approval'] = $this->model_sale_customer->getTotalCustomersAwaitingApproval();

		$this->load->model('catalog/review');

		$this->data['total_review'] = $this->model_catalog_review->getTotalReviews();
		$this->data['total_review_approval'] = $this->model_catalog_review->getTotalReviewsAwaitingApproval();

		$this->load->model('sale/affiliate');

		$this->data['total_affiliate'] = $this->model_sale_affiliate->getTotalAffiliates();
		$this->data['total_affiliate_approval'] = $this->model_sale_affiliate->getTotalAffiliatesAwaitingApproval();

		$this->data['orders'] = array(); 

		$data = array(
            'store_id'  => $macro_dashboard_store_id,
			'sort'  => 'o.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 10
		);

		$results = $this->model_catalog_macro_dashboard->getOrdersForMacroDashboard($data);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_view'),
				'href' => $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'], 'SSL')
			);

			$this->data['orders'][] = array(
				'order_id'   => $result['order_id'],
				'customer'   => $result['customer'],
				'status'     => $result['status'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'total'      => $this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),
				'action'     => $action
			);
		}

/* Sales */
        $this->load->model('sale/order');

		$this->data['total_sale'] = $this->currency->format($this->model_catalog_macro_dashboard->getTotalSalesForMacroDashboard($macro_dashboard_store_id), $this->config->get('config_currency'));
        $this->data['total_sale_year'] = $this->currency->format($this->model_catalog_macro_dashboard->getTotalSalesByYearForMacroDashboard(date('Y'), $macro_dashboard_store_id), $this->config->get('config_currency'));
        $this->data['total_sale_month'] = $this->currency->format($this->model_catalog_macro_dashboard->getTotalSalesByMonthForMacroDashboard(date('Y'), date('m'), $macro_dashboard_store_id), $this->config->get('config_currency'));
        $this->data['total_sale_today'] = $this->currency->format($this->model_catalog_macro_dashboard->getTotalSalesByTodayForMacroDashboard(date('Y-m-d'), $macro_dashboard_store_id), $this->config->get('config_currency'));
        
        
/* Statistics */        
		$this->data['total_order'] = $this->model_catalog_macro_dashboard->getTotalOrdersForMacroDashboard($macro_dashboard_store_id);
        $this->data['total_pending_order'] = $this->model_catalog_macro_dashboard->getTotalPendingOrdersForMacroDashboard($macro_dashboard_store_id);
        $this->data['total_customer'] = $this->model_catalog_macro_dashboard->getTotalCustomersForMacroDashboard($macro_dashboard_store_id);
        
        $this->data['total_pending_review'] = $this->model_catalog_macro_dashboard->getTotalReviewsAwaitingApprovalForMacroDashboard($macro_dashboard_store_id);
		$this->data['total_review'] = $this->model_catalog_macro_dashboard->getTotalReviewsForMacroDashboard($macro_dashboard_store_id);

/* Sales Chart */

/* Last 10 orders */

/* Best Sellers */
        
        $this->data['sellers'] = array(); 
        $results = $this->model_catalog_macro_dashboard->getPurchasedForMacroDashboard($macro_dashboard_store_id);

		foreach ($results as $result) {
			$this->data['sellers'][] = array(
				'name'       => $result['name'],
				'quantity'   => $result['quantity']
			);
		}
                
/* Category Inventory */
		$this->data['total_categories'] = $this->model_catalog_macro_dashboard->getTotalCategoriesForMacroDashboard($macro_dashboard_store_id);
        $this->data['active_categories'] = $this->model_catalog_macro_dashboard->getTotalActiveCategoriesForMacroDashboard($macro_dashboard_store_id);
        
/* Product Inventory */
		$this->data['total_products'] = $this->model_catalog_macro_dashboard->getTotalProductsForMacroDashboard($macro_dashboard_store_id);
        $this->data['active_products'] = $this->model_catalog_macro_dashboard->getActiveProductsForMacroDashboard($macro_dashboard_store_id);
        
        $this->data['in_stock'] = $this->model_catalog_macro_dashboard->getTotalInStockProducts($macro_dashboard_store_id);
        $this->data['out_of_stock'] = $this->model_catalog_macro_dashboard->getTotalOutOfStockProducts($macro_dashboard_store_id);
        
        $this->data['downloadable'] = $this->model_catalog_macro_dashboard->getTotalDownloadableForMacroDashboard();



		if ($this->config->get('config_currency_auto')) {
			$this->load->model('localisation/currency');

			$this->model_localisation_currency->updateCurrencies();
		}

		$this->template = 'common/macro_dashboard.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	public function chart() {
		$this->language->load('common/macro_dashboard');

		$data = array();

		$data['order'] = array();
		$data['customer'] = array();
		$data['xaxis'] = array();

		$data['order']['label'] = $this->language->get('text_order');
		$data['customer']['label'] = $this->language->get('text_customer');
        
        if (isset($this->request->get['store_id'])) {
			$store_id = $this->request->get['store_id'];
		} else {
			$store_id = '';
		}

		if (isset($this->request->get['range'])) {
			$range = $this->request->get['range'];
		} else {
			$range = 'month';
		}

		switch ($range) {
			case 'day':
				for ($i = 0; $i < 24; $i++) {
				    $order_sql = '';
                    $order_sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE order_status_id > '" . (int)$this->config->get('config_complete_status_id') . "'";
                    
                    if($store_id!="")
                        $order_sql .= " AND store_id=$store_id";
                    
                    $order_sql .= " AND (DATE(date_added) = DATE(NOW()) AND HOUR(date_added) = '" . (int)$i . "') GROUP BY HOUR(date_added) ORDER BY date_added ASC";
					$query = $this->db->query($order_sql);

					if ($query->num_rows) {
						$data['order']['data'][]  = array($i, (int)$query->row['total']);
					} else {
						$data['order']['data'][]  = array($i, 0);
					}

                    $cus_sql = '';
                    $cus_sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE DATE(date_added) = DATE(NOW()) AND HOUR(date_added) = '" . (int)$i . "'";
                    if($store_id!="")
                        $cus_sql .= " AND store_id=$store_id";
                        
                    $cus_sql .= " GROUP BY HOUR(date_added) ORDER BY date_added ASC";
                    
                    
					$query = $this->db->query($cus_sql);

					if ($query->num_rows) {
						$data['customer']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['customer']['data'][] = array($i, 0);
					}

					$data['xaxis'][] = array($i, date('H', mktime($i, 0, 0, date('n'), date('j'), date('Y'))));
				}					
				break;
			case 'week':
				$date_start = strtotime('-' . date('w') . ' days'); 

				for ($i = 0; $i < 7; $i++) {
					$date = date('Y-m-d', $date_start + ($i * 86400));
                    
                    $order_sql = '';
                    $order_sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE order_status_id > '" . (int)$this->config->get('config_complete_status_id') . "'";
                    
                    if($store_id!="")
                        $order_sql .= " AND store_id=$store_id";
                        
                    $order_sql .= " AND DATE(date_added) = '" . $this->db->escape($date) . "' GROUP BY DATE(date_added)";

					$query = $this->db->query($order_sql);

					if ($query->num_rows) {
						$data['order']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['order']['data'][] = array($i, 0);
					}
                    
                    $cus_sql = '';
                    $cus_sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer` WHERE DATE(date_added) = '" . $this->db->escape($date) . "'";
                    if($store_id!="")
                        $cus_sql .= " AND store_id=$store_id";
                        
                    $cus_sql .= " GROUP BY DATE(date_added)";

					$query = $this->db->query($cus_sql);

					if ($query->num_rows) {
						$data['customer']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['customer']['data'][] = array($i, 0);
					}

					$data['xaxis'][] = array($i, date('D', strtotime($date)));
				}

				break;
			default:
			case 'month':
				for ($i = 1; $i <= date('t'); $i++) {
					$date = date('Y') . '-' . date('m') . '-' . $i;
                    
                    $order_sql = '';
                    $order_sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE order_status_id > '" . (int)$this->config->get('config_complete_status_id') . "' AND (DATE(date_added) = '" . $this->db->escape($date) . "')";
                    if($store_id!="")
                        $order_sql .= " AND store_id=$store_id";
                        
                    $order_sql .= " GROUP BY DAY(date_added)";

					$query = $this->db->query($order_sql);

					if ($query->num_rows) {
						$data['order']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['order']['data'][] = array($i, 0);
					}
                    
                    $cus_sql = '';
                    $cus_sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE DATE(date_added) = '" . $this->db->escape($date) . "'";
                    if($store_id!="")
                        $cus_sql .= " AND store_id=$store_id";
                        
                    $cus_sql .= "GROUP BY DAY(date_added)";	

					$query = $this->db->query($cus_sql);

					if ($query->num_rows) {
						$data['customer']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['customer']['data'][] = array($i, 0);
					}	

					$data['xaxis'][] = array($i, date('j', strtotime($date)));
				}
				break;
			case 'year':
				for ($i = 1; $i <= 12; $i++) {
				    
                    $order_sql = '';
                    $order_sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE order_status_id > '" . (int)$this->config->get('config_complete_status_id') . "' AND YEAR(date_added) = '" . date('Y') . "' AND MONTH(date_added) = '" . $i . "'";
                    if($store_id!="")
                        $order_sql .= " AND store_id=$store_id";
                        
                    $order_sql .= " GROUP BY MONTH(date_added)";

					$query = $this->db->query($order_sql);
                    
					if ($query->num_rows) {
						$data['order']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['order']['data'][] = array($i, 0);
					}
                    
                    $cus_sql = '';
                    $cus_sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE YEAR(date_added) = '" . date('Y') . "' AND MONTH(date_added) = '" . $i . "'";
                    if($store_id!="")
                        $cus_sql .= " AND store_id=$store_id";
                        
                    $cus_sql .= "GROUP BY MONTH(date_added)";	

					$query = $this->db->query($cus_sql);

					if ($query->num_rows) { 
						$data['customer']['data'][] = array($i, (int)$query->row['total']);
					} else {
						$data['customer']['data'][] = array($i, 0);
					}

					$data['xaxis'][] = array($i, date('M', mktime(0, 0, 0, $i, 1, date('Y'))));
				}			
				break;	
		} 

		$this->response->setOutput(json_encode($data));
	}

	public function login() {
		$route = '';

		if (isset($this->request->get['route'])) {
			$part = explode('/', $this->request->get['route']);

			if (isset($part[0])) {
				$route .= $part[0];
			}

			if (isset($part[1])) {
				$route .= '/' . $part[1];
			}
		}

		$ignore = array(
			'common/login',
			'common/forgotten',
			'common/reset'
		);	

		if (!$this->user->isLogged() && !in_array($route, $ignore)) {
			return $this->forward('common/login');
		}

		if (isset($this->request->get['route'])) {
			$ignore = array(
				'common/login',
				'common/logout',
				'common/forgotten',
				'common/reset',
				'error/not_found',
				'error/permission'
			);

			$config_ignore = array();

			if ($this->config->get('config_token_ignore')) {
				$config_ignore = unserialize($this->config->get('config_token_ignore'));
			}

			$ignore = array_merge($ignore, $config_ignore);

			if (!in_array($route, $ignore) && (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token']))) {
				return $this->forward('common/login');
			}
		} else {
			if (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
				return $this->forward('common/login');
			}
		}
	}

	public function permission() {
		if (isset($this->request->get['route'])) {
			$route = '';

			$part = explode('/', $this->request->get['route']);

			if (isset($part[0])) {
				$route .= $part[0];
			}

			if (isset($part[1])) {
				$route .= '/' . $part[1];
			}

			$ignore = array(
				'common/macro_dashboard',
				'common/login',
				'common/logout',
				'common/forgotten',
				'common/reset',
				'error/not_found',
				'error/permission'		
			);			

			if (!in_array($route, $ignore) && !$this->user->hasPermission('access', $route)) {
				return $this->forward('error/permission');
			}
		}
	}	
}
?>