<?php
class ModelFidoNews extends Model {
	public function addNews($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "news SET status = '" . (int)$data['status'] . "', date_added = now()");
		$news_id = $this->db->getLastId();
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "news SET image = '" . $this->db->escape($data['image']) . "' WHERE news_id = '" . (int)$news_id . "'");
		}

		foreach ($data['news_description'] as $language_id => $value) {
			//$this->db->query("INSERT INTO " . DB_PREFIX . "news_description SET news_id = '" . (int)$news_id . "', category_id = '" . (int)$data['category_id'] . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_description SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_id=" . (int)$news_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		if (isset($data['news_store'])) {
			foreach ($data['news_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_store SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		if (isset($data['news_category'])) {
			foreach ($data['news_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_category SET news_id = '" . (int)$news_id . "', category_id = '" . (int)$category_id . "'");
			}
		}
		
		$this->cache->delete('news');
	}
	
	public function addNewsCategory($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "news_category SET status = '" . (int)$data['status'] . "', date_added = now()");
		$category_id = $this->db->getLastId();
		foreach ($data['news_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_category_language SET  language_id = '" . (int)$language_id . "', category_id = '" . (int)$category_id . "', title = '" . $this->db->escape($value['title']) . "',  date_added = now() ");
		}
		
		$this->cache->delete('news');
	}

	public function editNews($news_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "news SET status = '" . (int)$data['status'] . "' WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "news SET image = '" . $this->db->escape($data['image']) . "' WHERE news_id = '" . (int)$news_id . "'");
		}
		foreach ($data['news_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_description SET news_id = '" . (int)$news_id . "',  language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id. "'");
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_id=" . (int)$news_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_store WHERE news_id = '" . (int)$news_id . "'");
		
		if (isset($data['news_store'])) {		
			foreach ($data['news_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_store SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_category WHERE news_id = '" . (int)$news_id . "'");
		if (isset($data['news_category'])) {
			foreach ($data['news_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_category SET news_id = '" . (int)$news_id . "', category_id = '" . (int)$category_id . "'");
			}
		}
		
		$this->cache->delete('news');
	}
	
	public function editNewsCategory($category_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "news_category SET status = '" . (int)$data['status'] . "' WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_category_language WHERE category_id = '" . (int)$category_id . "'");
		
		foreach ($data['news_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_category_language SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "'");
		}
		
		$this->cache->delete('news');
	}

	public function deleteNews($news_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "news WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_store WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_category WHERE news_id = '" . (int)$news_id . "'");
		$this->cache->delete('news');
	}

	public function deleteNewsCategory($category_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_category WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_category_language WHERE category_id = '" . (int)$category_id . "'");
		$this->cache->delete('news');
	}	

	public function getNewsStory($news_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id . "') AS keyword FROM " . DB_PREFIX . "news WHERE news_id = '" . (int)$news_id . "'");
		return $query->row;
	}

	public function getNewsDescriptions($news_id) {
		$news_description_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");
		foreach ($query->rows as $result) {
			$news_description_data[$result['language_id']] = array(
				'title'            => $result['title'],
	//			'category_id'      => $result['category_id'],
				'meta_description' => $result['meta_description'],
				'description'      => $result['description']
			);
		}
		return $news_description_data;
	}

	public function getNewsCategoryDescriptions($news_id) {
		$news_description_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_category WHERE category_id = '" . (int)$news_id . "'");
		
		foreach ($query->rows as $result) {
			$news_description_data[$result['language_id']] = array(
				'title'            => $result['title'],
				'category_id'      => $result['category_id']
			);
		}
		return $news_description_data;
	}

	public function getNewsStores($news_id) {
		$newspage_store_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_to_store WHERE news_id = '" . (int)$news_id . "'");
		foreach ($query->rows as $result) {
			$newspage_store_data[] = $result['store_id'];
		}
		return $newspage_store_data;
	}
	
	public function getCategoryByNews($news_id) {
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_category_language WHERE language_id = '" . (int)$this->config->get('config_language_id'). "' and category_id in (SELECT category_id FROM ".DB_PREFIX."news_to_category WHERE news_id=".$news_id.")");
		return $query->rows;
		
	}
public function getCategoriesByNews($news_id) {
		$cats = array();
		$query = $this->db->query("SELECT category_id FROM ".DB_PREFIX."news_to_category WHERE news_id=".$news_id);
		foreach($query->rows as $cat)
		{
			$cats[] = $cat["category_id"];
		}
		return $cats;
		
	}
	public function getNewsCategory($category_id) {
		$news_category_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_category_language WHERE category_id = '" . (int)$category_id . "'");
		foreach ($query->rows as $result) {
			
			$news_category_data[$result['language_id']][] = array(
				'category_id' => $result['category_id'],
				'title'       => $result['title']
			);
		
		}
		return $news_category_data;
	}
	
	

	public function getNews() {

		//$query = $this->db->query("SELECT n.*, nd.*, IFNULL(ncl.title,'Categoria ainda n�o informada') category FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) LEFT JOIN " . DB_PREFIX . "news_category_language ncl ON (nd.category_id=ncl.category_id AND nd.language_id=ncl.language_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY n.date_added");
		$query = $this->db->query("SELECT n.*, nd.* FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id)  WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY n.date_added");
		return $query->rows;
	}

	public function getNewsAllCategory() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_category n LEFT JOIN " . DB_PREFIX . "news_category_language nd ON (n.category_id = nd.category_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY n.date_added");
		
		foreach ($query->rows as $result) {
			$news_category_data[$result['language_id']][] = array(
				'category_id'      => $result['category_id'],
				'title'      => $result['title']
			);
		}
		return $news_category_data;
	}

	public function getNewsCat() {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_category n LEFT JOIN " . DB_PREFIX . "news_category_language nd ON (n.category_id = nd.category_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY n.date_added");

		return $query->rows;
	}
	


	public function getTotalNews() {
		$this->checkNews();
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news");
		return $query->row['total'];
	}
	
	public function getTotalNewsCategory() {
		$this->checkNews();
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_category");
		return $query->row['total'];
	}	
	
	public function checkNews() {
		$create_news_category = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "news_category` (`category_id` int(11) NOT NULL auto_increment, `status` int(1) NOT NULL default '0', `date_added` datetime default NULL, PRIMARY KEY  (`category_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
		$this->db->query($create_news_category);
		$create_news_category_language = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "news_category_language` (`id` int(11) NOT NULL auto_increment, `language_id` int(11) NOT NULL default '0', `category_id` int(11) NOT NULL default '0', `title` varchar(64) collate utf8_bin NOT NULL default '',  `date_added` datetime default NULL, PRIMARY KEY  (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
		$this->db->query($create_news_category_language);
		$create_news = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "news` (`news_id` int(11) NOT NULL auto_increment,`status` int(1) NOT NULL default '0', `image` varchar(255) collate utf8_bin default NULL, `image_size` int(1) NOT NULL default '0', `date_added` datetime default NULL, PRIMARY KEY  (`news_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
		$this->db->query($create_news);
		$create_news_descriptions = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "news_description` (`news_id` int(11) NOT NULL default '0',`category_id` int(11) NOT NULL default '0', `language_id` int(11) NOT NULL default '0', `title` varchar(64) collate utf8_bin NOT NULL default '', `meta_description` varchar(255) collate utf8_bin NOT NULL, `description` text collate utf8_bin NOT NULL, PRIMARY KEY  (`news_id`,`language_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
		$this->db->query($create_news_descriptions);
		$create_news_to_store = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "news_to_store` (`news_id` int(11) NOT NULL, `store_id` int(11) NOT NULL, PRIMARY KEY  (`news_id`, `store_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
		$this->db->query($create_news_to_store);
	}
}
?>