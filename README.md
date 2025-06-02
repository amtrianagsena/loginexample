#Login con Google en PHP

Este proyecto permite autenticar usuarios mediante su cuenta de Google usando PHP, Composer y Google OAuth 2.0. Está diseñado para correr localmente con XAMPP u otro servidor local.

---

##Requisitos

- PHP 8.0 o superior
- [Composer](https://getcomposer.org/)
- XAMPP (o servidor local)
- Navegador web moderno

---

##Instalación

1. Clona este repositorio en la carpeta `htdocs` de XAMPP:
   
  - git clone https://github.com/tuusuario/mipy.git
  - Descarga el repositorio como un archivo comprimido

2. Entra al directorio del proyecto:

 - cd mipy
 - Abrelo desde Visual Studio Code
 
3. Instala las dependencias con Composer:

   En la terminal:
   >composer install <br>
   >composer require google/apiclient:^2.13
   
   Nota: La versión 2.13 es más actual y probablemente sea compatible con google/auth v1.47.0

4. Configura tu aplicación de Google en Google Cloud Console:

  - Crea credenciales OAuth 2.0
  - Copia tu Client ID, Client Secret y Redirect URI

 5. Abre AuthController.php y configura tus credenciales:

    $client->setClientId('TU_CLIENT_ID');<br>
    $client->setClientSecret('TU_CLIENT_SECRET');<br>
    $client->setRedirectUri('http://localhost:8081/mipy/public/index.php?action=google_callback');

  6. Ejecutar XAMMP

  7. Importar la base de datos

  - Revisar como se llama la base de datos
  - Crear la tabla users
    
---

 ##Uso

  1. Abrir el navegador e ingresar a la url:

  - http://localhost:8081/mipy/public/index.php
  
  2. Haz clic en el botón de Iniciar sesión con Google.
     
  3. Accede a tu cuenta de Google.
     
  - Verás el panel de usuario con tu nombre, email e imagen de perfil.

  Nota: Sin embargo, esto solo cierra la sesión de Google en el navegador si no hay otras pestañas activas con sesión iniciada. No hay un método oficial y seguro para cerrar completamente la sesión 
  de Google desde una app de terceros, pero sí puedes forzar una redirección que lo ayude.

---

##Funcionalidades

 - Login con cuenta de Google (OAuth 2.0)
 - Obtención del perfil de usuario (nombre, email, imagen)
 - Cierre de sesión completo (local y Google)

   
   

