<?php

ini_set("error_reporting", E_ALL);
ini_set("display_errors", TRUE);

require __DIR__ . '/page.php';

class HomePage extends Page {
	public function print_content() {
		print '
				<div class="section-header">About Me</div>
        
		        <table>
		        	<tr>
		        		<th class="contact-header">Email:</th>
		        		<td>A.McLeod-5@sms.ed.ac.uk</td>
		        	</tr>
		        	<tr></tr>
		        	<tr>
		        		<th class="contact-header">Address:</th>
		        		<td>Office 4.23 <br>
		        			Informatics Forum <br>
		        			10 Crichton Street <br>
		        			Edinburgh, EH8 9AB <br>
		        			Scotland, United Kingdom
		        		</td>
		        	</tr>
		        </table>
		        
		        
		        <p>
		        I am currently a PhD student at the <a href="http://www.ed.ac.uk/home">University of Edinburgh</a>
		        <a href="http://www.ed.ac.uk/informatics">School of Informatics</a>, specifically in the
		        <a href="http://www.ilcc.inf.ed.ac.uk/">Institute for Language, Cognition and Computation (ILCC)</a>.
		        </p>
		        
		        <p>
		        I am working on automatic music trascription, specifically trying to create a language model
		        for the transcription of symbolic music data. My primary supervisor is <a href="http://homepages.inf.ed.ac.uk/steedman/">
		        Mark Steedman</a>.
		        </p>
		        
		        <p>
		        Use the navigation buttons on the left to find out more about my work, or click <a href="pdf/CV.pdf">here</a>
		        (or on the link at the bottom of each page) to see my CV.
		        </p>';
	}
}

$page = new HomePage();
$page->init('home');
$page->print_page();

?>