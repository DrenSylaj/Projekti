document.addEventListener("DOMContentLoaded", function() {

    const slider = document.getElementById('slider');
    let scrollAmount = 1;

    function scrollSlider() {
        slider.style.transform = 'translateX(' + -scrollAmount + 'px)';
        scrollAmount++;

        // Reset to the beginning when reaching the end
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

function openLoginForm() {
    document.getElementById("formTitle").innerText = "Login";
    document.getElementById("signupLink").style.display = "block";
    document.getElementById("loginContainer").style.display = "flex";
}

function closeLoginForm() {
    document.getElementById("formTitle").innerText = "Login";
    document.getElementById("signupLink").style.display = "block";
    document.getElementById("loginContainer").style.display = "none";
}

function openSignupForm() {
    document.getElementById("formTitle").innerText = "Sign Up";
    document.getElementById("signupLink").style.display = "none";
    document.getElementById("loginContainer").style.display = "none";
    document.getElementById("signupContainer").style.display = "flex";
}

function closeSignupForm() {
    document.getElementById("formTitle").innerText = "Login";
    document.getElementById("signupLink").style.display = "block";
    document.getElementById("loginContainer").style.display = "flex";
    document.getElementById("signupContainer").style.display = "none";
}

function validateLoginForm() {
    var username = document.getElementById("custom-username").value;
    var password = document.getElementById("custom-password").value;

    if (username.trim() === "" || password.trim() === "") {
        alert("Username and password are required for login.");
        return false;
    }


    return true;
}

function validateSignupForm() {
    var username = document.getElementById("signup-username").value;
    var email = document.getElementById("signup-email").value;
    var password = document.getElementById("signup-password").value;

    if (username.trim() === "" || email.trim() === "" || password.trim() === "") {
        alert("All fields are required for sign-up.");
        return false;
    }

    // Validate email format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true;
}
