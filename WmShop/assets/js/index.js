function toggleContainers(signInContainer, signUpContainer) {
    var container1 = document.querySelector('.' + signInContainer);
    var container2 = document.querySelector('.' + signUpContainer);

    container1.style.display = (container1.style.display === "none" || container1.style.display === "") ? "block" : "none";
    container2.style.display = (container2.style.display === "none" || container2.style.display === "") ? "block" : "none";

    if (container1.style.display === "none" || container1.style.display === "") {
        container1.style.display = "block";
        container2.style.display = "none";
    } else if (container2.style.display === "none" || container2.style.display === "") {
        container2.style.display = "block";
        container1.style.display = "none";
    } else {
        // Additional code if needed...
    }
}
