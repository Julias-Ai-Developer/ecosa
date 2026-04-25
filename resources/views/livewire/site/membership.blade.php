<main>
    <x-site.page-hero
        eyebrow="Membership Registration"
        title="Membership Registration"
        current="Membership Registration"
        :image="asset('assets/images/school/aerialview.jpeg')"
    />

    <section class="site-section">
        <div class="mx-auto max-w-7xl px-5 lg:px-8">
            <div class="site-grid-2 items-start">
                <div>
                    <x-site.section-heading
                        eyebrow="Registration Guide"
                        title="Everything needed for a complete membership record."
                        text="The form captures your personal details, professional category, address, and payment information in a clear two-step flow."
                    />

                    <div class="mt-8 grid gap-4">
                        @foreach ($benefits as $benefit)
                            <div class="site-card flex gap-4 rounded-[24px] p-5">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-ecosa-blue text-white">
                                    <i class="fas fa-check"></i>
                                </div>
                                <p class="text-sm leading-7 text-zinc-600">{{ $benefit }}</p>
                            </div>
                        @endforeach

                        <div class="site-card p-6">
                            <p class="text-xs font-bold uppercase tracking-[0.24em] text-zinc-400">Registration Fee</p>
                            <p class="mt-4 font-display text-5xl font-semibold text-ecosa-blue-deep">UGX 20,000</p>
                            <p class="mt-4 text-sm leading-7 text-zinc-600">
                                After registration, the system emails your membership ID and links the record to your member portal account.
                            </p>
                        </div>

                        {{-- Payment Methods Info --}}
                        <div class="site-card overflow-hidden p-0">
                            <div class="bg-ecosa-blue-deep px-6 py-4">
                                <p class="font-accent text-xs font-bold uppercase tracking-[0.24em] text-white/60">Accepted Payment Methods</p>
                            </div>
                            <div class="grid grid-cols-2 gap-0 divide-x divide-ecosa-blue/8">
                                <div class="flex items-center gap-3 p-5">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#FFC200]/15">
                                        <i class="fas fa-mobile-screen-button text-xl text-[#FFC200]"></i>
                                    </div>
                                    <div>
                                        <p class="font-accent text-sm font-bold text-ecosa-blue-deep">MTN Mobile Money</p>
                                        <p class="text-xs text-zinc-500">Send &amp; confirm instantly</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 p-5">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#E40000]/10">
                                        <i class="fas fa-mobile-screen-button text-xl text-[#E40000]"></i>
                                    </div>
                                    <div>
                                        <p class="font-accent text-sm font-bold text-ecosa-blue-deep">Airtel Money</p>
                                        <p class="text-xs text-zinc-500">Send &amp; confirm instantly</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="site-card p-6 sm:p-8">
                    @if ($submitted)
                        <div class="site-success mb-6">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-circle-check text-2xl text-ecosa-green"></i>
                                <div>
                                    <p class="font-bold">Registration Submitted Successfully!</p>
                                    <p class="mt-1 text-xs text-ecosa-green-deep">Membership ID: <strong>{{ $submittedMembershipNumber }}</strong></p>
                                </div>
                            </div>
                            <p class="mt-3 text-sm">Payment status: <strong>{{ $submittedPaymentStatus }}</strong>. Use your email on the member login page to access your portal — use the password reset flow if you haven't set one.</p>
                        </div>
                    @endif

                    <p class="font-accent text-xs font-bold uppercase tracking-[0.28em] text-zinc-400">Step 1 of 2 — Personal Details</p>
                    <h2 class="mt-3 font-display text-4xl font-semibold text-ecosa-blue-deep">Complete your membership form</h2>

                    <form wire:submit.prevent="openPaymentModal" class="mt-6 grid gap-5">
                        <div class="grid gap-5 sm:grid-cols-2">
                            <label>
                                <span class="site-label">Full Name</span>
                                <input type="text" wire:model.blur="fullName" class="site-input" placeholder="Your full name">
                                @error('fullName') <p class="site-error">{{ $message }}</p> @enderror
                            </label>
                            <label>
                                <span class="site-label">Email Address</span>
                                <input type="email" wire:model.blur="email" class="site-input" placeholder="you@example.com">
                                @error('email') <p class="site-error">{{ $message }}</p> @enderror
                            </label>
                            <label>
                                <span class="site-label">Completion Year</span>
                                <input type="number" wire:model.blur="completionYear" class="site-input" placeholder="2018">
                                @error('completionYear') <p class="site-error">{{ $message }}</p> @enderror
                            </label>
                            <label>
                                <span class="site-label">Phone Number</span>
                                <input type="tel" wire:model.blur="phone" class="site-input" placeholder="+256...">
                                @error('phone') <p class="site-error">{{ $message }}</p> @enderror
                            </label>
                        </div>

                        <label>
                            <span class="site-label">Current Address</span>
                            <input type="text" wire:model.blur="currentAddress" class="site-input" placeholder="Town, district, or full address">
                            @error('currentAddress') <p class="site-error">{{ $message }}</p> @enderror
                        </label>

                        <div class="grid gap-5 sm:grid-cols-2">
                            <label>
                                <span class="site-label">Professional Category</span>
                                <select wire:model.blur="occupationType" class="site-input">
                                    @foreach ($this->occupationTypes() as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('occupationType') <p class="site-error">{{ $message }}</p> @enderror
                            </label>
                            <label>
                                <span class="site-label">Profession / Job Title</span>
                                <input type="text" wire:model.blur="occupationTitle" class="site-input" placeholder="Teacher, engineer, entrepreneur...">
                                @error('occupationTitle') <p class="site-error">{{ $message }}</p> @enderror
                            </label>
                        </div>

                        @if ($occupationType === 'business')
                            <div class="grid gap-5 sm:grid-cols-2">
                                <label>
                                    <span class="site-label">Business Name</span>
                                    <input type="text" wire:model.blur="businessName" class="site-input" placeholder="Your business name">
                                    @error('businessName') <p class="site-error">{{ $message }}</p> @enderror
                                </label>
                                <label>
                                    <span class="site-label">Nature of Business</span>
                                    <input type="text" wire:model.blur="businessNature" class="site-input" placeholder="Consulting, retail, construction...">
                                    @error('businessNature') <p class="site-error">{{ $message }}</p> @enderror
                                </label>
                            </div>
                        @endif

                        <label>
                            <span class="site-label">Marital Status</span>
                            <select wire:model.blur="maritalStatus" class="site-input">
                                @foreach ($this->maritalStatuses() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('maritalStatus') <p class="site-error">{{ $message }}</p> @enderror
                        </label>

                        <button type="submit" class="site-btn-primary mt-2 w-full" wire:loading.attr="disabled" wire:target="openPaymentModal">
                            <span wire:loading.remove wire:target="openPaymentModal">
                                <i class="fas fa-arrow-right mr-1"></i> Continue to Payment
                            </span>
                            <span wire:loading wire:target="openPaymentModal">Validating details...</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Payment Modal --}}
    @if ($showPaymentModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-[#081b2c]/72 px-4 py-8 backdrop-blur-sm">
            <div class="site-card w-full max-w-xl overflow-hidden rounded-[32px]">
                <div class="border-b border-ecosa-blue/8 bg-ecosa-blue-deep px-6 py-5 text-white sm:px-8">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <span class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/10 px-3 py-1 text-[0.7rem] font-bold uppercase tracking-[0.22em] text-white">Step 2 — Payment</span>
                            <h2 class="mt-4 font-display text-4xl font-semibold">Choose your payment method</h2>
                            <p class="mt-3 text-sm leading-7 text-white/72">Registration fee: <strong class="text-ecosa-gold">UGX 20,000</strong>. Pay via MTN or Airtel Mobile Money.</p>
                        </div>
                        <button type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/14 text-white" wire:click="closePaymentModal" aria-label="Close">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="completeRegistration" class="p-6 sm:p-8">
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ($this->paymentOptions() as $value => $label)
                            <label class="cursor-pointer rounded-[24px] border-2 p-5 transition {{ $paymentMethod === $value ? 'border-ecosa-green bg-ecosa-green/5 shadow-[0_8px_24px_rgba(23,146,75,0.15)]' : 'border-ecosa-blue/10 bg-white hover:border-ecosa-green/30' }}">
                                <input type="radio" value="{{ $value }}" wire:model.live="paymentMethod" class="sr-only">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl {{ $paymentMethod === $value ? 'bg-ecosa-green text-white' : 'bg-ecosa-blue/8 text-ecosa-blue' }}">
                                        <i class="fas fa-mobile-screen-button text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-accent text-sm font-bold {{ $paymentMethod === $value ? 'text-ecosa-green-deep' : 'text-ecosa-blue-deep' }}">{{ $label }}</p>
                                        <p class="text-xs text-zinc-500">Mobile Money</p>
                                    </div>
                                    @if ($paymentMethod === $value)
                                        <i class="fas fa-circle-check ml-auto text-ecosa-green"></i>
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('paymentMethod') <p class="site-error mt-2">{{ $message }}</p> @enderror

                    <div class="mt-6 grid gap-5">
                        <label>
                            <span class="site-label">Mobile Money Number</span>
                            <input type="tel" wire:model.blur="paymentPhone" class="site-input" placeholder="+256 7XX XXX XXX">
                            <p class="mt-1 text-xs text-zinc-500">Enter the number you will send payment from.</p>
                            @error('paymentPhone') <p class="site-error">{{ $message }}</p> @enderror
                        </label>

                        <label>
                            <span class="site-label">Transaction Reference <span class="font-normal text-zinc-400">(optional)</span></span>
                            <input type="text" wire:model.blur="paymentReference" class="site-input" placeholder="Receipt or transaction reference number">
                            @error('paymentReference') <p class="site-error">{{ $message }}</p> @enderror
                        </label>
                    </div>

                    <div class="mt-6 rounded-[20px] border border-ecosa-gold/20 bg-ecosa-gold/8 p-4">
                        <p class="font-accent text-xs font-bold text-ecosa-blue-deep">How to pay via Mobile Money:</p>
                        <ol class="mt-2 grid gap-1 text-xs leading-6 text-zinc-600">
                            <li>1. Send <strong>UGX 20,000</strong> to the ECOSA account number.</li>
                            <li>2. Enter your mobile money number above.</li>
                            <li>3. Submit — our team verifies and activates your membership.</li>
                        </ol>
                    </div>

                    <div class="mt-6 flex flex-wrap justify-end gap-3">
                        <button type="button" class="site-btn-ghost" wire:click="closePaymentModal">
                            <i class="fas fa-arrow-left mr-1"></i> Back
                        </button>
                        <button type="submit" class="site-btn-primary" wire:loading.attr="disabled" wire:target="completeRegistration">
                            <span wire:loading.remove wire:target="completeRegistration">
                                <i class="fas fa-paper-plane mr-1"></i> Submit Registration
                            </span>
                            <span wire:loading wire:target="completeRegistration">Submitting...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</main>
