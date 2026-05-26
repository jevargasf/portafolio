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
  `estado` INT(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_cert_perfil`
    FOREIGN KEY (`perfil_id`) REFERENCES `perfil_profesional` (`id`) ON DELETE CASCADE
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
  `ruta_icono` VARCHAR(100), -- Para iconos visuales
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
  `prioridad` INT DEFAULT NULL,
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

-- -----------------------------------------------------
-- 7. BLOG
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `entradas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `extracto` VARCHAR(255) NOT NULL,
  `contenido` LONGTEXT,
  `fecha_publicacion` DATETIME,
  `scope` VARCHAR(20) NOT NULL,
  `estado` INT DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entradas_slug_unique` (`slug`),
  CONSTRAINT `fk_usuario_entrada`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `documentos_entradas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `entrada_id` INT NOT NULL,
  `nombre_archivo` VARCHAR(100) NOT NULL,
  `ruta_archivo` VARCHAR(255) NOT NULL,
  `extension` VARCHAR(10) NOT NULL,
  `hash_archivo` VARCHAR(255) NOT NULL,
  `es_portada` TINYINT(1) DEFAULT 0,
  `estado` INT DEFAULT 1,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_docs_entrada`
    FOREIGN KEY (`entrada_id`)
    REFERENCES `entradas` (`id`)
    ON DELETE CASCADE
);

-- -----------------------------------------------------
-- 8. SUSCRIPTORES NEWSLETTER
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `suscriptores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `correo` VARCHAR(255) UNIQUE NOT NULL,
  `timestamp_verificacion` DATETIME DEFAULT NULL,
  `estado` INT DEFAULT 1,
  PRIMARY KEY (`id`)
);

-- -------------------------------------------
-- I. ÚLTIMOS CAMBIOS
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
-- II. INSERTS
-- -------------------------------------------
INSERT INTO `tecnologias` (`nombre`, `ruta_icono`, `tipo`, `estado`) VALUES
-- ==========================================
-- 1. TECNOLOGÍAS DEL PROCESO
-- ==========================================

-- A. Diseño (11)
('Draw.io', 'drawio', 11, 1),
('Adobe Illustrator', 'illustrator', 11, 1),

-- B. Desarrollo (12)
('VS Code', 'vscode', 12, 1),
('Git', 'git', 12, 1),
('ESLint', 'eslint', 12, 1),
('Prettier', 'prettier', 12, 1),
('Sass', 'sass', 12, 1),
('Vite', 'vite', 12, 1),
('Composer', 'composer', 12, 1),
('npm', 'npm', 12, 1),
('pip', 'pip', 12, 1),

-- C. Pruebas (13)
('PHPUnit', 'phpunit', 13, 1),
('Pest', 'pest', 13, 1),
('Jest', 'jest', 13, 1),
('Vitest', 'vitest', 13, 1),
('Playwright', 'playwright', 13, 1),
('Cypress', 'cypress', 13, 1),

-- D. Producción (14)
('GitHub Actions', 'github-actions', 14, 1),
('Docker', 'docker', 14, 1),
('Nginx', 'nginx', 14, 1),
('Apache', 'apache', 14, 1),
('AWS', 'aws', 14, 1),
('Azure', 'azure', 14, 1),
('Cloudflare', 'cloudflare', 14, 1),
('Linux', 'linux', 14, 1),
('Raspberry Pi', 'raspberrypi', 14, 1),


-- ==========================================
-- 2. TECNOLOGÍAS DEL PROYECTO
-- ==========================================

-- A. Presentación (21)
('HTML5', 'html5', 21, 1),
('CSS3', 'css3', 21, 1),
('JavaScript', 'javascript', 21, 1),
('Blade Templates', 'blade', 21, 1),
('React', 'react', 21, 1),

-- B. Aplicación (22)
('PHP', 'php', 22, 1),
('Laravel', 'laravel', 22, 1),
('Node.js', 'nodejs', 22, 1),
('Express', 'express', 22, 1),
('Django', 'django', 22, 1),
('Python', 'python', 22, 1),
('Java', 'java', 22, 1),
('SpringBoot', 'springboot', 22, 1),

-- C. Persistencia (23)
('MySQL', 'mysql', 23, 1),
('PostgreSQL', 'postgresql', 23, 1),
('SQLite', 'sqlite', 23, 1),
('MongoDB', 'mongodb', 23, 1),
('Eloquent', 'eloquent', 23, 1),

-- D. Integración (24)
('WebPay', 'webpay', 24, 1),
('Mailgun', 'mailgun', 24, 1),
('Mailman', 'mailman', 24, 1),
('Auth0', 'auth0', 24, 1),
('WebSocket', 'websocket', 24, 1),
('JSON Web Token', 'jwt', 24, 1);


-- -------------------------------------------
-- 10. ALTERS
-- -------------------------------------------
alter table perfil_profesional add column `index_bio` varchar(255) default null;
alter table perfil_profesional add column `index_especialidad` varchar(255) default null;
alter table perfil_profesional add column `biografia_enfoque` varchar(255) default null;
