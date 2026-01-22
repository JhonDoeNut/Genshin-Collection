-- Create database and use it
CREATE DATABASE genshin_impact
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_0900_ai_ci;
USE genshin_impact;

-- Table: element
CREATE TABLE element (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  url_img VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Table: origin
CREATE TABLE origin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  url_img VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Table: unitclass
CREATE TABLE unitclass (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  url_img VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Table: personnage
CREATE TABLE personnage (
  id VARCHAR(50) PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  element INT NOT NULL,
  unitclass INT NOT NULL,
  origin INT NULL,
  rarity INT NOT NULL,
  url_img VARCHAR(255) NOT NULL,
  
  CONSTRAINT fk_perso_element
    FOREIGN KEY (element) REFERENCES element(id)
      ON UPDATE CASCADE ON DELETE RESTRICT,
  
  CONSTRAINT fk_perso_unitclass
    FOREIGN KEY (unitclass) REFERENCES unitclass(id)
      ON UPDATE CASCADE ON DELETE RESTRICT,
  
  CONSTRAINT fk_perso_origin
    FOREIGN KEY (origin) REFERENCES origin(id)
      ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

-- optional: Insert elements, origins, and unitclasses into the tables
INSERT INTO element (id, name, url_img)
VALUES (1, 'Anemo', 'https://gensh.honeyhunterworld.com/img/icons/element/anemo.webp'),
       (2, 'Geo', 'https://gensh.honeyhunterworld.com/img/icons/element/geo.webp'),
       (3, 'Pyro', 'https://gensh.honeyhunterworld.com/img/icons/element/pyro.webp'),
       (4, 'Cryo', 'https://gensh.honeyhunterworld.com/img/icons/element/cryo.webp'),
       (5, 'Hydro', 'https://gensh.honeyhunterworld.com/img/icons/element/hydro.webp'),
       (6, 'Electro', 'https://gensh.honeyhunterworld.com/img/icons/element/electro.webp'),
       (7, 'Dendro', 'https://gensh.honeyhunterworld.com/img/icons/element/dendro.webp');

INSERT INTO unitclass (id, name, url_img)
VALUES (1, 'Sword', 'https://gensh.honeyhunterworld.com/img/s_33101.webp'),
       (2, 'Claymore', 'https://gensh.honeyhunterworld.com/img/s_163101.webp'),
       (3, 'Polearm', 'https://gensh.honeyhunterworld.com/img/s_233101.webp'),
       (4, 'Bow', 'https://gensh.honeyhunterworld.com/img/s_213101.webp'),
       (5, 'Catalyst', 'https://gensh.honeyhunterworld.com/img/s_43101.webp');

INSERT INTO origin (id, name, url_img)
VALUES (1, 'Mondstadt', 'https://gensh.honeyhunterworld.com/img/ch_1001.webp'),
       (2, 'Liyue', 'https://gensh.honeyhunterworld.com/img/ch_1101.webp'),
       (3, 'Inazuma', 'https://gensh.honeyhunterworld.com/img/ch_1201.webp'),
       (4, 'Sumeru', 'https://gensh.honeyhunterworld.com/img/ch_1301.webp'),
       (5, 'Fontaine', 'https://gensh.honeyhunterworld.com/img/ch_1401.webp'),
       (6, 'Natlan', 'https://gensh.honeyhunterworld.com/img/ch_1500.webp'),
       (7, 'Nod-Krai', 'https://gensh.honeyhunterworld.com/img/ch_1600.webp');

-- optional: insert personnage into the table
INSERT INTO personnage (id, name, element, unitclass, origin, rarity, url_img) 
VALUES ('69725b0a63a8d', 'Sucrose', 1, 5, 1, 4, 'https://gensh.honeyhunterworld.com/img/sucrose_043_gacha_splash.webp'),
       ('69725b785e8a4', 'Xiao', 1, 3, 2, 5, 'https://gensh.honeyhunterworld.com/img/xiao_026_gacha_splash.webp'),
       ('69725ba86087f', 'Yun Jin', 2, 3, 2, 4, 'https://gensh.honeyhunterworld.com/img/yunjin_064_gacha_splash.webp'),
       ('69725bd9728e9', 'Noelle', 2, 2, 1, 4, 'https://gensh.honeyhunterworld.com/img/noel_034_gacha_splash.webp'),
       ('69725c07af8b1', 'Zhongli', 2, 3, 2, 5, 'https://gensh.honeyhunterworld.com/img/zhongli_030_gacha_splash.webp'),
       ('69725c5474288', 'Diluc', 3, 2, 1, 5, 'https://gensh.honeyhunterworld.com/img/diluc_016_gacha_splash.webp'),
       ('69725c7f43f8d', 'Hu Tao', 3, 3, 2, 5, 'https://gensh.honeyhunterworld.com/img/hutao_046_gacha_splash.webp'),
       ('69725cb061151', 'Yoimiya', 3, 4, 3, 5, 'https://gensh.honeyhunterworld.com/img/yoimiya_049_gacha_splash.webp'),
       ('69725d1b7a216', 'Mavuika', 3, 2, 6, 5, 'https://gensh.honeyhunterworld.com/img/mavuika_106_gacha_splash.webp'),
       ('69725df3277de', 'Ganyu', 4, 4, 2, 5, 'https://gensh.honeyhunterworld.com/img/ganyu_037_gacha_splash.webp'),
       ('69725e4f16d2e', 'Layla', 4, 1, 4, 4, 'https://gensh.honeyhunterworld.com/img/layla_074_gacha_splash.webp'),
       ('69725e7724a4e', 'Rosaria', 4, 3, 1, 4, 'https://gensh.honeyhunterworld.com/img/rosaria_045_gacha_splash.webp'),
       ('69725ea543999', 'Shenhe', 4, 3, 2, 5, 'https://gensh.honeyhunterworld.com/img/shenhe_063_gacha_splash.webp'),
       ('69725f120876b', 'Yelan', 5, 4, 2, 5, 'https://gensh.honeyhunterworld.com/img/yelan_060_gacha_splash.webp'),
       ('69725f855b0d3', 'Mona', 5, 5, 1, 5, 'https://gensh.honeyhunterworld.com/img/mona_041_gacha_splash.webp'),
       ('69725fab77ece', 'Furina', 5, 1, 5, 5, 'https://gensh.honeyhunterworld.com/img/furina_089_gacha_splash.webp'),
       ('69725fd5a630c', 'Neuvillette', 5, 5, 5, 5, 'https://gensh.honeyhunterworld.com/img/neuvillette_087_gacha_splash.webp'),
       ('69725ffb0cf07', 'Keqing', 6, 1, 2, 5, 'https://gensh.honeyhunterworld.com/img/keqing_042_gacha_splash.webp'),
       ('6972603c6eda7', 'Fischl', 6, 4, 1, 4, 'https://gensh.honeyhunterworld.com/img/fischl_031_gacha_splash.webp'),
       ('697260563abc6', 'Beidou', 6, 2, 2, 4, 'https://gensh.honeyhunterworld.com/img/beidou_024_gacha_splash.webp'),
       ('6972607362a6d', 'Raiden Shogun', 6, 3, 3, 5, 'https://gensh.honeyhunterworld.com/img/shougun_052_gacha_splash.webp'),
       ('697260b7eb6d8', 'Kuki Shinobu', 6, 1, 3, 4, 'https://gensh.honeyhunterworld.com/img/shinobu_065_gacha_splash.webp'),
       ('697260ed71a91', 'Varesa', 6, 5, 6, 5, 'https://gensh.honeyhunterworld.com/img/varesa_111_gacha_splash.webp'),
       ('6972614710651', 'Chevreuse', 3, 3, 5, 4, 'https://gensh.honeyhunterworld.com/img/chevreuse_090_gacha_splash.webp'),
       ('697261698f00b', 'Klee', 3, 5, 1, 5, 'https://gensh.honeyhunterworld.com/img/klee_029_gacha_splash.webp'),
       ('697261bebd738', 'Bennett', 3, 1, 1, 4, 'https://gensh.honeyhunterworld.com/img/bennett_032_gacha_splash.webp'),
       ('697261e22acf2', 'Xiangling', 3, 3, 2, 4, 'https://gensh.honeyhunterworld.com/img/xiangling_023_gacha_splash.webp'),
       ('6972623a3c976', 'Amber', 3, 4, 1, 4, 'https://gensh.honeyhunterworld.com/img/ambor_021_gacha_splash.webp'),
       ('6972625a85e37', 'Kamisato Ayaka', 4, 1, 3, 5, 'https://gensh.honeyhunterworld.com/img/ayaka_002_gacha_splash.webp'),
       ('6972630a68074', 'Nefer', 7, 5, 7, 5, 'https://gensh.honeyhunterworld.com/img/nefer_122_gacha_splash.webp'),
       ('6972633f4f2bb', 'Lauma', 7, 5, 7, 5, 'https://gensh.honeyhunterworld.com/img/lauma_119_gacha_splash.webp'),
       ('6972636bd4b26', 'Kinich', 7, 2, 6, 5, 'https://gensh.honeyhunterworld.com/img/kinich_101_gacha_splash.webp'),
       ('6972639986a29', 'Sigewinne', 5, 4, 5, 5, 'https://gensh.honeyhunterworld.com/img/sigewinne_095_gacha_splash.webp'),
       ('697263ec666c4', 'Sangonomiya Kokomi', 5, 5, 3, 5, 'https://gensh.honeyhunterworld.com/img/kokomi_054_gacha_splash.webp'),
       ('69726411219c1', 'Citlali', 4, 5, 6, 5, 'https://gensh.honeyhunterworld.com/img/citlali_107_gacha_splash.webp'),
       ('697264359f944', 'Eula', 4, 2, 1, 5, 'https://gensh.honeyhunterworld.com/img/eula_051_gacha_splash.webp'),
       ('697264779539d', 'Qiqi', 4, 1, 2, 5, 'https://gensh.honeyhunterworld.com/img/qiqi_035_gacha_splash.webp'),
       ('6972649fcb983', 'Yumemizuki Mizuki', 1, 5, 3, 5, 'https://gensh.honeyhunterworld.com/img/mizuki_109_gacha_splash.webp'),
       ('697265181e809', 'Chasca', 1, 4, 6, 5, 'https://gensh.honeyhunterworld.com/img/chasca_104_gacha_splash.webp'),
       ('6972654b2cad4', 'Xianyun', 1, 5, 2, 5, 'https://gensh.honeyhunterworld.com/img/liuyun_093_gacha_splash.webp'),
       ('6972657671ab7', 'Lynette', 1, 1, 5, 4, 'https://gensh.honeyhunterworld.com/img/linette_083_gacha_splash.webp'),
       ('6972659e18230', 'Navia', 2, 2, 5, 5, 'https://gensh.honeyhunterworld.com/img/navia_091_gacha_splash.webp'),
       ('697265bfb4104', 'Chiori', 2, 1, 3, 5, 'https://gensh.honeyhunterworld.com/img/chiori_094_gacha_splash.webp'),
       ('697265e1d0c19', 'Wriothesley', 4, 5, 5, 5, 'https://gensh.honeyhunterworld.com/img/wriothesley_086_gacha_splash.webp');
