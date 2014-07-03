<?php  
class ControllerCompanyBusiness extends Controller {
	public function index() {
		static $category_id = 72;
							
	//	$this->load->model('catalog/category');
$this->language->load('product/product');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');

		//$this->data['categories'] = array();
		//$category_info = $this->model_catalog_category->getCategory($category_id);
		$this->data["parent_category_name"]=$this->language->get('business_heading_title');
		$this->language->load('module/sidebarmenu');
		$items[] = array("link" => $this->url->link('company/production', '', 'SSL'),"text" => $this->language->get('text_production'));
		
		$items[] = array("link" => $this->url->link('company/distribution', '', 'SSL'),"text" => $this->language->get('text_distribution'));
		$this->data["menu_items"]= $items;
	
		
	if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/company/business_line.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/company/business_line.tpl';
		} else {
			$this->template = 'default/template/company/business_line.tpl';
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);
										
		$this->response->setOutput($this->render());
	}
}
?>