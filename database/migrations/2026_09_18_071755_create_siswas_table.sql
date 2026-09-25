CREATE TABLE IF NOT EXISTS `siswa` (
    `id_siswa` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_user` INT UNSIGNED NOT NULL,
    `nis` VARCHAR(20) NOT NULL,
    `nama` VARCHAR(255) NOT NULL,
    `kelas` VARCHAR(10) NOT NULL,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL,

    CONSTRAINT `fk_siswa_user`
        FOREIGN KEY (`id_user`)
        REFERENCES `users` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;