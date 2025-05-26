# 🎬 Cinépolis - Aplicación Web de Cine

Unha aplicación web moderna para a xestión dun cine, desarrollada con Laravel, PHP, JavaScript, HTML e Bootstrap.

## 📋 Tabla de Contidos


- [🎬 Cinépolis - Aplicación Web de Cine](#-cinépolis---aplicación-web-de-cine)
  - [📋 Tabla de Contidos](#-tabla-de-contidos)
  - [🎯 Que é este proxecto?](#-que-é-este-proxecto)
  - [✨ Características principais](#-características-principais)
  - [🔧 Requisitos previos](#-requisitos-previos)
    - [Para Windows:](#para-windows)
  - [🚀 Instalación paso a paso](#-instalación-paso-a-paso)
    - [Paso 1: Descargar o proxecto](#paso-1-descargar-o-proxecto)
    - [Paso 2: Instalar dependencias](#paso-2-instalar-dependencias)
    - [Paso 3: Configurar a base de datos](#paso-3-configurar-a-base-de-datos)
    - [Paso 4: Configurar Laravel](#paso-4-configurar-laravel)
    - [Paso 5: Iniciar a aplicación](#paso-5-iniciar-a-aplicación)
  - [🎮 Cómo usar a aplicación](#-cómo-usar-a-aplicación)
    - [Para usuarios finais:](#para-usuarios-finais)
    - [Navegación:](#navegación)
  - [📚 Tecnoloxías utilizadas](#-tecnoloxías-utilizadas)


## 🎯 Que é este proxecto?

**Cinépolis** é una aplicación web que simula o sitio web dun cine. Permite aos usuarios:

- Ver a carteleira de películas
- Consultar detalles de cada película
- Reservar entradas e seleccionar asentos
- Consultar eventos especiais
- Contactar con cine


É un proxecto educativo sobre unha aplicación web completa e funcional.

## ✨ Características principais

- 🎬 **Carteleira de películas** con información detallada
- 🎫 **Sistema de reservas** con selección de asentos
- 📅 **Xestión de eventos** especiais
- 📱 **Diseño responsive** (adáptase a móviles e tablets)
- 🌐 **Interfaz en gallego** (idioma rexional de Galicia, España)
- 🎨 **Diseño moderno** con cores corporativos


## 🔧 Requisitos previos

Antes de instalar a aplicación, necesitas ter instalado na túa computadora:

### Para Windows:

1. **XAMPP** (incluye PHP, MySQL y Apache)

- Descarga desde: [https://www.apachefriends.org/](https://www.apachefriends.org/) - **Versión** recomendada: 8.1 o superior / **Composer** (xestor de dependencias de PHP)

- Descarga desde: [https://getcomposer.org/download/](https://getcomposer.org/download/)
   
- Sigue o instalador para Windows

2. **Git** (para descargar o código)

- Descarga desde: [https://git-scm.com/download/win](https://git-scm.com/download/win)


## 🚀 Instalación paso a paso

### Paso 1: Descargar o proxecto

1. **Abre a terminal ou símbolo do sistema:**
- Windows: Presiona `Win + R`, escribe `cmd` e presiona Enter
  
2. **Navega á carpeta onde queiras instalar o proxecto:**
- Ejemplo para Windows: cd C:\xampp\htdocs
  
3. **Descarga o proxecto desde GitHub:**
- git clone https://github.com/larissagerperangel/cinepolis.git
- cd cinepolis
  
### Paso 2: Instalar dependencias
**Instalar dependencias de PHP**
- composer install

### Paso 3: Configurar a base de datos

1. **Inicia XAMPP/MAMP:**
- Abre XAMPP Control Panel
- Inicia Apache y MySQL

2. **Crea a base de datos:**
- Vai a [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
- Fai clic en "Nueva" no panel esquerdo
- Escribe o nombre: `cinepolis`
- Fai clic en "Crear"

### Paso 4: Configurar Laravel
- **Xenerar clave de aplicación:** php artisan key:generate

- **Executar migraciones (crear tablas):** php artisan migrate

- **Executar os seeders (para ter datos na BD):** php artisan db:seed
  
### Paso 5: Iniciar a aplicación
- **Iniciar o servidor de desarrollo:** php artisan serve
- **¡Listo!** Agora podes abrir o teu navegador facendo ctrl+click na url [http://localhost:8000](http://localhost:8000)

## 🎮 Cómo usar a aplicación

### Para usuarios finais:

1. **Páxina principal:** Mostra películas destacadas e eventos
2. **Carteleira:** Lista completa de películas con filtros por xénero
3. **Detalles de película:** Información completa, horarios e reparto
4. **Reservar entradas:** Selecciona día, hora e asentos
5. **Eventos:** Consulta eventos especiais do cine
6. **Contacto:** Formulario para enviar mensaxes


### Navegación:

- Usa o menú superior para moverte entre secciones
- Os botóns vermllos son para accións principais (comprar entradas)
- Os botóns grises son para accións secundarias (ver detalles)

## 📚 Tecnoloxías utilizadas

- **Backend:** Laravel (PHP)
- **Frontend:** HTML, CSS, JavaScript, Bootstrap 
- **Base de datos:** MySQL
- **Iconos:** Font Awesome
- **Fuentes:** Google Fonts (Roboto)...

**¡Grazas por usar Cinépolis!** 🎬✨
