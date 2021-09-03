<?php 
use League\CommonMark\GithubFlavoredMarkdownConverter;


	function markdown($varaible){
		$converter = new GithubFlavoredMarkdownConverter([]);
		echo $converter->convertToHtml($varaible);
	}

?>