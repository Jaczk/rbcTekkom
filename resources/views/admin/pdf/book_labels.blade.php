<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Label Buku</title>
    <style>
        .label {
            width: 250px;
            /* Adjust the width as needed */
            height: 155px;
            /* Adjust the height as needed */
            border: 1px solid #000;
            /* Border style */
            text-align: center;
            /* Center-align the text */
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="label" style="font-size: 14px;">
        <div class="row">
            <img src="{{ public_path('assets/images/LOGO-UNDIP-1.png') }}" alt="" class="img-responsive" width="100px">
            <p>Ruang Baca Departemen Teknik Komputer</p>
        </div>
        <p>Universitas Diponegoro</p>
        <p>{{ $book->lib_book_code }}</p>
        <p>{{ strtoupper(substr($book->author, 0, 3)) }}</p>
        <p>{{ strtolower(substr($book->book_name, 0, 1)) }}</p>
    </div>
    
</body>
</html>
