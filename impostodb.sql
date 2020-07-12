CREATE DATABASE IF NOT EXISTS `impostodb`;

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `updated_at` TIMESTAMP,
  `created_at` TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `produtos` (`nome`) VALUES ('Mouse gamer'), ('Gabinete Gamer');

CREATE TABLE `imposto_produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `produto_id` int NOT NULL,
  `uf` varchar(2) NOT NULL,
  `percentual` decimal(10,2) DEFAULT NULL,
  `updated_at` TIMESTAMP,
  `created_at` TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `imposto_produtos` ADD CONSTRAINT `fk_imposto_produto` FOREIGN KEY ( `produto_id` ) REFERENCES `produtos` ( `id` ) ;

