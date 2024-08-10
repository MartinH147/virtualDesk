// The basis for the code for my to-do list came from https://www.w3schools.com/howto/howto_js_todolist.asp. It also helped my HTML and CSS

// creates the counter for the tasks indexes
// starts at 4 because of the existing tasks
var taskCounter = 4

// create a new task
function newTask() {
  const newTask = document.createElement("li"); // create a new li element
  const text = document.createTextNode("New Task"); // give it some text
  newTask.appendChild(text);
  
  let index = taskCounter
  taskCounter = taskCounter + 1

  // set the elements attributes
  newTask.setAttribute("id", `task${index}`);
  newTask.setAttribute("type", "text");
  newTask.setAttribute("onclick", "displayTask(this.id)");
  
  const parent = document.querySelector(".todayContents"); // get the parent element, in this case the list
  parent.appendChild(newTask); // assign the li element to the list

  // refresh the page (needs database set up)
  // location.reload();
}


// displays task in the task card
function displayTask(id) {
  // testing parameter
  console.log(id)

  // establish some variables
  let task = document.getElementById(id)
  const name = document.getElementById("taskName");
  const date = document.getElementById("taskDate");
  const urgency = document.getElementById("taskUrgency");
  const details = document.getElementById("taskDetails");

  // set their placeholders
  name.setAttribute("placeholder", task.id)
}

// if the value of the first input in the task card is "Task Name", then the text colour needs to be darker / more opaque
// otherwise, the text colour needs to be white because there is a task in the task card
