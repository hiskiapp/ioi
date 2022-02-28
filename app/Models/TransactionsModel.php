<?php
namespace App\Models;

use Crocodic\LaravelModel\Core\Model;

class TransactionsModel extends Model
{
    
	public $id;
	public $users_id;
	public $payment_methods_id;
	public $address_id;
	public $code;
	public $total_price;
	public $total_item;
	public $status;
	public $created_at;
	public $updated_at;

}