document.addEventListener("DOMContentLoaded", () => {
  initProgressBar();
  initNavigationToggle();
  initParallaxEffect();
  initSmoothScroll();
  initMobileSearch();
  updateActiveLink();

  window.addEventListener("scroll", () => {
    requestAnimationFrame(updateActiveLink);
  });
});

function initProgressBar() {
  const progressBar = document.querySelector(".header__progress-bar");
  if (!progressBar) return;

  const progressHandle = document.querySelector(".header__progress-handle");

  const updateProgress = () => {
    const windowHeight = window.innerHeight;
    const fullHeight = document.body.clientHeight;
    const progress = window.pageYOffset / (fullHeight - windowHeight);
    const progressPercent = Math.round(100 * progress);

    progressHandle.style.width =
      progressPercent > 0 ? `${progressPercent}%` : "0%";
  };

  window.addEventListener("scroll", () => {
    requestAnimationFrame(updateProgress);
  });
}

function initNavigationToggle() {
  const navigationHamburger = document.querySelector(".navigation__hamburger");
  navigationHamburger.addEventListener("click", () => {
    const navigationList = document.querySelector(".navigation__list");
    const navigationListTop = window
      .getComputedStyle(navigationList)
      .getPropertyValue("top");
    navigationList.style.top =
      navigationListTop === "-250px" ? "50px" : "-250px";
  });
}

function initParallaxEffect() {
  const parallax = document.querySelector(".post-content__image");
  if (!parallax || window.innerWidth <= 768) return;

  const animate = () => {
    const speed = 0.5;
    const position = window.pageYOffset;
    const yPos = position * speed;
    parallax.style.transform = `translateY(${yPos}px)`;
  };

  const isInViewport = (element) => {
    const rect = element.getBoundingClientRect();
    return (
      rect.top <=
        (window.innerHeight || document.documentElement.clientHeight) &&
      rect.bottom >= 0
    );
  };

  document.addEventListener("scroll", () => {
    if (isInViewport(parallax)) {
      requestAnimationFrame(animate);
    }
  });
}

function initMobileSearch() {
  const searchField = document.querySelector(".search-field");
  const searchFieldForm = document.querySelector(".search-field__form");
  const searchFieldButtonMobile = document.querySelector(
    ".search-field__button_mobile"
  );
  const navigationMobileLogo = document.querySelector(
    ".navigation__mobile-logo"
  );

  if (searchFieldButtonMobile) {
    searchFieldButtonMobile.addEventListener("click", () => {
      toggleMobileSearch(
        searchField,
        searchFieldForm,
        searchFieldButtonMobile,
        navigationMobileLogo
      );
    });
  }
}

function toggleMobileSearch(
  searchField,
  searchFieldForm,
  searchFieldButtonMobile,
  navigationMobileLogo
) {
  searchField.style.flex = "1";
  searchFieldForm.style.display = "flex";
  searchFieldButtonMobile.style.display = "none";
  navigationMobileLogo.style.display = "none";
}

function initSmoothScroll() {
  const sidebarLinks = document.querySelectorAll('a[href^="#"]');
  sidebarLinks.forEach((link) => {
    link.addEventListener("click", (event) => {
      smoothScroll(event, link);
    });
  });
}

function smoothScroll(event, link) {
  event.preventDefault();
  const target = document.querySelector(link.getAttribute("href"));
  if (target) {
    const targetPosition = target.offsetTop;
    window.scrollTo({
      top: targetPosition + 20,
      behavior: "smooth",
    });
  }
}

function updateActiveLink() {
  const sections = Array.from(document.querySelectorAll("[id]"));
  let activeSection = sections[0];
  const sectionOffset = 150;

  for (const section of sections) {
    const rect = section.getBoundingClientRect();
    if (rect.top <= sectionOffset) {
      activeSection = section;
    } else {
      break;
    }
  }

  const activeLink = document.querySelector(
    `.sidebar__navigation-link[href="#${activeSection.id}"]`
  );
  if (activeLink) {
    const previousActiveLink = document.querySelector(
      ".sidebar__navigation-link_active"
    );
    if (previousActiveLink) {
      previousActiveLink.classList.remove("sidebar__navigation-link_active");
    }
    activeLink.classList.add("sidebar__navigation-link_active");
  }
}
