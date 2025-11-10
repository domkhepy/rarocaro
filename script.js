// --- Função para carregar o carrinho ---
function loadCart() {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const cartDiv = document.getElementById('cart');

  if (cart.length === 0) {
    cartDiv.innerHTML = "<p>Carrinho vazio</p>";
    return;
  }

  let html = "";
  let total = 0;

  cart.forEach((item, index) => {
    total += item.preco * item.quantidade;
    html += `
      <div class="item">
        <strong>${item.produto}</strong> - ${item.quantidade}x (R$ ${item.preco})
        <button onclick="removeFromCart(${index})">Remover</button>
      </div>
    `;
  });

  html += `<hr><p><strong>Total: R$ ${total.toFixed(2)}</strong></p>`;
  html += `<button onclick="clearCart()">Esvaziar carrinho</button>`;

  cartDiv.innerHTML = html;
}

// --- Adicionar item ao carrinho ---
function addToCart(produto, preco) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  // Se o produto já estiver no carrinho, aumenta a quantidade
  const existing = cart.find(item => item.produto === produto);
  if (existing) {
    existing.quantidade += 1;
  } else {
    cart.push({ produto, preco, quantidade: 1 });
  }

  localStorage.setItem('cart', JSON.stringify(cart));
  loadCart();
}

// --- Remover item ---
function removeFromCart(index) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  cart.splice(index, 1);
  localStorage.setItem('cart', JSON.stringify(cart));
  loadCart();
}

// --- Esvaziar carrinho ---
function clearCart() {
  localStorage.removeItem('cart');
  loadCart();
}

// --- Carrega o carrinho automaticamente ao abrir a página ---
window.onload = loadCart;
