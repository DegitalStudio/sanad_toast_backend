<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    stats: Object
});
</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Admin Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-2xl font-bold mb-6">Welcome, Admin!</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="bg-blue-100 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold text-blue-800 mb-2">Total Orders</h4>
                                <p class="text-3xl font-bold text-blue-900">{{ stats.total_orders }}</p>
                            </div>
                            <div class="bg-green-100 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold text-green-800 mb-2">Menu Items</h4>
                                <p class="text-3xl font-bold text-green-900">{{ stats.total_menu_items }}</p>
                            </div>
                            <div class="bg-purple-100 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold text-purple-800 mb-2">Ingredients</h4>
                                <p class="text-3xl font-bold text-purple-900">{{ stats.total_ingredients }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-xl font-semibold">Quick Actions</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="#" class="block p-4 bg-gray-50 hover:bg-gray-100 rounded-lg border border-gray-200">
                                    <h5 class="font-semibold text-lg mb-2">Manage Menu Items</h5>
                                    <p class="text-sm text-gray-600">Add, edit, or remove menu items and their base ingredients</p>
                                </a>
                                <a href="#" class="block p-4 bg-gray-50 hover:bg-gray-100 rounded-lg border border-gray-200">
                                    <h5 class="font-semibold text-lg mb-2">Manage Ingredients</h5>
                                    <p class="text-sm text-gray-600">Manage nutritional values for all ingredients</p>
                                </a>
                                <a href="#" class="block p-4 bg-gray-50 hover:bg-gray-100 rounded-lg border border-gray-200">
                                    <h5 class="font-semibold text-lg mb-2">View All Orders</h5>
                                    <p class="text-sm text-gray-600">View and manage all Toast orders and QR codes</p>
                                </a>
                                <a href="#" class="block p-4 bg-gray-50 hover:bg-gray-100 rounded-lg border border-gray-200">
                                    <h5 class="font-semibold text-lg mb-2">User Management</h5>
                                    <p class="text-sm text-gray-600">Add or remove printer manager accounts</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
