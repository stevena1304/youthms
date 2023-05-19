@extends('layout-landing2.body')
@section('content')
    <!-- hero / illustration -->
    <section class="main-banner mt-5" id="main-banner">
        <div id="hero-services">
            <div class="container">
                <div class="row align-items-center" data-aos="fade-up" data-aos-duration="2000">
                    <div class="col-lg-8">
                        <img class="img-fluid" src="{{ asset('illustration/services.png') }}" alt="">
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <p>YouthMS memiliki 3 jenis layanan
                            yang bergerak dibidang Aplikasi,
                            Desain, dan Editing</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="layanan" id="layanan">
        <div class="konten">
            <h1 data-aos="fade-up" data-aos-duration="1000">Layanan Yang Kami Tawarkan</h1>
            <div class="row" data-aos="fade-up" data-aos-duration="1000">
                <div class="informasi col">
                    <div>
                        <h2>Desain</h2>
                        <p>Untuk para pedagang online maupun offline, desain merupakan salah satu hal penting untuk menarik
                            pembeli. Di youthMS kami memiliki beberapa layanan yang dapat digunakan untuk membantu
                            meningkatkan
                            upaya penjualan</p>

                        <h2 style="margin-top: -1px">Marketing</h2>
                        <a href="/services/detail" class="href"><h3>Social Media Content Managemen</h3></a>
                        <a href="" class="href"><h3>Social Media Post</h3></a>

                        <h2 style="margin-top: 30px">Desain Grafis</h2>
                        <a href="" class="href"><h3>Banner/X-Banner/Poster</h3></a>
                        <a href="" class="href"><h3>Brosur/Pamflet/Leaflet</h3></a>
                        <a href="" class="href"><h3>Packaging+Mock Up</h3></a>
                        <a href="" class="href"><h3>Poster Penelitian</h3></a>
                        <a href="" class="href"><h3>Kartu Nama</h3></a>
                        <a href="" class="href"><h3>Cover Buku</h3></a>
                        <a href="" class="href"><h3>Logo</h3></a>
                    </div>
                </div>
                <div class="col">
                    <img src="{{asset('illustration/service1.png')}}" alt="">
                </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-duration="2000">
                <div class="col">
                    <img src="{{asset('illustration/service1.png')}}" alt="">
                </div>
                <div class="web col">
                    <div>
                        <h2>Aplikasi</h2>
                        <p>Aplikasi merupakan salah satu tempat untuk memasrkan produk/jasa anda secara online. <br> YouthMS memiliki 2 layanan dalam bidang aplikasi</p>

                        <a href="" class="href"><h3>Website Sekolah/Yayasan/dan lain-lain</h3></a>
                        <a href="" class="href"><h3>Aplikasi Kasir Berbasis Web</h3></a>
                        <a href="" class="href"><h3>Website Company Profile</h3></a>
                        <a href="" class="href"><h3>Website E-commerce</h3></a>
                        <a href="" class="href"><h3>Website UMKM</h3></a>
                    </div>
                </div>
                
            </div>
            <div class="row" data-aos="fade-up" data-aos-duration="2000">
                <div class="editing col">
                    <div>
                        <h2>Editing</h2>
                        <p>Penyunting buku dalam arti sempit adalah orang yang bertugas melakukan penyuntingan naskah. Penyuntingan naskah adalah proses, cara, atau perbuatan menyunting naskahPenyunting buku dalam arti sempit adalah orang yang bertugas melakukan penyuntingan naskah. Penyuntingan naskah adalah proses, cara, atau perbuatan menyunting naskah</p>

                        <a href="" class="href"><h3>Memindahkan Dari Skripsi
                            Ke Jurnal/Makalah Ke Artikel</h3></a>
                        <a href="" class="href"><h3>Transkrip Data Audio To Word</h3></a>
                        <a href="" class="href"><h3>PowerPoint/Presentasi</h3></a>
                        <a href="" class="href"><h3>Editing Buku+Cover</h3></a>
                        <a href="" class="href"><h3>Editing Full Format</h3></a>
                        <a href="" class="href"><h3>Cek Plagiarisme</h3></a>
                        <a href="" class="href"><h3>Surat Menyurat</h3></a>
                        <a href="" class="href"><h3>Pengetikan</h3></a>
                        <a href="" class="href"><h3>Parafrase</h3></a>
                    </div>
                </div>
                <div class="col">
                    <img src="{{asset('illustration/service1.png')}}" alt="">
                </div>
            </div>
    </section>
            <div class="row">
                <div class="col"></div>
                <div class="col"></div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col"></div>
            </div>

        </div>
@endsection
