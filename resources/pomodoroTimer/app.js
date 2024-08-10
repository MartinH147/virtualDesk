// circular progress, from https://github.com/abhik-b/pomodro-timer
const circle = document.querySelector(".timerProgressCircle");
const radius = circle.r.baseVal.value;
const circumference = radius * 2 * Math.PI;

circle.style.strokeDasharray = circumference;
circle.style.strokeDashoffset = circumference;

function setProgress(percent) {
  const offset = circumference - (percent / 100) * circumference;
  circle.style.strokeDashoffset = offset;
}


// initial setup
// get values from the inputs on the settings card
let startingMinutes = document.getElementById("workmins")
startingMinutes = startingMinutes.value
startingMinutes = startingMinutes < 10 ? '0' + startingMinutes : startingMinutes;
const timeRemaining = document.getElementById('timeRemaining');
timeRemaining.innerHTML= `${startingMinutes}:00`;
// the timer starts inactive
let timerActive = false
// event listener for the start label and icon
if (timerActive == false) {
    document.getElementById("timerControls").addEventListener("click", initialiseTimer);
}
// icon and label elements
let period = document.querySelector('.period')
let icon = document.querySelector('.startstop')

// create an array with the values from the settings card, then start the timer
function initialiseTimer() {
    let periods = []
    fillArray(periods)
    startTimer(periods, x)
    timerActive = true
    icon.setAttribute("id", "stopIcon")
    // event listener for the stop icon
    document.getElementById("stopIcon").addEventListener("click", () => {
    location.reload()
});
}

// basis of timer comes from https://www.youtube.com/watch?v=x7WJEmxNlEs

let x = 0
// triggers when the start icon is clicked
function startTimer(params, x) {
    if (x < params.length) {
        // set up some variables for the timer
        let startMins = params[x]
        let time = Number(startMins * 60);
        console.log(time)
        let initialTime = time
        
        // start the timer with the setInterval method (the 1000 means it will wait 1 second after updating the timer)
        var interval = setInterval(updateTimer, 1000);
        
        // updates the timer
        function updateTimer() {
            icon.textContent = 'stop'
            if (x == 0 || x == 2 || x == 4 || x == 6) {
                period.textContent = 'Work'
            } else if (x == 1 || x == 3 || x == 5 || x ==7) {
                period.textContent = 'Break'
            } else {
                period.textContent = 'Long Break'
            }

            // updates time remaining display
            let minutes = Math.floor(time / 60);
            minutes = minutes < 10 ? '0' + minutes : minutes;
            let seconds = time % 60;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            timeRemaining.innerHTML= `${minutes}:${seconds}`;
    
            // updates circular progress by calling the previously created function
            perc = Math.ceil(((initialTime - time) / initialTime) * 100);
            setProgress(perc);
    
            // decrements timer if there is still time left
            if (time != 0) {
                time--;
            } else {
                console.log("timer finished")
                clearInterval(interval);
                x++
                console.log(x)
                startTimer(params, x)
            }
        }
        
    } 

};

