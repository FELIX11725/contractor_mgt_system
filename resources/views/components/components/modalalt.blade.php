<div x-data="{ open: true }">
    <!-- Modal Overlay -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-show="open" @click.away="open = false">
        <!-- Modal Container -->
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-4">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
            </div>

            <!-- Modal Content -->
            <div class="px-6 py-4">
                {{ $content }}
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-4">
                {{ $footer }}
            </div>
        </div>
    </div>
</div>