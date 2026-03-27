<?php

namespace OCA\BookStack\Service;

use OCP\IConfig;
use OCP\Http\Client\IClientService;
use Psr\Log\LoggerInterface;

class BookStackService {

    private IConfig $config;
    private IClientService $clientService;
    private LoggerInterface $logger;

    public function __construct(
        IConfig $config,
        IClientService $clientService,
        LoggerInterface $logger
    ) {
        $this->config = $config;
        $this->clientService = $clientService;
        $this->logger = $logger;
    }

    private function getBaseUrl(): string {
        return rtrim($this->config->getAppValue('bookstack', 'base_url', ''), '/');
    }

    private function getUserToken(string $userId): ?string {
        $tokenId     = $this->config->getUserValue($userId, 'bookstack', 'token_id', '');
        $tokenSecret = $this->config->getUserValue($userId, 'bookstack', 'token_secret', '');

        if ($tokenId === '' || $tokenSecret === '') {
            return null;
        }

        return $tokenId . ':' . $tokenSecret;
    }

    public function search(string $query, string $userId): array {
        $baseUrl = $this->getBaseUrl();
        $token   = $this->getUserToken($userId);

        if ($baseUrl === '' || $token === null) {
            return [];
        }

        $client = $this->clientService->newClient();

        try {
            $response = $client->get($baseUrl . '/api/search', [
                'headers' => [
                    'Authorization' => 'Token ' . $token,
                    'Content-Type'  => 'application/json',
                ],
                'query' => [
                    'query' => $query,
                    'count' => 20,
                ],
                'timeout' => 10,
                'verify'  => false,
            ]);

            $body = json_decode($response->getBody(), true);
            return $body['data'] ?? [];
        } catch (\Exception $e) {
            $this->logger->error('BookStack search failed: ' . $e->getMessage());
            return [];
        }
    }

    public function getPageUrl(int $pageId): string {
        return $this->getBaseUrl() . '/pages/' . $pageId;
    }

    public function getBaseUrlPublic(): string {
        return $this->getBaseUrl();
    }
}
