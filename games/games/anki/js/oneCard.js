// alert("hi");

const card = document.getElementById("card");
const  carbo = document.getElementById('carbo');
const  img = document.getElementById('img');


card.addEventListener("click", ()=>{

    if(carbo.classList.contains("off")){
        // console.log("off");
        carbo.classList.remove("off");
        img.classList.add("off");
    }else{
        // console.log("on");
        carbo.classList.add("off");
        img.classList.remove("off");
    }


}
);