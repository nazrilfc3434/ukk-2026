-- create_siswas_table

CREATE TABLE IF NOT EXISTS `siswa`(
    id_siswa INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_user INT UNSIGNED NOT NULL,
    nis varchar(20) NOT NULL,
    nama varchar(255) NOT NULL,
    kelas varchar(10) NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,

    CONSTRAINT fk_siswa_user FOREIGN KEY (id_user)
    REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utr8mb4;

    
    

