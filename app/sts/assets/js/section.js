//step 1: get DOM
let nextDom = document.getElementById('next');
let prevDom = document.getElementById('prev');

let car_ouselDom = document.querySelector('.car_ousel');
if(typeof car_ouselDom !== undefined && car_ouselDom !== null){
let SliderDom = car_ouselDom.querySelector('.car_ousel .li_st');
let thumbnailBorderDom = document.querySelector('.car_ousel .thumbnail');
let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.it_em');
let timeDom = document.querySelector('.car_ousel .time');

thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
let timeRunning = 3000;
let timeAutoNext = 7000;

if(check_section){
 document.getElementById('nav-links').style.color="#fff";
 document.getElementById('cart-icon').classList.remove("text-dark");
}

nextDom.onclick = function(){
    showSlider('next');    
}

prevDom.onclick = function(){
    showSlider('prev');    
}
let runTimeOut;
let runNextAuto = setTimeout(() => {
    next.click();
}, timeAutoNext)
function showSlider(type){
    let  SliderItemsDom = SliderDom.querySelectorAll('.car_ousel .li_st .it_em');
    let thumbnailItemsDom = document.querySelectorAll('.car_ousel .thumbnail .it_em');
    
    if(type === 'next'){
        SliderDom.appendChild(SliderItemsDom[0]);
        thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
        car_ouselDom.classList.add('next');
    }else{
        SliderDom.prepend(SliderItemsDom[SliderItemsDom.length - 1]);
        thumbnailBorderDom.prepend(thumbnailItemsDom[thumbnailItemsDom.length - 1]);
        car_ouselDom.classList.add('prev');
    }
    clearTimeout(runTimeOut);
    runTimeOut = setTimeout(() => {
        car_ouselDom.classList.remove('next');
        car_ouselDom.classList.remove('prev');
    }, timeRunning);

    clearTimeout(runNextAuto);
    runNextAuto = setTimeout(() => {
        next.click();
    }, timeAutoNext)

    
}
}