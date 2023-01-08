<?php
$kategori_menu = $conn->query("SELECT * FROM kategori_menu")->fetch_all(MYSQLI_ASSOC);
$menu = [];
foreach ($kategori_menu as $index => $value) {
    $menu = array_merge($menu, $conn->query("SELECT * FROM menu WHERE id_kategori_menu=" . $value['id'] . " ORDER BY nama")->fetch_all(MYSQLI_ASSOC));
    foreach ($menu as $index2 => $value2) {
        $menu[$index2]['bahan_baku_menu'] = $conn->query("SELECT * FROM bahan_baku_menu WHERE id_menu=" . $value2['id'])->fetch_all(MYSQLI_ASSOC);
    }
}

$q = "
    SELECT 
        bb.*,
        (
            IFNULL(SUM(penyuplaian.jumlah), 0) 
            - 
            IFNULL(SUM(bbm.jumlah * detail_penjualan.jumlah), 0) 
        ) AS jumlah
    FROM   
        bahan_baku bb 
    LEFT JOIN 
        pemasok_bahan_baku pbb 
    ON 
        pbb.id_bahan_baku=bb.id 
    LEFT JOIN 
        penyuplaian 
    ON 
        penyuplaian.id_pemasok_bahan_baku=pbb.id 
    LEFT JOIN 
        bahan_baku_menu bbm 
    ON 
        bbm.id_bahan_baku=bb.id 
    LEFT JOIN 
        menu m 
    ON 
        m.id=bbm.id_menu 
    LEFT JOIN 
        detail_penjualan 
    ON 
        detail_penjualan.id_menu=m.id 
    GROUP BY 
        bb.id 
    ORDER BY 
        bb.nama 
";
$stok_bahan_baku = $conn->query($q)->fetch_all(MYSQLI_ASSOC);
?>
<?php
if (isset($_POST['submit'])) {
    $tunai = $_POST['tunai'];
}
?>
<section class="table-components">
    <div class="container-fluid">
        <div class="tables-wrapper pt-30">
            <div class="row">
                <div class="col-lg-8">
                    <div class="tab-style-2 card-style mb-30">
                        <nav class="nav" id="nav-tab">
                            <?php foreach ($kategori_menu as $index => $value) : ?>
                                <button <?= !$index ? 'class="active"' : ''; ?> id="tab-kategori_menu-<?= $index; ?>" data-bs-toggle="tab" data-bs-target="#tabContent-kategori_menu-<?= $index; ?>">
                                    <?= $value['nama']; ?>
                                </button>
                            <?php endforeach; ?>
                        </nav>
                        <div class="tab-content" id="nav-tabContent2">
                            <?php foreach ($kategori_menu as $index => $value) : ?>
                                <div class="tab-pane fade <?= !$index ? 'show active' : '';  ?>" id="tabContent-kategori_menu-<?= $index; ?>">
                                    <div class="table-wrapper table-responsive">
                                        <table class="table clients-table">
                                            <?php
                                            $q = "
                                                SELECT 
                                                    * 
                                                FROM 
                                                    menu 
                                                WHERE 
                                                    id_kategori_menu=" . $value['id'] . " 
                                                ORDER BY 
                                                    nama
                                            ";
                                            $result = $conn->query($q);
                                            ?>
                                            <tbody>
                                                <?php if ($result->num_rows) : ?>
                                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                                        <tr>
                                                            <td>
                                                                <div class="employee-image">
                                                                    <img src="assets/images/lead/lead-6.png" alt="" />
                                                                </div>
                                                            </td>
                                                            <td class="min-width">
                                                                <p><?= $row['nama']; ?></p>
                                                            </td>
                                                            <td class="min-width text-center">
                                                                <p><?= $row['harga']; ?></p>
                                                            </td>
                                                            <td>
                                                                <div class="action">
                                                                    <button class="text-secondary" id="move-to-order-list" data-id="<?= $row['id']; ?>" data-index="<?= $index; ?>">
                                                                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                                            <path fill="currentColor" d="M11 9H13V6H16V4H13V1H11V4H8V6H11M7 18C5.9 18 5 18.9 5 20S5.9 22 7 22 9 21.1 9 20 8.1 18 7 18M17 18C15.9 18 15 18.9 15 20S15.9 22 17 22 19 21.1 19 20 18.1 18 17 18M7.2 14.8V14.7L8.1 13H15.5C16.2 13 16.9 12.6 17.2 12L21.1 5L19.4 4L15.5 11H8.5L4.3 2H1V4H3L6.6 11.6L5.2 14C5.1 14.3 5 14.6 5 15C5 16.1 5.9 17 7 17H19V15H7.4C7.3 15 7.2 14.9 7.2 14.8Z" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center">Menu <?= $value['nama']; ?> Kosong</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card-style mb-30">
                        <h5 class="text-medium mb-20 text-center">Daftar Pesanan</h5>
                        <div class="table-responsive">
                            <form action="" method="POST">
                                <table id="daftar-pesanan" class="table">
                                    <tbody>
                                        <tr>
                                            <td colspan="3" class="text-center">Daftar Pesanan Kosong</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>
<script>
    const stok_bahan_baku = JSON.parse('<?= json_encode($stok_bahan_baku); ?>');
    const menu = JSON.parse('<?= json_encode($menu); ?>');
    const stokMenu = {};
    const daftar_pesanan = {
        'pesanan': [],
        'id': []
    };
    const orderButton = document.querySelectorAll("#move-to-order-list");

    const updateStokMenu = () => {
        menu.forEach((menu_value, index) => {
            let stok = 0;
            let ready = 1;
            do {
                menu_value.bahan_baku_menu.forEach(value_bahan_baku_menu => {
                    stok_bahan_baku.forEach(value_stok_bahan_baku => {
                        if (
                            value_stok_bahan_baku.id == value_bahan_baku_menu.id_bahan_baku &&
                            parseInt(value_stok_bahan_baku.jumlah) < (parseInt(value_bahan_baku_menu.jumlah) * (stok + 1))
                        ) {
                            ready = 0;
                            return;
                        }
                    });
                });
                if (ready)
                    stok += 1;
            } while (ready);
            stokMenu[menu_value.id] = {
                nama_menu: menu_value.nama,
                stok: stok
            }

            if (stok == 0) {
                orderButton[index].classList.remove('text-secondary');
                orderButton[index].classList.add('text-light');
            } else {
                orderButton[index].classList.add('text-secondary');
                orderButton[index].classList.remove('text-light');
            }
            document.querySelectorAll('.plus-btn').forEach((button) => {
                if (button.getAttribute('data-id') == menu_value.id) {
                    if (stok == 0) {
                        button.classList.remove('text-success');
                        button.classList.add('text-light');
                    } else {
                        button.classList.add('text-success');
                        button.classList.remove('text-light');
                    }
                }
            });
        });
    }
    updateStokMenu();


    const updateStokBahanBaku = (menu, status = 1) => {
        stok_bahan_baku.forEach((value_stok_bahan_baku, index_stok_bahan_baku) => {
            menu.bahan_baku_menu.forEach(bahan_baku_menu => {
                if (value_stok_bahan_baku.id == bahan_baku_menu.id_bahan_baku) {
                    if (status) {
                        stok_bahan_baku[index_stok_bahan_baku].jumlah = parseInt(stok_bahan_baku[index_stok_bahan_baku].jumlah) - parseInt(bahan_baku_menu.jumlah);
                    } else {
                        stok_bahan_baku[index_stok_bahan_baku].jumlah = parseInt(stok_bahan_baku[index_stok_bahan_baku].jumlah) + parseInt(bahan_baku_menu.jumlah);
                    }
                }
            });
        });
    }

    const minusMenu = (index) => {
        updateStokBahanBaku(daftar_pesanan.pesanan[index], 0);
        daftar_pesanan.pesanan[index].jumlah -= 1;
        if (daftar_pesanan.pesanan[index].jumlah == 0) {
            delete daftar_pesanan.pesanan[index];
            delete daftar_pesanan.id[index];
        }
        updateDaftarPesanan();
        updateStokMenu();
    }

    const plusMenu = (index) => {
        if (cekStok(daftar_pesanan.id[index])) {
            updateStokBahanBaku(daftar_pesanan.pesanan[index]);
            daftar_pesanan.pesanan[index].jumlah += 1;
            updateDaftarPesanan();
            updateStokMenu();
        }
    }

    const updateKembalianTunai = () => {
        const total = document.querySelector('input[name=total]');
        const tunai = document.querySelector('input[name=tunai]');
        const kembalian = document.querySelector('input[name=kembalian]');

        if (tunai.value - total.value > 0)
            kembalian.value = tunai.value - total.value;
        else
            kembalian.value = 0;
    }

    const updateDaftarPesanan = () => {
        document.querySelector('#daftar-pesanan tbody').innerHTML = '';
        if (daftar_pesanan.id.length > 0) {
            let total = 0;
            daftar_pesanan.pesanan.forEach((value, index) => {
                document.querySelector('#daftar-pesanan tbody').insertAdjacentHTML('beforeend', `
                    <tr>
                        <td class="text-center fit">
                            <p>${index+1}</p>
                        </td>
                        <td class="px-5">
                            <h5>${value.nama}</h5>
                            <p>Rp. ${value.harga}</p>
                        </td>
                        <td class="fit">
                            <div class="d-flex gap-2">
                                <div class="action">
                                    <button type="button" onclick="minusMenu(${index})" class="text-danger">
                                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19,13H5V11H19V13Z" />
                                        </svg>
                                    </button>
                                </div>
                                <h5 class="px-3 mt-1">${value.jumlah}</h5>
                                <div class="action">
                                    <button type="button" onclick="plusMenu(${index})" class="text-success plus-btn" data-id="${value.id}">
                                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                `);
                total += value.harga * value.jumlah;
            });
            document.querySelector('#daftar-pesanan tbody').insertAdjacentHTML('beforeend', `
                <tr>
                    <th>Total</th>
                    <td colspan="2">
                        <input type="text" name="total" class="form-control text-end" disabled value="${total}">
                    </td>
                </tr>
                <tr>
                    <th>Tunai</th>
                    <td colspan="2">
                        <input type="text" name="tunai" oninput="updateKembalianTunai()" class="form-control text-end" value="0">
                    </td>
                </tr>
                <tr>
                    <th>Kembalian</th>
                    <td colspan="2">
                        <input type="text" name="kembalian" class="form-control text-end" disabled value="0">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <button type="submit" name="submit" class="btn btn-primary w-100">LAKUKAN PENJUALAN</button>
                    </td>
                </tr>
            `);
        } else {
            document.querySelector('#daftar-pesanan tbody').innerHTML = `
                <tr>
                    <td colspan="3" class="text-center">Daftar Pesanan Kosong</td>
                </tr>
            `;
        }

    }

    const cekStok = (id_menu) => {
        if (stokMenu[id_menu].stok > 0) {
            return true;
        } else {
            alert('Abis')
            return false;
        }
    }
    const pesanMenu = (id_menu) => {
        menu.forEach(value => {
            if (id_menu == value.id) {
                if (cekStok(id_menu)) {
                    updateStokBahanBaku(value);
                    if (daftar_pesanan.id.includes(value.id))
                        daftar_pesanan.pesanan[daftar_pesanan.id.indexOf(value.id)].jumlah += 1;
                    else {
                        daftar_pesanan.pesanan.push({
                            ...value,
                            jumlah: 1
                        });
                        daftar_pesanan.id.push(value.id);
                    }
                    updateDaftarPesanan();
                }
                return;
            }
        });
        updateStokMenu();
    }

    orderButton.forEach((value) => {
        value.addEventListener('click', () => {
            pesanMenu(value.getAttribute('data-id'));
        });
    });

    document.querySelector('form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const data = {
            pesanan: [],
            tunai: document.querySelector('input[name=tunai]').value
        };

        daftar_pesanan.pesanan.forEach((value) => {
            data.pesanan.push({
                id_menu: value.id,
                jumlah: value.jumlah,
                harga: value.harga,
            });
        });

        const response = await fetch("halaman/kasir/tambah.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => response.json());
        if(response.isSuccess){
            alert('Penjualan Berhasil');
            location.reload();
        }
    });
</script>