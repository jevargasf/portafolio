# Portafolio Profesional (Enfoque Socio-Técnico)

[Breve descripción del portafolio. Explica aquí la integración entre la sociología y el desarrollo de software, haciendo mención a tus protocolos de intervención (Tier 01 y Tier 02) detallados en `descripcion-personal.md`].

---

## 🛠️ Stack Tecnológico

- **Backend:** PHP 8.1+ / Laravel 10
- **Frontend:** HTML5, JavaScript (Vanilla), Sass (SCSS), Bootstrap 5.3
- **Herramientas de construcción:** Vite

---

## 📁 Estructura del Proyecto y Estilos

- **Vistas:** Ubicadas en `resources/views/` (plantillas Blade).
- **Estilos:** Ubicados en `resources/css/`.
  - La arquitectura de estilos sigue la metodología de modularización en Sass (abstracts, base, components, pages).
  - Consulta `design-tokens-manifesto.md` y `color-system-guidelines.md` en la raíz para comprender las directrices del sistema de diseño y paleta de colores.

---

## 🚀 Instalación y Configuración Local

Sigue estos pasos para levantar el entorno de desarrollo:

### 1. Clonar e Instalar Dependencias

```bash
# Instalar dependencias de PHP
composer install

# Instalar dependencias de Node.js
npm install
```

### 2. Configurar Entorno

1. Duplica el archivo `.env.example` y renómbralo a `.env`.
2. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```
3. Configura las variables de conexión a la base de datos en tu `.env`.

### 3. Base de Datos

Importa el esquema inicial desde el archivo SQL ubicado en la raíz:
- Archivo: `bbdd.sql`

---

## 💻 Comandos de Ejecución

Para iniciar el entorno de desarrollo local, ejecuta en terminales separadas:

```bash
# Iniciar servidor de backend Laravel
php artisan serve

# Iniciar servidor de desarrollo de Vite (compilación de assets en tiempo real)
npm run dev
```