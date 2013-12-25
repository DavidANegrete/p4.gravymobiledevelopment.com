
    <div id = "page-wrapper">
        <?php if($user):?>
            <h1>Hello <?=$user->first_name?>! </h1>
            <ol>
            <dt class="menu-options" title="Check out the gallery"><a href="/gallery/index">Coolest designs!</a></dt>
            <dt class="menu-options"title="Get an estimate or set up an appointment."><a href="/prices">Schedule Appointment or Get Prices</a></dt>
            <dt class="menu-options"title="Get added to our waitlist or book an appointment."><a href="/appointments">View Appointment</a></dt>
            </ol>
        <?php else: ?>
            <p>Hello and welcome to Dlicious Nails! Here you are are able to check out any new designs that
                were created at Dlicious Nails by Darma, get an estimate on a service and even set up an appointment.
                Sign in to get started.</p>
            <p>Here you will have a gallery to view. </p>

       <?php endif; ?>

    </div>


