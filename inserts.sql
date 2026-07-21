-- ==============================================================
-- REGENERACIÓN FASE 2: TRAYECTORIA
-- Perfil ID: 1
-- ==============================================================

-- 1. Desactivar llaves foráneas temporalmente para limpiar tablas de forma segura
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `titulos_academicos`;
TRUNCATE TABLE `certificaciones`;
SET FOREIGN_KEY_CHECKS = 1;

-- --------------------------------------------------------------
-- A. EDUCACIÓN FORMAL (`titulos_academicos`)
-- --------------------------------------------------------------
-- Nota: Adaptamos los años del CV a objetos DATE ('YYYY-MM-DD'). 
-- Dejamos comuna_id como NULL o puedes actualizarlo con el ID de Santiago/Rancagua según corresponda.

INSERT INTO `titulos_academicos` 
    (`perfil_id`, `nombre_titulo`, `institucion`, `fecha_inicio`, `fecha_obtencion`, `comuna_id`, `estado`) 
VALUES 
    (1, 'Analista Programador', 'INACAP Rancagua', '2024-03-01', '2025-12-31', NULL, 1),
    (1, 'Licenciado en Sociología', 'Universidad de Chile', '2012-03-01', '2017-12-31', NULL, 1),
    (1, 'Bachiller en Ciencias Naturales y Exactas', 'Universidad de Chile', '2010-03-01', '2011-12-31', NULL, 1);


-- --------------------------------------------------------------
-- B. CERTIFICACIONES (`certificaciones`)
-- --------------------------------------------------------------
-- Mapeamos campos: nombre, organizacion, numero_horas, fecha_inicio, fecha_fin y descripcion.
-- Al ser cursos intensivos de Talento Digital ejecutados en años específicos, estimamos fechas base.

INSERT INTO `certificaciones` 
    (`perfil_id`, `nombre`, `organizacion`, `numero_horas`, `descripcion`, `fecha_inicio`, `fecha_fin`, `url_certificado`, `estado`) 
VALUES 
    (
        1, 
        'Hacking Ético en Aplicativos Web', 
        'OTEC Sustantiva (Talento Digital)', 
        208, 
        'Especialización en seguridad informática defensiva y ofensiva enfocada en la detección y mitigación de vulnerabilidades críticas en entornos web corporativos.', 
        '2025-01-01', '2025-04-30', NULL, 1
    ),
    (
        1, 
        'Desarrollador Web Full Stack Python', 
        'OTEC Praxis (Talento Digital)', 
        428, 
        'Programa intensivo de formación técnica cubriendo el ciclo completo de desarrollo de software web con énfasis en arquitectura backend utilizando Python y Django.', 
        '2024-01-01', '2024-08-31', NULL, 1
    ),
    (
        1, 
        'Desarrollador Web Full Stack JavaScript', 
        'OTEC Sustantiva (Talento Digital)', 
        472, 
        'Especialización en la construcción de interfaces interactivas asíncronas y lógica de servidores utilizando JavaScript, herramientas modernas y bases de datos relacionales.', 
        '2023-03-01', '2023-11-30', NULL, 1
    );

-- ==============================================================
-- FASE 3: STACK TÉCNICO (Catálogo desde Cero)
-- ==============================================================

-- 1. Desactivar llaves foráneas para poder reiniciar (TRUNCATE) sin errores
SET FOREIGN_KEY_CHECKS = 0;

-- 2. Vaciar las tablas desde cero (elimina datos y reinicia el AUTO_INCREMENT)
TRUNCATE TABLE `proyectos_tecnologias`;
TRUNCATE TABLE `tecnologias`;

-- 3. Reactivar llaves foráneas por seguridad
SET FOREIGN_KEY_CHECKS = 1;

-- 4. Inserción del nuevo catálogo optimizado (Basado en el CV Final)
-- Categorías sugeridas (tipo): 
-- 14 = Infraestructura/OS | 21 = Frontend | 22 = Backend/Lenguajes | 23 = Base de Datos | 31 = Seguridad | 41 = IA & Data

INSERT INTO `tecnologias` (`nombre`, `ruta_icono`, `tipo`, `estado`) VALUES 
-- -----------------------------------------
-- A. FRONTEND / PRESENTACIÓN (Tipo 21)
-- -----------------------------------------
('HTML5', 'html5', 21, 1),
('CSS3 / SaSS', 'css3', 21, 1),
('JavaScript (Vanilla)', 'javascript', 21, 1),
('React', 'react', 21, 1),
('jQuery', 'jquery', 21, 1),
('Vite (Asset Bundler)', 'vite', 21, 1),

-- -----------------------------------------
-- B. BACKEND Y LENGUAJES (Tipo 22)
-- -----------------------------------------
('Python', 'python', 22, 1),
('PHP', 'php', 22, 1),
('Bash (Scripting)', 'bash', 22, 1),
('Laravel 10', 'laravel', 22, 1),
('Django', 'django', 22, 1),
('Express', 'express', 22, 1),

-- -----------------------------------------
-- C. BASES DE DATOS (Tipo 23)
-- -----------------------------------------
('MySQL', 'mysql', 23, 1),
('PostgreSQL', 'postgresql', 23, 1),
('SQLite', 'sqlite', 23, 1),

-- -----------------------------------------
-- D. INFRAESTRUCTURA, CLOUD Y OS (Tipo 14)
-- -----------------------------------------
('Git', 'git', 14, 1),
('cPanel', 'cpanel', 14, 1),
('Nginx', 'nginx', 14, 1),
('Apache', 'apache', 14, 1),
('AWS EC2', 'aws', 14, 1),
('Azure VM', 'azure', 14, 1),
('Google Cloud Platform (GCP)', 'gcp', 14, 1),
('Cron Jobs (Automatización)', 'cron', 14, 1),
('Linux (Kali / Raspberry Pi OS)', 'linux', 14, 1),
('Windows 11 / Server 2019', 'windows', 14, 1),

-- -----------------------------------------
-- E. SEGURIDAD WEB (Tipo 31)
-- -----------------------------------------
('Securización de Infraestructura', 'security', 31, 1),
('Prevención Inyección SQL', 'sqli', 31, 1),
('Ofuscación de Rutas', 'security', 31, 1),
('Autenticación JWT', 'jwt', 31, 1),

-- -----------------------------------------
-- F. INTELIGENCIA ARTIFICIAL Y DATOS (Tipo 41)
-- -----------------------------------------
('AI-Assisted Development (Gemini)', 'ai', 41, 1),
('Context Engineering (Handoff)', 'ai', 41, 1),
('Prompt Chaining', 'ai', 41, 1),
('Visión Computacional (YOLOv8)', 'yolo', 41, 1),
('OpenCV', 'opencv', 41, 1),
('Entrenamiento de Modelos ML', 'ml', 41, 1),
('Jupyter Notebooks', 'jupyter', 41, 1);

-- ==============================================================
-- FASE 4: EXPERIENCIA LABORAL
-- Perfil ID: 1
-- ==============================================================

-- 1. Limpieza de la tabla por seguridad
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `experiencias_laborales`;
SET FOREIGN_KEY_CHECKS = 1;

-- 2. Inserción de registros cronológicos (Inverso)
INSERT INTO `experiencias_laborales` 
    (`perfil_id`, `organizacion`, `cargo`, `descripcion`, `fecha_inicio`, `fecha_fin`, `es_trabajo_actual`, `comuna_id`, `estado`) 
VALUES 
    (
        1, 
        'Keyframe (Independiente)', 
        'Desarrollador Full Stack', 
        '<ul>
            <li>Diseñé y desarrollé desde cero un CMS (Content Management System) personalizado bajo arquitectura MVC utilizando Laravel 10 y PHP 8.2 para la digitalización del portafolio y servicios de una empresa de animación.</li>
            <li>Aceleré los ciclos de desarrollo y debugging mediante AI-Assisted Development (Gemini 3.1), aplicando técnicas de Prompt Chaining y gestión avanzada de contexto mediante archivos Handoff para garantizar la coherencia arquitectónica del código generado en múltiples sesiones.</li>
            <li>Implementé un sistema de autenticación single-tenant con ofuscación dinámica de rutas (Security through Obscurity) para el panel de administración, mitigando activamente el escaneo de bots automatizados.</li>
            <li>Ejecuté procesos de Hardening de infraestructura a nivel de servidor (cPanel), configurando permisos estrictos de directorios y bloqueando la descarga directa de recursos para proteger la integridad del sistema.</li>
            <li>Aplicó principios de seguridad web defensiva en el código fuente (PHP), sanitizando entradas y transacciones para prevenir ataques de inyección SQL y restringir la ejecución de reverse shells.</li>
            <li>Desarrollé una interfaz de usuario asíncrona mediante Vanilla JS, SCSS y Vite, integrando filtrado dinámico, microinteracciones y lógica condicional para el despliegue de pasarelas de pago (PayPal y Patreon).</li>
            <li>Diseñé el modelo de datos relacional en MySQL y gestioné el despliegue a producción, manteniendo un control de versiones riguroso con Git y una trazabilidad técnica exhaustiva.</li>
        </ul>', 
        '2026-03-01', NULL, 1, NULL, 1
    ),
    (
        1, 
        'OTEC Sustantiva (Online)', 
        'Ayudante Bootcamp Full Stack Java', 
        '<ul>
            <li>Apoyo técnico, administrativo y acompañamiento en sala al relator del curso Bootcamp Full Stack Java de Talento Digital.</li>
            <li>Resolución de inquietudes técnicas de los estudiantes en relación a clases sincrónicas, contenido interactivo, evaluaciones y trabajos prácticos del bootcamp.</li>
            <li>Revisión y evaluación analítica de las actividades prácticas de los estudiantes en la plataforma del curso.</li>
            <li>Realización de sesiones de ayudantía técnica guiada para reforzar los conceptos complejos de programación en Java y arquitectura de software del bootcamp.</li>
        </ul>', 
        '2026-02-01', '2026-06-30', 0, NULL, 1
    ),
    (
        1, 
        'Ilustre Municipalidad de Rancagua (Rancagua, Chile)', 
        'Desarrollador Full Stack', 
        '<ul>
            <li>Diseñé y desarrollé soluciones tecnológicas a medida para la modernización y transformación digital de procesos operativos en el sector público.</li>
            <li>Lideré el levantamiento técnico de requerimientos mediante reuniones directas con las contrapartes institucionales, traduciendo necesidades operativas en especificaciones técnicas de software.</li>
            <li>Estructuré y modelé bases de datos relacionales robustas bajo motores SQL para garantizar la persistencia e integridad de la información gubernamental.</li>
            <li>Programé la arquitectura completa (backend y frontend) de una plataforma interactiva de mesa de ayuda interna para optimizar la gestión y resolución de incidentes en departamentos municipales.</li>
            <li>Desarrollé dashboards dinámicos de analítica e indicadores integrando la librería DataTables para acelerar el despliegue de información estructurada y agilizar la toma de decisiones.</li>
            <li>Ganticé la usabilidad y experiencia de usuario (UX/UI) mediante un diseño web responsivo e interfaces intuitivas enfocadas en el funcionario público.</li>
            <li>Administré la infraestructura de servidores y orquesté el despliegue de aplicaciones a producción utilizando entornos Linux y repositorios Git.</li>
        </ul>', 
        '2025-08-01', '2025-12-31', 0, NULL, 1
    ),
    (
        1, 
        'Fondo Acelera INACAP (Rancagua, Chile)', 
        'Desarrollador Python / Investigador I+D (MVP Estimafrut)', 
        '<ul>
            <li>Lideré la investigación técnica y el desarrollo del Producto Mínimo Viable (MVP) "Estimafrut" financiado con fondos institucionales, orientado a la modernización tecnológica del sector agroindustrial (AgriTech).</li>
            <li>Diseñé e implementé un modelo de Machine Learning de visión computacional utilizando Python, YOLOv8 (Ultralytics) y OpenCV para la detección automatizada de estructuras frutales (dardos de cerezo).</li>
            <li>Ejecuté el ciclo completo de ingeniería de datos, abarcando la recopilación, limpieza y anotación estructurada de un dataset fotográfico propietario para el entrenamiento de la red neuronal.</li>
            <li>Aprovisioné y configuré entornos de desarrollo en la nube utilizando Google Cloud Platform (GCP) y Jupyter Notebooks, optimizando los recursos de cómputo para la ejecución y entrenamiento iterativo del modelo.</li>
            <li>Definí y documenté protocolos estrictos de captura fotográfica masiva para los operarios, mitigando falsos positivos mediante el control de la exposición lumínica, distancia de enfoque y supresión de ruido visual.</li>
        </ul>', 
        '2025-05-01', '2025-11-30', 0, NULL, 1
    ),
    (
        1, 
        'Creactiva Animaciones (Independiente)', 
        'Desarrollador Full Stack', 
        '<ul>
            <li>Desarrollé e implementé desde cero una aplicación web e-commerce responsiva utilizando Python (Django) para la digitalización de procesos de venta y capacitación técnica.</li>
            <li>Programé reglas de negocio complejas y automaticé planes de pago por suscripción mediante la integración segura de la pasarela WebPay de Transbank.</li>
            <li>Diseñé el sistema de autenticación de usuarios implementando JWT (JSON Web Tokens) para la validación segura de correos electrónicos en los nuevos registros.</li>
            <li>Desarrollé un motor de mensajería transaccional en Django integrado nativamente con el servidor SMTP de cPanel, orquestando el envío automatizado de correos (bienvenida, confirmación y caducidad).</li>
            <li>Automaticé el control de vigencia de las suscripciones configurando tareas en segundo plano (Cron Jobs) a nivel de servidor Linux, garantizando la consistencia de los accesos.</li>
            <li>Diseñé e implementé la arquitectura de frontend dinámico utilizando JavaScript moderno (HTML5/CSS3) y jQuery para optimizar la interactividad.</li>
            <li>Integré la aplicación con el reproductor multimedia TechSmith Smart Player para la visualización fluida de videos interactivos desarrollados en Camtasia.</li>
            <li>Administré la infraestructura y despliegues de la plataforma en hosting cPanel y servidor web Nginx, manteniendo control de versiones riguroso con Git.</li>
        </ul>', 
        '2024-07-01', '2025-04-30', 0, NULL, 1
    );

-- ==============================================================
-- FASE 5: PORTAFOLIO DE PROYECTOS Y RELACIÓN DE TECNOLOGÍAS
-- Perfil ID: 1
-- ==============================================================

-- 1. Limpieza de tablas por seguridad para evitar duplicaciones
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `proyectos_tecnologias`;
TRUNCATE TABLE `proyectos`;
SET FOREIGN_KEY_CHECKS = 1;

-- --------------------------------------------------------------
-- PROYECTO 1: KEYFRAME CMS
-- --------------------------------------------------------------
INSERT INTO `proyectos` 
    (`perfil_id`, `nombre`, `descripcion`, `desafio`, `solucion`, `horas_trabajo`, `url_repositorio`, `url_produccion`, `fecha_realizacion`, `slug`, `estado`, `tipo`) 
VALUES 
    (
        1, 
        'Keyframe CMS', 
        'Sistema de gestión de contenidos personalizado diseñado bajo arquitectura MVC para la digitalización integral del portafolio y servicios de una empresa de animación.',
        'Proteger un panel de administración expuesto a internet contra ataques automatizados de bots, escaneos de fuerza bruta y vulnerabilidades comunes en el manejo de datos, optimizando al mismo tiempo la velocidad de entrega del pipeline de desarrollo.',
        'Desarrollo del motor CMS utilizando Laravel 10 y PHP. Se implementó lógica de autenticación single-tenant reforzada con ofuscación dinámica de rutas de acceso (Security through Obscurity). En el servidor (cPanel), se aplicaron procesos de Hardening mediante la restricción estricta de permisos de directorios y bloqueo de descargas directas de recursos. A nivel de código, se sanitizaron todas las transacciones para anular vectores de inyección SQL y restringir la ejecución de reverse shells. El ciclo de desarrollo y debugging complejo fue acelerado estratégicamente mediante Prompt Chaining e ingeniería de contexto (archivos Handoff) con agentes LLM (Gemini 3.1), construyendo un frontend interactivo asíncrono con Vanilla JS, SCSS y Vite que integra pasarelas de pago como PayPal y Patreon.',
        120, 
        null, 
        'https://www.keyframe.cl/', 
        '2026-03-01', 
        'keyframe-cms', 
        1,
        1
    );

-- Capturamos el ID del proyecto recién insertado
SET @proyecto_keyframe = LAST_INSERT_ID();

-- Asociamos tecnologías al Proyecto 1 (Basado en nombres exactos del catálogo Fase 3)
INSERT INTO `proyectos_tecnologias` (`proyecto_id`, `tecnologia_id`, `prioridad`, `estado`)
SELECT @proyecto_keyframe, id, 1, 1 FROM `tecnologias` 
WHERE nombre IN ('PHP', 'Laravel 10', 'MySQL', 'JavaScript (Vanilla)', 'CSS3 / SaSS', 'Vite (Asset Bundler)', 'Git', 'cPanel', 'Nginx', 'Securización de Infraestructura', 'Prevención Inyección SQL', 'Ofuscación de Rutas', 'AI-Assisted Development (Gemini)', 'Context Engineering (Handoff)', 'Prompt Chaining');


-- --------------------------------------------------------------
-- PROYECTO 2: ESTIMAFRUT (MVP AGRITECH)
-- --------------------------------------------------------------
INSERT INTO `proyectos` 
    (`perfil_id`, `nombre`, `descripcion`, `desafio`, `solucion`, `horas_trabajo`, `url_repositorio`, `url_produccion`, `fecha_realizacion`, `slug`, `estado`, `tipo`) 
VALUES 
    (
        1, 
        'Estimafrut - MVP Visión Computacional', 
        'Producto Mínimo Viable (MVP) enfocado en I+D agroindustrial para la modernización y automatización de procesos agrícolas mediante inteligencia artificial.',
        'Construir un modelo de reconocimiento visual de alta fidelidad capaz de identificar con precisión estructuras complejas en huertos frutales (dardos de cerezo), superando el ruido visual en terreno y las variaciones extremas de iluminación ambiental.',
        'Diseño y entrenamiento de un modelo de visión computacional estado del arte utilizando YOLOv8 (Ultralytics) y Python. Se construyó el ciclo de ingeniería de datos desde cero, abarcando la recopilación, limpieza y curación de un dataset fotográfico propietario. Para acelerar el pipeline de entrenamiento sin comprometer la máquina local, se aprovisionaron y configuraron instancias de alto cómputo en la nube usando Google Cloud Platform (GCP) junto a Jupyter Notebooks. Adicionalmente, se programaron scripts con OpenCV para la manipulación de imágenes y se redactaron protocolos estrictos de captura fotográfica masiva para controlar el enfoque y la exposición lumínica en terreno, mitigando drásticamente la tasa de falsos positivos.',
        90, 
        NULL, 
        NULL, 
        '2025-05-01', 
        'estimafrut-agritech', 
        1,
        2
    );

SET @proyecto_estimafrut = LAST_INSERT_ID();

-- Asociamos tecnologías al Proyecto 2
INSERT INTO `proyectos_tecnologias` (`proyecto_id`, `tecnologia_id`, `prioridad`, `estado`)
SELECT @proyecto_estimafrut, id, 1, 1 FROM `tecnologias` 
WHERE nombre IN ('Python', 'Google Cloud Platform (GCP)', 'Visión Computacional (YOLOv8)', 'OpenCV', 'Entrenamiento de Modelos ML', 'Jupyter Notebooks', 'Git');

-- ==============================================================
-- FASE 5: PORTAFOLIO DE PROYECTOS Y RELACIÓN DE TECNOLOGÍAS
-- Perfil ID: 1
-- ==============================================================

-- 1. Limpieza de tablas por seguridad para evitar duplicaciones
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `proyectos_tecnologias`;
TRUNCATE TABLE `proyectos`;
SET FOREIGN_KEY_CHECKS = 1;

-- --------------------------------------------------------------
-- PROYECTO 3: CREACTIVA E-COMMERCE
-- --------------------------------------------------------------

INSERT INTO `proyectos` 
    (`perfil_id`, `nombre`, `descripcion`, `desafio`, `solucion`, `horas_trabajo`, `url_repositorio`, `url_produccion`, `fecha_realizacion`, `slug`, `estado`, `tipo`) 
VALUES 
    (
        1, 
        'Creactiva Animaciones', 
        'Plataforma completa de academia digital responsiva orientada a la venta de contenido educativo interactivo por suscripción y capacitaciones técnicas a pedido.',
        'Automatizar de forma segura el control de vigencia de planes de suscripción, gestionar motores de mensajería con servidores de correo y garantizar un flujo transaccional y de autenticación blindado para los usuarios.',
        'Desarrollo backend robusto en Python utilizando el framework Django. Se implementaron flujos transaccionales mediante la integración de la pasarela WebPay de Transbank. La seguridad de la sesión se resolvió mediante autenticación JWT (JSON Web Tokens) para validar correos de usuarios nuevos. El ciclo de vida de las suscripciones se automatizó configurando tareas programadas en segundo plano (Cron Jobs) a nivel del servidor Linux, interactuando con bases de datos relacionales. La comunicación externa se orquestó programando un módulo SMTP conectado de forma nativa al servidor de correos de cPanel, despachando alertas automáticas basadas en eventos de negocio (registros, compras exitosas y caducidades). El frontend se potenció con jQuery para dinamizar la interactividad.',
        150, 
        null, 
        'https://www.creactivaanimaciones.cl', 
        '2024-07-01', 
        'creactiva-ecommerce', 
        1,
        1
    );

SET @proyecto_creactiva = LAST_INSERT_ID();

-- Asociamos tecnologías al Proyecto 3
INSERT INTO `proyectos_tecnologias` (`proyecto_id`, `tecnologia_id`, `prioridad`, `estado`)
SELECT @proyecto_creactiva, id, 1, 1 FROM `tecnologias` 
WHERE nombre IN ('Python', 'Django', 'SQLite', 'JavaScript (Vanilla)', 'jQuery', 'Git', 'cPanel', 'Nginx', 'Apache', 'Cron Jobs (Automatización)', 'Linux (Kali / Raspberry Pi OS)', 'Autenticación JWT');