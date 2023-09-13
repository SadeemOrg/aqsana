<style>
    .mediabox-wrap {
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: #000;
        background-color: rgba(0, 0, 0, 0.8);
        top: 0;
        left: 0;
        opacity: 0;
        z-index: 999;
        -webkit-animation-duration: 0.5s;
        animation-duration: 0.5s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        -webkit-animation-name: mediabox;
        animation-name: mediabox;
    }

    .leftline12 {
        /* content:"\A"; */
        width: 13px;
        height: 97.5%;
        background: #349A37;
        right: 10;
        /* display:inline-block; */
        margin: 0 -23px;
    }

    @-webkit-keyframes mediabox {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes mediabox {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .mediabox-content {
        max-width: 680px;
        display: block;
        margin: 0 auto;
        height: 100%;
        position: relative;
    }

    .mediabox-content iframe {
        max-width: 100% !important;
        width: 100% !important;
        display: block !important;
        height: 480px !important;
        border: none !important;
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto 0;
    }

    .mediabox-hide {
        -webkit-animation-duration: 0.5s;
        animation-duration: 0.5s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        -webkit-animation-name: mediaboxhide;
        animation-name: mediaboxhide;
    }

    @-webkit-keyframes mediaboxhide {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }

    @keyframes mediaboxhide {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }

    .mediabox-close {
        position: absolute;
        top: 0;
        cursor: pointer;
        bottom: 528px;
        right: 0px;
        margin: auto 0;
        width: 24px;
        height: 24px;
        background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAMvSURBVHja7Js9aBRBFMd/d1lPY6FiJVjY+Fkoxl7wA1Q0prQRS6tgoZV2MWIRRVHUUq3U+JnESrS2sBXBzipREWMlATXwt8gFznC5nd15M7Nn8uC45nZnfr/dY96+N1uTxFKOOks8lgUU/H2t4tJqIQUcAiaBGeBymcECRgO4B/wBPgJ9zkdKcvkclfRL/8ZtSTXH40N+GpLGF8zth6Q9Lse7DHCsDXxVJLSDLyQhb4B+Sb/VOVJJ6ATfKqGvrIDjDvCpJLjAz8d0JwmLDTBQAD62hIakiYJzm5a021VAfwn4WBLKwLdK2JUnIJP0XX4RSoIP/Hy8W3jeepv1dL3nmjwI3DLOExrAU2DA8zwb8xKhGeCuwYQtJTSAZwbwAHdcEqFM0mPZhO/foSHppdFcrraby2IDV0FCcPi8PCClhCjwLplgCgkrDeGv5I3pcjViSogK7yogloTo8EUEhJaQBL6oAGsJ9yVtkrRD0qsU8JKolagKZ8AD4ETFymFXgPOAQpXE5mMWOAk86XZ4n6pwlSSUhvcti1dBghe8RV8gpYQRX3irxkgKCSPABV94y85QTAlm8NatsRgSTOGBUnmAS57w3KiA0Ro3gHOW8KEEAOwE3hvfXWubFauu6A6vCND07OmW9viq5vpsGT3AtRAN2XoA+BfAwQBiTweoNpMZw48BRwKuAoPN7zNVWwZjwAfpO9S7DN5cQmYAPw4cTvAsYPJ3qHcpvNmdUO9ieBMJZQT0AhMVgfeWUC8BP87cjjHfuA6sATY0c4c0EgpUUHslvTaq3l5aUL1N1oarAnxSCVWBTyYhJvyw41XJJI3GkpAH/yYyfHQJi01gdUL4qBKqCh9NQrtBx4wGvGi0XS6T9MhoTkN5AtZVDN5awlTePsGfwDfPjGwYGDKu3s4Cp4BRz/N8cskED0iaqciVt7wTvkra5roKlJEQGt5HwhdJ24vmAUUkDEV+VyCT9NBxbp/bXXnXTNBFQmz4IhI6wrs+C+zvICEVvIuEKUlbrZ4G97WRkBq+k4RJSVusd4ntlfSheVudrQh8q4SbmntH6K2kzSF3if1Xsfzq7LKAJR5/BwCdAQBJn4egPgAAAABJRU5ErkJggg==') no-repeat;
        background-size: 24px 24px;
        -webkit-background-size: 24px 24px;
        -moz-background-size: 24px 24px;
        -o-background-size: 24px 24px;
    }

    .mediabox-close:hover {
        opacity: 0.5;
    }

    @media all and (max-width: 768px) and (min-width: 10px) {
        .mediabox-content {
            max-width: 90%;
        }
    }

    @media all and (max-width: 600px) and (min-width: 10px) {
        .mediabox-content iframe {
            height: 320px !important;
        }

        .mediabox-close {
            bottom: 362px;
        }
    }

    @media all and (max-width: 480px) and (min-width: 10px) {
        .mediabox-content iframe {
            height: 220px !important;
        }

        .mediabox-close {
            bottom: 262px;
        }
    }
</style>


@php
    $videohome = nova_get_setting('videohome', 'default_value');

@endphp
<div class="relative mt-12 mb-10">
    <p class="font-FlatBold text-xl sm:text-[27px] text-center mt-8 lg:mt-0 xl:text-right">
        شاهد معنا
    </p>
    <div class="absolute border-b-[4px] pt-2 border-b-[#349A37] w-10 hidden xl:block"></div>
</div>
<!--Starting Slider -->

<!--Slider Content -->
<div class="owl-carousel owl-theme owl-loaded dots-style" id="association-news-slider-5">

    @if (is_array($videohome) == true && !empty($videohome))
        @foreach (array_reverse($videohome) as $video)
            @php
                $img = $video['data']['cover'];
            @endphp
            <div class="p-3 scalabel-img-box item bg-white Card_shadow relative rounded-[5px] ">
                <div class="absolute leftline12"></div>
                <div
                    class=" relative flex flex-row flex-nowrap items-start lg:items-start justify-center gap-x-2 bg-[#E4FFE585] xl:w-[570px] h-auto sm:h-[490px] rounded-[5px]  p-3 ">
                    <div class="relative flex justify-center items-center w-full lg:max-w-[640px] lg:max-h-[320px]">
                        <a href={{ $video['data']['link'] }} class="mediabox rounded-[5px] overflow-hidden block">
                            <img class="scale-hover lg:block w-[85%] sm:max-w-[620px] sm:h-[360px] h-auto sm:max-h-[360px] object-fill lg:mt-12 rounded-md"
                                src="{{ asset($img) }}" alt="people_on_Mousq" />
                            <img src="{{ asset('assets/image/play_Svg.svg') }}"
                                class="absolute max-w-[46px] top-[40%] md:top-[48%] left-[46%]" /></a>
                    </div>
                    <p class="block sm:hidden w-full text-center absolute font-FlatBold -bottom-8 overflow-y-hidden max-h-7">

                        {{ $video['data']['Title']?$video['data']['Title']:"منظومة الاقصى" }}  </p>
                    <div
                        class="writing sm:flex justify-center absolute hidden bottom-[3%] right-6 left-6 h-[80px] text-center w-[95%]  ">
                        <div itemprop="title"
                            class="flex flex-row items-center justify-center text-white bg-[#349A37]  font-bold text-sm sm:text-lg min-h-[56px] rounded-md px-2 overflow-y-hidden text-center w-[95%]">
                            <p> {{ $video['data']['Title'] ? $video['data']['Title'] : 'منظومة الاقصى' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<script type="text/javascript">
    (function(root, factory) {
        "use strict";
        if (typeof define === 'function' && define.amd) {
            define([], factory);
        } else if (typeof exports === 'object') {
            module.exports = factory();
        } else {
            root.MediaBox = factory();
        }
    }(this, function() {
        "use strict";

        var MediaBox = function(element) {
            if (!this || !(this instanceof MediaBox)) {
                return new MediaBox(element);
            }

            this.selector = document.querySelectorAll(element);
            this.root = document.querySelector('body');
            this.run();
        };

        MediaBox.prototype = {
            run: function() {
                Array.prototype.forEach.call(this.selector, function(el) {
                    el.addEventListener('click', function(e) {
                        e.preventDefault();

                        var link = this.parseUrl(el.getAttribute('href'));
                        this.render(link);
                        this.close();
                    }.bind(this), false);
                }.bind(this));
            },
            template: function(s, d) {
                var p;

                for (p in d) {
                    if (d.hasOwnProperty(p)) {
                        s = s.replace(new RegExp('{' + p + '}', 'g'), d[p]);
                    }
                }
                return s;
            },
            parseUrl: function(url) {
                var service = {},
                    matches;

                if (matches = url.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/)) {
                    service.provider = "youtube";
                    service.id = matches[2];
                } else if (matches = url.match(
                        /https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/
                    )) {
                    service.provider = "vimeo";
                    service.id = matches[3];
                } else {
                    service.provider = "Unknown";
                    service.id = '';
                }

                return service;
            },
            render: function(service) {
                var embedLink,
                    lightbox;

                if (service.provider === 'youtube') {
                    embedLink = 'https://www.youtube.com/embed/' + service.id;
                } else if (service.provider === 'vimeo') {
                    embedLink = 'https://player.vimeo.com/video/' + service.id;
                } else {
                    throw new Error("Invalid video URL");
                }

                lightbox = this.template(
                    '<div class="mediabox-wrap"><div class="mediabox-content"><span class="mediabox-close"></span><iframe src="{embed}?autoplay=1" frameborder="0" allowfullscreen></iframe></div></div>', {
                        embed: embedLink
                    });

                this.root.insertAdjacentHTML('beforeend', lightbox);
            },
            close: function() {
                var wrapper = document.querySelector('.mediabox-wrap');

                wrapper.addEventListener('click', function(e) {
                    if (e.target && e.target.nodeName === 'SPAN' && e.target.className ===
                        'mediabox-close') {
                        wrapper.classList.add('mediabox-hide');
                        setTimeout(function() {
                            this.root.removeChild(wrapper);
                        }.bind(this), 500);
                    }
                }.bind(this), false);
            }
        };

        return MediaBox;
    }));


    //Initialize the MediaBox.

    MediaBox('.mediabox');
</script>
