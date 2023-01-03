-- Query For Get Stock Bahan Baku
SELECT 
    bb.*,
    (
        IFNULL(SUM(penyuplaian.jumlah), 0) 
        - 
        IFNULL(SUM(bbm.jumlah * penjualan.jumlah), 0)
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
    penjualan 
ON 
    penjualan.id_menu=m.id 
GROUP BY 
    bb.id;

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