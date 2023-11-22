DELIMITER //

CREATE TRIGGER update_stok_obat AFTER INSERT ON beli
FOR EACH ROW
BEGIN
    DECLARE obat_id INT;
    DECLARE jml_beli_obat INT;

    SELECT id_obat, jml_beli INTO obat_id, jml_beli_obat
    FROM beli
    WHERE id_beli = NEW.id_beli;

    UPDATE obat
    SET stok_obat = stok_obat - jml_beli_obat
    WHERE id_obat = obat_id;
END;
//

DELIMITER ;

DELIMITER //

CREATE TRIGGER update_stok_supply AFTER INSERT ON supply
FOR EACH ROW
BEGIN
    DECLARE obat_id_supply INT;
    DECLARE jml_obat_supply INT;

    SELECT id_obat, jumlah_obat INTO obat_id_supply, jml_obat_supply
    FROM supply
    WHERE id_pengiriman = NEW.id_pengiriman;

    UPDATE obat
    SET stok_obat = stok_obat + jml_obat_supply
    WHERE id_obat = obat_id_supply;
END;
//

DELIMITER ;





