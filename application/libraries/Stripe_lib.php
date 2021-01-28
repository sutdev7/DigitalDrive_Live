<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Stripe Library for CodeIgniter 3.x
 *
 * Library for Stripe payment gateway. It helps to integrate Stripe payment gateway
 * in CodeIgniter application.
 *
 * This library requires the Stripe PHP bindings and it should be placed in the third_party folder.
 * It also requires Stripe API configuration file and it should be placed in the config directory.
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      
 * @license     
 * @link        
 * @version     3.0
 */

class Stripe_lib{
    var $CI;
	var $api_error;
    
    function __construct(){
		$this->api_error = '';
        $this->CI =& get_instance();
        $this->CI->load->config('stripe');
		
		// Include the Stripe PHP bindings library
		require APPPATH .'third_party/stripe-php/init.php';
		
		// Set API key
		\Stripe\Stripe::setApiKey($this->CI->config->item('stripe_api_key'));
    }

    function addCustomer($email, $token){
		try {
			// Add customer to stripe
			$customer = \Stripe\Customer::create(array(
				'email' => $email,
				'source'  => $token
			));
			return $customer;
		}catch(Exception $e) {
			$this->api_error = $e->getMessage();
			return false;
		}
    }
	
	function createCharge($customerId, $itemName, $itemPrice){
		// Convert price to cents
		$itemPriceCents = ($itemPrice*100);
		$currency = $this->CI->config->item('stripe_currency');
		// echo'charge_lib1'. $currency;
		try {
			// Charge a credit or a debit card
			$charge = \Stripe\Charge::create(array(
				'customer' => $customerId,
				'amount'   => $itemPriceCents,
				'currency' => $currency,
				'description' => $itemName
			));
			// echo'charge_lib2';print_r($charge);exit;
			// Retrieve charge details
			$chargeJson = $charge->jsonSerialize();
			return $chargeJson;
		}catch(Exception $e) {
			$this->api_error = $e->getMessage();
			// echo'api_error';print_r($this->api_error);
			return false;
		}
	}
	
	function refund(){
		$pi = \Stripe\PaymentIntent::create([
			'amount' => 100,
			'currency' => 'inr',
			'payment_method_types' => ['card'],
		  ]);
		//   echo'<pre>';print_r($pi);exit;

		$re = \Stripe\Refund::create([
			'amount' => 1,
			'payment_intent' => $pi['id']//'txn_1IAGIdJ75Fg0QL2lgPQxI75N',
		  ]);
		  
		  echo'<pre>';print_r($re);exit;
	}
}