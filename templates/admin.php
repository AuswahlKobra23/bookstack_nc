<?php
/** @var array $_ */
/** @var \OCP\IL10N $l */
\OCP\Util::addScript('bookstack', 'admin');
\OCP\Util::addStyle('bookstack', 'main');
?>
<div class="section">
    <h2><?php p($l->t('BookStack Integration')); ?></h2>
    <p><?php p($l->t('Set the URL of your BookStack instance. Each user configures their own API token in their personal settings.')); ?></p>

    <form id="bookstack-admin-form">
        <div class="bookstack-field">
            <label for="bookstack-url"><?php p($l->t('BookStack URL')); ?></label>
            <input
                type="url"
                id="bookstack-url"
                name="base_url"
                value="<?php p($_['base_url']); ?>"
                placeholder="https://bookstack.example.com"
                class="input-wide"
            />
        </div>

        <button type="button" id="bookstack-save" class="button">
            <?php p($l->t('Save')); ?>
        </button>
        <span id="bookstack-save-status"></span>
    </form>
</div>
