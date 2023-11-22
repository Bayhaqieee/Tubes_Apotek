// Fungsi tutup popup
function closePopup() {
    document.getElementById('popup').style.display = 'none';
}
// Tombol Beli diklik
document.getElementById('beli_button').addEventListener('click', function () {
    // Simulasi pengambilan data obat dari database
    // const idObat = '1'; // Ganti dengan id obat yang diinginkan
    // const namaObat = 'Paracetamol';
    // const stokObat = '50'; // Ambil dari database

    // // Mengisi nilai pada form dalam popup
    // document.getElementById('idObat').value = idObat;
    // document.getElementById('namaObat').value = namaObat;
    // document.getElementById('stokObat').value = stokObat;

    // Menampilkan popup
    document.getElementById('popup').style.display = 'block';
});



// Menghitung total harga
document.getElementById('jumlahBeli').addEventListener('input', function () {
    const jumlahBeli = this.value;
    const hargaObat = 10000; // Ambil dari database
    const totalHarga = jumlahBeli * hargaObat;
    document.getElementById('totalHarga').value = totalHarga;
});

// cek jml_beli apakah lebih besar dari stok_obat atau tidak 
document.getElementById('jml_beli').addEventListener('input', function () {
    const stok_obat = parseInt(document.getElementById('stok_obat').value);
    const jml_beli = parseInt(this.value);

    if (jml_beli > stok_obat) {
        alert('Jumlah pembelian melebihi stok obat yang tersedia!');
        this.value = stok_obat; // Set nilai input kembali ke stok obat maksimal
    }
});