<x-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Image Placeholder Generator</h1>
            <p class="text-gray-600 dark:text-gray-400">Create custom placeholder images with live preview</p>
        </div>

        <div x-data="imageGenerator()" class="space-y-8">
            <!-- Live Preview Section -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white flex items-center">
                    <svg class="w-6 h-6 mr-2 text-gray-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Live Preview
                </h2>
                <div class="flex flex-col lg:flex-row gap-6">
                    <div class="flex-1 bg-gray-100 dark:bg-gray-900 rounded-lg p-4 flex items-center justify-center min-h-[200px]">
                        <img :src="previewUrl" alt="Preview" class="max-w-full max-h-[400px] rounded shadow-lg">
                    </div>
                    <div class="flex-1 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">URL</label>
                            <div class="flex gap-2">
                                <input type="text" :value="previewUrl" readonly 
                                    class="flex-1 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 p-3 rounded-lg text-sm font-mono">
                                <button @click="copyToClipboard(previewUrl)" 
                                    class="px-4 py-2 bg-gray-900 dark:bg-gray-100 hover:bg-gray-800 dark:hover:bg-gray-200 text-white dark:text-gray-900 rounded-lg font-medium transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Markdown</label>
                            <div class="flex gap-2">
                                <input type="text" :value="markdownUrl" readonly 
                                    class="flex-1 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 p-3 rounded-lg text-sm font-mono">
                                <button @click="copyToClipboard(markdownUrl)" 
                                    class="px-4 py-2 bg-gray-900 dark:bg-gray-100 hover:bg-gray-800 dark:hover:bg-gray-200 text-white dark:text-gray-900 rounded-lg font-medium transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">HTML</label>
                            <div class="flex gap-2">
                                <input type="text" :value="htmlUrl" readonly 
                                    class="flex-1 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 p-3 rounded-lg text-sm font-mono">
                                <button @click="copyToClipboard(htmlUrl)" 
                                    class="px-4 py-2 bg-gray-900 dark:bg-gray-100 hover:bg-gray-800 dark:hover:bg-gray-200 text-white dark:text-gray-900 rounded-lg font-medium transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <h2 class="text-xl font-semibold mb-6 text-gray-900 dark:text-white">Customize Your Image</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Size (width x height)</label>
                        <input type="text" x-model="size" @input="updatePreview" 
                            placeholder="500x300" class="w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 p-3 rounded-lg focus:ring-2 focus:ring-gray-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Background Color</label>
                        <div class="flex gap-2">
                            <input type="color" x-model="bgColor" @input="updatePreview" 
                                class="h-12 w-20 rounded-lg cursor-pointer border border-gray-300 dark:border-gray-700">
                            <input type="text" x-model="bgColor" @input="updatePreview" 
                                placeholder="#FF5733" class="flex-1 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 p-3 rounded-lg focus:ring-2 focus:ring-gray-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Text Color</label>
                        <div class="flex gap-2">
                            <input type="color" x-model="textColor" @input="updatePreview" 
                                class="h-12 w-20 rounded-lg cursor-pointer border border-gray-300 dark:border-gray-700">
                            <input type="text" x-model="textColor" @input="updatePreview" 
                                placeholder="#FFFFFF" class="flex-1 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 p-3 rounded-lg focus:ring-2 focus:ring-gray-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Custom Text</label>
                        <input type="text" x-model="text" @input="updatePreview" 
                            placeholder="Your Text" class="w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 p-3 rounded-lg focus:ring-2 focus:ring-gray-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Format</label>
                        <select x-model="format" @change="updatePreview" 
                            class="w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 p-3 rounded-lg focus:ring-2 focus:ring-gray-500">
                            <option value="png">PNG</option>
                            <option value="jpg">JPG</option>
                            <option value="jpeg">JPEG</option>
                            <option value="webp">WebP</option>
                            <option value="avif">AVIF</option>
                            <option value="gif">GIF</option>
                            <option value="bmp">BMP</option>
                            <option value="ico">ICO</option>
                            <option value="svg">SVG</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Font</label>
                        <select x-model="font" @change="updatePreview" 
                            class="w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 p-3 rounded-lg focus:ring-2 focus:ring-gray-500">
                            <option value="arial">Arial</option>
                            <option value="couri">Courier</option>
                            <option value="times">Times</option>
                            <option value="tron">Tron</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quality (1-100)</label>
                        <input type="number" x-model="quality" @input="updatePreview" min="1" max="100"
                            class="w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 p-3 rounded-lg focus:ring-2 focus:ring-gray-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Effects</label>
                        <div class="flex gap-4 mt-2">
                            <label class="flex items-center text-gray-900 dark:text-gray-100 cursor-pointer">
                                <input type="checkbox" x-model="grayscale" @change="updatePreview" class="mr-2 rounded">
                                <span class="text-sm">Grayscale</span>
                            </label>
                            <label class="flex items-center text-gray-900 dark:text-gray-100 cursor-pointer">
                                <input type="checkbox" x-model="invert" @change="updatePreview" class="mr-2 rounded">
                                <span class="text-sm">Invert</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Special Images</label>
                        <div class="flex gap-4 mt-2 flex-wrap">
                            <label class="flex items-center text-gray-900 dark:text-gray-100 cursor-pointer">
                                <input type="checkbox" x-model="cat" @change="updatePreview" class="mr-2 rounded">
                                <span class="text-sm">Cat</span>
                            </label>
                            <label class="flex items-center text-gray-900 dark:text-gray-100 cursor-pointer">
                                <input type="checkbox" x-model="dog" @change="updatePreview" class="mr-2 rounded">
                                <span class="text-sm">Dog</span>
                            </label>
                            <label class="flex items-center text-gray-900 dark:text-gray-100 cursor-pointer">
                                <input type="checkbox" x-model="robot" @change="updatePreview" class="mr-2 rounded">
                                <span class="text-sm">Robot</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Flash Message -->
            <div x-show="copied" x-transition 
                class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 z-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Copied to clipboard!</span>
            </div>
        </div>

        <!-- API Documentation Section -->
        <div class="mt-12 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">API Documentation</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Use our API to programmatically generate placeholder images.</p>
            
            <div class="space-y-6">
                <section>
                    <h3 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Basic Usage</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Two URL formats are supported:</p>
                    <div class="space-y-4">
                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Short format:</p>
                            <div class="bg-gray-900 p-4 rounded-lg">
                                <code class="text-green-400 text-sm break-all">
                                    /640x320?text=Hello&bg=efefef&fg=374151
                                </code>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2 font-medium">Full format:</p>
                            <div class="bg-gray-900 p-4 rounded-lg">
                                <code class="text-green-400 text-sm break-all">
                                    {{ route('placeholder', ['size' => '300x200', 'background_color' => 'FF5733', 'text_color' => 'FFFFFF']) }}
                                </code>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <h3 class="text-lg font-semibold mb-3 text-gray-900 dark:text-white">Parameters</h3>
                    <div class="space-y-2">
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-32">size</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm">Dimensions (e.g., '300x200' or '300' for square)</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-32">format</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm">png, jpg, jpeg, webp, avif, gif, bmp, ico, svg</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-32">background_color/bg</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm">Hex code for background (default: 'C8C8C8')</span>
                        </div>
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white w-32">text_color/fg</span>
                            <span class="text-gray-600 dark:text-gray-400 text-sm">Hex code for text (default: '323232')</span>
                        </div>
                    </div>
                </section>

                <a href="/api" class="inline-flex items-center text-gray-900 dark:text-white hover:text-gray-700 dark:hover:text-gray-300 font-medium">
                    View Full API Documentation
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <script>
        function imageGenerator() {
            return {
                size: '500x300',
                bgColor: '#C8C8C8',
                textColor: '#323232',
                text: '',
                format: 'png',
                font: 'arial',
                quality: 90,
                grayscale: false,
                invert: false,
                cat: false,
                dog: false,
                robot: false,
                copied: false,
                
                get previewUrl() {
                    const bg = this.bgColor.replace('#', '');
                    const text = this.textColor.replace('#', '');
                    let url = `/p/${this.size}/${bg}/${text}?format=${this.format}&font=${this.font}&quality=${this.quality}`;
                    
                    if (this.text) url += `&text=${encodeURIComponent(this.text)}`;
                    if (this.grayscale) url += `&grayscale=true`;
                    if (this.invert) url += `&invert=true`;
                    if (this.cat) url += `&cat=true`;
                    if (this.dog) url += `&dog=true`;
                    if (this.robot) url += `&robot=true`;
                    
                    return url;
                },
                
                get markdownUrl() {
                    return `![Placeholder](${this.previewUrl})`;
                },
                
                get htmlUrl() {
                    return `<img src="${this.previewUrl}" alt="Placeholder">`;
                },
                
                updatePreview() {
                    // Trigger reactivity
                },
                
                async copyToClipboard(text) {
                    try {
                        await navigator.clipboard.writeText(text);
                        this.copied = true;
                        setTimeout(() => {
                            this.copied = false;
                        }, 2000);
                    } catch (err) {
                        console.error('Failed to copy:', err);
                    }
                }
            }
        }
    </script>
</x-layout>
