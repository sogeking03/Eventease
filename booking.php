<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Page</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="calendar">
    <h2>Select a Date for Booking</h2>
    <div id="calendar"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Fetch available dates from the database using AJAX
    $.ajax({
        url: 'fetch_available_dates.php',
        method: 'GET',
        success: function(response) {
            var availableDates = JSON.parse(response);
            // Initialize the calendar
            $('#calendar').datepicker({
                beforeShowDay: function(date) {
                    var dateString = $.datepicker.formatDate('yy-mm-dd', date);
                    if ($.inArray(dateString, availableDates) !== -1) {
                        return [true, 'available', 'Available for booking'];
                    }
                    return [false, '', 'Not available for booking'];
                }
            });
        }
    });
});
</script>
</body>
</html>
