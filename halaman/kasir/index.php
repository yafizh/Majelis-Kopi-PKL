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
$daftar_pesanan = [
    "pesanan" => [],
    "id" => [],
    "tunai" => 0,
    "total" => 0
];
if (isset($_GET['id'])) {
    $q = "
        SELECT 
            m.id,
            m.nama,
            m.foto,
            dp.harga,
            dp.jumlah 
        FROM 
            detail_penjualan dp 
        INNER JOIN 
            menu m  
        ON 
            m.id=dp.id_menu 
        WHERE 
            dp.id_penjualan=" . $_GET['id'] . "
    ";
    $result = $conn->query($q);

    while ($row = $result->fetch_assoc()) {
        $row['bahan_baku_menu'] = $conn->query("SELECT * FROM bahan_baku_menu WHERE id_menu=" . $row['id'])->fetch_all(MYSQLI_ASSOC);
        $daftar_pesanan['pesanan'][] = $row;
        $daftar_pesanan['id'][] = $row['id'];
    }
    $penjualan = $conn->query("SELECT * FROM penjualan WHERE id=" . $_GET['id'])->fetch_assoc();
    $daftar_pesanan['tunai'] = $penjualan['tunai'];
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
                                                            <td class="min-width">
                                                                <p>Rp <?= number_format($row['harga'], 0, ",", "."); ?></p>
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
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });

    const stok_bahan_baku = JSON.parse('<?= json_encode($stok_bahan_baku); ?>');
    const menu = JSON.parse('<?= json_encode($menu); ?>');
    const stokMenu = {};
    const daftar_pesanan = JSON.parse('<?= json_encode($daftar_pesanan); ?>');

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
            daftar_pesanan.pesanan.splice(index, 1)
            daftar_pesanan.id.splice(index, 1)
        }
        updateDaftarPesanan();
        updateStokMenu();
    }

    const plusMenu = (index) => {
        if (cekStok(daftar_pesanan.id[index])) {
            updateStokBahanBaku(daftar_pesanan.pesanan[index]);
            daftar_pesanan.pesanan[index].jumlah = parseInt(daftar_pesanan.pesanan[index].jumlah) + 1;
            updateDaftarPesanan();
            updateStokMenu();
        }
    }

    const updateKembalianTunai = () => {
        const kembalian = document.querySelector('input[name=kembalian]');
        document.querySelector('input[name=tunai]').addEventListener("keypress", function(evt) {
            if (evt.which < 48 || evt.which > 57) {
                evt.preventDefault();
                return;
            }

            this.addEventListener('input', function() {
                daftar_pesanan.tunai = Number(((this.value).split('.')).join(''));
                this.value = formatNumberWithDot.format(daftar_pesanan.tunai);

                if (Number(daftar_pesanan.tunai) - Number(daftar_pesanan.total) > 0)
                    kembalian.value = formatNumberWithDot.format(Number(daftar_pesanan.tunai) - Number(daftar_pesanan.total));
                else
                    kembalian.value = 0;
            });
        });
        if (Number(daftar_pesanan.tunai) - Number(daftar_pesanan.total) > 0)
            kembalian.value = formatNumberWithDot.format(Number(daftar_pesanan.tunai) - Number(daftar_pesanan.total));
        else
            kembalian.value = 0;
    }

    const updateDaftarPesanan = () => {
        document.querySelector('#daftar-pesanan tbody').innerHTML = '';
        if (daftar_pesanan.id.length > 0) {
            daftar_pesanan['total'] = 0;
            daftar_pesanan.pesanan.forEach((value, index) => {
                document.querySelector('#daftar-pesanan tbody').insertAdjacentHTML('beforeend', `
                    <tr>
                        <td class="text-center fit">
                            <p>${index+1}</p>
                        </td>
                        <td>
                            <h5>${value.nama}</h5>
                            <p>Rp ${formatNumberWithDot.format(value.harga)}</p>
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
                daftar_pesanan['total'] += value.harga * value.jumlah;
            });
            document.querySelector('#daftar-pesanan tbody').insertAdjacentHTML('beforeend', `
                <tr>
                    <th>Total</th>
                    <td colspan="2" class="ps-3">
                        <input type="text" name="total" class="form-control text-end" disabled value="${formatNumberWithDot.format(daftar_pesanan.total)}">
                    </td>
                </tr>
                <tr>
                    <th>Tunai</th>
                    <td colspan="2" class="ps-3">
                        <input type="text" name="tunai" oninput="updateKembalianTunai()" class="form-control text-end" value="${formatNumberWithDot.format(daftar_pesanan.tunai)}">
                    </td>
                </tr>
                <tr>
                    <th>Kembalian</th>
                    <td colspan="2" class="ps-3">
                        <input type="text" name="kembalian" class="form-control text-end" disabled value="0">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                    ${
                        params.id 
                        ? 
                        `
                        <div class="d-flex gap-3">
                            <a href="${document.referrer}" class="btn btn-secondary">KEMBALI</a>
                            <button type="submit" name="submit" class="flex-grow-1 btn btn-primary">PERBAHARUI PENJUALAN</button>
                        </div>
                        `
                        :
                        `<button type="submit" name="submit" class="btn btn-primary w-100">LAKUKAN PENJUALAN</button>` 
                    }
                    </td>
                </tr>
            `);
            updateKembalianTunai();
        } else {
            document.querySelector('#daftar-pesanan tbody').innerHTML = `
                <tr>
                    <td colspan="3" class="text-center">Daftar Pesanan Kosong</td>
                </tr>
            `;
        }

    }
    updateDaftarPesanan();

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
                        daftar_pesanan.pesanan[daftar_pesanan.id.indexOf(value.id)].jumlah = parseInt(daftar_pesanan.pesanan[daftar_pesanan.id.indexOf(value.id)].jumlah) + 1;
                    else {
                        daftar_pesanan.pesanan.push({
                            ...value,
                            jumlah: 1
                        });
                        daftar_pesanan.id.push(value.id);
                        console.log(daftar_pesanan)
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
            tunai: daftar_pesanan.tunai
        };

        daftar_pesanan.pesanan.forEach((value) => {
            data.pesanan.push({
                id_menu: value.id,
                jumlah: value.jumlah,
                harga: value.harga,
            });
        });

        if (params.id) {
            const response = await fetch("halaman/kasir/ubah.php?id=" + params.id, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(response => response.json());
            if (response.isSuccess) {
                alert('Edit Penjualan Berhasil');
                if (params.h1 && params.h2)
                    location.href = "?h1=menu&h2=detail_penjualan&id=" + params.id;
                else
                    location.href = "index.php?h=detail_riwayat_penjualan&id=" + params.id;
            }
        } else {
            const response = await fetch("halaman/kasir/tambah.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(response => response.json());
            if (response.isSuccess) {
                alert('Penjualan Berhasil');
                location.reload();
            }
        }
    });
</script>