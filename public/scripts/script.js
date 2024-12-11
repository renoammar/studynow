document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar");
    const eventDetailsEl = document.getElementById("event-details");

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        editable: true,
        selectable: true,
        select: handleDateSelect,
        eventClick: handleEventClick,
        events: fetchEvents,
    });

    calendar.render();

    document
        .getElementById("add-event-btn")
        .addEventListener("click", function () {
            const title = document.getElementById("event-title").value;
            const startDate = document.getElementById("event-date").value;
            const endDate =
                document.getElementById("event-end-date").value || null;

            if (title && startDate) {
                addEvent({
                    title: title,
                    start_date: startDate,
                    end_date: endDate,
                });
            } else {
                alert("Please enter title and start date.");
            }
        });

    function handleDateSelect(info) {
        const title = prompt("Enter Event Title:");
        if (title) {
            addEvent({
                title: title,
                start_date: info.startStr,
                end_date: info.endStr,
            });
        }
        calendar.unselect();
    }

    function addEvent(eventData) {
        fetch("/api/events", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify(eventData),
        })
            .then((response) => response.json())
            .then((event) => {
                calendar.addEvent({
                    id: event.id,
                    title: event.title,
                    start: event.start_date,
                    end: event.end_date,
                    allDay: true,
                });
                resetForm();
            })
            .catch((error) => console.error("Error:", error));
    }

    function fetchEvents(fetchInfo, successCallback, failureCallback) {
        fetch(`/api/events?start=${fetchInfo.startStr}&end=${fetchInfo.endStr}`)
            .then((response) => response.json())
            .then((events) => {
                successCallback(
                    events.map((event) => ({
                        id: event.id,
                        title: event.title,
                        start: event.start_date,
                        end: event.end_date,
                        allDay: true,
                    }))
                );
            })
            .catch((error) => {
                console.error("Error:", error);
                failureCallback(error);
            });
    }

    function handleEventClick(info) {
        eventDetailsEl.innerHTML = `
            <strong>Event: ${info.event.title}</strong>
            <br>Start: ${info.event.start.toLocaleDateString()}
            ${
                info.event.end
                    ? `<br>End: ${info.event.end.toLocaleDateString()}`
                    : ""
            }
            <button class="delete-event-btn" data-event-id="${
                info.event.id
            }">Delete Event</button>
        `;

        document
            .querySelector(".delete-event-btn")
            .addEventListener("click", function () {
                const eventId = this.getAttribute("data-event-id");
                deleteEvent(eventId, info.event);
            });
    }

    function deleteEvent(eventId, calendarEvent) {
        fetch(`/api/events/${eventId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then(() => {
                calendarEvent.remove();
                eventDetailsEl.innerHTML =
                    "No event selected. Click on an event to see the details here.";
            })
            .catch((error) => {
                console.error("Error:", error);
                eventDetailsEl.innerHTML = "<p>Error deleting event.</p>";
            });
    }

    function resetForm() {
        document.getElementById("event-title").value = "";
        document.getElementById("event-date").value = "";
        document.getElementById("event-end-date").value = "";
    }
});
