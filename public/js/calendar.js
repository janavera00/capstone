const date = new Date();
const currentDateDisplay = document.querySelector('#date');

const weekdaysFull = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
];
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

let selectedDate = `${date.getDate()}|${date.getMonth()}|${date.getFullYear()}`;


let displayDate = `<h1 id="${date.getDate()}|${date.getMonth()}|${date.getFullYear()}">${weekdaysFull[date.getDay()]}</h1><p>${months[date.getMonth()]} ${date.getDate()}, ${date.getFullYear()}</p>`;
currentDateDisplay.innerHTML = displayDate;

document.getElementById('year').innerHTML = date.getFullYear();


function constructCalendar(){
    for(let x = 0;x < 12;x++)
    {
        const calendarMonth = document.getElementById(x);
    
        date.setDate(1);
        date.setMonth(x);
        
        const monthDays = calendarMonth.querySelector('.days');
        
        const lastDay = new Date(date.getFullYear(), date.getMonth()+1, 0).getDate();
        const firstDayIndex = date.getDay();
        
        const weekdays = [
            "Sun",
            "Mon",
            "Tue",
            "Wed",
            "Thu",
            "Fri",
            "Sat",
        ];
        
        let weekdaysDisplay = "";

        weekdays.forEach(week => {
            weekdaysDisplay += `<div>${week}</div>`;
        });
        calendarMonth.querySelector('.weekdays').innerHTML = weekdaysDisplay;
        calendarMonth.querySelector('.date h1').innerHTML = months[date.getMonth()];
        
        let days = "";
        
        for(let i = firstDayIndex;i > 0;i--)
        {
            days += `<div class="blank"></div>`;
            monthDays.innerHTML = days;
        }
        
        for(let i = 1;i <= lastDay;i++)
        {
            dispDate = `${i}|${date.getMonth()}|${date.getFullYear()}`;
    
            if(dispDate == selectedDate)
                days += `<div class="day active" onclick="changeDate('${i}', '${date.getMonth()}', '${date.getFullYear()}')" id="${dispDate}">${i}</div>`;
            else
                days += `<div class="day" onclick="changeDate('${i}', '${date.getMonth()}', '${date.getFullYear()}')" id="${dispDate}">${i}</div>`;
            monthDays.innerHTML = days;
        } 
    }
}

function changeDate(day, month, year){
    let newDate = new Date(year, month, day);

    displayDate = `<h1 id="${newDate.getDate()}|${newDate.getMonth()}|${newDate.getFullYear()}">${weekdaysFull[newDate.getDay()]}</h1><p>${months[newDate.getMonth()]} ${newDate.getDate()}, ${newDate.getFullYear()}</p>`;
    selectedDate = `${day}|${month}|${year}`;

    currentDateDisplay.innerHTML = displayDate;
    constructCalendar();
    console.log(selectedDate);
}

constructCalendar();