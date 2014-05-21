<?php  
class ControllerCompanyBusiness extends Controller {
	public function index() {
		static $category_id = 72;
							
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');
		$this->load->model('tool/image');

		$this->data['categories'] = array();
		$category_info = $this->model_catalog_category->getCategory($category_id);
		$this->data["parent_category_name"]=$category_info["name"];
		$categories = $this->model_catalog_category->getCategories($category_id);

		foreach ($categories as $category) {
			$total = $this->model_catalog_product->getTotalProducts(array('filter_category_id'  => $category['category_id']));
			$category_products = $this -> model_catalog_product->getProducts(
				array('filter_category_id'  => $category['category_id'])
			);
			$temp_category_products = array();
			foreach($category_products as $product_info)
			{
				if ($product_info['image']) {
					$image = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
				} else {
					$image = false;
				}
				$product_info['image'] = $image;
				$temp_category_products[] = $product_info;
			}
			//if(count($category_products)>0)
			$this->data['categories'][] = array(
				'category_id' => $category['category_id'],
				'products' => $temp_category_products,
				'description' => html_entity_decode($category['description']),
			);	
		}
		
	if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/company/default.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/company/default.tpl';
		} else {
			$this->template = 'default/template/company/default.tpl';
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