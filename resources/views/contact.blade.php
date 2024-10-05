<x-layout>
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-6xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-pink-300 dark:from-blue-300 dark:to-pink-200">Contact Us</h1>

        <div class="bg-white/10 dark:bg-gray-800/30 backdrop-blur-md border border-white/20 dark:border-gray-700/20 p-8 rounded-2xl shadow-lg max-w-2xl mx-auto">
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-lg font-medium text-white dark:text-gray-200 mb-2">Name</label>
                    <input type="text" name="name" id="name" required class="w-full px-4 py-2 rounded-lg bg-white/20 dark:bg-gray-700/20 border border-white/30 dark:border-gray-600/30 text-white dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400">
                </div>
                <div>
                    <label for="email" class="block text-lg font-medium text-white dark:text-gray-200 mb-2">Email</label>
                    <input type="email" name="email" id="email" required class="w-full px-4 py-2 rounded-lg bg-white/20 dark:bg-gray-700/20 border border-white/30 dark:border-gray-600/30 text-white dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400">
                </div>
                <div>
                    <label for="message" class="block text-lg font-medium text-white dark:text-gray-200 mb-2">Message</label>
                    <textarea name="message" id="message" rows="4" required class="w-full px-4 py-2 rounded-lg bg-white/20 dark:bg-gray-700/20 border border-white/30 dark:border-gray-600/30 text-white dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"></textarea>
                </div>
                <div>
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 dark:from-blue-600 dark:to-purple-700 text-white font-bold text-lg rounded-full hover:from-blue-600 hover:to-purple-700 dark:hover:from-blue-700 dark:hover:to-purple-800 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">Send Message</button>
                </div>
            </form>
        </div>

        <div class="mt-12 text-center">
            <p class="text-xl text-white/90 dark:text-gray-300 mb-4">You can also reach us at:</p>
            <p class="text-lg text-white/80 dark:text-gray-400">
                <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                support@placehold.cloud
            </p>
        </div>
    </div>
</x-layout>
