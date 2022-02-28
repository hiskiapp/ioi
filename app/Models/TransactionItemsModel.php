<?php
namespace App\Models;

use Crocodic\LaravelModel\Core\Model;

class TransactionItemsModel extends Model
{
    
	public $id;
	public $transactions_id;
	public $products_id;
	public $quantity;
	public $price_item;
	public $created_at;
	public $updated_at;

}