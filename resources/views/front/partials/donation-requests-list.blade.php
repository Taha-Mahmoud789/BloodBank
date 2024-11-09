<div class="patients">
{{-- @dd($records)--}}
        @foreach($records as $request)
            <div class="details">
                <div class="blood-type">
                    <h2 dir="ltr">{{ $request->bloodType->name }}</h2>
                </div>
                <ul>
                    <li><span>اسم الحالة:</span> {{ $request->patient_name }}</li>
                    <li><span>مستشفى:</span> {{ $request->hospital_name }}</li>
                    <li><span>المدينة:</span> {{ $request->city->name }}</li>
                </ul>
                <a href="{{ route('donation-details', ['id' => $request->id]) }}">التفاصيل</a>
            </div>
        @endforeach
</div>

<div class="donation-requests">
    @if ($records->count())
        <div class="pages mt-4">
            {{ $records->links('vendor.pagination.bootstrap-5') }} <!-- Use Bootstrap 4 pagination -->
        </div>
    @else
        <div class="details">
            <p class="text-center">عذرًا، لا توجد طلبات تبرع متاحة حاليًا.</p>
        </div>
    @endif
</div>

