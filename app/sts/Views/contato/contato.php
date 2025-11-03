<?php
if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->dados['form'])) {
    $valueForm = $this->dados['form'];
    extract($valueForm);
}
?>

<div class="jumbotron head-contato py-5 bg-olamuhk-blue ">
    <div class="container pt-5 ">


        <div class="col-12 m-auto">
            <div class="row g-0  overflow-hidden flex-md-row mb-4  position-relative">
                <div class="col-12 col-md-6 p-4 d-flex flex-column position-static"> <strong
                        class="mb-2 text-olamuhk-orange">
                        <h1 class="display-3 fw-bold">Contacto</h1>
                    </strong>

                    <p class="card-text mb-auto text-dark">Este é o espaço ideal para partilhar as suas dúvidas,
                        sugestões ou até
                        mesmo solicitar ajuda. Preencha o formulário abaixo ou entre em contacto através dos nossos
                        canais de atendimento. A nossa equipa está pronta para oferecer um atendimento de excelência e
                        garantir a sua total satisfação.<br>
                        <a href="#contact-form" class="btn btn-outline-success mt-4">
                            Contacte-nos >>>
                        </a>
                    </p>
                </div>
                <div class="col-100 d-lg-block col-md-6" width="500px"> <img class="w-75 d-block rounded-5 mx-auto"
                        src="<?php echo URL."app/sts/assets/images/contact/contact_1.jpg"?>">
                </div>
            </div>
        </div>
    </div>
</div>

<h1 class="title-hero text-center  fw-bold"> Os Nossos Contactos </h1>
<section class="container my-5 shadow rounded-3">
    <div class="contact-card p-4">
        <div class="row g-0 align-items-center py-0 ">
            <!-- WhatsApp -->
            <div
                class="col-12 col-md-4  d-flex align-items-center justify-content-center justify-content-md-start mb-3 mb-md-0">
                <div class="contact-item w-100 ps-5">
                    <div class="contact-icon rounded-circle text-success "><i class="bi bi-whatsapp display-5 "></i></div>
                    <div class="flex-grow-1">
                        <div class="fw-bold text-dark">WhatsApp</div>
                        <div class="text-muted small">+258 (84/87) 1234567</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0"> 
                <div class="contact-item w-100 ps-5 text-warning">
                    <div class="contact-icon " aria-label="Email"><i class="bi bi-envelope display-5"></i></div>
                    <div class="flex-grow-1 ">
                        <div class="fw-bold text-dark ">Email</div>
                        <div class="text-muted small">info@racocaro.com</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-end"> 
                <div class="contact-item w-100 ps-5 text-primary">
                    <div class="contact-icon" aria-label="Telefone"><i class="bi bi-telephone display-5"></i></div>
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
    <div class="container px-0 rounded-5 py-0" style="box-shadow: 20px 0.5px 70px 0.5px rgb(0,0,0,.3);">
        <div class="row featurette  rounded-5" >
            
            <?php
            extract($this->dados['address']);
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
                        <input name="name" type="text" class="form-control p-3 border-0 border-bottom" id="name" placeholder="Nome completo" value="<?php
                        if (isset($name)) {
                            echo $name;
                        }
                        ?>" required>
                    </div>

                    <div class="form-group px-3 py-2">
                        <input name="email" type="email" class="form-control p-3 border-0 border-bottom" id="email" placeholder="Seu melhor e-mail"
                            value="<?php
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