<?php

/**
 * @file
 * Customize confirmation screen after successful submission.
 *
 * This file may be renamed "webform-confirmation-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-confirmation.tpl.php" to affect all webform confirmations on your
 * site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $confirmation_message: The confirmation message input by the webform author.
 * - $sid: The unique submission ID of this submission.
 */
dpm($node);
?>

<div class="webform-confirmation"><p>Cảm ơn bạn đã để lại phản hổi. Chúng tôi sẽ cân nhắc những phản hồi của bạn để trang phát triển hơn.</p></div>

<div class="links">
    <a href="<?php print url('/') ?>"><?php print t('Quay lại trang chủ') ?></a>
</div>
