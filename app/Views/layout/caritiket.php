
<div class="container mt-4">
    <div class="card-container-cari">
        <div class="card-cari">
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="departure">Lokasi Keberangkatan</label>
                                <input type="text" class="form-control" id="departure" placeholder="Masukkan lokasi keberangkatan">
                            </div>
                            <div class="mb-3">
                                <label for="destination">Tujuan</label>
                                <input type="text" class="form-control" id="destination" placeholder="Masukkan tujuan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date">Tanggal Keberangkatan</label>
                                <input type="date" class="form-control" id="date">
                            </div>
                        
                            <div class="mb-3">
                                <label for="numTickets">Jumlah Tiket</label>
                                <input type="number" class="form-control" id="numTickets" min="1" max="10" placeholder="Masukkan jumlah tiket">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
