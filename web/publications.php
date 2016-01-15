<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", TRUE);

require __DIR__ . '/page.php';

class PublicationsPage extends Page {
	public function print_content() {
		print '<div class="section-header">Publications</div>';
        
		$this->print_publications();
	}
	
	private function print_publications() {
		$publications_file = fopen("../data/publications.txt", "r");
		$publications_data = fread($publications_file,filesize("../data/publications.txt"));
		fclose($publications_file);
		
		$publications_array = explode("\n", $publications_data);
		
		$last_blank = -1;
		$i = 0;
		for ($i = 0; $i < count($publications_array); $i = $i + 1) {
			if (strcmp('', $publications_array[$i]) == 0) {
				$this->print_publications_item(array_slice($publications_array, $last_blank + 1, $i - $last_blank - 1));
				$last_blank = $i;
			}
		}
		
		if ($last_blank !== $i - 1) {
			$this->print_publications_item(array_slice($publications_array, $last_blank + 1, $i - $last_blank - 1));
		}
	}
	
	private function print_publications_item($publications_item) {
		$publications_item_map = array();
		
		foreach ($publications_item as $publications_item_entry) {
			if (($pos = strpos($publications_item_entry, '=')) !== false) {
				$publications_item_key = substr($publications_item_entry, 0, $pos);
				$publications_item_value = substr($publications_item_entry, $pos + 1);
				$publications_item_map[$publications_item_key] = $publications_item_value;
				
			}
		}
		
		$authors = $this->val_or_empty($publications_item_map, 'authors');
		$authors = str_replace("Andrew McLeod", '<span class="publication-me">Andrew McLeod</span>', $authors);
		
		print '
				<div class="publication" id="' . $this->val_or_empty($publications_item_map, 'id') . '">
		        	<div class="publication-title">' . $this->val_or_empty($publications_item_map, 'title') . '</div>
				   	<div class="publication-name">' . $authors;
				   	
		if (array_key_exists('year', $publications_item_map)) {
			print ' (' . $publications_item_map['year'] . ')';
		}
		
		print '</div>
				<div class="publication-location">' . $this->val_or_empty($publications_item_map, 'location') . '</div>';
		
		if (array_key_exists("link1_name", $publications_item_map)) {
			print '
		        	<div class="publication-links">
		        		<a href="' . $this->val_or_empty($publications_item_map, 'link1_location') . '">' . $publications_item_map['link1_name'] . '</a>';
			
			for ($i = 2; array_key_exists("link{$i}_name", $publications_item_map); $i = $i + 1) {
				print ' | <a href="' . $this->val_or_empty($publications_item_map, "link{$i}_location") . '">' . $publications_item_map["link{$i}_name"] . '</a>';
			}
			
		    print '</div>';
		}
		
		print '</div>';
	}
	
	private function val_or_empty($array, $key) {
		if (array_key_exists($key, $array)) {
			return $array[$key];
		}
		
		return '';
	}
}

$page = new PublicationsPage();
$page->init('publications');
$page->print_page();

?>