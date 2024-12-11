<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('message.Overview')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/overview.css') }}">
</head>
<body>
<x-wrapper>
    <div class="container my-4">
        <h1 class="h1 text-center">@lang('message.Overview')</h1>

        <!-- To-Do List Section -->
        <div class="mt-4">
            <h2>@lang('message.To-Do')</h2>
            @if($todos->isNotEmpty())
                <ul class="list-group">
                    @foreach($todos as $todo)
                        <li class="list-group-item">
                            <strong>{{ $todo->title }}</strong>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>@lang('message.No to-do items found.')</p>
            @endif
        </div>

        <!-- Events Section -->
        <div class="mt-4">
            <h2>@lang('message.Events')</h2>
            @if($events->isNotEmpty())
                <ul class="list-group">
                    @foreach($events as $event)
                        <li class="list-group-item">
                            <strong>{{ $event->title }}</strong>
                            <p>{{ $event->description }}</p>
                            <small>@lang('message.Starts'): {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('F j, Y') }}</small>
                            <br>
                            <small>@lang('message.Ends'): {{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('F j, Y') }}</small>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>@lang('message.No events found.')</p>
            @endif
        </div>
    </div>
</x-wrapper>

<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
