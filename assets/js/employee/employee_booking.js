document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        eventDidMount: function(info) {
            $(info.el).click(function(){
                $('#customerName').val(info.event.extendedProps.customerName);
                $('#time').val(info.event.extendedProps.time);
                $('#payment').val(info.event.extendedProps.payment);
                $('#address').val(info.event.extendedProps.address);
            });
        },
        eventSources: [{
            events: [ // put the array in the `events` property
                {
                    title  : 'event1',
                    start  : '2021-09-01',
                    customerName: 'Thisara',
                    address: '34, Reid avenue, Colombo',
                    time: '1:00 PM',
                    payment: 'Rs. 3000'
                },
                {
                    title  : 'event2',
                    start  : '2021-09-05',
                    end    : '2021-09-07',
                    customerName: 'ashfaq',
                    address: '35, Reid avenue, Colombo',
                    time: '3:00 PM',
                    payment: 'Rs. 5000'
                },
                {
                    title  : 'event3',
                    start  : '2021-09-20',
                    customerName: 'Madhawa',
                    address: '36, Reid avenue, Colombo',
                    time: '10:00 AM',
                    payment: 'Rs. 10,000'
                }
            ],
            color: '#108882',     // an option!
            textColor: 'white' // an option!
        }]
    });
    calendar.render();
});