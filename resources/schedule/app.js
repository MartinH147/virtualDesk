// MONTH CARD

// from https://www.geeksforgeeks.org/how-to-design-a-simple-calendar-using-javascript/
let date = new Date();
let year = date.getFullYear();
let month = date.getMonth();

const day = document.querySelector(".calendarDates");

const currdate = document
	.querySelector(".calendarCurrentDate");

const prenexIcons = document
	.querySelectorAll(".calendarNav span");

// Array of month names
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
	"December"
];

// Function to generate the calendar
const manipulate = () => {

	// Get the first day of the month
	let dayone = new Date(year, month, 1).getDay();

	// Get the last date of the month
	let lastdate = new Date(year, month + 1, 0).getDate();

	// Get the day of the last date of the month
	let dayend = new Date(year, month, lastdate).getDay();

	// Get the last date of the previous month
	let monthlastdate = new Date(year, month, 0).getDate();

	// Variable to store the generated calendar HTML
	let lit = "";

	// Loop to add the last dates of the previous month
	for (let i = dayone; i > 0; i--) {
		lit +=
			`<li class="inactive">${monthlastdate - i + 1}</li>`;
	}

	// Loop to add the dates of the current month
	for (let i = 1; i <= lastdate; i++) {

		// Check if the current date is today
		let isToday = i === date.getDate()
			&& month === new Date().getMonth()
			&& year === new Date().getFullYear()
			? "active"
			: "";
		lit += `<li class="${isToday}" onclick="displayInDayCard('${i}', '${months[month]}')"><p class="${isToday}p">${i}</p></li>`;
	}

	// Loop to add the first dates of the next month
	for (let i = dayend; i < 6; i++) {
		lit += `<li class="inactive">${i - dayend + 1}</li>`
	}

	// Update the text of the current date element 
	// with the formatted current month and year
	currdate.innerText = `${months[month]} ${year}`;

	// update the HTML of the dates element 
	// with the generated calendar
	day.innerHTML = lit;
}

manipulate();

// Attach a click event listener to each icon
prenexIcons.forEach(icon => {

	// When an icon is clicked
	icon.addEventListener("click", () => {

		// Check if the icon is "calendarPrev"
		// or "calendarNext"
		month = icon.id === "calendarPrev" ? month - 1 : month + 1;

		// Check if the month is out of range
		if (month < 0 || month > 11) {

			// Set the date to the first day of the 
			// month with the new year
			date = new Date(year, month, new Date().getDate());

			// Set the year to the new year
			year = date.getFullYear();

			// Set the month to the new month
			month = date.getMonth();
		}

		else {

			// Set the date to the current date
			date = new Date();
		}

		// Call the manipulate function to 
		// update the calendar display
		manipulate();
	});
});




// DAY CARD

// sets the .day element to the current weekday and numeric date
const dayElement = document.querySelector('.day'); 
const dayTitle = new Date(); 
const dayOptions = { weekday: 'long' }; 
const dayOfWeek = dayTitle.toLocaleDateString('en-US', dayOptions); 
const numericDate = dayTitle.getDate(); 
dayElement.textContent = `${dayOfWeek} ${numericDate}`; 


// displays day when clicked from month card
function displayInDayCard(date, month) {
	const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
	console.log(date, month)
	const d = new Date(`${month} ${date}, 2024 00:00:00`);
	let day = weekday[d.getDay()];
	console.log(day)
	const displayDay = document.getElementById("day")
	displayDay.innerHTML = `${day} ${date}`

	
	for (i = 0; i < months.length; i++) {
		if (month == months[i]) {
			// save cookies
			var SQLmonth = i + 1
			SQLmonth = SQLmonth < 10 ? '0' + SQLmonth : SQLmonth;
			document.cookie = `monthIndex=${i}; expires=Tue, 1 Jan 2030 12:00:00 UTC`;
			document.cookie = `date=${date}; expires=Tue, 1 Jan 2030 12:00:00 UTC`;
			date = date < 10 ? '0' + date : date;
			let SQLdate = `${year}-${SQLmonth}-${date}`
			console.log(SQLdate)
			document.cookie = `SQLdate=${SQLdate}; expires=Tue, 1 Jan 2030 12:00:00 UTC`;
		}
	}
}


// EVENT CARD
// makes the event display in the event card
function displayEvent(id) {
	// testing parameter
	console.log(id)
  
	// establish some variables
	let task = document.getElementById(id)
	const name = document.getElementById("eventName");
	const date = document.getElementById("eventDate");
	const time = document.getElementById("eventTime");
	const details = document.getElementById("eventDetails");
  
	// set their placeholders
	name.setAttribute("value", task.textContent)
}


var eventCounter = 2 // because there are 3 example events, these will be deleted later

// create a new event
function newEvent() {
	const newEvent = document.createElement("td"); // create a new td element
	const text = document.createTextNode("New Event"); // give it some text
	newEvent.appendChild(text);
	
	let index = eventCounter
	eventCounter = eventCounter + 1
  
	// set the elements attributes
	newEvent.setAttribute("id", `event${index}`);
	newEvent.setAttribute("class", "event");
	newEvent.setAttribute("onclick", "displayEvent(this.id, this.textContent)");
	
	const parent = document.querySelector(".newEventTableRow"); // get the parent element, in this case the table row
	parent.appendChild(newEvent); // assign the li element to the list
  
	// refresh the page (needs database set up). There's probably a better way to do this
	// location.reload();
  }

