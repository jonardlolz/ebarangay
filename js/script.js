const date = new Date();

$.ajax({
  url: './includes/jsdbh.inc.php',
  type: 'GET',
  success: function (data) {
    var obj = jQuery.parseJSON(data);
    var scheduleArray = new Array();

    obj.forEach(myFunction);

    function myFunction(item){
      console.log(item);
    }

    schedule = new Date(obj[0].scheduleDate);
    console.log(obj[0].ereklamoID);
    console.log(schedule.getMonth());


const renderCalendar = () => {
  date.setDate(1);

  const monthDays = document.querySelector(".days");

  const lastDay = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDate();

  const prevLastDay = new Date(
    date.getFullYear(),
    date.getMonth(),
    0
  ).getDate();

  const firstDayIndex = date.getDay();

  const lastDayIndex = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDay();

  const nextDays = 7 - lastDayIndex - 1;

  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  document.querySelector(".date h1").innerHTML = months[date.getMonth()];

  document.querySelector(".date p").innerHTML = new Date().toDateString();

  let days = "";

  for (let x = firstDayIndex; x > 0; x--) {
    days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
  }

  for (var i = 1; i <= lastDay; i++) {
    if (i === new Date().getDate() && date.getMonth() === new Date().getMonth()){
      days += `<div class="today">${i}</div>`;
      
    } 
    else if (i === schedule.getDate() && schedule.getMonth() === new Date().getMonth()){
      days += `<div class="today">${i}</div>`;
    }
    else {
      days += `<div>${i}</div>`;
    }
  }


  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="next-date">${j}</div>`;
  }
  monthDays.innerHTML = days;
};

document.querySelector(".prev").addEventListener("click", () => {
  date.setMonth(date.getMonth() - 1);
  renderCalendar();
});

document.querySelector(".next").addEventListener("click", () => {
  date.setMonth(date.getMonth() + 1);
  renderCalendar();
});

renderCalendar();

  }
});