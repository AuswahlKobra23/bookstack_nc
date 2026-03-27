<?php

namespace OCA\BookStack\AppInfo;

use OCA\BookStack\Search\BookStackSearchProvider;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\IConfig;
use OCP\Util;

class Application extends App implements IBootstrap {

    public const APP_ID = 'bookstack';

    public function __construct() {
        parent::__construct(self::APP_ID);
    }

    public function register(IRegistrationContext $context): void {
        $context->registerSearchProvider(BookStackSearchProvider::class);
    }

    public function boot(IBootContext $context): void {
        $config = $context->getServerContainer()->get(IConfig::class);
        $baseUrl = $config->getAppValue(self::APP_ID, 'base_url', '');

        if ($baseUrl !== '') {
            $host = parse_url($baseUrl, PHP_URL_HOST);
            $port = parse_url($baseUrl, PHP_URL_PORT);
            $hostWithPort = $host . ($port ? ':' . $port : '');

            Util::addScript(self::APP_ID, 'search');
            Util::addHeader('meta', [
                'name'    => 'bookstack-host',
                'content' => $hostWithPort,
            ]);
        }
    }
}
