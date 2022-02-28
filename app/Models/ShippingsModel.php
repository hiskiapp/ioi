<?php
namespace App\Models;

use Crocodic\LaravelModel\Core\Model;

class ShippingsModel extends Model
{
    
	public $id;
	public $transactions_id;
	public $address_id;
	public $courier;
	public $resi;
	public $address;
	public $created_at;
	public $updated_at;

}