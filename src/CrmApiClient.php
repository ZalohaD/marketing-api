<?php

class CrmApiClient
{
    private string $baseUrl;
    private string $token;
    private array  $leadDefaults;

    public function __construct(Config $config)
    {
        $this->baseUrl = $config->get('CRM_BASE_URL');
        $this->token   = $config->get('CRM_TOKEN');

        $this->leadDefaults = [
            'box_id'      => $config->get('LEAD_BOX_ID'),
            'offer_id'    => $config->get('LEAD_OFFER_ID'),
            'countryCode' => $config->get('LEAD_COUNTRY_CODE'),
            'language'    => $config->get('LEAD_LANGUAGE'),
            'password'    => $config->get('LEAD_PASSWORD'),
        ];
    }


     private function post(string $endpoint, array $payload): array
    {
        $url  = $this->baseUrl . $endpoint;
        $body = json_encode($payload);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $url);
        curl_setopt($ch, CURLOPT_POST,           true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,     $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT,        15);
        curl_setopt($ch, CURLOPT_HTTPHEADER,     [
            'Content-Type: application/json',
            'token: ' . $this->token,
        ]);

        $response = curl_exec($ch);
        $error    = curl_error($ch);

        unset($ch);

        if ($error) {
            return ['status' => false, 'error' => $error];
        }

        $decoded = json_decode($response, true);

        if (!is_array($decoded)) {
            return ['status' => false, 'error' => 'Invalid response from CRM'];
        }

        return $decoded;
    }

    public function addLead(array $data): array
    {
        //This is static data about lead!!
        foreach ($this->leadDefaults as $key => $value) {
            $data[$key] = $value;
        }

        return $this->post('/addlead', $data);
    }

    public function getStatuses(array $filters): array
    {
        $response = $this->post('/getstatuses', $filters);

        //Decode responce so we can put this data into fields
        if (isset($response['data']) && is_string($response['data'])) {
            $response['data'] = json_decode($response['data'], true);
        }

        if (!isset($response['data']) || !is_array($response['data'])) {
            $response['data'] = [];
        }

        return $response;
    }

   
}
