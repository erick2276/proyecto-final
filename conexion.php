<?php
$host = "localhost"; 
$user = "root";      
$password = "";      
$database = "PagWeb"; 

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = <<<SQL
DROP TABLE IF EXISTS `calendario`;
CREATE TABLE `calendario` (
  `IDcal` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCal` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`IDcal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `evento`;
CREATE TABLE `evento` (
  `IDeve` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEve` varchar(100) NOT NULL,
  `nombreInv` varchar(100) NOT NULL,
  `apellidosInv` varchar(100) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `tema` varchar(100) NOT NULL,
  `correoInv` varchar(100) NOT NULL,
  `telefonoInv` varchar(50) NOT NULL,
  `edificio` varchar(50) NOT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFinal` time DEFAULT NULL,
  `evento_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDeve`),
  KEY `fk_calendario` (`evento_ID`),
  CONSTRAINT `fk_calendario` FOREIGN KEY (`evento_ID`) REFERENCES `calendario` (`IDcal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `listaalumn`;
CREATE TABLE `listaalumn` (
  `IDalumn` int(11) NOT NULL AUTO_INCREMENT,
  `apellidoPAlumn` varchar(100) NOT NULL,
  `apellidoMAlumn` varchar(100) NOT NULL,
  `nombreAlumn` varchar(100) NOT NULL,
  `numeroContrtol` int(11) NOT NULL,
  `grupoAlumn` varchar(20) DEFAULT NULL,
  `idlis` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDalumn`),
  KEY `idlis` (`idlis`),
  CONSTRAINT `listaalumn_ibfk_1` FOREIGN KEY (`idlis`) REFERENCES `listaprof` (`IDlist`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `listaprof`;
CREATE TABLE `listaprof` (
  `IDlist` int(11) NOT NULL AUTO_INCREMENT,
  `nombreProf` varchar(100) NOT NULL,
  `apellidosProf` varchar(100) NOT NULL,
  `correoProf` varchar(100) NOT NULL,
  `grupo` varchar(20) NOT NULL,
  `carrera` varchar(100) NOT NULL,
  `semestre` varchar(30) NOT NULL,
  PRIMARY KEY (`IDlist`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `registro`;
CREATE TABLE `registro` (
  `IDreg` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `oficina` varchar(50) DEFAULT NULL,
  `numEmpleado` int(11) NOT NULL,
  PRIMARY KEY (`IDreg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
SQL;

if ($conn->multi_query($sql)) {
    echo "Tablas creadas exitosamente";
} else {
    echo "Error al crear tablas: " . $conn->error;
}

$conn->close();
?>
