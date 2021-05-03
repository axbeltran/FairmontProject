var API_KEY = "AIzaSyAJIwwavWAuiUBHkEMcjDw1zlkdWOxbha0";
var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];

function handleClientLoad() {
    gapi.load('client', initClient);
}

function initClient() {
    gapi.client.init({
        apiKey: API_KEY,
        discoveryDocs: DISCOVERY_DOCS,

    }).then(function () {

        listUpcomingEvents();
    }, function (error) {
        console.log(JSON.stringify(error, null, 2));
    });
}

function listUpcomingEvents() {
    gapi.client.calendar.events.list({
        'calendarId': 'fairmontlewisc@gmail.com',
        'timeMin': (new Date()).toISOString(),
        'showDeleted': false,
        'singleEvents': true,
        'maxResults': 10,
        'orderBy': 'startTime'
    }).then(function (response) {

        var events = response.result.items;
        if (events.length > 0) {
            for (i = 0; i < events.length; i++) {
                var event = events[i];
                var when = event.start.dateTime;
                var end = event.end.dateTime; // not being used right now
                var datecheckStart = parseInt(moment(event.start.date).format('Do'));
                var datecheckEnd = parseInt(moment(event.end.date).format('Do'));
                var endMonthInt = parseInt(moment(event.end.date).format('Mo'));
                var endYearInt = parseInt(moment(event.end.date).format('YYYY'));
                var fixedEndDayInt = datecheckEnd - 1;
                var fixedEndDate = (datecheckEnd - 1).toString();  // not being used right now
                var formattedFixedEnd = moment(fixedEndDate).format('Do'); // not being used right now

                if (!event.start.dateTime) {
                    var d = new Date();
                    d.setFullYear(endYearInt, (endMonthInt - 1), fixedEndDayInt);
                    when = (moment(event.start.date).format('MMMM Do') + ' through ' + moment(d).format('MMMM Do'));
                    if (moment(event.start.date).format('MMMM Do YYYY') == moment(event.end.date).format('MMMM Do YYYY')) {
                        when = moment(event.start.date).format('MMMM Do');
                    } if ((datecheckEnd - 1) == datecheckStart) { when = moment(event.start.date).format('MMMM Do'); }
                } else if (moment(event.start.dateTime).format('MMMM Do YYYY') == moment(event.end.dateTime).format('MMMM Do YYYY')) {
                    when = (moment(event.start.dateTime).format('MMMM Do, h:mm a') + ' to ' + moment(event.end.dateTime).format('h:mm a'));
                } else { when = (moment(event.start.dateTime).format('MMMM Do h:mm a') + ' to ' + moment(event.end.dateTime).format('MMMM Do h:mm a')); }


                if (!event.description) { event.description = "description to be determined."; }

                const containerElement = document.createElement('containerEvent');


                const subjectElement = document.createElement('h1');
                const subjectElementText = document.createTextNode(event.summary);
                subjectElement.appendChild(subjectElementText);
                containerElement.appendChild(subjectElement);


                const nameElement = document.createElement('h3');
                const nameElementText = document.createTextNode(when);
                nameElement.appendChild(nameElementText);
                containerElement.appendChild(nameElement);


                const contextElement = document.createElement('p');
                const contextElementText = document.createTextNode(event.description);
                contextElement.appendChild(contextElementText);
                containerElement.appendChild(contextElement);

                document.getElementById("eventsContainer").appendChild(containerElement);

            }
        } else {
            myHeader.innerText = "No Upcoming Events";
        }
    });
}