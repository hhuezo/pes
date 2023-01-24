@extends ('dashboard')
@section('contenido')
    <div class="container-fluid">

        <!-- row -->
        <form method="POST" action="{{ url('job_request/format_export') }}" target="_blank">
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Note editor</h4>
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
