<?php
class IndexAction extends CommonAction
{
	public function index(){
		vendor('Weather');
		echo Weather::getWeather($_GET['city']);
		exit('<html><body><script src="http://code.jquery.com/jquery-1.9.1.min.js"></script><h1>Not Allowed to Access Directly.</h1></body></html>');
	}

}
?>