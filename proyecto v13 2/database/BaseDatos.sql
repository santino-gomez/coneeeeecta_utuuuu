SQL: 

CREATE TABLE usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario VARCHAR(255) NOT NULL,
    apellido_usuario VARCHAR(255) NOT NULL, 
    fecha_nacimiento DATE NOT NULL,
    cedula_usuario CHAR(8) NOT NULL UNIQUE, CHECK (cedula_usuario REGEXP '^[0-9]{8}$'),
    email_usuario VARCHAR(255) NOT NULL UNIQUE,
    clave_usuario VARCHAR(255) NOT NULL,
    estado_verificacion ENUM('no_verificado', 'pendiente_revision', 'verificado_estudiante', 'verificado_egresado', 'rechazado') NOT NULL DEFAULT 'no_verificado',
    rol_principal ENUM('visitante', 'estudiante', 'egresado', 'administrador') NOT NULL DEFAULT 'visitante',
    es_egresado BOOLEAN NOT NULL DEFAULT FALSE,
    fecha_egreso DATE NULL,
    nombre_archivo_constancia VARCHAR(255) NULL,
    fecha_envio_verificacion DATETIME NULL,
    comentario_admin_verificacion TEXT NULL,
    perfil_publico_json TEXT NULL,
    usuario_activo BOOLEAN NOT NULL DEFAULT TRUE,
    codigo_verificacion VARCHAR(6),
    codigo_expira DATETIME,
    codigo_verificado BOOLEAN DEFAULT FALSE
);

CREATE TABLE empresa (
    id_empresa INT PRIMARY KEY AUTO_INCREMENT,
    nombre_empresa VARCHAR(255) NOT NULL,
    email_empresa VARCHAR(255) NOT NULL UNIQUE,
    clave_empresa VARCHAR(255) NOT NULL,
    descripcion_empresa TEXT NULL,
    sitio_web_empresa VARCHAR(255) NULL,
    direccion_empresa VARCHAR(255) NULL,
    logo_empresa_url VARCHAR(255) NULL,
    telefono_empresa VARCHAR(15) NOT NULL UNIQUE
);

CREATE TABLE tag (
    id_tag INT PRIMARY KEY AUTO_INCREMENT,
    nombre_tag VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE usuario_tag (
    id_usuario_tag INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id_usuario),
    id_tag INT NOT NULL,
    FOREIGN KEY (id_tag)
        REFERENCES tag (id_tag),
    UNIQUE (id_usuario , id_tag)
);

CREATE TABLE oferta (
    id_oferta INT PRIMARY KEY AUTO_INCREMENT,
    id_empresa INT NOT NULL,
    FOREIGN KEY (id_empresa)
        REFERENCES empresa (id_empresa),
    titulo_oferta VARCHAR(255) NOT NULL,
    descripcion_oferta TEXT,
    fecha_publicacion_oferta DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_cierre DATE NULL,
    es_para_egresado BOOLEAN NOT NULL DEFAULT FALSE,
    requisitos TEXT NULL,
    ubicacion VARCHAR(255) NULL,
    modalidad ENUM('presencial', 'virtual', 'hibrido')
);

CREATE TABLE oferta_tag (
    id_oferta_tag INT PRIMARY KEY AUTO_INCREMENT,
    id_oferta INT NOT NULL,
    FOREIGN KEY (id_oferta)
        REFERENCES oferta (id_oferta),
    id_tag INT NOT NULL,
    FOREIGN KEY (id_tag)
        REFERENCES tag (id_tag),
    UNIQUE (id_oferta , id_tag)
); 

CREATE TABLE post (
    id_post INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id_usuario),
    titulo_post VARCHAR(255) NOT NULL,
    contenido TEXT NOT NULL,
    fecha_publicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado_post VARCHAR(50) NOT NULL
); 

CREATE TABLE comentario (
    id_comentario INT PRIMARY KEY AUTO_INCREMENT,
    id_post INT NOT NULL,
    FOREIGN KEY (id_post)
        REFERENCES post (id_post),
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id_usuario),
    contenido TEXT NOT NULL,
    fecha_comentario DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE mensaje (
    id_mensaje INT PRIMARY KEY AUTO_INCREMENT,
    id_remitente INT NOT NULL,
    tipo_remitente ENUM('usuario', 'empresa') NOT NULL,
    id_destinatario INT NOT NULL,
    tipo_destinatario ENUM('usuario', 'empresa') NOT NULL,
    contenido TEXT NOT NULL,
    fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    leido BOOLEAN DEFAULT FALSE
);

CREATE TABLE recomendacion_ia (
    id_recomendacion INT PRIMARY KEY AUTO_INCREMENT,
    id_entidad_destino INT NOT NULL,
    tipo_entidad_destino ENUM('usuario', 'empresa') NOT NULL,
    id_entidad_recomendada INT NOT NULL,
    tipo_entidad_recomendada ENUM('oferta', 'post', 'usuario', 'empresa') NOT NULL,
    puntuacion_relevancia DECIMAL(5 , 2 ) NULL,
    fecha_generacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    informacion_adicional TEXT NULL
);