<?php
namespace App\Controllers;

use App\Models\Contact;
use App\Utilities\Validation;

class ContactController{
    private $contactModel;

    public function __construct(){
        $this->contactModel = new Contact();
    }

    public function add(){
        global $request;
        $data['alreadyExists'] = false;
        $count = $this->contactModel->count(['mobile' =>$request->input('mobile')]);
        if($count) {
            $data['alreadyExists'] = true;
            $data['message'] = "Contact with phone number {$request->input('mobile')} already exists.";
            view_die('contact.add-result',$data);
        }

        if(!Validation::is_valid_email($request->input('email'))){
            $data['success'] = false;
            $data['message'] = "Invalid email address";
            view_die('contact.add-result',$data);
        }

        $contact_id = $this->contactModel->create([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
        ]);
        $data['contact_id'] = $contact_id ;
        $data['success'] = true;
        $data['message'] = "Contact with id $contact_id created successfully.";
        view('contact.add-result',$data); 

    }

    public function delete(){
        global $request;
        $id = $request->get_route_param('id');
        $data['deleted_count'] = $this->contactModel->delete(['id' => $id]);

        view('contact.delete-result', $data);

    }
}