-- Configuración inicial para soportar acentos y caracteres especiales
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0; -- Desactivar chequeo temporalmente para evitar errores en creación

-- -----------------------------------------------------
-- 1. TABLAS DE UBICACIÓN (Maestras)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `regiones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `comunas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `region_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comunas_regiones_idx` (`region_id` ASC),
  CONSTRAINT `fk_comunas_regiones`
    FOREIGN KEY (`region_id`)
    REFERENCES `regiones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- 2. USUARIOS Y PERFIL (Seguridad y Datos Personales)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `run` VARCHAR(10) NOT NULL UNIQUE,
  `correo` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `nombres` VARCHAR(100) NOT NULL,
  `apellido_paterno` VARCHAR(100) NOT NULL,
  `apellido_materno` VARCHAR(100) NOT NULL,
  `rol_id` INT(1) NOT NULL DEFAULT 1,
  `fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `ultima_actualizacion` DATETIME NULL,
  `estado` INT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `perfil_profesional` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `ocupacion` VARCHAR(200),
  `biografia` TEXT,
  `telefono` VARCHAR(9),
  `esta_disponible` TINYINT(1),
  `estado` INT(1),
  PRIMARY KEY (`id`),
  INDEX `fk_perfil_usuario_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_perfil_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `links_redes_sociales` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `perfil_id` INT NOT NULL,
  `nombre_red` VARCHAR(50) NOT NULL, -- Ej: LinkedIn, GitHub
  `url` VARCHAR(255) NOT NULL,
  `icono_class` VARCHAR(50), -- Ej: 'fab fa-linkedin' (FontAwesome)
  `estado` INT(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_links_perfil`
    FOREIGN KEY (`perfil_id`)
    REFERENCES `perfil_profesional` (`id`)
    ON DELETE CASCADE
);

-- -----------------------------------------------------
-- 3. TRAYECTORIA (Experiencia y Educación)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `experiencias_laborales` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `perfil_id` INT NOT NULL,
  `organizacion` VARCHAR(200) NOT NULL,
  `cargo` VARCHAR(100) NOT NULL,
  `descripcion` TEXT,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NULL, -- NULL significa "Actualmente"
  `es_trabajo_actual` TINYINT(1) DEFAULT 0,
  `comuna_id` INT NULL,
  `estado` INT(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_exp_perfil`
    FOREIGN KEY (`perfil_id`) REFERENCES `perfil_profesional` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_exp_comuna`
    FOREIGN KEY (`comuna_id`) REFERENCES `comunas` (`id`)
);

CREATE TABLE IF NOT EXISTS `titulos_academicos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `perfil_id` INT NOT NULL,
  `nombre_titulo` VARCHAR(200) NOT NULL,
  `institucion` VARCHAR(200) NOT NULL,
  `fecha_inicio` DATE,
  `fecha_obtencion` DATE,
  `comuna_id` INT NULL,
  `estado` INT(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_titulos_perfil`
    FOREIGN KEY (`perfil_id`) REFERENCES `perfil_profesional` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_titulos_comuna`
    FOREIGN KEY (`comuna_id`) REFERENCES `comunas` (`id`)
);

CREATE TABLE IF NOT EXISTS `certificaciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `perfil_id` INT NOT NULL,
  `nombre` VARCHAR(200) NOT NULL,
  `organizacion` VARCHAR(200) NOT NULL,
  `numero_horas` INT NOT NULL,
  `descripcion` TEXT,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NULL,
  `url_certificado` VARCHAR(255),
  `comuna_id` INT NULL,
  `estado` INT(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_cert_perfil`
    FOREIGN KEY (`perfil_id`) REFERENCES `perfil_profesional` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cert_comuna`
    FOREIGN KEY (`comuna_id`) REFERENCES `comunas` (`id`)
);

CREATE TABLE IF NOT EXISTS `documentos_profesionales` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `perfil_id` INT NOT NULL,
  `nombre_archivo` VARCHAR(100) NOT NULL,
  `ruta_archivo` VARCHAR(255) NOT NULL,
  `extension` VARCHAR(10) NOT NULL,
  `hash_archivo` VARCHAR(255) NOT NULL,
  `es_cv` TINYINT(1) DEFAULT 0,
  `es_foto_perfil` TINYINT(1) DEFAULT 0,
  `estado` INT DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_docs_perfil`
    FOREIGN KEY (`perfil_id`)
    REFERENCES `perfil_profesional` (`id`)
    ON DELETE CASCADE
);

-- -----------------------------------------------------
-- 4. PROYECTOS (El Core del Portafolio)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `perfil_id` INT NOT NULL,
  `nombre` VARCHAR(200) NOT NULL,
  `descripcion` TEXT,
  `desafio` TEXT,
  `solucion` TEXT,
  `horas_trabajo` INT,
  `url_repositorio` VARCHAR(255),
  `url_produccion` VARCHAR(255),
  `fecha_realizacion` DATE,
  `slug` VARCHAR(255) DEFAULT NULL,
  `estado` INT DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_proyectos_perfil`
    FOREIGN KEY (`perfil_id`) REFERENCES `perfil_profesional` (`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `documentos_proyectos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `proyecto_id` INT NOT NULL,
  `nombre_archivo` VARCHAR(100) NOT NULL,
  `ruta_archivo` VARCHAR(255) NOT NULL,
  `extension` VARCHAR(10) NOT NULL,
  `hash_archivo` VARCHAR(255) NOT NULL,
  `es_portada` TINYINT(1) DEFAULT 0,
  `es_demo` TINYINT(1) DEFAULT 0,
  `estado` INT DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_docs_proyecto`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `proyectos` (`id`)
    ON DELETE CASCADE
);


-- -----------------------------------------------------
-- 5. CATEGORIZACIÓN (Tecnologías vs Habilidades)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tecnologias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL, -- Ej: React, Python
  `icono_class` VARCHAR(50), -- Para iconos visuales
  `tipo` INT DEFAULT 1,
  `estado` INT DEFAULT 1,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `habilidades` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL, -- Ej: Liderazgo, Scrum
  `icono_class` VARCHAR(50), -- Para iconos visuales
  `tipo` ENUM('blanda', 'tecnica') DEFAULT 'tecnica',
  `estado` INT DEFAULT 1,
  PRIMARY KEY (`id`)
);

-- Tablas pivote (Muchos a Muchos)
CREATE TABLE IF NOT EXISTS `proyectos_tecnologias` (
  `proyecto_id` INT NOT NULL,
  `tecnologia_id` INT NOT NULL,
  `estado` INT DEFAULT 1,
  PRIMARY KEY (`proyecto_id`, `tecnologia_id`),
  CONSTRAINT `fk_pt_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pt_tecnologia` FOREIGN KEY (`tecnologia_id`) REFERENCES `tecnologias` (`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `proyectos_habilidades` (
  `proyecto_id` INT NOT NULL,
  `habilidad_id` INT NOT NULL,
  `estado` INT DEFAULT 1,
  PRIMARY KEY (`proyecto_id`, `habilidad_id`),
  CONSTRAINT `fk_ph_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ph_habilidad` FOREIGN KEY (`habilidad_id`) REFERENCES `habilidades` (`id`) ON DELETE CASCADE
);

-- -----------------------------------------------------
-- 6. CONTACTO (Leads)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_remitente` VARCHAR(200) NOT NULL,
  `correo_remitente` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(9),
  `asunto` VARCHAR(200),
  `detalle` TEXT NOT NULL,
  `fecha_envio` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `estado` INT DEFAULT 1,
  PRIMARY KEY (`id`)
);

-- -----------------------------------------------------
-- 7. HISTORIAL DE ACCESOS
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `historial_accesos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `fecha` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `tipo_accion` INT(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_usuario_historial`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE CASCADE
);

SET FOREIGN_KEY_CHECKS = 1; -- Reactivar chequeo de llaves foráneas

-- -------------------------------------------
-- 8. ÚLTIMOS CAMBIOS
-- -------------------------------------------
ALTER TABLE usuarios 
ADD COLUMN created_at TIMESTAMP NULL DEFAULT NULL, 
ADD COLUMN updated_at TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE proyectos 
ADD COLUMN created_at TIMESTAMP NULL DEFAULT NULL, 
ADD COLUMN updated_at TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE perfil_profesional 
ADD COLUMN created_at TIMESTAMP NULL DEFAULT NULL, 
ADD COLUMN updated_at TIMESTAMP NULL DEFAULT NULL;


-- -------------------------------------------
-- 9. INSERTS
-- -------------------------------------------
INSERT INTO `tecnologias` (`nombre`) VALUES 
('Laravel'), ('PHP'), ('MySQL'), ('Bootstrap'), ('Vue.js'), ('React');