<form action="/search"
      method="get"
      class="header__form form">
    <button class="form__btn">
        <img src="{{ asset('parts/icons/outline/search-normal-1.svg') }}"
             alt>
    </button>
    <div class="form__search_container">
        <label for="search"
               class="sr_only"
               aria-hidden="{{ __('friends.field.search.placeholder') }}">
            {{ __('friends.field.search') }}
        </label>
        <input type="search"
               id="search"
               class="form__search"
               name="search"
               placeholder="{{ __('friends.field.search.placeholder') }}">
    </div>
</form>
