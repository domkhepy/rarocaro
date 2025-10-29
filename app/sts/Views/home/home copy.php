<?php
if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
//Ler o registro da página home retornado do banco de dados
//A função extract é utilizado para extrair o array e imprimir através do nome da chave

?>
<!-- Hero / Section: Consulta de serviço principal -->
<header class="hero d-flex align-items-center text-white"
    style="background: url('<?php echo URL."app/sts/assets/images/home/bg-head.jpeg";?>') center/cover no-repeat;">

    <div class="container py-80">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h1 class="display-4 fw-bold mb-3">TOU RARO<br>
                    TOU CARO</h1>
                <p class="lead mb-4 ">T-Shirts Premium<br> Criadas para Quem Exige Excelência</p>

                <a href="#contact-form " class="btn btn-outline-light mt-4 rounded-0 p-3 pe-5 fw-bold">
                            Personalizar >>>
                        </a>
            </div>
            <div class="col-md-5 d-none d-md-block">
                <div class="card bg-dark text-white border-0" style="opacity:.70;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Nossos Serviços</h5>
                        <p class="card-text">Venda • T-Shirts • Entrega</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Benefícios / Serviços -->
<section id="servicos" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold display-4">Nossas Coleções</h2>
            <span class="section-underline" aria-hidden="true"></span>
            <p class="text-muted mt-4">Cada coleção conta uma história única de artesanato e design
                </p>
        </div>

        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo URL."app/sts/assets/images/collection/t1.jpeg";?>"
                        class="card-img-top" alt="Transporte" />
                    <div class="card-body">
                        <h5 class="card-title">Transporte</h5>
                        <p class="card-text text-muted">Transporte em longa e curta distância com frota moderna.</p>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo URL."app/sts/assets/images/collection/t2.jpeg";?>"
                        class="card-img-top" alt="Armazenagem" />
                    <div class="card-body">
                        <h5 class="card-title">Warehousing</h5>
                        <p class="card-text text-muted">Gestão de armazéns com tecnologia de ponta.</p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo URL."app/sts/assets/images/collection/t3.jpeg";?>"
                        class="card-img-top" alt="Mining Support" />
                    <div class="card-body">
                        <h5 class="card-title">Mining Support</h5>
                        <p class="card-text text-muted">Suporte logístico para operações de mineração.</p>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo URL."app/sts/assets/images/collection/t4.jpeg";?>"
                        class="card-img-top" alt="Earthworks" />
                    <div class="card-body">
                        <h5 class="card-title">Earthworks</h5>
                        <p class="card-text text-muted">Serviços de terraplenagem com eficiência e segurança.</p>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo URL."app/sts/assets/images/collection/t1.jpeg";?>"
                        class="card-img-top" alt="Project Logistics" />
                    <div class="card-body">
                        <h5 class="card-title">Project Logistics</h5>
                        <p class="card-text text-muted">Logística de projetos com planejamento detalhado.</p>
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo URL."app/sts/assets/images/collection/t5.jpeg";?>"
                        class="card-img-top" alt="Supply Chain" />
                    <div class="card-body">
                        <h5 class="card-title">Supply Chain</h5>
                        <p class="card-text text-muted">Soluções integradas para toda a cadeia de suprimentos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projetos -->
<section id="projetos" class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold display-4">Destaques</h2>
            <p class="text-muted">Descubra a nossa seleção criteriosa de t-shirts premium que definem o luxo moderno</p>
        </div>

        <div class="row g-4">
            <!-- Projeto 1 -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo URL."app/sts/assets/images/collection/t3.jpeg";?>" class="card-img-top" alt="Projeto 1" />
                    <div class="card-body">
                        <h5 class="card-title">Transporte de materiais de construção rodoviária</h5>
                        <p class="card-text text-muted">Transporte de materiais de construção rodoviária.</p>
                    </div>
                </div>
            </div>
            <!-- Projeto 2 -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo URL."app/sts/assets/images/collection/t1.jpeg";?>" class="card-img-top" alt="Projeto 2" />
                    <div class="card-body">
                        <h5 class="card-title">Mining Equipment Relocation</h5>
                        <p class="card-text text-muted">Readequação de equipamentos de mineração com segurança.</p>
                    </div>
                </div>
            </div>
            <!-- Projeto 3 -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo URL."app/sts/assets/images/collection/t2.jpeg";?>" class="card-img-top" alt="Projeto 3" />
                    <div class="card-body">
                        <h5 class="card-title">Port to Site Distribution Network</h5>
                        <p class="card-text text-muted">Rede de distribuição portos->obras com eficiência.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Depoimentos -->
<section class="section" id="what-our-clients-say" style="background: #0b1a2b;">
    <h2 class="section-title">O que nossos clientes dizem</h2>
    <span class="section-underline" aria-hidden="true"></span>
    <div class="section-subtitle">Trusted by leading companies across Mozambique</div>

    <!-- Cartão de depoimento (carousel simples) -->
    <div class="carousel" aria-label="Depoimento de cliente">
        <p class="quote" id="quote-text">
            "The team at Lalgy goes above and beyond. They understand our needs and always deliver on their promises. A
            true partner in our success."
        </p>

        <div class="testimonial" aria-label="Depoimento do cliente">
            <div class="avatar" id="avatar">J</div>
            <div class="person">
                <div class="name">João Silva</div>
                <span class="role">Logistics Coordinator</span>
                <span class="company">Mozal Aluminium</span>
            </div>
        </div>
    </div>

    <!-- Controles -->
    <div class="controls" aria-label="Navegação de depoimentos">
        <button class="ctrl-btn" id="prevBtn" title="Anterior" aria-label="Anterior">
            ‹
        </button>

        <ul class="dots" id="dots" aria-label="Indicadores de depoimento">
            <!-- preenchidos dinamicamente -->
            <li class="dot active" data-index="0"></li>
            <li class="dot" data-index="1"></li>
            <li class="dot" data-index="2"></li>
        </ul>

        <button class="ctrl-btn" id="nextBtn" title="Próximo" aria-label="Próximo">
            ›
        </button>
    </div>
</section>





<h1 class="title-hero text-center my-5 fw-bold display-4 " id="faleconosco"> Os Nossos Contactos </h1>
<section class="container my-5 shadow rounded-3">
    <div class="contact-card p-4">
        <div class="row g-0 align-items-center py-3">
            <!-- WhatsApp -->
            <div
                class="col-12 col-md-4  d-flex align-items-center justify-content-center justify-content-md-start mb-3 mb-md-0">
                <div class="contact-item w-100 ps-5">
                    <div class="contact-icon rounded-circle"><i class="bi bi-whatsapp display-5 text-success"></i></div>
                    <div class="flex-grow-1">
                        <div class="fw-bold text-dark">WhatsApp</div>
                        <div class="text-muted small">+258 (84/87) 1234567</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0">
                <div class="contact-item w-100 ps-5">
                    <div class="contact-icon " aria-label="Email"><i
                            class="bi bi-envelope display-5 transports-text-orange"></i></div>
                    <div class="flex-grow-1 ">
                        <div class="fw-bold text-dark ">Email</div>
                        <div class="text-muted small">info@tourarotoucaro.com</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-end">
                <div class="contact-item w-100 ps-5">
                    <div class="contact-icon" aria-label="Telefone"><i
                            class="bi bi-telephone display-5 transports-text-blue"></i></div>
                    <div class="flex-grow-1">
                        <div class="fw-bold text-dark">Telefone</div>
                        <div class="text-muted small">+258 (84/87) 1234567</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="jumbotron contato py-5 ">
    <div class="container px-0 rounded-5">
        <div class="row featurette  rounded-5">

            <?php
            if(isset($this->dados['address'])) extract($this->dados['address']);
            ?>
            <div class="col-md-6 ">
                <img class="w-100 h-100 d-block rounded-5 mx-auto "
                    src="<?php echo URL."app/sts/assets/images/contact/contact_2.jpg"?>">
            </div>
            <div class="col-md-6 mb-4 ">
                <?php
                 if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
                <form method="POST" action="" class=" p-3 h-100 w-100 " id="contact-form">
                    <h1 class="title-hero text-center my-3 fw-bold"> Preencha o Formulário</h1>
                    <div class="form-group px-3 py-2">
                        <input name="name" type="text" class="form-control p-3 border-0 border-bottom" id="name"
                            placeholder="Nome completo" value="<?php
                        if (isset($name)) {
                            echo $name;
                        }
                        ?>" required>
                    </div>

                    <div class="form-group px-3 py-2">
                        <input name="email" type="email" class="form-control p-3 border-0 border-bottom" id="email"
                            placeholder="Seu melhor e-mail" value="<?php
                        if (isset($email)) {
                            echo $email;
                        }
                        ?>" required>
                    </div>

                    <div class="form-group px-3 py-2">
                        <input name="subject" type="text" class="form-control p-3 border-0 border-bottom" id="subject"
                            placeholder="Assunto da mensagem" value="<?php
                        if (isset($subject)) {
                            echo $subject;
                        }
                        ?>" required>
                    </div>

                    <div class="form-group px-3 py-2">
                        <textarea name="content" class="form-control" id="content" rows="3"
                            placeholder="Conteúdo da mensagem" required><?php
                            if (isset($content)) {
                                echo $content;
                            }
                            ?></textarea>
                    </div>

                    <button name="CreatContMsg" value="CreatContMsg" type="submit"
                        class="btn btn-primary w-75 d-block mx-auto p-3 mt-3">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>