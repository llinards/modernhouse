@foreach($cookies->getCategories() as $category)
<h5 class="mt-4 mb-2">{{ $category->title }}</h5>
@if($category->description)
    <p class="text-muted" style="font-size: 14px;">{{ $category->description }}</p>
@endif
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>@lang('cookieConsent::cookies.cookie')</th>
                <th>@lang('cookieConsent::cookies.purpose')</th>
                <th>@lang('cookieConsent::cookies.duration')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($category->getCookies() as $cookie)
            <tr>
                <td><code>{{ $cookie->name }}</code></td>
                <td>{{ $cookie->description }}</td>
                <td class="text-nowrap">{{ Carbon\Carbon::now()->diffForHumans(Carbon\Carbon::now()->addMinutes($cookie->duration), true) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endforeach
