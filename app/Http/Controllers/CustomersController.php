<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\CustomersModel;
use App\CommunesModel;
use App\RegionsModel;

class CustomersController extends BaseController{

    /**
     * Get a customer by dni or email.
     *
     * @param  string|null  $dni
     * @param  string|null  $email
     * @return Customer
     */
    public function show($dni, $email){
     
        if ($dni) {
            $data = CustomersModel::where('dni',$dni)->where('status','A')->first();
        } elseif($email) {
            $data = CustomersModel::where('email',$email)->where('status','A')->first();   
        } 
        if(!$data) {
            return response('Customer not found');
        }

        if($data) {
            return response ($data);
        } else {
            return response('Customer not found');
        }
        
    }

    /*
    * Save a new customer
    *
    * @param  string  $name
    * @param  string  $email
    * @param  string|null  $dni
    * @param  string|null  $email
    * @param  int|null  $id_reg
    * @param  int|null  $id_com
    * @param  string|null  $last_name
    * @param  string|null   $address
    * @return Msg
    */
    public function store(Request $request){
        
        $data = new CustomersModel;

        if (!CommunesModel::where('id_com', $request->input('id_com'))->exists()){
            return response("Commune don't exists");
        }

        if (!RegionsModel::where('id_reg', $request->input('id_reg'))->exists()){
            return response("Region don't exists");
        }

        if($request->input('email')){
            $data->email = $request->input('email');
        } else {
            return response("Email can't be blank");
        }

        if (CustomersModel::where('email', $request->input('email'))->exists()){
            return response("email exists");
        }

        if($request->input('name')){
            $data->name = $request->input('name');
        } else {
            return response("Name can't be blank");
        }

        if (CustomersModel::where('dni', $request->input('dni'))->exists()){
            return response("dni exists");
        }


        if($request->input('dni')){
            $data->dni = $request->input('dni');
        } else {
            return response("dni can't be blank");
        }

        if($request->input('last_name')){
            $data->last_name = $request->input('last_name');
        } else {
            return response("last name can't be blank");
        }
        
        $data->id_reg = $request->input('id_reg');
        $data->id_com = $request->input('id_com');
        $data->address = $request->input('address');
        $data->date_reg = \Carbon\Carbon::now();
        $data->status = 'A';

        $data->save();

        return response('Successful insert');
    }

    /*
    * Logic delete a customer
    *
    * @param  string|null  $dni
    * @param  string|null  $email
    * @return Customer
    */
    public function destroy($dni, $email){

        if ($dni) {
            $data = CustomersModel::where('dni',$dni)->where('status','A')->first();
        } elseif($email) {
            $data = CustomersModel::where('email',$email)->where('status','A')->first();   
        } 
        if(!$data) {
            return response('Customer not found');
        }
        $data->status='trash';
        $data->save();

        return response('Successful delete');
    }
}