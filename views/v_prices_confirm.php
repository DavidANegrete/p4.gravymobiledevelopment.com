

<form class="form" id="confirmationform" method="POST" action="/prices/p_book/">

    <fieldset>

        <legend>Please enter a time and date for your appointment <?=$user->first_name?></legend>

        <p>

            <label for="appointment_date">Date</label>

            <input id="appointment_date" type="date" name = 'date' required/>

        </p>

        <p>

            <label for="appointment_time">Time</label>

            <input id="appointment_time" type="time" name = 'time' required/>

        </p>

        <p>

            <input class="submit" type="submit" id = 'timesubmitform' value="Submit"/>

        </p>

    </fieldset>

</form>

<script>

    $("#commentForm").validate();

</script>

