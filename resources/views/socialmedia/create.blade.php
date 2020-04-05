
@extends('layouts.app')
@section('content')
<div class="container">
  <form method="post" enctype="multipart/form-data" action="{{action('socialmediaController@store')}}">
    {{csrf_field()}}
     @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
	<div class="form-group row">
		<label for="service" class="col-sm-2 col-form-label col-form-label-lg">Service<span class="text-danger">*</span></label>
		<div class="col-sm-10">
			<select id="service">
			  <option value="youtube">Youtube</option>
			  <option value="facebook">Facebook</option>
			  <option value="linkedin">LinkedIn</option>
			  <option value="pinterest">Pinterest</option>
			  <option value="instagram">Instagram</option>
			  <option value="snapchat">Snapchat</option>
			  <option value="twitter">Twitter</option>
			</select>      
		</div>
	
      <label for="heading" class="col-sm-2 col-form-label col-form-label-lg">Heading<span class="text-danger">*</span></label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="heading" required="required" placeholder="Heading" name="heading" value="{{ old('heading') }}">
      </div>
    </div>
    <div class="form-group row">
      <label for="web_link" class="col-sm-2 col-form-label col-form-label-lg">Web Link<span class="text-danger">*</span></label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="web_link" required="required" placeholder="Web Link" name="web_link" value="{{ old('web_link') }}">
      </div>
    </div>
    <div class="form-group row">
      <label for="video_link" class="col-sm-2 col-form-label col-form-label-lg">Video Link<span class="text-danger">*</span></label>
      <div class="col-sm-10">
        <input type="file" name="videofile" class="form-control">
      </div>
    </div>
    <div class="form-group row">
      <label for="image_link" class="col-sm-2 col-form-label col-form-label-lg">Image Link<span class="text-danger">*</span></label>
      <div class="col-sm-10">
		<input type="file" name="imagefile" class="form-control">
	  
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-2"></div>
      <button type="submit" id = "btnsubmit" name="btnsubmit" class="btn btn-primary">Post</button>
    </div>
  </form>
</div>
@endsection