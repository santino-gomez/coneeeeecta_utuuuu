-- Base de datos Conecta UTU (actualizada)

CREATE TABLE IF NOT EXISTS usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario VARCHAR(255) NOT NULL,
    apellido_usuario VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    cedula_usuario CHAR(8) NOT NULL UNIQUE CHECK (cedula_usuario REGEXP '^[0-9]{8}$'),
    email_usuario VARCHAR(255) NOT NULL UNIQUE,
    clave_usuario VARCHAR(255) NOT NULL,
    estado_verificacion ENUM('no_verificado', 'pendiente_revision', 'verificado_estudiante', 'verificado_egresado', 'rechazado') NOT NULL DEFAULT 'no_verificado',
    rol_principal ENUM('visitante', 'estudiante', 'egresado', 'empresa', 'administrador') NOT NULL DEFAULT 'visitante',
    es_egresado BOOLEAN NOT NULL DEFAULT FALSE,
    fecha_egreso DATE NULL,
    nombre_archivo_constancia VARCHAR(255) NULL,
    fecha_envio_verificacion DATETIME NULL,
    comentario_admin_verificacion TEXT NULL,
    perfil_publico_json JSON NULL,
    usuario_activo BOOLEAN NOT NULL DEFAULT TRUE,
    codigo_verificacion VARCHAR(6) NULL,
    codigo_expira DATETIME NULL,
    codigo_verificado BOOLEAN NOT NULL DEFAULT FALSE,
    creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en DATETIME NULL ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS empresa (
    id_empresa INT PRIMARY KEY AUTO_INCREMENT,
    nombre_empresa VARCHAR(255) NOT NULL,
    email_empresa VARCHAR(255) NOT NULL UNIQUE,
    clave_empresa VARCHAR(255) NOT NULL,
    descripcion_empresa TEXT NULL,
    sitio_web_empresa VARCHAR(255) NULL,
    direccion_empresa VARCHAR(255) NULL,
    logo_empresa_url VARCHAR(255) NULL,
    telefono_empresa VARCHAR(25) NOT NULL,
    persona_contacto VARCHAR(255) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS empresa_usuario_contacto (
    id_contacto INT PRIMARY KEY AUTO_INCREMENT,
    id_empresa INT NOT NULL,
    id_usuario INT NOT NULL,
    mensaje TEXT NOT NULL,
    fecha_contacto DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_empresa) REFERENCES empresa(id_empresa),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

CREATE TABLE IF NOT EXISTS tag (
    id_tag INT PRIMARY KEY AUTO_INCREMENT,
    nombre_tag VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS usuario_tag (
    id_usuario_tag INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_tag INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_tag) REFERENCES tag(id_tag) ON DELETE CASCADE,
    UNIQUE KEY usuario_tag_unique (id_usuario, id_tag)
);

CREATE TABLE IF NOT EXISTS oferta (
    id_oferta INT PRIMARY KEY AUTO_INCREMENT,
    id_empresa INT NOT NULL,
    titulo_oferta VARCHAR(255) NOT NULL,
    descripcion_oferta TEXT,
    fecha_publicacion_oferta DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_cierre DATE NULL,
    es_para_egresado BOOLEAN NOT NULL DEFAULT FALSE,
    requisitos TEXT NULL,
    ubicacion VARCHAR(255) NULL,
    modalidad ENUM('presencial', 'virtual', 'hibrido') NOT NULL DEFAULT 'presencial',
    tipo_jornada ENUM('tiempo_completo', 'medio_tiempo', 'temporal', 'practica') NOT NULL DEFAULT 'tiempo_completo',
    rango_salarial VARCHAR(120) NULL,
    cupos INT NULL,
    fecha_actualizacion DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_empresa) REFERENCES empresa(id_empresa)
);

CREATE TABLE IF NOT EXISTS oferta_tag (
    id_oferta_tag INT PRIMARY KEY AUTO_INCREMENT,
    id_oferta INT NOT NULL,
    id_tag INT NOT NULL,
    FOREIGN KEY (id_oferta) REFERENCES oferta(id_oferta) ON DELETE CASCADE,
    FOREIGN KEY (id_tag) REFERENCES tag(id_tag) ON DELETE CASCADE,
    UNIQUE KEY oferta_tag_unique (id_oferta, id_tag)
);

CREATE TABLE IF NOT EXISTS postulacion (
    id_postulacion INT PRIMARY KEY AUTO_INCREMENT,
    id_oferta INT NOT NULL,
    id_usuario INT NOT NULL,
    mensaje_presentacion TEXT NULL,
    estado ENUM('pendiente', 'vista', 'entrevista', 'seleccionado', 'rechazado') NOT NULL DEFAULT 'pendiente',
    fecha_postulacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_oferta) REFERENCES oferta(id_oferta) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
    UNIQUE KEY postulacion_unique (id_oferta, id_usuario)
);

CREATE TABLE IF NOT EXISTS post (
    id_post INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    titulo_post VARCHAR(255) NOT NULL,
    contenido TEXT NOT NULL,
    fecha_publicacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado_post ENUM('borrador', 'publicado', 'archivado') NOT NULL DEFAULT 'publicado',
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS comentario (
    id_comentario INT PRIMARY KEY AUTO_INCREMENT,
    id_post INT NOT NULL,
    id_usuario INT NOT NULL,
    contenido TEXT NOT NULL,
    fecha_comentario DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_post) REFERENCES post(id_post) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS reaccion (
    id_reaccion INT PRIMARY KEY AUTO_INCREMENT,
    id_post INT NOT NULL,
    id_usuario INT NOT NULL,
    tipo ENUM('me_gusta', 'apoyo', 'inspirador') NOT NULL DEFAULT 'me_gusta',
    fecha_reaccion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_post) REFERENCES post(id_post) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
    UNIQUE KEY reaccion_unica (id_post, id_usuario)
);

CREATE TABLE IF NOT EXISTS mensaje (
    id_mensaje INT PRIMARY KEY AUTO_INCREMENT,
    id_remitente INT NOT NULL,
    tipo_remitente ENUM('usuario', 'empresa') NOT NULL,
    id_destinatario INT NOT NULL,
    tipo_destinatario ENUM('usuario', 'empresa') NOT NULL,
    contenido TEXT NOT NULL,
    fecha_envio DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    leido BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS orientacion_resultado (
    id_resultado INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    codigo_principal CHAR(1) NOT NULL,
    puntaje_json JSON NOT NULL,
    sugerencias_json JSON NOT NULL,
    fecha_realizacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS recomendacion_ia (
    id_recomendacion INT PRIMARY KEY AUTO_INCREMENT,
    id_entidad_destino INT NOT NULL,
    tipo_entidad_destino ENUM('usuario', 'empresa') NOT NULL,
    id_entidad_recomendada INT NOT NULL,
    tipo_entidad_recomendada ENUM('oferta', 'post', 'usuario', 'empresa') NOT NULL,
    puntuacion_relevancia DECIMAL(5,2) NULL,
    fecha_generacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    informacion_adicional JSON NULL
);
