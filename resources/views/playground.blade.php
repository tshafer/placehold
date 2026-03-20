<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Embed Playground</h1>
            <p class="text-gray-600 dark:text-gray-400">Write HTML, CSS, and JS that use the placehold.cloud API. See live results and share your creations.</p>
        </div>

        <div x-data="playground()">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Editor -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col" style="min-height:500px">
                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                        <div class="flex gap-2">
                            <button @click="tab = 'html'" :class="tab === 'html' ? 'bg-white dark:bg-gray-700 shadow-sm' : ''" class="px-3 py-1 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 transition-colors">HTML</button>
                            <button @click="tab = 'css'" :class="tab === 'css' ? 'bg-white dark:bg-gray-700 shadow-sm' : ''" class="px-3 py-1 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 transition-colors">CSS</button>
                            <button @click="tab = 'js'" :class="tab === 'js' ? 'bg-white dark:bg-gray-700 shadow-sm' : ''" class="px-3 py-1 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 transition-colors">JS</button>
                        </div>
                        <button @click="run()" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
                            <x-heroicon-o-play class="w-4 h-4" /> Run
                        </button>
                    </div>
                    <div class="flex-1 relative">
                        <textarea x-show="tab === 'html'" x-model="html" class="absolute inset-0 w-full h-full p-4 bg-gray-900 text-green-400 font-mono text-sm resize-none focus:outline-none" spellcheck="false"></textarea>
                        <textarea x-show="tab === 'css'" x-model="css" class="absolute inset-0 w-full h-full p-4 bg-gray-900 text-blue-400 font-mono text-sm resize-none focus:outline-none" spellcheck="false"></textarea>
                        <textarea x-show="tab === 'js'" x-model="js" class="absolute inset-0 w-full h-full p-4 bg-gray-900 text-yellow-400 font-mono text-sm resize-none focus:outline-none" spellcheck="false"></textarea>
                    </div>
                </div>

                <!-- Preview -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col" style="min-height:500px">
                    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Preview</span>
                        <button @click="share()" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <x-heroicon-o-share class="w-4 h-4" /> Share
                        </button>
                    </div>
                    <div class="flex-1">
                        <iframe x-ref="preview" class="w-full h-full border-0 bg-white" sandbox="allow-scripts"></iframe>
                    </div>
                </div>
            </div>

            <!-- Templates -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Templates</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    <button @click="loadTemplate('gallery')" class="text-left bg-gray-50 dark:bg-gray-900 rounded-lg p-4 hover:border-gray-400 dark:hover:border-gray-500 border border-gray-200 dark:border-gray-700 transition-colors">
                        <span class="block text-sm font-medium text-gray-900 dark:text-white">Image Gallery</span>
                        <span class="block text-xs text-gray-500 dark:text-gray-400 mt-1">Grid of placeholder images</span>
                    </button>
                    <button @click="loadTemplate('card')" class="text-left bg-gray-50 dark:bg-gray-900 rounded-lg p-4 hover:border-gray-400 dark:hover:border-gray-500 border border-gray-200 dark:border-gray-700 transition-colors">
                        <span class="block text-sm font-medium text-gray-900 dark:text-white">User Card</span>
                        <span class="block text-xs text-gray-500 dark:text-gray-400 mt-1">Avatar + placeholder content</span>
                    </button>
                    <button @click="loadTemplate('dashboard')" class="text-left bg-gray-50 dark:bg-gray-900 rounded-lg p-4 hover:border-gray-400 dark:hover:border-gray-500 border border-gray-200 dark:border-gray-700 transition-colors">
                        <span class="block text-sm font-medium text-gray-900 dark:text-white">Dashboard Mock</span>
                        <span class="block text-xs text-gray-500 dark:text-gray-400 mt-1">Chart placeholders + data</span>
                    </button>
                    <button @click="loadTemplate('qr')" class="text-left bg-gray-50 dark:bg-gray-900 rounded-lg p-4 hover:border-gray-400 dark:hover:border-gray-500 border border-gray-200 dark:border-gray-700 transition-colors">
                        <span class="block text-sm font-medium text-gray-900 dark:text-white">QR Code Page</span>
                        <span class="block text-xs text-gray-500 dark:text-gray-400 mt-1">QR codes + download links</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function playground() {
            const baseUrl = window.location.origin;
            const templates = {
                gallery: {
                    html: `<h1>Image Gallery</h1>\n<div class="grid">\n  <img src="${baseUrl}/400x300?text=Photo+1&bg=6366f1&fg=fff">\n  <img src="${baseUrl}/400x300?text=Photo+2&bg=059669&fg=fff">\n  <img src="${baseUrl}/400x300?text=Photo+3&bg=dc2626&fg=fff">\n  <img src="${baseUrl}/400x300?text=Photo+4&bg=d97706&fg=fff">\n  <img src="${baseUrl}/400x300?text=Photo+5&bg=7c3aed&fg=fff">\n  <img src="${baseUrl}/400x300?text=Photo+6&bg=0891b2&fg=fff">\n</div>`,
                    css: `body { font-family: system-ui; padding: 20px; background: #f9fafb; }\nh1 { font-size: 24px; margin-bottom: 16px; }\n.grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }\n.grid img { width: 100%; border-radius: 8px; }`,
                    js: ''
                },
                card: {
                    html: `<div class="card">\n  <img src="${baseUrl}/avatar/jane.doe?size=80" class="avatar">\n  <div>\n    <h2>Jane Doe</h2>\n    <p>Software Engineer</p>\n    <img src="${baseUrl}/300x20?text=&bg=e5e7eb&fg=e5e7eb" class="bar">\n    <img src="${baseUrl}/240x20?text=&bg=e5e7eb&fg=e5e7eb" class="bar">\n  </div>\n</div>`,
                    css: `body { font-family: system-ui; padding: 40px; background: #f3f4f6; display: flex; justify-content: center; }\n.card { background: white; border-radius: 12px; padding: 24px; display: flex; gap: 16px; box-shadow: 0 1px 3px rgba(0,0,0,.1); max-width: 400px; }\n.avatar { width: 80px; height: 80px; border-radius: 50%; }\nh2 { margin: 0; font-size: 18px; }\np { color: #6b7280; margin: 4px 0 12px; font-size: 14px; }\n.bar { display: block; border-radius: 4px; margin-top: 6px; }`,
                    js: ''
                },
                dashboard: {
                    html: `<h1>Dashboard</h1>\n<div class="stats">\n  <div class="stat"><span>Users</span><strong>1,234</strong></div>\n  <div class="stat"><span>Revenue</span><strong>$45.6k</strong></div>\n  <div class="stat"><span>Orders</span><strong>892</strong></div>\n</div>\n<div class="charts">\n  <img src="${baseUrl}/500x250?text=Revenue+Chart&bg=6366f1&fg=fff">\n  <img src="${baseUrl}/500x250?text=Users+Chart&bg=059669&fg=fff">\n</div>`,
                    css: `body { font-family: system-ui; padding: 20px; background: #111827; color: white; }\nh1 { font-size: 24px; margin-bottom: 16px; }\n.stats { display: flex; gap: 12px; margin-bottom: 20px; }\n.stat { flex: 1; background: #1f2937; border-radius: 8px; padding: 16px; }\n.stat span { font-size: 13px; color: #9ca3af; }\n.stat strong { display: block; font-size: 28px; margin-top: 4px; }\n.charts { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }\n.charts img { width: 100%; border-radius: 8px; }`,
                    js: ''
                },
                qr: {
                    html: `<h1>Event Tickets</h1>\n<div class="tickets">\n  <div class="ticket">\n    <img src="${baseUrl}/qr?data=TICKET-001&size=150">\n    <p>Ticket #001</p>\n  </div>\n  <div class="ticket">\n    <img src="${baseUrl}/qr?data=TICKET-002&size=150">\n    <p>Ticket #002</p>\n  </div>\n  <div class="ticket">\n    <img src="${baseUrl}/qr?data=TICKET-003&size=150">\n    <p>Ticket #003</p>\n  </div>\n</div>`,
                    css: `body { font-family: system-ui; padding: 20px; background: #f9fafb; }\nh1 { font-size: 24px; margin-bottom: 20px; }\n.tickets { display: flex; gap: 16px; }\n.ticket { background: white; border-radius: 12px; padding: 20px; text-align: center; box-shadow: 0 1px 3px rgba(0,0,0,.1); }\n.ticket img { border-radius: 8px; }\n.ticket p { margin: 12px 0 0; font-weight: 600; }`,
                    js: ''
                }
            };

            return {
                tab: 'html',
                html: templates.gallery.html,
                css: templates.gallery.css,
                js: templates.gallery.js,
                init() {
                    this.loadFromHash();
                    this.$nextTick(() => this.run());
                },
                run() {
                    const doc = `<!DOCTYPE html><html><head><style>${this.css}</style></head><body>${this.html}<script>${this.js}<\/script></body></html>`;
                    this.$refs.preview.srcdoc = doc;
                },
                share() {
                    const payload = btoa(JSON.stringify({ h: this.html, c: this.css, j: this.js }));
                    const url = window.location.origin + '/playground#' + payload;
                    navigator.clipboard.writeText(url);
                    alert('Link copied to clipboard!');
                },
                loadFromHash() {
                    if (window.location.hash.length > 1) {
                        try {
                            const data = JSON.parse(atob(window.location.hash.slice(1)));
                            this.html = data.h || '';
                            this.css = data.c || '';
                            this.js = data.j || '';
                        } catch (e) {}
                    }
                },
                loadTemplate(name) {
                    const t = templates[name];
                    this.html = t.html;
                    this.css = t.css;
                    this.js = t.js;
                    this.tab = 'html';
                    this.$nextTick(() => this.run());
                }
            };
        }
    </script>
</x-layout>
