<?php /*<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
*/
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Blank Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">



</head>

<body>

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">
                <form action="{{ url('register_employer') }}" method="POST">
                    <div class="box-header with-border">
                        <h4><strong>CREATE ACOUNT</strong></h4>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div role="form">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            required>
                                    </div>

                                    <div id="alert_email" class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                        error, there is already a user with this email.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div role="form">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="confirm_pass" class="form-control"
                                            required>
                                    </div>

                                    <div id="alert_pass" class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
                                        <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                        error, The passwords do not match.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>







                    <div class=" with-border">
                        <h4><strong>{!! trans('employer.Title') !!}</strong></h4>
                    </div>

                    @csrf
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div role="form">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('employer.LegalName') !!}</label>
                                        <input type="text" name="legal_business_name" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{!! trans('employer.TradeName') !!}</label>
                                        <input type="text" name="trade_name" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.IdentificationNumber') !!}</label>
                                        <input type="text" name="federal_id_number" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.YearBusinessEstablished') !!}</label>
                                        <input type="number" name="year_business_established" min="1900"
                                            max="<?php echo date('Y'); ?>" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.NumberEmployees') !!}</label>
                                        <input type="text" name="number_employees_full_time" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.PrimaryBusinessPhone') !!}</label>
                                        <input type="text" name="primary_business_phone" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.PrimaryBusinessFax') !!}</label>
                                        <input type="text" name="primary_business_fax" class="form-control">
                                    </div>




                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div role="form">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label>{!! trans('employer.CompanyWebsite') !!}</label>
                                        <input type="text" name="company_website" class="form-control">
                                    </div>


                                    <div class="form-group">
                                        <label>{!! trans('employer.ParticipatedH-2B') !!}</label>
                                        <select class="form-control" name="has_participate_h2b"
                                            id="ParticipatedH-2B">
                                            <option value="0">{!! trans('employer.No') !!} </option>
                                            <option value="1">{!! trans('employer.Yes') !!} </option>
                                        </select>
                                    </div>


                                    <div class="form-group" id="DivYearsCompanyParticipated">
                                        <label>{!! trans('employer.YearsCompanyParticipated') !!}</label>
                                        <input type="number" name="quantity_year_has_participate_h2b"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.PrimaryBusiness') !!}</label>
                                        <select class="form-control" name="primary_business_type_id"
                                            id="PrimaryBusinessType">
                                            <option value="">Select</option>
                                            @foreach ($primary_business_types as $obj)
                                                <option value="{{ $obj->id }}">{{ $obj->name_english }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="DivNaicsCodCompany">
                                        <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                        <select class="form-control" name="naics_id" id="NaicsCod">

                                        </select>
                                    </div>

                                    <div class="form-group" id="DivNaicsNameCompany">
                                        <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                        <input type="text" name="naics_code" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.GrossCompanyIncome') !!}</label>
                                        <input type="number" name="year_end_gross_company_income"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.NetCompanyIncome') !!}</label>
                                        <input type="number" name="year_end_net_company_income"
                                            class="form-control">
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-3">&nbsp;</div>
                    </div>
                    <div class="with-border">
                        <h4><strong>{!! trans('employer.PrincipalPlaceBusiness') !!}</strong></h4>
                    </div>

                    <div class="col-md-12">
                        <br>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>{!! trans('employer.PrincipalStreetAddress') !!}</label>
                                <input type="text" name="principal_street_address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>{!! trans('employer.PrincipalCity') !!}</label>
                                <input type="text" name="principal_city" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.PrincipalCountry') !!}</label>
                                <input type="text" name="principal_country" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.PrincipalState') !!}</label>
                                <select class="form-control" name="principal_state_id">
                                    @foreach ($principal_states as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.PrincipalZipCode') !!}</label>
                                <input type="number" name="principal_zip_code" class="form-control">
                            </div>


                        </div>
                        <div class="col-md-6">



                            <br>
                            <div class="form-group">
                                <input type="checkbox" name="mailing_address_same_above"
                                    id="SameAsAbove">&nbsp;{!! trans('employer.SameAsAbove') !!}
                            </div>
                            <br>
                            <div id="DivMailin">
                                <div class="form-group">
                                    <label>{!! trans('employer.MailingAddress') !!}</label>
                                    <input type="text" name="mailing_address" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.MailingCity') !!}</label>
                                    <input type="text" name="mailing_city" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.MailingState') !!}</label>
                                    <select class="form-control" name="mailing_state">
                                        @foreach ($principal_states as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.MailingZipCode') !!}</label>
                                    <input type="text" name="mailing_zip_code" class="form-control">
                                </div>



                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="with-border">
                                <h4><strong>{!! trans('employer.EmployerContactInformation') !!}</strong></h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContact') !!}</label>
                                    <input type="text" name="primary_contact_name"
                                        placeholder="{!! trans('employer.Name') !!}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.Last') !!}</label>
                                    <input type="text" name="primary_contact_last_name"
                                        placeholder="{!! trans('employer.Last') !!}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactJobTitle') !!}</label>
                                    <input type="text" name="primary_contact_job_title" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactEmail') !!}</label>
                                    <input type="text" name="primary_contact_email" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactPhone') !!}</label>
                                    <input type="text" name="primary_contact_phone" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactCellPhone') !!}</label>
                                    <input type="text" name="primary_contact_cellphone" class="form-control">
                                </div>


                            </div>
                            <div class="col-md-6">



                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactListed') !!}</label>
                                    <select class="form-control" name="signed_all_documents"
                                        id="PrimaryContactListed">
                                        <option value="1">{!! trans('employer.Yes') !!} </option>
                                        <option value="0">{!! trans('employer.No') !!} </option>

                                    </select>
                                </div>
                                <div id="DivSignatory">

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryName') !!}</label>
                                        <input type="text" name="signatory_name" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryLastName') !!}</label>
                                        <input type="text" name="signatory_last_name" class="form-control"
                                            >
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryJobTitle') !!}</label>
                                        <input type="text" name="signatory_job_title" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryEmail') !!}</label>
                                        <input type="mail" name="signatory_email" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryPhone') !!}</label>
                                        <input type="text" name="signatory_phone" class="form-control">
                                    </div>

                                </div>


                            </div>
                            <div class="col-md-3">&nbsp;</div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>

                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-md-12">&nbsp;</div>
        </div>
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript">
            //validar usuario

            $("#email").blur(function() {
                var email = $(this).val();
                $.get("{{ url('validate_email') }}" + '/' + email, function(data) {
                    console.log(data);
                    if (data != '0') {
                        $('#alert_email').show();
                    } else {
                        $('#alert_email').hide();
                    }
                });
            });

            $("#password").blur(function() {

                validate_email();
            });

            $("#confirm_pass").blur(function() {

                validate_email();
            });


            function validate_email() {
               // console.log("pass " + document.getElementById('password').value.trim());
              //  console.log("confirm " + document.getElementById('confirm_pass').value.trim());
                if (document.getElementById('password').value.trim() != '' && document.getElementById('confirm_pass').value
                    .trim() != '') {
                    if (document.getElementById('password').value.trim() != document.getElementById('confirm_pass').value.trim()) {
                        $('#alert_pass').show();
                    } else {
                        $('#alert_pass').hide();
                    }
                }
            }


            $("#ParticipatedH-2B").change(function() {
                if (document.getElementById('ParticipatedH-2B').value == 1) {
                    $('#DivYearsCompanyParticipated').show();
                } else {
                    $('#DivYearsCompanyParticipated').hide();
                }

            });

            $("#PrimaryContactListed").change(function() {
                if (document.getElementById('PrimaryContactListed').value == 1) {
                    $('#DivSignatory').hide();

                } else {
                    $('#DivSignatory').show();
                }

            });


            $("#SameAsAbove").change(function() {
                if (document.getElementById('SameAsAbove').checked == true) {
                    $('#DivMailin').hide();

                } else {
                    $('#DivMailin').show();
                }

            });



            $("#PrimaryBusinessType").change(function() {
                var PrimaryBusinessType = $(this).val();

                if (PrimaryBusinessType != 6) {
                    $('#DivNaicsCodCompany').show();
                    $('#DivNaicsNameCompany').hide();

                    $.get("{{ url('get_naics_code') }}" + '/' + PrimaryBusinessType, function(data) {
                        //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                        console.log(data);
                        var _select = ''
                        for (var i = 0; i < data.length; i++)
                            _select += '<option value="' + data[i].id + '"  >' + data[i].code + ' ' + data[i]
                            .name +
                            '</option>';
                        $("#NaicsCod").html(_select);
                    });
                } else {
                    $('#DivNaicsCodCompany').hide();
                    $('#DivNaicsNameCompany').show();
                }



            });
            //


            $(document).ready(function() {
                $('#DivYearsCompanyParticipated').hide();
                $('#DivSignatory').hide();

                $('#DivNaicsCodCompany').show();
                $('#DivNaicsNameCompany').hide();
                $('#alert_email').hide();
                $('#alert_pass').hide();
            });
        </script>
</body>

</html>
