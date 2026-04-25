<div>
    <h1 style="font-size:1.45rem;font-weight:700;color:#111827;margin:0 0 6px;">Set your password</h1>
    <p style="font-size:13.5px;color:#6b7280;margin:0 0 28px;">
        This is your first login. Please choose a secure password to continue.
    </p>

    @if (session('status'))
        <div style="margin-bottom:18px;padding:10px 14px;border-radius:8px;
                    background:#ecfdf5;border:1px solid #6ee7b7;font-size:13px;color:#065f46;">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit="save">

        {{-- New password --}}
        <div style="margin-bottom:18px;">
            <label for="password" style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;">
                New Password
            </label>
            <div style="position:relative;" x-data="{ show: false }">
                <input id="password" name="password"
                       wire:model="password"
                       :type="show ? 'text' : 'password'"
                       required autocomplete="new-password"
                       placeholder="Minimum 8 characters"
                       style="width:100%;box-sizing:border-box;padding:11px 42px 11px 14px;
                              border-radius:8px;font-size:14px;color:#111827;outline:none;
                              border:1px solid {{ $errors->has('password') ? '#f87171' : '#d1d5db' }};
                              background:{{ $errors->has('password') ? '#fff7f7' : '#fff' }};"
                       onfocus="this.style.borderColor='#173a60';this.style.boxShadow='0 0 0 3px rgba(23,58,96,.08)'"
                       onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                <button type="button" @click="show = !show"
                        style="position:absolute;right:12px;top:50%;transform:translateY(-50%);
                               background:none;border:none;cursor:pointer;padding:0;color:#9ca3af;line-height:0;">
                    <svg x-show="!show" style="width:18px;height:18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                    <svg x-show="show" style="width:18px;height:18px;display:none;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p style="margin:5px 0 0;font-size:12px;color:#dc2626;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm password --}}
        <div style="margin-bottom:24px;">
            <label for="password_confirmation" style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;">
                Confirm Password
            </label>
            <input id="password_confirmation" name="password_confirmation"
                   wire:model="password_confirmation"
                   type="password"
                   required autocomplete="new-password"
                   placeholder="Repeat your new password"
                   style="width:100%;box-sizing:border-box;padding:11px 14px;border-radius:8px;
                          font-size:14px;color:#111827;outline:none;
                          border:1px solid #d1d5db;background:#fff;"
                   onfocus="this.style.borderColor='#173a60';this.style.boxShadow='0 0 0 3px rgba(23,58,96,.08)'"
                   onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
        </div>

        <button type="submit"
                style="width:100%;padding:12px;border:none;border-radius:8px;
                       background:#17924b;color:#fff;font-size:14px;font-weight:700;
                       letter-spacing:0.04em;cursor:pointer;transition:opacity .15s;"
                onmouseover="this.style.opacity='.88'"
                onmouseout="this.style.opacity='1'">
            Set Password & Continue
        </button>

    </form>
</div>
