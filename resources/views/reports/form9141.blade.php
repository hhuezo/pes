<table border="1" style="width: 100%">
    <tbody>
        <tr>
            <td>1. Contact’s Last (family) Name * <strong>{{ $job_request->employer->primary_contact_last_name }}</strong></td>
            <td colspan="2">2. First (given) Name * <strong>{{ $job_request->employer->primary_contact_name }}</strong></td>
            <td>3. Middle Name(s) (if applicable) </td>
        </tr>
        <tr>
            <td colspan="4">4. Contact’s job title * <strong>{{ $job_request->employer->primary_contact_job_title }}</td>
        </tr>
        <tr>
            <td colspan="4">5. Address 1 * </td>
        </tr>
        <tr>
            <td colspan="4">6. Address 2 </td>
        </tr>
        <tr>
            <td colspan="2"> 7. City *</td>
            <td>8. State *</td>
            <td>9. Postal Code *</td>
        </tr>
        <tr>
            <td colspan="2">10. Country *</td>
            <td colspan="2">11. Province (if applicable)</td>

        </tr>
        <tr>
            <td>12. Telephone number *</td>
            <td>13. Extension (if applicable) </td>
            <td colspan="2">14. Business E-Mail Address </td>
        </tr>
    </tbody>
</table>
<br><br>
<table border="1" style="width: 100%">
    <tbody>
        <tr>
            <td colspan="4">1. Legal Business Name * <strong>{{ $job_request->employer->legal_business_name }}</strong></td>
        </tr>
        <tr>
            <td colspan="4">2. Trade Name/Doing Business As (DBA), if applicable <strong>{{ $job_request->employer->trade_name }}</strong></td>
        </tr>
        <tr>
            <td colspan="4">3. Address 1 <strong>{{ $job_request->employer->principal_street_address }}</strong></td>
        </tr>
        <tr>
            <td colspan="4">4. Address 2 <strong></strong></td>
        </tr>
        <tr>
            <td colspan="2">5. City * <strong>{{ $job_request->employer->principal_city->name }}</strong></td>
            <td>6. State * <strong>{{ $job_request->employer->principal_state->cs_state }}</strong></td>
            <td>7. Postal code * <strong>{{ $job_request->employer->principal_zip_code }}</strong></td>
        </tr>
        <tr>
            <td colspan="2">8. Country * <strong>USA</strong></td>
            <td colspan="2">9. Province (if applicable)  <strong></strong></td>
        </tr>
    </tr>
    <tr>
        <td colspan="2">10. Telephone number * <strong>{{ $job_request->employer->primary_business_phone }}</strong></td>
        <td colspan="2">11. Extension (if applicable)  <strong></strong></td>
    </tr>
    <tr>
        <td colspan="2">12. Federal Employer Identification Number (FEIN from IRS) *<strong>{{ $job_request->employer->primary_business_phone }}</strong></td>
        <td colspan="2">13. NAICS code *  <strong>{{ $job_request->employer->naicsCode->cn_code }}</strong></td>
    </tr>
    </tbody>
</table>
