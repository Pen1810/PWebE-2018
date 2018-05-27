CREATE TABLE `barang` (
  `b_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `kategori` int(11) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `harga` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `itempic` varchar(128) NOT NULL DEFAULT '/img/catalogue/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `member` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(32) NOT NULL UNIQUE,
  `pass` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '3',
  `nama` varchar(256) NOT NULL,
  `alamat` varchar(512) NOT NULL,
  `telp` varchar(16) NOT NULL,
  `email` varchar(54) NOT NULL,
  `profpic` varchar(128) NOT NULL DEFAULT '/img/profile/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `no_resi` varchar(32) NOT NULL UNIQUE,
  `id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `t_stats` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_member` FOREIGN KEY (`id`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `fk_transaksi_barang` FOREIGN KEY (`b_id`) REFERENCES `barang` (`b_id`);
