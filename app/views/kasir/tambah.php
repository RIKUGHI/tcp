      <div class="modal-body">
        <form action="<?= BASEURL; ?>/kasir/keranjang" method="post">
          <input style="cursor:not-allowed;" class="forid" name="id_barang" readonly value="<?= $data['dtbrng']['id_barang']; ?>">
          <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input style="cursor:not-allowed;" type="text" class="form-control" name="nama_barang" readonly value="<?= $data['dtbrng']['nama_barang']; ?>">
          </div>
          <div class="form-group">
            <label for="kode">kode</label>
            <input style="cursor:not-allowed;text-transform:uppercase;" type="text" class="form-control" name="kode" readonly value="<?= $data['dtbrng']['kode']; ?>">
          </div>
          <div class="form-group">
            <label for="kategori">Kategori</label>
            <input style="cursor:not-allowed;text-transform:uppercase;" type="text" class="form-control" name="kategori" readonly value="<?= $data['dtbrng']['kategori']; ?>">
          </div>
          <div class="form-group">
            <label for="satuan">Satuan</label>
            <select class="form-control" id="harga" name="harga">
              <option value="<?= $data['dtbrng']['harga_eceran']; ?>">Harga Eceran -- Rp <?= number_format($data['dtbrng']['harga_eceran'],0,',','.'); ?></option>
              <option value="<?= $data['dtbrng']['harga_grosir']; ?>">Harga Grosir -- Rp <?= number_format($data['dtbrng']['harga_grosir'],0,',','.'); ?></option>
            </select>
          </div>
          <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" class="form-control" name="jumlah" required>
          </div>
      </div>
      <div class="modal-footer">
        <a href="<?= BASEURL; ?>/kasir">
          <button type="button" class="btn btn-close" >Close</button>
        </a>
        <button type="submit" class="btn btn-add">Tambah Ke Keranjang</button>
        </form>
      </div>

