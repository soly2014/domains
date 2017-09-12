<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	      $params= [
                         'username'=>'shitCusxldsjjsttsjkoromer@yahoo.com',
                         'email'=>'soly@yahoo.com',
                         'passwd'=>'Addresss123',
                         'name'=>'Kevin Morgan',
                         'company'=>'Vertex Advertiisng',
                         'address_line_1'=>'address-line-1',
                         'city'=>'Liverpool',
                         'state'=>'NSW',
                         'country'=>'AU',
                         'zipcode'=>'2170',
                         'phone_cc'=>'20',
                         'phone'=>'01000433553',
                         'lang_pref'=>'en' 
                       ];  
          \App\Customer::create($params);
    

      // $params_two= [ 
      //                    'domain-name'=>'learncloud.com',
      //                    'years'=>'1',
      //                    'ns_one'=>'ns1.domain.com',
      //                    'ns_two'=>'ns2.domain.com',
      //                    'customer'=>'17602107',
      //                    'customer_id'=>1,
      //                    'reg_contact_id'=>'71666469',
      //                    'admin_contact_id'=>'71666469',
      //                    'tech_contact_id'=>'71666469',
      //                    'billing_contact_id'=>'71666469',
      //                    'invoice_option'=>'KeepInvoice'
      //                  ];

      //     \App\Domain::create($params_two);


    }
}
