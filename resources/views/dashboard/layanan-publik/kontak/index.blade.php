@extends('dashboard.template.layout')

@section('title', 'Kontak')

@section('body-content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item">Layanan Publik</li>
                <li class="breadcrumb-item active" aria-current="page">Kontak</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Daftar kontak website</h4>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-9 d-flex align-items-center">
        <div style="font-size: 12px;">Show</div>
        <select class="form-control mx-2" style="width: 70px" id="limit-contact">
            @foreach($limitOption as $opt)
            @if ($opt == $limit)
            <option value="{{ $opt }}" selected>{{ $opt }}</option>
            @else
            <option value="{{ $opt }}">{{ $opt }}</option>
            @endif
            @endforeach
        </select>
        <div style="font-size: 12px;">entries</div>
    </div>
    <div class="col-md-3">
        <form action="{{ route('dashboard.layanan-publik.kontak') }}" style="position: relative;">
            <input type="hidden" name="limit" value="{{ $limit }}" />
            <input class="form-control" placeholder="Cari data..." name="name" value="{{ $name }}"
                id="search-contact" />
            <button type="submit" class="btn btn-primary" style="right:0;top: 0; height: 100%; position: absolute">
                <i data-feather="search"></i>
            </button>
        </form>
    </div>
</div>

<div data-label="Example" class="df-example demo-table">
    <div class="table-responsive p-2">
        <table class="table mg-b-0">
            <thead>
                <th>Nama</th>
                <th>Subject</th>
            </thead>
            <tbody>
                @if (count($contacts) > 0)
                @foreach ($contacts as $c)
                <tr class="table-hover" onclick="showDetail('{{ json_encode($c) }}')">
                    <td style="width: 20%;">{{ $c->name }}</td>
                    <td>{{ $c->subject }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center">Oops data masih kosong...</td>
                </tr>
                @endif
            </tbody>
        </table>
        <div class="w-100 d-flex justify-content-center">
            {{ $contacts->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label
                            class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Subject</label>
                        <p class="mg-b-0" id="subject-contact"></p>
                    </div>
                    <div class="col-6 col-sm mb-3">
                        <label
                            class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Nama</label>
                        <p class="mg-b-0" id="name-contact"></p>
                    </div>
                    <div class="col-6 col-sm mb-3">
                        <label
                            class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Email</label>
                        <p class="mg-b-0" id="email-contact"></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label
                            class="tx-10 tx-medium tx-spacing-1 tx-color-03 tx-uppercase tx-sans mg-b-10">Pesan</label>
                        <p class="mg-b-0" id="message-contact"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#limit-contact").on("change", (e) => {
        let qp = new URLSearchParams();
        qp.set("limit", e.target.value);
        qp.set("name", $("#search-contact").val());
        window.location.href = "/dashboard/layanan-publik/kontak?" + qp.toString();
    })

    function showDetail(data) {
        const parseData = JSON.parse(data);
        $('#modal-detail').modal('show')
        $("#subject-contact").html(parseData?.subject)
        $("#name-contact").html(parseData?.name)
        $("#email-contact").html(parseData?.email)
        $("#message-contact").html(parseData?.message)
    }

</script>
@endsection
