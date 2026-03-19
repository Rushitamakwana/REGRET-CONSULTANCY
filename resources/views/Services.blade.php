<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Title set by layout --}}
    <title>Services - Regret Consultancy</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('image/Favicon.jpeg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('image/Favicon.jpeg') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #000;
            color: #fff;
            font-family: 'Inter', sans-serif
        }

        .text-cyan {
            color: #0276db
        }

        .bg-cyan {
            background: #0276db
        }

        .border-cyan {
            border-color: #0276db
        }

        .process-line {
            position: absolute;
            top: 50%;
            left: 100%;
            width: 100%;
            height: 2px;
            background: #0276db;
            z-index: -1
        }

        .hero-gradient {
            background: radial-gradient(circle at 120% 200%, #0276db 0%, #000000 65%);
            min-height: 60vh;
        }

        .card-border {
            border: 1px solid rgba(56, 189, 248, .2);
            transition: .3s
        }
    </style>
</head>

<body class="antialiased">

    <section class="hero-gradient relative w-full flex flex-col">
        @include('layouts.header')
        <main class="flex-grow flex flex-col items-center justify-start pt-10 px-6 text-center">

            <div class="flex items-center gap-2 text-sm mb-4">
                <a href="/"> <span class="text-white opacity-80">Home</span> </a>
                >
                <span class="text-[#0276db] font-medium">Service</span>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold max-w-5xl leading-snug mb-10 text-[#ffffff]">
                Comprehensive digital marketing solution Designed to help your brand

                <span class="text-[#aaaeaf]">
                    grow, engage, and convert in the digital landscape.
                </span>
            </h1>

        </main>
    </section>


    <section class="py-14 px-6 max-w-6xl mx-auto">

        @forelse($services as $index => $service)

            @php
                $isEven = $index % 2 === 0;
                $serviceNumber = str_pad($index + 1, 2, '0', STR_PAD_LEFT);

                $icons = ['fa-chart-line', 'fa-lightbulb', 'fa-rocket', 'fa-gear', 'fa-bullseye'];
                $icon = $icons[$index % count($icons)];

                $imageUrl = $service->image
                    ? asset('uploads/services/' . $service->image)
                    : 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80';

                $deliverablesList = $service->deliverables ? explode("\n", trim($service->deliverables)) : [];
                $serviceDeliverables = array_filter(array_map('trim', $deliverablesList));
            @endphp


            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-20">

                @if($isEven)

                    <div class="rounded-3xl overflow-hidden shadow-2xl h-80 md:h-96">
                        <img src="{{ $imageUrl }}" class="w-full h-full object-contain">
                    </div>

                    <div class="space-y-5">

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 border border-cyan flex items-center justify-center rounded">
                                <i class="fa-solid {{ $icon }} text-cyan text-xs"></i>
                            </div>
                            <span class="text-2xl font-bold text-cyan">{{ $serviceNumber }}</span>
                        </div>

                        <h2 class="text-4xl font-bold text-cyan">
                            {{ $service->title }}
                        </h2>

                        <p class="text-gray-300 text-lg leading-relaxed">
                            {{ $service->description }}
                        </p>

                        <div class="space-y-2">
                            <p class="text-cyan font-bold">Key Deliverables:</p>

                            <ul class="space-y-2 text-gray-300">

                                @forelse($serviceDeliverables as $deliverable)

                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                        {{ $deliverable }}
                                    </li>

                                @empty
                                    <li>No deliverables specified</li>
                                @endforelse

                            </ul>
                        </div>

                        <div class="flex gap-4 pt-3">
                            <a href="{{ route('services.show', $service->id) }}"
                                class="bg-cyan text-black font-bold py-3 px-8 rounded-full hover:bg-opacity-90 transition block text-center">
                                View Details
                            </a>

                            <a href="/contact"
                                class="border border-white py-3 px-8 rounded-full hover:bg-white hover:text-black transition no-underline inline-block">
                                Get started
                            </a>
                        </div>

                    </div>

                @else

                    <div class="order-2 md:order-1 space-y-5">

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 border border-cyan flex items-center justify-center rounded">
                                <i class="fa-solid {{ $icon }} text-cyan text-xs"></i>
                            </div>
                            <span class="text-2xl font-bold text-cyan">{{ $serviceNumber }}</span>
                        </div>

                        <h2 class="text-4xl font-bold text-cyan">
                            {{ $service->title }}
                        </h2>

                        <p class="text-gray-300 text-lg leading-relaxed">
                            {{ $service->description }}
                        </p>

                        <div class="space-y-2">
                            <p class="text-cyan font-bold">Key Deliverables:</p>

                            <ul class="space-y-2 text-gray-300">

                                @foreach($serviceDeliverables as $deliverable)

                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                        {{ $deliverable }}
                                    </li>

                                @endforeach

                            </ul>
                        </div>

                        <div class="flex gap-4 pt-3">
                            <a href="{{ route('services.show', $service->id) }}"
                                class="bg-cyan text-black font-bold py-3 px-8 rounded-full hover:bg-opacity-90 transition block text-center">
                                View Details
                            </a>

                            <a href="/contact"
                                class="border border-white py-3 px-8 rounded-full hover:bg-white hover:text-black transition no-underline inline-block">
                                Get started
                            </a>
                        </div>

                    </div>

                    <div class="order-1 md:order-2 rounded-3xl overflow-hidden shadow-2xl h-80 md:h-96">
                        <img src="{{ $imageUrl }}" class="w-full h-full object-contain">
                    </div>

                @endif

            </div>

        @empty

            <div class="text-center py-16">
                <p class="text-gray-400 text-lg">
                    No active services available at the moment.
                </p>
            </div>

        @endforelse

    </section>


    <section class="py-14 px-6 max-w-6xl mx-auto text-center">

        <div class="flex items-center justify-center gap-4 mb-2">
            <div class="h-[1px] w-12 bg-gray-500"></div>
            <span class="uppercase tracking-widest text-sm font-medium text-gray-400">
                How We Work
            </span>
            <div class="h-[1px] w-12 bg-gray-500"></div>
        </div>

        <h2 class="text-5xl font-bold text-cyan mb-6">
            Our Process
        </h2>

        <p class="text-gray-400 max-w-2xl mx-auto mb-10">
            A proven methodology that delivers consistent results for our clients.
        </p>


        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 relative">

            <div class="flex flex-col items-center">
                <div
                    class="relative w-24 h-24 rounded-full bg-cyan flex items-center justify-center text-black text-3xl font-bold mb-6">
                    01
                    <div class="hidden md:block process-line"></div>
                </div>
                <h3 class="text-xl font-bold mb-2">Discovery</h3>
                <p class="text-gray-400 text-sm">
                    We understand your business, goals, and target audience.
                </p>
            </div>

            <div class="flex flex-col items-center">
                <div
                    class="relative w-24 h-24 rounded-full bg-cyan flex items-center justify-center text-black text-3xl font-bold mb-6">
                    02
                    <div class="hidden md:block process-line"></div>
                </div>
                <h3 class="text-xl font-bold mb-2">Strategy</h3>
                <p class="text-gray-400 text-sm">
                    We develop a customized marketing strategy.
                </p>
            </div>

            <div class="flex flex-col items-center">
                <div
                    class="relative w-24 h-24 rounded-full bg-cyan flex items-center justify-center text-black text-3xl font-bold mb-6">
                    03
                    <div class="hidden md:block process-line"></div>
                </div>
                <h3 class="text-xl font-bold mb-2">Execution</h3>
                <p class="text-gray-400 text-sm">
                    We implement the strategy with precision.
                </p>
            </div>

            <div class="flex flex-col items-center">
                <div
                    class="relative w-24 h-24 rounded-full bg-cyan flex items-center justify-center text-black text-3xl font-bold mb-6">
                    04
                </div>
                <h3 class="text-xl font-bold mb-2">Optimization</h3>
                <p class="text-gray-400 text-sm">
                    We monitor and improve campaign performance.
                </p>
            </div>

        </div>

    </section>


    <section class="py-14 px-6 max-w-4xl mx-auto text-center">
        <div class="flex items-center justify-center gap-4 mb-2">
            <div class="h-[1px] w-12 bg-gray-600"></div> <span
                class="uppercase tracking-[0.3em] text-xs font-semibold text-gray-400">Why Us</span>
            <div class="h-[1px] w-12 bg-gray-600"></div>
        </div>

        <h2 class="text-5xl font-bold text-cyan mb-6">
            Why Choose
        </h2>

        <p class="text-gray-400 mb-10 max-w-2xl mx-auto">
            We combine creativity with data-driven strategies to deliver marketing solutions that work.
        </p>

        <div class="space-y-4">

            <div class="flex items-center gap-4 bg-[#4c4c4c] border border-[#0276db] p-4 rounded-full">
                <div class="w-10 h-10 bg-cyan rounded-full flex items-center justify-center text-black font-bold">01
                </div>
                <div class="text-left">
                    <h4 class="font-bold">Result-Driven Approach</h4>
                    <p class="text-gray-400 text-sm">we focus on delivery measurable outcomes that impactyour bottom
                        line</p>
                </div>
            </div>

            <div class="flex items-center gap-4 bg-[#4c4c4c] border border-[#0276db] p-4 rounded-full">
                <div class="w-10 h-10 bg-cyan rounded-full flex items-center justify-center text-black font-bold">02
                </div>
                <div class="text-left">
                    <h4 class="font-bold">Expert Team</h4>
                    <p class="text-gray-400 text-sm">Work With Experienced professionals who understand the digital
                        Landscape.</p>
                </div>
            </div>

            <div class="flex items-center gap-4 bg-[#4c4c4c] border border-[#0276db] p-4 rounded-full">
                <div class="w-10 h-10 bg-cyan rounded-full flex items-center justify-center text-black font-bold">03
                </div>
                <div class="text-left">
                    <h4 class="font-bold">Dedicated Support</h4>
                    <p class="text-gray-400 text-sm">Get personalized attention and ongoing support throughout your
                        journey.</p>
                </div>
            </div>

        </div>

    </section>


    <section class="bg-black flex items-center justify-center py-16 p-4">

        <div class="bg-[#a2c6fd] w-full max-w-6xl rounded-[40px] px-8 py-12 text-center shadow-lg">

            <h2 class="text-[#0276db] text-3xl md:text-4xl font-semibold mb-4">
                Ready to Join Our Team?
            </h2>

            <p class="text-[#0276db] text-sm md:text-base  tracking-wide max-w-2xl mx-auto mb-8">
                Explore career opportunities at REGRET CONSULTANCY and be part of our growing digital
                marketing agency
            </p>

            <a href="/Career"
                class="bg-[#15355c]  text-white px-6 md:px-10 py-3 md:py-4 rounded-full text-sm md:text-base font-medium inline-flex items-center group transition-all duration-300 transform hover:scale-105 active:scale-95">
                View Open Positions <span class="ml-2 group-hover:translate-x-1 transition-transform duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </span>
            </a>

        </div>

    </section>

    @include('layouts.footer')
</body>

</html>