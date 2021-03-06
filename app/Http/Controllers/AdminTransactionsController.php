<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\helpers\CB;
use Session;
	use Request;
	use Illuminate\Support\Facades\DB;
	use CRUDBooster;

class AdminTransactionsController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = true;
			$this->table = "transactions";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Created at","name"=>"created_at"];
			$this->col[] = ["label"=>"Code","name"=>"code"];
			$this->col[] = ["label"=>"User","name"=>"users_id","join"=>"users,name"];
			$this->col[] = ["label"=>"Payment Method","name"=>"payment_methods_id","join"=>"payment_methods,name"];
			$this->col[] = ["label"=>"Total Price","name"=>"total_price","callback_php"=>'number_format($row->total_price, 0, ",", ".")'];
			$this->col[] = ["label"=>"Total Item","name"=>"total_item"];
			$this->col[] = ["label"=>"Status","name"=>"status","callback"=>function($row){
				$class_status = class_status($row->status);
				$res = "<div class='dropdown'>
				<button type='button' class='btn btn-{$class_status} btn-xs btn-document dropdown-toggle' data-toggle='dropdown'>
				<span class='fa fa-list'></span> {$row->status} <span class='fa fa-caret-down'></span>
				</button>
				<ul class='dropdown-menu'>
				<li>
				<a href='javascript:void(0)' onclick='swal({
					title: &quot;Set to Unpaid ?&quot;,
					text: &quot;&quot;,
					type: &quot;warning&quot;,
					showCancelButton: true,
					confirmButtonColor: &quot;#3C8DBC&quot;,
					confirmButtonText: &quot;Ya!&quot;,
					cancelButtonText: &quot;Tidak&quot;,
					closeOnConfirm: false },
					function(){  location.href=&quot;" .CRUDBooster::mainPath('unpaid/').$row->id."&quot; });'>Unpaid</a>
					</li>
					<li>
				<a href='javascript:void(0)' onclick='swal({
					title: &quot;Set to Checking ?&quot;,
					text: &quot;&quot;,
					type: &quot;warning&quot;,
					showCancelButton: true,
					confirmButtonColor: &quot;#3C8DBC&quot;,
					confirmButtonText: &quot;Ya!&quot;,
					cancelButtonText: &quot;Tidak&quot;,
					closeOnConfirm: false },
					function(){  location.href=&quot;" .CRUDBooster::mainPath('checking/').$row->id."&quot; });'>Checking</a>
					</li>
				<li>
				<a href='javascript:void(0)' onclick='swal({
					title: &quot;Set to Process ?&quot;,
					text: &quot;&quot;,
					type: &quot;warning&quot;,
					showCancelButton: true,
					confirmButtonColor: &quot;#3C8DBC&quot;,
					confirmButtonText: &quot;Ya!&quot;,
					cancelButtonText: &quot;Tidak&quot;,
					closeOnConfirm: false },
					function(){  location.href=&quot;" .CRUDBooster::mainPath('process/').$row->id."&quot; });'>Process</a>
					</li>
					<li>
					<a href='".CRUDBooster::mainPath('shipping/').$row->id."'>Shipping</a>
					</li>
					<li>
					<a href='javascript:void(0)' onclick='swal({
						title: &quot;Set to Success ?&quot;,
						text: &quot;&quot;,
						type: &quot;warning&quot;,
						showCancelButton: true,
						confirmButtonColor: &quot;#3C8DBC&quot;,
						confirmButtonText: &quot;Ya!&quot;,
						cancelButtonText: &quot;Tidak&quot;,
						closeOnConfirm: false },
						function(){  location.href=&quot;" .CRUDBooster::mainPath('success/').$row->id."&quot; });'>Success</a>
						</li>
						<li>
						<a href='javascript:void(0)' onclick='swal({
							title: &quot;Set to Expired ?&quot;,
							text: &quot;&quot;,
							type: &quot;warning&quot;,
							showCancelButton: true,
							confirmButtonColor: &quot;#3C8DBC&quot;,
							confirmButtonText: &quot;Ya!&quot;,
							cancelButtonText: &quot;Tidak&quot;,
							closeOnConfirm: false },
							function(){  location.href=&quot;" .CRUDBooster::mainPath('expired/').$row->id."&quot; });'>Expired</a>
							</li>
						</ul>
						</div>";
						return $res;
					}];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'User','name'=>'users_id','type'=>'select','width'=>'col-sm-10','datatable'=>'users,name'];
			$this->form[] = ['label'=>'Payment Method','name'=>'payment_methods_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'payment_methods,name'];
			$this->form[] = ['label'=>'Address','name'=>'address_id','type'=>'select','width'=>'col-sm-10','datatable'=>'address,main_address','parent_select'=>'users_id'];
			$this->form[] = ['label'=>'Code','name'=>'code','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Total Price','name'=>'total_price','type'=>'money','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Total Item','name'=>'total_item','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"User Id","name"=>"user_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"user,id"];
			//$this->form[] = ["label"=>"Payment Methods Id","name"=>"payment_methods_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"payment_methods,name"];
			//$this->form[] = ["label"=>"Address Id","name"=>"address_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"address,receive_name"];
			//$this->form[] = ["label"=>"Code","name"=>"code","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Total Price","name"=>"total_price","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Total Item","name"=>"total_item","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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
			$this->sub_module[] = ['label'=>'Items','path'=>'transaction_items','parent_columns'=>'code','foreign_key'=>'transactions_id','button_color'=>'info','button_icon'=>'fa fa-th'];


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
			$this->addaction[] = ['label'=>'Payment','url'=>CRUDBooster::mainpath('payment/[id]').'?return_url='.Request::url(),'icon'=>'fa fa-money','color'=>'danger','showIf'=>"in_array([status], ['Unpaid', 'Checking', 'Process','Shipping','Success'])"];
			$this->addaction[] = ['label'=>'Shipping','url'=>CRUDBooster::mainpath('shipping/[id]').'?return_url='.Request::url(),'icon'=>'fa fa-road','color'=>'warning','showIf'=>"in_array([status], ['Process','Shipping','Success'])"];


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
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :) 
		public function getUnpaid($id) {
			DB::table('transactions')->where('id', $id)->update([
				'status' => 'Unpaid',
				'updated_at' => date('Y-m-d H:i:s'),
			]);

			CB::redirectBack('Set transaction to unpaid successfully!', 'success');
		}

		public function getChecking($id) {
			DB::table('transactions')->where('id', $id)->update([
				'status' => 'Checking',
				'updated_at' => date('Y-m-d H:i:s'),
			]);

			CB::redirectBack('Set transaction to checking successfully!', 'success');
		}

		public function getProcess($id) {
			DB::table('transactions')->where('id', $id)->update([
				'status' => 'Process',
				'updated_at' => date('Y-m-d H:i:s'),
			]);

			CB::redirectBack('Set transaction to process successfully!', 'success');
		}

		public function getPayment($id) {
			$data['row'] = optional(DB::table('payment_confirmations')->where('transactions_id', $id)->first());
			$data['transaction'] = DB::table('transactions')->where('id', $id)->first();

			return $this->view('admin.payment.index', $data);
		}

		public function getShipping($id) {
			$data['row'] = optional(DB::table('shippings')->where('transactions_id', $id)->first());
			$data['transaction'] = DB::table('transactions')->where('id', $id)->first();

			return $this->view('admin.shippings.index', $data);
		}

		public function postShipping($id) {
			$transactions = DB::table('transactions')->where('id', $id)->first();

			DB::table('shippings')->updateOrInsert([
				'transactions_id' => $id,
			], [
				'address_id' => $transactions->address_id,
				'courier' => g('courier'),
				'resi' => g('resi'),
				'address' => g('address'),
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			]);

			DB::table('transactions')->where('id', $id)->update([
				'status' => 'Shipping',
				'updated_at' => date('Y-m-d H:i:s'),
			]);

			CB::redirectBack('Shipping success!', 'success');
		}

		public function getSuccess($id) {
			DB::table('transactions')->where('id', $id)->update([
				'status' => 'Success',
				'updated_at' => date('Y-m-d H:i:s'),
			]);

			CB::redirectBack('Set transaction to success successfully!', 'success');
		}

		public function getExpired($id) {
			DB::table('transactions')->where('id', $id)->update([
				'status' => 'Expired',
				'updated_at' => date('Y-m-d H:i:s'),
			]);

			CB::redirectBack('Set transaction to expired successfully!', 'success');
		}

		public function getApprove($id) {
			DB::table('transactions')->where('id', $id)->update([
				'status' => 'Process',
				'updated_at' => date('Y-m-d H:i:s'),
			]);

			DB::table('payment_confirmations')->where('transactions_id', $id)->update([
				'status' => 'Approved',
				'updated_at' => date('Y-m-d H:i:s'),
			]);

			CB::redirectBack('Set transaction to process successfully!', 'success');
		}

		public function getReject($id) {
			DB::table('transactions')->where('id', $id)->update([
				'status' => 'Unpaid',
				'updated_at' => date('Y-m-d H:i:s'),
			]);

			DB::table('payment_confirmations')->where('transactions_id', $id)->update([
				'status' => 'Rejected',
				'updated_at' => date('Y-m-d H:i:s'),
			]);

			CB::redirectBack('Set transaction to unpaid successfully!', 'success');
		}

	}