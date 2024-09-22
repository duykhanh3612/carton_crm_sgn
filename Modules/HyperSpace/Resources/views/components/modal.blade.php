<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        @if(isset($type) && $type === 'form')
            <form action="{{ $action ?: '' }}" method="post" id="{{ $id.'Form' }}">
                @endif
                <div class="modal-content">
                    <div class="modal-header">
                        @isset($title)
                            <h5 class="modal-title text-uppercase" id="{{ $id }}">{{ $title }}</h5>
                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ $body }}
                    </div>
                    <div class="modal-footer">
                        {{ $footer }}
                    </div>
                </div>
                @if(isset($type) && $type === 'form')
            </form>
        @endif
    </div>
</div>