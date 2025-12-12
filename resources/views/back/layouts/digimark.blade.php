<div id="digimarkModal" class="fixed inset-0 bg-black bg-opacity-70 hidden z-50 flex items-center justify-center">
    <div class="relative w-full max-w-3xl p-10 rounded-xl">

        <button onclick="closeDigimark()" class="absolute top-3 right-3 text-white text-2xl">&times;</button>

        <div id="digimarkSlides" class="relative overflow-hidden">

            <div class="slide w-full flex justify-center">
                <img data-src="{{ asset('digimark/digisign-1.png') }}" class="lazy-img max-h-[70vh] rounded-lg">
            </div>

            <div class="slide w-full flex justify-center hidden">
                <img data-src="{{ asset('digimark/digisign-2.png') }}" class="lazy-img max-h-[70vh] rounded-lg">
            </div>

            <div class="slide w-full flex justify-center hidden">
                <div class="flex flex-col items-center">
                    <video id="digimarkVideo" autoplay muted playsinline controls class="max-h-[70vh] rounded-lg">
                        <source data-src="{{ asset('digimark/sebatas-berdua.mp4') }}" type="video/mp4">
                    </video>
                    <i class="text-gray-400 text-sm mt-2">
                        source: https://youtu.be/Vi7wXLZGlss?si=ECDoGI-zwlYP9W2-
                    </i>
                </div>
            </div>
        </div>

        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-white text-3xl cursor-pointer" onclick="prevSlide()">
            &#10094;</div>
        <div class="absolute right-5 top-1/2 -translate-y-1/2 text-white text-3xl cursor-pointer" onclick="nextSlide()">
            &#10095;</div>

    </div>
</div>

<script>
    let currentSlide = 0;

    function showDigimark() {
        document.getElementById("digimarkModal").classList.remove("hidden");
        showSlide(currentSlide);
    }

    function closeDigimark() {
        document.getElementById("digimarkModal").classList.add("hidden");
    }

    function showSlide(n) {
        const slides = document.querySelectorAll("#digimarkSlides .slide");
        slides.forEach((slide, i) => slide.classList.toggle("hidden", i !== n));
    }

    function nextSlide() {
        const slides = document.querySelectorAll("#digimarkSlides .slide");
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        const slides = document.querySelectorAll("#digimarkSlides .slide");
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    function lazyLoadDigimark() {
        document.querySelectorAll('.lazy-img').forEach(img => {
            if (!img.src) img.src = img.dataset.src;
        });

        const vid = document.getElementById("digimarkVideo");
        const src = vid.querySelector('source');

        if (src && !src.src) {
            src.src = src.dataset.src;
            vid.load();
        }
    }

</script>
