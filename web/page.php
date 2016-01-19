<?php 

abstract class Page {
	private $page_name;
	
	public function init($name) {
		$this->page_name = $name;
	}
	
	private function print_before_content() {
		print '
				<!DOCTYPE html>
				<html>
				<head>';
		
		$this->print_css();
					
		print '
					<title>Andrew McLeod</title>
				</head>
				<body>
				
					<div id="main">
						<div id="top">
							<a class="name" href="index.html">Andrew McLeod</a>
						</div>
				    
						<div id="middle">';
		
		$this->print_navigation();
		
		print '<div id="content">';
	}
	
	private function print_css() {
		print '
				<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
				<link rel="stylesheet" type="text/css" href="' . $this->page_name . '.css" media="screen"/>';
	}
	
	private function print_navigation() {
		print '
				<div id="navigation">
					<ul id="nav-list">';
		
		$this->print_nav_link("Home");
		$this->print_nav_link("Publications");
		$this->print_nav_link("Software");
		
		print '
					</ul>
				</div>';
	}
	
	private function print_nav_link($name) {
		$lower_name = strtolower($name);
		$class = 'nav-active';
		
		if (strcmp($lower_name, $this->page_name) !== 0) {
			$class = 'nav-inactive';
			print '<a class="nav-link" href="' . $lower_name . '.php">';
		}
		
		print '<li class="nav ' . $class . '">' . $name . '</li>';
			
		if (strcmp($lower_name, $this->page_name) !== 0) {
			print '</a>';
		}
	}
	
	public abstract function print_content();
	
	private function print_after_content() {
		print '
							</div>
						</div>
				    
						<div id="middle-bottom-border"></div>
				    
						<div id="bottom">
							<a href="pdf/CV.pdf">CV</a>
						</div>
					</div>
				
				</body>
				</html>';
	}
	
	public function print_page() {
		$this->print_before_content();
		$this->print_content();
		$this->print_after_content();
	}
}

?>