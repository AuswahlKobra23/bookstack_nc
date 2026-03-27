<?php

namespace OCA\BookStack\Controller;

use OCA\BookStack\Service\BookStackService;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\Attribute\NoAdminRequired;
use OCP\AppFramework\Http\Attribute\NoCSRFRequired;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\IRequest;

class ViewController extends Controller {

    private BookStackService $bookStackService;
    private IConfig $config;

    public function __construct(
        string $appName,
        IRequest $request,
        BookStackService $bookStackService,
        IConfig $config
    ) {
        parent::__construct($appName, $request);
        $this->bookStackService = $bookStackService;
        $this->config = $config;
    }

    #[NoAdminRequired]
    #[NoCSRFRequired]
    public function index(): TemplateResponse {
        $baseUrl = $this->bookStackService->getBaseUrlPublic();
        return new TemplateResponse('bookstack', 'main', [
            'iframeUrl' => $baseUrl,
        ]);
    }

    #[NoAdminRequired]
    #[NoCSRFRequired]
    public function show(int $pageId): TemplateResponse {
        $url = $this->bookStackService->getPageUrl($pageId);
        return new TemplateResponse('bookstack', 'main', [
            'iframeUrl' => $url,
        ]);
    }
}
