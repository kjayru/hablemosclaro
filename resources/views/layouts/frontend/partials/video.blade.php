<section class="section m--bg ultimos_videos">
    <div class="limit">
        <h3 class="g-title m--white">Últimos videos</h3>
        <div class="ultimos_videos__list">

            <article class="ultimos_videos__item m--principal fnShowVideoTarget">
                <iframe class="ultimos_videos__item__video" src="https://www.youtube-nocookie.com/embed/{{ @$videos[0]['video'] }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe></iframe>
                <header class="ultimos_videos__item__header">
                    <strong class="ultimos_videos__item__subtitle">{{ @$videos[0]['categoria']->nombre }}</strong>

                    @if(isset($videos[0]['subcategoria']))
                        <a href="/{{@$videos[0]['categoria']->slug}}/{{@$videos[0]['subcategoria']->slug}}/{{@$videos[0]['slug']}}" class="ultimos_videos__item__title">{{ @$videos[0]['titulo'] }}</a>
                    @else
                        <a href="/{{@$videos[0]['categoria']->slug}}/{{@$videos[0]['slug']}}" class="ultimos_videos__item__title">{{ @$videos[0]['titulo'] }}</a>
                    @endif

                </header>
            </article>
            <div class="ultimos_videos__sublist">

              @foreach(@$videos as $key => $vid)

                @if($key<3)
                    @php
                        if(isset($vid['subcategoria'])){
                            $vid_url = "/".@$vid['categoria']->slug."/".@$vid['subcategoria']->slug."/".$vid['slug'];
                        }else{
                            $vid_url = "/".@$vid['categoria']->slug."/".@$vid->slug;
                        }
                    @endphp
                <article class="ultimos_videos__item <?= $key==0?'-active-':''; ?> fnShowVideoButton" data-video="{{@$vid['video']}}" data-url="{{@$vid_url}}">
                    <picture class="ultimos_videos__item__image">
                        <img src="https://img.youtube.com/vi/{{@$vid['video']}}/0.jpg" alt="" loading="lazy">
                        <span class="ultimos_videos__item__image__timer">{{ $vid['lectura']}} min</span>
                    </picture>
                    <header class="ultimos_videos__item__header">
                        <strong class="ultimos_videos__item__subtitle">{{ @$vid['categoria']->nombre}}</strong>
                        <a href="{{ $vid_url }}" class="ultimos_videos__item__title">{{ @$vid['titulo'] }}</a>
                    </header>
                </article>
                @endif
            @endforeach

            </div>
        </div>
    </div>
</section>
