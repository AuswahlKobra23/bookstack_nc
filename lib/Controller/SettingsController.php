<?php

namespace OCA\BookStack\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Http\Attribute\NoAdminRequired;
use OCP\AppFramework\Http\Attribute\NoCSRFRequired;
use OCP\IConfig;
use OCP\IRequest;
use OCP\IUserSession;

class SettingsController extends Controller {

    private IConfig $config;
    private IUserSession $userSession;

    public function __construct(
        string $appName,
        IRequest $request,
        IConfig $config,
        IUserSession $userSession
    ) {
        parent::__construct($appName, $request);
        $this->config = $config;
        $this->userSession = $userSession;
    }

    public function saveAdmin(string $base_url): JSONResponse {
        $this->config->setAppValue('bookstack', 'base_url', rtrim($base_url, '/'));
        return new JSONResponse(['status' => 'ok']);
    }

    #[NoAdminRequired]
    #[NoCSRFRequired]
    public function savePersonal(): JSONResponse {
        $user = $this->userSession->getUser();
        if ($user === null) {
            return new JSONResponse(['status' => 'unauthenticated'], 401);
        }
        $tokenId     = (string)($this->request->getParam('token_id') ?? '');
        $tokenSecret = (string)($this->request->getParam('token_secret') ?? '');
        $this->config->setUserValue($user->getUID(), 'bookstack', 'token_id', $tokenId);
        $this->config->setUserValue($user->getUID(), 'bookstack', 'token_secret', $tokenSecret);
        return new JSONResponse(['status' => 'ok']);
    }
}
