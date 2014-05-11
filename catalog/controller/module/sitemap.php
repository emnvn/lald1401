<?php  
class ControllerModuleSitemap extends Controller {
	private $_name = 'sitemap';	
		public function rewrite($link) {
		if ($this->config->get('config_seo_url')) {
			$url_data = parse_url(str_replace('&amp;', '&', $link));
			
			$url = ''; 
				
			$data = array();
			
			parse_str($url_data['query'], $data);
				
			foreach ($data as $key => $value) {
				if (($key == 'product_id') || ($key == 'manufacturer_id') || ($key == 'information_id')) {
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");				
					if ($query->num_rows) {
						$url .= '/' . $query->row['keyword'];						
					unset($data[$key]);
				}					
			} elseif ($key == 'path') {
				$categories = explode('_', $value);					
					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'category_id=" . (int)$category . "'");
						if ($query->num_rows) {
							$url .= '/' . $query->row['keyword'];
						}							
					}			
					unset($data[$key]);
				}
			}
			
			if ($url) {
				unset($data['route']);
				$query = '';
				if ($data) {
					foreach ($data as $key => $value) {
						$query .= '&' . $key . '=' . $value;
					}
					if ($query) {
						$query = '?' . trim($query, '&');
					}
				}
				return $url_data['scheme'] . '://' . $url_data['host'] . (isset($url_data['port']) ? ':' . $url_data['port'] : '') . str_replace('/index.php', '', $url_data['path']) . $url . $query;
			} else {
				return $link;
			}
		} else {
			return $link;
		}		
	}
	
	protected $category_id = 0;
	protected $path = array();
	
	protected function index() {
	
		
		$this->language->load('module/sitemap');
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->language->load('module/sidebarmenu');
		$pages = array();
		
		//$childs = array();
		//$pages[] = array("link" => "","text" => $this->language->get('text_header'),"childs"=>$childs);
		
		$childs = array();
		
		$this->load->model('design/layout');
		$layout_id = $this->model_design_layout->getLayout("company/overview");
		//echo "Layout id: $layout_id";
		$this->load->model('setting/setting');
		$tab_content = $this->model_setting_setting->getSetting("TabContent");
		if(count($tab_content)>0){
			//var_dump($tab_content);
			$tab_content_module = $tab_content["TabContent_module"];
			if(is_array($tab_content_module)){
			if($tab_content_module[0]["layout_id"]==$layout_id){
				$child_pages = trim($tab_content_module[0]["pages"],",");
				$child_pages = explode(',',$child_pages);
				$this->load->model('catalog/information');
				foreach($child_pages as $information_id){
					$information_info = $this->model_catalog_information->getInformation($information_id);
					$childs[] = array("link" => $this->url->link('company/overview', 'id='.$information_id, 'SSL'),"text" => $information_info["title"]);
				}
			}
			}
			
		}
		
		//$childs[] = array("link" => $this->url->link('company/overview', '', 'SSL'),"text" => "coporations values");
		//$childs[] = array("link" => $this->url->link('company/overview', '', 'SSL'),"text" => "coporations vision");
		
		$pages[] = array("link" => $this->url->link('company/overview', '', 'SSL'),"text" => $this->language->get('text_overview'),"childs"=>$childs);
		
		$pages[] = array("link" => $this->url->link('company/business', '', 'SSL'),"text" => $this->language->get('text_business'));
		$pages[] = array("link" => $this->url->link('company/production', '', 'SSL'),"text" => $this->language->get('text_production'));
		$pages[] = array("link" => $this->url->link('company/distribution', '', 'SSL'),"text" => $this->language->get('text_distribution'));
		$pages[] = array("link" => $this->url->link('company/factory', '', 'SSL'),"text" => $this->language->get('text_factory'));
		$pages[] = array("link" => $this->url->link('information/contact', '', 'SSL'),"text" => $this->language->get('text_contact'));
		$this->language->load('common/header');
		
		$pages[] = array("link" => $this->url->link('company/about', '', 'SSL'),"text" => strtolower($this->language->get('text_about_us')));
		$pages[] = array("link" => $this->url->link('company/career', '', 'SSL'),"text" => strtolower($this->language->get('text_career')));
		$this->language->load('common/footer');
		
		$childs = array();
		$childs[] = array("link" => $this->url->link('company/policy', '', 'SSL'),"text" => $this->language->get('text_privacy_policy'));
		$childs[] = array("link" => $this->url->link('company/disclaimer', '', 'SSL'),"text" => $this->language->get('text_disclaimer'));
		//$childs[] = array("link" => "#","text" => $this->language->get('text_webmail'));
		
		
		$pages[] = array("link" => "","text" => strtolower($this->language->get('text_other')),"childs"=>$childs);
		//$pages[] = array("link" => "","text" => $this->language->get('text_main'),"childs"=>$childs);
		
		//$childs = array();
		//$pages[] = array("link" => "","text" => $this->language->get('text_footer'),"childs"=>$childs);
		
		
		
		$this->data['page_root'] = array("link" => $this->url->link('common/home', '', 'SSL'),"text" => $this->language->get('text_root'));
		$this->data['pages'] = $pages;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/sitemap.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/sitemap.tpl';
		} else {
			$this->template = 'default/template/module/sitemap.tpl';
		}
		
		$this->render();
  	}
	
	protected function getCategories($parent_id, $current_path = '') {
            
			$output = '';
            
            $results = $this->model_catalog_tree_category->getCategories($parent_id);
		
			foreach ($results as $result) {    
			
				 if (!$current_path) {
                    $new_path = $result['category_id'];
                } else {
                    $new_path = $current_path . '_' . $result['category_id'];
                }
				
				
				if( $this->config->get('tree_category_counter')>0) $totalProducts = " (".$this->model_catalog_tree_category->getTotalproductsByCategoryId($result['category_id']).")";
				else $totalProducts = '';
				
				$url = $this->rewrite(HTTP_SERVER . "index.php?route=product/category&path=" . $new_path);
				
				if ($parent_id > 0) {
				
					$output .= "d.add(".$result["category_id"].",".$result["parent_id"].",'".$result["name"].$totalProducts."','".$url."');\n";
				
				} else {
			
					$output .= "d.add(".$result['category_id'].",".$result["parent_id"].",'".$result["name"].$totalProducts."','".$url."');\n";
				
				}
				
				$output .= $this->getCategories($result['category_id'], $new_path);
			}

            return $output;
        } 		
}
?>