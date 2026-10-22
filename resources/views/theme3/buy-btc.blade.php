@extends('theme3.layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="hero pt-32 pb-20 text-white">
        <div class="container-main text-center relative z-10" data-aos="zoom-in">
            <span class="section-label mb-4">Supported Exchanges</span>
            <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-white mb-4">
                Buy & Deposit <span class="text-gradient">Digital Currency</span>
            </h1>
            <p class="text-gray-300 max-w-2xl mx-auto text-base sm:text-lg">
                Acquire Bitcoin and cryptocurrency securely using verified global exchange partners.
            </p>
        </div>
    </div>

    <!-- Exchanges Grid -->
    <section class="py-20 sm:py-28 bg-[#f7f8fb]">
        <div class="container-main">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6" data-aos="fade-up">
                
                @php
                    $exchanges = [
                        ['name' => 'Paxful', 'url' => 'https://paxful.com/roots/buy-bitcoin', 'img' => 'images/exchenger-1.png'],
                        ['name' => 'Coinmama', 'url' => 'https://www.coinmama.com/', 'img' => 'images/exchenger-2.png'],
                        ['name' => 'Digatrade', 'url' => 'https://digatrade.com/', 'img' => 'images/exchenger-3.png'],
                        ['name' => '24xbtc', 'url' => 'https://24xbtc.com/', 'img' => 'images/exchenger-4.png'],
                        ['name' => 'HitBTC', 'url' => 'https://hitbtc.com/', 'img' => 'images/exchenger-5.png'],
                        ['name' => 'Bit2Me', 'url' => 'https://bit2me.com/en/index.php', 'img' => 'images/exchenger-6.png'],
                        ['name' => 'Coinmate', 'url' => 'https://coinmate.io/home', 'img' => 'images/exchenger-7.png'],
                        ['name' => 'Bitcoin.de', 'url' => 'https://www.bitcoin.de/en', 'img' => 'images/exchenger-8.png'],
                        ['name' => 'CEX.IO', 'url' => 'https://cex.io/', 'img' => 'images/exchenger-9.png'],
                        ['name' => 'Cubits', 'url' => 'https://cubits.com/', 'img' => 'images/exchenger-10.png'],
                        ['name' => 'WeMoveCoins', 'url' => 'https://wemovecoins.com/', 'img' => 'images/exchenger-11.png'],
                        ['name' => 'Coinhouse', 'url' => 'https://www.coinhouse.com/', 'img' => 'images/exchenger-12.png'],
                    ];
                @endphp

                @foreach($exchanges as $exchange)
                    <a href="{{ $exchange['url'] }}" target="_blank" rel="noopener noreferrer"
                       class="feature-card rounded-2xl p-6 bg-white flex flex-col items-center justify-center gap-4 hover:shadow-lg transition group">
                        <img src="{{ asset($exchange['img']) }}" alt="{{ $exchange['name'] }}" class="max-h-12 w-auto object-contain transition-transform group-hover:scale-105">
                        <span class="text-xs font-semibold text-gray-500 group-hover:text-[#947312] transition-colors">{{ $exchange['name'] }} ↗</span>
                    </a>
                @endforeach

            </div>
        </div>
    </section>
@endsection
