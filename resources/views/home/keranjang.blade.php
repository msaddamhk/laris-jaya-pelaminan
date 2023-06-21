@extends('Layout.home.main2')

@section('content')
    <section id="about" class="py-5">
        <div class="container py-3">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Produk</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td class="d-flex">
                                <img src="gambar/hiro/hiro1.jpg" width="60px" height="60px" alt=""
                                    data-aos="fade-in" data-aos-delay="150" style="object-fit: cover" loading="lazy" />
                                <p class="my-auto ms-3">Pelaminan</p>
                            </td>
                            <td>1 Pcs</td>
                            <td>Rp 100.000</td>
                            <td>
                                <button class="btn btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="container">
            <h4>Data</h4>
            <hr />
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">No Hp</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">No HP</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <hr />
            <h5 class="fw-bold">Total : Rp 100.000</h5>
            <button class="btn btn-success btn-sm" style="font-size: 12px">
                <i class="bi bi-wallet"></i> Bayar Sekarang
            </button>
        </div>
    </section>
@endsection
