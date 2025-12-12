<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Check In / Check Out</title>

    <link rel="manifest" href="/checkin/manifest.json">

    <style>
        body { font-family: Arial; padding: 20px; }
        button {
            padding: 12px 20px;
            margin: 10px 0;
            background: #000;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        #installBtn { background: green; display: none; }
    </style>
</head>
<body>

<h2>Check In / Check Out App</h2>

<button onclick="checkIn()">Check In</button>
<button onclick="checkOut()">Check Out</button>

<p id="status"></p>

<button id="installBtn">Install App</button>

<script src="/checkin/app.js"></script>

</body>
</html>
