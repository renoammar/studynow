<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('message.edit')</title>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
 
    <link rel="stylesheet" href="{{ asset('style/timer.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .note-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<x-wrapper>
    <div class="container">
        <div class="note-form">
            <h1>@lang('message.edit')</h1>
            <form action="{{ route('TodoList.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">@lang('message.title')</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">@lang('message.content')</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $post->content) }}</textarea>
                </div>
                <button type="submit" class="btn btn-dark">@lang('message.Save Changes')</button>
                <a href="{{ route('TodoList.index') }}" class="btn btn-secondary ms-3">@lang('message.cancel')</a>
            </form>
        </div>
    </div>
    </x-wrapper>
   
    <script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
