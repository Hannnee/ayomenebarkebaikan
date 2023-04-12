<a href="{{ ($mode == 'dark-mode') ? route('theme.update', 'light-mode') : route('theme.update', 'dark-mode') }}">
    <em class="icon ni ni-{{ ($mode == 'dark-mode') ? 'sun' : 'moon' }}"></em>
    <span>{{ ($mode == 'dark-mode') ? 'Light' : 'Dark' }} mode</span>
</a>

