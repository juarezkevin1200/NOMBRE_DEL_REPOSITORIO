<?php

namespace Classes;

use Ramsey\Uuid\Uuid;

class Paypal {
    public $clientId;
    public $secret;
    public $accessToken;
    public $baseUrl;
    public $orderId;
    public $linkPago;

    public function __construct()
    {
        $this->clientId = $_ENV['PAYPAL_CLIENT_ID'];
        $this->secret = $_ENV['PAYPAL_CLIENT_SECRET'];
        $this->baseUrl = $_ENV['PAYPAL_BASE_URL'];
    }

    public function CreateOrder() {

        $baseUrl = $_ENV['PAYPAL_BASE_URL'];
        $UrlRet = $_ENV['HOST'] . "/pedidos/completado";
        $total = $_SESSION['total'] ?? 1000.00;
        $data = [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "MXN",
                        "value" => $total
                    ]
                ]
            ],
            "application_context" => [
                "brand_name" => "Mi tienda",
                "landing_page" => "NO_PREFERENCE",
                "user_action" => "PAY_NOW",
                "return_url" => $_ENV["HOST"] . "/pedidos/capture-order" ,
                "cancel_url" => $_ENV["HOST"] . "/pedidos/cancel-order"

            ]

        ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "$baseUrl/v2/checkout/orders");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",
                "Authorization: Bearer $this->accessToken"
            ]);

            $response = curl_exec($ch);
            curl_close($ch);
            
            $data = json_decode($response, true);

          
        if (isset($data['id'])) {
            $this->orderId = $data['id'];
            $this->linkPago = $data['links'][1]['href'];
        } else {
            $this->orderId = null;
            $this->linkPago = null;
        }

        return $response;
    }

    public function CaptureOrder() {
            $url = $this->baseUrl . "/v2/checkout/orders/" . $this->orderId . "/capture";

            // Inicializar cURL
            $ch = curl_init($url);

            // Configuración de cURL
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->accessToken
            ]);
            curl_setopt($ch, CURLOPT_POST, true); // Es un POST aunque no necesite un cuerpo
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Ejecutar la solicitud y capturar la respuesta
            $response = curl_exec($ch);

            // Verificar errores de cURL
            if (curl_errno($ch)) {
                $response = curl_error($ch);
            } 
            curl_close($ch);
           
            return $response;
    }

    

    public function ConfirmarPayment(){
        $url =$this->baseUrl . "/v2/checkout/orders/" . $this->orderId ."/confirm-payment-source";

        // Datos para la solicitud
        $data = [
            "payment_source" => [
                "paypal" => [
                    "name" => [
                        "given_name" => "John",
                        "surname" => "Doe"
                    ],
                    "email_address" => "customer@example.com",
                    "experience_context" => [
                        "payment_method_preference" => "IMMEDIATE_PAYMENT_REQUIRED",
                        "brand_name" => "EXAMPLE INC",
                        "locale" => "en-US",
                        "landing_page" => "LOGIN",
                        "shipping_preference" => "SET_PROVIDED_ADDRESS",
                        "user_action" => "PAY_NOW",
                        "return_url" => $_ENV["HOST"] . "/returnUrl",
                        "cancel_url" => $_ENV["HOST"] . "/cancelUrl"
                    ]
                ]
            ]
        ];

        // Inicializar cURL
        $ch = curl_init($url);

        // Configuración de cURL
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->accessToken
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Ejecutar solicitud y capturar respuesta
        $response = curl_exec($ch);
        // Capturar errores si ocurren
        if (curl_errno($ch)) {
            return 'Error:' . curl_error($ch);
        } else {
            // Imprimir la respuesta
            return $response;
        }

    }

    public function CheckOrder(){
        // Crear la URL de la solicitud
        $url = "$this->baseUrl/v2/checkout/orders/$this->orderId";
        // Hacer la solicitud GET para obtener la información de la orden
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer $this->accessToken"
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Obtener el código HTTP de la respuesta
        curl_close($ch);

        // Verificar si la respuesta fue exitosa (código 200)
        if ($httpCode === 200) {
            return $responseData = json_decode($response, true);
        } else {
            return json_decode($response, true);
        }
    }

    public function ShowOrder(){

        $url = $this->baseUrl ."/v2/checkout/orders/" . $this->orderId;

        // Inicializar cURL
        $ch = curl_init($url);

        // Configuración de cURL
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $this->accessToken
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); // Especificar el método GET

        // Ejecutar la solicitud y capturar la respuesta
        $response = curl_exec($ch);

        // Verificar errores de cURL
        if (curl_errno($ch)) {
            $response =  curl_error($ch);
        }

        // Cerrar cURL
        curl_close($ch);
        return $response;
    }


    public function ObtenerToken(){
            // URL del endpoint de PayPal (usa sandbox para pruebas)
            $url = "https://api-m.sandbox.paypal.com/v1/oauth2/token";
            // Inicializa cURL
            $ch = curl_init($url);
            // Configura las opciones de cURL
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Accept: application/json",
                "Accept-Language: en_US"
            ]);
            curl_setopt($ch, CURLOPT_USERPWD, $this->clientId . ":" . $this->secret); // Basic Auth
            curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Ejecuta la petición y obtiene la respuesta
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
                curl_close($ch);
                exit;
            }
            curl_close($ch);

            // Decodifica la respuesta
            $data = json_decode($response, true);
            
            // Muestra el token de acceso
            if (isset($data['access_token'])) {
                $this->accessToken = $data['access_token'];
            } else {
                $this->accessToken = null;
            }

    }

}