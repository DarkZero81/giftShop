@if ($paginator->hasPages())
    @php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        $window = 1; // تقليل عدد الأزرار ليناسب شاشات الجوال تماماً
        $start = max(1, $current - $window);
        $end = min($last, $current + $window);
        $queryParams = request()->except('page');
    @endphp

    <nav role="navigation" aria-label="Pagination Navigation" style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; margin: 20px 0; font-family: sans-serif;">
        <ul style="display: flex; items-center; list-style: none; padding: 0; margin: 0; border-radius: 6px; overflow: hidden; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            
            {{-- زر البداية --}}
            @if ($current == 1)
                <li><span style="display: flex; align-items: center; justify-content: center; px: 12px; height: 38px; padding: 0 12px; text-decoration: none; color: #9ca3af; bg-color: #f3f4f6; background: #f3f4f6; cursor: not-allowed; border-right: 1px solid #e5e7eb;">«</span></li>
            @else
                <li><a style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 12px; text-decoration: none; color: #4b5563; background: #fff; border-right: 1px solid #e5e7eb;" href="{{ $paginator->url(1) }}{{ http_build_query($queryParams) ? (strpos($paginator->url(1), '?') === false ? '?' : '&') . http_build_query($queryParams) : '' }}">«</a></li>
            @endif

            {{-- زر السابق --}}
            @if ($paginator->onFirstPage())
                <li><span style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 14px; color: #9ca3af; background: #f3f4f6; cursor: not-allowed; border-right: 1px solid #e5e7eb; font-weight: bold;">‹</span></li>
            @else
                <li><a style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 14px; text-decoration: none; color: #4b5563; background: #fff; border-right: 1px solid #e5e7eb; font-weight: bold;" href="{{ $paginator->previousPageUrl() }}">‹</a></li>
            @endif

            {{-- النقاط الأولى --}}
            @if ($start > 1)
                <li><a style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 12px; text-decoration: none; color: #4b5563; background: #fff; border-right: 1px solid #e5e7eb;" href="{{ $paginator->url(1) }}">1</a></li>
                @if ($start > 2)
                    <li><span style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 12px; color: #9ca3af; background: #fff; border-right: 1px solid #e5e7eb;">...</span></li>
                @endif
            @endif

            {{-- الأرقام المتغيرة --}}
            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $current)
                    <li><span style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 14px; color: #fff; background: #6366f1; border-right: 1px solid #6366f1; font-weight: 600;">{{ $page }}</span></li>
                @else
                    <li><a style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 14px; text-decoration: none; color: #4b5563; background: #fff; border-right: 1px solid #e5e7eb;" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
            @endfor

            {{-- النقاط الأخيرة --}}
            @if ($end < $last)
                @if ($end < $last - 1)
                    <li><span style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 12px; color: #9ca3af; background: #fff; border-right: 1px solid #e5e7eb;">...</span></li>
                @endif
                <li><a style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 12px; text-decoration: none; color: #4b5563; background: #fff; border-right: 1px solid #e5e7eb;" href="{{ $paginator->url($last) }}">{{ $last }}</a></li>
            @endif

            {{-- زر التالي --}}
            @if ($paginator->hasMorePages())
                <li><a style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 14px; text-decoration: none; color: #4b5563; background: #fff; border-right: 1px solid #e5e7eb; font-weight: bold;" href="{{ $paginator->nextPageUrl() }}">›</a></li>
            @else
                <li><span style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 14px; color: #9ca3af; background: #f3f4f6; cursor: not-allowed; border-right: 1px solid #e5e7eb; font-weight: bold;">›</span></li>
            @endif

            {{-- زر النهاية --}}
            @if ($current == $last)
                <li><span style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 12px; color: #9ca3af; background: #f3f4f6; cursor: not-allowed;">»</span></li>
            @else
                <li><a style="display: flex; align-items: center; justify-content: center; height: 38px; padding: 0 12px; text-decoration: none; color: #4b5563; background: #fff;" href="{{ $paginator->url($last) }}">»</a></li>
            @endif
        </ul>

        {{-- صندوق القفز السريع والبيانات المساعدة --}}
        <div style="display: flex; align-items: center; gap: 15px; margin-top: 10px; font-size: 12px; color: #f3f4f6;">
            <span style="color: rgba(255,255,255,0.8)">Page {{ $current }} of {{ $last }}</span>
            
            <form method="GET" style="display: inline-flex; align-items: center; gap: 6px;" action="{{ request()->url() }}">
                @foreach (request()->except('page') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <input name="page" type="number" min="1" max="{{ $last }}" style="width: 45px; height: 24px; text-align: center; border: 1px solid #e5e7eb; border-radius: 4px; color: #000; font-size: 11px;" placeholder="#" />
                <button type="submit" style="height: 24px; padding: 0 8px; background: #fff; color: #4f46e5; border: 1px solid #e5e7eb; border-radius: 4px; cursor: pointer; font-size: 11px; font-weight: bold;">Go</button>
            </form>
        </div>
    </nav>
@endif
