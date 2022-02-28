<?php
namespace App\Models;

use Crocodic\LaravelModel\Core\Model;

class BannersModel extends Model
{
    
	public $id;
	public $products_id;
	public $image;
	public $title;
	public $description;
	public $created_at;
	public $updated_at;

}