function toggleChatContainer(studentName, studentID) {
    var chatContainer = document.querySelector('.chatContainer');
    chatContainer.style.display = 'block'; // Show the chat container

    // Set the studentID value in the hidden input field
    document.getElementById('studentID').value = studentID;

    // Update the student's name in the chat header
    var chatHeader = document.querySelector('.studentChat p');
    chatHeader.textContent = studentName;

    // You can optionally load previous messages related to this student here
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
