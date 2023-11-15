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

