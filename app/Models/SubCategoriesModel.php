<?php
namespace App\Models;

use Crocodic\LaravelModel\Core\Model;

class SubCategoriesModel extends Model
{
    
	public $id;
	public $categories_id;
	public $name;
	public $image;
	public $created_at;
	public $updated_at;

}