<div>
    @if ($submitted)
        <div class="rounded-[18px] border border-emerald-400/30 bg-emerald-400/10 px-4 py-3 text-sm font-semibold text-emerald-200">
            Your message has been received. ECOSA will respond using your email address.
        </div>
    @endif

    <form wire:submit.prevent="sendMessage" class="{{ $submitted ? 'mt-4' : '' }} space-y-3">
        <div>
            <input
                type="text"
                wire:model.blur="name"
                class="w-full border border-white/10 bg-[#0a2a44] px-4 py-3 text-sm text-white outline-none transition placeholder:text-white/35 focus:border-[#ff5b2e]"
                placeholder="Name"
            >
            @error('name') <p class="mt-2 text-sm font-medium text-rose-300">{{ $message }}</p> @enderror
        </div>

        <div>
            <input
                type="email"
                wire:model.blur="email"
                class="w-full border border-white/10 bg-[#0a2a44] px-4 py-3 text-sm text-white outline-none transition placeholder:text-white/35 focus:border-[#ff5b2e]"
                placeholder="Email"
            >
            @error('email') <p class="mt-2 text-sm font-medium text-rose-300">{{ $message }}</p> @enderror
        </div>

        <div>
            <textarea
                wire:model.blur="message"
                rows="5"
                class="w-full resize-none border border-white/10 bg-[#0a2a44] px-4 py-3 text-sm text-white outline-none transition placeholder:text-white/35 focus:border-[#ff5b2e]"
                placeholder="Comment"
            ></textarea>
            @error('message') <p class="mt-2 text-sm font-medium text-rose-300">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="inline-flex w-full items-center justify-center bg-[#ff5b2e] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#ff6c44]" wire:loading.attr="disabled" wire:target="sendMessage">
            <span wire:loading.remove wire:target="sendMessage">Send</span>
            <span wire:loading wire:target="sendMessage">Sending...</span>
        </button>
    </form>
</div>
