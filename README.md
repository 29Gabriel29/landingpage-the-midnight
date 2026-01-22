# Fan Registration App – PHP + PostgreSQL + Docker + Render

Aplicación web desarrollada en **PHP** para registrar correos electrónicos de fans, almacenarlos en una base de datos **PostgreSQL** y enviar un email de confirmación utilizando la API de **Resend**.  
Incluye un **panel de administración** para listar y eliminar registros.

---

## Identidad visual & Experiencia

- Visualización de contenido audiovisual (videos embebidos)
- Interfaz orientada a banda musical: The Midnight
- Botones interactivos
- Navegación simple y directa
- Diseño visual alineado con la identidad estética del proyecto (Retrowave, Outrun, Synthwave)

---

## Funcionalidades

- Registro de fans (nombre + email), Validando email
- Prevención de correos duplicados
- Envío automático de email de confirmación (Resend API)
- Panel Admin:
  - Login seguro
  - Listado de correos registrados
  - Eliminación de registros
- Logout seguro
- Deploy funcional en entorno productivo

---

## Tecnologías utilizadas

- **PHP 8**
- **PostgreSQL**
- **PDO**
- **Docker / Docker Compose**
- **Apache**
- **Resend API** (envío de emails)
- **Git / GitHub**
- **Render** (deploy)

---

## Desarrollo local (Linux)

El proyecto fue desarrollado y probado en entorno **Linux**, utilizando contenedores Docker para garantizar consistencia entre desarrollo y producción.

Servicios utilizados:
- Contenedor PHP + Apache
- Contenedor PostgreSQL

Las variables sensibles (DB, API keys, etc.) se gestionan mediante variables de entorno (Definidas en Render).

---

## ☁️ Deploy en Render

La aplicación se encuentra desplegada en **Render**, utilizando:

- Web Service para PHP
- Base de datos PostgreSQL gestionada por Render

**Importante (Plan FREE):**
- La base de datos tiene una duración aproximada de **30 días**
- Al expirar, debe recrearse manualmente
- Esto implica la pérdida de los datos anteriores

---

## Envío de emails (Resend)

- El envío de emails se realiza mediante la **API de Resend**
- El correo de confirmación **solo llega al email registrado(29gabrielgomez29@gmail.com)**
- Resend **requiere que la aplicación esté desplegada en un dominio real**
  - No funciona correctamente en subdominios de testing

---

## Acceso al panel Admin

El panel de administración permite:
- Listar correos registrados
- Eliminar registros manualmente

### Credenciales:
Usuario: admin
Contraseña: admin123

El acceso se realiza desde el **footer** de la aplicación.

---

## Seguridad básica implementada

- Uso de sesiones para autenticación
- Protección de rutas administrativas
- Prepared Statements (PDO) contra SQL Injection
- Restricción de emails duplicados a nivel DB --> sql
ALTER TABLE fans
ADD CONSTRAINT fans_email_unique UNIQUE (email);
