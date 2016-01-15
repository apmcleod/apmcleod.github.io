<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", TRUE);

require __DIR__ . '/page.php';

class SoftwarePage extends Page {
	public function print_content() {
		print '<div class="section-header">Software</div>';
        
		$this->print_software();
	}
	
	private function print_software() {
		$software_file = fopen("../data/software.txt", "r") or die("ERROR");
		$software_data = fread($software_file,filesize("../data/software.txt"));
		fclose($software_file);
		
		$software_array = explode("\n", $software_data);
		
		$last_blank = -1;
		$i = 0;
		for ($i = 0; $i < count($software_array); $i = $i + 1) {
			if (strcmp('', $software_array[$i]) == 0) {
				$this->print_software_item(array_slice($software_array, $last_blank + 1, $i - $last_blank + 1));
				$last_blank = $i;
			}
		}
		
		if ($last_blank !== $i - 1) {
			$this->print_software_item(array_slice($software_array, $last_blank + 1, $i - $last_blank + 1));
		}
	}
	
	private function print_software_item($software_item) {
		$software_item_map = array();
		
		foreach ($software_item as $software_item_entry) {
			if (($pos = strpos($software_item_entry, '=')) !== false) {
				$software_item_key = substr($software_item_entry, 0, $pos);
				$software_item_value = substr($software_item_entry, $pos + 1);
				$software_item_map[$software_item_key] = $software_item_value;
				
			} else {
				print 'Unrecognized line in software.txt: ' . $software_item_entry;
			}
		}
		
		print '
				<div class="software" id="' . $this->val_or_empty($software_item_map, 'id') . '">
		        	<div class="software-title">' . $this->val_or_empty($software_item_map, 'title') . '</div>
				
		        	<div class="software-description">
		        	' . $this->val_or_empty($software_item_map, 'description') . '
		        	</div>';
		
		if (array_key_exists("link1_name", $software_item_map)) {
			print '
		        	<div class="software-links">
		        		<a href="' . $this->val_or_empty($software_item_map, 'link1_location') . '">' . $software_item_map['link1_name'] . '</a>';
			
			for ($i = 2; array_key_exists("link{$i}_name", $software_item_map); $i = $i + 1) {
				print ' | <a href="' . $this->val_or_empty($software_item_map, "link{$i}_location") . '">' . $software_item_map["link{$i}_name"] . '</a>';
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

$page = new SoftwarePage();
$page->init('software');
$page->print_page();

?>