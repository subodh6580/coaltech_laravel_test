<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{$page_title}}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<div class="container">
@if(!empty($productDetails))
<div class="row">
<div class="col-sm-6">
<h2>Update Product</h2>
</div>
<div class="col-sm-4">
<a href="{{url('/')}}" class="btn btn-primary">Add New Product</a>
</div>
</div>



  <form class="form-horizontal" action="{{url('/update')}}" method="POST">
@csrf
<input type="hidden" name="product_id" value="{{$productDetails->id}}">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Product Name:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Enter product name" name="product_name" value="{{$productDetails->product_name}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Quantity in stock:</label>
      <div class="col-sm-6">          
        <input type="number" class="form-control" placeholder="Enter quantity" name="quantity_in_stock" value="{{$productDetails->quantity_in_stock}}">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Price per item:</label>
      <div class="col-sm-6">          
        <input type="number" class="form-control"  placeholder="Enter price" name="price_per_item" value="{{$productDetails->price_per_item}}">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-6">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
@else 
<h2>Add New Product</h2>
<form class="form-horizontal" action="{{url('/product_submit')}}" method="POST">
@csrf
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Product Name:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="Enter product name" name="product_name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Quantity in stock:</label>
      <div class="col-sm-6">          
        <input type="number" class="form-control" placeholder="Enter quantity" name="quantity_in_stock">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Price per item:</label>
      <div class="col-sm-6">          
        <input type="number" class="form-control"  placeholder="Enter price" name="price_per_item" >
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-6">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
@endif
  <h2>Product Listing</h2>
  <table class="table table-bordered" id="table_id">
    <thead>
      <tr>
      <th>Sr.</th>
        <th>Product name</th>
        <th>Quantity in stock</th>
        <th>Price per item</th>
        <th>Created(Datetime)</th>
        <th>Total value number</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="tbody">
      
      
    </tbody>
  </table>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
            $.ajax({
                url: "{{url('/list')}}",
                method: "get",
                success: function(response) { 
                    //response = $.parseJSON(data);
                    $.each(response.Data, function(i, item) {
                        var $tr = $('<tr>').append(
                            $('<td>').text(++i),
                            $('<td>').text(item.product_name),
                            $('<td>').text(item.quantity_in_stock),
                            $('<td>').text(item.price_per_item),
                            $('<td>').text(item.created_at),
                            $('<td>').text(parseInt(item.quantity_in_stock)*parseInt(item.price_per_item)),
                            $('<td>').html('<a href="{{url("update_product/")}}/'+item.id+'" class="btn btn-primary">Edit</a>')
                        ).appendTo('#table_id');
                       //$tr.wrap('<p>').html();
                        //console.log($tr.wrap('<p>').html());
                    });
                },
                error:function(err){
                 
                        
                }
            });

            
                
</script>

</body>
</html>
