<?php
namespace App\Models;

use Crocodic\LaravelModel\Core\Model;

class UsersModel extends Model
{
    
	public $id;
	public $avatar;
	public $name;
	public $email;
	public $email_verified_at;
	public $password;
	public $gender;
	public $phone;
	public $remember_token;
	public $created_at;
	public $updated_at;

}