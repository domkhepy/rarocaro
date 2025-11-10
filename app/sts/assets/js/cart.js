// --- Função para carregar o carrinho ---
function loadCart() {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const cartDiv = document.getElementById('cartItems');
  const cartTotal = document.getElementById('cartTotal');
  const productNumber = document.getElementById('productNumber');
  const checkoutBtn = document.getElementById('checkoutBtn');
  const total_quantity = document.getElementById('total_quantity');

  if (cart.length === 0) {
    cartDiv.innerHTML = "<p>Carrinho vazio</p>";
     checkoutBtn.disabled = true;
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
total_quantity.value = count;
  cartDiv.innerHTML = html;
   checkoutBtn.disabled = false;
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

 // Finalizar compra
    checkoutBtn.addEventListener('click', function() {
        let summaryHTML = '<h5>Resumo do Pedido</h5><ul class="list-group mb-3">';
        let details = [];
        let total = 0;
         const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        
        cart.forEach(item => {
            const itemTotal = item.preco * item.quantidade;
            total += itemTotal;
            
            summaryHTML += `
                <li class="list-group-item d-flex justify-content-between">
                    <span>${item.produto} (${item.quantidade}x)</span>
                    <span>MZN ${itemTotal.toFixed(2)}</span>
                </li>
            `;
            
            details.push({
                id: item.id,
                name: item.produto,
                price: item.preco,
                quantity: item.quantidade
            });
        });
        
        summaryHTML += `
            </ul>
            <div class="d-flex justify-content-between fw-bold">
                <span>Total:</span>
                <span>MZN ${total.toFixed(2)}</span>
            </div>
        `;
        
        orderSummary.innerHTML = summaryHTML;
        orderDetails.value = JSON.stringify(details);
        checkoutModal.show();
    });

// --- Carrega o carrinho automaticamente ao abrir a página ---
window.onload = loadCart;
