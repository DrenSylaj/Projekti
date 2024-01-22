function validateLoginForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (email.trim() === '' || password.trim() === '') {
        alert('Please enter both email and password.');
        return false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!emailRegex.test(email)){
        alert('Please enter a valid email adress.');
        return false;
    }

    return true;
}

function validateSignupForm() {
    var signupName = document.getElementById('signup_name').value;
    var signupSurname = document.getElementById('signup_surname').value;
    var signupEmail = document.getElementById('signup_email').value;
    var signupPassword = document.getElementById('signup_password').value;

    if (signupName.trim() === '' || signupSurname.trim() === '' || signupPassword.trim() === '') {
        alert('Please fill in all required fields.');
        return false;
    }

    if(signupPassword.length < 8){
      alert('Password must be at least 8 characters long');
      return false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(signupEmail)) {
        alert('Please enter a valid email address.');
        return false;
    }


    return true;
}

const wrapper = document.querySelector(".wrapper"),
signupHeader = document.querySelector(".signup header"),
loginHeader = document.querySelector(".login header");
loginHeader.addEventListener("click", () => {
    wrapper.classList.add("active");
    });
        signupHeader.addEventListener("click", () => {
          wrapper.classList.remove("active");
        });