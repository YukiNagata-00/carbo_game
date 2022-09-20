let items = document.querySelectorAll('.item');
let contents = document.querySelectorAll('.content');

items.forEach(clickedItem =>{

    clickedItem.addEventListener('click', () =>{
        items.forEach(item =>{
            item.classList.remove('active');
        })

        contents.forEach(content =>{
            content.classList.remove('active');
        })

        document.getElementById(clickedItem.dataset.id).classList.add('active');
        clickedItem.classList.add('active');
    });
})