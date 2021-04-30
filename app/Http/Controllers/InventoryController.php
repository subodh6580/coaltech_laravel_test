<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;
use Illuminate\Support\Facades\Hash;
use File;

class InventoryController extends Controller
{
	function __construct()
	{
		if(!file_exists(public_path('/upload/json/datafile.json'))){
			file_put_contents(public_path('/upload/json/datafile.json'), []);
            $command = 'chmod g=u'. public_path('/upload/json/datafile.json');
            exec($command);

		}
	}

    public function index($id='')
	{
        if(!empty($id))
        {
		$jsonString = file_get_contents(public_path('upload/json/datafile.json'));
		$data1 = json_decode($jsonString);
		foreach($data1 as $data)
        {
            if($data->id == $id)
            {
                
                return $data;
            }
        }
		
        } else {
            $jsonString = file_get_contents(public_path('upload/json/datafile.json'));
            $data1 = json_decode($jsonString);
            
            return response(['Data' => $data1, 'message' => 'All User Accounts'], 200);
        }
	}
	
	
	public function productSubmit(Request $request)
	{
		     
		$data = $request->all();
		
        $validator = Validator::make($data, [
            'product_name' => 'required',
            'quantity_in_stock' => 'required',
            'price_per_item' => 'required'
        ]);
		
		if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
	
		$data1=[];
		$id=1;
		 if(file_exists(public_path('/upload/json/datafile.json'))){
			$jsonString = file_get_contents(public_path('upload/json/datafile.json'));
			$data1 = json_decode($jsonString, true);
			$datac=collect($data1);
			if(!empty($datac->last())){
				$id=$datac->last()['id']+1;
			}
		}
		
		$data = $request->only('product_name','quantity_in_stock','price_per_item');
		$data['id']=$id;
		$data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
		$data1[]=$data;
		$newJsonString = json_encode($data1, JSON_PRETTY_PRINT);

		file_put_contents(public_path('/upload/json/datafile.json'), stripslashes($newJsonString));
		
	 return back()->with('success','Product Created successfully');

		
	}
	
	public function update(Request $request)
	{
		
		$data = $request->all();
		
        $validator = Validator::make($data, [
            'product_id'=>'required',
            'product_name' => 'required',
            'quantity_in_stock' => 'required',
            'price_per_item' => 'required'
        ]);
		
		if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
		$id = $request->product_id;
		
		$data1=[];
		if(file_exists(public_path('/upload/json/datafile.json'))){
			$jsonString = file_get_contents(public_path('upload/json/datafile.json'));
			$data1 = json_decode($jsonString, true);
			$result=array_search($id, array_column($data1, 'id'));
			
			
				if(!empty($request->product_name)){
					$data1[$result]['product_name']=$request->product_name;
					$newJsonString = json_encode($data1, JSON_PRETTY_PRINT);
					file_put_contents(public_path('/upload/json/datafile.json'), stripslashes($newJsonString));
				}
				if(!empty($request->quantity_in_stock)){
					$data1[$result]['quantity_in_stock']=$request->quantity_in_stock;
				}
				if(!empty($request->price_per_item)){
					$data1[$result]['price_per_item']=$request->price_per_item;
				}
				   
					$data1[$result]['updated_at']=date('Y-m-d H:i:s');
				
				$newJsonString = json_encode($data1, JSON_PRETTY_PRINT);
				file_put_contents(public_path('/upload/json/datafile.json'), stripslashes($newJsonString));
				
				return back()->with('success','Updated Successfully');
			
			
		}
		
	}

    public function ProductListView($id='')
    {
        $data['page_title'] = 'Product Listing';
        if(!empty($id))
        {
           $data['productDetails'] = $this->index($id);
        }
        return view('product_listing',$data);
    }


}    