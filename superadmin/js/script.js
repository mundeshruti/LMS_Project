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

   document.querySelector('#fas fa-expand').onclick = () => {
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

function sendNotificationBySuperadmin(pageNumber) {
    console.log('sendNotification function called');
    
    // Get values from the HTML form
    var recipientType = document.getElementById('recipient-type').value;
    var recipient = document.getElementById('recipient').value;
    var message = document.getElementById('notification-message').value.trim();

    // Validate the message
    if (!message) {
        alert('Please enter a notification message.');
        return;
    }

    // Make an AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'superadmin_insert_notification.php?page=' + pageNumber, true); // Pass pageNumber for pagination
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

    // Send the request with the necessary data
    xhr.send('admin_id=' + encodeURIComponent(recipientType) + '&course_id=' + encodeURIComponent(recipient) + '&message=' + encodeURIComponent(message));
}
