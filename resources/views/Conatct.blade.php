<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description"
        content="Regret Consultancy is a professional consulting firm helping businesses and individuals grow with smart strategies, expert advice, and result-driven solutions.">
    <meta name="keywords"
        content="Regret Consultancy, business consulting India, career guidance services, professional consultancy, startup consulting, marketing strategy, business growth services, consultancy firm India, expert consulting services, digital consulting">
    <link rel="icon" type="image/x-icon" href="{{ asset('image/Favicon.jpeg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('image/Favicon.jpeg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" />
   
    <title>Contact Us - Regret Consultancy</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #050505;
            color: #ffffff;
            margin: 0;
            overflow-x: hidden;
        }

        .hero-gradient {
            background: radial-gradient(circle at 120% 200%, #0276db 0%, #000000 65%);
        }

        .globe-glow {
            filter: drop-shadow(0 0 30px rgba(2, 118, 219, 0.3));
        }

        .icon-circle {
            background: white;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 767px) {
            .icon-circle {
                width: 38px;
                height: 38px;
            }
        }
    </style>
</head>

<body>

    <section class="hero-gradient relative w-full overflow-hidden py-5">

        @include('layouts.header')

        <!-- MOBILE (sm only, hidden on md+) -->
        <div class="flex md:hidden flex-col items-center pt-6 pb-0 px-4">
            <div class="flex items-center gap-2 text-sm mb-4">
              <a href="/">  <span class="text-white opacity-70">Home</span></a>
                <span class="text-white opacity-70">&gt;</span>
                <span class="text-[#0276db] font-medium">Contact Us</span>
            </div>

            <h1 class="title text-3xl font-bold leading-tight text-[#03adce] mb-4 text-center">
                Contact Us
            </h1>

            <div class="relative w-[80%] max-w-sm globe-glow mt-4">
                <img src="{{ asset('image/contact.png') }}" alt="Globe" class="w-full h-auto object-contain" />

                <!-- Email icon -->
                <div class="absolute -top-[10%] right-[27%]">
                    <div class="icon-circle">
                        <i class="fa-regular fa-envelope text-[#00d4e8] text-sm"></i>
                    </div>
                </div>

                <!-- Phone icon -->
                <div class="absolute top-[40%] -right-[12%]">
                    <div class="icon-circle">
                        <i class="fa-solid fa-phone text-[#00d4e8] text-sm"></i>
                    </div>
                </div>

                <!-- Location icon -->
                <div class="absolute top-[92%] right-[24%]">
                    <div class="icon-circle">
                        <i class="fa-solid fa-location-dot text-[#00d4e8] text-sm"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- DESKTOP (md+) — NO CHANGES -->
        <div class="hidden md:flex relative  min-h-[60vh] md:min-h-[70vh]">

            <div class="relative flex-shrink-0 globe-glow pt-[70px]" style="width: 42%; margin-left: -4%;">
                <img src="{{ asset('image/contact.png') }}" alt="Globe" class="w-full h-auto object-contain"
                    style="max-height: 50vh;" />

                <div class="absolute top-[10%] right-[27%] lg:top-[10%] lg:right-[27%] md:top-[10%] md:right-[27%]">
                    <div class="icon-circle">
                        <i class="fa-regular fa-envelope text-[#00d4e8] text-base"></i>
                    </div>
                </div>

                <div class="absolute top-[40%] right-[12%] lg:top-[50%] lg:right-[10%] md:top-[50%] md:right-[0%]">
                    <div class="icon-circle">
                        <i class="fa-solid fa-phone text-[#00d4e8] text-base"></i>
                    </div>
                </div>

                <div class="absolute top-[88%] right-[24%] md:top-[92%] md:right-[30%] -z-99">
                    <div class="icon-circle">
                        <i class="fa-solid fa-location-dot text-[#00d4e8] text-base"></i>
                    </div>
                </div>
            </div>

            <div class="flex flex-col -pt-20 px-8 lg:px-16">
                <div class="flex  gap-2 text-sm mb-6">
                    <span class="text-white opacity-80">Home</span>
                    > <span class="text-[#0276db] font-medium">Contact Us</span>
                </div>
                <h1 class="title text-3xl md:text-5xl lg:text-4xl font-bold max-w-5xl leading-tight text-[#0276db]">
                    Contact Us
                </h1>
            </div>

        </div>

    </section>

    <!-- Leave your msg -->

    <section class="py-16 px-4 md:px-10 lg:px-20" style="background-color: #050505;">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
            <!-- Form -->
            <div class="rounded-2xl p-6 sm:p-8 w-full max-w-[450px] mx-auto md:max-w-full md:mx-0"
                style="background: linear-gradient(180deg, #717579 0%, #112d52 60%, #0d2444 70%, #081628 100%); border: 1px solid rgba(2, 118, 219, 0.25);">
                <h2 class="text-white text-lg font-semibold mb-6">Leave your Message</h2>


                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="text-white text-sm mb-2 block">Name</label>
                            <input type="text" name="name" required placeholder="Your name"
                                class="w-full rounded-lg px-4 py-2 text-sm text-gray-800 h-12 outline-none"
                                style="background: rgba(255,255,255,0.92); border: none;" value="{{ old('name') }}" />
                        </div>
                        <div>
                            <label class="text-white text-sm mb-2 block">Email</label>
                            <input type="email" name="email" required placeholder="Your mail"
                                class="w-full rounded-lg px-4 py-2 text-sm text-gray-800 h-12 outline-none"
                                style="background: rgba(255,255,255,0.92); border: none;" value="{{ old('email') }}" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-white text-sm mb-2 block">Subject</label>
                        <input type="text" name="subject" required placeholder="Subject"
                            class="w-full md:w-[48%] rounded-lg px-4 py-2 text-sm text-gray-800 h-12 outline-none"
                            style="background: rgba(255,255,255,0.92); border: none;" value="{{ old('subject') }}" />
                    </div>

                    <div class="mb-6">
                        <label class="text-white text-sm mb-2 block">Phone (Optional)</label>
                        <input type="tel" name="phone" placeholder="Your phone"
                            class="w-full md:w-[48%] rounded-lg px-4 py-2 text-sm text-gray-800 h-12 outline-none"
                            style="background: rgba(255,255,255,0.92); border: none;" value="{{ old('phone') }}" />
                    </div>

                    <div class="mb-6">
                        <label class="text-white text-sm mb-2 block">Message</label>
                        <textarea name="message" required placeholder="Your message..." rows="5"
                            class="w-full rounded-lg px-4 py-3 text-sm text-gray-800 outline-none resize-none"
                            style="background: rgba(255,255,255,0.92); border: none;">{{ old('message') }}</textarea>
                    </div>



                    <div class="flex justify-center">
                        <button type="submit"
                            class="px-10 py-3 rounded-full text-white text-sm font-medium transition hover:opacity-90 bg-[#15355c]">
                            Send Message
                        </button>
                    </div>
                </form>

            </div>

            <!-- Right Side -->
            <div class="flex flex-col justify-start w-full">
                <h2 class="text-2xl md:text-3xl font-bold mb-8 text-[#0276db]">
                    Don't hesitate to contact Us
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">

                    <div class="flex items-center gap-3 rounded-xl px-4 py-5 bg-white"
                        style="border: 1px solid rgba(255,255,255,0.1);">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                            style="background: rgba(2,118,219,0.15);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0 24H12V0H0V24ZM7.5 3H10.5V6H7.5V3ZM7.5 9H10.5V12H7.5V9ZM7.5 15H10.5V18H7.5V15ZM1.5 3H4.5V6H1.5V3ZM1.5 9H4.5V12H1.5V9ZM1.5 15H4.5V18H1.5V15ZM13.5 7.5H24V9H13.5V7.5ZM13.5 24H16.5V18H21V24H24V10.5H13.5V24Z"
                                    fill="#3608DC" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-black text-sm font-semibold">Office</p>
                            <p class="text-gray-400 text-xs mt-0.5 truncate">isha patel</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 rounded-xl px-4 py-5 bg-white"
                        style="border: 1px solid rgba(255,255,255,0.1);">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                            style="background: rgba(255,165,0,0.15);">
                            <svg width="20" height="20" viewBox="0 0 22 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21.9988 16.4022V20.724C21.9989 21.0334 21.8817 21.3314 21.6707 21.5578C21.4598 21.7842 21.1708 21.9221 20.8622 21.9438C20.3285 21.9813 19.8926 22 19.5545 22C8.75429 22 0 13.2452 0 2.44444C0 2.10711 0.0187397 1.67119 0.0562191 1.13667C0.0778786 0.827987 0.215809 0.539013 0.44218 0.328055C0.66855 0.117097 0.966508 -0.000139863 1.27593 3.13597e-07H5.59747C5.74906 -0.000153187 5.8953 0.0560499 6.00778 0.157692C6.12026 0.259333 6.19094 0.399157 6.2061 0.55C6.2338 0.830297 6.25987 1.05519 6.28432 1.22467C6.52718 2.9198 7.02493 4.56847 7.76068 6.11478C7.87679 6.35922 7.80101 6.65133 7.58102 6.80778L4.94361 8.69245C6.55651 12.4499 9.5508 15.4444 13.308 17.0573L15.1902 14.4247C15.2668 14.3167 15.379 14.2393 15.5071 14.206C15.6352 14.1727 15.771 14.1856 15.8905 14.2426C17.4365 14.977 19.0846 15.4735 20.7791 15.7153C20.9485 15.7398 21.1726 15.7659 21.4513 15.7936C21.6019 15.809 21.7414 15.8798 21.8428 15.9923C21.9442 16.1047 21.999 16.2508 21.9988 16.4022Z"
                                    fill="#E09B3D" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-black text-sm font-semibold">Phone</p>
                            <p class="text-gray-400 text-xs mt-0.5 truncate">+91 8460691834</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 rounded-xl px-4 py-5 bg-white"
                        style="border: 1px solid rgba(255,255,255,0.1);">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                            style="background: rgba(180,0,255,0.15);">
                            <svg width="29" height="29" viewBox="0 0 34 34" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.9996 2.13031C8.78645 2.13031 2.12988 8.78687 2.12988 17C2.12988 25.2131 8.45707 31.535 16.3886 31.8591C16.1018 31.4553 15.9318 30.9666 15.9318 30.4353V28.8734C13.2543 28.6344 10.8318 27.5081 8.95645 25.7922L10.3908 24.3578C10.598 24.1506 10.598 23.8159 10.3908 23.6087C10.1836 23.4016 9.84895 23.4016 9.64176 23.6087L8.20738 25.0431C6.37988 23.0456 5.2377 20.4266 5.1102 17.5366H7.12895C7.42113 17.5366 7.6602 17.2975 7.6602 17.0053C7.6602 16.7131 7.42113 16.4741 7.12895 16.4741H5.09957C5.09957 16.5591 5.09957 16.6441 5.09426 16.7291C5.16332 13.7381 6.32676 11.0181 8.20738 8.96219L9.64707 10.4019C9.75332 10.5028 9.88613 10.5559 10.0243 10.5559C10.1624 10.5559 10.2952 10.5028 10.3961 10.4019C10.6033 10.1947 10.6033 9.85468 10.3961 9.6475L8.96176 8.21312C11.0071 6.33781 13.7058 5.17437 16.6808 5.08937C16.6118 5.08937 16.5427 5.08937 16.4683 5.09469V7.13469C16.4683 7.42687 16.7074 7.66594 16.9996 7.66594C17.2918 7.66594 17.5308 7.42687 17.5308 7.13469V5.09469C17.4405 5.08937 17.3555 5.08937 17.2652 5.08406C20.2614 5.14781 22.9921 6.31656 25.0533 8.2025L23.603 9.6475C23.3958 9.85468 23.3958 10.1947 23.603 10.4019C23.7093 10.5028 23.8474 10.5559 23.9802 10.5559C24.113 10.5559 24.2511 10.5028 24.3574 10.4019L25.8024 8.95687C27.6883 11.0181 28.8571 13.7381 28.9208 16.7344C28.9208 16.6494 28.9208 16.5644 28.9155 16.4794H26.8702C26.578 16.4794 26.3389 16.7131 26.3389 17.0106C26.3389 17.3081 26.578 17.5419 26.8702 17.5419H28.9102C28.873 18.3972 28.7455 19.2312 28.5383 20.0334H28.9686C29.6539 20.0334 30.2755 20.3097 30.7218 20.7612C30.9183 20.9578 31.0777 21.1969 31.1999 21.4519C31.6408 20.0494 31.8746 18.5566 31.8746 17.0053C31.8746 8.79218 25.218 2.13562 17.0049 2.13562L16.9996 2.13031ZM8.23395 8.925C8.4252 8.71781 8.62176 8.51593 8.82895 8.32469C8.62707 8.52125 8.4252 8.71781 8.23395 8.925ZM25.0746 8.23969C25.2818 8.43093 25.4836 8.63281 25.6749 8.83468C25.4783 8.6275 25.2818 8.43093 25.0746 8.23969Z"
                                    fill="#631E95" />
                                <path
                                    d="M24.8943 28.3793C24.8943 28.5015 24.8305 28.6131 24.7243 28.6822L23.8743 29.2028C23.7627 29.2718 23.6139 29.2718 23.5024 29.2028L22.6524 28.6822C22.5461 28.6131 22.4824 28.5015 22.4824 28.3793V28.0447L16.9893 26.4934V30.43C16.9893 31.2162 17.6268 31.8537 18.413 31.8537H28.9636C29.7499 31.8537 30.3821 31.2162 30.3821 30.43V26.4934L24.8943 28.0447V28.3793Z"
                                    fill="#631E95" />
                                <path
                                    d="M16.9893 22.5091V25.3884L19.6349 26.1375V21.0906H18.413C17.6268 21.0906 16.9893 21.7281 16.9893 22.5091Z"
                                    fill="#631E95" />
                                <path
                                    d="M28.9641 21.0906H27.7422V26.1375L30.3825 25.3884V22.5091C30.3825 21.7281 29.7503 21.0906 28.9641 21.0906Z"
                                    fill="#631E95" />
                                <path
                                    d="M24.9313 17.935H22.4398C21.5526 17.935 20.8354 18.6575 20.8354 19.5394V21.0906H20.6973V26.4403L22.4823 26.945V26.1959C22.4823 25.9994 22.6416 25.84 22.8382 25.84H24.5382C24.7348 25.84 24.8941 25.9994 24.8941 26.1959V26.9397L26.6791 26.435V21.0906H26.541V19.5394C26.541 18.6522 25.8185 17.935 24.9366 17.935H24.9313ZM21.8979 21.0906V19.5394C21.8979 19.2419 22.1423 18.9975 22.4398 18.9975H24.9313C25.2288 18.9975 25.4732 19.2419 25.4732 19.5394V21.0906H21.8979Z"
                                    fill="#631E95" />
                                <path
                                    d="M17.0057 9.27032C16.7135 9.27032 16.4744 9.50939 16.4744 9.80157V15.0397C15.7785 15.2309 15.2313 15.7728 15.04 16.4688H10.3916C10.0994 16.4688 9.86035 16.7078 9.86035 17C9.86035 17.2922 10.0994 17.5313 10.3916 17.5313H15.04C15.2791 18.3919 16.06 19.0347 16.995 19.0347C18.116 19.0347 19.0297 18.1209 19.0297 17C19.0297 16.0597 18.3869 15.2788 17.521 15.0397V9.80157C17.521 9.50939 17.2872 9.27032 16.995 9.27032H17.0057Z"
                                    fill="#631E95" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-black text-sm font-semibold">Work hours</p>
                            <p class="text-gray-400 text-xs mt-0.5">Everyday, 10am to 7pm</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 rounded-xl px-4 py-5 bg-white"
                        style="border: 1px solid rgba(255,255,255,0.1);">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 bg-[#cdf6cc]">
                            <svg width="22" height="22" viewBox="0 0 27 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M24.3 0H2.7C1.215 0 0.0135 1.2375 0.0135 2.75L0 19.25C0 20.7625 1.215 22 2.7 22H24.3C25.785 22 27 20.7625 27 19.25V2.75C27 1.2375 25.785 0 24.3 0ZM24.3 5.5L13.5 12.375L2.7 5.5V2.75L13.5 9.625L24.3 2.75V5.5Z"
                                    fill="#097E1A" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-black text-sm font-semibold">Email</p>
                            <p class="text-gray-400 text-xs mt-0.5 truncate">regretconsultancy@gmail.com</p>
                        </div>
                    </div>

                </div>

                <div class="flex items-center gap-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full flex items-center justify-center transition hover:opacity-80">
                        <img src="{{ asset('image/icon/05.instagram.png') }}" alt="">
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full flex items-center justify-center transition hover:opacity-80">
                        <img src="{{ asset('image/icon/linkedln.png') }}" alt="">
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full flex items-center justify-center transition hover:opacity-80">
                        <img src="{{ asset('image/icon/google.png') }}" alt="">

                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="flex items-center justify-center py-10 px-6 max-w-7xl mx-auto">
        <div class="w-full max-w-6xl">
            <div
                class="bg-[#0276db] rounded-[25px] md:rounded-[40px] p-6 md:p-10 text-center flex flex-col items-center justify-center transition-all hover:shadow-2xl">

                <h2 class="text-white text-xl md:text-3xl lg:text-4xl font-semibold mb-6 tracking-tight"
                    style="text-shadow: 0 1px 0 rgba(0,0,0,0.6), 0 -1px 0 rgba(255,255,255,0.2);">
                    Ready to Join Our team?
                </h2>

                <p
                    class="text-white text-xs md:text-sm lg:text-base mb-10 max-w-2xl leading-relaxed uppercase tracking-widest opacity-90">
                    Explore career opportunities at REGRET CONSULTANCY and be part of our growing digital marketing
                    agency
                </p>

                <button
                    class="bg-[#15355c] text-white px-6 md:px-10 py-2 md:py-3 rounded-full text-sm md:text-base font-medium inline-flex items-center group transition-all duration-300 transform hover:scale-105 active:scale-95">
                    View Open Positions
                    <span class="ml-2 group-hover:translate-x-1 transition-transform duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </span>
                </button>

            </div>
        </div>
    </section>
    @include('layouts.footer')


</body>

</html>