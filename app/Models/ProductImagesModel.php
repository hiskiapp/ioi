<?php
namespace App\Models;

use Crocodic\LaravelModel\Core\Model;

class ProductImagesModel extends Model
{
    
	public $id;
	public $products_id;
	public $src;
	public $created_at;
	public $updated_at;

}