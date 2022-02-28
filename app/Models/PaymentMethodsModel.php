<?php
namespace App\Models;

use Crocodic\LaravelModel\Core\Model;

class PaymentMethodsModel extends Model
{
    
	public $id;
	public $icon;
	public $name;
	public $account_number;
	public $account_owner;
	public $created_at;
	public $updated_at;

}