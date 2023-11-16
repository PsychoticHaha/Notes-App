const saveBtn = document.querySelector('#save'),
  saveChange = document.querySelector('#saveChange'),
  input = document.getElementById('note-title'),
  textarea = document.getElementById('note-body');
const cancelBtn = document.querySelector('#cancel');

// Listen the click on  the save button
saveBtn.addEventListener('click', (event) => {
  event.preventDefault();
  const format = `{&title=${input.value}&note=${textarea.value}&save=Save}`;
  // Send values to the saveNote function
  saveNote(format);
  input.value = '';
  textarea.value = '';
})

document.addEventListener('DOMContentLoaded', getNotes());
// Function for note saving
function saveNote(params) {
  const url = './CRUD/createNotes.php',
    xhr = new XMLHttpRequest();
  if (input.value != '' && textarea.value != "" && input.value != false && textarea.value != false) {
    xhr.onreadystatechange = async function () {
      if (xhr.readyState == 4 && xhr.status === 200) {
        const result = JSON.parse(xhr.responseText);
        console.log((result == "NOTE SAVED"));
        if (result === "NOTE SAVED") {
          //  Show success message only when note is saved
          const msg = document.createElement('div');
          msg.setAttribute('class', 'success tips');
          msg.innerHTML = 'Note Saved !';
          document.body.appendChild(msg);
          hideMsg(msg);
          getNotes();
        }
      }
    }
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
  } else {
    const msg = document.createElement('div');
    msg.setAttribute('class', 'error tips');
    msg.innerHTML = 'Sorry, cannot save empty note !';
    document.body.appendChild(msg);
    hideMsg(msg);
  }
}

let dataAccumulator = '';
//  Read Notes via fetching
async function getNotes() {
  const url = './CRUD/getNotes.php';
  let html = '';
  await fetch(url)
    .then(response => {
      if (!response.ok) {
        throw new Error(`Erreur HTTP! Statut : ${response.status} `);
      }
      return response.json();
    })
    .then(data => {
      for (let i = 0; i < data.length; i++) {
        const element = data[i],
          id = element.id,
          title = element.title,
          content = element.content,
          creation_date = element.creation_date;
        if (id == "") {
          document.querySelector('.note-empty').style = 'display:flex';
        } else {
          document.querySelector('.note-empty').style = 'display:none';
       
        html += `<div class="singlenote" id='${id}'>
        <div class="title">
          <p>${title}</p>
          <p>${((creation_date))}</p>
        </div>
        <div class="note-content">
          <p>${content}</p>
        </div>
        <div class="btns">
          <a class="edit" onclick="editNote(${id})">
            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
            </svg>
            Edit
          </a>
          <a class="delete" onclick="deleteNote(${id})">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
            </svg>
            Delete
          </a>
        </div>
      </div>`;
      }
    }
    })
    .catch(error => console.error('Erreur', error));
  const notelistContainer = document.querySelector('.box-homepage .content .body');
  notelistContainer.innerHTML = html;
}

// Edit notes
let noteID = 0;
function editNote(id) {
  toggleNoteList();
  const elementToEdit = document.getElementById(id),
    title = elementToEdit.firstElementChild.firstElementChild.innerHTML;
  const content = elementToEdit.firstElementChild.nextElementSibling.firstElementChild.innerHTML;
  input.value = title;
  textarea.value = content;
  saveBtn.style = 'display:none';
  saveChange.style = 'display:block';
  input.classList.add('highlight');
  textarea.classList.add('highlight');
  let t;
  clearTimeout(t);
  cancelBtn.style = "display:block";
  t = setTimeout(() => {
    input.classList.remove('highlight');
    textarea.classList.remove('highlight');
  }, 4000);
  noteID = id;
}

// Save new changes
saveChange.addEventListener('click', (event) => {
  event.preventDefault();
  saveEdit();
});
// Note Save Edit function
function saveEdit() {
  const data = `&title=${input.value}&note=${textarea.value}&noteID=${noteID}&saveChange=Save+Changes`;
  const url = './CRUD/editNotes.php',
    xhr = new XMLHttpRequest();
  if (input.value != '' && textarea.value != "" && input.value != false && textarea.value != false) {
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status === 200) {
        const result = JSON.parse(xhr.responseText);
        if (result === "NOTE EDITED") {
          //  Show success message
          const msg = document.createElement('div');
          msg.setAttribute('class', 'success tips');
          msg.innerHTML = 'Saved new changes on your note !';
          document.body.appendChild(msg);
          hideMsg(msg);
          getNotes();
          toggleNoteList(); // I added this to toggle page content everytime there is a saved edit
        }
        input.value = '';
        textarea.value = '';
        saveBtn.style = 'display:block';
        saveChange.style = 'display:none';
        cancelBtn.style = "display:none";
      }
    }
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(data);
  } else {
    const msg = document.createElement('div');
    msg.setAttribute('class', 'error tips');
    msg.innerHTML = 'Sorry, cannot save changes !';
    document.body.appendChild(msg);
    hideMsg(msg);
  }
}
cancelBtn.addEventListener('click', cancel);
function cancel() {
  input.value = '';
  textarea.value = "";
  cancelBtn.style = 'display:none';
  saveChange.style = 'display:none';
  saveBtn.style = 'display:block';
}
// DeleteNote
function deleteNote(id) {
  const elementToDelete = document.getElementById(id),
    modal = document.querySelector('.confirm-modal');
  modal.classList.add('show-modal');
  document.querySelector('.modal .buttons .yes').addEventListener('click', () => {
    const url = './CRUD/deleteNotes.php',
      xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status === 200) {
        const result = JSON.parse(xhr.responseText);
        if (result === "NOTE DELETED") {
          console.log(result);
          modal.classList.remove('show-modal');
          //  Show success message
          const msg = document.createElement('div');
          msg.setAttribute('class', 'success tips');
          msg.innerHTML = 'Note deleted !';
          setTimeout(() => {
            document.body.appendChild(msg);
            hideMsg(msg);
          }, 1000);
          getNotes();
        }
      }
    }
    const data = `&noteID=${id}&delete=delete`;
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(data);
    elementToDelete.remove();
  })
  document.querySelector('.modal .buttons .no').addEventListener('click', () => {
    modal.classList.remove('show-modal');
  })
}

// Design for mobile UI
const noteBtn = document.querySelector('.mobile-header div');
noteBtn.addEventListener('click', () => {
  toggleNoteList();
});

function toggleNoteList() {
  const notePage = document.querySelector('.box-homepage');
  if (noteBtn.classList.contains('your-notes')) {
    noteBtn.innerHTML = `
          </svg>
        <svg class="header-svg" xmlns="http://www.w3.org/2000/svg" fill="#fff" width="24" height="24"
        viewBox="0 0 24 24">
        <path
          d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9h-4v4h-2v-4H9V9h4V5h2v4h4v2z" />
        </svg>
        <span class="text">Add note</span>`;
    noteBtn.classList.replace('your-notes', 'add-note');
  } else {
    noteBtn.innerHTML = `
        <svg class="header-svg" xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 384 512">
          <path
            d="M336 64H282.121C268.896 26.799 233.738 0 192 0S115.104 26.799 101.879 64H48C21.5 64 0 85.484 0 112V464C0 490.516 21.5 512 48 512H336C362.5 512 384 490.516 384 464V112C384 85.484 362.5 64 336 64ZM96 392C82.75 392 72 381.25 72 368S82.75 344 96 344S120 354.75 120 368S109.25 392 96 392ZM96 296C82.75 296 72 285.25 72 272S82.75 248 96 248S120 258.75 120 272S109.25 296 96 296ZM192 64C209.674 64 224 78.326 224 96C224 113.672 209.674 128 192 128S160 113.672 160 96C160 78.326 174.326 64 192 64ZM304 384H176C167.199 384 160 376.799 160 368C160 359.199 167.199 352 176 352H304C312.801 352 320 359.199 320 368C320 376.799 312.801 384 304 384ZM304 288H176C167.199 288 160 280.799 160 272C160 263.199 167.199 256 176 256H304C312.801 256 320 263.199 320 272C320 280.799 312.801 288 304 288Z" />
        <span class="text">Your notes</span>`;
    noteBtn.classList.replace('add-note', 'your-notes');
  }
  notePage.classList.toggle('up');
}