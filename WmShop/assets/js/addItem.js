const imageInput = document.getElementById('image');
const uploadedImage = document.getElementById('uploadedImage');
const imageContainer = document.getElementById('pictureContainer');

imageInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    const objectURL = URL.createObjectURL(file);
    uploadedImage.src = objectURL;
    imageContainer.style.display = 'block';
});