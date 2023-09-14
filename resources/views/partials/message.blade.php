@if (Session::has('errors'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <h4 class="alert-heading">
            Terjadi Kesalahan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </h4>
        <hr>
        <ul class="list">
            @php $errorFieldNames = []; @endphp
            @foreach (Session::get('errors')->getMessageBag()->toArray() as $fieldName => $messages)
                @php $errorFieldNames[] = $fieldName; @endphp
                @foreach ($messages as $message)
                    <li>{!! $message !!}</li>
                @endforeach
            @endforeach
        </ul>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            @foreach ($errorFieldNames as $fieldName)
                @php
                    if (strpos($fieldName, '.') !== false) {
                        $fieldName = implode('][', explode('.', $fieldName)).']';
                        $fieldName = substr($fieldName, 0, strpos($fieldName, ']')).substr($fieldName, strpos($fieldName, ']') + 1);
                    }
                @endphp
                $('input[name="{{ $fieldName }}"], textarea[name="{{ $fieldName }}"], select[name="{{ $fieldName }}"]').addClass('is-invalid');
            @endforeach
        });
    </script>
    @endpush
@endif
@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">
            Sukses
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </h4>
        <hr>
        <ul class="list">
            @foreach (Session::get('success')->getMessageBag()->toArray() as $messages)
                @foreach ($messages as $message)
                    <p>{!! $message !!}</p>
                @endforeach
            @endforeach
        </ul>
    </div>
@endif
@if (Session::has('warning'))
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">
            Perhatian
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </h4>
        <hr>
        <ul class="list">
            @foreach (Session::get('warning')->getMessageBag()->toArray() as $messages)
                @foreach ($messages as $message)
                    <p>{!! $message !!}</p>
                @endforeach
            @endforeach
        </ul>
    </div>
@endif