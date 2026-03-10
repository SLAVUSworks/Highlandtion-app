<footer id="nav-dash" class="relative bg-[#4581b2] text-white py-6 mt-8 z-50" data-aos="fade-up">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <h3 class="text-2xl font-semibold">SLAVUSworks N Friends</h3>
                <div class="grid grid-cols-3 gap-6 mt-4 text-center">
                    <div>
                        <img src="{{ asset('digimark/panthero.png') }}" alt="thero-art"
                            class="mx-auto h-24 object-contain">
                        <a href="https://www.instagram.com/panthero.real/" target="_blank" rel="noopener noreferrer"><p class="mt-2 text-sm font-medium">Panthero.Art</p></a>
                    </div>
                    <div>
                        <img src="{{ asset('digimark/SBcRIDKCP.png') }}" alt="sbcridkcp"
                            class="mx-auto h-24 object-contain">
                        <a href="https://terukaze1939.github.io/" target="_blank" rel="noopener noreferrer"><p class="mt-2 text-sm font-medium">SBcRIDKCP</p></a>
                    </div>
                    <div>
                        <img src="{{ asset('digimark/vaa.png') }}" alt="vaa-gfx"
                            class="mx-auto h-24 object-contain">
                        <a href="https://www.instagram.com/_.vaadappa/" target="_blank" rel="noopener noreferrer"><p class="mt-2 text-sm font-medium">Vaa GFX</p></a>
                    </div>
                </div>
            </div>
            <div class="relative overflow-hidden">
                <h3 class="text-2xl font-bold relative z-10">
                    Web Control Panel <small class="font-light">v2.4</small>
                </h3>

                <p class="text-xl text-justify relative z-10">
                    More than just CMS. Made with ⸜(｡˃ ᵕ ˂ )⸝♡.
                </p>

                <div class="absolute left-0 right-0 bottom-0 h-24
                    bg-[linear-gradient(45deg,rgba(255,255,255,0.08)_25%,transparent_25%,transparent_50%,rgba(255,255,255,0.08)_50%,rgba(255,255,255,0.08)_75%,transparent_75%,transparent)]
                    bg-[length:20px_20px]
                    opacity-80">
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-semibold">Font Pack by</h3>
                <a href="https://tokotype.github.io/plusjakarta-sans/" target="_blank" rel="noopener noreferrer"><p class="text-6xl font-bold text-right">+Jakarta Sans</p></a>
                <h3 class="text-2xl font-semibold">Made With</h3>
                <p class="text-xl text-right">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP
                    v{{ PHP_VERSION }})</p>
                <p class="text-xl text-right">{{ exec('npm list tailwindcss | grep tailwindcss') }}</p>
            </div>
        </div>

        <div class="flex justify-end items-center mt-8">
            <p class="text-sm text-right">HL-Web App N Booking System v2.15.12<br>
                <small class="text-sm">Made & maintained by
                    <a href="https://github.com/SLAVUSworks" target="_blank" rel="noopener noreferrer"
                        class="text-black">SLAVUSworks</a>
                    with
                    <a href="https://github.com/terukaze1939" target="_blank" rel="noopener noreferrer"
                        class="text-black">Terukaze</a>
                </small>
            </p>
            <img onclick="showDigimark()"
                src="{{ asset('digimark/slavusworks.png') }}"
                alt="SLAVUSworks" class="w-12 h-12 ml-2">
        </div>
    </div>
</footer>