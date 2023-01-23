@extends ('dashboard')
@section('contenido')
    <!-- row -->
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="row">
        <div class="col-lg-12">
            <div class="profile">
                <div class="profile-head">
                    <!--<div class="photo-content">
                            <div class="cover-photo"></div>
                            <div class="profile-photo">
                                <img src="{{ asset('images/profile.png') }}" class="img-fluid rounded-circle" alt="">
                            </div>
                        </div>-->
                    <div class="profile-info">
                        <div class="row justify-content-center">
                            <div class="col-xl-8">
                                <div class="row">
                                    <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                        <div class="profile-name">
                                            <h4 class="text-primary">{{ $employer->legal_business_name }}</h4>
                                            <p>{{ $employer->trade_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                        <div class="profile-email">
                                            <h4 class="text-muted">{{ $employer->primary_contact_email }} </h4>
                                            <p>Contact Email</p>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xl-4 col-sm-4 prf-col">
                                                                                    <div class="profile-call">
                                                                                        <h4 class="text-muted">(+1) 321-837-1030</h4>
                                                                                        <p>Phone No.</p>
                                                                                    </div>
                                                                                </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="profile-blog pt-3 border-bottom-1 pb-1">

                        @can('approve employer')
                            @if ($employer->validated != 1)
                                <h5 class="text-primary d-inline">Aprove employer</h5>
                                <br>
                                <div>
                                    <button type="button" class="btn btn-success float-right" onclick="modal();">Aprove <span
                                            class="btn-icon-right"><i class="fa fa-check"></i></span>
                                    </button>
                                </div>
                            @else
                                <p><strong>Case manager: </strong>
                                    @if ($employer->case_manager_id)
                                        {{ $employer->case_manager->name }}
                                    @endif
                                </p>
                            @endif
                        @endcan
                    </div>
                    <br>
                    <div class="profile-statistics">
                        <h5 class="text-primary d-inline">Request</h5>
                        <div class="text-center mt-4 border-bottom-1 pb-3">
                            <div class="row">
                                @foreach ($request as $obj)
                                    <div class="col">
                                        <h3 class="m-b-0">{{ $obj->count }}</h3><span>{{ $obj->name }}</span>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>


                    <div class="profile-blog pt-3 border-bottom-1 pb-1">
                        <h5 class="text-primary d-inline">General</h5>
                        <img src="images/profile/1.jpg" alt="" class="img-fluid mt-4 mb-4 w-100">
                        <p><strong>Legal Business Name: </strong>{{ $employer->legal_business_name }}</p>
                        <p><strong>Trade Name/​Doing Business As (DBA): </strong>{{ $employer->trade_name }}</p>
                        <p><strong>Federal Employer Identification Number: </strong>{{ $employer->federal_id_number }}</p>
                        <p><strong>Year Business Established: </strong>{{ $employer->year_business_established }}</p>
                        <p><strong>Current Number of Full-Time Equivalent Employees:
                            </strong>{{ $employer->number_employees_full_time }}</p>
                        <p><strong>Primary Business Phone: </strong>{{ $employer->primary_business_phone }}</p>
                        <p><strong>Primary Business Fax: </strong>{{ $employer->primary_business_fax }}</p>

                        <p><strong>Company Website: </strong>{{ $employer->company_website }}</p>
                        <p><strong>Has your Company participated in the H-2B program previously?: </strong>
                            @if ($employer->has_participate_h2b == 0)
                                No
                            @elseif ($employer->has_participate_h2b == 1)
                                Yes
                                <p><strong>How many years has your company participated?:
                                    </strong>{{ $employer->quantity_year_has_participate_h2b }}</p>
                            @endif
                        </p>
                        <p><strong>Primary Business Type: </strong>
                            @if ($employer->catalog_industry_id)
                                {{ $employer->industry->name }}
                            @endif
                        </p>
                        <p><strong>NAICS code: </strong>
                            @if ($employer->naics_id)
                                {{ $employer->naicsCode->cn_code }}
                            @endif
                        </p>
                        <p><strong>Latest year-end GROSS Company income: </strong>$
                            {{ $employer->year_end_gross_company_income }}
                        </p>
                        <p><strong>Latest year-end NET Company income: </strong>$
                            {{ $employer->year_end_net_company_income }}</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#my-posts" data-toggle="tab"
                                        class="nav-link active show">{!! trans('employer.EmployerData') !!}</a>
                                </li>
                                <li class="nav-item"><a href="#about-me" data-toggle="tab"
                                        class="nav-link">{!! trans('employer.Contact') !!}</a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div id="my-posts" class="tab-pane fade active show">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Principal address</h4>
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.PrincipalState') !!}</label>
                                                        <input type="text"
                                                            @if ($employer->principal_state_id) value="{{ $employer->principal_state->cs_state }}" @endif
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.PrincipalCountry') !!}</label>
                                                        <input type="text"
                                                            @if ($employer->principal_county_id) value="{{ $employer->principal_county->czc_county }}" @endif
                                                            class="form-control" readonly>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.PrincipalCity') !!}</label>
                                                        <input type="text"
                                                            @if ($employer->principal_city_id) value="{{ $employer->principal_city->czc_city }}" @endif
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.PrincipalZipCode') !!}</label>
                                                        <input type="text" value="{{ $employer->principal_zip_code }}"
                                                            class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" value="{{ $employer->principal_street_address }}"
                                                        class="form-control" readonly>
                                                </div>

                                            </form>
                                            <br>
                                            <h4 class="text-primary"> {!! trans('employer.MailingAddress') !!}</h4>
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.MailingState') !!}</label>
                                                        <input type="text"
                                                            @if ($employer->mailing_state_id) value="{{ $employer->mailling_state->cs_state }}" @endif
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.MailingCountry') !!}</label>
                                                        <input type="text"
                                                            @if ($employer->mailing_county_id) value="{{ $employer->mailling_county->czc_county }}" @endif
                                                            class="form-control" readonly>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.MailingCity') !!}</label>
                                                        <input type="text"
                                                            @if ($employer->mailing_city_id) value="{{ $employer->mailling_city->czc_city }}" @endif
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.MailingZipCode') !!}</label>
                                                        <input type="text" value="{{ $employer->mailing_zip_code }}"
                                                            class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" value="{{ $employer->mailing_street_address }}"
                                                        class="form-control" readonly>
                                                </div>

                                            </form>
                                            <br>
                                            <h4 class="text-primary">List SWA</h4>
                                            <form>
                                                @if ($swa_login->count() > 0)
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-responsive-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Username</th>
                                                                    <th>Password</th>
                                                                    <th>State</th>
                                                                    <th>Website</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($swa_login as $obj)
                                                                    <tr>
                                                                        <td>{{ $obj->swa_username }}</td>
                                                                        <td>{{ $obj->swa_password }}</td>
                                                                        <td>{{ $obj->swa->state_desc }}</td>
                                                                        <td> {{ $obj->swa->wotc_website }}</td>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div id="about-me" class="tab-pane fade ">

                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Primary Contact</h4>
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.PrimaryContact') !!}</label>
                                                        <input type="text"
                                                            value="{{ $employer->primary_contact_name }}"
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.contact_middle_name') !!}</label>
                                                        <input type="text"
                                                            value="{{ $employer->contact_middle_name }}"
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.Last') !!}</label>
                                                        <input type="text"
                                                            value="{{ $employer->primary_contact_last_name }}"
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.PrimaryContactJobTitle') !!}</label>
                                                        <input type="text"
                                                            value="{{ $employer->primary_contact_job_title }}"
                                                            class="form-control" readonly>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.PrimaryContactEmail') !!}</label>
                                                        <input type="text"
                                                            value="{{ $employer->primary_contact_email }}"
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.PrimaryContactPhone') !!}</label>
                                                        <input type="text"
                                                            value="{{ $employer->primary_contact_phone }}"
                                                            class="form-control" readonly>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.PrimaryContactCellPhone') !!}</label>
                                                        <input type="text"
                                                            value="{{ $employer->primary_contact_cellphone }}"
                                                            class="form-control" readonly>
                                                    </div>

                                                    <div class="form-group col-md-6">&nbsp;</div>


                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.State') !!}</label>
                                                        <input type="text"
                                                            @if ($contact_worksite) value="{{ $contact_worksite->state->cs_state }}" @endif
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.Country') !!}</label>
                                                        <input type="text"
                                                            @if ($contact_worksite) value="{{ $contact_worksite->county->czc_county }}" @endif
                                                            class="form-control" readonly>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.City') !!}</label>
                                                        <input type="text"
                                                            @if ($contact_worksite) value="{{ $contact_worksite->city->czc_city }}" @endif
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.ZipCode') !!}</label>
                                                        <input type="text"
                                                            @if ($contact_worksite) value="{{ $contact_worksite->zip_code_address }}" @endif
                                                            class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text"
                                                        @if ($contact_worksite) value="{{ $contact_worksite->street_address }}" @endif
                                                        class="form-control" readonly>
                                                </div>

                                            </form>
                                            <br>
                                            <h4 class="text-primary"> Signatory</h4>
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.SignatoryName') !!}</label>
                                                        <input type="text" value="{{ $employer->signatory_name }}"
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.SignatoryLastName') !!}</label>
                                                        <input type="text"value="{{ $employer->signatory_last_name }}"
                                                            class="form-control" readonly>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.SignatoryJobTitle') !!}</label>
                                                        <input type="text"value="{{ $employer->signatory_job_title }}"
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.SignatoryEmail') !!}</label>
                                                        <input type="text" value="{{ $employer->signatory_email }}"
                                                            class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryPhone') !!}</label>
                                                    <input type="text" value="{{ $employer->signatory_phone }}"
                                                        class="form-control" readonly>
                                                </div>

                                            </form>
                                            <br>


                                            <h4 class="text-primary"> Main worksite</h4>
                                            <form>
                                                <div class="form-row">



                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.State') !!}</label>
                                                        <input type="text"
                                                            @if ($main_worksite) value="{{ $main_worksite->state->cs_state }}" @endif
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.Country') !!}</label>
                                                        <input type="text"
                                                            @if ($main_worksite) value="{{ $main_worksite->county->czc_county }}" @endif
                                                            class="form-control" readonly>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.City') !!}</label>
                                                        <input type="text"
                                                            @if ($main_worksite) value="{{ $main_worksite->city->czc_city }}" @endif
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{!! trans('employer.ZipCode') !!}</label>
                                                        <input type="text"
                                                            @if ($main_worksite) value="{{ $main_worksite->zip_code_address }}" @endif
                                                            class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" value="{{ $main_worksite->street_address }}"
                                                        class="form-control" readonly>
                                                </div>

                                            </form>
                                            <br>
                                            <h4 class="text-primary">Aditional worksites</h4>
                                            <form>
                                                @if ($aditional_worksite->count() > 0)
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-responsive-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>State</th>
                                                                    <th>County</th>
                                                                    <th>City</th>
                                                                    <th>Zip Code</th>
                                                                    <th>Address</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($aditional_worksite as $obj)
                                                                    <tr>
                                                                        @if ($obj->state_id_address)
                                                                            <td>{{ $obj->state->cs_state }}</td>
                                                                        @else
                                                                            <td></td>
                                                                        @endif

                                                                        @if ($obj->county_id)
                                                                            <td>{{ $obj->county->czc_county }}aa</td>
                                                                        @else
                                                                            <td></td>
                                                                        @endif

                                                                        @if ($obj->city_id)
                                                                            <td>{{ $obj->city->czc_city }}</td>
                                                                        @else
                                                                            <td></td>
                                                                        @endif



                                                                        <td>{{ $obj->zip_code_address }}</td>



                                                                        @if ($obj->street_address)
                                                                            <td>{{ $obj->street_address }}</td>
                                                                        @else
                                                                            <td></td>
                                                                        @endif



                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif
                                            </form>

                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modal approve -->

    <div class="modal fade " id="modal_approve" tabindex="-1" role="dialog" aria-hidden="true" data-tipo="1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ url('employer_admin/activate') }}">
                    <div class="modal-header">
                        <h5 class="modal-title">approve</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $employer->id }}">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <h4>Do you want to approve the employer?</h4>

                        <div class="form-group">
                            <label>Case manager</label>
                            <select class="form-control select2" name="case_manager_id">
                                @if ($case_managers)
                                    @foreach ($case_managers as $obj)
                                        <option value="{{ $obj->id }}">
                                            {{ $obj->name }}
                                        </option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')

    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        function modal() {
            $('#modal_approve').modal('show');
        }
    </script>
@endsection
