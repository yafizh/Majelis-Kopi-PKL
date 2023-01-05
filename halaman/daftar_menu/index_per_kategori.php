<?php $kategori_menu = $conn->query("SELECT * FROM kategori_menu WHERE id=" . $_GET['id_kategori_menu'])->fetch_assoc(); ?>
<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3><a href="?h1=menu&h2=daftar_menu" class="breadcrumb-item">Menu</a> <span style="color: #5D657B;">/</span> Kategori <?= $kategori_menu['nama']; ?></h3>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="?h1=menu&h2=tambah_daftar_menu&id_kategori_menu=<?= $kategori_menu['id']; ?>" class="btn btn-primary mb-30">Tambah</a>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert-box success-alert">
                <div class="alert">
                    <h4 class="alert-heading">Berhasil</h4>
                    <p class="text-medium">
                        <?= $_SESSION['success']; ?>
                    </p>
                </div>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="table-responsive">
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center fit">
                                            <h6>No</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Nama</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Harga</h6>
                                        </th>
                                        <th class="text-center fit">
                                            <h6>Aksi</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $result = $conn->query("SELECT * FROM menu WHERE id_kategori_menu=" . $_GET['id_kategori_menu']);
                                $no = 1;
                                ?>
                                <tbody>
                                    <?php if ($result->num_rows) : ?>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td class="text-center fit">
                                                    <p><?= $no++; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['nama']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['harga']; ?></p>
                                                </td>
                                                <td class="d-flex gap-2">
                                                    <div class="action">
                                                        <button data-image="<?= $row['foto']; ?>" onclick="setImageModal(this)" class="text-secondary" data-bs-toggle="modal" data-bs-target="#ModalOne" title="Lihat Gambar">
                                                            <i class="lni lni-image"></i>
                                                        </button>
                                                    </div>
                                                    <div class="action">
                                                        <a href="?h1=menu&h2=ubah_daftar_menu&id_kategori_menu=<?= $_GET['id_kategori_menu']; ?>&id=<?= $row['id']; ?>" class="text-warning">
                                                            <i class="lni lni-pencil"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action">
                                                        <a onclick="return confirm('Yakin?')" href="?h1=menu&h2=hapus_daftar_menu&id_kategori_menu=<?= $_GET['id_kategori_menu']; ?>&id=<?= $row['id']; ?>" class="text-danger">
                                                            <i class="lni lni-trash-can"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td class="text-center" colspan="4">Data Kosong</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="follow-up-modal">
    <div class="modal fade" id="ModalOne" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-style text-center">
                <div class="modal-body">
                    <div class="image mb-30">
                        <img src="#" style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: .4rem;"/>
                    </div>
                    <div class="action d-flex flex-wrap justify-content-center">
                        <button data-bs-dismiss="modal" class="main-btn primary-btn-outline square-btn btn-hover m-1">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('layout/js.php'); ?>
<script>
    const setImageModal = (elm) => document.querySelector('#ModalOne .image img').setAttribute('src', elm.getAttribute('data-image'));
</script>