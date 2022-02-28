<?php

namespace App\Http\Controllers;

use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Session;
use Request;
use DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class AdminProductsController extends \crocodicstudio\crudbooster\controllers\CBController
{

	public function cbInit()
	{

		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->title_field = "name";
		$this->limit = "20";
		$this->orderby = "id,desc";
		$this->global_privilege = false;
		$this->button_table_action = true;
		$this->button_bulk_action = true;
		$this->button_action_style = "button_dropdown";
		$this->button_add = true;
		$this->button_edit = true;
		$this->button_delete = true;
		$this->button_detail = true;
		$this->button_show = true;
		$this->button_filter = true;
		$this->button_import = true;
		$this->button_export = true;
		$this->table = "products";
		# END CONFIGURATION DO NOT REMOVE THIS LINE

		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = [];
		$this->col[] = ["label" => "Name", "name" => "name"];
		$this->col[] = ["label" => "Location", "name" => "location"];
		$this->col[] = ["label" => "Size", "name" => "size"];
		$this->col[] = ["label" => "Stock", "name" => "stock"];
		$this->col[] = ["label" => "Price", "name" => "price", "callback_php" => 'number_format($row->price, 0, ",", ".")'];
		$this->col[] = ["label" => "Category", "name" => "categories_id", "join" => "categories,name"];
		$this->col[] = ["label" => "Sub Category", "name" => "sub_categories_id", "join" => "sub_categories,name"];
		$this->col[] = ["label" => "Seen Total", "name" => "seen_total"];
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = [];
		$this->form[] = ['label' => 'Name', 'name' => 'name', 'type' => 'text', 'validation' => 'required|string|min:3|max:70', 'width' => 'col-sm-10', 'placeholder' => 'You can only enter the letter only'];
		$this->form[] = ['label' => 'Images', 'name' => 'images', 'type' => 'hidden', 'validation' => 'required', 'width' => 'col-sm-9'];
		$this->form[] = ['label' => 'Permalink', 'name' => 'permalink', 'type' => 'text', 'validation' => 'required|min:3|unique:products,permalink', 'width' => 'col-sm-10'];
		$this->form[] = ['label' => 'Description', 'name' => 'description', 'type' => 'wysiwyg', 'validation' => 'required|string|min:5|max:5000', 'width' => 'col-sm-10'];
		$this->form[] = ['label' => 'Category', 'name' => 'categories_id', 'type' => 'select', 'width' => 'col-sm-10', 'datatable' => 'categories,name', 'validation' => 'required|integer|min:0'];
		$this->form[] = ['label' => 'Sub Category', 'name' => 'sub_categories_id', 'type' => 'select', 'width' => 'col-sm-10', 'datatable' => 'sub_categories,name', 'parent_select' => 'categories_id', 'validation' => 'required|integer|min:0'];
		$this->form[] = ['label' => 'Location', 'name' => 'location', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
		$this->form[] = ['label' => 'Price', 'name' => 'price', 'type' => 'money', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
		$this->form[] = ['label' => 'Size', 'name' => 'size', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
		$this->form[] = ['label' => 'Stock', 'name' => 'stock', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
		# END FORM DO NOT REMOVE THIS LINE

		# OLD START FORM
		//$this->form = [];
		//$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];
		//$this->form[] = ['label'=>'Images','name'=>'images','type'=>'upload','validation'=>'required|image','width'=>'col-sm-9'];
		//$this->form[] = ['label'=>'Permalink','name'=>'permalink','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Description','name'=>'description','type'=>'wysiwyg','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Category','name'=>'categories_id','type'=>'select','width'=>'col-sm-10','datatable'=>'categories,name'];
		//$this->form[] = ['label'=>'Sub Category','name'=>'sub_categories_id','type'=>'select','width'=>'col-sm-10','datatable'=>'sub_categories,name','parent_select'=>'categories_id'];
		//$this->form[] = ['label'=>'Location','name'=>'location','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Price','name'=>'price','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Size','name'=>'size','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Stock','name'=>'stock','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
		# OLD END FORM

		/* 
		| ---------------------------------------------------------------------- 
		| Sub Module
		| ----------------------------------------------------------------------     
		| @label          = Label of action 
		| @path           = Path of sub module
		| @foreign_key 	  = foreign key of sub table/module
		| @button_color   = Bootstrap Class (primary,success,warning,danger)
		| @button_icon    = Font Awesome Class  
		| @parent_columns = Sparate with comma, e.g : name,created_at
		| 
		*/
		$this->sub_module = array();


		/* 
		| ---------------------------------------------------------------------- 
		| Add More Action Button / Menu
		| ----------------------------------------------------------------------     
		| @label       = Label of action 
		| @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
		| @icon        = Font awesome class icon. e.g : fa fa-bars
		| @color 	   = Default is primary. (primary, warning, succecss, info)     
		| @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
		| 
		*/
		$this->addaction = array();


		/* 
		| ---------------------------------------------------------------------- 
		| Add More Button Selected
		| ----------------------------------------------------------------------     
		| @label       = Label of action 
		| @icon 	   = Icon from fontawesome
		| @name 	   = Name of button 
		| Then about the action, you should code at actionButtonSelected method 
		| 
		*/
		$this->button_selected = array();


		/* 
		| ---------------------------------------------------------------------- 
		| Add alert message to this module at overheader
		| ----------------------------------------------------------------------     
		| @message = Text of message 
		| @type    = warning,success,danger,info        
		| 
		*/
		$this->alert        = array();



		/* 
		| ---------------------------------------------------------------------- 
		| Add more button to header button 
		| ----------------------------------------------------------------------     
		| @label = Name of button 
		| @url   = URL Target
		| @icon  = Icon from Awesome.
		| 
		*/
		$this->index_button = array();



		/* 
		| ---------------------------------------------------------------------- 
		| Customize Table Row Color
		| ----------------------------------------------------------------------     
		| @condition = If condition. You may use field alias. E.g : [id] == 1
		| @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
		| 
		*/
		$this->table_row_color = array();


		/*
		| ---------------------------------------------------------------------- 
		| You may use this bellow array to add statistic at dashboard 
		| ---------------------------------------------------------------------- 
		| @label, @count, @icon, @color 
		|
		*/
		$this->index_statistic = array();



		/*
		| ---------------------------------------------------------------------- 
		| Add javascript at body 
		| ---------------------------------------------------------------------- 
		| javascript code in the variable 
		| $this->script_js = "function() { ... }";
		|
		*/
		$this->script_js = NULL;


		/*
		| ---------------------------------------------------------------------- 
		| Include HTML Code before index table 
		| ---------------------------------------------------------------------- 
		| html code to display it before index table
		| $this->pre_index_html = "<p>test</p>";
		|
		*/
		$this->pre_index_html = null;



		/*
		| ---------------------------------------------------------------------- 
		| Include HTML Code after index table 
		| ---------------------------------------------------------------------- 
		| html code to display it after index table
		| $this->post_index_html = "<p>test</p>";
		|
		*/
		$this->post_index_html = null;



		/*
		| ---------------------------------------------------------------------- 
		| Include Javascript File 
		| ---------------------------------------------------------------------- 
		| URL of your javascript each array 
		| $this->load_js[] = asset("myfile.js");
		|
		*/
		$this->load_js = array();



		/*
		| ---------------------------------------------------------------------- 
		| Add css style at body 
		| ---------------------------------------------------------------------- 
		| css code in the variable 
		| $this->style_css = ".style{....}";
		|
		*/
		$this->style_css = NULL;



		/*
		| ---------------------------------------------------------------------- 
		| Include css File 
		| ---------------------------------------------------------------------- 
		| URL of your css each array 
		| $this->load_css[] = asset("myfile.css");
		|
		*/
		$this->load_css = array();
	}


	/*
	| ---------------------------------------------------------------------- 
	| Hook for button selected
	| ---------------------------------------------------------------------- 
	| @id_selected = the id selected
	| @button_name = the name of button
	|
	*/
	public function actionButtonSelected($id_selected, $button_name)
	{
		//Your code here

	}


	/*
	| ---------------------------------------------------------------------- 
	| Hook for manipulate query of index result 
	| ---------------------------------------------------------------------- 
	| @query = current sql query 
	|
	*/
	public function hook_query_index(&$query)
	{
		//Your code here

	}

	/*
	| ---------------------------------------------------------------------- 
	| Hook for manipulate row of index table html 
	| ---------------------------------------------------------------------- 
	|
	*/
	public function hook_row_index($column_index, &$column_value)
	{
		//Your code here
	}

	/*
	| ---------------------------------------------------------------------- 
	| Hook for manipulate data input before add data is execute
	| ---------------------------------------------------------------------- 
	| @arr
	|
	*/
	public function hook_before_add(&$postdata)
	{
		if (!is_array(g('images'))) {
			$resp = redirect()->back()->with(['message' => 'Image required!', 'message_type' => 'warning'])->withInput();
			Session::driver()->save();
			$resp->send();
			exit;
		}

		$postdata['permalink'] = str_slug($postdata['permalink']);
	}

	/* 
	| ---------------------------------------------------------------------- 
	| Hook for execute command after add public static function called 
	| ---------------------------------------------------------------------- 
	| @id = last insert id
	| 
	*/
	public function hook_after_add($id)
	{
		$images = g('images');

		if (is_array($images)) {
			$images = collect($images)->map(function ($image) {
				return str_replace(url('/') . '/', '', $image);
			})->toArray();
			$data = [];
			foreach ($images as $image) {
				$data[] = [
					'products_id' => $id,
					'src' => $image
				];
			}

			DB::table('product_images')->insert($data);
		}
	}

	/* 
	| ---------------------------------------------------------------------- 
	| Hook for manipulate data input before update data is execute
	| ---------------------------------------------------------------------- 
	| @postdata = input post data 
	| @id       = current id 
	| 
	*/
	public function hook_before_edit(&$postdata, $id)
	{
		if (!is_array(g('images'))) {
			$resp = redirect()->back()->with(['message' => 'Image required!', 'message_type' => 'warning'])->withInput();
			Session::driver()->save();
			$resp->send();
			exit;
		}

		$postdata['permalink'] = str_slug($postdata['permalink']);
	}

	/* 
	| ---------------------------------------------------------------------- 
	| Hook for execute command after edit public static function called
	| ----------------------------------------------------------------------     
	| @id       = current id 
	| 
	*/
	public function hook_after_edit($id)
	{
		DB::table('product_images')->where('products_id', $id)->delete();

		$images = g('images');

		if (is_array($images)) {
			$images = collect($images)->map(function ($image) {
				return str_replace(url('/') . '/', '', $image);
			})->toArray();
			$data = [];
			foreach ($images as $image) {
				$data[] = [
					'products_id' => $id,
					'src' => $image
				];
			}

			DB::table('product_images')->insert($data);
		}
	}

	/* 
	| ---------------------------------------------------------------------- 
	| Hook for execute command before delete public static function called
	| ----------------------------------------------------------------------     
	| @id       = current id 
	| 
	*/
	public function hook_before_delete($id)
	{
		//Your code here

	}

	/* 
	| ---------------------------------------------------------------------- 
	| Hook for execute command after delete public static function called
	| ----------------------------------------------------------------------     
	| @id       = current id 
	| 
	*/
	public function hook_after_delete($id)
	{
		//Your code here

	}



	//By the way, you can still create your own method in here... :) 
	public function getAdd()
	{
		//Create an Auth
		if (!CRUDBooster::isCreate() && $this->global_privilege == FALSE || $this->button_add == FALSE) {
			CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
		}

		$data = [];
		$data['page_title'] = 'Add Data';
		$data['categories'] = DB::table('categories')->get();

		//Please use view method instead view method from laravel
		return $this->view('admin.products.form', $data);
	}

	public function getEdit($id)
	{
		//Create an Auth
		if (!CRUDBooster::isUpdate() && $this->global_privilege == FALSE || $this->button_edit == FALSE) {
			CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
		}

		$data = [];
		$data['page_title'] = 'Edit Data';
		$data['categories'] = DB::table('categories')->get();

		$row = DB::table('products')->where('id', $id)->first();
		$row->product_images = DB::table('product_images')->where('products_id', $row->id)->pluck('src')->toArray();
		$data['row'] = $row;

		//Please use view method instead view method from laravel
		return $this->view('admin.products.form', $data);
	}

	public function postDropzone()
	{
		return response()->json(['name' => CRUDBooster::uploadFile('file', true)]);
	}
}
