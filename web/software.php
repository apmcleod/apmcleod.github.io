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
		$software_file = fopen("../software.dat", "r");
		$software_data = fread($software_file,filesize("../software.dat"));
		fclose($software_file);
		
		$software_array = explode("\n", $software_data);
		
		$last_blank = -1;
		for ($i = 0; $i < count($software_array); $i = $i + 1) {
			if (strcmp('', $software_array[$i]) == 0) {
				print_software_item(array_slice($software_array, $last_blank + 1, $i - $last_blank + 1));
				$last_blank = $i;
			}
		}
	}
	
	private function print_software_item($software_item) {
		$software_item_map = [];
		
		foreach ($software_item as $software_item_entry) {
			if(($pos = strpos($software_item_entry, ',')) !== false) {
				$software_item_key = substr($software_item_entry, 0, $pos);
				$software_item_value = substr($str, $pos + 1);
				$software_item_map[$software_item_key] = $software_item_value;
			}
			else
			{
				print 'Unrecognized line in software.txt: ' . $software_item_entry;
			}
		}
		
		print $software_item_map;
		
		print '
				<div class="software" id="VoiceSplitting">
		        	<div class="software-title">Voice Splitting</div>
				
		        	<div class="software-description">
		        	A project written in Java which is able to take polyphonic MIDI files as input and separate the notes
		        	within into strictly monophonic voices. The program can be run either from the command line, or with
		        	a GUI. Read the paper (accepted to be published in the Journal of New Music Research) for more detailed
		        	information, or head over to GitHub to view the code, along with a brief readme for more information on
		        	how to use it. If you do use, please cite appropriately the paper. Please email me with any questions,
		        	comments, suggestions you might have!
		        	</div>
				
		        	<div class="software-links"><a href="VoiceSeparation.pdf">Paper</a> |
		        	<a href="https://github.com/apmcleod/voice-splitting">GitHub</a></div>
		        </div>';
	}
}

$page = new SoftwarePage();
$page->init('software');
$page->print_page();

?>