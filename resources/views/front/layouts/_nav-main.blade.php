<header>
	<div class="row">
		<div class="lang-selector">
			<form id="setlocale" action="{{ route('front.setLocale') }}" method="POST">
				<input type="hidden" name="locale" value="{{ $locale }}">
				<a href="#" class="{{ $locale == 'en' ? 'active' : '' }}" data-locale="en">EN</a>|<a href="#" class="{{ $locale == 'uk' ? 'active' : '' }}" data-locale="uk">UA</a>
			</form>
		</div>
		<h1 class="main-title text-center">{{ $page_title or 'ArroWs Development Portfolio' }}</h1>
		<div class="hr-top"></div>
		<button class="btn btn-transparent btn-abs btn-popup" data-target="#contact-popup">@lang('app.contactme')</button>
	</div>
</header>