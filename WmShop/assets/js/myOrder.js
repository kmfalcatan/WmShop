var paragraphs = document.querySelectorAll('.status');
var buttonsCancel = document.querySelectorAll('.cancelButton'); 
var buttonRecieve = document.querySelectorAll('.recieveButton'); 

paragraphs.forEach(function(paragraph, index) {
  console.log('Status:', paragraph.textContent); // Add this line for debugging

    if (paragraph.textContent.includes('Pending')) {
        buttonsCancel[index].style.display = 'block';
    } else{
      buttonsCancel[index].style.display = 'none';
    }
});
