<section class="user_card">
    <h2 aria-level="2" role="heading" class="user_card__title">
        {{ auth()->user()->pseudo }} <span class="user_card__hashtag">{{ '#' . auth()->user()->hashtag }}</span>
    </h2>
    <p class="user_card__name">
        {{ auth()->user()->name }}
    </p>
</section>
