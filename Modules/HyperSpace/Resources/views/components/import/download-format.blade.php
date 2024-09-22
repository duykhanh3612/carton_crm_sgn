<!-- Download format -->
@if(!empty($listFormat))
    @if(count($listFormat) > 1)
        <div class="form-group">
            <label>{{ $title ?? '' }}</label>
            @foreach($listFormat as $format)
                <div class="radio">
                    <label>
                        <input type="radio" name="{{ $formatName }}" @if(!empty($format['checked'])) checked @endif
                               value="{{ $format['value'] }}">{{ $format['label'] }}
                        <a href="{{ $format['link'] }}"><i class="fa fa-download"></i>&nbsp; Download</a>
                    </label>
                </div>
            @endforeach
        </div>
    @else
        @php
            $format = reset($listFormat);
        @endphp
        <label>
            {{ $format['label'] }}
            <a href="{{ $format['link'] }}"><i class="fa fa-download"></i>&nbsp; Download</a>
        </label>
    @endif
@endif
