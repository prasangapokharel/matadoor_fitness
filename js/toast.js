// Show toast message if status parameter is present in URL
window.addEventListener('load', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const toast = document.getElementById('toast');

    if (status === 'success') {
        toast.textContent = 'Registration successful!';
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000); // Hide toast after 3 seconds
    } else if (status === 'error') {
        toast.textContent = 'Registration failed. Please try again.';
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000); // Hide toast after 3 seconds
    }
});
