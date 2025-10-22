<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String
});

const currentSlide = ref(0);
const slides = [
    {
        image: 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=1200&h=600&fit=crop',
        title: 'Fresh Ingredients',
        description: 'Premium quality salads with complete nutritional information'
    },
    {
        image: 'https://images.unsplash.com/photo-1616094563780-eeebdba189e5?w=1200&h=600&fit=crop',
        title: 'QR Code Technology',
        description: 'Scan to view detailed nutrition facts instantly'
    },
    {
        image: 'https://images.unsplash.com/photo-1556761175-b413da4baf72?w=1200&h=600&fit=crop',
        title: 'Nutrition Labels',
        description: 'FDA-compliant nutrition facts for every item'
    },
    {
        image: 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=1200&h=600&fit=crop',
        title: 'Professional Printing',
        description: 'High-quality label printing for each order'
    }
];

const nextSlide = () => {
    currentSlide.value = (currentSlide.value + 1) % slides.length;
};

const prevSlide = () => {
    currentSlide.value = (currentSlide.value - 1 + slides.length) % slides.length;
};

const goToSlide = (index) => {
    currentSlide.value = index;
};

onMounted(() => {
    // Auto-advance carousel every 5 seconds
    setInterval(nextSlide, 5000);
});
</script>

<template>
    <Head title="The Good Salad - Nutrition Management" />

    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-green-50">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-green-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span class="ml-3 text-2xl font-bold text-green-800">The Good Salad</span>
                        </div>
                    </div>

                    <div v-if="canLogin" class="flex items-center space-x-4">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 font-medium shadow-sm"
                        >
                            Dashboard
                        </Link>
                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="px-6 py-2.5 text-green-700 hover:text-green-800 font-medium transition-colors"
                            >
                                Log in
                            </Link>
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 font-medium shadow-sm"
                            >
                                Register
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="text-center mb-12">
                    <div class="inline-block px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold mb-6">
                        Nutrition Management System
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Automated QR Code<br/>
                        <span class="text-green-600">Nutrition Labels</span>
                    </h1>

                    <p class="text-lg md:text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto mb-8">
                        Seamlessly integrate with Toast POS to automatically generate and print QR codes
                        containing detailed nutritional information for every order.
                    </p>

                    <div class="flex flex-wrap gap-4 justify-center mb-12">
                        <Link
                            v-if="!$page.props.auth.user"
                            :href="route('login')"
                            class="px-8 py-4 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-200 font-semibold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                        >
                            Get Started
                        </Link>
                        <Link
                            v-else
                            :href="route('dashboard')"
                            class="px-8 py-4 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-200 font-semibold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                        >
                            Go to Dashboard
                        </Link>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 max-w-2xl mx-auto">
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-green-600">100%</div>
                            <div class="text-sm md:text-base text-gray-600 mt-2">Accurate</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-green-600">Real-time</div>
                            <div class="text-sm md:text-base text-gray-600 mt-2">Processing</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl md:text-4xl font-bold text-green-600">Instant</div>
                            <div class="text-sm md:text-base text-gray-600 mt-2">QR Codes</div>
                        </div>
                    </div>
                </div>

                <!-- Carousel -->
                <div class="max-w-5xl mx-auto">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-gray-900">
                        <!-- Slides -->
                        <div class="relative h-96 md:h-[500px]">
                            <div
                                v-for="(slide, index) in slides"
                                :key="index"
                                :class="{'opacity-100': currentSlide === index, 'opacity-0': currentSlide !== index}"
                                class="absolute inset-0 transition-opacity duration-700 ease-in-out"
                            >
                                <img
                                    :src="slide.image"
                                    :alt="slide.title"
                                    class="w-full h-full object-cover"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                                <!-- Slide Content -->
                                <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                                    <h3 class="text-3xl md:text-4xl font-bold mb-2">{{ slide.title }}</h3>
                                    <p class="text-lg md:text-xl text-gray-200">{{ slide.description }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Previous Button -->
                        <button
                            @click="prevSlide"
                            class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg transition-all duration-200 hover:scale-110"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        <!-- Next Button -->
                        <button
                            @click="nextSlide"
                            class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg transition-all duration-200 hover:scale-110"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        <!-- Dots Indicator -->
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                            <button
                                v-for="(slide, index) in slides"
                                :key="index"
                                @click="goToSlide(index)"
                                :class="{
                                    'bg-white w-8': currentSlide === index,
                                    'bg-white/50 w-2': currentSlide !== index
                                }"
                                class="h-2 rounded-full transition-all duration-300"
                            ></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Powerful Features</h2>
                    <p class="text-xl text-gray-600">Everything you need to manage nutrition information efficiently</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                        <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Role-Based Access</h3>
                        <p class="text-gray-600">Admin and Printer Manager roles with customized dashboards for each user type.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                        <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Toast POS Integration</h3>
                        <p class="text-gray-600">Seamless integration with Toast API for real-time order processing and webhook support.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                        <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Smart Calculations</h3>
                        <p class="text-gray-600">Automatic nutrition calculation based on ingredients and modifiers for precise results.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                        <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">QR Code Generation</h3>
                        <p class="text-gray-600">Instant QR code generation with detailed nutrition labels for every menu item.</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                        <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Menu Management</h3>
                        <p class="text-gray-600">Comprehensive menu and ingredient management with Excel/CSV import/export.</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-gradient-to-br from-green-50 to-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                        <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Analytics & Reports</h3>
                        <p class="text-gray-600">Track orders, monitor performance, and generate comprehensive reports.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-3 gap-8">
                    <div>
                        <div class="flex items-center mb-4">
                            <svg class="h-8 w-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span class="ml-2 text-xl font-bold">The Good Salad</span>
                        </div>
                        <p class="text-gray-400">Nutrition management made simple and efficient.</p>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4">System</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li>Laravel {{ laravelVersion }}</li>
                            <li>PHP {{ phpVersion }}</li>
                            <li>Vue.js 3</li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4">Support</h4>
                        <p class="text-gray-400">For technical support and inquiries, please contact your system administrator.</p>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; 2025 The Good Salad. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
