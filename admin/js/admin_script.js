let body = document.body;

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("notifications-btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   searchForm.classList.remove('active');
}

let searchForm = document.querySelector('.header .flex .search-form');

document.querySelector('#search-btn').onclick = () =>{
   searchForm.classList.toggle('active');
   profile.classList.remove('active');
}

let sideBar = document.querySelector('.side-bar');

document.querySelector('#menu-btn').onclick = () =>{
   sideBar.classList.toggle('active');
   body.classList.toggle('active');
}

document.querySelector('.side-bar .close-side-bar').onclick = () =>{
   sideBar.classList.remove('active');
   body.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   searchForm.classList.remove('active');

   if(window.innerWidth < 1200){
      sideBar.classList.remove('active');
      body.classList.remove('active');
   }

}

let toggleBtn = document.querySelector('#toggle-btn');
let darkMode = localStorage.getItem('dark-mode');

const enabelDarkMode = () =>{
   toggleBtn.classList.replace('fa-sun', 'fa-moon');
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   toggleBtn.classList.replace('fa-moon', 'fa-sun');
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}


toggleBtn.onclick = (e) =>{
   let darkMode = localStorage.getItem('dark-mode');
   if(darkMode === 'disabled'){
      enabelDarkMode();
   }else{
      disableDarkMode();
   }
}

if(darkMode === 'enabled'){
   enabelDarkMode();
}
window.onload = function() {
   let toggleBtn = document.getElementById('toggle-btn');
   let body = document.body;
   let sideBar = document.querySelector('.side-bar');
   let profile = document.querySelector('.header .flex .profile');
   let search = document.querySelector('.header .flex .search-form');

   const enableDarkMode = () => {
       toggleBtn.classList.replace('fa-sun', 'fa-moon');
       body.classList.add('dark');
       localStorage.setItem('dark-mode', 'enabled');
   }

   const disableDarkMode = () => {
       toggleBtn.classList.replace('fa-moon', 'fa-sun');
       body.classList.remove('dark');
       localStorage.setItem('dark-mode', 'disabled');
   }

   if (localStorage.getItem('dark-mode') === 'enabled') {
       enableDarkMode();
   }

   toggleBtn.onclick = () => {
       if (localStorage.getItem('dark-mode') === 'disabled') {
           enableDarkMode();
       } else {
           disableDarkMode();
       }
   }

   document.querySelector('#user-btn').onclick = () => {
       profile.classList.toggle('active');
       search.classList.remove('active');
   }

   document.querySelector('#search-btn').onclick = () => {
       search.classList.toggle('active');
       profile.classList.remove('active');
   }

   document.querySelector('#menu-btn').onclick = () => {
       sideBar.classList.toggle('active');
       body.classList.toggle('active');
   };

   document.querySelector('#close-btn').onclick = () => {
       sideBar.classList.remove('active');
       body.classList.remove('active');
   }

   window.onscroll = () => {
       profile.classList.remove('active');
       search.classList.remove('active');

       if (window.innerWidth < 1200) {
           sideBar.classList.remove('active');
           body.classList.remove('active');
       }
   };
};

function sendNotificationByAdmin() {
    console.log('sendNotificationByAdmin function called');

    // Get the values from the HTML form
    var recipient = document.getElementById('recipient').value;
    var message = document.getElementById('notification-message').value.trim();

    // Validate the message
    if (!message) {
        alert('Please enter a notification message.');
        return;
    }

    // Make an AJAX request to admin_insert_notification.php
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'admin_insert_notification.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Handle the response from the server
                alert(xhr.responseText);
                // Reload the page after successful submission
                location.reload();
            } else {
                // Handle error
                alert('Error occurred while sending notification.');
            }
        }
    };
    xhr.send('course_id=' + encodeURIComponent(recipient) + '&message=' + encodeURIComponent(message));
}
