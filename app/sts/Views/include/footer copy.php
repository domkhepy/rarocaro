<?php
if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
extract($this->dados['footer']);
?>
  <!-- Rodapé -->

  <footer class="site-footer" aria-label="Rodapé">
  <div class="footer-container">
    <!-- Bloco 1: Brand + descrição -->
    <section class="footer-brand">
      <a class="navbar-brand" href="#"><img width="140px"
                src="<?php echo URL."app/sts/assets/images/icon/logo2.png"?>"></a>
      <p class="brand-desc">
    T-shirts premium criadas para quem exige excelência em cada detalhe.
    <div class="brand-social" aria-label="Redes sociais">
        <a href="#" class="social" aria-label="Facebook">f</a>
        <a href="#" class="social" aria-label="Twitter">t</a>
        <a href="#" class="social" aria-label="LinkedIn">in</a>
        <a href="#" class="social" aria-label="Instagram">ig</a>
      </div>
    </section>

    <!-- Bloco 2: Quick Links -->
    <nav class="footer-links" aria-label="Links rápidos">
      <h4 class="footer-title">Links Rápidos</h4>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Serviços</a></li>
        <li><a href="#">Projetos</a></li>
        <li><a href="#">Notícias</a></li>
        <li><a href="#">Contacto</a></li>
      </ul>
    </nav>

    <!-- Bloco 3: Our Services -->
    <section class="footer-links" aria-label="Serviços">
      <h4 class="footer-title">Nossos Serviços</h4>
      <ul>
        <li><a href="#">Transporte</a></li>
        <li><a href="#">Terraplenagem</a></li>
        <li><a href="#">Logística de Projetos</a></li>
      </ul>
    </section>

    <!-- Bloco 4: Contact Info -->
    <section class="footer-links" aria-label="Contato">
      <h4 class="footer-title">Contacto</h4>
      <ul class="contact-list">
        <li><span class="icon">📍</span> Av. Julius Nyere 1234, Maputo, Mozambique</li>
        <li><span class="icon">☎</span> +258 123 456 789</li>
        <li><span class="icon">✉</span> info@tourarotoucaro.com</li>
      </ul>
    </section>
  </div>
<hr></hr>
  <div class="container d-flex justify-content-between flex-wrap gap-3">
      <span>© 2025 Tou Raro Tou Caro. Todos direitos reservados.</span>
      <nav aria-label="Rodapé">
        <ul class="list-unstyled d-flex gap-3 mb-0">
          <li><a class="text-white-50" href="#">Política de Privacidade</a></li>
          <li><a class="text-white-50" href="#">Termos</a></li>
          <li><a class="text-white-50" href="#">Contato</a></li>
        </ul>
      </nav>
    </div>
</footer>
