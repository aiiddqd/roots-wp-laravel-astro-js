<div class="acorn-blade-smoke-test">
    <p>Rendered via Acorn/Blade at {{ $renderedAt }}.</p>
    @if($items ?? false)
        <ul>
            @foreach($items as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    @endif
</div>
