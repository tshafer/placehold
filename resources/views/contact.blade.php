<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Contact Us</h1>
            <p class="text-gray-600 dark:text-gray-400">We'd love to hear from you</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                    <input type="text" name="name" id="name" required 
                           class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input type="email" name="email" id="email" required 
                           class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message</label>
                    <textarea name="message" id="message" rows="6" required 
                              class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-gray-500 focus:border-transparent"></textarea>
                </div>
                <div>
                    <button type="submit" 
                            class="w-full px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors shadow-lg">
                        Send Message
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 text-center">
            <p class="text-gray-600 dark:text-gray-400 mb-4">You can also reach us at:</p>
            <a href="mailto:support@placehold.cloud" class="inline-flex items-center text-gray-900 dark:text-white hover:text-gray-700 dark:hover:text-gray-300 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                support@placehold.cloud
            </a>
        </div>
    </div>
</x-layout>
