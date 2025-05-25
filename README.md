# 🎬 Cinépolis - Aplicación Web de Cine

Una aplicación web moderna para la gestión de un cine, desarrollada con Laravel, PHP, JavaScript, HTML y Bootstrap.

## 📋 Tabla de Contenidos


- [🎬 Cinépolis - Aplicación Web de Cine](#-cinépolis---aplicación-web-de-cine)
  - [📋 Tabla de Contenidos](#-tabla-de-contenidos)
  - [🎯 ¿Qué es este proyecto?](#-qué-es-este-proyecto)
  - [✨ Características principales](#-características-principales)
  - [🔧 Requisitos previos](#-requisitos-previos)
    - [Para Windows:](#para-windows)
  - [🚀 Instalación paso a paso](#-instalación-paso-a-paso)
    - [Paso 1: Descargar el proyecto](#paso-1-descargar-el-proyecto)
    - [Paso 2: Instalar dependencias](#paso-2-instalar-dependencias)
    - [Paso 3: Configurar la base de datos](#paso-3-configurar-la-base-de-datos)
    - [Paso 4: Configurar Laravel](#paso-4-configurar-laravel)
    - [Paso 5: Iniciar la aplicación](#paso-5-iniciar-la-aplicación)
  - [🎮 Cómo usar la aplicación](#-cómo-usar-la-aplicación)
    - [Para usuarios finales:](#para-usuarios-finales)
    - [Navegación:](#navegación)
  - [📚 Tecnologías utilizadas](#-tecnologías-utilizadas)


## 🎯 ¿Qué es este proyecto?

**Cinépolis** es una aplicación web que simula el sitio web de un cine. Permite a los usuarios:

- Ver la cartelera de películas
- Consultar detalles de cada película
- Reservar entradas y seleccionar asientos
- Consultar eventos especiales
- Contactar con el cine


Es un proyecto educativo que demuestra cómo crear una aplicación web completa y funcional.

## ✨ Características principales

- 🎬 **Cartelera de películas** con información detallada
- 🎫 **Sistema de reservas** con selección de asientos
- 📅 **Gestión de eventos** especiales
- 📱 **Diseño responsive** (se adapta a móviles y tablets)
- 🌐 **Interfaz en gallego** (idioma regional de Galicia, España)
- 🎨 **Diseño moderno** con colores corporativos


## 🔧 Requisitos previos

Antes de instalar la aplicación, necesitas tener instalado en tu computadora:

### Para Windows:

1. **XAMPP** (incluye PHP, MySQL y Apache)

- Descarga desde: [https://www.apachefriends.org/](https://www.apachefriends.org/) - **Versión** recomendada: 8.1 o superior / **Composer** (gestor de dependencias de PHP)

- Descarga desde: [https://getcomposer.org/download/](https://getcomposer.org/download/)
   
- Sigue el instalador para Windows

2. **Git** (para descargar el código)

- Descarga desde: [https://git-scm.com/download/win](https://git-scm.com/download/win)


## 🚀 Instalación paso a paso

### Paso 1: Descargar el proyecto

1. **Abre la terminal o símbolo del sistema:**
- Windows: Presiona `Win + R`, escribe `cmd` y presiona Enter
  
2. **Navega a la carpeta donde quieres instalar el proyecto:**
- Ejemplo para Windows: cd C:\xampp\htdocs
  
3. **Descarga el proyecto desde GitHub:**
- git clone https://github.com/larissagerperangel/cinepolis.git
- cd cinepolis
  
### Paso 2: Instalar dependencias
**Instalar dependencias de PHP**
- composer install

### Paso 3: Configurar la base de datos

1. **Inicia XAMPP/MAMP:**
- Abre XAMPP Control Panel
- Inicia Apache y MySQL

2. **Crea la base de datos:**
- Ve a [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
- Haz clic en "Nueva" en el panel izquierdo
- Escribe el nombre: `cinepolis`
- Haz clic en "Crear"

### Paso 4: Configurar Laravel
- **Generar clave de aplicación:** php artisan key:generate

- **Ejecutar migraciones (crear tablas):** php artisan migrate

- **Llenar la base de datos con datos:** php artisan db:seed
  
### Paso 5: Iniciar la aplicación
- **Iniciar el servidor de desarrollo:** php artisan serve
- **¡Listo!** Ahora puedes abrir tu navegador haciendo ctrl+click en la url [http://localhost:8000](http://localhost:8000)

## 🎮 Cómo usar la aplicación

### Para usuarios finales:

1. **Página principal:** Muestra películas destacadas y eventos
2. **Cartelera:** Lista completa de películas con filtros por género
3. **Detalles de película:** Información completa, horarios y reparto
4. **Reservar entradas:** Selecciona día, hora y asientos
5. **Eventos:** Consulta eventos especiales del cine
6. **Contacto:** Formulario para enviar mensajes


### Navegación:

- Usa el menú superior para moverte entre secciones
- Los botones rojos son para acciones principales (comprar entradas)
- Los botones grises son para acciones secundarias (ver detalles)

## 📚 Tecnologías utilizadas

- **Backend:** Laravel 10 (PHP)
- **Frontend:** HTML, CSS, JavaScript, Bootstrap 
- **Base de datos:** MySQL
- **Iconos:** Font Awesome
- **Fuentes:** Google Fonts (Roboto)

**¡Gracias por usar Cinépolis!** 🎬✨