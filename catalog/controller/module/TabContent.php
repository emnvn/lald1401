<?php
class ControllerModuleTabContent extends Controller {
	
	private $name = 'TabContent';
	
protected function index($setting) {
		$this->language->load('module/'.$this->name);
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
		$informations = explode(',', $setting["pages"]);
			
		$this->load->model('catalog/information'); 
		$this->data["pages"] = array();
		if(isset($this->request->get["id"])){
			$active_id = $this->request->get["id"];
			//$this->data["active_id"] = $active_id;
		}
		$active_index = 1;
		$is_traced = false; 
		foreach($informations as $information_id){
			
			if($information_id == "")continue;
		//	echo "information id: $information_id ";
			if($information_id == $active_id){
				$is_traced = true;
			}
			if(!$is_traced){
				$active_index++;
			}
			
			$information_info = $this->model_catalog_information->getInformation($information_id);
			
			$page = array();
			$page["information_id"] = $information_info["information_id"];
			$page["title"] = $information_info["title"];
			$page["description"] = html_entity_decode($information_info["description"]);
			$this->data["pages"][] = $page;
		}
		if(!$is_traced) $active_index = 1;
		$this->data["active_index"] = $active_index;
		//echo $active_index;
		$this->data["test"] = "Test";
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/TabContent.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/TabContent.tpl';
		} else {
			$this->template = 'default/template/module/TabContent.tpl';
		}
		
		$this->render();
	}
	
}
?>