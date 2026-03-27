<?php

namespace OCA\BookStack\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\IL10N;
use OCP\Settings\ISettings;

class PersonalSettings implements ISettings {

    private IConfig $config;
    private IL10N $l10n;
    private string $userId;

    public function __construct(IConfig $config, IL10N $l10n, string $userId) {
        $this->config = $config;
        $this->l10n = $l10n;
        $this->userId = $userId;
    }

    public function getForm(): TemplateResponse {
        return new TemplateResponse('bookstack', 'personal', [
            'token_id'     => $this->config->getUserValue($this->userId, 'bookstack', 'token_id', ''),
            'token_secret' => $this->config->getUserValue($this->userId, 'bookstack', 'token_secret', ''),
        ]);
    }

    public function getSection(): string {
        return 'personal-info';
    }

    public function getPriority(): int {
        return 50;
    }
}
