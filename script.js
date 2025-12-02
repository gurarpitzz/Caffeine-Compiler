// ===========================
// CoffeeShop UI Interactivity
// ===========================

// Select main elements safely
const navbar = document.querySelector('.navbar');
const cartItem = document.querySelector('.cart-items-container');
const searchForm = document.querySelector('.search-form');
const menuBtn = document.querySelector('#menu-btn');
const cartBtn = document.querySelector('#cart-btn');
const searchBtn = document.querySelector('#search-btn');

// ===========================
// Navbar Toggle (Mobile)
// ===========================
if (menuBtn && navbar) {
  menuBtn.onclick = () => {
    navbar.classList.toggle('active');
    if (cartItem) cartItem.classList.remove('active');
    if (searchForm) searchForm.classList.remove('active');
  };
}

// ===========================
// Cart Toggle
// ===========================
if (cartBtn && cartItem) {
  cartBtn.onclick = () => {
    cartItem.classList.toggle('active');
    if (navbar) navbar.classList.remove('active');
    if (searchForm) searchForm.classList.remove('active');
  };
}

// ===========================
// Search Toggle
// ===========================
if (searchBtn && searchForm) {
  searchBtn.onclick = () => {
    searchForm.classList.toggle('active');
    if (navbar) navbar.classList.remove('active');
    if (cartItem) cartItem.classList.remove('active');
  };
}

// ===========================
// Scroll behavior
// ===========================
window.onscroll = () => {
  if (navbar) navbar.classList.remove('active');
  if (cartItem) cartItem.classList.remove('active');
  if (searchForm) searchForm.classList.remove('active');
};

// ===========================
// Smooth Scroll for Navbar Links
// ===========================
document.querySelectorAll('.navbar a[href^="#"]').forEach(link => {
  link.addEventListener('click', e => {
    const targetId = link.getAttribute('href');
    if (targetId.startsWith('#') && document.querySelector(targetId)) {
      e.preventDefault();
      document.querySelector(targetId).scrollIntoView({
        behavior: 'smooth'
      });
      if (navbar) navbar.classList.remove('active');
    }
  });
});

// ===========================
// Subtle animation on hover
// ===========================
document.querySelectorAll('.navbar a').forEach(a => {
  a.addEventListener('mouseenter', () => {
    a.style.transition = 'color 0.3s ease';
    a.style.color = 'brown';
  });
  a.addEventListener('mouseleave', () => {
    a.style.color = '';
  });
});
