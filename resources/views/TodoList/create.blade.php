<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('message.Create a New To do')</title>
    <link rel="stylesheet" href="{{ asset('style/timer.css') }}">

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    
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
    <div class="Todo-List-content w-100 ">
        <div class="container d-flex justify-content-center align-items-center h-100">
        <div class="note-form w-50">
            <h1>@lang('message.Create a New To do')</h1>
            <form action="{{ route('TodoList.store') }}" method="POST" class="">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">@lang('message.title')</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">@lang('message.content')</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-dark">@lang('message.save')</button>
                <a href="{{ route('TodoList.index') }}" class="btn btn-secondary ms-3">@lang('message.cancel')</a>
            </form>
        </div>
    </div>
    </div> 

</x-wrapper>
  
   
    <script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
