<!DOCTYPE html>
<html>
<head>
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
    <div>
        <h1 style="text-align: center;">Book Label</h1>
        <p><strong>Book Name:</strong> {{ $book->book_name }}</p>
        <p><strong>Library Code:</strong> {{ $book->lib_book_code }}</p>
        <p><strong>Author:</strong> {{ $book->author }}</p>
        <p><strong>Specialization:</strong> {{ $book->specialization }}</p>
        <!-- Add more data placeholders as needed -->

        <p style="margin-top: 20px;">------------------------------------</p>
        <p>{{ $book->lib_book_code }}</p>
        <p>{{ substr($book->author, 3) }}</p>
        <p>{{ substr($book->book_name, 1) }}</p>
    </div>
</body>
</html>
