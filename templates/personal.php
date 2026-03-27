<?php
/** @var array $_ */
/** @var \OCP\IL10N $l */
\OCP\Util::addScript('bookstack', 'personal');
\OCP\Util::addStyle('bookstack', 'main');
?>
<div class="section">
    <h2><?php p($l->t('BookStack')); ?></h2>
    <p><?php p($l->t('Enter your personal BookStack API token to enable search.')); ?></p>

    <form id="bookstack-personal-form">
        <div class="bookstack-field">
            <label for="bookstack-personal-token-id"><?php p($l->t('API Token ID')); ?></label>
            <input
                type="text"
                id="bookstack-personal-token-id"
                name="token_id"
                value="<?php p($_['token_id']); ?>"
                placeholder="Token ID"
                class="input-wide"
            />
        </div>

        <div class="bookstack-field">
            <label for="bookstack-personal-token-secret"><?php p($l->t('API Token Secret')); ?></label>
            <input
                type="password"
                id="bookstack-personal-token-secret"
                name="token_secret"
                value="<?php p($_['token_secret']); ?>"
                placeholder="Token Secret"
                class="input-wide"
            />
        </div>

        <p class="bookstack-hint">
            <?php p($l->t('Generate an API token in BookStack under your profile → API Tokens.')); ?>
        </p>

        <button type="button" id="bookstack-personal-save" class="button">
            <?php p($l->t('Save')); ?>
        </button>
        <span id="bookstack-personal-save-status"></span>
    </form>
</div>
