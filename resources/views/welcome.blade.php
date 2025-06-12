<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">

    {{-- title --}}
    <title>
        Service Marketplace
    </title>
</head>

<body class="bg-white text-gray-800">

    {{-- Header --}}
    <header class="border-b shadow-sm bg-white">
        <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-indigo-700">
                Service Marketplace
            </h2>
            <nav class="space-x-4 text-sm font-medium">
                @auth
                    @if (Auth::user()->account_type == 'admin')
                        <a href="{{ route('admin.clients') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] leading-normal rounded-lg">
                            All client users
                        </a>
                    @else
                        <a href="{{ route('projects.index') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] leading-normal rounded-lg">
                            All open projects
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                        Sign Up
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    {{-- Hero --}}
    <section class="bg-gradient-to-br from-indigo-50 to-white py-20">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                Your One-Stop Marketplace for Hiring and Freelancing
            </h2>
            <p class="mt-5 text-lg text-gray-600 max-w-2xl mx-auto">
                Clients post projects. Freelancers bid. The best match connects and collaborates — all powered by
                real-time chat and seamless tools.
            </p>
            <div class="mt-8">
                <a href="{{ route('register') }}"
                    class="block w-max mx-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg text-lg font-semibold">
                    Get Started
                </a>
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <h3 class="text-center text-3xl font-bold text-gray-900 mb-14">
                How It Works
            </h3>
            <div class="grid md:grid-cols-3 gap-10 text-center">
                <div>
                    <div class="text-5xl mb-4">📝</div>
                    <h4 class="text-xl font-semibold mb-2">
                        1. Post a Project
                    </h4>
                    <p class="text-gray-600">
                        Clients create project listings describing their needs in detail.
                    </p>
                </div>
                <div>
                    <div class="text-5xl mb-4">📩</div>
                    <h4 class="text-xl font-semibold mb-2">
                        2. Receive Bids
                    </h4>
                    <p class="text-gray-600">
                        Freelancers browse listings and submit tailored proposals.
                    </p>
                </div>
                <div>
                    <div class="text-5xl mb-4">💬</div>
                    <h4 class="text-xl font-semibold mb-2">
                        3. Accept & Collaborate
                    </h4>
                    <p class="text-gray-600">
                        Clients accept bids and begin real-time chat to manage work smoothly.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="py-24 bg-indigo-50">
        <div class="max-w-6xl mx-auto px-6">
            <h3 class="text-center text-3xl font-bold text-gray-900 mb-14">
                Powerful Features for Success
            </h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
                    <h4 class="text-lg font-semibold mb-2 text-indigo-700">
                        Role-Based Access
                    </h4>
                    <p class="text-gray-600">
                        Admins, freelancers, and clients each have tailored dashboards and permissions.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
                    <h4 class="text-lg font-semibold mb-2 text-indigo-700">
                        Live Chat with Pusher
                    </h4>
                    <p class="text-gray-600">
                        Built-in messaging allows direct communication after project acceptance.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
                    <h4 class="text-lg font-semibold mb-2 text-indigo-700">
                        Project Management
                    </h4>
                    <p class="text-gray-600">
                        Track active projects, bids, messages, and milestones with ease.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-indigo-600 py-16 text-white text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h3 class="text-3xl font-bold">
                Start Posting or Bidding Today
            </h3>
            <p class="mt-4 text-lg">
                Join a growing network of professionals and clients building the future of remote work.
            </p>
            <a href="{{ route('register') }}"
                class="mt-6 inline-block bg-white text-indigo-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Create Your Free Account
            </a>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-white text-center py-6 text-gray-500">
        <p class="mx-auto text-md font-bold">
            &copy; 2025 Service Marketplace | All rights reserved | code BPdevelopment
        </p>
    </footer>

</body>

</html>