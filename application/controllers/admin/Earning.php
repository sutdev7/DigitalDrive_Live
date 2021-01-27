<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Earning extends CI_Controller {

	function __construct() {
      	parent::__construct();

		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');		
    }

	public function index()
	{
	 echo 'Earning';exit;	
	}
		
}
