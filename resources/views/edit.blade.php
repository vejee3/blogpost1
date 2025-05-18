@extends('layout')
     
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow rounded-4 p-4" style="background-color: rgba(255, 255, 255, 0.7);">
            <div class="card-header bg-transparent border-0 pb-3">
              <h2>Edit Post</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <input type="text" name="title" class="form-control mb-3" placeholder="Title" value="{{ $post->title }}" required>
                    <input type="text" name="author" class="form-control mb-3" placeholder="Author" value="{{ $post->author }}" required>
                    <textarea name="body" cols="20" rows="4" class="form-control mb-3" placeholder="Body" required>{{ $post->body }}</textarea>
                     
                    <label class="form-label mb-1">Cover Image</label>
                    <input type="file" class="form-control mb-3" name="cover">
 
                    <label class="form-label mb-1">Additional Images</label>
                    <input type="file" class="form-control mb-3" name="images[]" multiple>
 
                    <button type="submit" class="btn btn-success mt-3">Update Post</button>
                </form>
                 
                <hr class="my-4">
                
                <label class="form-label mb-2">Current Cover Image</label>
                <div class="d-flex align-items-center gap-3 mb-4">
                    <form action="{{ route('cover.delete', $post->id) }}" method="post" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm" type="submit">Delete Cover Image</button>
                    </form>
                    <img src="/cover/{{ $post->cover }}" class="img-thumbnail shadow-sm" style="max-height: 100px; max-width: 100px;" alt="Cover Image">
                </div>
                 
                <label class="form-label mb-2">Current Additional Images</label>
                @if (count($post->images) > 0)
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($post->images as $img)
                            <div class="image-container text-center">
                                <form action="{{ route('image.delete', $img->id) }}" method="post" style="margin-bottom: 0.5rem;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" type="submit">Delete Image</button>
                                </form>
                                <img src="/images/{{ $img->image }}" class="img-thumbnail shadow-sm" style="max-height: 100px; max-width: 100px;" alt="Additional Image">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No additional images available.</p>
                @endif
            </div>                  
        </div>
    </div>                        
</div>
@endsection
