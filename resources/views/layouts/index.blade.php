<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body style="font-family: 'Poppins', sans-serif;" class="overflow-x-hidden">
    <div x-data="{ open: false, messages: [], userMsg: '', isLoading: false }" class="fixed bottom-6 right-6 z-50">

        <!-- Chat Box -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            class="bg-white w-80 md:w-96 rounded-2xl shadow-2xl border border-slate-100 overflow-hidden flex flex-col mb-4"
            style="height: 500px; max-height: 80vh;">

            <!-- Header -->
            <div class="bg-[#016B61] p-4 flex justify-between items-center text-white">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('img/logo.png') }}" class="w-8 rounded-full bg-white/20" alt="">
                    <div>
                        <h3 class="font-bold text-sm">Tanya KenalBot</h3>
                        <p class="text-[10px] opacity-80">Powered by Gemini AI</p>
                    </div>
                </div>
                <button @click="open = false" class="text-white/80 hover:text-white">✕</button>
            </div>

            <!-- Chat Area -->
            <div class="flex-1 p-4 overflow-y-auto bg-slate-50 space-y-3" id="chat-container">
                <!-- Intro Message -->
                <div class="flex justify-start">
                    <div
                        class="bg-white border border-slate-200 text-slate-700 rounded-2xl rounded-tl-none py-2 px-3 text-sm shadow-sm max-w-[85%]">
                        Halo! Ada yang bisa saya bantu seputar sampah atau iuran? 👋
                    </div>
                </div>

                <template x-for="msg in messages">
                    <div :class="msg.sender === 'user' ? 'flex justify-end' : 'flex justify-start'">
                        <div :class="msg.sender === 'user' ?
                            'bg-[#016B61] text-white rounded-2xl rounded-tr-none' :
                            'bg-white border border-slate-200 text-slate-700 rounded-2xl rounded-tl-none'"
                            class="py-2 px-3 text-sm shadow-sm max-w-[85%]">

                            <span x-show="msg.sender === 'bot'" x-html="msg.text"
                                class="prose prose-sm max-w-none"></span>
                            <span x-show="msg.sender === 'user'" x-text="msg.text"></span>

                        </div>
                    </div>
                </template>

                <!-- Loading Indicator -->
                <div x-show="isLoading" class="flex justify-start">
                    <div
                        class="bg-slate-200 text-slate-500 rounded-2xl rounded-tl-none py-2 px-4 text-xs animate-pulse">
                        Sedang mengetik...
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <form
                @submit.prevent="
            if(userMsg.trim() === '') return;
            messages.push({sender: 'user', text: userMsg});
            const input = userMsg;
            userMsg = '';
            isLoading = true;

            // Auto scroll ke bawah
            setTimeout(() => {
                const container = document.getElementById('chat-container');
                container.scrollTop = container.scrollHeight;
            }, 50);

            // Fetch ke Laravel
            fetch('{{ route('chatbot.ask') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: input })
            })
            .then(res => res.json())
            .then(data => {
                messages.push({sender: 'bot', text: data.reply});
                isLoading = false;
                setTimeout(() => {
                    const container = document.getElementById('chat-container');
                    container.scrollTop = container.scrollHeight;
                }, 50);
            })
            .catch(err => {
                console.error(err);
                messages.push({sender: 'bot', text: 'Maaf, ada gangguan koneksi.'});
                isLoading = false;
            });
        "
                class="p-3 border-t border-slate-100 bg-white">
                <div class="flex gap-2">
                    <input x-model="userMsg" type="text" placeholder="Tulis pesan..."
                        class="w-full text-sm border-none focus:ring-0 bg-transparent px-2" />
                    <button type="submit"
                        class="bg-[#016B61] hover:bg-[#015a52] text-white p-2 rounded-full shadow-md transition-transform active:scale-90">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m22 2-7 20-4-9-9-4Z" />
                            <path d="M22 2 11 13" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Toggle Button -->
        <button @click="open = !open"
            class="bg-[#016B61] hover:bg-[#015a52] text-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center transition-transform hover:scale-110 active:scale-95 group">
            <!-- Icon Chat -->
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
            </svg>
            <!-- Icon Close -->
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="rotate-90">
                <path d="m18 15-6-6-6 6" />
            </svg>
        </button>
    </div>
    {{-- Navbar --}}
    <nav>
        <x-navbar></x-navbar>
    </nav>
    {{-- Content --}}
    <div>
        @yield('content')
    </div>
    {{-- Footer --}}
    <footer>

    </footer>

    @stack('scripts')
</body>

</html>
