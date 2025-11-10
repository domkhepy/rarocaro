<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Loja com Carrinho Persistente</title>
<link rel="stylesheet" href="style.css">
<script src="script.js" defer></script>
</head>
<body>

<h1>🛍️ Loja Online</h1>

<div class="produto">
  <img src="perfume.jpg" width="120" alt="Produto">
  <h2>Perfume INUKA</h2>
  <p>Preço: R$ 200</p>
  <button onclick="addToCart('Perfume INUKA', 200)">Adicionar ao carrinho</button>
</div>

<div class="produto">
  <img src="creme.jpg" width="120" alt="Produto">
  <h2>Creme Hidratante</h2>
  <p>Preço: R$ 150</p>
  <button onclick="addToCart('Creme Hidratante', 150)">Adicionar ao carrinho</button>
</div>

<hr>

<h2>🛒 Carrinho</h2>
<div id="cart"></div>

</body>
</html>
