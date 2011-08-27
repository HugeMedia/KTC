<div id="ktc-facts">
    <div id="facts-label">Fast Fact:</div>
    <div id="facts-listing">
        <?php foreach ($element['facts'] as $fact): ?>
            <?php if (isset($fact->text)): ?>
                <div class="ktc-fact fact-<?php print $fact->index; ?>"><div class="fact-text"><?php print $fact->text;  ?></div></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
