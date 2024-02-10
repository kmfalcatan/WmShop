function toggleChatContainer() {
    var chatContainer = document.querySelector('.chatContainer');
    chatContainer.style.display = (chatContainer.style.display === 'none' || chatContainer.style.display === '') ? 'block' : 'none';
}

function toggleSubContainer(event) {
    if (event && event.target.classList.contains('backIcon')) {
        var subContainer = document.querySelector('.chatContainer');
        subContainer.style.display = 'none';
    } else {
        // Clicked outside the backIcon, toggle subContainer
        var subContainer = document.querySelector('.subContainer');
        subContainer.style.display = 'block';
    }
}