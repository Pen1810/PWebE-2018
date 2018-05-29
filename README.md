# PWebE-2018

## Anggota:
1. Honesta Swandaru (5116100055)
2. Deddy Aditya P. (5116100069)
3. Abdurrahman (5116100087)
4. Akmal Darari R. B. (5116100148)

## Rancangan struktur directory
    PWebE-2018-+-img-+-catalogue---{item-id}    // isinya gambar-gambar itemnya
               |     |-profiles                 // isinya profpic custom user
               |     `-{other-images}
               |-css-+-{bootstrap}
               |     `-{custom-css}
               |-js-+-{jquery}
               |    |-{bootstrap}
               |    `-{custom-css}
               |-fonts-+-{font-awesome}
               |       `-{bootstrap-glyphicon}
               |-db---{sql-files}               // isinya ddl, data dump, rancangan sql
               |-{favicon.ico}
               `-{some-php-files}               // something like index.php dll
Tidak menutup kemungkinan file php khusus (portal seller, control panel admin) diletakkan pada folder yang berbeda.

## Rancangan database
Database akan bernama <code>pweb_shop</code> dan akan berisi 3 tabel yaitu tabel member, tabel barang dan tabel transaksi.

### Struktur tabel member

Column | Properties | Default
-------|------------|---------
id | Primary key, Auto increment | not set 
username | Unique, Not null | not set
pass | Not null | not set
role | Not null | <code>3</code>
nama | Not null | not set
alamat | Not null | not set
telp | Not null | not set
email | Not null | not set
profpic | Not null | <code>/img/profile/default.png</code>

Keterangan: Pada kolom role nilai 1 berarti admin, nilai 2 berarti penjual dan nilai 3 berarti pembeli terdaftar.

### Struktur tabel barang

Column | Properties | Default
-------|------------|---------
b_id | Primary key, Auto increment | not set
kategori | Not null | not set
nama_barang | Not null | not set
harga | Not null | not set
stock | Not null | not set
berat | Not null | not set
deskripsi | Not null | not set
itempic | Not null | <code>/img/catalogue/default.png</code>

Keterangan: 

### Struktur tabel transaksi

Column | Properties | Default
-------|------------|---------
id_transaksi | Primary key, Auto increment | not set
no_resi | Not null, Unique | not set
id | Foreign key (member) | not set
b_id | Foreign key (barang) | not set
t_stats | Not null | <code>1</code>

Keterangan: 

