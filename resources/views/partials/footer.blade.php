<footer
        :class="{ 'bg-white bg-opacity-10': '{{ Cookie::get('darkMode', 'false') }}' === 'false', 'bg-gray-900': '{{ Cookie::get('darkMode', 'false') }}' === 'true' }"
        class="w-full backdrop-blur-md border-t border-white border-opacity-20 py-8 transition-colors duration-300">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between items-center">
            <div class="w-full md:w-1/2 mb-6 md:mb-0">
                <h3 class="text-xl font-bold mb-2 font-vt323" :class="{ 'text-white': '{{ Cookie::get('darkMode', 'false') }}' === 'false', 'text-gray-200': '{{ Cookie::get('darkMode', 'false') }}' === 'true' }">placehold.cloud</h3>
                <p class="text-green-400 animate-[pulse_1s_ease-in-out_infinite] transition-colors duration-300">Your go-to solution for placeholder content and APIs.</p>
            </div>
            <div class="w-full md:w-1/2">
                <h4 class="text-lg font-semibold mb-2" :class="{ 'text-white': '{{ Cookie::get('darkMode', 'false') }}' === 'false', 'text-gray-200': '{{ Cookie::get('darkMode', 'false') }}' === 'true' }">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="/about-us" :class="{ 'text-white text-opacity-80 hover:text-white': '{{ Cookie::get('darkMode', 'false') }}' === 'false', 'text-gray-400 hover:text-gray-200': '{{ Cookie::get('darkMode', 'false') }}' === 'true' }" class="transition duration-300">About Us</a></li>
                    <li><a href="/privacy-policy" :class="{ 'text-white text-opacity-80 hover:text-white': '{{ Cookie::get('darkMode', 'false') }}' === 'false', 'text-gray-400 hover:text-gray-200': '{{ Cookie::get('darkMode', 'false') }}' === 'true' }" class="transition duration-300">Privacy Policy</a></li>
                    <li><a href="/terms-of-service" :class="{ 'text-white text-opacity-80 hover:text-white': '{{ Cookie::get('darkMode', 'false') }}' === 'false', 'text-gray-400 hover:text-gray-200': '{{ Cookie::get('darkMode', 'false') }}' === 'true' }" class="transition duration-300">Terms of Service</a></li>
                    <li><a href="/cookie-policy" :class="{ 'text-white text-opacity-80 hover:text-white': '{{ Cookie::get('darkMode', 'false') }}' === 'false', 'text-gray-400 hover:text-gray-200': '{{ Cookie::get('darkMode', 'false') }}' === 'true' }" class="transition duration-300">Cookie Policy</a></li>
                    <li><a href="/contact" :class="{ 'text-white text-opacity-80 hover:text-white': '{{ Cookie::get('darkMode', 'false') }}' === 'false', 'text-gray-400 hover:text-gray-200': '{{ Cookie::get('darkMode', 'false') }}' === 'true' }" class="transition duration-300">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-8 pt-8 border-t border-white border-opacity-20 text-center">
            <p :class="{ 'text-white text-opacity-80': '{{ Cookie::get('darkMode', 'false') }}' === 'false', 'text-gray-400': '{{ Cookie::get('darkMode', 'false') }}' === 'true' }">&copy; {{ date('Y') }} placehold.cloud. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Cookie Consent -->
<div id="cookie-consent" x-data="{ show: !localStorage.getItem('cookieConsent') }" x-show="show" x-transition
     class="fixed bottom-0 left-0 w-full bg-gray-900 text-white py-4 px-6 flex justify-between items-center">
    <p>We use cookies to improve your experience. By using our site, you agree to our use of cookies. For more information, please see our <a href="/cookie-policy" class="underline">Cookie Policy</a>.</p>
    <button @click="localStorage.setItem('cookieConsent', 'true'); show = false"
            class="bg-white text-gray-900 px-4 py-2 rounded hover:bg-gray-200 transition duration-300 animate-[bounce_1s_infinite]">Accept</button>
</div>
