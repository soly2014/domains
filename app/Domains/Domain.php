<?php 

namespace App\Domains; 


class Domain
{
	private $_user_id;
	private $_api_key;
	private $_baseURL;
	
	function __construct($user_id,$api_key,$baseURL)
	{
		$this->_user_id = $user_id;
		$this->_api_key = $api_key;
		$this->_baseURL = $baseURL;
	}


	/**
	 * [addCustomer call the endpoint]
	 * @param  [array]  see this link for required or optional params http://manage.resellerclub.com/kb/answer/804
	 * @return [json] [json response]
	 */
	public function addCustomer($params= ['username'=>'solyooo@yahoo.com','passwd'=>'Addresss123','name'=>'Kevin Morgan','company'=>'Vertex Advertiisng','address-line-1'=>'address-line-1','city'=>'Liverpool','state'=>'NSW','country'=>'AU','zipcode'=>'2170','phone-cc'=>'20','phone'=>'01000433553','lang-pref'=>'en']){

		 return $this->callResellerClubEndpoint('customers/signup', 'POST' , $params);

	}



	/**
	 * [addContact call the endpoint]
	 * @param  [array]  see this link for required or optional params http://manage.resellerclub.com/kb/answer/790
	 * @return [json] [json response]
	 */
	public function addContact($params= ['name'=>'Mohamed Hegazy','company'=>'N/A','address-line-1'=>'address','city'=>'Cairo','country'=>'EG','zipcode'=>'11211','phone-cc'=>'20','phone'=>'1097885718','email'=>'m@mohamedhegazy.com','customer-id'=>'17579075','type'=>'Contact']){

		 return $this->callResellerClubEndpoint('contacts/add', 'POST' , $params);

	}



	/**
	 * [addDomain call the endpoint]
	 * @param  [array]  see this link for required or optional params http://manage.resellerclub.com/kb/answer/752
	 * @return [json] [json response]
	 */
	public function addDomain($params= ['domain-name'=>'learncloud.com','years'=>'1','ns'=>'ns1.domain.com','ns'=>'ns2.domain.com','customer-id'=>'17579075','reg-contact-id'=>'71548132','admin-contact-id'=>'71548132','tech-contact-id'=>'71548132','billing-contact-id'=>'71548132','invoice-option'=>'KeepInvoice']){

		 return $this->callResellerClubEndpoint('domains/register', 'POST' , $params);

	}



	/**
	 * [callResellerClubEndpoint call the endpoint]
	 * @param  [string] $domain 
	 * @param  [array] $tlds   [net,com]
	 * @return [json] [json response]
	 */
	public function searchDomains($domain,$tlds=['com,net']){

		 return $this->callResellerClubEndpoint('domains/available', 'GET' ,  array(
	 		'domain-name'=>$domain,
	 		'tlds'=>$tlds

	 	 	));
	}


	/**
	 * [changeNameServer call the endpoint]
	 * @param  [string] $entityid 
	 * @param  [array] $name_servers [ns1,ns2]
	 * @return [json] [json response]
	 */
	public function changeNameServer($entityid='78446168',$name_servers=[
		                                          'dns5.parkpage.foundationapi.com',
		                                          'dns6.parkpage.foundationapi.com'])
	{

		return $this->callResellerClubEndpoint('domains/modify-ns', 'POST' ,  array(
	 		'order-id' => $entityid,
	 		'ns' => $name_servers
 	      ));

	}

	/**
	 * [createGsuiteAccount call the endpoint]
	 * @param  [string] $entityid 
	 * @param  [array] $name_servers [ns1,ns2]
	 * @return [json] [json response]
	 */
	public function createGsuiteAccount($params)
	{

		return $this->callResellerClubEndpoint('gapps/gbl/add', 'POST' , $params);

	}


	/**
	 * [createGsuiteAdminAccount call the endpoint]
	 * @param  [string] $entityid 
	 * @param  [array] $name_servers [ns1,ns2]
	 * @return [json] [json response]
	 */
	public function createGsuiteAdminAccount($params)
	{

		return $this->callResellerClubEndpoint('gapps/gbl/admin/add', 'POST' , $params);

	}


	/**
	 * 
	 * [callResellerClubEndpoint call the endpoint]
	 * @param  [string] $endpoint [endpoint to request]
	 * @param  [string] $method   [GET,POST]
	 * @param  [string] $payload  [array of parameters]
	 * @return [json] [json response]
	 */
	private function callResellerClubEndpoint($endpoint, $method, $payload) {

		$url = $this->_baseURL. $endpoint . '.json';
		$fields = 'auth-userid='.$this->_user_id.'&api-key='.$this->_api_key;
		
		foreach ($payload as $key=>$value) {
			if (is_array($value)) {
				foreach ($value as $innerkey=>$innerValue) {
					$fields .= '&'  . $key. '=' . $innerValue;
				}
			}else {
				$fields .= '&'  . $key. '=' . $value;
			}
		}

		switch ($method) {
			case 'GET':
				return $this->curlGetRequest($url, $fields);
			case 'POST':
				return $this->curlPostRequest($url, $fields);
			default:
				return 'not allowed method';			
		}
	}


	/**
	 * [curlPostRequest perform post request]
	 * @param  [type] $url    [the endpoint to request]
	 * @param  [type] $fields [the fields in the url]
	 * @return [type]         [json response]
	 */
	private function curlPostRequest($url, $fields) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url );
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_POST,TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);// 

		$httpResponse = curl_exec($ch);

		return $httpResponse;
	}

	/**
	 * [curlGetRequest perform get request]
	 * @param  [type] $url    [the endpoint to request]
	 * @param  [type] $fields [the fields in the url]
	 * @return [type]         [json response]
	 */
	private function curlGetRequest($url, $fields)
	{
		$ch = curl_init($url . '?' . $fields);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
		return  $data;

	}




}



















?>