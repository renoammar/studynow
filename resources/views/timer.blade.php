<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Timer</title>
    <link rel="stylesheet" href="{{ asset('style/timer.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Insert CSS Here -->
</head>
<body>
    <x-wrapper>
        <div class="wrapper">
            <div class="timer-container">
                <div id="timer">25:00</div>
                <div class="inputWrapper">
                    <input type="number" id="customTimeInput" min="1" placeholder="@lang('message.Minutes')">
                    <button class="buttonTimer" id="setCustomTimeButton">@lang('message.Set Timer')</button>
                </div>
                <div class="controls">
                    <button class="buttonTimer" id="startButton">@lang('message.Start')</button>
                    <button class="buttonTimer" id="stopButton">@lang('message.Stop')</button>
                    <button class="buttonTimer" id="resetButton">@lang('message.Reset')</button>
                </div>
            </div>
        </div>
    </x-wrapper>
    <script>
        let time = 25 * 60; // Default time is 25 minutes in seconds
        let timerElement = document.getElementById('timer');
        let timerInterval;
        let isRunning = false;

        function updateTimerDisplay() {
            let minutes = Math.floor(time / 60);
            let seconds = time % 60;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            timerElement.textContent = `${minutes}:${seconds}`;
        }

        function startTimer() {
            if (!isRunning) {
                timerInterval = setInterval(() => {
                    if (time <= 0) {
                        clearInterval(timerInterval);
                        alert("Time's up!");
                        isRunning = false;
                    } else {
                        time--;
                        updateTimerDisplay();
                    }
                }, 1000);
                isRunning = true;
            }
        }

        function stopTimer() {
            clearInterval(timerInterval);
            isRunning = false;
        }

        function resetTimer() {
            clearInterval(timerInterval);
            time = 25 * 60; // Reset to default 25 minutes
            updateTimerDisplay();
            isRunning = false;
        }

        function setCustomTime() {
            let customTime = document.getElementById('customTimeInput').value;
            if (customTime && customTime > 0) {
                time = customTime * 60; // Set time based on user input in minutes
                updateTimerDisplay();
            } else {
                alert("{{ __('message.Please enter a valid number of minutes greater than 0.') }}");
            }
        }

        document.getElementById('startButton').addEventListener('click', startTimer);
        document.getElementById('stopButton').addEventListener('click', stopTimer);
        document.getElementById('resetButton').addEventListener('click', resetTimer);
        document.getElementById('setCustomTimeButton').addEventListener('click', setCustomTime);

        // Initialize the display
        updateTimerDisplay();
    </script>
</body>
</html>
