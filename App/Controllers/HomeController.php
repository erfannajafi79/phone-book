<?php
namespace App\Controllers;

use App\Models\Contact;

class HomeController{
    private $contactModel;

    public function __construct(){
        $this->contactModel = new Contact();
    }

    
    public function index()
    {
        // $faker = \Faker\Factory::create();
        // echo $faker->name();
        // echo $faker->email();
        // echo $faker->phoneNumber();

        // for ($i=0 ; $i<1000 ; $i++ ){
        //     $this->contactModel->create([
        //         'name' => $faker->name(),
        //         'mobile' => $faker->phoneNumber(),
        //         'email' => $faker->email()
        //         ]);
        // }
        global $request;
        $where = ['ORDER' => ["id" => "DESC"]];
        $search_keyword = $request->input('s');
        if(!is_null($search_keyword)){
            $where['OR'] = [
                    'name[~]' => $search_keyword,
                    'mobile[~]' => $search_keyword,
                    'email[~]' => $search_keyword
            ];
        }

        $contacts = $this->contactModel->get('*', $where);
        $data = [
            'contacts' => $contacts ,
            'num_contacts' => $this->contactModel->count(),
            'pageSize' => $this->contactModel->getPageSize(),
            'search_keyword' => $search_keyword
        ];
        view('home.index' , $data);
    }
}