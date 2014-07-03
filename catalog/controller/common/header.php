<?php   
class ControllerCommonHeader extends Controller {
	protected function index() {
		$this->data['title'] = $this->document->getTitle();
		if($this->data['title']=="")$this->data['title'] = "Lautan Luas";
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->data['base'] = $this->config->get('config_ssl');
		} else {
			$this->data['base'] = $this->config->get('config_url');
		}
		
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();	 
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
		$this->data['lang'] = $this->language->get('code');
		$this->data['direction'] = $this->language->get('direction');
		$this->data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');
	
			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];	
			} else {
				$ip = ''; 
			}
			
			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];	
			} else {
				$url = '';
			}
			
			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];	
			} else {
				$referer = '';
			}
						
			$this->model_tool_online->whosonline($ip, $this->customer->getId(), $url, $referer);
		}
				
		$this->language->load('common/header');
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = HTTPS_IMAGE;
		} else {
			$server = HTTP_IMAGE;
		}	
				
		if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->data['icon'] = $server . $this->config->get('config_icon');
		} else {
			$this->data['icon'] = '';
		}
		
		$this->data['name'] = $this->config->get('config_name');
				
		if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
			$this->data['logo'] = $server . $this->config->get('config_logo');
		} else {
			$this->data['logo'] = '';
		}
		
		
		/* Start Lautan web */
		$this->data['text_home'] = $this->language->get('text_home');
		$this->data['text_about_us'] = $this->language->get('text_about_us');
		$this->data['text_about_us'] = $this->language->get('text_about_us');
		$this->data['text_our_product'] = $this->language->get('text_our_product');
		$this->data['text_faq'] = $this->language->get('text_faq');
		$this->data['text_career'] = $this->language->get('text_career');
		$this->data['text_sitemap'] = $this->language->get('text_sitemap');
		
		$this->data['link_about'] = $this->url->link('company/about');
		$this->data['link_product'] = $this->url->link('company/production');
		$this->data['link_career'] = $this->url->link('company/career');
		$this->data['link_sitemap'] = $this->url->link('company/sitemap');
		/* End Lautan web */
		
		$this->data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$this->data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
    	$this->data['text_search'] = $this->language->get('text_search');
		$this->data['text_welcome'] = sprintf($this->language->get('text_welcome'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
		$this->data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));
		$this->data['text_account'] = $this->language->get('text_account');
    	$this->data['text_checkout'] = $this->language->get('text_checkout');
    	$this->data['text_template'] = $this->language->get('text_template');
    	$this->data['text_guide'] = $this->language->get('text_guide');
				
		$this->data['home'] = $this->url->link('common/home');
		$this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$this->data['logged'] = $this->customer->isLogged();
		$this->data['account'] = $this->url->link('account/account', '', 'SSL');
		$this->data['shopping_cart'] = $this->url->link('checkout/cart');
		$this->data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		$this->data['telephone'] = $this->config->get('config_telephone');
		
		if (isset($this->request->get['filter_name'])) {
			$this->data['filter_name'] = $this->request->get['filter_name'];
		} else {
			$this->data['filter_name'] = '';
		}
		
		// Menu
		$this->load->model('catalog/category');
		
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		$this->data['categories'] = array();
					
		$categories = $this->model_catalog_category->getCategories(0);
		$this->data['menu_home'] = array(
					'name'     => $this->language->get('text_home'),
					'href'     => $this->url->link('common/home')
		);
		$this->data['menu_news'] = array(
					'name'     => $this->language->get('text_news'),
					'href'     => $this->url->link('information/news')
		);
		$this->data['menu_contact'] = array(
					'name'     => $this->language->get('text_contact'),
					'href'     => $this->url->link('information/contact')
		);
		/*foreach ($categories as $category) {
			
			if ($category['top']) {
				$children_data = array();
				
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				
				foreach ($children as $child) {
					//var_dump($child);
					$data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);
					
					$product_total = $this->model_catalog_product->getTotalProducts($data);
					if ($child['image']) {
						$image = $this->model_tool_image->resize($child['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
					} else {
						$image = '';
					}				
					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
						'image' =>$image,
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])	
					);						
				}
				$this->load->model("fido/news");
				$temp_news=$this->model_fido_news->getNewsCategory($category["news_category_id"]);
				$related_news = array();
				foreach($temp_news as $news)
				{
					$related_news[] = array(
						"title"=>$news["title"],
						"href"=>$this->url->link("information/news", 'news_id=' . $news['news_id'])
					);
				}
				// Level 1
				$this->data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'related_news'=>$related_news,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}*/
		
	if(isset($this->data['categories'])){
					$this->data['categories'][] = array(
						'name'     => $this->language->get("text_blogs"),
						'children' => array(),
						'column'   => 1,
						'href'     => $this->url->link('pavblog/blogs', '')
					);
				}

		
		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
		} else {
			$route = 'common/home';
		}
		
		$menu_active = "home";
		if($route == "company/about") $menu_active = "about";
		else if($route == "company/production") $menu_active = "product";
		else if($route == "company/career") $menu_active = "career";
		else if($route == "company/sitemap") $menu_active = "sitemap";
		
		$this->data['menu_active'] = $menu_active;
	//echo $menu_active;
		$this->children = array(
			'module/language',
			'module/currency',
			'module/cart'
		);	
		$page_type="home_page";
		if(isset($this->request->get['route']) && $this->request->get['route']!="common/home")
		$page_type = "other_page";
		$this->data['page_type'] = $page_type;
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/header.tpl';
		} else {
			$this->template = 'default/template/common/header.tpl';
		}
	
		
    	$this->render();
	} 	
}
?>