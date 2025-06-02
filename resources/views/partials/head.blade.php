<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

@isset($title)
    <title>{{ $title }} | Service Marketplace</title>
@else
    <title>Service Marketplace</title>
@endisset

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'])

<script>
    window.setAppearance = function (appearance) {
        let setDark = () => document.documentElement.classList.add('dark')
        let setLight = () => document.documentElement.classList.remove('dark')
        let setButtons = (appearance) => {
            document.querySelectorAll('button[onclick^="setAppearance"]').forEach((button) => {
                button.setAttribute('aria-pressed', String(appearance === button.value))
            })
        }
        if (appearance === 'system') {
            let media = window.matchMedia('(prefers-color-scheme: dark)')
            window.localStorage.removeItem('appearance')
            media.matches ? setDark() : setLight()
        } else if (appearance === 'dark') {
            window.localStorage.setItem('appearance', 'dark')
            setDark()
        } else if (appearance === 'light') {
            window.localStorage.setItem('appearance', 'light')
            setLight()
        }
        if (document.readyState === 'complete') {
            setButtons(appearance)
        } else {
            document.addEventListener("DOMContentLoaded", () => setButtons(appearance))
        }
    }
    window.setAppearance(window.localStorage.getItem('appearance') || 'system')
</script>
