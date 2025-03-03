<div x-data="{ modalOpen: @entangle($attributes->wire('model')) }">
    <button class="btn bg-gray-900 cdj8c cg0jr ch8z9 cilvw cyn7a" @click.prevent="modalOpen = true" aria-controls="feedback-modal">
        {{ $buttonText ?? 'Send Feedback' }}
    </button>
    <!-- Modal backdrop -->
    <div class="bg-gray-900 c29tc c2iqv cini7 cjxg0 cys4p" x-show="modalOpen" x-transition:enter="cxxol cbmha c8uqq" 
         x-transition:enter-start="opacity-0" x-transition:enter-end="cgcrn" x-transition:leave="cxxol cbmha cf39k" 
         x-transition:leave-start="cgcrn" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak>
    </div>
    <!-- Modal dialog -->
    <div id="feedback-modal" class="flex items-center justify-center cxe43 cnbwt cini7 cjxg0 cys4p codu7 clbq0" 
         role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="cxxol cz9ag c8uqq" 
         x-transition:enter-start="opacity-0 cu867" x-transition:enter-end="cgcrn csdj3" 
         x-transition:leave="cxxol cz9ag c8uqq" x-transition:leave-start="cgcrn csdj3" 
         x-transition:leave-end="opacity-0 cu867" x-cloak>
        <div class="bg-white c2vpa co669 caufm cb8zv ccwri crwo8 c6btv" @click.outside="modalOpen = false" 
             @keydown.escape.window="modalOpen = false">
            <!-- Modal header -->
            <div class="border-gray-200 cghq3 ctv3r cx3hp c72q5">
                <div class="flex items-center cm3rx">
                    <div class="text-gray-800 dark:text-gray-100 cgulq">Send Feedback</div>
                    <button class="c3e4j cg12x cmpw7 cdqku" @click="modalOpen = false">
                        <div class="cn8jz">Close</div>
                        <svg class="cbm9w" width="16" height="16" viewBox="0 0 16 16">
                            <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Modal content -->
            <div class="cx3hp cz8qb">
                <div class="text-sm">
                    <div class="text-gray-800 dark:text-gray-100 c1k3n cxg65">Let us know what you think 🙌</div>
                </div>
                <div class="cjav5">
                    <div>
                        <label class="block text-sm c1k3n cu6vl" for="name">Name <span class="czr3n">*</span></label>
                        <input id="name" class="caqf9 c6btv c9hxi cwn3v" type="text" required>
                    </div>
                    <div>
                        <label class="block text-sm c1k3n cu6vl" for="email">Email <span class="czr3n">*</span></label>
                        <input id="email" class="caqf9 c6btv c9hxi cwn3v" type="email" required>
                    </div>
                    <div>
                        <label class="block text-sm c1k3n cu6vl" for="feedback">Message <span class="czr3n">*</span></label>
                        <textarea id="feedback" class="c071z c6btv c9hxi cwn3v" rows="4" required></textarea>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="border-gray-200 cghq3 cr4kg cx3hp cz8qb">
                <div class="flex flex-wrap justify-end ch3kz">
                    <button class="border-gray-200 text-gray-800 cc0oq cghq3 cspbm c0zkc cnf4p" @click="modalOpen = false">Cancel</button>
                    <button class="bg-gray-900 cdj8c cg0jr ch8z9 cilvw cyn7a cnf4p">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>
