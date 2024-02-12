var paragraphs = document.querySelectorAll('.status');
var buttonsCancel = document.querySelectorAll('.cancelButton'); 
var buttonRecieve = document.querySelectorAll('.recieveButton'); 

paragraphs.forEach(function(paragraph, index) {
    if (paragraph.textContent.includes('hakdog')) {
        buttonsCancel[index].style.display = 'block';
    } else{
      buttonsCancel[index].style.display = 'none';
    }

    if (paragraph.textContent.includes('OLD')) {
        buttonRecieve[index].style.display = 'block';
    } else{
      buttonRecieve[index].style.display = 'none';
    }
});
