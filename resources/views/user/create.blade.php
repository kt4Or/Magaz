<form action="{{route('register.store')}}" method="POST">
   @csrf
   <div class="unput-group mb-3">
      <input type="text" class="form-control" placeholder="Name" name="name" value="{{old('name')}}">
      <div class="input-group-append">
         <div class="input-group-text">
            <span class="fas fa-user"></span>
         </div>
      </div>
   </div>
   <div class="unput-group mb-3">
      <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
      <div class="input-group-append">
         <div class="input-group-text">
            <span class="fas fa-envelope"></span>
         </div>
      </div>
   </div>
   <div class="unput-group mb-3">
      <input type="password" class="form-control" placeholder="Password" name="password" value="{{old('password')}}">
      <div class="input-group-append">
         <div class="input-group-text">
            <span class="fas fa-lock"></span>
         </div>
      </div>
   </div>
   <div class="unput-group mb-3">
      <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
      <div class="input-group-append">
         <div class="input-group-text">
            <span class="fas fa-lock"></span>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-4">
         <button type="submit" class="btn btn-primary btn-lock">Register</button>
      </div>
   </div>
</form>
@if (session()->has('success'))
<div class="alert alert-success">
   {{session('success')}}
</div>
@endif