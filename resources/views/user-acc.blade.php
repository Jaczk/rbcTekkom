<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}"> --}}
    <title>Access Denied</title>
    <style>
        .restricted {
            background-color: #100;
            color: #FFFFFF;
            text-align: center;
            padding-top: 10%;
        }
        code {
            color: red;
        }
        h5 {
            color: red;
            font-weight: 100;
            text-decoration: none;
            /*underline;*/
        }
    </style>
</head>

<body class="restricted">
    <div class="restricted">
        <h1><code>Access Denied</code></h1>
        <hr style="margin:auto;width:30%; border-top: 3px solid #FF0404">
        <h4> Kamu tidak punya hak akses ke halaman ini</h4>
        <h3>🚫🚫🚫🚫</h3>
        <h5> <code> error code: 403 forbidden </code></h5>
    </div>
</body>

</html>
