<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Laravel Store Data To Json Format</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <style>
   .error{ color:red; } 
  </style>
</head>
 
<body>
 
<div class="container">
    <h2 style="margin-top: 10px;">Laravel Store Data To Json Format In Text File</h2>
    <br>
    <br>
 
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
    </div>
    <br>
    @endif
   
    <form id="laravel_json" method="post" action="{{asset('/register')}}">
      @csrf
      <div class="form-group">
        <label for="formGroupExampleInput">UserName</label>
        <input type="text" name="username" class="form-control" id="formGroupExampleInput" placeholder="Please enter username">
      </div>
      <div class="form-group">
        <label for="email">Email Id</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Please enter email id">
      </div>
	  <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Please enter first name">
      </div>
	  <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Please enter last name">
      </div>      
      <div class="form-group">
        <label for="password">Password</label>
        <input type="text" name="password" class="form-control" id="password" placeholder="Please enter password">
      </div>
      <div class="form-group">
       <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </form>
 
</div>
 
</body>
</html>