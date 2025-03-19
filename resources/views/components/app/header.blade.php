<header class="sticky top-0 before:absolute before:inset-0 before:backdrop-blur-md max-lg:before:bg-white/90 dark:max-lg:before:bg-gray-100/90 before:-z-10 z-30 {{ $variant === 'v2' || $variant === 'v3' ? 'before:bg-white after:absolute after:h-px after:inset-x-0 after:top-full after:bg-gray-200 dark:after:bg-gray-300/60 after:-z-10' : 'max-lg:shadow-sm lg:before:bg-white/90 dark:lg:before:bg-gray-100/90' }} {{ $variant === 'v2' ? 'dark:before:bg-gray-100' : '' }} {{ $variant === 'v3' ? 'dark:before:bg-gray-200' : '' }}">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 {{ $variant === 'v2' || $variant === 'v3' ? '' : 'lg:border-b border-gray-200 dark:border-gray-300/60' }}">

            <!-- Header: Left side -->
            <div class="flex">
                <!-- Hamburger button -->
                <button
                    class="text-gray-700 hover:text-gray-900 dark:hover:text-gray-600 lg:hidden"
                    @click.stop="sidebarOpen = !sidebarOpen"
                    aria-controls="sidebar"
                    :aria-expanded="sidebarOpen"
                >
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="5" width="16" height="2" />
                        <rect x="4" y="11" width="16" height="2" />
                        <rect x="4" y="17" width="16" height="2" />
                    </svg>
                </button>
            </div>

            <!-- Header: Right side -->
            <div class="flex items-center space-x-4">

                <!-- Search Button with Modal -->
                <x-modal-search>
                    <svg class="w-6 h-6 fill-current text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M11 2a9 9 0 1 0 9 9 9.01 9.01 0 0 0-9-9zm0 16a7 7 0 1 1 7-7 7.008 7.008 0 0 1-7 7zm3.74-6.28a7.5 7.5 0 0 1-6.28-3.74l5.94 5.94a1 1 0 1 0 1.42-1.42z"/>
                    </svg>
                </x-modal-search>

                <!-- Notifications button -->
                <x-dropdown-notifications align="right">
                    <svg class="w-6 h-6 fill-current text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 24c1.1 0 1.99-.9 1.99-2H10.01C10.01 23.1 10.9 24 12 24zm6-6V9c0-3.31-2.69-6-6-6-2.69 0-5 1.71-5.83 4.06C5.2 7.29 4 9.61 4 12v6l-2 2v1h16v-1l-2-2z"/>
                    </svg>
                </x-dropdown-notifications>

                <!-- Info button -->
                <x-dropdown-help align="right">
                    <svg class="w-6 h-6 fill-current text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M13 7h-2v2h2V7zm0 4h-2v6h2v-6zm-1 10c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z"/>
                    </svg>
                </x-dropdown-help>

                <!-- Dark mode toggle -->
                <x-theme-toggle />

                <!-- Divider -->
                <hr class="w-px h-6 bg-gray-300 dark:bg-gray-400/60 border-none" />

                <!-- User button -->
                <x-dropdown-profile align="right">
                    <svg class="w-6 h-6 fill-current text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.33-8 4v2h16v-2c0-2.67-5.33-4-8-4z"/>
                    </svg>
                </x-dropdown-profile>

            </div>

        </div>
    </div>
</header>