const nav = document.getElementById("nav-links");
const navLinks = document.getElementById("navbar-nav");
const menuBtn = document.getElementById("menu-btn");
const menuBtnIcon = menuBtn.querySelector("i");

menuBtn.addEventListener("click", (e) => {
  console.log("hello");
  navLinks.classList.toggle("open");

  const isOpen = navLinks.classList.contains("open");
  menuBtnIcon.setAttribute(
    "class",
    isOpen ? "bi bi-x fa-2x" : "bi bi-list fa-2x"
  );

   
  
  //nav.setAttribute(
    //"class",
    //isOpen ? "navbar navbar-expand-lg navbar-light bg-secondary position-fixed w-100 shadow-sm sticky-top p-3" : "navbar navbar-expand-lg navbar-light bg-transparent position-fixed w-100 shadow-sm sticky-top p-3"
  //);
});

navLinks.addEventListener("click", (e) => {
  navLinks.classList.remove("open");
  menuBtnIcon.setAttribute("class", "bi bi-list fa-2x");

  nav.setAttribute("class", "navbar navbar-expand-lg navbar-light bg-secondary position-fixed w-100 shadow-sm sticky-top p-3");
});

 /* Change navbar background on scroll
        window.addEventListener('scroll', function() {
            const navcontact = document.querySelector('.contact-bar');
            if (window.scrollY > 50) {
                navcontact.classList.add('d-none');
                navcontact.classList.remove('d-block');
            } else {
                navcontact.classList.add('d-block');
                navcontact.classList.remove('d-none');
            }
        });*/

        window.addEventListener('scroll', function() {
            if (window.scrollY > 600) {
                nav.classList.add('transports-bg-blue');
                nav.classList.remove('bg-transparent');
            } else {
                nav.classList.add('bg-transparent');
                nav.classList.remove('transports-bg-blue');
            }
        });


       
    // Dados dos depoimentos (adapte conforme necessário)
    const depoimentos = [
      {
        quote: "The team at Lalgy goes above and beyond. They understand our needs and always deliver on their promises. A true partner in our success.",
        name: "João Silva",
        role: "Logistics Coordinator",
        company: "Mozal Aluminium",
        avatar: "J"
      },
      {
        quote: "Their attention to detail and proactive communication keeps our projects on track. Highly recommended.",
        name: "Ana Costa",
        role: "Project Manager",
        company: "TechNova",
        avatar: "A"
      },
      {
        quote: "Professional, responsive and results-driven. They helped us scale quickly with minimal friction.",
        name: "Carlos Mendez",
        role: "Operations Lead",
        company: "Delta Systems",
        avatar: "C"
      }
    ];

    // Elementos
    const quoteEl = document.getElementById('quote-text');
    const avatarEl = document.getElementById('avatar');
    const nameEl   = document.querySelector('.name');
    const roleEl   = document.querySelector('.role');
    const companyEl= document.querySelector('.company');
    const prevBtn    = document.getElementById('prevBtn');
    const nextBtn    = document.getElementById('nextBtn');
    const dots       = document.querySelectorAll('#dots .dot');

    let index = 0;

    function render(index){
      const d = depoimentos[index];
      quoteEl.textContent = d.quote;
      avatarEl.textContent = d.avatar;
      // Realtime: atualiza nome/role/empresa
      nameEl.textContent  = d.name;
      roleEl.textContent  = d.role;
      companyEl.textContent = d.company;

      // Atualiza dots
      dots.forEach((dot,i)=> dot.classList.toggle('active', i===index));
    }

    // Inicia
    render(index);

    // Eventos
    prevBtn.addEventListener('click', () => {
      index = (index - 1 + depoimentos.length) % depoimentos.length;
      render(index);
    });

    nextBtn.addEventListener('click', () => {
      index = (index + 1) % depoimentos.length;
      render(index);
    });

    // Dots interativos
    dots.forEach(dot => {
      dot.addEventListener('click', (e) => {
        const i = Number(dot.dataset.index);
        index = i;
        render(index);
      });
    });

    // Opcional: teclado
    document.addEventListener('keydown', (e) => {
      if(e.key === 'ArrowLeft') { index = (index - 1 + depoimentos.length) % depoimentos.length; render(index); }
      if(e.key === 'ArrowRight'){ index = (index + 1) % depoimentos.length; render(index); }
    });
 
