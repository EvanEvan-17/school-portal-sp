<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css'])

        @livewireStyles
        <script>
        // Load dark mode before page renders to prevent flicker
        const loadDarkMode = () => {
            const theme = localStorage.getItem('theme') ?? 'system'
            const body = document.body
            if (
                theme === 'dark' ||
                (theme === 'system' &&
                    window.matchMedia('(prefers-color-scheme: dark)')
                    .matches)
            ) {
                document.documentElement.classList.add('dark')
                if(body != null) body.classList.add('dark')

            }
        }
                
        // Initialize on page load
        loadDarkMode();
        // Reinitialize after Livewire navigation (for spa mode)
        document.addEventListener('livewire:navigated', function() {
            loadDarkMode();
        });
    </script>
    {!! RecaptchaV3::initJs() !!}