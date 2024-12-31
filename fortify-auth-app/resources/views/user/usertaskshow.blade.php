@extends('user.manage')

@section('title')
Task Details
@endsection

@section('content')
<div class="pcoded-inner-content">
    <!-- Main body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Task Details</h4>
                </div>
            </div>

            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ $task->title }}</h5>
                            </div>
                            <div class="card-body m-2">
                                <!-- Task Details: Status -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
                                    </div>
                                </div>

                                <!-- Task Details: Due Date -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <p><strong>Due Date:</strong> {{ $task->due_date }}</p>
                                    </div>
                                </div>

                                <!-- Task Details: Description -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <p><strong>Description:</strong> {{ $task->description }}</p>
                                    </div>
                                </div>

                                <!-- Status Update Form -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <form action="{{ route('user.updateTaskStatus', $task->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="mb-3">
                                                <label for="status" class="form-label"><strong>Update Status :</strong></label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update Status</button>
                                        </form>
                                    </div>
                                </div>

                                <div id="comments-section">
                                    <h3>Comments</h3>
                                    <ul id="comments-list" class="list-unstyled">
                                        @foreach ($task->comments as $comment)
                                            <li class="media mb-4">
                                                <!-- Avatar or User Image -->
                                                <img  src="{{ asset('storage/' . $comment->user->file_name) }}" alt="{{ $comment->user->name }}" class="mr-3 rounded-circle" width="50" height="50">
                                                
                                                <div class="media-body">
                                                    <!-- User's Name and Comment -->
                                                    <h5 class="mt-0 mb-1">{{ $comment->user->name }}</h5>
                                                    <p>{{ $comment->comment }}</p>
                                                    
                                                    <!-- Time -->
                                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                
                                    <form action="{{ route('task.comments.store', $task->id) }}" method="POST">
                                        @csrf
                                        <textarea name="comment" class="form-control" placeholder="Add a comment" required></textarea>
                                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                    </form>
                                </div>

                                <!-- Back Button -->
                                <div class="mt-3 text-center">
                                    <a href="{{ route('user.usertasks') }}" class="btn btn-secondary">Back to Tasks</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
