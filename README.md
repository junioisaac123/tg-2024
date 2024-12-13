# Prototipo de Videojuego Educativo de Matemáticas con Ajedrez

## Descripción del Proyecto

Este proyecto de grado presenta un prototipo de videojuego diseñado para complementar la enseñanza de matemáticas en estudiantes de segundo de primaria, utilizando el ajedrez como herramienta pedagógica y aplicando técnicas de computación emocional.

## Información General

- **Título**: Implementación de un prototipo de videojuego para complementar la enseñanza de la asignatura de matemáticas a estudiantes de segundo de primaria a través de la práctica sistemática de ajedrez utilizando técnicas de computación emocional
- **Tecnología Principal**: Laravel 11

## Requisitos Previos

- PHP 8.2 o superior
- Composer
- Node.js y npm
- Servidor web (Apache/Nginx)
- Base de datos MySQL

## Instalación

### Clonar el Repositorio

```bash
git clone https://github.com/junioisaac123/tg-2024.git
cd tg-2024
```

### Configuración del Entorno

1. Copiar archivo de configuración

```bash
cp .env.example .env
```

2. Instalar dependencias de PHP

```bash
composer install
```

3. Instalar dependencias de Node.js

```bash
npm install
npm run dev
```

4. Generar clave de aplicación

```bash
php artisan key:generate
```

5. Configurar base de datos

- Crear una base de datos nueva
- Configurar credenciales en el archivo `.env`
- Ejecutar migraciones

```bash
php artisan migrate
```

## Estructura del Proyecto

- `app/`: Lógica principal de la aplicación
- `config/`: Archivos de configuración
- `database/`: Migraciones y seeders
- `public/`: Recursos públicos
- `resources/`: Vistas y recursos frontend
- `routes/`: Definición de rutas de la aplicación

## Características Principales

- Integración de conceptos matemáticos con mecánicas de ajedrez
- Técnicas de computación emocional para personalización del aprendizaje
- Interfaz diseñada para niños de segundo de primaria
- Seguimiento del progreso académico y emocional

## Ejecución del Proyecto

```bash
php artisan serve
```

El proyecto estará disponible en `http://localhost:8000`

## Componentes Técnicos

- Framework: Laravel 11
- Frontend: Blade, Tailwind CSS
- Base de datos: MySQL

## Consideraciones Emocionales

El prototipo implementa técnicas de computación emocional para:

- Adaptar la dificultad según el estado emocional del estudiante
- Proporcionar retroalimentación personalizada
- Mantener la motivación del estudiante

## Contacto

- Autor: Isaac Junior Castellar Lopez
- Correo: <junior.castellar@correounivalle.edu.co>

---

> [!IMPORTANT]  
> Enlace para Probar la Aplicación
> La aplicación está desplegada en una instancia de AWS, que permanece apagada para optimizar
> recursos. Si deseas probar la aplicación, se debe proponer un día específico para encender la
> instancia y enviarlo a cualquiera de los siguientes correos:
> <jisaac197@gmail.com>
> <junior.castellar@correounivalle.edu.co>
