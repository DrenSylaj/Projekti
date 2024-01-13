document.addEventListener('DOMContentLoaded', function () {
    const heartIcons = document.querySelectorAll('.heart-icon');

    // Load heart states from local storage on page load
    heartIcons.forEach(icon => {
        const index = icon.dataset.index;
        const isFilled = localStorage.getItem(`heartState_${index}`);
        if (isFilled === 'filled') {
            icon.classList.add('filled');
        }
    });

    // Click event for hearts
    heartIcons.forEach(icon => {
        icon.addEventListener('click', function () {
            const index = this.dataset.index;
            const isFilled = this.classList.toggle('filled');
            
            // Save heart state to local storage
            localStorage.setItem(`heartState_${index}`, isFilled ? 'filled' : '');
        });
    });
});