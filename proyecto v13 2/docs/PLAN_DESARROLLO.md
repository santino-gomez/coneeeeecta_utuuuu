# Plan de desarrollo Conecta UTU

Este plan describe la evolución propuesta para transformar la base existente en una plataforma modular preparada para escalar según los objetivos descritos en `Proyecto.pdf`.

## 1. Arquitectura y lineamientos

- **Patrón MVC modular**: la nueva estructura separa `app/Controllers`, `app/Models`, `app/Services` y `resources/views` con autoload PSR-4 para facilitar el mantenimiento.
- **Front controller y enrutador**: todo el tráfico HTTP pasa por `public/index.php`, que delega en el router (`App\Core\Router`) definido en `routes/web.php`.
- **Servicios reutilizables**: se añaden servicios dedicados para localización, orientación vocacional y futuras integraciones (ej. notificaciones, IA personalizada).
- **Configuración externa**: variables de entorno (`.env`) con respaldo en `config/database.php` permiten desplegar en distintos entornos sin modificar código.
- **Compatibilidad visual**: se mantienen los estilos originales como punto de partida, incorporando nuevos estilos temáticos (`auth.css`, `profile.css`) en la misma identidad gráfica.

## 2. Fases propuestas

### Fase 1 · Consolidación técnica (esta entrega)
- Implementar el front controller, router y helpers comunes.
- Migrar las vistas principales (`landing`, autenticación, perfil, comunidad, oportunidades, test vocacional) a `resources/views`.
- Crear modelos base (usuarios, empresas, ofertas, posts) conectados a MySQL via PDO.
- Añadir servicio de orientación vocacional con modelo RIASEC y resultados accionables.
- Documentar plan y pasos de integración.

### Fase 2 · Profundización funcional
- Conectar formularios existentes con lógica de negocio (validaciones, verificación de correo, recuperación de contraseña, flujo de empresas).
- Implementar dashboards diferenciados por rol (estudiante, egresado, empresa, admin) reutilizando componentes.
- Añadir gestión de portafolios (archivos y enlaces), y repositorio de recursos.
- Extender comunidad con comentarios y reacciones (tabla `reaccion`).
- Integrar módulo de mensajería interna y alertas vía correo (Sendinblue SDK ya incluido).

### Fase 3 · Inteligencia aplicada y escalabilidad
- Conectar los resultados del test vocacional con recomendaciones de oportunidades y posts mediante un motor de afinidad (`recomendacion_ia`).
- Diseñar API interna para integraciones futuras (aplicación móvil, analítica externa).
- Añadir colas de tareas y caché (Redis / RabbitMQ) para operaciones intensivas.
- Preparar infraestructura de despliegue (contenedores Docker, CI/CD, monitoreo).

## 3. Seguridad y cumplimiento
- Uso obligatorio de contraseñas hasheadas (bcrypt) y tokens de sesión regenerados.
- Validación y sanitización de datos en controladores y modelos (filtros de PHP + reglas de negocio).
- Preparar middlewares para autorización por rol y protección CSRF (pendiente de implementación).
- Registro de auditoría para acciones críticas (a implementar en Fase 2).

## 4. Experiencia de usuario
- Mantener identidad visual existente, añadiendo componentes responsivos modernizados.
- Progresar hacia diseño de sistema (colores, tipografías y componentes reutilizables en CSS/JS).
- Garantizar accesibilidad básica (contraste, etiquetas, navegación por teclado).

## 5. Próximos entregables
1. **Backlog funcional detallado** por módulo con criterios de aceptación.
2. **Guías de despliegue** (Docker + scripts de inicialización).
3. **Batería de pruebas** (PHPUnit/Feature tests) y pipeline CI.
4. **Documentación funcional** para administradores y empresas.

Este plan puede iterarse junto al equipo para priorizar funcionalidades estratégicas (ej. convenios con empresas o seguimiento de egresados).