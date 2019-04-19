<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SlackbotController extends Controller
{
    // TODO: Mudar web hook na implementação

    public function infocorpContato(Request $request)
    {
        // TODO: Adicionar $SLACK_WEBHOOK para a implementação
        $SLACK_WEBHOOK = '';

        $PROJECT = 'G - WEBSITE';
        $NAME = $request->get('name');
        $EMAIL = $request->get('email');
        $SUBJECT = $request->get('subject');

        $MESSAGE = "
        {
            'attachments': [
                {
                    'pretext': 'Olá, Mensagem nova do {$PROJECT}',
                    'color': '#36a64f',
                    'text': 'Nome: {$NAME}\nMensagem: {$SUBJECT} \nEmail: {$EMAIL}',
                }
            ]
        }
        ";

        // Submit the POST request
        $result = $this->sendJsonCurl($SLACK_WEBHOOK, $MESSAGE);

        return response()->json($result, 200);
    }

    /*
     * Função para enviar json curl
     *
     * @param String $SLACK_WEBHOOK
     * @param String $MESSAGE
     *
     * @return curl_exec
     */
    private function sendJsonCurl($SLACK_WEBHOOK, $MESSAGE)
    {
        // Original Slack cURL
        // curl -X POST -H 'Content-type: application/json' --data "$MESSAGE" $SLACK_WEBHOOK
        $ch = curl_init($SLACK_WEBHOOK);

        // Prepare new cURL resource
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $MESSAGE);

        // Set HTTP Header for POST request
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($MESSAGE))
        );

        // Submit the POST request
        $result = curl_exec($ch);

        // Close cURL session handle
        curl_close($ch);
        return $result;
    }
}