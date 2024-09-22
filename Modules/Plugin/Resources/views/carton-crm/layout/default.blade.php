@extends('plugin::carton-crm.master')
@section('content')
    <section class="content-wrapper">
        <div class="content-wrapper-box">
            {!! @$content !!}
        </div>
    </section>
@endsection

<?php if (!empty($routeRemoveItems) || !empty($routeUpdateStatusItems)): ?>
<script>
    let routeRemoveItems = "{{ $routeRemoveItems }}";
    let routeUpdateStatusItems = "{{ $routeUpdateStatusItems }}";
</script>
<?php endif;?>
