<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Label Buku</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .label {
            width: 450px;
            height: 100px;
            border: 1px solid #000;
            display: table;
            margin: 30px;
            text-align: center;
            padding: 0;
            font-size: 14px;
        }

        .cell {
            display: table-cell;
            padding: 0;
            vertical-align: middle;
        }

        .left {
            width: 35%;
            border-right: 1px solid #000
                /* Add a semicolon here */
                /* Set the left section width */
        }


        .right {
            width: 65%;
            /* Set the right section width */
        }

        .border-title {
            border-bottom: 1px solid #000;
        }

        .d-left {
            width: 65%;
        }

        .d-right {
            width: 35%;
        }

        p {
            line-height: 6px;

        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
     <div class="label">
            <div class="cell left">
                <img src="{{ public_path('storage/qr-images/' . $book->qr_code) }}" alt="QR Code" width="120px">
            </div>
            <div class="cell right">
                <div class="border-title">
                    <p>Ruang Baca Departemen Teknik Komputer</p>
                    <p>Universitas Diponegoro</p>
                </div>
                <p>{{ $book->lib_book_code }}</p>
                <p>{{ strtoupper(substr($book->author, 0, 3)) }}</p>
                <p>{{ strtolower(substr($book->book_name, 0, 1)) }}</p>
            </div>
        </div>
</body>
</html>
