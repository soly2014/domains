<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/add-customer', function () {

	$user_id = env('RESELLER_CLUB_USER_ID');
	$api_key = env('RESELLER_CLUB_API_KEY');
	$url = env('RESELLER_CLUB_BASEURL');
      $class = new \App\Domains\Domain($user_id,$api_key,$url);
      $customer = \App\Customer::find(1);
      $params= ['username'=>$customer->username ,
                        'passwd'=>$customer->passwd,
                        'name'=>$customer->name,
                        'company'=>$customer->company,
                        'address-line-1'=>$customer->address_line_1,
                        'city'=>$customer->city,
                        'state'=>$customer->state,
                        'country'=>$customer->country,
                        'zipcode'=>$customer->zipcode,
                        'phone-cc'=>$customer->phone_cc,
                        'phone'=>$customer->phone,
                        'lang-pref'=>$customer->lang_pref ];

      $customer =  json_decode($class->addCustomer($params));
       if (is_integer($customer)) {
      	$user_id =1;
      	if (!\App\Customer::where('id',$user_id)->first()) {
                  $cus =  new \App\Customer();      		
	       	$cus->customer_id = $customer;
	       	$cus->save();
     		
      	} else {
                  $cus =  \App\Customer::where('id',$user_id)->first();  		
	       	$cus->customer_id = $customer;
	       	$cus->save();
      	}
      	
       	return 'added successfully '.$customer;
       } else {
       	return $customer->message;
       }
       	
});


Route::get('/add-contact', function () {

	$user_id = env('RESELLER_CLUB_USER_ID');
	$api_key = env('RESELLER_CLUB_API_KEY');
	$url = env('RESELLER_CLUB_BASEURL');
      $class = new \App\Domains\Domain($user_id,$api_key,$url);
      $customer = \App\Customer::find(1);
      $params= [
                        'name'=>$customer->name,
                        'company'=>$customer->company,
                        'address-line-1'=>$customer->address_line_1,
                        'city'=>$customer->city,
                        'state'=>$customer->state,
                        'country'=>$customer->country,
                        'zipcode'=>$customer->zipcode,
                        'phone-cc'=>$customer->phone_cc,
                        'phone'=>$customer->phone,
                        'email'=>$customer->email,
                        'customer-id'=>$customer->customer_id,
                        'type'=>'Contact'
                        ];

      $contact_id = json_decode($class->addContact($params));
      if (is_integer($contact_id)) {
      	$user_id =1;
	     	$cus =  \App\Customer::where('id',$user_id)->first();
	     	$cus->contact_id = $contact_id;
	     	$cus->save();
	     	return 'added successfully '.$contact_id;
     } else {
     		return $contact_id->message;
     }

});


Route::get('/add-domain', function () {

	$user_id = env('RESELLER_CLUB_USER_ID');
	$api_key = env('RESELLER_CLUB_API_KEY');
	$url = env('RESELLER_CLUB_BASEURL');
      $class = new \App\Domains\Domain($user_id,$api_key,$url);
      $customer = \App\Customer::find(1);
      $params= [ 
                         'domain-name'=>'joopoklkojkiokoplkn.com',
                         'years'=>'1',
                         'ns'=>[ 
                            'dns3.parkpage.foundationapi.com',
                            'dns4.parkpage.foundationapi.com'
                         ],
                         'customer-id'=>$customer->customer_id,
                         'reg-contact-id'=>$customer->contact_id,
                         'admin-contact-id'=>$customer->contact_id,
                         'tech-contact-id'=>$customer->contact_id,
                         'billing-contact-id'=>$customer->contact_id,
                         'invoice-option'=>'KeepInvoice'
                       ];


      //{"actiontypedesc":"Registration of solycloud.com for 1 year","unutilisedsellingamount":"-14.990","sellingamount":"-14.990","entityid":"78434262","actionstatus":"Success","status":"Success","eaqid":"453300259","customerid":"17603982","description":"solycloud.com","actiontype":"AddNewDomain","invoiceid":"76144417","sellingcurrencysymbol":"USD","actionstatusdesc":"Domain registration completed Successfully"}                 
      $domain = json_decode($class->addDomain($params));
      if ($domain->status == 'Success') {
            $d = new \App\Domain();
            $d->actiontypedesc  = $domain->actiontypedesc;
            $d->unutilisedsellingamount  = $domain->unutilisedsellingamount;
            $d->sellingamount  = $domain->sellingamount;
            $d->entityid  = $domain->entityid;
            $d->actionstatus  = $domain->actionstatus;
            $d->status  = $domain->status;
            $d->eaqid  = $domain->eaqid;
            $d->customerid  = $domain->customerid;
            $d->customer_id  = 1;
            $d->description  = $domain->description;
            $d->actiontype  = $domain->actiontype;
            $d->invoiceid  = $domain->invoiceid;
            $d->sellingcurrencysymbol  = $domain->sellingcurrencysymbol;
            $d->save();            
              return "success";//'actiontypedesc','unutilisedsellingamount','sellingamount','entityid','actionstatus','status','eaqid','customerid','description','actiontype','invoiceid','sellingcurrencysymbol','actionstatusdesc'

      } else {

              return $domain->error;
      }
      
	
});


Route::get('/search-domains', function () {

	$user_id = env('RESELLER_CLUB_USER_ID');
	$api_key = env('RESELLER_CLUB_API_KEY');
	$url = env('RESELLER_CLUB_BASEURL');
      $class = new \App\Domains\Domain($user_id,$api_key,$url);
      $domain = 'solycloud';
      $tlds =['com','net','org','me','io','co'];
      $domains = json_decode($class->searchDomains($domain,$tlds));
      $result ='';
      foreach ($domains as $key => $value) {
      	$result .= 'the domain is '.$key.' and status is '.$value->status.'<br>';
      }
      return $result;
});



Route::get('/change-name-servers', function () {

  $user_id = env('RESELLER_CLUB_USER_ID');
  $api_key = env('RESELLER_CLUB_API_KEY');
  $url = env('RESELLER_CLUB_BASEURL');
      $class = new \App\Domains\Domain($user_id,$api_key,$url);
      $entityid='78446168';// the entity id for the domain you wanna chage their name server
      $name_servers=['dns5.parkpage.foundationapi.com','dns6.parkpage.foundationapi.com'];
      echo $class->changeNameServer($entityid,$name_servers);

});





Route::get('/create-gsuite', function () {

  $user_id = env('RESELLER_CLUB_USER_ID');
  $api_key = env('RESELLER_CLUB_API_KEY');
  $url = env('RESELLER_CLUB_BASEURL');
  $class = new \App\Domains\Domain($user_id,$api_key,$url);
  $customer = \App\Customer::find(1);
  $domain = \App\Domain::find(2);

  $params = [
                      'domain-name'=>$domain->description,
                      'customer-id'=>$customer->customer_id,
                      'months'=>'1',
                      'no-of-accounts'=>'1',
                      'invoice-option'=>'PayInvoice'
                     ];

  echo $class->createGsuiteAccount($params);

});




Route::get('/addGsuiteAdmin', function () {

  $user_id = env('RESELLER_CLUB_USER_ID');
  $api_key = env('RESELLER_CLUB_API_KEY');
  $url = env('RESELLER_CLUB_BASEURL');
  $class = new \App\Domains\Domain($user_id,$api_key,$url);
  $customer = \App\Customer::find(1);
  $domain = \App\Domain::find(2);

  $params = [
                        'order-id'=>'0',
                        'email-address'=>'abc@domain.com',
                        'password'=>'password',
                        'first-name'=>'abc',
                        'last-name'=>'abc',
                        'name'=>'abc',
                        'alternate-email-address'=>'xyz@domain.com',
                        'company'=>'test',
                        'zip'=>'0',                   
                    ];

  echo $class->createGsuiteAdminAccount($params);

});



