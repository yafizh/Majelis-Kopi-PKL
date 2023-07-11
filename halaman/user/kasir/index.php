<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Kasir</h3>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="?h1=user&h2=tambah_kasir" class="btn btn-primary mb-30">Tambah</a>
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
                                            <h6>Username</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Nama</h6>
                                        </th>
                                        <th class="fit">
                                            <h6>Aksi</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        k.*,
                                        u.username 
                                    FROM 
                                        kasir k 
                                    INNER JOIN 
                                        user u 
                                    ON 
                                        u.id=k.id_user 
                                ";
                                $result = $conn->query($q);
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
                                                    <p><?= $row['username']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['nama']; ?></p>
                                                </td>
                                                <td class="d-flex gap-2">
                                                    <div class="action">
                                                        <button data-image="<?= $row['foto']; ?>" onclick="setImageModal(this)" class="text-secondary" data-bs-toggle="modal" data-bs-target="#ModalOne" title="Lihat Gambar">
                                                            <i class="lni lni-image"></i>
                                                        </button>
                                                    </div>
                                                    <div class="action">
                                                        <a href="?h1=user&h2=detail_kasir&id=<?= $row['id']; ?>" class="text-success">
                                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                                <path fill="currentColor" d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="action">
                                                        <a href="?h1=user&h2=ubah_kasir&id=<?= $row['id']; ?>" class="text-warning">
                                                            <i class="lni lni-pencil"></i>
                                                        </a>
                                                    </div>
                                                    <div class="action">
                                                        <a onclick="return confirm('Yakin?')" href="?h1=user&h2=hapus_kasir&id=<?= $row['id_user']; ?>" class="text-danger">
                                                            <i class="lni lni-trash-can"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td class="text-center" colspan="3">Data Kosong</td>
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
                        <img src="#" style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: .4rem;" />
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