@extends('layout')
     
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h2>Blog</h2>
            </div>
            <div class="card-body">
                <a href="{{ url('/create') }}" class="btn btn-success btn-sm" title="Add New Post">Add New Post</a>
                <br/><br/>
                <div class="table-responsive">
                <h2>Blog Post List</h2>
                <table class="table">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Author</th>
                      <th>Description</th>
                      <th>Cover</th>
                      <th>Update</th>
                      <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                      <tr>
                          <th scope="row">{{ $post->id }}</th>
                          <td>{{ $post->title }}</td>
                          <td>{{ $post->author }}</td>
                          <td>{{ $post->body }}</td>
                          <td><img src="cover/{{ $post->cover }}" class="img-responsive" style="max-height:100px; max-width:100px" alt="" srcset=""></td>
                          <td><a href="/edit/{{ $post->id }}" class="btn btn-outline-primary">Edit</a></td>
                          <td>
                              <form action="{{ route('post.delete', $post->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?');" type="submit">Delete</button>
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