-- Membuat database baru
CREATE DATABASE db_toko;

-- Menggunakan database tersebut
USE db_toko;

-- Tabel Barang
CREATE TABLE barang (
  barang_id INT AUTO_INCREMENT PRIMARY KEY,
  nama_barang VARCHAR(100) NOT NULL,
  harga INT NOT NULL
);

-- Tabel Transaksi
CREATE TABLE transaksi (
  transaksi_id INT AUTO_INCREMENT PRIMARY KEY,
  tanggal DATETIME NOT NULL,
  total INT DEFAULT 0
);

-- Tabel Detil Transaksi
CREATE TABLE detil_transaksi (
  detil_id INT AUTO_INCREMENT PRIMARY KEY,
  transaksi_id INT NOT NULL,
  barang_id INT NOT NULL,
  jumlah INT NOT NULL,
  subtotal INT NOT NULL,
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(transaksi_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (barang_id) REFERENCES barang(barang_id)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
);
