@foreach ($request_details as $detail)
    <p><strong>B. Employer Point-of-Contact Information</strong><br>
        Important Note: The information contained in this section is for an employee authorized to act on behalf of the
        employer in labor certification or labor
        condition application matters. The information in this section must be different from the attorney or agent
        information listed in Section D, except when an
        attorney listed in Section D is an employee of the employer</p>

    <table border="1" style="width: 100%">
        <tbody>
            <tr>
                <td>1. Contact’s Last (family) Name *
                    <strong>{{ $detail->job_request->employer->primary_contact_last_name }}</strong>
                </td>
                <td colspan="2">2. First (given) Name *
                    <strong>{{ $detail->job_request->employer->primary_contact_name }}</strong>
                </td>
                <td>3. Middle Name(s) (if applicable)
                    <strong>{{ $detail->job_request->employer->contact_middle_name }}</strong>
                </td>
            </tr>

            <tr>
                <td colspan="4">4. Contact’s job title *
                    <strong>{{ $detail->job_request->employer->primary_contact_job_title }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="4">5. Address 1 *
                    <strong>{{ $detail->job_request->employer->primary_contact_job_title }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="4">6. Address 2 </td>
            </tr>
            <tr>
                <td colspan="2"> 7. City *
                    @if ($contact_worksite)
                        <strong>{{ $contact_worksite->city->name }}</strong>
                    @endif
                </td>
                <td>8. State *
                    @if ($contact_worksite)
                        <strong>{{ $contact_worksite->state->cs_state }}</strong>
                    @endif
                </td>
                <td>9. Postal Code *
                    @if ($contact_worksite)
                        <strong>{{ $contact_worksite->zip_code_address }}</strong>
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2">10. Country * <strong>USA</strong></td>
                <td colspan="2">11. Province (if applicable)</td>

            </tr>
            <tr>
                <td>12. Telephone number * <strong>{{ $detail->job_request->employer->primary_contact_phone }}</strong>
                </td>
                <td>13. Extension (if applicable) </td>
                <td colspan="2">14. Business E-Mail Address
                    <strong>{{ $detail->job_request->employer->primary_contact_email }}</strong>
                </td>
            </tr>

        </tbody>
    </table>

    <br><br>
    <p><strong>C. Employer Information</strong></p>
    <table border="1" style="width: 100%">
        <tbody>
            <tr>
                <td colspan="4">1. Legal Business Name *
                    <strong>{{ $detail->job_request->employer->legal_business_name }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="4">2. Trade Name/Doing Business As (DBA), if applicable
                    <strong>{{ $detail->job_request->employer->trade_name }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="4">3. Address 1
                    <strong>{{ $detail->job_request->employer->principal_street_address }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="4">4. Address 2 <strong></strong></td>
            </tr>
            <tr>
                <td colspan="2">5. City *
                    <strong>{{ $detail->job_request->employer->principal_city->name }}</strong>
                </td>
                <td>6. State * <strong>{{ $detail->job_request->employer->principal_state->cs_state }}</strong></td>
                <td>7. Postal code * <strong>{{ $detail->job_request->employer->principal_zip_code }}</strong></td>
            </tr>
            <tr>
                <td colspan="2">8. Country * <strong>USA</strong></td>
                <td colspan="2">9. Province (if applicable) <strong></strong></td>
            </tr>
            </tr>
            <tr>
                <td colspan="2">10. Telephone number *
                    <strong>{{ $detail->job_request->employer->primary_business_phone }}</strong>
                </td>
                <td colspan="2">11. Extension (if applicable) <strong></strong></td>
            </tr>
            <tr>
                <td colspan="2">12. Federal Employer Identification Number (FEIN from IRS)
                    *<strong>{{ $detail->job_request->employer->primary_business_phone }}</strong></td>
                <td colspan="2">13. NAICS code *
                    <strong>{{ $detail->job_request->employer->naicsCode->cn_code }}</strong>
                </td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <br><br>
    <p><strong>E. Wage Source Information
        </strong><br>
        Refer to instructions for all supporting documents required in this section.
        <br>
    <table border="1" style="width: 100%">
        <tbody>
            <tr>
                <td colspan="2">1. Is the employer covered by ACWIA, as described in 20 CFR 656.40(e)(1)? * (Not
                    applicable for H-2B)</td>
                <td colspan="2">
                    @if ($detail->job_request->has_acwia == 1)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    Yes &nbsp;&nbsp;
                    @if ($detail->job_request->has_acwia != 1)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    No &nbsp;&nbsp; <input type="checkbox">N/A
                </td>
            </tr>

            <tr>
                <td colspan="4">
                    a. If “Yes,” identify which ACWIA provision the employer is covered under (choose all that apply):
                    <br>
                    @if ($detail->job_request->has_acwia_institution_highed == 1)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    (i)
                    Institution of higher education<br>
                    @if ($detail->job_request->has_acwia_related_nonprofit == 1)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    (ii) Affiliated or related nonprofit entity connected or associated with an institution of higher
                    education<br>
                    @if ($detail->job_request->has_acwia_research_nonprofit == 1)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    (iii) Nonprofit research organization or Governmental research organization<br>
                </td>

            </tr>

            <tr>
                <td colspan="2">b. If the employer has previously been determined not covered under ACWIA, does the
                    employer
                    have any reason to believe that its status has changed?</td>
                <td colspan="2">
                    @if ($detail->job_request->has_reason_not_acwia == 1)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    Yes &nbsp;&nbsp;
                    @if ($detail->job_request->has_reason_not_acwia == 0)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    No &nbsp;&nbsp;
                    @if ($detail->job_request->has_acwia == 1)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    N/A
                </td>
            </tr>

            <tr>
                <td colspan="2">2. Is the position covered by a Professional Sports League Rules or Regulations?</td>
                <td colspan="2">
                    @if ($detail->job_request->has_sports_league_regs == 1)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    Yes &nbsp;&nbsp;
                    @if ($detail->job_request->has_sports_league_regs == 0)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    No &nbsp;&nbsp;

                </td>
            </tr>

            <tr>
                <td colspan="2">3. Is the position covered by a Collective Bargaining Agreement (CBA)?</td>
                <td colspan="2">
                    @if ($detail->it_has_cba == 1)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    Yes &nbsp;&nbsp;
                    @if ($detail->it_has_cba == 0)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    No &nbsp;&nbsp;
                    <input type="checkbox">
                    N/A
                </td>
            </tr>

            <tr>
                <td colspan="4"><strong>For non-OES requests, select and fully complete only one of the
                        following:</strong>
                    (Davis Bacon Act (DBA) & Service Contract Act (SCA) are not
                    prevailing wage sources for H-2B)
                </td>
            </tr>

            <tr>
                <td colspan="4">4. Source Type: &nbsp;&nbsp;
                    @if ($detail->job_request->source_type_dba == 1)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    DBA &nbsp;&nbsp;

                    @if ($detail->job_request->source_type_sca == 1)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    SCA &nbsp;&nbsp;
                    @if ($detail->job_request->source_type_survey == 1)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
                    Survey
                </td>
            </tr>

            <tr>
                <td colspan="4">a. Complete the following if consideration of a survey is requested above. § (If this
                    is a request to use a survey in the H-2B program,
                    Form ETA-9165 must also be completed.)
                </td>
            </tr>

            <tr>
                <td colspan="4">(i) Survey name or title: <strong>{{ $detail->job_request->survey_name_title }}
                    </strong></td>
            </tr>


            <tr>
                <td colspan="4">(ii) Survey date of publication or, if not published, date of submission to DOL:
                    <strong>{{ date('m/d/Y', strtotime($detail->job_request->survey_date_of_submission)) }}</strong>
                </td>
            </tr>
        </tbody>
    </table>


    <br><br>
    <p><strong>F. Job Offer Information</strong><br>
        a. Job Description
        <br>
    <table border="1" style="width: 100%">
        <tr>
            <td colspan="4">1. Job Title * <strong>{{ $detail->title->title }}</strong></td>
        </tr>

        <tr>
            <td colspan="4">2. Job Duties: Description of the specific services or labor to be performed. * (All job
                duties must be disclosed. A description of the job duties
                MUST begin in this space. One separate addendum will be accepted to fully compete the response.)
                <strong>{{ $detail->desc_job_duties }}</strong>
            </td>
        </tr>

        <tr>
            <td colspan="2">3. Does this position supervise the work of other employees? *</td>
            <td colspan="2">
                @if ($detail->has_to_supervise_others == 1)
                    <input type="checkbox" checked>
                @else
                    <input type="checkbox">
                @endif
                Yes &nbsp;&nbsp;
                @if ($detail->has_to_supervise_others == 0)
                    <input type="checkbox" checked>
                @else
                    <input type="checkbox">
                @endif
                No
            </td>
        </tr>

        <tr>
            <td colspan="4">a. If “Yes,” please indicate the SOC code(s) and SOC title(s) of the occupation(s) of the
                employees to be supervised: </td>
        </tr>


    </table>

    <br><br>
    <p><strong>b. Minimum Job Requirements</strong><br>
        <br>
    <table border="1" style="width: 100%">
        <tr>
            <td colspan="4">1. Education: Minimum U.S. diploma/degree required *
                <strong>{{ $detail->degree_code->name }}</strong>
            </td>
        </tr>
        <tr>
            <td colspan="2">a. If “Other degree” in question 1, specify the U.S.
                diploma/degree required
                <strong>{{ $detail->other_us_degree }}</strong>
            </td>
            <td colspan="2">b. Indicate the major(s) and/or field(s) of study required
                (May list more than one related major and more than one field)
                <strong>{{ $detail->majors_or_field_of_study }}</strong>
            </td>
        </tr>

        <tr>
            <td colspan="3">2. Does the employer require a second U.S. diploma/degree? </td>
            <td>
                @if ($detail->has_second_us_degree == 1)
                    <input type="checkbox" checked>
                @else
                    <input type="checkbox">
                @endif
                Yes &nbsp;&nbsp;
                @if ($detail->has_second_us_degree == 0)
                    <input type="checkbox" checked>
                @else
                    <input type="checkbox">
                @endif
                No
            </td>
        </tr>

        <tr>
            <td colspan="4">a. If “Yes” in question 2, indicate the second U.S. diploma/degree and the major(s)
                and/or field(s) of study required
                <strong>{{ $detail->majors_or_field_of_study_2 }}</strong>
            </td>
        </tr>



        <tr>
            <td colspan="3">3. Is training for the job opportunity required? </td>
            <td>
                @if ($detail->is_training_required == 1)
                    <input type="checkbox" checked>
                @else
                    <input type="checkbox">
                @endif
                Yes &nbsp;&nbsp;
                @if ($detail->is_training_required == 0)
                    <input type="checkbox" checked>
                @else
                    <input type="checkbox">
                @endif
                No
            </td>
        </tr>

        <tr>
            <td colspan="2">a. If “Yes” in question 3, specify the number of months of
                training required <strong>{{ $detail->months_of_experience_required }}</strong>
            </td>
            <td colspan="2">b. Indicate the field(s)/name(s) of training required §
                (May list more than one related field and more than one type)
                <strong>{{ $detail->field_training_required }}</strong>
            </td>
        </tr>

        <tr>
            <td colspan="3">4. Is employment experience required? </td>
            <td>
                @if ($detail->is_employement_experience_required == 1)
                    <input type="checkbox" checked>
                @else
                    <input type="checkbox">
                @endif
                Yes &nbsp;&nbsp;
                @if ($detail->is_employement_experience_required == 0)
                    <input type="checkbox" checked>
                @else
                    <input type="checkbox">
                @endif
                No
            </td>
        </tr>
        <tr>
            <td colspan="2">a. If “Yes” in question 4, specify the number of months of
                experience required</td>
            <td colspan="2">
                b. Indicate the occupation required §
            </td>
        </tr>
        <tr>
            <td colspan="3">5. Special Skills or Other Requirements: Does the employer require any specific or other
                requirements?</td>
            <td>
                @if ($detail->is_employement_experience_required == 1)
                    <input type="checkbox" checked>
                @else
                    <input type="checkbox">
                @endif
                Yes &nbsp;&nbsp;
                @if ($detail->is_employement_experience_required == 0)
                    <input type="checkbox" checked>
                @else
                    <input type="checkbox">
                @endif
                No
            </td>

        </tr>

        <tr>
            <td colspan="4">a. If “Yes,” check all that apply and specify the requirement(s):</td>
        </tr>
        <tr>
            <td colspan="4"><input type="checkbox"> (i) License/Certification:</td>
        </tr>
        <tr>
            <td colspan="4"><input type="checkbox"> (ii) Foreign Language:</td>
        </tr>
        <tr>
            <td colspan="4"><input type="checkbox"> (iii) Residency/Fellowship:</td>
        </tr>
        <tr>
            <td colspan="4"><input type="checkbox"> (iv) Other Special Skills or Requirements:</td>
        </tr>

    </table>
@endforeach
