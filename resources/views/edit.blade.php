@extends('layout')
     
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h2>Edit Post</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <input type="text" name="title" class="form-control m-2" placeholder="Title" value="{{ $post->title }}" required>
                    <input type="text" name="author" class="form-control m-2" placeholder="Author" value="{{ $post->author }}" required>
                    <textarea name="body" cols="20" rows="4" class="form-control m-2" placeholder="Body" required>{{ $post->body }}</textarea>
                     
                    <label class="m-2">Cover Image</label>
                    <input type="file" class="form-control m-2" name="cover">
 
                    <label class="m-2">Additional Images</label>
                    <input type="file" class="form-control m-2" name="images[]" multiple>
 
                    <button type="submit" class="btn btn-success mt-3">Update Post</button>
                </form>
                 
                <label class="m-2">Current Cover Image</label>
                <form action="{{ route('cover.delete', $post->id) }}" method="post" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn text-danger" type="submit">Delete Cover Image</button>
                </form>
                <img src="/cover/{{ $post->cover }}" class="img-responsive" style="max-height: 100px; max-width: 100px;" alt="Cover Image">
                <br>
                 
                <label class="m-2">Current Additional Images</label>
                @if (count($post->images) > 0)
                    @foreach ($post->images as $img)
                        <div class="image-container">
                            <form action="{{ route('image.delete', $img->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn text-danger" type="submit">Delete Image</button>
                            </form>
                            <img src="/images/{{ $img->image }}" class="img-responsive" style="max-height: 100px; max-width: 100px;" alt="Additional Image">
                        </div>
                    @endforeach
                @else
                    <p>No additional images available.</p>
                @endif
            </div>                  
        </div>
    </div>                        
</div>
@endsection