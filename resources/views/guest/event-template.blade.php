@extends('layouts.main')


@section('content')
    <div class="bordered-wrapper first event">
        <div class="container short banner" data-pos="46% 50%">
            <div class="content title">
                @yield('page-title')
                <div class="sub-title">@yield('sub-title')</div>
            </div>
        </div>
    </div>

    @yield('event')
@endsection


@section('scripts')
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script>
        ((delay) => {
            const grid = document.querySelector('.grid');
            const msnry = new Masonry(grid, {
                'item-selector': 'grid-item',
                'gutter': 3,
                fitWidth: true,
            });

            console.log('setup media swap');
            const mediaLinks = document.querySelectorAll('.media-swap');
            mediaLinks.forEach(mediaLink => {
                mediaLink.addEventListener('click', swapMedia);
            })

            setTimeout(() => msnry.layout(), delay);
        })(3000);

        function preventDefault(e) {
            e.preventDefault();
            console.log('click action prevented', e.target);
            return false;
        }

        function swapMedia(e) {
            e.preventDefault();
            const el = e.target;
            el.classList.add('playing');
            el.removeEventListener('click', swapMedia);

            const fr = el.parentNode.querySelector('iframe');
            fr.src = fr.dataset.src;
        }
    </script>

    @yield('event_scripts')
@endsection


@section('styles')
    <style type="text/css">
        .bordered-wrapper.event {
            border: 0 none;
        }

        .short.banner {
            width: 100%;
            height: 300px;
            position: relative;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            padding: 0;
            content: attr(data-image);
            background-color: #222;
        }

        .short.banner .title {
            transform: translateY(-20%);
        }

        .short.banner .sub-title {
            margin-top: 2em;
            font-size: 12%;
        }

        .grid-holder {
            display: flex;
            align-content: center;
            justify-content: center;
            width: 100%;
            margin: 1em 0;
            overflow-x: hidden;
        }

        .grid {
            width: 100%;
        }

        .grid-item {
            width: 20%;
            margin-bottom: 3px;
            min-width: calc(var(--img-width, 300) * 1px);
            min-height: calc(var(--img-height, 200) * 1px);
            display: grid;
            position: relative;
            justify-content: center;
            align-content: center;
        }

        .grid-item img {
            width: 100%;
            transition: opacity 350ms ease;
            opacity: 1;
        }

        .grid-item iframe {
            width: auto;
            display: none;
            background-color: #222;
        }

        .grid-item>a {
            display: block;
            width: 100%;
            max-width: 300px;
            max-height: 535px;
        }

        .grid-item a>* {
            pointer-events: none;
        }

        .grid-item a.playing {
            display: none;
        }

        .grid-item a.playing+iframe {
            display: inherit;
        }

        .grid-item.video a:not(.playing):after {
            content: 'Video';
            position: absolute;
            inset: 50% 0;
            text-transform: uppercase;
            font-weight: 600;
            color: #fff;
            text-shadow: 0 0 2px #222, 0 0 4px #222, 0 0 8px #000, 0 0 16px #fff, 0 0 32px #fff;
            background-color: rgba(255, 255, 255, .5);
            font-size: 150%;
            z-index: 2;
        }

        .grid-item.video a:not(.playing):hover img,
        .grid-item.video a:not(.playing):focus img,
        .grid-item.video a:not(.playing):active img {
            opacity: .5;
        }

        @media screen and (max-width: 531px) {
            .short.banner .title {
                line-height: 18vw;
                font-size: 22vw;
                transform: translateY(-45%);
            }
        }
    </style>
    @yield('event_styles')
@endsection