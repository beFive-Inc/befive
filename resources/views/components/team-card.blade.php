@if(isset(auth()->user()->team))
    <section class="team_card">
        <div class="team_card__img_container">
            <img src="" alt="">
        </div>
        <h2 aria-level="2" role="heading" class="team_card__title">
            {{ auth()->user()->team->name }}
        </h2>
    </section>
@endif
