<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body style="margin:0;padding:0;background:#fff;font-family:'Inter',ui-sans-serif,system-ui,sans-serif;">

        <div style="display:flex;height:100vh;overflow:hidden;">

            {{-- ── Left: pure aerial photo + live clock ──────────────── --}}
            <div style="position:relative;flex:0 0 60%;overflow:hidden;">

                <img src="{{ asset('assets/images/school/aerialview.jpeg') }}"
                     alt="Equatorial College"
                     style="width:100%;height:100%;object-fit:cover;display:block;">

                {{-- Bottom scrim so text & clock read cleanly --}}
                <div style="position:absolute;inset-x:0;bottom:0;height:58%;
                            background:linear-gradient(to top,rgba(4,14,28,0.88) 0%,rgba(4,14,28,0.50) 52%,transparent 100%);"></div>

                {{-- Tagline + clock — centered bottom --}}
                <div style="position:absolute;bottom:0;left:0;right:0;
                            display:flex;flex-direction:column;align-items:center;
                            padding-bottom:48px;gap:22px;">

                    {{-- Tagline --}}
                    <div style="text-align:center;padding:0 40px;">
                        <p style="font-family:'Inter',sans-serif;font-size:2rem;font-weight:800;
                                  color:#fff;line-height:1.2;margin:0;">
                            Your alumni home,<br>
                            <span style="color:#67bc45;">always open.</span>
                        </p>
                    </div>

                    {{-- Clock pill --}}
                    <div style="background:rgba(20,20,20,0.78);border-radius:12px;
                                padding:16px 32px;backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px);
                                text-align:center;">
                        <div style="display:flex;align-items:baseline;justify-content:center;gap:10px;">
                            <span id="ecosa-clock"
                                  style="font-family:'Inter',sans-serif;font-size:2.4rem;font-weight:700;
                                         color:#fff;letter-spacing:3px;line-height:1;
                                         font-variant-numeric:tabular-nums;"></span>
                            <span id="ecosa-ampm"
                                  style="font-family:'Inter',sans-serif;font-size:1.1rem;font-weight:500;
                                         color:rgba(255,255,255,0.50);"></span>
                        </div>
                        <div id="ecosa-date"
                             style="margin-top:5px;font-family:'Inter',sans-serif;font-size:11.5px;
                                    font-weight:500;letter-spacing:0.15em;
                                    color:rgba(255,255,255,0.60);text-align:center;"></div>
                    </div>

                </div>
            </div>

            {{-- ── Right: plain white panel, slot content centred ────── --}}
            <div style="flex:1;display:flex;flex-direction:column;
                        padding:48px 56px;background:#fff;overflow-y:auto;">

                {{-- Centered form area --}}
                <div style="flex:1;display:flex;flex-direction:column;justify-content:center;">

                    {{-- Logo at top of form area --}}
                    <div style="margin-bottom:32px;">
                        <a href="{{ route('home') }}"
                           style="display:inline-flex;align-items:center;gap:12px;text-decoration:none;">
                            <img src="{{ asset('assets/images/logo.png') }}"
                                 alt="ECOSA"
                                 style="height:64px;width:64px;object-fit:contain;">
                            <div>
                                <p style="font-size:22px;font-weight:800;color:#173a60;margin:0;line-height:1;">ECOSA</p>
                                <p style="font-size:11px;font-weight:500;color:#94a3b8;margin:3px 0 0;">Together for the Bright Future</p>
                            </div>
                        </a>
                    </div>

                    {{-- Slot — the specific auth page content goes here --}}
                    <div style="max-width:380px;width:100%;">
                        {{ $slot }}
                    </div>

                </div>

                {{-- Footer --}}
                <div style="text-align:center;padding-top:24px;">
                    <p style="font-size:11.5px;color:#c0c9d4;margin:0;line-height:1.6;">
                        &copy; {{ date('Y') }} ECOSA &nbsp;·&nbsp;
                        Developed by
                        <a href="https://www.kamatrustai.com"
                           target="_blank" rel="noopener"
                           style="color:#94a3b8;text-decoration:none;font-weight:600;"
                           onmouseover="this.style.color='#173a60'"
                           onmouseout="this.style.color='#94a3b8'">Kamatrust AI</a>
                    </p>
                </div>

            </div>

        </div>

        {{-- Live clock --}}
        <script>
            function ecosaUpdateClock() {
                const now  = new Date();
                let h      = now.getHours();
                const m    = String(now.getMinutes()).padStart(2,'0');
                const s    = String(now.getSeconds()).padStart(2,'0');
                const ampm = h >= 12 ? 'PM' : 'AM';
                h = h % 12 || 12;
                document.getElementById('ecosa-clock').textContent =
                    String(h).padStart(2,'0') + ':' + m + ':' + s;
                document.getElementById('ecosa-ampm').textContent = ampm;
                const days   = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
                const months = ['January','February','March','April','May','June',
                                'July','August','September','October','November','December'];
                const d = now;
                document.getElementById('ecosa-date').textContent =
                    days[d.getDay()] + ', ' + d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
            }
            ecosaUpdateClock();
            setInterval(ecosaUpdateClock, 1000);
        </script>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
