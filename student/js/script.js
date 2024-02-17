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
 

 function updateUnreadNotifications() {
    console.log('update Notification function called');

    // Make an AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_unread_notification.php',true); // Pass pageNumber for pagination
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Reload the page after successful submission
                location.reload();
            } else {
                // Handle error
                alert('Error occurred while sending notification.');
            }
        }
    };

    // Send the request with the necessary data
    xhr.send();
}