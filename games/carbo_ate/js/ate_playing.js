let next_form =  document.getElementsByClassName('next_form');
let ans = document.getElementsByClassName('ans_content');
let btn = document.getElementById('input_btn');


function removeOff(){
    if(next_form.classList.contains("off") && ans.classList.contains("off")){
        next_form.classList.remove("off");
        ans.classList.remove("off");
    }else{
        next_form.classList.add("off");
        ans.classList.add("off");
    }
}
