<nav class="bg-white h-13 shadow mb-8 px-6 md:px-0">
    <div class="container mx-auto h-full flex flex-col content-around">
        <div class="flex items-center justify-center pt-3">
            <div class="flex-1 md:flex-none text-center md:text-left ml-8 md:ml-0">
                <a href="{{ route('admin.index') }}" class="text-lg font-hairline text-grey-darkest no-underline hover:underline">
                    {{ config('app.name', 'Laravel') }} - Admin Panel
                </a>
            </div>
            <div class="md:flex-1 md:text-right">
                @guest
                    <a class="no-underline hover:underline text-grey-darker pr-3 text-sm" href="{{ url('/login') }}">{{ __('Login') }}</a>
                    <a class="no-underline hover:underline text-grey-darker text-sm" href="{{ url('/register') }}">{{ __('Register') }}</a>
                @else
                    <dropdown>
                        <div slot="link" class="block md:hidden">
                            <button class="flex items-center px-3 py-2 border rounded text-blue border-blue-light hover:text-white hover:bg-blue-dark hover:border-blue-dark" style="outline: none;">
                                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                            </button>
                        </div>
                        <button slot="link" class="hidden md:block btn is-blue is-small" style="outline: none;">{{ Auth::user()->name }}</button>

                        <div slot="dropdown-items" class="w-32 mt-px bg-white border border-grey rounded-b p-2 text-right">
                            <a href="{{ route('logout') }}"
                                class="no-underline hover:underline text-grey-darker text-sm"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </dropdown>
                @endguest
            </div>
        </div>
        <div class="flex item-end justify-center mb-2 mt-2 md:mt-0">
            <dropdown>
                <a slot="link" class="no-underline hover:underline text-grey-darker pr-3 text-sm dropdown-toggle" href="#">Cards</a>
                <div slot="dropdown-items" class="w-32 mt-px mr-3 bg-white border border-grey rounded-b p-3">
                    <a href="{{ route('admin.cards.index') }}" class="block mb-2 text-right no-underline hover:underline text-grey-darker text-sm">Show All</a>
                    @if (auth()->check())
                        <a href="{{ route('admin.cards.index', ['by' => auth()->user()->name]) }}" class="block mb-2 text-right no-underline hover:underline text-grey-darker text-sm">Show My Cards</a>
                    @endif
                    <a href="{{ route('admin.cards.create') }}" class="block text-right no-underline hover:underline text-grey-darker text-sm">Create New</a>
                </div>
            </dropdown>

            <dropdown>
                <a slot="link" class="no-underline hover:underline text-grey-darker pr-3 text-sm dropdown-toggle" href="#">Power-Ups</a>
                <div slot="dropdown-items" class="w-32 mt-px mr-3 bg-white border border-grey rounded-b p-3">
                    <a href="{{ route('admin.powers.index') }}" class="block mb-2 text-right no-underline hover:underline text-grey-darker text-sm">Show All</a>
                    <a href="{{ route('admin.powers.create') }}" class="block text-right no-underline hover:underline text-grey-darker text-sm">Create New</a>
                </div>
            </dropdown>
        </div>
    </div>
</nav>