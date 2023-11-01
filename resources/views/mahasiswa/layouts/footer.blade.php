<footer class="footer">
    <div class="row p-5">
        <div class="col-sm-3">
            <img src="{{ asset('assets/images/LOGO-UNDIP-1.png') }}"class="img-fluid" alt="Responsive image"
                style="margin-top: 10%">
        </div>
        <div class="col-sm-3">
            <h4> NEWS </h4>
            {{-- @foreach ($posts as $post)
            <p><a href="{{ url('/postingan/detail/'.$post->id_posting) }}">{{ $post->judul }}</a></p>
            <br>
            @endforeach     --}}
        </div>
        <div class="col-sm-3">
            <h4> KONTAK </h4>
            <p><strong>Alamat: </strong> Prof. H. Soedarto, SH Tembalang, Semarang, Indonesia 1269</p>
            <p><strong>Email: </strong> @undip.ac.id</p>
            <p><strong>No. Telepon: </strong> (024) 76480609 </p>
            <h4> Layanan </h4>
            <div class="row">
                <div class="col-sm-6">
                    <p><a href="https://digilib.undip.ac.id/">Digilib UNDIP</a></p>
                    <p><a href="https://lib.undip.ac.id/">Perpus UNDIP</a></p>
                    <p><a href="http://perpus.ft.undip.ac.id/">Perpus FT UNDIP</a></p>
                    <p><a href="https://tekkom.ft.undip.ac.id/">Tekkom UNDIP</a></p>
                </div>
                <div class="col-sm-6">
                    <p><a href="http://capstone-ta.ce.undip.ac.id/">Tekkom Capstone</a></p>
                    <p><a href="https://ejournal.undip.ac.id/?t=MTY2ODQ2MDAyMw==">E-Journal</a></p>
                    <p><a href="https://www.perpusnas.go.id/">Perpusnas</a></p>
                    <p><a href="https://digilib.undip.ac.id/">Helpdesk</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <h4>LOKASI KAMPUS</h4>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.642526581279!2d110.43760927486224!3d-7.051224192951058!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708d3d9c55e8cb%3A0x67f23b9ef2c77c35!2sDepartement%20of%20Computer%20Engineering%2C%20Universitas%20Diponegoro!5e0!3m2!1sen!2sid!4v1684191073311!5m2!1sen!2sid"
                width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

</footer>
