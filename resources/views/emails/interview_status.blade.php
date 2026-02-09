<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Interview Status Update</title>
</head>

<body style="font-family: Arial, sans-serif; background-color:#f4f6f8; margin:0; padding:0;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:20px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border:1px solid #e5e5e5;">

                    <!-- Header -->
                    <tr>
                        <td style="background:#ff6b00; color:#fff; padding:12px 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <!-- Left: Company Name -->
                                    <td align="left" style="font-size:18px; font-weight:bold; color:#fff;">
                                        {{ $companyDetails[0]->company_name ?? 'Company Name' }}
                                    </td>

                                    <!-- Right: Company Logo -->
                                    <td align="right">
                                        @if (!empty($companyDetails[0]->company_logo))
                                            <img src="cid:{{ $companyDetails[0]->company_logo }}" alt="Company Logo"
                                                style="max-height:40px; max-width:120px; display:block;">
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:25px; color:#333; font-size:15px; line-height:1.6;">
                            <p style="margin-top:0;">
                                Hello <strong>{{ $candidate->first_name }} {{ $candidate->last_name }}</strong>,
                            </p>
                            <p>
                                This is to inform you that your interview status for the position
                                <strong>{{ $candidate->job->title ?? '-' }}</strong> has been updated to
                                <strong>{{ ucfirst($schedule->status) }}</strong>.
                            </p>

                            @if ($schedule->comments)
                                <p>
                                    {{ $schedule->comments }}
                                </p>
                            @endif

                            <p style="margin-top:25px;">
                                Regards,<br>
                                <strong>HR Team</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f7f7f7; text-align:center; padding:12px; font-size:12px; color:#555;">
                            {{ $companyDetails[0]->address ?? '' }}
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
