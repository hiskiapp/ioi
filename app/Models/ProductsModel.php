<?php
namespace App\Models;

use Crocodic\LaravelModel\Core\Model;

class ProductsModel extends Model
{
    
	public $id;
	public $images;
	public $name;
	public $location;
	public $size;
	public $description;
	public $stock;
	public $price;
	public $seen_total;
	public $categories_id;
	public $sub_categories_id;
	public $permalink;
	public $created_at;
	public $updated_at;

}