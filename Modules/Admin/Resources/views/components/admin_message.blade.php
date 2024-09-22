@if(count($errors))
    @if($errors->has('message'))
        <div class="alert alert-danger" role="alert">
            <span class="d-block">{!! $errors->first('message') !!}</span>
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            <span class="d-block">{!! $errors->first() !!}</span>
        </div>
    @endif
@endif
@if(session()->has('error'))
    <div class="alert alert-danger" role="alert">
        @if(is_array(session()->get('error')))
            @foreach (session()->get('error') as $message)
                  {!! $message !!} <br/>
            @endforeach
        @else
            {!! session()->get('error') !!}
        @endif
    </div>
@endif
@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        @if(is_array(session()->get('success')))
            @foreach (session()->get('success') as $message)
                  {!! $message !!} <br/>
            @endforeach
        @else
            {!! session()->get('success') !!}
        @endif
    </div>
@endif