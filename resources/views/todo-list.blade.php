<!-- resources/views/todolist.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoList</title>
    <link rel="stylesheet" href="{{asset('style/TodoList.css')}}">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>
<body>
    <x-wrapper>
       
        <div class="todo-content">
            <!-- Your todo content here -->
            <h1>Todo List Page</h1>
        </div>
    </x-wrapper>
</body>
</html>
