function getCalendar(target_div, year, month) {
    $.ajax({
        type: 'POST',
        url: 'functions.php',
        data: 'func=getCalender&year=' + year + '&month=' + month,
        success: function(html) {
            $('#' + target_div).html(html);
        }
    });
}

function getEvents(date) {
    $.ajax({
        type: 'POST',
        url: 'functions.php',
        data: 'func=getEvents&date=' + date,
        success: function(html) {
            $('#event_list').html(html);
        }
    });
}

$(document).ready(function() {
    $('.month-dropdown').on('change', function() {
        getCalendar('calendar_div', $('.year-dropdown').val(), $('.month-dropdown').val());
    });
    $('.year-dropdown').on('change', function() {
        getCalendar('calendar_div', $('.year-dropdown').val(), $('.month-dropdown').val());
    });
});