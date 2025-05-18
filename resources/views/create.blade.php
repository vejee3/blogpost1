@extends('layout')
     
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow rounded-4 mt-4">
            <div class="card-header text-white">
                <h2 class="mb-0">Add New Post</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="title" class="form-control mb-3" placeholder="Title" required>
                    <input type="text" name="author" class="form-control mb-3" placeholder="Author" required>
                    <textarea name="body" rows="5" class="form-control mb-3" placeholder="Body" required></textarea>
                    
                    <label class="form-label fw-semibold">Cover Image</label>
                    <input type="file" class="form-control mb-3" name="cover" accept="image/*">

                    <label class="form-label fw-semibold">Additional Images</label>
                    <input type="file" class="form-control mb-4" name="images[]" multiple accept="image/*">

                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </form>
            </div>                  
        </div>
    </div>                        
</div>
@endsection
