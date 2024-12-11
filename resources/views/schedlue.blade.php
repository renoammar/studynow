<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/fullcalendar.min.css">
    <link rel="stylesheet" href="{{ asset('style/calendars.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('message.Event Title')</title>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</head>
<body>
    <div class="schedule__wrapper">
        <x-sidebar></x-sidebar>
        <div class="combined-panel">
            <div id="event-form">
                <input type="text" id="event-title" placeholder="@lang('message.Event Title')" required>
                <div class="date__wrapper">
                    <label for="event-date">@lang('message.Event Start Date')</label>
                    <input type="date" id="event-date" required>
                </div>
                <div class="date__wrapper">
                    <label for="event-end-date">@lang('message.Event End Date (Optional)')</label>
                    <input type="date" id="event-end-date">
                </div>
                <button id="add-event-btn">@lang('message.Add Event')</button>
                <div id="event-details">@lang('message.No event selected. Click on an event to see the details here.')</div>
            </div>
            <div id="calendar"></div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.js"></script>
    <script>     
           document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var eventDetailsEl = document.getElementById('event-details');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth' // Removed timeGridWeek and timeGridDay
        },
        editable: true,
        selectable: true,
        select: handleDateSelect,
        eventClick: handleEventClick,
        events: fetchEvents
    });
    calendar.render();

    function handleDateSelect(info) {
        var title = prompt('@lang('message.Enter Event Title'):');
        if (title) {
            addEvent({
                title: title,
                start_date: info.startStr,
                end_date: info.endStr
            });
        }
        calendar.unselect();
    }

    document.getElementById('add-event-btn').addEventListener('click', function() {
        var title = document.getElementById('event-title').value;
        var startDate = document.getElementById('event-date').value;
        var endDate = document.getElementById('event-end-date').value || null;

        if (title && startDate) {
            addEvent({
                title: title,
                start_date: startDate,
                end_date: endDate
            });
        } else {
            alert('Please enter title and start date.');
        }
    });

    function addEvent(eventData) {
        fetch('/api/events', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(eventData)
        })
        .then(response => response.json())
        .then(event => {
            calendar.addEvent({
                id: event.id,
                title: event.title,
                start: event.start_date,
                end: event.end_date,
                allDay: true
            });
            resetForm();
        })
        .catch(error => console.error('Error:', error));
    }

    function fetchEvents(fetchInfo, successCallback, failureCallback) {
        fetch(`/api/events?start=${fetchInfo.startStr}&end=${fetchInfo.endStr}`)
            .then(response => response.json())
            .then(events => {
                successCallback(events.map(event => ({
                    id: event.id,
                    title: event.title,
                    start: event.start_date,
                    end: event.end_date,
                    allDay: true
                })));
            })
            .catch(error => {
                console.error('Error:', error);
                failureCallback(error);
            });
    }

    function handleEventClick(info) {
        // Display event details with a delete button
        eventDetailsEl.innerHTML = `
            <strong>@lang('message.Events'): ${info.event.title}</strong>
            <br>@lang('message.Starts'): ${info.event.start.toLocaleDateString()}
            ${info.event.end ? `<br>@lang('message.Ends'): ${info.event.end.toLocaleDateString()}` : ''}
            <button class="delete-event-btn" data-event-id="${info.event.id}">@lang('message.Delete Event')</button>
        `;

        // Add event listener to the delete button
        const deleteBtn = document.querySelector('.delete-event-btn');
        deleteBtn.addEventListener('click', function() {
            const eventId = this.getAttribute('data-event-id');
            deleteEvent(eventId, info.event);
        });
    }

    function deleteEvent(eventId, calendarEvent) {
        fetch(`/api/events/${eventId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(() => {
            calendarEvent.remove();
            eventDetailsEl.innerHTML = '@lang('message.No event selected. Click on an event to see the details here.')';
        })
        .catch(error => {
            console.error('Error:', error);
            eventDetailsEl.innerHTML = '<p>@lang('message.Error deleting event.')</p>';
        });
    }

    function resetForm() {
        document.getElementById('event-title').value = '';
        document.getElementById('event-date').value = '';
        document.getElementById('event-end-date').value = '';
    }
});

    </script>
</body>
</html>
