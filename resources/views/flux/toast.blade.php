<div
    x-data="{
        show: false,
        heading: '',
        text: '',
        variant: 'neutral',
        duration: 3000,
        timeout: null,

        showToast(heading, text, duration = 3000, variant = 'neutral') {
            this.heading = heading || '';
            this.text = text || '';
            this.variant = variant || 'neutral';
            this.duration = duration || 3000;
            this.show = true;

            if (this.timeout) {
                clearTimeout(this.timeout);
            }

            this.timeout = setTimeout(() => {
                this.show = false;
            }, this.duration);
        },

        close() {
            this.show = false;
            if (this.timeout) {
                clearTimeout(this.timeout);
                this.timeout = null;
            }
        }
    }"
    @toast-show.window="showToast($event.detail.slots?.heading, $event.detail.slots?.text, $event.detail.duration, $event.detail.dataset?.variant)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-2"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-2"
    class="fixed bottom-4 right-4 z-50 max-w-sm"
>
    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg shadow-lg p-4">
        <div class="flex items-start">
            <div class="flex-1">
                <h4 x-show="heading && heading.trim() !== ''" class="text-sm font-medium text-gray-900 dark:text-white" x-text="heading"></h4>
                <p class="text-sm text-gray-600 dark:text-gray-300" :class="{ 'mt-1': heading && heading.trim() !== '' }" x-text="text"></p>
            </div>
            <button @click="close" class="ml-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</div>
