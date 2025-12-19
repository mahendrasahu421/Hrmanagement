<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
</head>

<body style="margin:0; padding:0; background:#f5f5f5; font-family:Arial, sans-serif;">

    <div style="max-width:600px; margin:auto; border:1px solid #ddd; background:#fff;">

        <!-- Header -->
        <div style="background:#f26522; color:#fff; padding:15px; display:flex; justify-content:space-between; align-items:center;">

            <div>
                <h3 style="margin:0; font-size:18px; color:#fff;">
                    {{ $subject }}
                </h3>
            </div>

            <div>
               @if(!empty($companyDetails) && !empty($companyDetails->company_logo))
    <img src="{{ asset('uploads/company/'.$companyDetails->company_logo) }}" height="60">
@endif

            </div>

        </div>

        <!-- Body -->
        <div style="padding:20px; color:#333; line-height:1.6; font-size:14px;">
            {!! $template_body !!}
        </div>

        <!-- Footer -->
        <div style="background:#f1f1f1; padding:15px; font-size:12px; text-align:center; color:#555;">
            {{ $companyDetails[0]->address ?? '' }}
        </div>

    </div>

</body>
</html>
