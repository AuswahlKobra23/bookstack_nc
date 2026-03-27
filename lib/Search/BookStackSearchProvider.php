<?php

namespace OCA\BookStack\Search;

use OCA\BookStack\Service\BookStackService;
use OCP\IL10N;
use OCP\IURLGenerator;
use OCP\IUser;
use OCP\Search\IProvider;
use OCP\Search\ISearchQuery;
use OCP\Search\SearchResult;
use OCP\Search\SearchResultEntry;

class BookStackSearchProvider implements IProvider {

    private BookStackService $bookStackService;
    private IL10N $l10n;
    private IURLGenerator $urlGenerator;

    public function __construct(
        BookStackService $bookStackService,
        IL10N $l10n,
        IURLGenerator $urlGenerator
    ) {
        $this->bookStackService = $bookStackService;
        $this->l10n = $l10n;
        $this->urlGenerator = $urlGenerator;
    }

    public function getId(): string {
        return 'bookstack';
    }

    public function getName(): string {
        return $this->l10n->t('BookStack');
    }

    public function getOrder(string $route, array $routeParameters): int {
        return 20;
    }

    public function search(IUser $user, ISearchQuery $query): SearchResult {
        $term    = $query->getTerm();
        $results = $this->bookStackService->search($term, $user->getUID());

        $entries = array_map(function (array $item) {
            $pageId  = $item['id'] ?? 0;
            $type    = $item['type'] ?? 'page';
            $name    = $item['name'] ?? '';
            $preview = strip_tags($item['preview_html']['content'] ?? '');
            $url     = $item['url'] ?? $this->bookStackService->getBaseUrlPublic() . '/' . $type . 's/' . $pageId;
            $icon    = $this->urlGenerator->imagePath('bookstack', 'app.svg');

            return new SearchResultEntry($icon, $name, $preview, $url, $icon);
        }, $results);

        return SearchResult::complete($this->getName(), $entries);
    }
}
