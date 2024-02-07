function toggleMenu(menuIcon) {
    menuIcon.classList.toggle("change")
}

const popup = document.querySelector('.productContainer');
const toggleElements = document.querySelectorAll('.subItemContainer');

function show() {
    popup.style.display = 'block';
}

toggleElements.forEach(function(container) {
    container.addEventListener('click', show);
});


const header = document.querySelector('.menubarContainer');
const navbar = document.querySelector('.sideNavBarContainer');

header.addEventListener('click', function(){
    if(navbar.classList === 'fadeIn'){
        navbar.classList.remove('fadeIn');
    } else{
        navbar.classList.toggle('fadeIn');
    }
});

function changeColor(button) {
    // Reset the background color of all buttons
    var filters = document.querySelectorAll('.filter');
    filters.forEach(function(filter) {
        filter.style.backgroundColor = '';
    });

    button.style.backgroundColor = 'rgb(124, 124, 124)'; 
}