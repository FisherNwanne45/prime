<div class="row">
    <div class="col-12">
        <div class="user-ranking-mobile">
            <div class="icon">
                <img src="{{ asset($user?->avatar ?? 'global/materials/user.png') }}"
                    alt="{{ $user?->full_name ?? 'User' }}" />
            </div>
            <div class="name">
                <h4>{{ __('Hi') }}, {{ $user?->full_name }}</h4>
                <p>
                    {{ $user?->rank?->ranking_name ?? __('No Rank') }}
                    @if($user?->rank?->ranking)
                    - <span>{{ $user->rank->ranking }}</span>
                    @endif
                </p>
            </div>
            @if($user?->rank?->icon)
            <div class="rank-badge">
                <img src="{{ asset($user->rank->icon) }}" alt="{{ $user->rank->ranking_name ?? 'Rank' }}" />
            </div>
            @endif
        </div>

        <div class="user-wallets-mobile">
            <img src="{{ asset('frontend/materials/wallet-shadow.png') }}" alt="" class="wallet-shadow">
            <div class="head">{{ __('All Wallets in') }} {{ $currency ?? '' }}</div>

            {{-- Main Wallet --}}
            <div class="one">
                <div class="balance">
                    <span
                        class="symbol">{{ $currencySymbol ?? '' }}</span>{{ Str::before($user?->balance ?? '0.00', '.') }}<span
                        class="after-dot">.{{ strpos($user?->balance ?? '', '.') !== false ? Str::after($user->balance, '.') : '00' }}</span>
                </div>
                <div class="wallet">{{ __('Main Wallet') }}</div>
            </div>

            {{-- Profit Wallet --}}
            <div class="one p-wal">
                <div class="balance">
                    <span
                        class="symbol">{{ $currencySymbol ?? '' }}</span>{{ Str::before($user?->profit_balance ?? '0.00', '.') }}<span
                        class="after-dot">.{{ strpos($user?->profit_balance ?? '', '.') !== false ? Str::after($user->profit_balance, '.') : '00' }}</span>
                </div>
                <div class="wallet">{{ __('Profit Wallet') }}</div>
            </div>

            <div class="info">
                <i icon-name="info"></i>{{ __('You Earned') }} {{ $dataCount['profit_last_7_days'] ?? 0 }}
                {{ $currency ?? '' }} {{ __('This Week') }}
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="mob-shortcut-btn">
            <a href="{{ route('user.deposit.amount') }}"><i icon-name="download"></i> {{ __('Deposit') }}</a>
            <a href="{{ route('user.schema') }}"><i icon-name="box"></i> {{ __('Investment') }}</a>
            <a href="{{ route('user.withdraw.view') }}"><i icon-name="send"></i> {{ __('Withdraw') }}</a>
        </div>
    </div>

    <div class="col-12">
        <!-- Navigation -->
        @include('frontend::user.mobile_screen_include.dashboard.__navigations')

        <!-- Statistics -->
        @include('frontend::user.mobile_screen_include.dashboard.__statistic')

        <!-- Recent Transactions -->
        @include('frontend::user.mobile_screen_include.dashboard.__transactions')
    </div>

    <div class="col-12">
        <div class="mobile-ref-url mb-4">
            <div class="all-feature-mobile">
                <div class="title">{{ __('Referral URL') }}</div>
                <div class="mobile-referral-link-form">
                    <input type="text" value="{{ $referral?->link ?? '' }}" id="refLink" readonly />
                    <button type="button" onclick="copyRef()">
                        <span id="copy">{{ __('Copy') }}</span>
                    </button>
                </div>
                <p class="referral-joined">
                    {{ $referral?->relationships()?->count() ?? 0 }} {{ __('people have joined using this URL') }}
                </p>
            </div>
        </div>
    </div>
</div>