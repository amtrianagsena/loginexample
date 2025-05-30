<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../../vendor/autoload.php';

class AuthController
{
    public function login()
    {
        $client = new Google_Client();
        $client->setClientId('45917651012-bhdbuh250a8m0vsiajo7dm8s6umnj4su.apps.googleusercontent.com');
        $client->setClientSecret('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');
        $client->setRedirectUri('http://localhost:8081/mipy/public/index.php?action=google_callback');
        $client->addScope('email');
        $client->addScope('profile');

        $login_url = $client->createAuthUrl();
        include __DIR__ . '/../views/login.php';
    }
    public function googleCallback()
    {
        //Crear handler personalizado para evitar el error con Guzzle
        $guzzleClient = new \GuzzleHttp\Client([
            'handler' => \GuzzleHttp\HandlerStack::create(),
            'curl' => [
                CURLOPT_FORBID_REUSE => true,
            ]
        ]);

        $client = new Google_Client();
        $client->setHttpClient($guzzleClient); //Usa Guzzle con configuración personalizada
        $client->setClientId('45917651012-bhdbuh250a8m0vsiajo7dm8s6umnj4su.apps.googleusercontent.com');
        $client->setClientSecret('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');
        $client->setRedirectUri('http://localhost:8081/mipy/public/index.php?action=google_callback');

        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

            if (isset($token['error'])) {
                echo "<h3>Error al obtener el token de Google:</h3>";
                echo "<p><strong>Código:</strong> " . htmlspecialchars($token['error']) . "</p>";
                echo "<p><strong>Descripción:</strong> " . htmlspecialchars($token['error_description'] ?? 'Sin descripción') . "</p>";
                exit;
            }

            $client->setAccessToken($token['access_token']);

            //Obtener información del usuario con cURL
            $ch = curl_init('https://www.googleapis.com/oauth2/v3/userinfo');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $token['access_token']
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $google_user = json_decode($response, true);

            if (isset($google_user['sub'])) {
                $user_model = new User();
                $user = $user_model->findOrCreate(
                    $google_user['sub'],
                    $google_user['name'],
                    $google_user['email'],
                    $google_user['picture']
                );

                session_start();
                $_SESSION['user'] = $user;
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                echo "<h3>No se pudo obtener información del usuario.</h3>";
                exit;
            }
        }

        header('Location: index.php');
    }


    public function dashboard()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: index.php');
            exit;
        }

        $user = $_SESSION['user'];
        include __DIR__ . '/../views/dashboard.php';
    }

    /*public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
    }*/

    /*
    Sin embargo, esto solo cierra la sesión de Google en el navegador 
    si no hay otras pestañas activas con sesión iniciada. 
    No hay un método oficial y seguro para cerrar completamente la sesión 
    de Google desde una app de terceros, pero sí puedes forzar una redirección que lo ayude.*/
    public function logout()
    {
        session_start();
        session_destroy();

        //Logout de Google y luego regresar a tu app
        $redirect = urlencode('http://localhost:8081/mipy/public/index.php');
        $googleLogoutUrl = "https://accounts.google.com/Logout?continue=https://appengine.google.com/_ah/logout?continue={$redirect}";

        header("Location: $googleLogoutUrl");
        exit;
    }
}
