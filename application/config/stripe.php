<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Stripe API Configuration
| -------------------------------------------------------------------
|
| You will get the API keys from Developers panel of the Stripe account
| Login to Stripe account (https://dashboard.stripe.com/)
| and navigate to the Developers � API keys page
| Remember to switch to your live publishable and secret key in production!
|
|  stripe_api_key        	string   Your Stripe API Secret key.
|  stripe_publishable_key	string   Your Stripe API Publishable key.
|  stripe_currency   		string   Currency code.
*/
// test credential
$config['stripe_api_key']         = 'sk_test_51I1z0nJ75Fg0QL2lYFPUtnx8LwJQHarHjgQXRIwgOt2pJGVjuOPsebMLnZpnz6TlsZKmgfko6kBLAw5xWU5eadX000BN9L9eKP'; 
$config['stripe_publishable_key'] = 'pk_test_51I1z0nJ75Fg0QL2lUupaCm4M3VR8y5K6xQsoOfMVzlkDjRVe7ghiAVrWslp1XJPcBjMwlsNlU6xbDS4UkpITkQml00yFc3mdEb';

// credential for dgital drive
// $config['stripe_api_key']         = 'sk_test_51HMDwOL1EsUnlcKdXbVXn9eeuwUotMGrZvnJL5abRlAY1QWXlwXmZoUvbxnVzgXPNWlbv2WvZRjFuJ5clNloaeXx00IP2lisrS'; 
// $config['stripe_publishable_key'] = 'pk_test_51HMDwOL1EsUnlcKdCrTpYScLCxFxIvDD51jGbiEDRoHN0rBvQ5fUExmF7EHecskZK8EvUTiYhil6tPw7PmIqmNqW00GoOZ7kfN';

$config['stripe_currency']        = 'INR';