@extends('layout')
     
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow rounded-4">
            <div class="card-header">
              <h2>Blog</h2>
            </div>
            <div class="card-body">
                <a href="{{ url('/create') }}" class="btn btn-success btn-sm mb-3" title="Add New Post">Add New Post</a>
                <div class="table-responsive">
                    <h2>Blog Post List</h2>
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                              <th>ID</th>
                              <th>Title</th>
                              <th>Author</th>
                              <th>Description</th>
                              <th>Cover</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                              <tr>
                                  <th scope="row">{{ $post->id }}</th>
                                  <td>{{ $post->title }}</td>
                                  <td>{{ $post->author }}</td>
                                  <td>{{ Str::limit($post->body, 100) }}</td>
                                  <td>
                                    <img src="{{ asset('cover/' . $post->cover) }}" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="max-height:100px; max-width:100px" 
                                         alt="Cover Image">
                                  </td>
                                  <td>
                                    <a href="{{ url('/edit/' . $post->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                    <form action="{{ route('post.delete', $post->id) }}" method="post" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?');" type="submit">Delete</button>
                                      </form>
                                  </td>
                                 
                              </tr>
                            @endforeach
                          </tbody>
                      </table>
                </div>  
            </div>                  
        </div>
    </div>                        
</div>
@endsection
