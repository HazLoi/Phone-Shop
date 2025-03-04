<?php

class DriveModel {
    private $client;

    public function __construct() {
        $this->client = $this->authenticate();
    }

    private function authenticate() {
        // Load the Google API PHP Client Library
        require_once __DIR__ . '/../../vendor/autoload.php';

        $client = new Google_Client();
        $client->setApplicationName('Google Drive Integration');
        $client->setScopes(Google_Service_Drive::DRIVE_READONLY);
        $client->setAuthConfig(__DIR__ . '/../../.env'); // Path to your .env file with credentials
        $client->setAccessType('offline');

        // Load previously authorized credentials from a file
        $credentialsPath = 'path/to/credentials.json'; // Update with your path
        if (file_exists($credentialsPath)) {
            $accessToken = json_decode(file_get_contents($credentialsPath), true);
            $client->setAccessToken($accessToken);
        }

        // Refresh the token if it's expired
        if ($client->isAccessTokenExpired()) {
            // Refresh the token using the refresh token
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            // Save the token to a file
            file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
        }

        return $client;
    }

    public function getFiles() {
        $service = new Google_Service_Drive($this->client);
        $files = $service->files->listFiles(array(
            'pageSize' => 10,
            'fields' => 'nextPageToken, files(id, name, mimeType)',
        ));

        return $files->getFiles();
    }
}