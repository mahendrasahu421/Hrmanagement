<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Candidate Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; background-color:#f4f6f8; margin:0; padding:0;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:20px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border:1px solid #e5e5e5;">

                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #ff6b00, #ff9b00); padding: 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="left" style="font-size:22px; font-weight:bold; color:#fff;">
                                        {{ $subject }}
                                    </td>
                                    <td align="right">
                                        @if (!empty($companyDetails[0]->company_logo))
                                            <img src="cid:{{ $companyDetails[0]->company_logo }}" alt="Company Logo"
                                                style="max-height:50px; max-width:120px; display:block;">
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px 25px; color:#333; font-size:16px; line-height:1.6;">
                            {!! $template_body !!}
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f1f1f1; text-align:center; padding:15px; font-size:12px; color:#555;">
                            {{ $companyDetails[0]->address ?? '' }}
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
