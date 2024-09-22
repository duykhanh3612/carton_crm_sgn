<!-- Button trigger modal -->
<button type="button" class="btn {{ $btnStyle ?? 'btn-primary' }} {{ $btnClass ?? '' }}" data-toggle="modal"
        data-target="#{{ $id }}">
    {{ $title ?? '' }}
</button>

<!-- Modal -->
<div class="modal fade {{ $modalClass ?? '' }}" id="{{ $id }}" tabindex="-1" role="dialog"
     aria-labelledby="{{ $id }}Label"
     aria-hidden="true">
    <form id="{{ $formId ?? '' }}" action="{{ $formAction ?? '' }}" method="{{ $formMethod ?? 'post' }}"
          enctype="{{ $formId ?? 'multipart/form-data' }}">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $id }}Label">{{ $modalTitle ?? '' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $slot ?? '' }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ $titleClose ?? 'Cancel' }}</button>
                    <button type="submit" class="btn {{ $btnStyle ?? 'btn-primary' }}"
                            id="{{ $btnSubmitId ?? '' }}">{{ $titleSubmit ?? 'Submit' }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
