document.addEventListener("DOMContentLoaded", () => {
  observeElements();
  initializeFilters();
  initializeSearch();
  initializePageTransitions();
  initializeCardHoverEffects();
  initializeScrollToTop();
  initializeStatsModal(); 
});
function initializeStatsModal() {
  const modal = document.getElementById('statsModal');
  const openBtn = document.querySelector('.open-stats-btn');
  const closeBtn = modal ? modal.querySelector('.close-modal-btn') : null;

  if (!modal || !openBtn || !closeBtn) return;
  openBtn.addEventListener('click', () => {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  });

  function closeModal(e) {
    if (!e || e.target === modal || e.target === closeBtn) {
      modal.classList.remove('active');
      document.body.style.overflow = 'auto';
    }
  }

  closeBtn.addEventListener('click', closeModal);
  modal.addEventListener('click', closeModal);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });
}


function observeElements() {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = "1";
          entry.target.style.transform = "translateY(0)";
        }
      });
    },
    { threshold: 0.1, rootMargin: "0px 0px -100px 0px" }
  );

  document.querySelectorAll(".event-card").forEach((card) => {
    card.style.opacity = "0";
    card.style.transform = "translateY(20px)";
    card.style.transition = "all 0.6s cubic-bezier(0.4, 0, 0.2, 1)";
    observer.observe(card);
  });
}

function initializeFilters() {
  const filterContainer = document.querySelector(".filters-container");
  const statuses = ["ALL", "ACTIVE", "UPCOMING", "CANCELLED", "COMPLETED", "PLANNED"];
  if (!filterContainer) return;

  statuses.forEach((status) => {
    const btn = document.createElement("button");
    btn.className = `filter-btn ${status === "ALL" ? "active" : ""}`;
    btn.textContent = status;
    btn.setAttribute("data-filter", status);

    btn.addEventListener("click", function () {
      document.querySelectorAll(".filter-btn").forEach((b) => b.classList.remove("active"));
      this.classList.add("active");
      filterEvents(status);
    });

    filterContainer.appendChild(btn);
  });
}
function filterEvents(status) {
  const cards = document.querySelectorAll(".event-card");
  cards.forEach((card) => {
    const badge = card.querySelector(".event-status-badge");
    const cardStatus = badge ? badge.textContent.trim() : "";
    if (status === "ALL" || cardStatus === status) {
      card.style.display = "block";
      card.style.animation = "fadeInScale 0.3s ease-out";
    } else {
      card.style.display = "none";
    }
  });
}
function initializeSearch() {
  const searchInput = document.querySelector(".search-input");
  if (!searchInput) return;

  searchInput.addEventListener("input", (e) => {
    const query = e.target.value.toLowerCase();
    const cards = document.querySelectorAll(".event-card");

    cards.forEach((card) => {
      const title = card.querySelector(".event-card-content h3").textContent.toLowerCase();
      const location = card.querySelector(".meta-item:nth-child(2)").textContent.toLowerCase();
      if (title.includes(query) || location.includes(query)) {
        card.style.display = "block";
        card.style.opacity = "1";
      } else {
        card.style.display = "none";
        card.style.opacity = "0.5";
      }
    });
  });
}

function initializePageTransitions() {
  const links = document.querySelectorAll('a[href*="?page="]');
  links.forEach((link) => {
    link.addEventListener("click", () => {
      const main = document.querySelector(".main");
      if (main) main.style.animation = "fadeOut 0.3s ease-out";
    });
  });
}


function initializeCardHoverEffects() {
  const cards = document.querySelectorAll(".event-card");
  cards.forEach((card) => {
    card.addEventListener("mouseenter", () => {
      card.style.transform = "translateY(-10px) scale(1.02)";
    });
    card.addEventListener("mouseleave", () => {
      card.style.transform = "translateY(0) scale(1)";
    });
  });
}

function initializeScrollToTop() {
  const scrollBtn = document.getElementById("scrollToTopBtn");
  if (!scrollBtn) return;

  window.addEventListener("scroll", () => {
    const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    const header = document.querySelector(".header");

    if (scrollTop > 300) scrollBtn.classList.add("visible");
    else scrollBtn.classList.remove("visible");

    if (header) {
      if (scrollTop > 50) header.style.boxShadow = "0 4px 12px rgba(0, 0, 0, 0.1)";
      else header.style.boxShadow = "var(--shadow-sm)";
    }
  });

  scrollBtn.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
}

if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
  document.documentElement.style.scrollBehavior = "auto";
  const style = document.createElement("style");
  style.textContent =
    "* { animation-duration: 0.01ms !important; animation-iteration-count: 1 !important; transition-duration: 0.01ms !important; }";
  document.head.appendChild(style);
}
