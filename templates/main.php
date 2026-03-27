<?php
/** @var array $_ */
/** @var \OCP\IL10N $l */
\OCP\Util::addStyle('bookstack', 'main');
?>
<div id="bookstack-wrapper">
    <iframe
        id="bookstack-iframe"
        src="<?php echo htmlspecialchars($_['iframeUrl'], ENT_QUOTES); ?>"
        frameborder="0"
        allowfullscreen
    ></iframe>
</div>
