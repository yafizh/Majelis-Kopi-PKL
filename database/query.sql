-- Query For Get Stock Bahan Baku
SELECT 
    bb.*,
    (
        (
            SELECT 
                IFNULL(SUM(p.jumlah), 0) 
            FROM 
                penyuplaian p 
            INNER JOIN 
                pemasok_bahan_baku pbb 
            ON 
                pbb.id=p.id_pemasok_bahan_baku 
            WHERE 
                pbb.id_bahan_baku=bb.id
        ) 
        -
        (
            SELECT 
                IFNULL(SUM(bbd.jumlah * dp.jumlah), 0) 
            FROM 
                detail_penjualan dp 
            INNER JOIN 
                bahan_baku_digunakan bbd 
            ON 
                dp.id=bbd.id_detail_penjualan 
            WHERE 
                bbd.id_bahan_baku=bb.id
        )
    ) jumlah 
FROM 
    bahan_baku bb 
ORDER BY 
    bb.nama;

-- Query For Get Pemasok and What they are supplie it
SELECT  
    p.*, 
    GROUP_CONCAT(bb.nama) AS bahan_baku 
FROM 
    pemasok p 
LEFT JOIN 
    pemasok_bahan_baku pbb 
ON 
    pbb.id_pemasok=p.id 
LEFT JOIN 
    bahan_baku bb 
ON 
    bb.id=pbb.id_bahan_baku 
GROUP BY 
    p.id;