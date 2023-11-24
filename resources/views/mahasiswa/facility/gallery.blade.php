@extends('mahasiswa.layouts.base')

@section('title', 'Gallery')

@section('content')
    <!-- Gallery -->
    <style>
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content,
        #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <div class="p-3 row">
        <div class="mb-4 col-lg-4 col-md-12 mb-lg-0">
            @foreach ($photos1 as $index => $photo)
                <a href="#" class="gallery-link" data-index="{{ $index }}" data-set="1">
                    <img src="{{ asset('storage/facility/' . $photo->image) }}" alt="photo"
                        class="mb-4 rounded w-100 shadow-1-strong">
                </a>
            @endforeach
        </div>

        <div class="mb-4 col-lg-4 mb-lg-0">
            @foreach ($photos2 as $index => $photo)
                <a href="#" class="gallery-link" data-index="{{ $index }}" data-set="2">
                    <img src="{{ asset('storage/facility/' . $photo->image) }}" alt="photo"
                        class="mb-4 rounded w-100 shadow-1-strong">
                </a>
            @endforeach
        </div>

        <div class="mb-4 col-lg-4 mb-lg-0">
            @foreach ($photos3 as $index => $photo)
                <a href="#" class="gallery-link" data-index="{{ $index }}" data-set="3">
                    <img src="{{ asset('storage/facility/' . $photo->image) }}" alt="photo"
                        class="mb-4 rounded w-100 shadow-1-strong">
                </a>
            @endforeach
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="mt-5 close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>
    <!-- Gallery -->
@endsection

@section('js')
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Set variables for modal content and caption
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");

        // Get all elements with class "gallery-link"
        var galleryLinks = document.querySelectorAll('.gallery-link');

        // Attach click event to each gallery link
        galleryLinks.forEach(function(link) {
            link.onclick = function(event) {
                event.preventDefault();

                var clickedImg = this.querySelector('img'); // Get the clicked image element
                var index = this.getAttribute('data-index');
                var set = this.getAttribute('data-set');

                modal.style.display = "block";
                modalImg.src = clickedImg.src; // Use the src of the clicked image
                captionText.innerHTML = clickedImg.alt;
            }
        });


        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection
