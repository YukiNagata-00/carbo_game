


const choices = document.querySelectorAll('.choice');

choices.forEach(clickedChoice => {
    clickedChoice.addEventListener('click', ()=>{
        // console.log(clickedChoice.parentNode);
        clickedChoice.parentNode.submit();
    })
})