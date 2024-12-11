<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('message.To-Do')</title>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

 
    <link rel="stylesheet" href="{{ asset('style/timer.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
        }
        .card {
            margin-bottom: 20px;
        }
        .note-header {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }
        .note-content {
            font-size: 1rem;
            color: #555;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        .btn-primary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</head>

<body>
    <x-wrapper>
    <div class="Todo-List-content">

    </div> 

    
    <div class="container">
        <h1 class="text-center mb-4">@lang('message.To-Do')</h1>
        
        <a href="{{ route('TodoList.create') }}" class="btn btn-dark mb-4">@lang('message.Create New To do')</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="list-group">
            @foreach ($posts as $post)
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title note-header">{{ $post->title }}</h5>
                        <p class="card-text note-content">{{ Str::limit($post->content, 100) }}</p>
                        <a href="{{ route('TodoList.edit', $post->id) }}" class="btn btn-sm btn-outline-secondary">@lang('message.edit')</a>

                        
                        <form action="{{ route('TodoList.destroy', $post->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('@lang('message.Are you sure you want to delete this post?')')">@lang('message.delete')</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

   </x-wrapper>
    <script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
