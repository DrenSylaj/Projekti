document.addEventListener("DOMContentLoaded", function() {

    const slider = document.getElementById('slider');
    let scrollAmount = 1;

    function scrollSlider() {
        slider.style.transform = 'translateX(' + -scrollAmount + 'px)';
        scrollAmount++;

        if (scrollAmount > slider.scrollWidth / 2) {
            scrollAmount = 1;
        }

        requestAnimationFrame(scrollSlider);
    }
    scrollSlider();
    
    const body = document.querySelector("body");
    const nav = document.querySelector("nav");
    const modeToggle = document.querySelector(".dark-light");
    const searchToggle = document.querySelector(".searchToggle");
    const sidebarOpen = document.querySelector(".sidebarOpen");

    if (modeToggle) {
        modeToggle.addEventListener("click", function() {
            modeToggle.classList.toggle("active");
            body.classList.toggle("dark");

            if (!body.classList.contains("dark")) {
                localStorage.setItem("mode", "light-mode");
            } else {
                localStorage.setItem("mode", "dark-mode");
            }
        });
    }

    if (searchToggle) {
        searchToggle.addEventListener("click", function() {
            searchToggle.classList.toggle("active");
        });
    }

    if (sidebarOpen) {
        sidebarOpen.addEventListener("click", function() {
            nav.classList.add("active");
        });
    }

    if (body) {
        body.addEventListener("click", function(e) {
            let clickedElm = e.target;
            if (
                !clickedElm.classList.contains("sidebarOpen") &&
                !clickedElm.classList.contains("menu")
            ) {
                nav.classList.remove("active");
            }
        });
    }
});

function validateLoginForm() {
    var email = document.getElementById('signup_email').value;
    var name = document.getElementById('signup_username').value;
    var surname = document.getElementById('signup_surname').value;
    var password = document.getElementById('signup_password').value;

    if (name.trim() === '' || surname.trim() === '' || password.trim() === '' || email.trim()=== '') {
        alert('Please enter both username and password.');
        return false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!emailRegex.test(email)){
        return false;
    }

    return true;
}

function validateSignupForm() {
    var signupUsername = document.getElementById('signup-username').value;
    var signupEmail = document.getElementById('signup-email').value;
    var signupPassword = document.getElementById('signup-password').value;

    if (signupUsername.trim() === '' || signupPassword.trim() === '') {
        alert('Please fill in all required fields.');
        return false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(signupEmail)) {
        alert('Please enter a valid email address.');
        return false;
    }


    return true;
}


