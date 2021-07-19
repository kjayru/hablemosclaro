<section class="section m--bg ultimos_videos">
    <div class="limit">
        <h3 class="g-title m--white">Últimos videos</h3>
        <div class="ultimos_videos__list">

            <article class="ultimos_videos__item m--principal fnShowVideoTarget">
                <iframe class="ultimos_videos__item__video" src="https://www.youtube-nocookie.com/embed/{{ $videos[0]->video }}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe></iframe>
                <header class="ultimos_videos__item__header">
                    <strong class="ultimos_videos__item__subtitle">{{ $videos[0]->category->nombre }}</strong>

                    @if(isset($vid->category->parent))
                    <a href="/{{$videos[0]->category->parent->slug}}/{{$videos[0]->category->slug}}/{{$videos[0]->slug}}" class="ultimos_videos__item__title">{{ $videos[0]->titulo }}</a>
                    @else
                    <a href="/{{$videos[0]->category->slug}}/{{$videos[0]->slug}}" class="ultimos_videos__item__title">{{ $videos[0]->titulo }}</a>
                    @endif
                </header>
            </article>
            <div class="ultimos_videos__sublist">

              @foreach($videos as $key=>$vid)
                @if($key<3)
                @php
                    if(isset($vid->category->parent)){
                       $vid_url = "/".$vid->category->parent->slug."/".$vid->category->slug."/".$vid->slug;
                    }else{
                        $vid_url = "/".$vid->category->slug."/".$vid->slug;
                    }
                @endphp
                <article class="ultimos_videos__item <?= $key==0?'-active-':''; ?> fnShowVideoButton" data-video="{{$vid->video}}" data-url="{{$vid_url}}">

                    <picture class="ultimos_videos__item__image">
                        <img src="assets/public/images/ultimos_videos.png" alt="" loading="lazy">
                        <span class="ultimos_videos__item__image__timer">2 min</span>
                    </picture>
                    <header class="ultimos_videos__item__header">
                        <strong class="ultimos_videos__item__subtitle">{{ $vid->category->nombre}}</strong>
                        <a href="{{ $vid_url }}" class="ultimos_videos__item__title">{{ $vid->titulo }}</a>
                    </header>
                </article>
                @endif
            @endforeach

            </div>
        </div>
    </div>
</section>
