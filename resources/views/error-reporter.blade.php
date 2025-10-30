<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RadMonitor Error Reporter Plugin for WordPress</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .glow-effect {
            position: relative;
        }
        .glow-effect::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #60A5FA, #7C3AED);
            border-radius: inherit;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .glow-effect:hover::before {
            opacity: 1;
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .gradient-border {
            position: relative;
            background: linear-gradient(#1F2937, #1F2937) padding-box,
                        linear-gradient(45deg, #60A5FA, #7C3AED) border-box;
            border: 2px solid transparent;
            border-radius: 1rem;
        }

        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100">
    <!-- Navbar -->
    <nav class="bg-gray-800/80 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <svg class="h-8 w-auto mr-3" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Outer ring with gradient and glow -->
                        <circle cx="20" cy="20" r="19" stroke="url(#ringGrad)" stroke-width="1" filter="url(#glow)"/>

                        <!-- Inner geometric pattern -->
                        <path d="M20 5 L35 20 L20 35 L5 20 Z" fill="url(#innerGrad)" opacity="0.3"/>
                        <circle cx="20" cy="20" r="12" stroke="url(#ringGrad)" stroke-width="2" fill="none"/>

                        <!-- Dynamic elements -->
                        <path d="M14 20L18 24L26 16" stroke="url(#ringGrad)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <animate attributeName="stroke-dasharray" values="0,100;100,0" dur="2s" repeatCount="indefinite"/>
                        </path>

                        <!-- Rotating accent circles -->
                        <circle cx="20" cy="8" r="2" fill="url(#accentGrad)">
                            <animateTransform attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="4s" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="32" cy="20" r="2" fill="url(#accentGrad)">
                            <animateTransform attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="4s" repeatCount="indefinite"/>
                        </circle>

                        <!-- Definitions -->
                        <defs>
                            <linearGradient id="ringGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#60A5FA">
                                    <animate attributeName="stop-color" values="#60A5FA;#7C3AED;#60A5FA" dur="4s" repeatCount="indefinite"/>
                                </stop>
                                <stop offset="100%" style="stop-color:#7C3AED">
                                    <animate attributeName="stop-color" values="#7C3AED;#60A5FA;#7C3AED" dur="4s" repeatCount="indefinite"/>
                                </stop>
                            </linearGradient>

                            <radialGradient id="innerGrad" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" style="stop-color:#60A5FA"/>
                                <stop offset="100%" style="stop-color:#7C3AED"/>
                            </radialGradient>

                            <linearGradient id="accentGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#93C5FD"/>
                                <stop offset="100%" style="stop-color:#A78BFA"/>
                            </linearGradient>

                            <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                                <feGaussianBlur stdDeviation="2" result="blur"/>
                                <feComposite in="SourceGraphic" in2="blur" operator="over"/>
                            </filter>
                        </defs>
                    </svg>
                    <span class="text-xl font-bold">RadMonitor WordPress Reporter Plugin</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="https://radmonitor.live" class="text-gray-300 hover:text-white">Main Site</a>
                    <a href="https://radmonitor.live/dashboard" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 transition">Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <!-- Background patterns -->
        <div class="inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMzLjMxIDAgNiAyLjY5IDYgNnMtMi42OSA2LTYgNi02LTIuNjktNi02IDIuNjktNiA2LTZ6IiBzdHJva2U9IiMxYTFhMWEiIHN0cm9rZS13aWR0aD0iMiIvPjwvZz48L3N2Zz4=')] opacity-10"></div>
        <div class="inset-0 bg-gradient-to-br from-blue-900/40 to-purple-900/40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative">
            <div class="top-0 right-0 -mt-10 mr-10 text-blue-500/20 text-9xl">
                <i class="fas fa-bug"></i>
            </div>

            <div class="text-center">
                <div class="inline-block mb-8">
                    <div class="relative">
                        <div class="inset-0 bg-gradient-to-r from-blue-500 to-purple-600 blur-xl opacity-50"></div>
                        <div class="relative flex items-center justify-center p-2 bg-gray-900 rounded-2xl border border-gray-700">
                            <i class="fas fa-shield-alt text-6xl text-blue-500 mr-4"></i>
                            <h1 class="text-5xl font-extrabold bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">RadMonitor WordPress Reporter Plugin</h1>
                        </div>
                    </div>
                </div>
                <p class="mt-4 text-xl text-gray-300 max-w-3xl mx-auto">Official WordPress plugin for RadMonitor: Catch and track all WordPress errors in your RadMonitor dashboard</p>
                <div class="mt-8 flex justify-center space-x-4">
                    <a href="https://wordpress.org/plugins/radmonitor" class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 transition duration-300 transform hover:scale-105">
                        Install Plugin
                        <i class="fab fa-wordpress ml-3"></i>
                    </a>
                    <a href="https://docs.radmonitor.live/plugins/error-reporter" class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-xl border-2 border-blue-500 hover:bg-blue-500/10 transition duration-300">
                        Documentation
                        <i class="fas fa-book ml-3"></i>
                    </a>
                </div>
                <div class="mt-4 text-sm text-gray-400">
                    Requires RadMonitor account • Compatible with WordPress 5.0+
                </div>
            </div>
        </div>

        <!-- Floating Stats -->
        <div class="bottom-0 left-0 right-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-gray-800/80 backdrop-blur-sm p-4 rounded-xl border border-gray-700">
                        <div class="text-3xl font-bold text-blue-500">Simple</div>
                        <div class="text-gray-400">One-Click Install</div>
                    </div>
                    <div class="bg-gray-800/80 backdrop-blur-sm p-4 rounded-xl border border-gray-700">
                        <div class="text-3xl font-bold text-purple-500">Real-time</div>
                        <div class="text-gray-400">Error Tracking</div>
                    </div>
                    <div class="bg-gray-800/80 backdrop-blur-sm p-4 rounded-xl border border-gray-700">
                        <div class="text-3xl font-bold text-green-500">Zero</div>
                        <div class="text-gray-400">Performance Impact</div>
                    </div>
                    <div class="bg-gray-800/80 backdrop-blur-sm p-4 rounded-xl border border-gray-700">
                        <div class="text-3xl font-bold text-yellow-500">Secure</div>
                        <div class="text-gray-400">End-to-End Encrypted</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- After the Hero Section -->
    <div class="py-16 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800/80 backdrop-blur-sm rounded-2xl border border-gray-700 p-8">
                <h2 class="text-3xl font-bold text-center mb-8">See How It Works</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Live Demo -->
                    <div class="gradient-border p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                        <pre class="bg-gray-900 p-4 rounded-lg overflow-x-auto">
<code class="text-sm text-gray-300">// Example WordPress Error
try {
    throw new Exception('Database connection failed');
} catch (Exception $e) {
    radmonitor_report($e);
}</code>
                        </pre>
                    </div>
                    <!-- Dashboard Preview -->
                    <div class="gradient-border p-6">
                        <img src="/images/dashboard-preview.png" alt="RadMonitor Dashboard" class="rounded-lg shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Quick Installation</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="relative bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <div class="absolute -top-4 -left-4 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center font-bold">1</div>
                    <h3 class="text-xl font-semibold mb-4 mt-2">Install Plugin</h3>
                    <p class="text-gray-400">Download and install the RadMonitor plugin from WordPress.org</p>
                </div>
                <!-- Step 2 -->
                <div class="relative bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <div class="absolute -top-4 -left-4 w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center font-bold">2</div>
                    <h3 class="text-xl font-semibold mb-4 mt-2">Add API Key</h3>
                    <p class="text-gray-400">Enter your RadMonitor API key in the plugin settings</p>
                </div>
                <!-- Step 3 -->
                <div class="relative bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <div class="absolute -top-4 -left-4 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center font-bold">3</div>
                    <h3 class="text-xl font-semibold mb-4 mt-2">Start Monitoring</h3>
                    <p class="text-gray-400">That's it! Your errors will now be tracked in RadMonitor</p>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-center mb-8">Key Features</h1>
            <p class="text-xl text-gray-400 text-center mb-12">Everything you need to monitor and improve your WordPress site</p>
        </div>
    </div>
    <div class="pb-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-700">
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Error Monitoring -->
                        <div class="bg-gray-900 p-6 rounded-xl shadow-xl border border-gray-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-blue-500/20 glow-effect">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-exclamation-triangle text-red-500 text-2xl mr-3"></i>
                                <h2 class="text-xl font-semibold">Error Monitoring</h2>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>PHP Error Tracking</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>WordPress Error Logging</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Exception Handling</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Custom Error Reporting</li>
                            </ul>
                        </div>

                        <!-- Analytics -->
                        <div class="bg-gray-900 p-6 rounded-xl shadow-xl border border-gray-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-blue-500/20 glow-effect">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-chart-line text-blue-500 text-2xl mr-3"></i>
                                <h2 class="text-xl font-semibold">Analytics</h2>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Error Frequency</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Impact Analysis</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Error Patterns</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Custom Reports</li>
                            </ul>
                        </div>

                        <!-- Security -->
                        <div class="bg-gray-900 p-6 rounded-xl shadow-xl border border-gray-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-blue-500/20 glow-effect">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-shield-alt text-green-500 text-2xl mr-3"></i>
                                <h2 class="text-xl font-semibold">Security</h2>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Secure Data Transfer</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>API Authentication</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Data Encryption</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Access Control</li>
                            </ul>
                        </div>

                        <!-- Integration -->
                        <div class="bg-gray-900 p-6 rounded-xl shadow-xl border border-gray-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-blue-500/20 glow-effect">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-puzzle-piece text-purple-500 text-2xl mr-3"></i>
                                <h2 class="text-xl font-semibold">Integration</h2>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>RadMonitor Dashboard</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Email Notifications</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Slack Alerts</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Webhook Support</li>
                            </ul>
                        </div>

                        <!-- Configuration -->
                        <div class="bg-gray-900 p-6 rounded-xl shadow-xl border border-gray-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-blue-500/20 glow-effect">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-sliders-h text-yellow-500 text-2xl mr-3"></i>
                                <h2 class="text-xl font-semibold">Configuration</h2>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Easy Setup</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Flexible Options</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Error Filtering</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Custom Rules</li>
                            </ul>
                        </div>

                        <!-- Support -->
                        <div class="bg-gray-900 p-6 rounded-xl shadow-xl border border-gray-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-blue-500/20 glow-effect">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-life-ring text-indigo-500 text-2xl mr-3"></i>
                                <h2 class="text-xl font-semibold">Support</h2>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>24/7 Support</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Documentation</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Video Tutorials</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Community Help</li>
                            </ul>
                        </div>

                        <!-- Automated Backups -->
                        <div class="bg-gray-900 p-6 rounded-xl shadow-xl border border-gray-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-blue-500/20 glow-effect">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-database text-cyan-500 text-2xl mr-3"></i>
                                <h2 class="text-xl font-semibold">Automated Backups</h2>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Daily Backups</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Secure Storage</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>One-Click Restore</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Version History</li>
                            </ul>
                        </div>

                        <!-- API Integration -->
                        <div class="bg-gray-900 p-6 rounded-xl shadow-xl border border-gray-700 hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-blue-500/20 glow-effect">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-code text-pink-500 text-2xl mr-3"></i>
                                <h2 class="text-xl font-semibold">API Integration</h2>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>RESTful API</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Custom Endpoints</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Webhooks</li>
                                <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>API Documentation</li>
                            </ul>
                        </div>

                    </div>

                    <!-- Download Section -->
                    <div class="mt-20 bg-gradient-to-r from-blue-900/50 to-purple-900/50 p-8 rounded-2xl border border-blue-700/50">
                        <div class="text-center">
                            <h2 class="text-3xl font-bold mb-4">Ready to Add Error Reporting to RadMonitor?</h2>
                            <p class="text-gray-300 mb-8">Install the plugin and connect to your RadMonitor account in minutes</p>
                            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                                <a href="https://wordpress.org/plugins/radmonitor" class="flex items-center px-6 py-3 bg-blue-600 rounded-xl hover:bg-blue-700 transition duration-300">
                                    <i class="fab fa-wordpress mr-2"></i>
                                    Install Plugin
                                </a>
                                <a href="https://docs.radmonitor.live/plugins/error-reporter" class="flex items-center px-6 py-3 bg-gray-700 rounded-xl hover:bg-gray-600 transition duration-300">
                                    <i class="fas fa-book mr-2"></i>
                                    View Documentation
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonials -->
                    <div class="mt-20">
                        <h2 class="text-2xl font-bold mb-8 text-center">What RadMonitor Users Say</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="bg-gray-900 p-6 rounded-xl border border-gray-700">
                                <div class="flex items-center mb-4">
                                    <div class="text-yellow-500">★★★★★</div>
                                </div>
                                <p class="text-gray-300 mb-4">"The error reporting plugin has been a game-changer. It integrates perfectly with RadMonitor and catches every issue."</p>
                                <div class="flex items-center">
                                    <img src="https://i.pravatar.cc/40?img=1" class="rounded-full mr-3" alt="User">
                                    <div>
                                        <div class="font-semibold">Sarah Johnson</div>
                                        <div class="text-sm text-gray-400">WordPress Developer</div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-900 p-6 rounded-xl border border-gray-700">
                                <div class="flex items-center mb-4">
                                    <div class="text-yellow-500">★★★★★</div>
                                </div>
                                <p class="text-gray-300 mb-4">"Setup was incredibly simple. Just installed the plugin, entered my RadMonitor API key, and it was working instantly."</p>
                                <div class="flex items-center">
                                    <img src="https://i.pravatar.cc/40?img=2" class="rounded-full mr-3" alt="User">
                                    <div>
                                        <div class="font-semibold">Michael Chen</div>
                                        <div class="text-sm text-gray-400">Site Administrator</div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-900 p-6 rounded-xl border border-gray-700">
                                <div class="flex items-center mb-4">
                                    <div class="text-yellow-500">★★★★★</div>
                                </div>
                                <p class="text-gray-300 mb-4">"The error analytics in RadMonitor have helped us identify and fix issues we didn't even know existed."</p>
                                <div class="flex items-center">
                                    <img src="https://i.pravatar.cc/40?img=3" class="rounded-full mr-3" alt="User">
                                    <div>
                                        <div class="font-semibold">Emma Wilson</div>
                                        <div class="text-sm text-gray-400">Lead Developer</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="mt-20 text-center">
                        <div class="inline-block p-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl">
                            <a href="https://wordpress.org/plugins/radmonitor" class="block px-8 py-4 bg-gray-900 rounded-lg hover:bg-gray-800 transition duration-300">
                                <span class="text-xl font-semibold">Install the Plugin Now</span>
                                <p class="text-sm text-gray-400 mt-2">Free with your RadMonitor subscription</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Before the Footer -->
    <div class="py-16 bg-gray-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Frequently Asked Questions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- FAQ Item -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-xl font-semibold mb-4">Will this slow down my site?</h3>
                    <p class="text-gray-400">No, RadMonitor is designed to have minimal impact on your site's performance. Error reporting happens asynchronously.</p>
                </div>
                <!-- New FAQ Items -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-xl font-semibold mb-4">Do I need a RadMonitor account?</h3>
                    <p class="text-gray-400">Yes, you'll need a RadMonitor account to use this plugin. You can sign up for free at radmonitor.live.</p>
                </div>

                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-xl font-semibold mb-4">What PHP versions are supported?</h3>
                    <p class="text-gray-400">The plugin supports PHP 7.2 and above, including PHP 8.x versions.</p>
                </div>

                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-xl font-semibold mb-4">How secure is the error reporting?</h3>
                    <p class="text-gray-400">All data is encrypted in transit using TLS 1.3 and we never store sensitive information like passwords or API keys.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Before Footer -->
    <div class="py-12 bg-gray-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center items-center gap-8">
                <img src="/images/wordpress-verified.svg" alt="WordPress Verified" class="h-16 opacity-75 hover:opacity-100 transition">
                <img src="/images/php-compatible.svg" alt="PHP Compatible" class="h-16 opacity-75 hover:opacity-100 transition">
                <img src="/images/gdpr-compliant.svg" alt="GDPR Compliant" class="h-16 opacity-75 hover:opacity-100 transition">
                <img src="/images/ssl-secure.svg" alt="SSL Secure" class="h-16 opacity-75 hover:opacity-100 transition">
                <img src="/images/soc2-certified.svg" alt="SOC2 Certified" class="h-16 opacity-75 hover:opacity-100 transition">
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 border-t border-gray-700 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">RadMonitor</h3>
                    <ul class="space-y-2">
                        <li><a href="https://radmonitor.live/features" class="text-gray-400 hover:text-white">Features</a></li>
                        <li><a href="https://radmonitor.live/pricing" class="text-gray-400 hover:text-white">Pricing</a></li>
                        <li><a href="https://docs.radmonitor.live" class="text-gray-400 hover:text-white">Documentation</a></li>
                        <li><a href="https://api.radmonitor.live" class="text-gray-400 hover:text-white">API</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Plugin</h3>
                    <ul class="space-y-2">
                        <li><a href="https://wordpress.org/plugins/radmonitor" class="text-gray-400 hover:text-white">WordPress.org</a></li>
                        <li><a href="https://community.radmonitor.live" class="text-gray-400 hover:text-white">Community</a></li>
                        <li><a href="https://status.radmonitor.live" class="text-gray-400 hover:text-white">Status</a></li>
                        <li><a href="https://radmonitor.live/contact" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="https://radmonitor.live/about" class="text-gray-400 hover:text-white">About</a></li>
                        <li><a href="https://blog.radmonitor.live" class="text-gray-400 hover:text-white">Blog</a></li>
                        <li><a href="https://radmonitor.live/careers" class="text-gray-400 hover:text-white">Careers</a></li>
                        <li><a href="https://radmonitor.live/press" class="text-gray-400 hover:text-white">Press</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="https://radmonitor.live/privacy" class="text-gray-400 hover:text-white">Privacy</a></li>
                        <li><a href="https://radmonitor.live/terms" class="text-gray-400 hover:text-white">Terms</a></li>
                        <li><a href="https://radmonitor.live/security" class="text-gray-400 hover:text-white">Security</a></li>
                        <li><a href="https://radmonitor.live/licenses" class="text-gray-400 hover:text-white">Licenses</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Add these decorative elements throughout the page -->
    <!-- After the navbar -->
    <div class="absolute top-0 right-0 -z-10 w-[200px] h-[200px] bg-blue-500/30 rounded-full blur-[120px]"></div>
    <div class="absolute top-40 left-10 -z-10 w-[300px] h-[300px] bg-purple-500/20 rounded-full blur-[120px]"></div>

    <!-- Add animated background patterns -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:14px_24px]"></div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 -left-4 w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full floating"></div>
            <div class="absolute top-20 right-10 w-4 h-4 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full floating" style="animation-delay: -2s"></div>
            <div class="absolute bottom-40 left-1/4 w-6 h-6 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full floating" style="animation-delay: -4s"></div>
        </div>
    </div>

</body>
</html>
