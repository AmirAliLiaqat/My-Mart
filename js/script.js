// Js code for show/hide password
function show_hide_password() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

// Js code for show/hide date & time
function display_c(){
    var refresh = 1000; // Refresh rate in milli seconds
    mytime = setTimeout('display_ct()',refresh);
}

function display_ct() {
    var x = new Date();

    var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
    hours = x.getHours( ) % 12;
    hours = hours ? hours : 12;

    const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    var x1 = month[x.getMonth()] + " " + x.getDate() + " " + x.getFullYear(); 
    x1 = x1 + " - " +  hours + ":" +  x.getMinutes() + ":" +  x.getSeconds() + ":" + ampm;
    document.getElementById('ct').innerHTML = x1;

    display_c();
}