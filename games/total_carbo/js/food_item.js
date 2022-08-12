let item = document.querySelector('.item');

// const checking = setInterval(()=>{
//     moving();
//     let x = item.getBoundingClientRect().left;
//     console.log(x);
//     if(x == 0){
//         clearInterval(checking);
//     }
// }, 3000);


const moving = () => {
    item.animate(
    [
        { transform: 'translateX(2000px)' },
        { transform: 'translateX(-2000px)' }
    ],
    {
        duration: 4000,
        iterations: 1
    }
    )
};

// console.log(item.getBoundingClientRect().left);