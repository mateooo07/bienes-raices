# Bienes Raíces - Sistema de Gestión Inmobiliaria

Plataforma web desarrollada en PHP para la administración integral de propiedades inmobiliarias con arquitectura MVC

## Descripción del Proyecto

Sistema web moderno para la gestión completa de bienes raíces, diseñado para inmobiliarias y agentes independientes. La plataforma permite administrar portafolios de propiedades, gestionar vendedores, y ofrecer una experiencia optimizada tanto para administradores como para usuarios finales que buscan propiedades.

**Características principales:**
- Catálogo completo de propiedades con sistema de búsqueda
- Panel administrativo para gestión de propiedades y vendedores
- Sistema de autenticación seguro para administradores
- Interfaz responsive optimizada para todos los dispositivos
- Blog integrado para contenido inmobiliario
- Páginas institucionales (Nosotros, Contacto)
- Gestión de imágenes de propiedades

## Tecnologías y Arquitectura

### Stack Tecnológico
- **Backend:** PHP 8.0+
- **Frontend:** HTML5, CSS3 (SCSS), JavaScript ES6
- **Base de datos:** MySQL 8.0+
- **Patrón de diseño:** MVC (Model-View-Controller)
- **Herramientas de build:** Gulp.js, Node.js
- **Gestión de dependencias:** Composer (PHP), npm (JavaScript)
- **Preprocesador CSS:** SASS/SCSS

### Arquitectura MVC
El proyecto implementa un patrón MVC robusto:
- **Models** → Lógica de negocio y acceso a datos (ActiveRecord, Propiedad, Vendedor, Admin)
- **Views** → Presentación y templates HTML
- **Controllers** → Manejo de requests y coordinación (LoginController, PropiedadController, VendedorController, PaginasController)

## Requisitos del Sistema

### Requisitos Mínimos
- PHP 8.0 o superior
- MySQL 8.0 o superior
- Node.js 16+ y npm
- Composer 2.0+
- Servidor web Apache/Nginx con URL rewriting

### Extensiones PHP Requeridas
- mysqli
- pdo_mysql
- mbstring
- json
- openssl
- gd (para manipulación de imágenes)

## Guía de Instalación

### 1. Clonar el Repositorio
```bash
git clone https://github.com/mateooo07/bienes-raices.git
cd bienes-raices
```

### 2. Instalar Dependencias PHP
```bash
composer install
```

### 3. Instalar Dependencias Node.js
```bash
npm install
```

### 4. Configurar Entorno
```bash
# Copiar archivo de configuración
cp .env.example .env

# Editar configuración según tu entorno
nano .env
```

### 5. Configurar Base de Datos
```bash
# Importar estructura de base de datos
mysql -u usuario -p nombre_bd < admin/bbdd/bienesraices_crud_propiedades.sql
mysql -u usuario -p nombre_bd < admin/bbdd/bienesraices_crud_usuarios.sql
mysql -u usuario -p nombre_bd < admin/bbdd/bienesraices_crud_vendedores.sql
```

### 6. Compilar Assets Frontend
```bash
# Desarrollo
npm run dev

# Producción
npm run build
```

## Estructura del Proyecto

```
bienesraices/
├── admin/                    # Panel administrativo
│   ├── propiedades/         # CRUD de propiedades
│   │   ├── actualizar.php
│   │   ├── borrar.php
│   │   ├── crear.php
│   │   └── index.php
│   ├── vendedores/          # CRUD de vendedores
│   └── bbdd/               # Scripts de base de datos
├── controllers/             # Controladores MVC
│   ├── LoginController.php
│   ├── PaginasController.php
│   ├── PropiedadController.php
│   └── VendedorController.php
├── models/                  # Modelos de datos
│   ├── ActiveRecord.php    # Clase base ORM
│   ├── Admin.php
│   ├── Propiedad.php
│   └── Vendedor.php
├── views/                   # Vistas y templates
│   ├── auth/               # Autenticación
│   ├── paginas/            # Páginas públicas
│   └── propiedades/        # Vistas de propiedades
├── public/                  # Archivos públicos
│   ├── build/              # Assets compilados
│   ├── css/
│   ├── img/
│   ├── js/
│   └── index.php           # Punto de entrada
├── includes/               # Archivos de configuración
│   ├── config/
│   ├── templates/
│   └── funciones.php
├── src/                    # Código fuente frontend
│   ├── js/
│   │   ├── app.js
│   │   └── modernizr.js
│   ├── scss/              # Estilos SASS
│   │   ├── base/
│   │   ├── internas/
│   │   ├── layout/
│   │   └── app.scss
│   └── img/
├── vendor/                 # Dependencias PHP
├── node_modules/          # Dependencias Node.js
├── .env.example           # Template de configuración
├── composer.json          # Dependencias PHP
├── package.json           # Dependencias Node.js
├── gulpfile.js           # Tareas de build
└── Router.php            # Enrutador personalizado
```

## Funcionalidades Principales

### Panel Administrativo
- **Gestión de Propiedades:** CRUD completo con subida de imágenes
- **Gestión de Vendedores:** Administración de agentes inmobiliarios
- **Autenticación Segura:** Sistema de login para administradores
- **Dashboard:** Vista general del sistema

### Frontend Público
- **Catálogo de Propiedades:** Listado con filtros y búsqueda
- **Detalle de Propiedad:** Vista completa con galería de imágenes
- **Blog Inmobiliario:** Sección de noticias y artículos
- **Páginas Institucionales:** Nosotros, Contacto
- **Diseño Responsive:** Optimizado para todos los dispositivos

## Configuración de la Base de Datos

### Estructura Principal
- **propiedades** - Información detallada de inmuebles
- **vendedores** - Datos de agentes inmobiliarios
- **usuarios** - Sistema de autenticación
- **imagenes** - Gestión de archivos multimedia

### Configuración de Conexión
Editar el archivo `.env`:

```env
DB_HOST=localhost
DB_NAME=bienes_raices
DB_USER=tu_usuario
DB_PASS=tu_contraseña
DB_CHARSET=utf8mb4
```

## Desarrollo Frontend

### Herramientas de Build
El proyecto utiliza Gulp para automatizar tareas:

```bash
# Desarrollo (watch mode)
gulp dev

# Compilar para producción
gulp build

# Optimizar imágenes
gulp images
```

### Estructura SCSS
```
src/scss/
├── base/           # Reset, variables, mixins
├── layout/         # Header, footer, navegación
├── internas/       # Páginas específicas
└── app.scss        # Archivo principal
```

## Flujo de Desarrollo

### Ramas de Trabajo
- `main` - Código estable en producción
- `develop` - Desarrollo activo
- `feature/*` - Nuevas funcionalidades
- `hotfix/*` - Correcciones urgentes

### Buenas Prácticas Git
```bash
# Crear rama para nueva feature
git checkout -b feature/nueva-funcionalidad

# Commits descriptivos
git commit -m "feat: agregar filtro de búsqueda por precio"

# Sincronizar con develop
git pull origin develop
git push origin feature/nueva-funcionalidad
```

## Seguridad

### Medidas Implementadas
- Sanitización de inputs con `filter_input()`
- Prepared statements para prevenir SQL injection
- Validación de tipos de archivos subidos
- Sistema de autenticación con sesiones seguras
- Configuración de headers de seguridad

### Validación de Datos
```php
// Ejemplo de validación
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "Email no válido";
}
```

## Despliegue

### Configuración del Servidor
1. Configurar virtual host en Apache/Nginx
2. Establecer permisos de archivos apropiados
3. Configurar SSL/HTTPS
4. Optimizar configuración de PHP

### Variables de Entorno Producción
```env
APP_ENV=production
DB_HOST=servidor_produccion
UPLOAD_MAX_SIZE=10M
```

## Testing

### Estructura de Pruebas
```bash
# Ejecutar pruebas unitarias
./vendor/bin/phpunit tests/

# Pruebas de integración
./vendor/bin/phpunit tests/Integration/
```

## Contribución al Proyecto

### Proceso de Contribución
1. Fork del repositorio
2. Crear rama de feature
3. Desarrollar y probar cambios
4. Commit con mensajes descriptivos
5. Abrir Pull Request

### Estándares de Código
- Seguir PSR-12 para PHP
- Documentar funciones y clases
- Escribir código autoexplicativo
- Mantener consistencia en naming

## Scripts Útiles

### Comandos Composer
```bash
composer install          # Instalar dependencias
composer update           # Actualizar dependencias
composer dump-autoload    # Regenerar autoloader
```

### Comandos NPM
```bash
npm install              # Instalar dependencias
npm run dev             # Modo desarrollo
npm run build           # Build producción
```

### Base de Datos
```bash
# Backup
mysqldump -u user -p bienes_raices > backup.sql

# Restaurar
mysql -u user -p bienes_raices < backup.sql
```

## Tecnologías y Librerías

### Backend
- **PHP 8+** - Lenguaje principal
- **MySQL 8** - Base de datos
- **Composer** - Gestión de dependencias

### Frontend
- **SCSS/SASS** - Preprocesador CSS
- **JavaScript ES6** - Funcionalidades interactivas
- **Gulp.js** - Automatización de tareas
- **Modernizr** - Detección de características del navegador

### Herramientas de Desarrollo
- **Git** - Control de versiones
- **npm** - Gestión de paquetes JavaScript
- **ESLint** - Linting JavaScript
- **Autoprefixer** - Prefijos CSS automáticos

## Licencia

Este proyecto está bajo la Licencia MIT - consultar el archivo `LICENSE` para más detalles.

## Autor y Mantenimiento

**Desarrollador:** mateooo07  
**Repositorio:** [https://github.com/mateooo07/bienes-raices](https://github.com/mateooo07/bienes-raices)  
**Última actualización:** Octubre 2025

## Soporte y Contacto

- **Issues:** [GitHub Issues](https://github.com/mateooo07/bienes-raices/issues)
- **Documentación:** Wiki del proyecto
- **Contribuciones:** Pull Requests bienvenidos

Para reportar bugs o solicitar nuevas funcionalidades, por favor utilizar el sistema de issues de GitHub con las etiquetas apropiadas.

---

*Este README proporciona una guía completa para el desarrollo, instalación y mantenimiento del sistema de gestión inmobiliaria. Para información específica sobre implementación, consultar la documentación técnica en la wiki del proyecto.*
