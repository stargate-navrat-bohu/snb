


<script>
function tick() {
var hours, minutes, seconds, ap;
var intHours, intMinutes, intSeconds;
var today;

today = new Date();

intHours = today.getHours();
intMinutes = today.getMinutes();
intSeconds = today.getSeconds();

if (intHours == 0) {
hours = "12:";
ap = "Midnight";
} else if (intHours < 24) {
hours = intHours+":";
ap = "";
} else if (intHours == 12) {
hours = "12:";
ap = "";
} else {
intHours = intHours - 12
hours = intHours + ":";
ap = "";
}

if (intMinutes < 10) {
minutes = "0"+intMinutes+":";
} else {
minutes = intMinutes+":";
}

if (intSeconds < 10) {
seconds = "0"+intSeconds+" ";
} else {
seconds = intSeconds+" ";
}

timeString = hours+minutes+seconds+ap;

Clock.innerHTML = timeString;

window.setTimeout("tick();", 100);
}

window.onload = tick;

</script> 
<script>
function tick() {
  var hours, minutes, seconds, ap;
  var intHours, intMinutes, intSeconds;
  var today;

  today = new Date();

  intHours = today.getHours();
  intMinutes = today.getMinutes();
  intSeconds = today.getSeconds();

  if (intHours == 0) {
     hours = "12:";
  } else if (intHours < 12) { 
     hours = intHours+":";
  } else if (intHours == 12) {
     hours = "12:";
  } else {
     hours = intHours + ":";
  }

  if (intMinutes < 10) {
     minutes = "0" + intMinutes + ":";
  } else {
     minutes = intMinutes + ":";
  }

  if (intSeconds < 10) {
     seconds = "0" + intSeconds + " ";
  } else {
     seconds = intSeconds + " ";
  } 

  timeString = hours + minutes + seconds ;

  Clock.innerHTML = timeString;

  window.setTimeout("tick();", 100);
}

window.onload = tick;

</script>

<div id="Clock"> </div>