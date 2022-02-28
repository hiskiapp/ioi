<?php
namespace App\Models;

use Crocodic\LaravelModel\Core\Model;

class CartsModel extends Model
{
    
	public $id;
	public $users_id;
	public $products_id;
	public $total_order;
	public $created_at;
	public $updated_at;

}