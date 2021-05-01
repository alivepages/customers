<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class CustomersModel extends Model{

    public $timestamps = false;
    protected $primaryKey = 'dni';

    protected $table = 'customers';

}
