<style>
  body {
    font-family: "Times New Roman", Times, serif;
	 font-size: 12px;
      }
.fuente {
	font-family: "Times New Roman", Times, serif;
	 font-size: 10px;
}
.fuente_header {
	font-family: "Times New Roman", Times, serif;
	 font-size: 12px;
}

@media all {
   div.saltopagina{
      display: none;
   }
}

@media print{
   div.saltopagina{
      display:block;
      page-break-before:always;
   }
}
</style>

@foreach ($request_details as $detail)
    <table width="95%" border="0" align="center">
        <tr>
            <td width="29%"><span class="fuente">OMB Approval: 1205-0508</span><br /> <span class="fuente">Expiration Date: 09/30/2022</span></td>
            <td width="53%">
                <div align="center"><span class="fuente_header">Application for Prevailing Wage Determination<br /> Form ETA-9141 <br />
                  <strong>U.S. Department of Labor </strong></span>
                </div>
            </td>
            <td width="18%"><img src="{{ asset('img/DOLLogo.png') }}" width="86" height="86" align="right" /></td>
        </tr>
        <tr>
            <td colspan="3"><strong class="fuente_header">Please read and review the filing instructions carefully before completing the
                    Form ETA-9141. A copy of the instructions can be found at
                    https://www.dol.gov/agencies/eta/foreign-labor. For all submissions, either electronic or paper, ALL
                    required fields/items containing an asterisk (*) must be completed as well as any applicable
                    fields/items where a response is conditional as indicated by the section (§) symbol. </strong></td>
        </tr>
    </table>
    <br />
    <table width="95%" border="0" cellspacing="0" align="center">
        <tr>
            <td colspan="2">
                <hr />
            </td>
        </tr>
        <tr>
            <td colspan="2"><strong class="fuente_header">A. Employment-Based Visa Information</strong></td>
        </tr>
        <tr>
            <td width="79%" class="fuente_header">1. Indicate the type of visa classification supported by this application (Write
                classification symbol): *</td>
            <td width="21%">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <hr />
            </td>
        </tr>
        <tr>
            <td colspan="2" class="fuente_header"><strong>B. Employer Point-of-Contact Information</strong><br>
              Important Note: The information contained in this section is for an employee authorized to act on behalf
              of the employer in labor certification or labor condition application matters. The information in this
              section must be different from the attorney or agent information listed in Section D, except when an
              attorney listed in Section D is an employee of the employer</td>
        </tr>
    </table>
    <p>&nbsp;</p>


    <table border="1" style="width: 95%" align="center" cellspacing="0">
        <tbody>
            <tr>
                <td><span class="fuente_header">1. Contact’s Last (family) Name *<br>
                    <strong>{{ $detail->job_request->employer->primary_contact_last_name }}</strong></span>
                </td>
                <td colspan="2" class="fuente_header">2. First (given) Name *<br>
                    <strong>{{ $detail->job_request->employer->primary_contact_name }}</strong>
                </td>
                <td><span class="fuente_header">3. Middle Name(s) (if applicable)<br>
                    <strong>{{ $detail->job_request->employer->contact_middle_name }}</strong></span>
                </td>
            </tr>

            <tr>
                <td colspan="4"><span class="fuente_header">4. Contact’s job title *<br>
                    <strong>{{ $detail->job_request->employer->primary_contact_job_title }}</strong>
                </span></td>
            </tr>
            <tr>
                <td colspan="4"><span class="fuente_header">5. Address 1 *<br>
                    <strong>{{ $detail->job_request->employer->primary_contact_job_title }}</strong>
                </span></td>
            </tr>
            <tr>
                <td colspan="4"><span class="fuente_header">6. Address 2 </span></td>
            </tr>
            <tr>
                <td colspan="2"><span class="fuente_header"> 7. City *<br>
                    @if ($contact_worksite)
                        <strong>{{ $contact_worksite->city->czc_city }}</strong>
                  @endif
              </span></td>
                <td><span class="fuente_header">8. State *<br>
                    @if ($contact_worksite)
                        <strong>{{ $contact_worksite->state->cs_state }}</strong>
                  @endif
              </span></td>
                <td><span class="fuente_header">9. Postal Code *<br>
                    @if ($contact_worksite)
                        <strong>{{ $contact_worksite->zip_code_address }}</strong>
                  @endif
              </span></td>
            </tr>
            <tr>
                <td colspan="2"><span class="fuente_header">10. Country * <br><strong>USA</strong></span></td>
                <td colspan="2"><span class="fuente_header">11. Province (if applicable)</span><br></td>

            </tr>
            <tr>
                <td><span class="fuente_header">12. Telephone number * <br> <strong>{{ $detail->job_request->employer->primary_contact_phone }}</strong>
                </span></td>
                <td><span class="fuente_header">13. Extension (if applicable) </span><br></td>
                <td colspan="2"><span class="fuente_header">14. Business E-Mail Address<br>
                    <strong>{{ $detail->job_request->employer->primary_contact_email }}</strong>
                </span></td>
            </tr>

        </tbody>
    </table>

    <br>

    <table width="95%" border="0" align="center">
        <tr>
            <td><strong class="fuente_header">C. Employer Information</strong></td>
        </tr>
    </table>

    <table border="1" style="width: 95%" align="center" cellspacing="0">
        <tbody>
            <tr>
                <td colspan="4"><span class="fuente_header">1. Legal Business Name *
                    <strong>{{ $detail->job_request->employer->legal_business_name }}</strong>
                </span></td>
            </tr>
            <tr>
                <td colspan="4"><span class="fuente_header">2. Trade Name/Doing Business As (DBA), if applicable
                    <strong>{{ $detail->job_request->employer->trade_name }}</strong>
                </span></td>
            </tr>
            <tr>
                <td colspan="4"><span class="fuente_header">3. Address 1
                    <strong>{{ $detail->job_request->employer->principal_street_address }}</strong>
                </span></td>
            </tr>
            <tr>
                <td colspan="4"><span class="fuente_header">4. Address 2 </span></td>
            </tr>
            <tr>
                <td colspan="2"><span class="fuente_header">5. City *
                    <strong>{{ $detail->job_request->employer->principal_city->name }}</strong>
                </span></td>
                <td><span class="fuente_header">6. State * <strong>{{ $detail->job_request->employer->principal_state->cs_state }}</strong></span></td>
                <td><span class="fuente_header">7. Postal code * <strong>{{ $detail->job_request->employer->principal_zip_code }}</strong></span></td>
            </tr>
            <tr>
                <td colspan="2"><span class="fuente_header">8. Country * <strong>USA</strong></span></td>
                <td colspan="2"><span class="fuente_header">9. Province (if applicable) </span></td>
            </tr>
              <span class="fuente_header">
              </tr>
              </span>

            <tr>
                <td colspan="2"><span class="fuente_header">10. Telephone number *
                    <strong>{{ $detail->job_request->employer->primary_business_phone }}</strong>
                </span></td>
                <td colspan="2"><span class="fuente_header">11. Extension (if applicable) </span></td>
            </tr>
            <tr>
                <td colspan="2"><span class="fuente_header">12. Federal Employer Identification Number (FEIN from IRS)
                    *<strong>{{ $detail->job_request->employer->primary_business_phone }}</strong></span></td>
                <td colspan="2"><span class="fuente_header">13. NAICS code *
                    <strong>{{ $detail->job_request->employer->naicsCode->cn_code }}</strong>
                </span></td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table width="95%" border="0" align="center">
        <tr>
            <td class="fuente_header"><strong>E. Wage Source Information </strong><br />
              Refer to instructions for all supporting documents required in this section. </td>
        </tr>
    </table>

    <table border="1" cellspacing="0" style="width: 95%" align="center">
        <tbody>
            <tr>
                <td colspan="2"><span class="fuente_header">1. Is the employer covered by ACWIA, as described in 20 CFR 656.40(e)(1)? * (Not
                    applicable for H-2B)</span></td>
                <td colspan="2"><span class="fuente_header">
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
                  No &nbsp;&nbsp;
                  <input type="checkbox">
                  N/A
              </span></td>
            </tr>

            <tr>
                <td colspan="4"><span class="fuente_header">
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
                </span></td>

            </tr>

            <tr>
                <td colspan="2"><span class="fuente_header">b. If the employer has previously been determined not covered under ACWIA, does the
                    employer
                    have any reason to believe that its status has changed?</span></td>
                <td colspan="2"><span class="fuente_header">
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
              </span></td>
            </tr>

            <tr>
                <td colspan="2"><span class="fuente_header">2. Is the position covered by a Professional Sports League Rules or Regulations?</span></td>
                <td colspan="2"><span class="fuente_header">
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

                </span></td>
            </tr>

            <tr>
                <td colspan="2"><span class="fuente_header">3. Is the position covered by a Collective Bargaining Agreement (CBA)?</span></td>
                <td colspan="2"><span class="fuente_header">
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
              </span></td>
            </tr>

            <tr>
                <td colspan="4"><span class="fuente_header"><strong>For non-OES requests, select and fully complete only one of the
                        following:</strong>
                  (Davis Bacon Act (DBA) & Service Contract Act (SCA) are not
                    prevailing wage sources for H-2B)
                </span></td>
            </tr>

            <tr>
                <td colspan="4"><span class="fuente_header">4. Source Type: &nbsp;&nbsp;
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
              </span></td>
            </tr>

            <tr>
                <td colspan="4"><span class="fuente_header">a. Complete the following if consideration of a survey is requested above. § (If
                    this
                    is a request to use a survey in the H-2B program,
                    Form ETA-9165 must also be completed.)
                </span></td>
            </tr>

            <tr>
                <td colspan="4"><span class="fuente_header">(i) Survey name or title: <strong>{{ $detail->job_request->survey_name_title }}
                    </strong></span></td>
            </tr>


            <tr>
                <td colspan="4"><span class="fuente_header">(ii) Survey date of publication or, if not published, date of submission to DOL:
                    <strong>{{ date('m/d/Y', strtotime($detail->job_request->survey_date_of_submission)) }}</strong>
                </span></td>
            </tr>
        </tbody>
    </table>


    <br>
    <table width="95%" border="0" align="center">
        <tr>
            <td><span class="fuente_header"><strong>F. Job Offer Information</strong><br />
              <strong>a. Job Description </strong></span>
            </td>
        </tr>
    </table>

    <table border="1" cellspacing="0" style="width: 95%" align="center">
        <tr>
            <td colspan="4"><span class="fuente_header">1. Job Title * <strong>{{ $detail->title->title }}</strong></span></td>
        </tr>

        <tr>
            <td colspan="4"><span class="fuente_header">2. Job Duties: Description of the specific services or labor to be performed. * (All job
                duties must be disclosed. A description of the job duties
                MUST begin in this space. One separate addendum will be accepted to fully compete the response.)
                <strong>{{ $detail->desc_job_duties }}</strong>
            </span></td>
        </tr>

        <tr>
            <td colspan="2"><span class="fuente_header">3. Does this position supervise the work of other employees? *</span></td>
            <td colspan="2"><span class="fuente_header">
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
          </span></td>
        </tr>

        <tr>
            <td colspan="4"><span class="fuente_header">a. If “Yes,” please indicate the SOC code(s) and SOC title(s) of the occupation(s) of
                the
                employees to be supervised: </span></td>
        </tr>


    </table>

    <br>
    <table width="95%" border="0" align="center">
        <tr>
            <td><strong class="fuente_header">b. Minimum Job Requirements</strong></td>
        </tr>
    </table>
    <table border="1" cellspacing="0" style="width: 95%" align="center">
        <tr>
            <td colspan="4"><span class="fuente_header">1. Education: Minimum U.S. diploma/degree required *
                <strong>
                    @if($detail->minimum_education_id)
                    {{  $detail->degree_code->name }}
                    @endif
                </strong>
            </span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="fuente_header">a. If “Other degree” in question 1, specify the U.S.
                diploma/degree required <strong>{{ $detail->other_us_degree }}</strong></span></td>
            <td colspan="2"><span class="fuente_header">b. Indicate the major(s) and/or field(s) of study required
                (May list more than one related major and more than one field)
                <strong>{{ $detail->majors_or_field_of_study }}</strong>
            </span></td>
        </tr>
        <tr>
            <td colspan="3"><span class="fuente_header">2. Does the employer require a second U.S. diploma/degree? </span></td>
            <td><span class="fuente_header">
              @if ($detail->has_second_us_degree == 1)
                  <input type="checkbox" checked />
              @else
                  <input type="checkbox" />
              @endif
              Yes &nbsp;&nbsp;
              @if ($detail->has_second_us_degree == 0)
                  <input type="checkbox" checked />
              @else
                  <input type="checkbox" />
              @endif
              No
          </span></td>
        </tr>
        <tr>
            <td colspan="4"><span class="fuente_header">a. If “Yes” in question 2, indicate the second U.S. diploma/degree and the major(s)
                and/or field(s) of study required <strong>{{ $detail->majors_or_field_of_study_2 }}</strong></span></td>
        </tr>
        <tr>
            <td colspan="3"><span class="fuente_header">3. Is training for the job opportunity required? </span></td>
            <td><span class="fuente_header">
              @if ($detail->is_training_required == 1)
                  <input type="checkbox" checked />
              @else
                  <input type="checkbox" />
              @endif
              Yes &nbsp;&nbsp;
              @if ($detail->is_training_required == 0)
                  <input type="checkbox" checked />
              @else
                  <input type="checkbox" />
              @endif
              No
          </span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="fuente_header">a. If “Yes” in question 3, specify the number of months of
                training required <strong>{{ $detail->months_of_training_required }}</strong></span></td>
            <td colspan="2"><span class="fuente_header">b. Indicate the field(s)/name(s) of training required §
                (May list more than one related field and more than one type)
                <strong>{{ $detail->field_training_required }}</strong>
            </span></td>
        </tr>
        <tr>
            <td colspan="3"><span class="fuente_header">4. Is employment experience required? </span></td>
            <td><span class="fuente_header">
              @if ($detail->is_employement_experience_required == 1)
                  <input type="checkbox" checked />
              @else
                  <input type="checkbox" />
              @endif
              Yes &nbsp;&nbsp;
              @if ($detail->is_employement_experience_required == 0)
                  <input type="checkbox" checked />
              @else
                  <input type="checkbox" />
              @endif
              No
          </span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="fuente_header">a. If “Yes” in question 4, specify the number of months of
                experience required <strong>{{ $detail->months_of_experience_required }}</strong></span></td>
            <td colspan="2"><span class="fuente_header"> b. Indicate the occupation required
                @if ($detail->occupation_experience_id)
                    <strong>{{ $detail->occupation_experience->title }}</strong>
              @endif
          </span></td>
        </tr>
        <tr>
            <td colspan="3"><span class="fuente_header">5. Special Skills or Other Requirements: Does the employer require any specific or other
                requirements?</span></td>
            <td><span class="fuente_header">
              @if ($detail->is_employement_experience_required == 1)
                  <input type="checkbox" checked />
              @else
                  <input type="checkbox" />
              @endif
              Yes &nbsp;&nbsp;
              @if ($detail->is_employement_experience_required == 0)
                  <input type="checkbox" checked />
              @else
                  <input type="checkbox" />
              @endif
              No
          </span></td>
        </tr>
        <tr>
            <td colspan="4"><span class="fuente_header">a. If “Yes,” check all that apply and specify the requirement(s):</span></td>
        </tr>
        @foreach ($special_skills as $obj)
            @if ($obj->is_alternate_skill == 0)
                <tr>
                    <td colspan="4"><span class="fuente_header">

                      @if ($obj->detail != '')
                          <input type="checkbox" checked />
                          {{ $obj->special_skill->name }} : <strong>{{ $obj->detail }}</strong>
                      @else
                          <input type="checkbox" />
                          {{ $obj->special_skill->name }} : <strong>{{ $obj->detail }}</strong>
                      @endif

                  </span></td>
                </tr>
            @endif
        @endforeach
    </table>
    <p>&nbsp;</p>
    <table width="95%" border="0" align="center">
        <tr>
            <td class="fuente_header"><strong>c. Alternative Job Requirements</strong><br />
              While an employer may specify alternative requirements, the substantial equivalency of the alternative
              requirements to minimum requirements will not be evaluated. (Not applicable for H-2B)</td>
        </tr>
    </table>
    <table width="95%" border="1" cellspacing="0" align="center">
        <tr>
            <td colspan="2"><span class="fuente_header">1. Are alternate sets of Education, Training, and/or Experience accepted? §</span></td>
            <td width="15%"><span class="fuente_header">
              @if ($detail->alternate_experience_accepted == 1)
                  <input type="checkbox" checked>
              @else
                  <input type="checkbox">
              @endif Yes

              @if ($detail->alternate_experience_accepted == 0)
                  <input type="checkbox" checked>
              @else
                  <input type="checkbox">
              @endif
              No
          </span></td>
        </tr>
        <tr>
            <td colspan="3"><span class="fuente_header"><strong>If c.1 is &ldquo;Yes,&rdquo; c.2, c.3, and c. 4 must be completed. </strong>
            </span></td>
        </tr>
        <tr>
            <td colspan="3"><span class="fuente_header">2. Specify the alternate level of education: U.S. diploma/degree accepted §<br />

              @foreach ($degree_codes as $obj)
                  @if ($obj->id == $detail->alternate_education_level_id)
                      <input type="checkbox" checked> {{ $obj->name }}
                    @else
                      <input type="checkbox"> {{ $obj->name }}
                    @endif
                @endforeach

            </span></td>
        </tr>
        <tr>
            <td width="53%"><span class="fuente_header">a. If &ldquo;Other degree&rdquo; in question 2, specify the U.S. diploma/degree accepted
                § <strong>{{ $detail->if_other_specify_degree }}</strong></span></td>
            <td colspan="2"><span class="fuente_header">b. Indicate the major(s) and/or field(s) of study accepted § (May list more than one
                related major and more than one field) <strong>{{ $detail->alternate_major }}</strong></span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="fuente_header">3. Is alternate training for the job opportunity accepted? §</span></td>
            <td><span class="fuente_header">
              @if ($detail->alternate_training_accepted == 1)
                  <input type="checkbox" checked>
              @else
                  <input type="checkbox">
              @endif Yes

              @if ($detail->alternate_training_accepted == 0)
                  <input type="checkbox" checked>
              @else
                  <input type="checkbox">
              @endif
              No
          </span></td>
        </tr>
        <tr>
            <td><span class="fuente_header">a. If &ldquo;Yes&rdquo; in question 3, specify the number of <u> months</u> of alternate training
                accepted § <strong>{{ $detail->alternate_training_number_months }}</strong></span></td>
            <td colspan="2"><span class="fuente_header">b. Indicate the field(s)/name(s) of training accepted § (May list more than one related
                field and more than one type) <strong>{{ $detail->alternate_field_of_training }}</strong></span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="fuente_header">4. Is alternate employment experience accepted? §</span></td>
            <td><span class="fuente_header">
              @if ($detail->alternate_employment_exp_required == 1)
                  <input type="checkbox" checked>
              @else
                  <input type="checkbox">
              @endif Yes

              @if ($detail->alternate_employment_exp_required == 0)
                  <input type="checkbox" checked>
              @else
                  <input type="checkbox">
              @endif
              No
          </span></td>
        </tr>
        <tr>
            <td colspan="3"><span class="fuente_header">a. If &ldquo;Yes&rdquo; in question 4, specify the number of months of alternate
                experience accepted § <strong>{{ $detail->altername_months_number_exp }}</strong></span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="fuente_header">5. Special Skills or Other Requirements: Does the employer require any specific or other
                requirements? *</span></td>
            <td><span class="fuente_header">
              @if ($detail->alternate_especial_skills_accepted == 1)
                  <input type="checkbox" checked>
              @else
                  <input type="checkbox">
              @endif Yes

              @if ($detail->alternate_especial_skills_accepted == 0)
                  <input type="checkbox" checked>
              @else
                  <input type="checkbox">
              @endif
              No
          </span></td>
        </tr>
        <tr>
            <td colspan="3"><span class="fuente_header">a. If &ldquo;Yes,&rdquo; check all that apply and specify the requirement(s) §
            </span></td>
        </tr>
        @foreach ($special_skills as $obj)
            @if ($obj->is_alternate_skill == 1)
                <tr>
                    <td colspan="4"><span class="fuente_header">

                      @if ($obj->detail != '')
                          <input type="checkbox" checked />
                          {{ $obj->special_skill->name }} : <strong>{{ $obj->detail }}</strong>
                      @else
                          <input type="checkbox" />
                          {{ $obj->special_skill->name }} : <strong>{{ $obj->detail }}</strong>
                      @endif

                  </span></td>
                </tr>
            @endif
        @endforeach
    </table>
    <table width="95%" border="0" align="center">
        <tr>
            <td><strong class="fuente_header">d. Other Information</strong></td>
        </tr>
    </table>
    <table width="95%" border="1" cellspacing="0" align="center">
        <tr>
            <td><span class="fuente_header">1. Suggested SOC (O*NET/OES) code * <strong>{{ $detail->title->onetsoc_code }}</strong></span></td>
            <td><span class="fuente_header">a. Suggested SOC (O*NET/OES) occupation title * <strong>{{ $detail->title->title }}</strong></span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="fuente_header">2. Job title of the official the employee will report to for this job opportunity (if
                applicable) § <strong>{{ $detail->official_job_title }}</strong></span></td>
        </tr>
        <tr>
            <td><span class="fuente_header">3. Will travel be required in order to perform the job duties? *
                @if ($detail->is_travel_required == 1)
                  <input type="checkbox" checked>
              @else
                  <input type="checkbox">
              @endif Yes

              @if ($detail->is_travel_required == 0)
                  <input type="checkbox" checked>
              @else
                  <input type="checkbox">
              @endif
              No
          </span></td>
            <td><span class="fuente_header">a. If &ldquo;Yes,&rdquo; provide geographic location and frequency of the travel. §
                <strong>{{ $detail->geographic_location_frecuency }}</strong></span></td>
        </tr>
    </table>
    <table width="95%" border="0" align="center">
        <tr>
            <td><strong class="fuente_header">e. Place of Employment Information</strong></td>
        </tr>
    </table>
    <table width="95%" border="1" cellspacing="0" align="center">
        <tr>
            <td colspan="5"><span class="fuente_header">1. Worksite address 1 *</span></td>
        </tr>
        <tr>
            <td colspan="5"><span class="fuente_header">2. Address 2
                @if ($detail->employer_worksite_id)
                    <strong>{{ $detail->employer_worksite->street_address }}</strong>
              @endif
          </span></td>
        </tr>
        <tr>
            <td width="27%"><span class="fuente_header">3. City * @if ($detail->employer_worksite_id)
                    <strong>{{ $detail->employer_worksite->city->czc_city }}</strong>
              @endif
          </span></td>
            <td width="30%"><span class="fuente_header">4. State * @if ($detail->employer_worksite_id)
                    <strong>{{ $detail->employer_worksite->state->cs_state }}</strong>
              @endif
          </span></td>
            <td width="29%"><span class="fuente_header">5. County * @if ($detail->employer_worksite_id)
                    <strong>{{ $detail->employer_worksite->county->czc_county }}</strong>
              @endif
          </span></td>
            <td width="5%" colspan="2"><span class="fuente_header">6. Postal Code * @if ($detail->employer_worksite_id)
                    <strong>{{ $detail->employer_worksite->zip_code_address }}</strong>
              @endif
          </span></td>
        </tr>
        <tr>
            <td colspan="4"><span class="fuente_header">7. Will work be performed in any Bureau of Labor Statistics Area (Metropolitan or
                Non-Metropolitan Statistical Areas) other than the Bureau of Labor Statistics Area of the address listed
                above, or, in the case of Bureau of Labor Statistics areas with multiple county-level prevailing wage
                rates, in a county other than the county of the address listed above? * (If &ldquo;Yes,&rdquo; a
                completed Appendix A is required)</span></td>
            <td width="9%"><span class="fuente_header">
              @if ($detail->is_located_multiple_pwd_msa == 1)
                  <input type="checkbox" checked>
              @else
                  <input type="checkbox">
              @endif Yes

              @if ($detail->is_located_multiple_pwd_msa == 0)
                  <input type="checkbox" checked>
              @else
                  <input type="checkbox">
              @endif
              No
          </span></td>
        </tr>
    </table>
    <p>
        <div class="saltopagina"></div>
@endforeach
</p>
<script type="text/javascript">
    window.onload = function () {
        window.print();
        //window.close();
    }
</script>
