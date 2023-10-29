<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Label Buku</title>
    <style>
        .label {
            width: 250px; /* Adjust the width as needed */
            height: 155px; /* Adjust the height as needed */
            border: 1px solid #000; /* Border style */
            display: inline-block; /* Display cards horizontally */
            margin: 10px; /* Adjust margin between cards */
            text-align: center; /* Center-align the text */
            padding: 10px;
        }
    </style>
</head>
<body>
    @foreach ($books as $book)
    <div class="label" style="font-size: 14px;"> <!-- Adjust the font size as needed -->
        <p>Ruang Baca Departemen Teknik Komputer</p>
        <p>Universitas Diponegoro</p>
        <p>{{ $book->lib_book_code }}</p>
        <p>{{ strtoupper(substr($book->author, 0, 3)) }}</p>
        <p>{{ strtolower(substr($book->book_name, 0, 1)) }}</p>
    </div>
    @endforeach
</body>
</html>
