<?php  
class ControllerModuleSidebarMenu extends Controller {
	protected $category_id = 0;
	protected $path = array();
	
	protected function index() {
		$this->language->load('module/sidebarmenu');
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->load->model('catalog/category');
		//$this->load->model('tool/seo_url');
		
		if (isset($this->request->get['path'])) {
			$this->path = explode('_', $this->request->get['path']);
			
			$this->category_id = end($this->path);
		}
		
		$this->data['category'] = $this->getCategories(0);
						
		
		//important
		$this->id = 'sidebarmenu';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/sidebarmenu.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/sidebarmenu.tpl';
		} else {
			$this->template = 'default/template/module/sidebarmenu.tpl';
		}
		
		$this->render();
  	}

	
	protected function getCategories($parent_id, $current_path = '') {
		static $layer = 0;
		$category_id = array_shift($this->path);
		
		$output = '';
		
		$results = $this->model_catalog_category->getCategories($parent_id);
		
		if ($results) { 
			if ($layer > 0)
			{
				$output .= '<ul>';
			}
			else
			{
				$output .= '<ul id="nav">';
			}
			$layer = $layer + 1;
    	}
		$isfirst = 0;
		foreach ($results as $result) {	
			if (!$current_path) {
				$new_path = $result['category_id'];
			} else {
				$new_path = $current_path . '_' . $result['category_id'];
			}
			
			
			
			$children = '';
			$classname = '';
			
			//if ($category_id == $result['category_id']) {
				$children = $this->getCategories($result['category_id'], $new_path);
			//}
			if ($layer >0)
			{
				if ($isfirst ==0 )
				{
					$classname = 'first';
				}
				$isfirst ++;
				
			}
			/*
			if ($this->category_id == $result['category_id']) {
				$output .= '<li class="onSelectedLi ' . $classname . '"><a title="' . $result['meta_description'] . '" href="' . $this->model_tool_seo_url->rewrite(HTTP_SERVER . 'index.php?route=product/category&amp;path=' . $new_path)  . '">' . $result['name'] . '</a>';
			} else {
				$output .= '<li class="' . $classname . '"><a title="' . $result['meta_description'] . '" href="' . $this->model_tool_seo_url->rewrite(HTTP_SERVER . 'index.php?route=product/category&amp;path=' . $new_path)  . '">' . $result['name'] . '</a>';
			}
			*/
			
		if ($this->category_id == $result['category_id']) {
				$output .= '<li class="onSelectedLi ' . $classname . '"><a title="' . $result['meta_description'] . '" href="' . HTTP_SERVER . 'index.php?route=product/category&amp;path=' . $new_path  . '">' . $result['name'] . '</a>';
			} else {
				$output .= '<li class="' . $classname . '"><a title="' . HTTP_SERVER . 'index.php?route=product/category&amp;path=' . $new_path  . '">' . $result['name'] . '</a>';
			}
			
        	$output .= $children;
        
        	$output .= '</li>'; 
		}

 
		if ($results) {
			
			$output .= '</ul>';
		}
		
		return $output;
	}		
}
?>