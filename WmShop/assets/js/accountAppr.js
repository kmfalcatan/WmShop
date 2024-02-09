function changeColor(button) {
    console.log("Button clicked!");
    // Reset the background color of all buttons
    var filters = document.querySelectorAll('.filter1');
    filters.forEach(function(filter) {
        filter.style.backgroundColor = '';
    });

    button.style.backgroundColor = 'rgb(124, 124, 124)';
}