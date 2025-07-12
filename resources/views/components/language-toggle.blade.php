{{-- Language Dropdown Toggle (Bootstrap 5) --}}
<div class="dropdown language-dropdown {{ $class ?? '' }}" style="{{ $style ?? '' }}">
    <button class="btn btn-link dropdown-toggle d-flex align-items-center text-decoration-none" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color:#64748b;font-weight:500;">
        <i class="fas fa-globe me-2"></i>
        <span class="fw-normal">{{ __('auth.change_language') ?? 'Change Language' }}</span>
    </button>
    <ul class="dropdown-menu shadow-sm border-0 mt-1" aria-labelledby="languageDropdown" style="min-width:180px;">
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 {{ app()->isLocale('en') ? 'active bg-primary text-white' : '' }}" href="{{ url('/lang/en') }}">
                <span style="font-size:1.2em;">🇬🇧</span>
                <span>English</span>
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 {{ app()->isLocale('ar') ? 'active bg-primary text-white' : '' }}" href="{{ url('/lang/ar') }}">
                <span style="font-size:1.2em;">🇪🇬</span>
                <span>العربية</span>
            </a>
        </li>
    </ul>
</div>

{{-- No custom JS needed: Bootstrap dropdown handles all interactions --}}

@push('styles')
<style>
.language-dropdown .dropdown-toggle {
    color: #64748b;
    background: none;
    border: none;
    font-size: 1.05rem;
    outline: none;
    box-shadow: none !important;
    transition: color 0.2s;
}
.language-dropdown .dropdown-toggle:focus, .language-dropdown .dropdown-toggle:hover {
    color: #2563eb;
    background: none;
    text-decoration: underline;
}
.language-dropdown .dropdown-menu {
    border-radius: 0.65rem;
    min-width: 180px;
    padding: 0.25rem 0;
    font-size: 1rem;
    box-shadow: 0 4px 24px 0 rgba(30,41,59,.08);
}
.language-dropdown .dropdown-item {
    border-radius: 0.45rem;
    transition: background 0.18s, color 0.18s;
    font-weight: 500;
    padding: 0.5rem 1rem;
}
.language-dropdown .dropdown-item.active, .language-dropdown .dropdown-item:active, .language-dropdown .dropdown-item:focus {
    background: #2563eb !important;
    color: #fff !important;
}
.language-dropdown .dropdown-item span {
    display: inline-block;
    vertical-align: middle;
}
</style>
@endpush
