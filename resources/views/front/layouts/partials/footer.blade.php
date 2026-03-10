<footer class="mt-auto border-t border-primary/10 bg-white dark:bg-[#1a0c0d] px-6 py-16" data-aos="fade-up">
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 mb-16">

            {{-- Brand & About --}}
            <div class="space-y-6">
                <a href="/" class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-white overflow-hidden">
                        <img src="{{ $config['app_favicon'] }}" alt="{{ $config['app_name'] }}"
                                class="w-7 h-7 object-contain">
                    </div>
                    <h2 class="text-2xl font-black tracking-tighter">{{ $config['app_name'] }}</h2>
                </a>
                <p class="text-slate-500 max-w-sm text-justify leading-relaxed">
                    {{ $config['app_description'] }}
                </p>
                <div class="flex gap-4">
                    <a class="h-10 w-10 rounded-full border border-primary/20 flex items-center justify-center hover:bg-primary hover:text-white transition-all" href="{{ route('menu.index') }}">
                        <span class="material-symbols-outlined text-sm">public</span>
                    </a>
                    <a class="h-10 w-10 rounded-full border border-primary/20 flex items-center justify-center hover:bg-primary hover:text-white transition-all" href="{{ route('contact.show') }}">
                        <span class="material-symbols-outlined text-sm">alternate_email</span>
                    </a>
                    <a class="h-10 w-10 rounded-full border border-primary/20 flex items-center justify-center hover:bg-primary hover:text-white transition-all" href="{{ route('contact.show') }}">
                        <span class="material-symbols-outlined text-sm">call</span>
                    </a>
                </div>
            </div>

            {{-- Hubungi Kami --}}
            <div class="space-y-6">
                <h4 class="text-lg font-bold">Hubungi Kami</h4>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary">phone</span>
                        <p class="text-sm text-slate-500">{!! $config['footer-contact'] !!}</p>
                    </div>
                    <div class="h-32 w-full rounded-xl overflow-hidden grayscale opacity-70 border border-primary/10">
                        <iframe width="100%" height="150" id="gmap_canvas"
                            src="https://maps.google.com/maps?q=sman%201%20bukittinggi&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                        </iframe>
                    </div>
                </div>
            </div>

            {{-- Panitia --}}
            <div class="space-y-6">
                <h4 class="text-lg font-bold">Panitia</h4>
                <div class="grid grid-cols-3 gap-4">
                    <div class="h-24 bg-primary/5 rounded-lg border border-primary/10 flex items-center justify-center p-2">
                        <img src="{{ asset('digimark/mpk.png') }}"
                                alt="MPK" class="h-full object-contain">
                    </div>
                    <div class="h-24 bg-primary/5 rounded-lg border border-primary/10 flex items-center justify-center p-2">
                        <img src="{{ asset('digimark/smansa.png') }}"
                                alt="SMAN1BKT" class="h-full object-contain">
                    </div>
                    <div class="h-24 bg-primary/5 rounded-lg border border-primary/10 flex items-center justify-center p-2">
                        <img src="{{ asset('digimark/osis.PNG') }}"
                                alt="OSIS" class="h-full object-contain">
                    </div>
                </div>
            </div>

        </div>

        <div class="pt-8 border-t border-primary/10 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="text-xs font-medium text-slate-500 tracking-widest uppercase">
                &copy; {{ date('Y') }} {{ $config['app_name'] }}. All Rights Reserved.
            </p>
            <div class="flex items-center gap-2">
                <p class="text-sm text-slate-500 text-right">
                    HL-Web App n Booking System v2.15<br>
                    <small>Made &amp; maintained by
                        <a href="https://github.com/SLAVUSworks" target="_blank" rel="noopener noreferrer"
                            class="text-primary hover:underline">SLAVUSworks</a>
                    </small>
                </p>
                <img src="{{ asset('digimark/slavusworks.png') }}" alt="SLAVUSworks" class="w-10 h-10 ml-1">
            </div>
        </div>

    </div>
</footer>