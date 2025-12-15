let nextButton = document.getElementById('next');
let prevButton = document.getElementById('prev');
let carousel = document.querySelector('.carousel');
let listHTML = document.querySelector('.carousel .list');
let seeMoreButtons = document.querySelectorAll('.seeMore');
let backButton = document.getElementById('back');
let showImageDetail = document.getElementById('showImageDetail');
const nav = document.getElementById("nav-links");

const navLinks = document.getElementById("nav-links");
const menuBtn = document.getElementById("menu-btn");
const menuBtnIcon = menuBtn.querySelector("i");

const shopping_cart = document.getElementById("shopping-cart");
const cart_sidebar = document.getElementById("cartSidebar");
const close_cart = document.getElementById("close-cart");





if(typeof nextButton !== 'undefined' && nextButton !== null ){
nextButton.onclick = function(){
    showSlider('next');
}

prevButton.onclick = function(){
    showSlider('prev');
}
let unAcceppClick;
const showSlider = (type) => {
  showImageDetail.innerHTML = '';
    nextButton.style.pointerEvents = 'none';
    prevButton.style.pointerEvents = 'none';

    carousel.classList.remove('next', 'prev');
    
    let items = document.querySelectorAll('.carousel .list .item');
    if(type === 'next'){
        listHTML.appendChild(items[0]);
        carousel.classList.add('next');
      relatedProductImages.forEach((image) => {
        if(image.product_id == items[2].dataset.value){
          showImageDetail.innerHTML += `<img src='${URLADM}app/adms/assets/image/products/${image.product_id}/${image.name}' value='${image.product_id}' class='rounded mb-1 imageDetailList' width='40px' alt='Product Image'>`;
       
        }
        

        });

        document.querySelectorAll('.imageDetailList').forEach(inp => {

   
    
inp.addEventListener('click', (e) => {
  const currentImg = document.getElementById('product_img_'+e.target.getAttribute('value')).src;

  document.getElementById('product_img_'+e.target.getAttribute('value')).src = e.target.src;
  e.target.src = currentImg;

  

  });
   
  })
    }else{

        listHTML.prepend(items[items.length - 1]);

       
        carousel.classList.add('prev');
relatedProductImages.forEach((image) => {
        if(image.product_id == items[0].dataset.value){
          showImageDetail.innerHTML += `<img src='${URLADM}app/adms/assets/image/products/${image.product_id}/${image.name}'  value='${image.product_id}' class='rounded mb-1 imageDetailList' width='40px' alt='Product Image'>`;
        }
        
        });

         document.querySelectorAll('.imageDetailList').forEach(inp => {
    
inp.addEventListener('click', (e) => {
  const currentImg = document.getElementById('product_img_'+e.target.getAttribute('value')).src;

  document.getElementById('product_img_'+e.target.getAttribute('value')).src = e.target.src;
  e.target.src = currentImg;
  });
   
  })
    }
    clearTimeout(unAcceppClick);
    unAcceppClick = setTimeout(()=>{
        nextButton.style.pointerEvents = 'auto';
        prevButton.style.pointerEvents = 'auto';
    }, 2000)
}
seeMoreButtons.forEach((button) => {
    button.onclick = function(){

       document.getElementById('return').classList.remove('d-none');

 showImageDetail.innerHTML = '';
      relatedProductImages.forEach((image) => {
        if(image.product_id == button.value){
          showImageDetail.innerHTML += `<img src='${URLADM}app/adms/assets/image/products/${image.product_id}/${image.name}'   value='${image.product_id}' class='rounded mb-1 imageDetailList' width='40px' alt='Product Image'>`;
        
        
        }
        
        });

         document.querySelectorAll('.imageDetailList').forEach(inp => {
    
inp.addEventListener('click', (e) => {
  const currentImg = document.getElementById('product_img_'+e.target.getAttribute('value')).src;

  document.getElementById('product_img_'+e.target.getAttribute('value')).src = e.target.src;
  e.target.src = currentImg;
  
  });
   
  })
       
        carousel.classList.remove('next', 'prev');
        carousel.classList.add('showDetail');
        showImageDetail.classList.remove('showImageDetail');
        showImageDetail.classList.add('showImageDetailActive');
    }
});

if(typeof backButton !== 'undefined' && backButton !== null){
backButton.onclick = function(){
    carousel.classList.remove('showDetail');
}   
}   
}


/*nav menu*/
menuBtn.addEventListener("click", (e) => {

  navLinks.classList.toggle("open");

  const isOpen = navLinks.classList.contains("open");
  menuBtnIcon.setAttribute(
    "class",
    isOpen ? "bi bi-x-lg" : "bi bi-list"
  );

  isOpen ? nav.style.left="0px": nav.style.left="100%";


});

navLinks.addEventListener("click", (e) => {
  navLinks.classList.remove("open");
  menuBtnIcon.setAttribute("class", "bi bi-list");
});


/*carinha*/
shopping_cart.addEventListener("click", (e) => {
  cart_sidebar.classList.remove("d-none");
});
close_cart.addEventListener("click", (e) => {
  cart_sidebar.classList.toggle("d-none");
});



const list = document.getElementById('list');
const nextImg = document.getElementById('next');
const prevImg = document.getElementById('prev');

  // Configuração básica
    let index = 0;

    // Lógica de swipe simples (left/right)
    let startX = 0;
    let isDragging = false;

    const onPointerDown = (e) => {
      isDragging = true;
      startX = e.clientX;
      // Evita seleção de imagem durante o swipe
      //viewer.style.cursor = 'grabbing';
    };

    const onPointerMove = (e) => {
      if (!isDragging) return;
      // Podemos adicionar feedback visual aqui deslocando o slide atual/futuro
    };

    const onPointerUp = (e) => {
      if (!isDragging) return;
      const dx = e.clientX - startX;
      const threshold = 60; // sensibilidade do swipe
      if (dx < -threshold) {
        // swipe left -> próxima foto
        goNext();
      } else if (dx > threshold) {
        // swipe right -> foto anterior
        goPrev();
      }
      isDragging = false;
      //viewer.style.cursor = 'default';
    };

    const goNext = () => {
      nextImg.click();
    };

    const goPrev = () => {
      prevImg.click();
    };    

    // Event handlers
    if(typeof list !== 'undefined' && list !== null){
    list.addEventListener('pointerdown', onPointerDown);
    list.addEventListener('pointermove', onPointerMove);
    list.addEventListener('pointerup', onPointerUp);}

    // Opcional: mover com teclado (arrow keys)
    document.addEventListener('keydown', (e) => {
     
      if (e.key === 'ArrowLeft') goPrev();
      if (e.key === 'ArrowRight') goNext();
    });



     document.querySelectorAll('.nav_button').forEach(inp => {
    
inp.addEventListener('click', (e) => {
    e.classList.add('selectedPg');
  });
   
  })

   const currentPage = window.location.pathname.split("/").pop();


    const pages = {
      "": "home",
      "personalize": "personalizacao",
      "collection": "colecao",
      "contact": "contact"
    };



    if (pages[currentPage]) {
      document.getElementById(pages[currentPage]).classList.add("selectedPg");
    }

 document.querySelectorAll('.minimize').forEach( min => {
 
  min.addEventListener('click',()=>{
    
    document.querySelectorAll('.detail').forEach(inp => {
  inp.classList.add("d-none");
});
    
document.getElementById('maxmize').classList.remove("d-none")
  });
 }

 )



  

  document.getElementById('maxmize').addEventListener('click',()=>{
    document.querySelectorAll('.detail').forEach(inp => {
  inp.classList.remove("d-none");
});
document.getElementById('maxmize').classList.add("d-none")
  })



document.getElementById('return').addEventListener('click',()=>{
   carousel.classList.add('next', 'prev');
        carousel.classList.remove('showDetail');
        showImageDetail.classList.add('showImageDetail');
        showImageDetail.classList.remove('showImageDetailActive');

        document.getElementById('return').classList.add('d-none');
        document.getElementById('maxmize').classList.add('d-none');
        document.querySelectorAll('.detail').forEach(inp => {
  inp.classList.remove("d-none");
});
        
  })
     

