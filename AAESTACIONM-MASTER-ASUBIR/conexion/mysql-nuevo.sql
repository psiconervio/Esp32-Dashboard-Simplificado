//-----creacion de tabla esp32
CREATE TABLE `esp32_01_tableUpdate` (
    `id` varchar(255) NOT NULL,
    `temperature` float(10,2) NOT NULL,
    `humidity` int(3) NOT NULL,
    `status_read_sensor_dht11` varchar(255) NOT NULL,
    `veleta` varchar(255) NOT NULL,
    `anemometro` int(3) NOT NULL,
    `pluviometro` int(3) NOT NULL,
    `time` time NOT NULL,
    `date` date NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 //----Insercion prueba 
INSERT INTO `esp32_01_tableUpdate`(`id`, `temperature`, `humidity`, `status_read_sensor_dht11`, `veleta`, `anemometro`,`pluviometro`, `time`, `date`)
 VALUES ('esp32_01','0.00','0','SUCCESS','norte','0','0',NOW(),NOW())


//---actualizador de tabla
CREATE TABLE `esp32_table_dht11_leds_record` (
    `id` varchar(255) NOT NULL,
    `board` varchar(255) NOT NULL,
    `temperature` float(10,2) NOT NULL,
    `humidity` int(3) NOT NULL,
    `status_read_sensor_dht11` varchar(255) NOT NULL,
    `LED_01` varchar(255) NOT NULL,
    `LED_02` varchar(255) NOT NULL,
    `time` time NOT NULL,
    `date` date NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
//---------------------------------------- 