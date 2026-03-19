<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    /* NAV LINKS */
    .nav-link {
      position: relative;
      font-weight: 600;
      font-size: 15px;
      color: black;
      padding-bottom: 4px;
      white-space: nowrap;
    }

    .nav-link::after {
      content: "";
      position: absolute;
      left: 50%;
      bottom: -4px;
      width: 0;
      height: 3px;
      background: black;
      transition: 0.3s;
      transform: translateX(-50%);
      border-radius: 10px;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    .nav-link.active::after {
      width: 100%;
    }

    /* MOBILE FULL-SCREEN MENU */
    .mobile-menu {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: #18a3b8;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 28px;
      transform: translateY(-100%);
      transition: 0.4s ease;
      z-index: 999;
    }

    .mobile-menu.active {
      transform: translateY(0);
    }

    .mobile-link {
      font-size: 22px;
      font-weight: 600;
      color: white;
      transition: opacity 0.2s;
    }

    .mobile-link:hover {
      opacity: 0.75;
    }

    .mobile-menu-close {
      position: absolute;
      top: 20px;
      right: 24px;
      font-size: 36px;
      color: white;
      cursor: pointer;
      font-weight: 700;
      line-height: 1;
      background: none;
      border: none;
    }
  </style>
</head>

<body class="bg-gray-100">



  <header class="w-full max-w-6xl mx-auto px-3 sm:px-4 py-3 lg:py-4
               flex items-center gap-3 lg:gap-6">

    <div class="hidden lg:flex shrink-0 items-center">
      <img src="{{ asset('image/logo.png') }}" alt="Logo" class="h-16 lg:h-20" alt="Logo">
    </div>

    <div class="bg-[#18a3b8] flex items-center justify-between w-full
              px-4 sm:px-5 lg:px-10
              py-2.5 sm:py-3 lg:py-4
              rounded-full min-w-0">

      <div class="flex items-center shrink-0">


        <img src="{{ asset('image/regretlogo.png') }}" alt="logo" class="block lg:hidden h-8 sm:h-10 w-auto" alt="Logo">

        <div class="hidden lg:flex items-center gap-1">
          <span class="text-white font-bold text-xl whitespace-nowrap">REGRET</span>
          <span class="text-black font-bold text-xl whitespace-nowrap">CONSULTANCY</span>
        </div>

      </div>

      <nav class="hidden lg:flex items-center gap-6 xl:gap-10">
        <a href="/" class="{{ request()->is('/') ? 'nav-link active' : 'nav-link' }}">Home</a>
        <a href="/about" class="{{ request()->is('about') ? 'nav-link active' : 'nav-link' }}">About Us</a>
        <a href="/services" class="{{ request()->is('services') ? 'nav-link active' : 'nav-link' }}">Services</a>
        <a href="/Career" class="{{ request()->is('Career') ? 'nav-link active' : 'nav-link' }}">Career</a>
        <a href="#" class="nav-link">Portfolio</a>
      </nav>


      <a href="/contact" class="hidden lg:inline-flex items-center shrink-0
              px-6 xl:px-8 py-2
              bg-white text-black text-sm lg:text-base
              rounded-full font-semibold
              hover:bg-black hover:text-white transition-colors duration-200">
        Contact Us
      </a>

      <button id="menuBtn" aria-label="Open menu" class="lg:hidden text-white text-3xl leading-none focus:outline-none">
        ☰
      </button>

    </div>

  </header>


  <div class="mobile-menu" id="mobileMenu" aria-hidden="true">

    <button id="closeBtn" class="mobile-menu-close" aria-label="Close menu">&times;</button>

    <a href="/" class="mobile-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
    <a href="/about" class="mobile-link {{ request()->is('about') ? 'active' : '' }}">About Us</a>
    <a href="/services" class="mobile-link {{ request()->is('services*') ? 'active' : '' }}">Services</a>
    <a href="/Career" class="mobile-link {{ request()->is('Career') ? 'active' : '' }}">Career</a>
    <a href="#" class="mobile-link">Portfolio</a>

    <a href="/contact" class="mt-2 px-10 py-3 bg-white text-[#18a3b8] rounded-full
            font-semibold text-lg hover:bg-black hover:text-white transition-colors duration-200">
      Contact Us
    </a>

  </div>


  <script>
    const menuBtn = document.getElementById("menuBtn");
    const closeBtn = document.getElementById("closeBtn");
    const mobileMenu = document.getElementById("mobileMenu");

    const openMenu = () => { mobileMenu.classList.add("active"); mobileMenu.setAttribute("aria-hidden", "false"); }
    const closeMenu = () => { mobileMenu.classList.remove("active"); mobileMenu.setAttribute("aria-hidden", "true"); }

    menuBtn.addEventListener("click", openMenu);
    closeBtn.addEventListener("click", closeMenu);

    document.querySelectorAll(".mobile-link").forEach(link =>
      link.addEventListener("click", closeMenu)
    );

    window.addEventListener("resize", () => {
      if (window.innerWidth >= 1024) closeMenu();
    });
  </script>

</body>

</html>