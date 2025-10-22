<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    qr_codes: Array
});
</script>

<template>
    <Head title="Printer Manager Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Printer Manager Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-2xl font-bold mb-6">Welcome, Printer Manager!</h3>

                        <div class="mb-6">
                            <div class="bg-yellow-100 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold text-yellow-800 mb-2">Pending QR Codes</h4>
                                <p class="text-3xl font-bold text-yellow-900">{{ qr_codes.length }}</p>
                                <p class="text-sm text-yellow-700 mt-2">QR codes ready for printing</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <h4 class="text-xl font-semibold">QR Codes</h4>
                                <div class="flex gap-2">
                                    <input
                                        type="text"
                                        placeholder="Search by customer name or item..."
                                        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">All Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="printed">Printed</option>
                                    </select>
                                </div>
                            </div>

                            <div v-if="qr_codes.length === 0" class="text-center py-12 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="text-gray-500 text-lg">No QR codes available yet</p>
                                <p class="text-gray-400 text-sm mt-2">QR codes will appear here when orders are received from Toast POS</p>
                            </div>

                            <div v-else class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="qr in qr_codes" :key="qr.id">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ qr.date }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ qr.customer }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ qr.item }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ qr.location }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    {{ qr.status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                                                <button class="text-green-600 hover:text-green-900 mr-3">Download</button>
                                                <button class="text-purple-600 hover:text-purple-900">Mark Printed</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
