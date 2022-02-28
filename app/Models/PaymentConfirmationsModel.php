<?php
namespace App\Models;

use Crocodic\LaravelModel\Core\Model;

class PaymentConfirmationsModel extends Model
{
    
	public $id;
	public $transactions_id;
	public $proof;
	public $sender_name;
	public $sender_number;
	public $status;
	public $created_at;
	public $updated_at;

}