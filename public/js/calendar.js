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

document.getElementsByTagName('hr')[0].remove();

let displayDate = `<h1>${weekdaysFull[date.getDay()]}</h1><p>${months[date.getMonth()]} ${date.getDate()}, ${date.getFullYear()}</p>`;
currentDateDisplay.innerHTML = displayDate;

let displayTaskDate = `${date.getFullYear()}-${((date.getMonth()+1)<10)?'0'+(date.getMonth()+1):date.getMonth()+1}-${((date.getDate()+1)<10)?'0'+(date.getDate()):date.getDate()}`;
const displayTaskNode = document.getElementsByClassName('selectedDate');
let selectedDateMessage = "block";
// console.log(displayTaskNode);
for(let i = 0;i < displayTaskNode.length;i++)
{
    displayTaskNode[i].style.display = "none";
    if(displayTaskDate == displayTaskNode[i].id){
        selectedDateMessage = "none";
        displayTaskNode[i].style.display = "block"
    }
}
document.getElementById('selectedDateMessage').style.display = selectedDateMessage;

function constructCalendar(){
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    for(let x = 0;x < 10;x++)
    {
        const calendarMonth = document.getElementById(x);
    
        date.setDate(1);
        date.setMonth(currentMonth);
        date.setFullYear(currentYear);
        
        if(currentMonth < 11){
            currentMonth++;
        }else{
            currentMonth = 0;
            currentYear++;
        }

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
        calendarMonth.querySelector('.date h1').innerHTML = `${months[date.getMonth()]}, ${date.getFullYear()}`;
        
        let days = "";
        
        for(let i = firstDayIndex;i > 0;i--)
        {
            days += `<div class="blank"></div>`;
            monthDays.innerHTML = days;
        }
        
        for(let i = 1;i <= lastDay;i++)
        {
            dispDate = `${i}|${date.getMonth()}|${date.getFullYear()}`;
            let today = `${new Date().getDate()}|${new Date().getMonth()}|${new Date().getFullYear()}`;
            let dateMarker = "";
            // let EventDate = getEventDate(dispDate);

            // console.log(hasEvent(dispDate));

            if(dispDate == selectedDate)
                dateMarker = "active";
            else if(dispDate == today)
                dateMarker = "current";
            else if(hasEvent(dispDate))
                dateMarker = "hasEvent";
                
            days += `<div class="day ${dateMarker}" onclick="changeDate('${i}', '${date.getMonth()}', '${date.getFullYear()}')" id="${dispDate}">${i}</div>`;
            monthDays.innerHTML = days;

            document.getElementById(dispDate);
            
        } 
    }
    
    // var nodes = document.querySelector('.eventsOnCalendar');
    // console.log(nodes);
    // nodes.forEach(node => {
        // });
}
    // console.log(getEventDate(`14|11`));
    
function changeDate(day, month, year){
    let newDate = new Date(year, month, day);

    displayDate = `<h1>${weekdaysFull[newDate.getDay()]}</h1><p>${months[newDate.getMonth()]} ${newDate.getDate()}, ${newDate.getFullYear()}</p>`;
    selectedDate = `${day}|${month}|${year}`;

    currentDateDisplay.innerHTML = displayDate;

    displayTaskDate = `${newDate.getFullYear()}-${((newDate.getMonth()+1)<10)?'0'+(newDate.getMonth()+1):newDate.getMonth()+1}-${(newDate.getDate()<10)?'0'+newDate.getDate():newDate.getDate()}`;
    selectedDateMessage = "block";
    for(let i = 0;i < displayTaskNode.length;i++)
    {
        displayTaskNode[i].style.display = "none";
        
        if(displayTaskDate == displayTaskNode[i].id){
            document.getElementById('selectedDateMessage').style.display = "none";
            selectedDateMessage = "none";
            displayTaskNode[i].style.display = "block"
        }
    }
    document.getElementById('selectedDateMessage').style.display = selectedDateMessage;
    // currentMonth = new Date().getMonth();
    constructCalendar();
    // console.log(selectedDate);
}

function hasEvent(draw){
    let events = document.querySelector('#eventsOnCalendar').childNodes;
        
    for(let i = 0;i < events.length;i++)
    {
        let explodedDate = events[i].textContent.split('-');
        var newDate = new Date(parseInt(explodedDate[0]), parseInt(explodedDate[1])-1, parseInt(explodedDate[2]));
        newDate = `${newDate.getDate()}|${newDate.getMonth()}|${newDate.getFullYear()}`;

        if(draw == newDate)
        {
            // console.log(newDate);
            return true;
        }
    }
    return false;
}

constructCalendar();