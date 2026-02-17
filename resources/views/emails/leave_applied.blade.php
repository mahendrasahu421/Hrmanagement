<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $template_key ?? 'Leave Request' }}</title>
</head>

<body style="margin:0; padding:0; background:#f5f5f5; font-family:Arial, sans-serif;">

    <div style="max-width:600px; margin:auto; border:1px solid #ddd; background:#fff;">

        <!-- Header -->
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f26522; color:#fff;">
            <tr>
                <!-- LEFT : Subject / Name -->
                <td align="left" valign="middle" style="padding:15px; font-size:18px; font-weight:bold; color:#fff;">
                    {{ $subject }}
                </td>

                <!-- RIGHT : Logo -->
                <td align="right" valign="middle" style="padding:15px;">
                    @if (!empty($companyDetails[0]->company_logo))
                        <img src="cid:{{ $companyDetails[0]->company_logo }}" alt="Logo"
                            style="max-height:45px; max-width:120px; display:block;">
                    @endif
                </td>
            </tr>
        </table>


        <!-- Body -->
        <div style="padding:20px; color:#333; line-height:1.6; font-size:14px;">
            {!! $template_body !!}
        </div>


        <!-- Footer -->
        <div style="background:#f1f1f1; padding:15px; font-size:12px; text-align:center; color:#555;">
            © {{ date('Y') }} {{ $companyDetails[0]->company_name ?? 'Our Company' }}
            | Powered by Neural Info Solutions Private Limited
        </div>

    </div>

</body>

</html>
