@extends ('dashboard')
@section('contenido')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome back!</h4>
                    <p class="mb-0">Your business dashboard template</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Summernote</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <form method="POST" action="{{ url('job_request/format_export') }}" target="_blank">
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Summernote Editor</h4>
                        </div>
                        <div class="card-body">
                            @csrf
                            <textarea name="note" class="summernote" style="height: 502.031px;">
                                {{$template->header}}
                                {{$template->body}}
                                {{$template->footer}}
                            </textarea>


                        </div>

                        <input type="submit" class="btn btn-primary btn-block">
                    </div>
                </div>
            </div>

        </form>

    </div>
@endsection
