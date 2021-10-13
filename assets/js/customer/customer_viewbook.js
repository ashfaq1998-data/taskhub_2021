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
    

    });
    calendar.render();
  });