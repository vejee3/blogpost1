@extends('layout')

@section('content')
<div class="container my-5">
    <div class="card shadow rounded-4 p-4">
        <h2 class="mb-4">Admin Dashboard</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->author }}</td>
                            <td>
                                <form action="{{ route('admin.approve', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="btn btn-success btn-sm" type="submit">Approve</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
