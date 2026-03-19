<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .footer-link {
            position: relative;
            display: inline-block;
        }

        .phone-blue {
            background-color: #03adce;
        }

        .whatsapp-green {
            background-color: #0fd939;
        }

        .footer-link::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -4px;
            width: 0;
            height: 2px;
            background: #06b6d4;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .footer-link:hover::after {
            width: 100%;
        }
    </style>
</head>

<body>
    <footer class="bg-black text-white px-4 py-6 sm:px-6 sm:py-8 md:px-16 lg:px-24 border-t border-gray-800 relative">
        <div class="flex flex-col sm:flex-row justify-center sm:justify-between items-center mb-6 sm:mb-8 gap-3">
            <div class="flex gap-2 sm:gap-3 justify-center sm:justify-start">
                <a href="tel:8460691834">
                    <div class="phone-blue p-2 rounded-full cursor-pointer hover:opacity-80 transition-opacity">
                        <i class="fa-solid fa-phone text-white py-1 px-1.5 text-sm sm:text-base"></i>
                    </div>
                </a>
                <a href="https://wa.me/8460691834" target="_blank">
                    <div class="whatsapp-green p-2.5 rounded-lg cursor-pointer hover:opacity-80 transition-opacity">
                        <i class="fa-brands fa-whatsapp fa-lg py-1 px-1 text-center"></i>
                    </div>
                </a>
            </div>
            <div class="border border-[#03adce] p-2 rounded-full cursor-pointer hover:bg-[#03adce] hover:text-white transition-colors scroll-top-btn"
                onclick="scrollToTop()">
                <i class="fa-solid fa-arrow-up py-1 px-1.5 text-gray-400"></i>
            </div>
        </div>
        <script>
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
            // Show/hide button on scroll
            window.addEventListener('scroll', function () {
                const btn = document.querySelector('.scroll-top-btn');
                if (window.scrollY > 300) {
                    btn.style.opacity = '1';
                    btn.style.visibility = 'visible';
                } else {
                    btn.style.opacity = '0';
                    btn.style.visibility = 'hidden';
                }
            });
        </script>
        <style>
            .scroll-top-btn {
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
            }
        </style>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10 md:gap-12 mb-8 sm:mb-10">
            <div class="space-y-4 sm:space-y-6 text-center md:text-left">
                <img src="{{ asset('image/logo.png') }}" class="h-24 sm:h-28 md:h-20 w-auto mx-auto md:mx-0">
                <p class="text-gray-400 text-xs sm:text-sm leading-relaxed max-w-xs mx-auto md:mx-0">
                    Transforming brand through innovative digital marketing strategies.
                    We help business grow, gain visibility, and measurable results.
                </p>
                <div class="flex gap-2 sm:gap-3 justify-center md:justify-start">
                    <div
                        class="gradient-instagram p-1.5 sm:p-2 rounded-lg hover:bg-[#03adce] cursor-pointer transition-transform hover:scale-110">
                        <img src="{{ asset('image/icon/05.instagram.png') }}" alt="" class="w-5 h-5">
                    </div>
                    <div
                        class="google-blue p-1.5 sm:p-2 rounded-lg cursor-pointer hover:bg-[#03adce] transition-transform hover:scale-110">
                        <img src="{{ asset('image/icon/google.png') }}" alt="" class="w-5 h-5">
                    </div>
                    <div
                        class="facebook-blue p-1.5 sm:p-2 rounded-lg cursor-pointer hover:bg-[#03adce]  transition-transform hover:scale-110">
                        <img src="{{ asset('image/icon/facebook.png') }}" alt="" class="w-5 h-5">
                    </div>
                </div>
            </div>
            <div class="text-center md:text-left">
                <h4 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4">Quick Links</h4>
                <ul class="space-y-2 sm:space-y-3 text-gray-400 text-xs sm:text-sm">
                    <li><a href="/" class="footer-link hover:text-white transition-colors">Home</a></li>
                    <li><a href="/about" class="footer-link hover:text-white transition-colors">About Us</a></li>
                    <li><a href="/services" class="footer-link hover:text-white transition-colors">Services</a></li>
                    <li><a href="/Career" class="footer-link hover:text-white transition-colors">Careers</a></li>
                </ul>
            </div>
            <div class="text-center md:text-left">
                <h4 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4">Our Services</h4>
                <ul class="space-y-2 sm:space-y-3 text-gray-400 text-xs sm:text-sm">
                    <li><a href="/services" class="footer-link hover:text-white transition-colors">Social Media
                            Marketing</a></li>
                    <li><a href="/services" class="footer-link hover:text-white transition-colors">Performance
                            Marketing</a></li>
                    <li><a href="/services" class="footer-link hover:text-white transition-colors">Branding &
                            Strategy</a></li>
                    <li><a href="/services" class="footer-link hover:text-white transition-colors">Graphic Designing</a>
                    </li>
                    <li><a href="/services" class="footer-link hover:text-white transition-colors">Content Writing</a>
                    </li>
                </ul>
            </div>
            <div class="text-center md:text-left">
                <h4 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4">Get In Touch</h4>
                <ul class="space-y-2 sm:space-y-3 text-gray-400 text-xs sm:text-sm">
                    <li class="flex items-center justify-center md:justify-start gap-2 sm:gap-3">
                        <i class="fa-solid fa-location-dot text-[#03adce] p-1"></i>
                        <span>Ahmedabad, Gujarat, India</span>
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-2 sm:gap-3">
                        <i class="fa-solid fa-envelope text-[#03adce] p-1"></i>
                        <span class="break-all">regretconsultancy@gmail.com</span>
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-2 sm:gap-3">
                        <i class="fa-solid fa-phone text-[#03adce] p-1"></i>
                        <span>+91 8460691834</span>
                    </li>
                </ul>
            </div>
        </div>
        <div
            class="border-t border-[#03adce] pt-5 pb-5 sm:pt-6 sm:pb-6 flex flex-col md:flex-row justify-center md:justify-between items-center gap-4 sm:gap-6">
            <div class="text-center md:text-left w-full md:w-auto">
                <h5 class="text-base sm:text-lg font-semibold">Stay Updated</h5>
                <p class="text-gray-400 text-xs sm:text-sm">
                    Subscribe to our newsletter for the latest marketing insights.
                </p>
            </div>
            <div class="flex w-full md:w-auto max-w-md gap-2 sm:gap-3 justify-center md:justify-start">
                <input type="email" placeholder="Enter your email"
                    class="bg-transparent border border-[#03adce] rounded-full px-4 sm:px-6 py-2.5 sm:py-3 flex-grow text-xs sm:text-sm focus:outline-none focus:border-cyan-500 transition-colors">
                <button
                    class="bg-cyan-500 hover:bg-cyan-600 text-black font-semibold px-5 sm:px-8 py-2.5 sm:py-3 rounded-full text-xs sm:text-sm transition-all whitespace-nowrap">Subscribe</button>
            </div>
        </div>
        <div class="pt-4 border-t border-[#03adce] text-center text-gray-500 text-[10px] sm:text-[11px] tracking-wide">
            Copyright 2026 REGRET CONSULTANCY. All rights reserved.
        </div>
    </footer>
</body>

</html>