@extends ('dashboard')
@section('contenido')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-12 col-xxl-12">
                        <h4 class="card-title">Formats</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-xl-12 col-xxl-12 row">

                        <div class="col-md-6">
                            <a href="{{ url('job_request/format_export') }}/{{ $job_request->id }}/6">
                                <div class="alert alert-dark"><strong>RR Attestation</strong> Form.-WITH US Workers</div>
                            </a>
                        </div>


                        <div class="col-md-6">
                            <a href="{{ url('job_request/form9141') }}/{{ $job_request->id }}" target="_blank">
                                <div class="alert alert-dark"><strong>Form 9141</strong></div>
                            </a>
                        </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
