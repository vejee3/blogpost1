@extends('layout')
     
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h2>Add New Post</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="title" class="form-control m-2" placeholder="Title" required>
                    <input type="text" name="author" class="form-control m-2" placeholder="Author" required>
                    <textarea name="body" cols="20" rows="4" class="form-control m-2" placeholder="Body" required></textarea>
                    <label class="m-2">Cover Image</label>
                    <input type="file" class="form-control m-2" name="cover">
 
                    <label class="m-2">Images</label>
                    <input type="file" class="form-control m-2" name="images[]" multiple>
 
                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                </form>
            </div>                  
        </div>
    </div>                        
</div>
@endsection