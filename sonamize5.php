<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hotmart — Landing clone</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root{
      --brand-orange: #ff5a1f; /* close to Hotmart */
      --dark-bg: #0b0b0b;
      --muted: #e6e6e6;
    }
    body{font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; color:#fff; background:var(--dark-bg);}
    a{color:var(--brand-orange);}
    .hero{background: linear-gradient(180deg, rgba(255,90,31,0.12), transparent 40%), var(--dark-bg); padding:4.5rem 0;}
    .brand-bar{background:#000;padding:.5rem 0}
    .brand-bar .logo{color:var(--brand-orange);font-weight:700}
    .card-cta{background:#111;padding:1.2rem;border-radius:.5rem}
    .btn-primary{background:var(--brand-orange);border:0}
    .muted{color:#bdbdbd}
    .stats{color:var(--muted)}
    .section-light{background:#0f0f0f;padding:3rem 0}
    .feature-card{background:#0b0b0b;border:1px solid rgba(255,255,255,0.04);padding:1rem;border-radius:.5rem}
    .playbox{background:#3a1d12;height:320px;border-radius:.5rem;display:flex;align-items:center;justify-content:center}
    footer{background:#070707;padding:3rem 0;color:#cfcfcf}
    .faq .accordion-button{background:transparent;color:#fff}
    @media (max-width:767px){
      .hero{padding:3rem 0}
      .playbox{height:200px}
    }
  </style>
</head>
<body>
  <!-- Top bar / header -->
  <div class="brand-bar">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="logo">Hotmart</div>
      <div class="d-none d-md-flex gap-4 muted">
        <a href="#">Produtos</a>
        <a href="#">Comprar</a>
        <a href="#">Entrar</a>
      </div>
    </div>
  </div>

  <!-- HERO -->
  <section class="hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7 text-white">
          <h1 class="display-6 fw-bold">Fazemos tudo para o seu negócio digital acontecer.</h1>
          <p class="lead text-white-50">Crie, venda e escale seu produto digital com a melhor plataforma para empreendedores.</p>
          <div class="d-flex gap-3 align-items-center mt-4">
            <button class="btn btn-primary btn-lg">Quero começar</button>
            <a href="#" class="muted">Saiba mais</a>
          </div>

          <div class="row stats mt-5">
            <div class="col-4">
              <div class="h3 mb-0">+ 30 Bilhões</div>
              <div class="muted">em transações</div>
            </div>
            <div class="col-4">
              <div class="h3 mb-0">+ 25 Milhões</div>
              <div class="muted">de usuários</div>
            </div>
            <div class="col-4">
              <div class="h3 mb-0">200 Mil</div>
              <div class="muted">criadores</div>
            </div>
          </div>
        </div>

        <!-- CTA card form -->
        <div class="col-lg-5 mt-4 mt-lg-0">
          <div class="card-cta text-dark">
            <h5 class="mb-3">Crie sua conta grátis. É rápido</h5>
            <form>
              <div class="mb-2"><input class="form-control" placeholder="Seu nome" required></div>
              <div class="mb-2"><input class="form-control" type="email" placeholder="E-mail" required></div>
              <div class="mb-2"><input class="form-control" type="password" placeholder="Senha" required></div>
              <button class="btn btn-primary w-100">Criar conta grátis</button>
            </form>
            <small class="muted d-block mt-2">Ao criar você concorda com os termos.</small>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Community / social proof -->
  <section class="section-light">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h3>Cresça ao lado dos melhores.</h3>
          <p class="muted">Faça parte da comunidade que lidera o digital.</p>
          <button class="btn btn-outline-light">Conhecer comunidade</button>
        </div>
        <div class="col-md-6 d-flex gap-3 justify-content-center">
          <img src="https://via.placeholder.com/160x320" class="img-fluid rounded shadow-sm" alt="perfil">
          <img src="https://via.placeholder.com/160x320" class="img-fluid rounded shadow-sm" alt="perfil2">
        </div>
      </div>
    </div>
  </section>

  <!-- Cards / features -->
  <section class="container my-5">
    <h4 class="text-white mb-4">Seu próximo passo no digital acontece aqui. E o próximo. E o próximo...</h4>
    <div class="row g-3">
      <div class="col-md-4">
        <div class="feature-card">
          <img src="https://via.placeholder.com/600x360" class="img-fluid mb-3" alt="">
          <h6>Crie e venda</h6>
          <p class="muted small">Ferramentas para publicar e vender seus produtos digitais.</p>
          <a href="#">Saiba mais →</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card">
          <img src="https://via.placeholder.com/600x360" class="img-fluid mb-3" alt="">
          <h6>Gerencie sua audiência</h6>
          <p class="muted small">Automação, funis e métricas para aumentar conversões.</p>
          <a href="#">Saiba mais →</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card">
          <img src="https://via.placeholder.com/600x360" class="img-fluid mb-3" alt="">
          <h6>Monetize</h6>
          <p class="muted small">Diversas formas de monetização para seus conteúdos.</p>
          <a href="#">Saiba mais →</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Video / AI claim -->
  <section class="container my-5">
    <div class="row">
      <div class="col-lg-8">
        <h5>A primeira (e única no Brasil) integrada com inteligência artificial para negócios digitais.</h5>
        <p class="muted">Descubra como nossa IA ajuda na criação e recomendação de conteúdos.</p>
        <div class="playbox my-3">
          <button class="btn btn-outline-light">▶ Assistir vídeo</button>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="feature-card">
          <h6>Você foca no conteúdo.</h6>
          <p class="muted small">E a Hotmart aumenta suas conversões.</p>
          <a href="#">Conhecer soluções</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Conversion focus section -->
  <section class="container my-5">
    <div class="row g-4 align-items-stretch">
      <div class="col-lg-5">
        <div class="h-100 p-4 rounded" style="background:#000;border:1px solid rgba(255,255,255,.08)">
          <h3 class="fw-bold">Você foca no conteúdo.<br><span style="color:var(--brand-orange)">E a Hotmart aumenta suas conversões.</span></h3>
          <a href="#" class="btn btn-primary btn-lg mt-4">Vender mais agora</a>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="position-relative h-100 rounded overflow-hidden">
          <img src="https://via.placeholder.com/900x500" class="w-100 h-100" style="object-fit:cover" alt="checkout">
          <div class="position-absolute bottom-0 start-0 p-4" style="background:linear-gradient(0deg,rgba(0,0,0,.7),transparent)">
            <h5 class="fw-bold">+7% em vendas com nosso preenchimento automático.</h5>
            <p class="small mb-0">Seu cliente compra rápido com o nosso checkout que preenche tudo automaticamente. E você aumenta suas vendas sem esforço. Fácil para ele, eficiente para você.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA large -->
  <section class="container my-5 text-center">
    <div class="p-4 rounded" style="background:linear-gradient(90deg, rgba(255,90,31,0.12), transparent);">
      <h3>Aqui acontece mais rápido.</h3>
      <p class="muted">Agende já e comece a vender seus produtos digitais hoje.</p>
      <button class="btn btn-primary">Criar conta grátis</button>
    </div>
  </section>

  <!-- FAQ -->
  <section class="container my-5 faq">
    <h4 class="mb-3">Dúvidas? Nós temos as respostas.</h4>
    <div class="accordion" id="faq">
      <div class="accordion-item bg-transparent">
        <h2 class="accordion-header" id="q1">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">01 - Como posso começar a vender no Hotmart?</button>
        </h2>
        <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#faq">
          <div class="accordion-body">Crie sua conta e siga o passo a passo para publicar seu produto.</div>
        </div>
      </div>

      <div class="accordion-item bg-transparent">
        <h2 class="accordion-header" id="q2">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">02 - O que é Hotmart Club?</button>
        </h2>
        <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faq">
          <div class="accordion-body">Uma área de membros para distribuir cursos e assinaturas.</div>
        </div>
      </div>

      <!-- add more items as needed -->
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h6>Hotmart</h6>
          <p class="muted">Fazemos tudo para o seu negócio digital acontecer.</p>
        </div>
        <div class="col-md-4">
          <h6>Recursos</h6>
          <ul class="list-unstyled muted small">
            <li>Produtos</li>
            <li>Comunidade</li>
            <li>Ajuda</li>
          </ul>
        </div>
        <div class="col-md-4 text-md-end muted small">
          <p>© 2025 Hotmart company</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
