<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Recruitment Hub - CareerConnect</title>

    <!-- Use Tailwind Play CDN (v3+) for the utility classes used in the layout -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Posting modal edit appearance */
        .posting-input {
            background: #F7F7F8;
            border: 1px solid #E6E6E9;
            padding: .75rem .9rem;
            border-radius: .6rem;
            font-size: 0.95rem;
            color: #222;
        }
        .field-label {
            color: #6B7280;
            font-weight: 600;
        }
        #postingModal[data-editing="true"] .submit-btn {
            background: #111827;
            color: #fff;
        }
        .submit-btn {
            background: #10B981;
            color: white;
            padding: .6rem 1rem;
            border-radius: .6rem;
            font-weight: 600;
        }
        .validation-tooltip {
            background: rgba(99, 102, 241, 0.08);
            color: #374151;
            padding: .45rem .6rem;
            border-radius: 9999px;
            font-size: .85rem;
            position: absolute;
            right: 0.25rem;
            top: -1.4rem;
            border: 1px solid rgba(99,102,241,0.08);
        }
        .dropdown-menu { display: none; }
        .dropdown-menu.show { display:block; }

        /* refined tooltip look */
        .validation-tooltip {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: -44px;
            background: rgba(107,114,128,0.95);
            color: #fff;
            padding: 8px 12px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            z-index: 60;
            box-shadow: 0 6px 18px rgba(15,23,42,0.2);
            white-space: nowrap;
        }
        .validation-tooltip svg { width: 16px; height: 16px; flex: 0 0 16px; }

        .empty-comments { text-align: center; color: #9CA3AF; }
        .empty-comments svg { display: block; margin: 0 auto; }
        .no-comments-input input { background: #F9FAFB; }
        img.logo { height: 34px; width: auto; }
        @media (min-width: 768px) { img.logo { height: 36px; } }
        svg.icon { width: 18px; height: 18px; }
        svg.icon-lg { width: 20px; height: 20px; }
        .btn .icon { margin-right: 6px; }

        button.btn-edit {
            background: #EEF6FF !important;
            color: #1D4ED8 !important;
            border-radius: 12px !important;
            padding: 10px 18px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            border: 1px solid rgba(29,78,216,0.08) !important;
            box-shadow: 0 6px 14px rgba(15,23,42,0.04) !important;
            font-weight: 600 !important;
            transition: background .12s ease, transform .06s ease;
        }
        button.btn-edit svg { color: #1D4ED8; fill: currentColor; width: 20px; height: 20px; }
        button.btn-edit:hover { background: #E6F0FF !important; }
        button.btn-edit:active, button.btn-edit.pressed { background: #DCEFFF !important; transform: translateY(1px); }

        /* Posting modal specialized styles */
        #postingModal .posting-input {
            background: #F3F4F6;
            border: none;
            padding: 14px 16px;
            border-radius: 12px;
            box-shadow: none;
            color: #111827;
        }
        #postingModal .posting-input::placeholder { color: #9CA3AF; }
        #postingModal textarea.posting-input { min-height: 140px; }
        #postingModal.editing h3 { font-weight: 700; }
        #postingModal .submit-btn { background: #000; color: #fff; border-radius: 999px; padding: 10px 28px; }
        #postingModal .field-label { font-weight: 600; color: #111827; }

        /* ensure modals sit above other elements */
        #postingModal, #jobDetailModal, #deleteConfirmModal { z-index: 60; }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <!-- NAVBAR (use Tailwind only to match design precisely) -->
    <nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('images/logokita.png') }}" alt="CareerConnect Logo" class="logo">
            <a href="{{ route('home') }}" class="text-lg font-bold text-gray-800">CareerConnect</a>
        </div>

        <div class="flex items-center space-x-8">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="{{ route('recruitment') }}" class="text-gray-800 hover:text-blue-600 font-semibold">Recruitment</a>
                <a href="{{ url('/profile') }}" class="text-gray-600 hover:text-blue-600">My Profile</a>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-gray-700">Kevin Gultom</span>
                <img src="https://via.placeholder.com/32" alt="User Avatar" class="rounded-full h-8 w-8 object-cover">
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto p-6">
        <header class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-1">Recruitment Hub</h1>
            <p class="text-gray-600">Lowongan pekerjaan yang dibagikan langsung oleh alumni di berbagai perusahaan</p>
        </header>

        <!-- FILTERS CARD -->
        <section class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <div class="relative">
                    <label class="text-sm font-medium text-gray-700 mb-1 block">Job Type</label>
                    <button id="jobTypeBtn" class="bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-3 py-2 text-left w-full flex justify-between items-center">
                        <span id="selectedJobType" class="text-sm">Semua</span>
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="jobTypeDropdown" class="dropdown-menu absolute mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto sm:text-sm">
                        <a href="#" class="block text-gray-900 py-2 px-3 hover:bg-blue-100" data-value="Semua">Semua</a>
                        <a href="#" class="block text-gray-900 py-2 px-3 hover:bg-blue-100" data-value="Full-time">Full-time</a>
                        <a href="#" class="block text-gray-900 py-2 px-3 hover:bg-blue-100" data-value="Part-time">Part-time</a>
                        <a href="#" class="block text-gray-900 py-2 px-3 hover:bg-blue-100" data-value="Internship">Internship</a>
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700 mb-1 block">Cari</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="search" class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-200 focus:border-blue-500 text-sm" placeholder="Cari lowongan, perusahaan, lokasi...">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button id="openPostingBtn" class="inline-flex items-center px-4 py-2 rounded-md shadow text-white bg-black hover:bg-gray-800">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                        Posting Lowongan
                    </button>
                </div>
            </div>

            <div class="mt-4 relative">
                <label class="text-sm font-medium text-gray-700 mb-1 block">Kategori</label>
                <div class="flex items-center">
                    <div class="relative">
                        <button id="kategoriBtn" class="bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-3 py-2 text-left w-48 flex justify-between items-center">
                            <span id="selectedKategori" class="text-sm">Semua Kategori</span>
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </button>
                        <div id="kategoriDropdown" class="dropdown-menu absolute mt-1 w-48 bg-white shadow-lg max-h-60 rounded-md py-1 ring-1 ring-black ring-opacity-5 overflow-auto sm:text-sm">
                            <a href="#" class="block py-2 px-3 hover:bg-blue-100" data-value="Semua Kategori">Semua Kategori</a>
                            <a href="#" class="block py-2 px-3 hover:bg-blue-100" data-value="Teknologi & IT">Teknologi & IT</a>
                            <a href="#" class="block py-2 px-3 hover:bg-blue-100" data-value="Design & Creative">Design & Creative</a>
                            <a href="#" class="block py-2 px-3 hover:bg-blue-100" data-value="Business & Marketing">Business & Marketing</a>
                            <a href="#" class="block py-2 px-3 hover:bg-blue-100" data-value="Data & Analytics">Data & Analytics</a>
                            <a href="#" class="block py-2 px-3 hover:bg-blue-100" data-value="Finance & Banking">Finance & Banking</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- JOB LISTINGS -->
        <section id="job-listings" class="space-y-6">

            <!-- CARD #1 -->
            <article class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center">
                        <img src="https://via.placeholder.com/40" alt="Sarah Putri Avatar" class="rounded-full h-10 w-10 mr-4 object-cover">
                        <div>
                            <p class="font-semibold text-gray-900">Sarah Putri</p>
                            <p class="text-sm text-gray-500">Senior Software Engineer</p>
                            <p class="text-xs text-gray-400">ITB - Teknik Informatika 2018</p>
                        </div>
                    </div>
                    <button class="text-blue-600 hover:underline text-sm lihatDetailBtn">Lihat Detail</button>
                </div>

                <div class="border border-gray-200 rounded-lg p-4 mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <img src="https://via.placeholder.com/20" alt="Company Logo" class="h-5 w-5 mr-2 object-cover">
                            <div>
                                <p class="font-semibold text-gray-800">Frontend Developer</p>
                                <p class="text-sm text-gray-600">JW Marriott</p>
                                <p class="text-xs text-gray-500 flex items-center">
                                    <svg class="h-3 w-3 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                    Medan
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Full-time</span>
                            <p class="text-xs text-gray-500 mt-1">2 jam lalu</p>
                            <button class="ml-2 text-gray-400 hover:text-gray-600">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm10 0H7v6l2-2 2 2V5z" clip-rule="evenodd"/></svg>
                            </button>
                        </div>
                    </div>
                    <p class="text-sm text-gray-700 mt-2">Kami sedang mencari Frontend Developer yang passionate untuk bergabung dengan tim kami. Bertanggung jawab atas pengembangan fitur baru menggunakan React, TypeScript, dan Next.js untuk membangun produk yang digunakan oleh jutaan pengguna.</p>
                </div>

                <div class="space-y-3 mb-4">
                    <div class="comments-list">
                        <div class="comment-item bg-gray-50 p-3 rounded-md">
                            <p class="font-medium text-gray-800">Ahmad Fauzi <span class="text-xs text-gray-500 ml-2">1 jam lalu</span></p>
                            <p class="text-sm text-gray-700">wah opportunity bagus nih! Requirements-nya cocok sama background saya. Thanks for sharing kak Sarah!</p>
                        </div>
                        <div class="comment-item bg-gray-50 p-3 rounded-md">
                            <p class="font-medium text-gray-800">Maya Sari Sibuea <span class="text-xs text-gray-500 ml-2">2 jam lalu</span></p>
                            <p class="text-sm text-gray-700">Company culture-nya gimana kak? Apakah beginner-friendly untuk fresh graduate?</p>
                        </div>
                    </div>

                    <div class="empty-comments hidden py-10">
                        <div class="text-center text-gray-400">
                            <svg class="mx-auto mb-4" width="56" height="56" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 22s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z" stroke="#9CA3AF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 11.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" stroke="#9CA3AF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <p class="font-semibold text-gray-700">Tidak ada komentar</p>
                            <p class="text-sm text-gray-500">Tinggalkan komentar anda disini</p>
                        </div>
                    </div>

                    <div class="no-comments-input hidden mt-6">
                        <input type="text" placeholder="Tulis komentar ..." class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm bg-gray-50">
                        <div class="flex items-center justify-between mt-3">
                            <button class="inline-flex items-center px-4 py-2 rounded-md text-sm bg-gray-200 text-gray-700">
                                <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884l8 4.8a1 1 0 00.994 0l8-4.8A1 1 0 0018 4H2a1 1 0 00.003 1.884z"/></svg>
                                Kirim Komentar
                            </button>
                            <div class="space-x-3">
                                <button class="inline-flex items-center px-4 py-2 text-sm bg-gray-200 text-gray-700 btn-edit">
                                    <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-7 7A2 2 0 018.172 17H2v-5.172a2 2 0 01.586-1.414l7-7zM7 11a1 1 0 100 2h.01a1 1 0 100-2H7z"/></svg>
                                    Edit
                                </button>
                                <button class="inline-flex items-center px-4 py-2 text-sm bg-red-100 text-red-700 btn-delete">
                                    <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="relative flex-1 mr-4">
                        <input type="text" placeholder="Tulis komentar..." class="w-full border border-gray-300 rounded-md py-2 pl-3 pr-10 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <button class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-blue-600">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" /></svg>
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="inline-flex items-center px-4 py-2 text-sm bg-blue-100 text-blue-700 rounded-md">Edit</button>
                        <button class="inline-flex items-center px-4 py-2 text-sm bg-red-100 text-red-700 rounded-md">Hapus</button>
                    </div>
                </div>
            </article>

            <!-- CARD #2 (keeps the same structure) -->
            <article class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center">
                        <img src="https://via.placeholder.com/40" alt="Budi Santoso Avatar" class="rounded-full h-10 w-10 mr-4 object-cover">
                        <div>
                            <p class="font-semibold text-gray-900">Budi Santoso</p>
                            <p class="text-sm text-gray-500">Product Manager</p>
                            <p class="text-xs text-gray-400">ITB - Sistem Informasi 2018</p>
                        </div>
                    </div>
                    <button class="text-blue-600 hover:underline text-sm lihatDetailBtn">Lihat Detail</button>
                </div>

                <div class="border border-gray-200 rounded-lg p-4 mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <img src="https://via.placeholder.com/20" alt="Company Logo" class="h-5 w-5 mr-2 object-cover">
                            <div>
                                <p class="font-semibold text-gray-800">UI/UX Designer</p>
                                <p class="text-sm text-gray-600">Shopee</p>
                                <p class="text-xs text-gray-500 flex items-center">
                                    <svg class="h-3 w-3 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                    Bandung
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Internship</span>
                            <p class="text-xs text-gray-500 mt-1">2 jam lalu</p>
                            <button class="ml-2 text-gray-400 hover:text-gray-600">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm10 0H7v6l2-2 2 2V5z" clip-rule="evenodd"/></svg>
                            </button>
                        </div>
                    </div>
                    <p class="text-sm text-gray-700 mt-2">Startup fintech yang sedang berkembang pesat mencari UI/UX Designer Intern yang kreatif dan detail-oriented. Kesempatan bagus untuk belajar langsung dari senior designer dan berkontribusi pada produk yang impact-nya besar.</p>
                </div>

                <div class="space-y-3 mb-4">
                    <div class="comments-list">
                        <div class="comment-item bg-gray-50 p-3 rounded-md">
                            <p class="font-medium text-gray-800">Lisa Andriani <span class="text-xs text-gray-500 ml-2">1 jam lalu</span></p>
                            <p class="text-sm text-gray-700">Startup fintech-nya cepat banget! Recommended untuk yang mau belajar fast-paced environment.</p>
                        </div>
                        <div class="comment-item bg-gray-50 p-3 rounded-md">
                            <p class="font-medium text-gray-800">Abdul Manaf <span class="text-xs text-gray-500 ml-2">2 jam lalu</span></p>
                            <p class="text-sm text-gray-700">Company culture-nya gimana kak? Apakah beginner-friendly untuk fresh graduate?</p>
                        </div>
                        <p class="text-sm text-blue-600 hover:underline cursor-pointer">Komentar lainnya (5)</p>
                    </div>

                    <div class="empty-comments hidden py-10">
                        <div class="text-center text-gray-400">
                            <svg class="mx-auto mb-4" width="56" height="56" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 22s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z" stroke="#9CA3AF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 11.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" stroke="#9CA3AF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <p class="font-semibold text-gray-700">Tidak ada komentar</p>
                            <p class="text-sm text-gray-500">Tinggalkan komentar anda disini</p>
                        </div>
                    </div>

                    <div class="no-comments-input hidden mt-6">
                        <input type="text" placeholder="Tulis komentar ..." class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm bg-gray-50">
                        <div class="flex items-center justify-between mt-3">
                            <button class="inline-flex items-center px-4 py-2 rounded-md text-sm bg-gray-200 text-gray-700">
                                <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884l8 4.8a1 1 0 00.994 0l8-4.8A1 1 0 0018 4H2a1 1 0 00.003 1.884z"/></svg>
                                Kirim Komentar
                            </button>
                            <div class="space-x-3">
                                <button class="inline-flex items-center px-4 py-2 text-sm bg-gray-200 text-gray-700 btn-edit">
                                    <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-7 7A2 2 0 018.172 17H2v-5.172a2 2 0 01.586-1.414l7-7zM7 11a1 1 0 100 2h.01a1 1 0 100-2H7z"/></svg>
                                    Edit
                                </button>
                                <button class="inline-flex items-center px-4 py-2 text-sm bg-red-100 text-red-700 btn-delete">
                                    <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="relative flex-1 mr-4">
                        <input type="text" placeholder="Tulis komentar..." class="w-full border border-gray-300 rounded-md py-2 pl-3 pr-10 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <button class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-blue-600">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" /></svg>
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="inline-flex items-center px-4 py-2 text-sm bg-blue-100 text-blue-700 rounded-md">Edit</button>
                        <button class="inline-flex items-center px-4 py-2 text-sm bg-red-100 text-red-700 rounded-md">Hapus</button>
                    </div>
                </div>
            </article>

        </section>
    </main>

    <!-- Delete confirmation modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 hidden items-center justify-center">
        <div id="deleteConfirmOverlay" class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative bg-white rounded-lg max
                <div class="flex items-center justify-between">
                    <div class="relative w-full mr-4">
                        <input type="text" placeholder="Tulis komentar..." class="w-full border border-gray-300 rounded-md py-2 pl-3 pr-10 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <button class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-blue-600">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </button>
                    </div>
                    <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-2">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-7 7A2 2 0 018.172 17H2v-5.172a2 2 0 01.586-1.414l7-7zM7 11a1 1 0 100 2h.01a1 1 0 100-2H7z" />
                        </svg>
                        Edit
                    </button>
                    <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
        </div>

    </div>
    <!-- Delete confirmation modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 z-60 hidden items-center justify-center">
        <div id="deleteConfirmOverlay" class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative bg-white rounded-lg max-w-md w-[90%] p-6 z-10 shadow-lg">
            <h3 class="text-lg font-semibold mb-2">Hapus Posting?</h3>
            <p class="text-sm text-gray-600 mb-4">Apakah Anda yakin ingin menghapus postingan ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex justify-end space-x-3">
                <button id="cancelDeleteBtn" class="px-4 py-2 rounded-md bg-gray-200">Batal</button>
                <button id="confirmDeleteBtn" class="px-4 py-2 rounded-md bg-red-600 text-white">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Posting modal -->
    <div id="postingModal" class="fixed inset-0 z-50 hidden items-center justify-center">
        <div id="postingModalOverlay" class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative bg-white rounded-2xl max-w-3xl w-[95%] md:w-[720px] p-6 z-10 shadow-xl">
            <button id="closePostingModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800">✕</button>
            <h3 class="text-xl font-semibold mb-1">Posting Lowongan Baru</h3>
            <p class="text-sm text-gray-500 mb-4">Bagikan informasi lowongan di perusahaan Anda kepada adik-adik mahasiswa</p>

            <form id="postingForm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="relative">
                        <label class="text-sm field-label mb-1">Nama Perusahaan</label>
                        <input id="postingCompany" type="text" class="posting-input mt-1 block w-full" placeholder="e.g. TechCorp Indonesia">
                    </div>
                    <div class="relative">
                        <label class="text-sm field-label mb-1">Posisi</label>
                        <input id="postingPosition" type="text" class="posting-input mt-1 block w-full" placeholder="e.g. Frontend Developer">
                    </div>

                    <div>
                        <label class="text-sm field-label mb-1">Kategori</label>
                        <div class="relative mt-1">
                            <button type="button" id="modalKategoriBtn" class="w-full text-left border border-gray-200 rounded-md p-3 flex justify-between items-center">
                                <span id="modalKategoriSelected">Pilih Kategori</span>
                                <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                            </button>
                            <div id="modalKategoriDropdown" class="hidden absolute left-0 mt-2 w-full bg-white border border-gray-200 rounded-md shadow-sm z-20">
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-value="Teknologi & IT">Teknologi & IT</button>
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-value="Design & Creative">Design & Creative</button>
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-value="Business & Marketing">Business & Marketing</button>
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-value="Data & Analytics">Data & Analytics</button>
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-value="Finance & Banking">Finance & Banking</button>
                            </div>
                            <input type="hidden" name="kategori" id="postingKategoriInput" value="">
                        </div>
                    </div>
                    <div>
                        <label class="text-sm field-label mb-1">Tipe Pekerjaan</label>
                        <div class="relative mt-1">
                            <button type="button" id="modalTipeBtn" class="w-full text-left border border-gray-200 rounded-md p-3 flex justify-between items-center">
                                <span id="modalTipeSelected">Pilih Tipe Pekerjaan</span>
                                <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                            </button>
                            <div id="modalTipeDropdown" class="hidden absolute left-0 mt-2 w-full bg-white border border-gray-200 rounded-md shadow-sm z-20">
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-value="Full-time">Full-time</button>
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-value="Part-time">Part-time</button>
                                <button class="w-full text-left px-4 py-2 hover:bg-gray-100" data-value="Internship">Internship</button>
                            </div>
                            <input type="hidden" name="tipe_pekerjaan" id="postingTipeInput" value="">
                        </div>
                    </div>

                    <div class="relative">
                        <label class="text-sm field-label mb-1">Lokasi</label>
                        <input id="postingLokasi" type="text" class="posting-input mt-1 block w-full" placeholder="e.g. Jakarta">
                    </div>
                    <div></div>
                    <div class="md:col-span-2 relative">
                        <label class="text-sm field-label mb-1">Deskripsi Pekerjaan</label>
                        <textarea id="postingDeskripsi" class="posting-input mt-1 block w-full" placeholder="Jelaskan tentang posisi ini, tanggung jawab dan apa yang dicari (Optional)"></textarea>
                    </div>

                    <div class="md:col-span-2 relative">
                        <label class="text-sm field-label mb-1">Link</label>
                        <input id="postingLink" type="text" class="posting-input mt-1 block w-full" placeholder="e.g. https://www.TechCorp.com/...">
                    </div>

                    <div>
                        <label class="text-sm field-label mb-1">Gambar</label>
                        <div class="mt-1">
                            <input id="postingImage" type="file" class="block w-full text-sm text-gray-500" />
                        </div>
                    </div>

                </div>

                <div class="mt-6 text-center">
                    <button type="button" id="submitPosting" class="submit-btn px-6 py-2 bg-black text-white rounded-full">Posting</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Job Detail modal -->
    <div id="jobDetailModal" class="fixed inset-0 z-50 hidden items-start justify-center pt-12">
        <div id="jobDetailOverlay" class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative bg-white rounded-2xl max-w-5xl w-[95%] p-6 z-10 shadow-xl">
            <button id="closeJobDetail" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800">✕</button>
            <h2 class="text-2xl font-semibold text-blue-600 mb-4">Detail Lengkap</h2>
            <p class="text-sm text-gray-600 mb-6">Lowongan pekerjaan yang dibagikan langsung oleh alumni di berbagai perusahaan</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <img id="detailImage" src="https://via.placeholder.com/400x240" alt="Job Image" class="w-full rounded-lg shadow-md mb-4">
                    <div id="detailCard" class="bg-blue-50 rounded-xl p-4">
                        <div class="d-flex align-items-center mb-2">
                            <div class="h-9 w-9 bg-gray-200 rounded-md mr-3 d-flex align-items-center justify-content-center">
                                <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 13.5V7a2 2 0 012-2h14a2 2 0 012 2v6.5" stroke="#111827" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/><rect x="7" y="9" width="10" height="7" rx="1" stroke="#111827" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <div>
                                <p id="detailTitle" class="font-semibold text-gray-900">Frontend Developer</p>
                                <p id="detailCompany" class="text-sm text-gray-600">Company</p>
                                <p id="detailLocation" class="text-xs text-gray-500 d-flex align-items-center">Medan</p>
                            </div>
                        </div>
                        <div class="text-right text-xs text-gray-400"> <span id="detailTime">1 jam lalu</span> </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p id="detailAuthor" class="font-semibold">Author Name</p>
                            <p id="detailAuthorRole" class="text-sm text-gray-500">Senior Software Engineer</p>
                            <p id="detailAuthorAlumni" class="text-xs text-gray-400">ITB - Teknik Informatika 2018</p>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-md p-4 mb-4">
                        <h3 class="font-semibold mb-2">Deskripsi Pekerjaan</h3>
                        <div id="detailDescription" class="text-sm text-gray-700 leading-relaxed">
                            <p>Deskripsi akan muncul di sini ketika Anda menekan tombol lihat detail pada sebuah posting.</p>
                        </div>
                        <p class="mt-3 text-xs"><a href="#" class="text-blue-600">Detail : Lihat Selengkapnya..</a></p>
                    </div>

                    <div class="bg-white border border-gray-100 rounded-lg p-6">
                        <h4 class="font-semibold mb-4">Diskusi & Pertanyaan</h4>
                        <div class="comments-section" id="detailCommentsSection">
                            <!-- comments will be cloned here if desired -->
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm text-gray-600 mb-2">Tambah Komentar</label>
                            <input id="detailNewComment" type="text" placeholder="Tulis komentar ..." class="w-full border border-gray-300 rounded-md py-2 pl-3 pr-10 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm bg-gray-50">
                            <div class="flex justify-end mt-3">
                                <button id="detailSendComment" class="inline-flex items-center px-4 py-2 rounded-md text-sm bg-gray-200 text-gray-700">
                                    <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884l8 4.8a1 1 0 00.994 0l8-4.8A1 1 0 0018 4H2a1 1 0 00.003 1.884z"/></svg>
                                    Kirim Komentar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal posting logic
        const openPostingBtn = document.getElementById('openPostingBtn');
        const postingModal = document.getElementById('postingModal');
        const closePostingModal = document.getElementById('closePostingModal');
        const postingOverlay = document.getElementById('postingModalOverlay');

        function openModal() {
            // reset to create mode when opening via Posting button
            resetPostingModalForCreate();
            postingModal.classList.remove('hidden');
            postingModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }
        function closeModal() {
            postingModal.classList.add('hidden');
            postingModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }
        openPostingBtn && openPostingBtn.addEventListener('click', (e) => { e.preventDefault(); openModal(); });
        closePostingModal && closePostingModal.addEventListener('click', closeModal);
        postingOverlay && postingOverlay.addEventListener('click', closeModal);
        window.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

        // Submit handler with validation
        const submitPostingBtn = document.getElementById('submitPosting');
        function clearValidationTooltips(scope) {
            const existing = (scope || document).querySelectorAll('.validation-tooltip');
            existing.forEach(el => el.remove());
        }
        function showValidationTooltip(container, message = 'Please fill out this field') {
            clearValidationTooltips(container);
            const tip = document.createElement('div');
            tip.className = 'validation-tooltip';
            tip.innerHTML = `
                <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.172 2.172a1 1 0 011.656 0l7 11A1 1 0 0117.172 16H2.828a1 1 0 01-.656-1.828l7-11z" fill="#F59E0B"/><path d="M10 7a1 1 0 10-2 0v2a1 1 0 102 0V7zm0 6a1 1 0 100-2 1 1 0 000 2z" fill="#fff"/></svg>
                <span>${message}</span>
            `;
            // ensure the container is positioned relative for absolute tooltip
            if (container && getComputedStyle(container).position === 'static') {
                container.style.position = 'relative';
            }
            container.appendChild(tip);
            // remove after 3.2s
            setTimeout(() => tip.remove(), 3200);
        }

        function validatePostingForm() {
            clearValidationTooltips(document.getElementById('postingModal') || document);
            const company = document.getElementById('postingCompany');
            const position = document.getElementById('postingPosition');
            const kategori = document.getElementById('postingKategoriInput');
            const tipe = document.getElementById('postingTipeInput');
            const lokasi = document.getElementById('postingLokasi');
            const link = document.getElementById('postingLink');

            const checks = [
                { el: company, ok: company && company.value.trim() !== '' },
                { el: position, ok: position && position.value.trim() !== '' },
                { el: kategori, ok: kategori && kategori.value.trim() !== '' },
                { el: tipe, ok: tipe && tipe.value.trim() !== '' },
                { el: lokasi, ok: lokasi && lokasi.value.trim() !== '' },
                { el: link, ok: link && link.value.trim() !== '' }
            ];

            for (let c of checks) {
                if (!c.ok) {
                    const container = c.el ? (c.el.closest('.relative') || c.el.parentElement) : document.getElementById('postingModal');
                    showValidationTooltip(container, 'Please fill out this field');
                }
            }

            const firstInvalid = checks.find(c => !c.ok);
            if (firstInvalid) {
                // focus first invalid field where possible
                if (firstInvalid.el && typeof firstInvalid.el.focus === 'function') firstInvalid.el.focus();
                return false;
            }
            return true;
        }

        submitPostingBtn && submitPostingBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const ok = validatePostingForm();
            if (!ok) return;
            // If validation passes, either save edits to the existing card client-side or behave as create
            const isEditing = postingModal && postingModal.hasAttribute && postingModal.hasAttribute('data-editing');
            const company = document.getElementById('postingCompany') ? document.getElementById('postingCompany').value.trim() : '';
            const position = document.getElementById('postingPosition') ? document.getElementById('postingPosition').value.trim() : '';
            const lokasi = document.getElementById('postingLokasi') ? document.getElementById('postingLokasi').value.trim() : '';
            const tipe = document.getElementById('postingTipeInput') ? document.getElementById('postingTipeInput').value.trim() : '';
            const kategori = document.getElementById('postingKategoriInput') ? document.getElementById('postingKategoriInput').value.trim() : '';
            const desc = document.getElementById('postingDeskripsi') ? document.getElementById('postingDeskripsi').value.trim() : '';
            const link = document.getElementById('postingLink') ? document.getElementById('postingLink').value.trim() : '';

            if (isEditing && pendingEditCard) {
                try {
                    // update the card DOM
                    const posEl = pendingEditCard.querySelector('.font-semibold.text-gray-800');
                    if (posEl) posEl.textContent = position || posEl.textContent;
                    const compEl = pendingEditCard.querySelector('.text-sm.text-gray-600');
                    if (compEl) compEl.textContent = company || compEl.textContent;
                    const locEl = pendingEditCard.querySelector('.text-xs.text-gray-500');
                    if (locEl) locEl.textContent = lokasi || locEl.textContent;
                    // update badge if present
                    const badgeEl = pendingEditCard.querySelector('.inline-flex.items-center.px-2.5');
                    if (badgeEl && tipe) badgeEl.textContent = tipe;
                    // update description block
                    const descBlock = pendingEditCard.querySelector('.border.border-gray-200.rounded-lg.p-4');
                    if (descBlock) {
                        const p = descBlock.querySelector('p.text-sm');
                        if (p) p.textContent = desc || p.textContent;
                    }
                    // update link if present
                    if (link) {
                        const linkEl = pendingEditCard.querySelector('.border.border-gray-200.rounded-lg.p-4 a');
                        if (linkEl) { linkEl.href = link; linkEl.textContent = link; }
                    }
                } catch (err) { console.warn('Failed updating card DOM', err); }
                // cleanup
                pendingEditCard = null;
                restoreModalImageInput();
                closeModal();
                // show small confirmation
                setTimeout(() => alert('Perubahan berhasil disimpan (client-side).'), 50);
                return;
            }

            // default create behavior (still dummy)
            closeModal();
            alert('Posting lowongan dikirim (dummy).');
        });

        // Dropdown functionality for Job Type
        const jobTypeBtn = document.getElementById('jobTypeBtn');
        const jobTypeDropdown = document.getElementById('jobTypeDropdown');
        const selectedJobType = document.getElementById('selectedJobType');

        jobTypeBtn.addEventListener('click', () => {
            jobTypeDropdown.classList.toggle('show');
        });

        jobTypeDropdown.querySelectorAll('a').forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                selectedJobType.textContent = e.target.dataset.value;
                jobTypeDropdown.classList.remove('show');
                // Di sini Anda bisa menambahkan logika untuk memfilter lowongan berdasarkan job type
                console.log('Selected Job Type:', e.target.dataset.value);
            });
        });

        // Dropdown functionality for Kategori
        const kategoriBtn = document.getElementById('kategoriBtn');
        const kategoriDropdown = document.getElementById('kategoriDropdown');
        const selectedKategori = document.getElementById('selectedKategori');

        kategoriBtn.addEventListener('click', () => {
            kategoriDropdown.classList.toggle('show');
        });

        kategoriDropdown.querySelectorAll('a').forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                selectedKategori.textContent = e.target.dataset.value;
                kategoriDropdown.classList.remove('show');
                // Di sini Anda bisa menambahkan logika untuk memfilter lowongan berdasarkan kategori
                console.log('Selected Kategori:', e.target.dataset.value);
            });
        });

        // Close dropdowns when clicking outside  
        window.addEventListener('click', (e) => {
            if (!jobTypeBtn.contains(e.target) && !jobTypeDropdown.contains(e.target)) {
                jobTypeDropdown.classList.remove('show');
            }
            if (!kategoriBtn.contains(e.target) && !kategoriDropdown.contains(e.target)) {
                kategoriDropdown.classList.remove('show');
            }
            // Modal dropdowns
            const modalKategoriBtn = document.getElementById('modalKategoriBtn');
            const modalKategoriDropdown = document.getElementById('modalKategoriDropdown');
            const modalTipeBtn = document.getElementById('modalTipeBtn');
            const modalTipeDropdown = document.getElementById('modalTipeDropdown');
            if (modalKategoriBtn && modalKategoriDropdown) {
                if (!modalKategoriBtn.contains(e.target) && !modalKategoriDropdown.contains(e.target)) {
                    modalKategoriDropdown.classList.add('hidden');
                }
            }
            if (modalTipeBtn && modalTipeDropdown) {
                if (!modalTipeBtn.contains(e.target) && !modalTipeDropdown.contains(e.target)) {
                    modalTipeDropdown.classList.add('hidden');
                }
            }
        });

        // Show empty-state UI when a comments list has no comment items
        function refreshEmptyCommentStates() {
            document.querySelectorAll('.comments-list').forEach(list => {
                const parentCard = list.closest('.bg-white.rounded-lg');
                const hasComments = list.querySelectorAll('.comment-item').length > 0;
                const emptyState = list.parentElement.querySelector('.empty-comments');
                const altInput = list.parentElement.querySelector('.no-comments-input');
                const normalInput = list.parentElement.parentElement.querySelector('.flex.items-center.justify-between');
                if (!hasComments) {
                    if (emptyState) emptyState.classList.remove('hidden');
                    if (altInput) altInput.classList.remove('hidden');
                    if (normalInput) normalInput.style.display = 'none';
                } else {
                    if (emptyState) emptyState.classList.add('hidden');
                    if (altInput) altInput.classList.add('hidden');
                    if (normalInput) normalInput.style.display = '';
                }
            });
        }

        // Run on load
        refreshEmptyCommentStates();

        // Job detail modal logic
        const detailModal = document.getElementById('jobDetailModal');
        const detailOverlay = document.getElementById('jobDetailOverlay');
        const closeJobDetail = document.getElementById('closeJobDetail');

        function openJobDetail() {
            if (!detailModal) return;
            detailModal.classList.remove('hidden');
            detailModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }
        function closeJobDetailModal() {
            if (!detailModal) return;
            detailModal.classList.add('hidden');
            detailModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        // wire buttons
        document.querySelectorAll('.lihatDetailBtn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                // find the job card container
                const card = btn.closest('.bg-white.rounded-lg.shadow-md.p-6.mb-6');
                if (!card) {
                    // try parent fallback
                    openJobDetail();
                    return;
                }

                // populate modal fields from card DOM
                const img = card.querySelector('img') ? card.querySelector('img').src : '';
                const title = card.querySelector('.font-semibold.text-gray-800') ? card.querySelector('.font-semibold.text-gray-800').textContent.trim() : '';
                const company = card.querySelector('.text-sm.text-gray-600') ? card.querySelector('.text-sm.text-gray-600').textContent.trim() : '';
                const locationEl = card.querySelector('.text-xs.text-gray-500');
                const location = locationEl ? locationEl.textContent.trim() : '';
                const typeLabel = card.querySelector('.inline-flex.items-center') ? card.querySelector('.inline-flex.items-center').textContent.trim() : '';
                const timeEl = card.querySelector('.text-xs.text-gray-500.mt-1');
                const time = timeEl ? timeEl.textContent.trim() : '';
                const description = card.querySelector('.border.border-gray-200.rounded-lg.p-4 p.text-sm') ? card.querySelector('.border.border-gray-200.rounded-lg.p-4 p.text-sm').textContent.trim() : (card.querySelector('.border.border-gray-200.rounded-lg.p-4') ? card.querySelector('.border.border-gray-200.rounded-lg.p-4').textContent.trim() : '');

                const authorNameEl = card.querySelector('p.font-semibold.text-gray-900') || card.querySelector('.flex.items-center > div p.font-semibold');
                const author = authorNameEl ? authorNameEl.textContent.trim() : '';
                const authorRoleEl = card.querySelector('.text-sm.text-gray-500');
                const authorRole = authorRoleEl ? authorRoleEl.textContent.trim() : '';

                const detailImage = document.getElementById('detailImage');
                const detailTitle = document.getElementById('detailTitle');
                const detailCompany = document.getElementById('detailCompany');
                const detailLocation = document.getElementById('detailLocation');
                const detailTime = document.getElementById('detailTime');
                const detailDescription = document.getElementById('detailDescription');
                const detailAuthor = document.getElementById('detailAuthor');
                const detailAuthorRole = document.getElementById('detailAuthorRole');

                if (detailImage && img) detailImage.src = img;
                if (detailTitle) detailTitle.textContent = title || detailTitle.textContent;
                if (detailCompany) detailCompany.textContent = company || detailCompany.textContent;
                if (detailLocation) detailLocation.textContent = location || detailLocation.textContent;
                if (detailTime) detailTime.textContent = time || detailTime.textContent;
                if (detailDescription) detailDescription.textContent = description || detailDescription.textContent;
                if (detailAuthor) detailAuthor.textContent = author || detailAuthor.textContent;
                if (detailAuthorRole) detailAuthorRole.textContent = authorRole || detailAuthorRole.textContent;

                // adjust inline icons sizes inside modal if any
                document.querySelectorAll('#jobDetailModal svg').forEach(sv => {
                    sv.classList.add('icon');
                });

                // copy comments into detail modal if present
                const commentsSection = document.getElementById('detailCommentsSection');
                if (commentsSection) {
                    commentsSection.innerHTML = '';
                    const commentsList = card.querySelectorAll('.comment-item');
                    if (commentsList && commentsList.length) {
                        commentsList.forEach(ci => {
                            const clone = ci.cloneNode(true);
                            commentsSection.appendChild(clone);
                        });
                    } else {
                        commentsSection.innerHTML = '<p class="text-sm text-gray-500">Tidak ada komentar pada postingan ini.</p>';
                    }
                }

                openJobDetail();
            });
        });

        closeJobDetail && closeJobDetail.addEventListener('click', closeJobDetailModal);
        detailOverlay && detailOverlay.addEventListener('click', closeJobDetailModal);
        window.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeJobDetailModal(); });

        // Delete confirmation modal logic
        // track pending edit card (for client-side update)
        let pendingEditCard = null;
        const deleteModal = document.getElementById('deleteConfirmModal');
        const deleteOverlay = document.getElementById('deleteConfirmOverlay');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        let pendingDeleteCard = null;

        function openDeleteModal(card) {
            pendingDeleteCard = card;
            if (!deleteModal) return;
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }
        function closeDeleteModal() {
            pendingDeleteCard = null;
            if (!deleteModal) return;
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        // delegate delete button clicks
        document.addEventListener('click', function(e) {
            const del = e.target.closest && e.target.closest('button.btn-delete');
            if (!del) return;
            const card = del.closest('.bg-white.rounded-lg.shadow-md.p-6.mb-6');
            if (!card) return;
            e.preventDefault();
            openDeleteModal(card);
        });

        cancelDeleteBtn && cancelDeleteBtn.addEventListener('click', (e) => { e.preventDefault(); closeDeleteModal(); });
        deleteOverlay && deleteOverlay.addEventListener('click', closeDeleteModal);
        confirmDeleteBtn && confirmDeleteBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (pendingDeleteCard) {
                pendingDeleteCard.remove();
                // After removal, refresh empty comment states to update UI
                refreshEmptyCommentStates();
            }
            closeDeleteModal();
        });

        // Fungsi placeholder untuk klik tombol
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', (e) => {
                // Contoh: Anda bisa menambahkan logika spesifik di sini
                // console.log(`Tombol "${e.target.textContent.trim()}" diklik!`);
            });
        });

        // Modal dropdown handlers (separate scope)
        const mkBtn = document.getElementById('modalKategoriBtn');
        const mkDropdown = document.getElementById('modalKategoriDropdown');
        const mkSelected = document.getElementById('modalKategoriSelected');
        const mkInput = document.getElementById('postingKategoriInput');
        if (mkBtn && mkDropdown) {
            mkBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                mkDropdown.classList.toggle('hidden');
            });
            mkDropdown.querySelectorAll('button').forEach(btn => {
                btn.addEventListener('click', (ev) => {
                    ev.preventDefault();
                    const val = btn.dataset.value || btn.textContent.trim();
                    mkSelected.textContent = val;
                    if (mkInput) mkInput.value = val;
                    mkDropdown.classList.add('hidden');
                });
            });
        }

        const mtBtn = document.getElementById('modalTipeBtn');
        const mtDropdown = document.getElementById('modalTipeDropdown');
        const mtSelected = document.getElementById('modalTipeSelected');
        const mtInput = document.getElementById('postingTipeInput');
        if (mtBtn && mtDropdown) {
            mtBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                mtDropdown.classList.toggle('hidden');
            });
            mtDropdown.querySelectorAll('button').forEach(btn => {
                btn.addEventListener('click', (ev) => {
                    ev.preventDefault();
                    const val = btn.dataset.value || btn.textContent.trim();
                    mtSelected.textContent = val;
                    if (mtInput) mtInput.value = val;
                    mtDropdown.classList.add('hidden');
                });
            });
        }
        // Helpers to manage image UI inside modal (preview + upload button for edit mode)
        function setModalImageUI(imgUrl) {
            const fileInput = document.getElementById('postingImage');
            if (!fileInput) return;
            // create a small preview + upload button
            const container = document.createElement('div');
            container.className = 'flex items-center gap-3';
            container.id = 'postingImagePreviewContainer';

            const thumb = document.createElement('div');
            thumb.className = 'w-20 h-12 bg-gray-100 rounded-md overflow-hidden flex items-center justify-center';
            if (imgUrl) {
                const im = document.createElement('img');
                im.src = imgUrl;
                im.className = 'object-cover w-full h-full';
                thumb.appendChild(im);
            } else {
                thumb.innerHTML = '<span class="text-xs text-gray-500">No photo</span>';
            }

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'px-4 py-2 bg-white border border-gray-200 rounded-md text-sm text-gray-600';
            btn.textContent = 'Upload Foto';
            btn.addEventListener('click', () => {
                fileInput.click();
            });

            // replace the file input with the preview container
            fileInput.style.display = 'none';
            const parent = fileInput.parentElement;
            if (parent) parent.appendChild(container);
            container.appendChild(thumb);
            container.appendChild(btn);
        }

        function restoreModalImageInput() {
            const fileInput = document.getElementById('postingImage');
            const prev = document.getElementById('postingImagePreviewContainer');
            if (prev && prev.parentElement) prev.parentElement.removeChild(prev);
            if (fileInput) fileInput.style.display = '';
        }

        // Reset posting modal into create mode
        function resetPostingModalForCreate() {
            if (!postingModal) return;
            postingModal.removeAttribute('data-editing');
            postingModal.classList.remove('editing');
            const titleEl = postingModal.querySelector('h3');
            if (titleEl) titleEl.textContent = 'Posting Lowongan Baru';
            const submitBtn = document.getElementById('submitPosting');
            if (submitBtn) submitBtn.textContent = 'Posting';
            // clear inputs
            const fields = ['postingCompany','postingPosition','postingKategoriInput','postingTipeInput','postingLokasi','postingDeskripsi','postingLink'];
            fields.forEach(id => {
                const el = document.getElementById(id);
                if (!el) return;
                if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') el.value = '';
            });
            // reset dropdown display labels
            const mk = document.getElementById('modalKategoriSelected'); if (mk) mk.textContent = 'Pilih Kategori';
            const mt = document.getElementById('modalTipeSelected'); if (mt) mt.textContent = 'Pilih Tipe Pekerjaan';
            // restore image input if preview was shown
            restoreModalImageInput();
        }

        // Delegate Edit button clicks to open posting modal in edit mode
        document.addEventListener('click', function(e) {
            const btn = e.target.closest && e.target.closest('button');
            if (!btn) return;
            // match buttons that have btn-edit class or show "Edit" text
            if ( (btn.classList && btn.classList.contains('btn-edit')) || (btn.textContent && btn.textContent.trim() === 'Edit') ) {
                // find the job card container
                const card = btn.closest('.bg-white.rounded-lg.shadow-md.p-6.mb-6');
                if (!card) return;

                // extract fields from card
                const companyEl = card.querySelector('.text-sm.text-gray-600');
                const positionEl = card.querySelector('.font-semibold.text-gray-800');
                const locationEl = card.querySelector('.text-xs.text-gray-500');
                const descEl = card.querySelector('.border.border-gray-200.rounded-lg.p-4 p.text-sm');
                const linkEl = card.querySelector('.border.border-gray-200.rounded-lg.p-4 a');
                const imgEl = card.querySelector('img');

                const company = companyEl ? companyEl.textContent.trim() : '';
                const position = positionEl ? positionEl.textContent.trim() : '';
                const location = locationEl ? locationEl.textContent.trim() : '';
                const desc = descEl ? descEl.textContent.trim() : '';
                const link = linkEl ? linkEl.href || linkEl.textContent.trim() : '';
                const img = imgEl ? imgEl.src : '';

                // populate modal fields
                const companyInput = document.getElementById('postingCompany'); if (companyInput) companyInput.value = company;
                const positionInput = document.getElementById('postingPosition'); if (positionInput) positionInput.value = position;
                const lokasiInput = document.getElementById('postingLokasi'); if (lokasiInput) lokasiInput.value = location;
                const descInput = document.getElementById('postingDeskripsi'); if (descInput) descInput.value = desc;
                const linkInput = document.getElementById('postingLink'); if (linkInput) linkInput.value = link;
                if (img && document.getElementById('detailImage')) document.getElementById('detailImage').src = img;

                // If kategori/tipe values are present in card (via badge/span), try to set them
                const tipeBadge = card.querySelector('.inline-flex.items-center.px-2.5');
                if (tipeBadge) {
                    const val = tipeBadge.textContent.trim();
                    const mt = document.getElementById('modalTipeSelected'); if (mt) mt.textContent = val;
                    const mtInput = document.getElementById('postingTipeInput'); if (mtInput) mtInput.value = val;
                }

                // set modal into editing mode
                postingModal.setAttribute('data-editing','true');
                postingModal.classList.add('editing');
                pendingEditCard = card;
                const titleEl = postingModal.querySelector('h3'); if (titleEl) titleEl.textContent = 'Edit Postingan';
                const submitBtn = document.getElementById('submitPosting'); if (submitBtn) submitBtn.textContent = 'Simpan';

                // if the card has an image, show a preview and upload button in the modal
                if (img) {
                    try { setModalImageUI(img); } catch(err){ console.warn('setModalImageUI error', err); }
                } else {
                    // still show the upload UI (no image)
                    try { setModalImageUI(null); } catch(err) { }
                }

                openModal();
            }
        });

    </script>
</body>
</html>