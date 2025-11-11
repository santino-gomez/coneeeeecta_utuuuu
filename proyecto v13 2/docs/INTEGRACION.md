# Guía de integración

Sigue estos pasos para desplegar los cambios en tu entorno sin perder la base existente.

## 1. Preparar el entorno
1. Copia todo el contenido de esta versión sobre tu instancia local del proyecto.
2. Crea el archivo `.env` a partir de `.env.example` y ajusta las credenciales de la base de datos.
3. Ejecuta `composer install` (si es necesario) y `composer dump-autoload` para regenerar el autoload.

## 2. Migrar la base de datos
1. Respaldar tu base de datos actual (`mysqldump ... > backup.sql`).
2. Actualizar la estructura siguiendo `database/BaseDatos.sql` (ver sección siguiente para nuevas tablas/campos).
3. Ajustar nombres de tablas/columnas si tu esquema previo difiere: respeta las claves primarias y foráneas existentes.

### Cambios relevantes en la BD
- Campos extra en `usuario`: `perfil_publico_json`, `usuario_activo`, `codigo_verificacion`, `codigo_expira`, `codigo_verificado`.
- Tablas nuevas sugeridas: `post_reaccion`, `orientacion_resultado`, `empresa_usuario_contacto` (pendientes de crear según necesidades específicas).
- Los modelos utilizan PDO y esperan nombres de columnas en minúsculas con guiones bajos (ver `app/Models`).

## 3. Revisar configuración de rutas y vistas
- El nuevo front controller se ubica en `public/index.php` y utiliza el router de `routes/web.php`.
- Vistas migradas a `resources/views` conservan el diseño original y amplían secciones nuevas (perfil, comunidad, vocacional, oportunidades).
- Mantén los assets en `public/` (CSS, JS, imágenes); se añadió `public/css/auth.css` y `public/css/profile.css`.

## 4. Conectar módulos existentes
- Formularios antiguos pueden reutilizarse apuntando a las nuevas rutas (`/login`, `/registro`, `/perfil`, `/comunidad`, `/oportunidades`, `/vocacional`).
- Si mantienes scripts heredados, ve migrándolos gradualmente a controladores bajo `app/Controllers`.
- Para funcionalidades no implementadas aún (ej. comentarios, reacciones, panel admin) crea controladores y vistas siguiendo los patrones existentes.

## 5. Pruebas recomendadas
- Validar acceso al home (`/`), login y registro.
- Confirmar que el test vocacional procesa respuestas y genera recomendaciones.
- Revisar creación de publicaciones en comunidad y alta de oportunidades.
- Ejecutar análisis estático (PHPStan/Psalm) y pruebas unitarias cuando se incorporen.

## 6. Próximos pasos sugeridos
- Implementar middlewares para proteger rutas según rol.
- Añadir sistema de archivos para portafolios (almacenamiento y descarga de documentos).
- Integrar motor de recomendaciones conectando resultados del test con oportunidades filtradas.
- Documentar API REST/JSON para integraciones futuras.

Esta guía es una base inicial; ajústala a tu flujo de trabajo y al roadmap aprobado por el equipo.
