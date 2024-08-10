let note_counter = document.querySelectorAll('.newNote').length;
console.log(note_counter)

// create new note
document.querySelector("stickyNotes").addEventListener("click", newStickyNote())


function newStickyNote() {
  // checks if the number of notes will exceed 5
  if (note_counter < 5) {
      const note = document.createElement("input"); // create a new input element
      
      // create a unique id for the element
      const id = `note${note_counter}`
      note_counter = note_counter + 1
  
      // set the elements attributes
      note.setAttribute("id", id)
      note.setAttribute("class", "newNote")
      note.setAttribute("type", "text")
      note.setAttribute("placeholder", "New Note")
      note.setAttribute("ondblclick", "deleteNote(this.id)")
      
      const parent = document.getElementById("notesSpace"); // get the parent element, in this case the notesSpace
      parent.appendChild(note); // assign the input element to the notesSpace
  }
}

// delete the double-clicked note
function deleteNote(id) {
  const element = document.getElementById(id);
  element.remove();
}


