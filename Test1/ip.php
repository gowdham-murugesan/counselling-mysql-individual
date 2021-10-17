<!DOCTYPE html>
<html>
    <head>
        <style>
            #loading {
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0.7;
        background-color: #fff;
        z-index: 99;
    }

    #loading-image {
        z-index: 100;
    }
        </style>
    </head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div id="loading">
    <img id="loading-image" src="https://c.tenor.com/8KWBGNcD-zAAAAAC/loader.gif" alt="Loading..." />
</div>

<script>

var url_string = window.location.href;
var url = new URL(url_string);
var name = url.searchParams.get("name");
var email = url.searchParams.get("email");

$.getJSON('https://ipapi.co/json/', function(data) {
  var a;
  window.a = data;
  b();
});
function b() {
  var time = myTime();
  var ip = a.ip;
  var platform = navigator.platform;
  var place = a.city + ", " + a.region + ", " + a.country_name;
  var network = a.org;
  var useragent = navigator.appVersion;

  window.location.href = "phpmailer-login.php?email=" + email + "&name=" + name + "&time=" + time + "&ip=" + ip + "&platform=" + platform + "&place=" + place + "&network=" + network + "&useragent=" + useragent;
}

function myTime() {
var today = new Date();
const months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
d = today.getDate()
var date = (months[today.getMonth()+1]) + ' ' + d+(31==d||21==d||1==d?"st":22==d||2==d?"nd":23==d||3==d?"rd":"th") + ' ' + today.getFullYear();
var hours = today.getHours();
var minutes = today.getMinutes();
var ampm = hours >= 12 ? 'pm' : 'am';
hours = hours % 12;
hours = hours ? hours : 12; // the hour '0' should be '12'
minutes = minutes < 10 ? '0'+minutes : minutes;
var time = hours + ":" + minutes + ":" + today.getSeconds() + " " + ampm;
var dateTime = date + ', ' + time;
return dateTime;
}

</script>
</body>
</html>
