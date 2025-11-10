// --- Função para carregar o carrinho ---
function loadCart() {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const cartDiv = document.getElementById('cartItems');
  const cartTotal = document.getElementById('cartTotal');
  const productNumber = document.getElementById('productNumber');

  if (cart.length === 0) {
    cartDiv.innerHTML = "<p>Carrinho vazio</p>";
    return;
  }

  let html = "";
  let total = 0;
  let count = 0;

  cart.forEach((item, index) => {
    total += item.preco * item.quantidade;
    html += `
    
      <div class=" cart-item d-flex justify-content-between">
       <div>
                        <h6 class="mb-1">${item.produto}</h6>
                        <small class="text-muted">${item.quantidade} x MZN${item.preco}</small>
                    </div>
                    <div>
        <button class="btn btn-sm btn-outline-danger ms-2 remove-item" onclick="removeFromCart(${index})"><i class="bi bi-trash" width="16" height="16"></i></button>
      </div>
      </div>
    `;
    count += item.quantidade;
  });

  
  html += `<button class="btn mt-4 btn-sm btn-danger  " onclick="clearCart()">Esvaziar carrinho</button>`;
cartTotal.textContent = `MZN ${total.toFixed(2)}`;
productNumber.textContent = count;
  cartDiv.innerHTML = html;
}

// --- Adicionar item ao carrinho ---
function addToCart(id, produto, preco) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  // Se o produto já estiver no carrinho, aumenta a quantidade
  const existing = cart.find(item => item.produto === produto);
  if (existing) {
    existing.quantidade += 1;
  } else {
    cart.push({ id, produto, preco, quantidade: 1 });
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
