<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.partials.meta')

    <link rel="stylesheet" href="{{ mix('/css/front.css') }}">
    <link rel="stylesheet" href="https://cloud.typography.com/6194432/6145752/css/fonts.css">
    <livewire:styles>

    @include('layout.partials.favicons')
    @include('feed::links')

    <script src="https://polyfill.io/v2/polyfill.min.js?features=IntersectionObserver,Promise,Array.from,Element.prototype.dataset" defer></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <script src="/scope.js" defer></script>

    @include('layout.partials.analytics')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    @stack('head')

    <x-comments::styles />
</head>

<body class="flex flex-col min-h-screen">
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WGCBMG"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>

    <script>/* Empty script tag because Firefox has a FOUC */</script>
    @include('layout.partials.wallpaper')

    {{-- @include('layout.partials.cta') --}}

    @include('layout.partials.header')
    @include('layout.partials.flash')

    <div class="flex-grow" role="main">
        {{ $slot }}
    </div>

    @include('layout.partials.footer')

    <livewire:scripts>
    @stack('scripts')

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('compose', ({ text, defer = false } = {}) => {
                    // Store the editor as a non-reactive instance property
                    let editor;

                    return {
                        text,

                        init() {
                            if (! defer) {
                                this.load();
                            }
                        },

                        load() {
                            if (editor) {
                                return;
                            }

                            const textarea = this.$el.querySelector('textarea');

                            if (! textarea) {
                                return;
                            }

                            editor = new SimpleMDE({
                                element: textarea,
                                hideIcons: ['heading', 'image', 'preview', 'side-by-side', 'fullscreen', 'guide'],
                                spellChecker: false,
                                status: false,
                            });

                            editor.codemirror.on("change", () => {
                                this.text = editor.value();
                            });
                        },

                        clear() {
                            editor.value('');
                        },
                    };
                });
            });
        </script>
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {!! schema()->localBusiness() !!}

    <x-comments::scripts /> 
</body>
</html>
