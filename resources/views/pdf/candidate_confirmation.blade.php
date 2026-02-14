<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 210mm;
            height: 297mm;
            @if (!empty($bgImage))
                background-image: url("{{ $bgImage }}");
            @endif
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            position: relative;
        }

        .content {
            position: absolute;
            top: 30mm;
            left: 25mm;
            right: 25mm;
            bottom: 25mm;

            overflow: hidden;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="content">
            {!! $body !!}
        </div>
    </div>
</body>

</html>
