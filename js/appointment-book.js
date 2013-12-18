/**
 * Created by David on 11/21/13.
 * Harvard Extension Schools
 */

//declaring variables
var cost=0;
var time=0;
var label;
var extra_selected = false;
var service;
var extras = new Array();

//declaring prices/time of extra services
var extras_name = new Array("Parafin Wax Treatment","Massage","Nail Art", "None");
var extras_cost = new Array(10,10,10,0);
var extras_time = new Array(10,10,20,0);

/***
 * Inner clusters of radio buttons.
 ***/

var main_options            =       '<input type="radio" class="service" name="service" id="extensions">'+
    '<label for="extensions">Nail Extensions</label><br>'+

    <!-- adding a div to add content to later -->
    '<div class="options" id="extensions-options"></div>'+

    '<input type="radio" class="service" name="service" id="fills">'+
    '<label for="fills">Fills</label><br>'+

    <!-- adding a div to add content to later -->
    '<div class="options" id="fills-options"></div>'+

    '<input type="radio" class="service" name="service" id="manicure">'+
    '<label for="manicure">Manicure</label><br>'+

    <!-- adding a div to add content  -->
    '<div class="options" id="manicure-options"></div><br>';

var extensions_fills_sub    =   '<input type="radio" class="service-type" name="service-type" id="acrylic" value = "1">'+
    '<label for="acrylic">Acrylic</label>'+
    '<input type="radio" class="service-type" name="service-type" id="gel" value = "2">' +
    '<label for="gel">Gel</label><br>';

var manicure_sub            =   '<input type="radio" class="service-type" name="service-type" id="regular_polish" value = "3">'+
    '<label for="regular_polish">Regular</label>'+
    '<input type="radio" class="service-type" name="service-type" id="gel_polish" value = "4">'+
    '<label for="gel_polish">Gel</label><br>';

var add_on_checkbox           = '<input type="checkbox" class = "add-on" name="add-on" id = "parafin" value="0" = "50">'+
    '<label for="parafin">Parafin wax</label><br>'+
    '<input type="checkbox" class = "add-on" name="add-on" id = "massage" value="1">'+
    '<label for="massage">Massage</label><br>'+
    '<input type="checkbox" class = "add-on" name="add-on" id = "nail-art" value="2">'+
    '<label for="nail-art">Nail Art</label><br>'+
    '<input type="checkbox" class = "add-on" name="add-on" id = "none" value="3">'+
    '<label for="none">None</label><br><br>';

/***
 * displaying the main options
 ***/

$('#head').html('<h1></h1>');
$('#display').html(main_options);
$('#book-now').html('');

/***
 * Click listener for the initial radio button UI. The termination of the UI will result in the cost
 * and time values to be set.
 ***/

$('input[name=service]').click(function() {

    //Get the label element that comes immediately after this radio button.
    label       =   $(this).next();

    //from the label element get the inner HTML
    service     =    label.html();

    //condition to check for a match
    if (service == 'Nail Extensions'){

        //this function hides the other labels and enables the corresponding menu
        displaySub(service);

        //next layer checking whether acrylic or gel was selected
        $('input[name=service-type]').click(function(){

            //the select button is enabled hid it at first and displaying only after a value is assigned to cost and time
            $('#select-service').prop("disabled", false);

            //get the label element that comes after this inner radio button
            label       =   $(this).next();

            //from the label element get the inner HTML
            service     =   label.html();

            //set cost to 50 for acrylic nails and time to 60
            if (service == 'Acrylic') {
                cost    =   50;
                time    =   60;
                service = service + ' Extensions';
                console.log('Acrylic Cost:' + cost);
            }

            //set cost to 60 for gel and time to 60
            else if(service == 'Gel'){
                cost    =   60;
                time    =   60;
                service = service + ' Extensions';
                console.log('gel Cost:' + cost);
            }

        });

    }

    else if(service == 'Fills'){

        //this function hides the other labels and enables the corresponding menu
        displaySub(service);

        //get the label element that comes after this inner radio button
        label       =   $(this).next();

        //from the label element get the inner HTML
        service     =   label.html();

        $('input[name=service-type]').click(function(){

            //enabling the radio
            $('#select-service').prop("disabled", false);

            //get the label element that comes after this inner radio button
            label       =   $(this).next();

            //from the label element get the inner HTML
            service     =   label.html();

            //set cost to 35 for acrylic nails and time to 50
            if (service == 'Acrylic') {
                cost    =   35;
                time    =   50;
                service = service + ' Fills';
            }

            //set cost to 45 for gel and time to 50
            else if(service == 'Gel'){
                cost    =   45;
                time    =   50;
                service = service + ' Fills';
            }

        });

    }

    else if(service == 'Manicure'){

        //this function hides the other labels and enables the corresponding menu
        displaySub(service);

        //get the label element that comes after this inner radio button
        label       =   $(this).next();

        //from the label element get the inner HTML
        service     =   label.html();

        $('input[name=service-type]').click(function(){

            //get the label element that comes after this inner radio button
            label       =   $(this).next();

            //from the label element get the inner HTML
            service     =   label.html();

            //set cost to 50 for acrylic nails and time to 60
            if (service == 'Regular Polish') {
                cost    =   25;
                time    =   30;
                service = service + ' Manicure';
            }

            //set cost to 60 for gel and time to 60
            else if(service == 'Gel Polish'){
                cost    =   35;
                time    =   45;
                service = service + ' Manicure';
            }

        });

    }

});




//EO main options

/***
 * Click listener for for the select button.
 **/

// added this variable to keep the check boxes from getting wiped when the button is pressed again.
var control= 0;
$('#select-service').click(function() {

    if(control==0){
        addOn();
        control =1;
    }

    //this function displays the total
    displayTotal();

    // this function checks the check boxes.
    checkboxes();
});

/***
 *This function displays the total.
 ***/

function displayTotal(){

    $('#main-service').html( service + ': <span> $' + cost + '</span>' );

    //checking if valid because keep null from displaying
    if(extra_selected == true){

        $('#display').html('');
        $('#head').html('<h1>Services Selected</h1>');
        $('#info').html('Here is an estimate for your next appointment. Click on Book-It to schedule it.');

        //step through extras and display total
        for (var i=0; i<extras.length; i++){

            $('#extras').append( '<p>' + extras_name[Math.floor(extras[i])] + ':<span> $' + extras_cost[Math.floor(extras[i])] + '</span></p>');
            time = time + extras_time[Math.floor(extras[i])];
            cost = cost + extras_cost[Math.floor(extras[i])];
        }

        $('#sub-total').html( 'Service + Extras: ' + ' <span> $' + cost + '</span>' +'<br>');

        //adding control to keep users from entering submit twice
        $('#select-service').prop("disabled", true);
        $('#book-it').prop("disabled", false);
    }

    $('#time').html( '<br>Time needed' + ': <span>' + time + ' minutes </span><br><br>' );
}

/***
 *This function changes the heading and also displays new HTML in the display area
 ***/

function addOn(){


    $('#head').html('<h1>Pick Extras</h1>');
    $('#info').html('Select an extra service or select none and continue.');
    $('#display').html(add_on_checkbox);

}

/***
 *Function to reload page so the user can start over
 ***/

$('#back').click(function() {
    location.reload();


});

/***
 * Check the boxes
 ***/

function checkboxes(){

    var checkedBoxes = $('input[name=add-on]:checked');

    for (var i=0; i<checkedBoxes.length; i++)
    {
        var box = Math.floor($(checkedBoxes[i]).val());
        if(box == 0){

            extras[i] = box;
        }
        else if(box == 1){
            extras[i] = box;
        }
        else if(box == 2){
            extras[i] = box;
        }
        else if(box == 3){
            extras[i] = box;
        }

        extra_selected = true;

    }

}

//using a single function to display diffrent subs for the main menus,
function displaySub(submenu){

    if (submenu == 'Nail Extensions'){
        $('#extensions-options').html(extensions_fills_sub);
        $('#fills-options').html('');
        $('#manicure-options').html('');
    }
    else if(submenu == 'Fills'){
        $('#extensions-options').html('');
        $('#fills-options').html(extensions_fills_sub);
        $('#manicure-options').html('');
    }

    else if(submenu == 'Manicure'){
        $('#extensions-options').html('');
        $('#fills-options').html('');
        $('#manicure-options').html(manicure_sub)

    }

}


//Eventually I will add athe abitlity for this to be booked using a db.
$('#book-it').click(function() {
    $('#info').html('Your appointment is booked!');
    console.log('test');

});








