<?php
namespace App\Models;

use Crocodic\LaravelModel\Core\Model;

class AddressModel extends Model
{
    
	public $id;
	public $users_id;
	public $main_address;
	public $receive_name;
	public $phone;
	public $province;
	public $city;
	public $district;
	public $detail;
	public $note;
	public $created_at;
	public $updated_at;

}