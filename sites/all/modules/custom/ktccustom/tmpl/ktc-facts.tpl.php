<div id="ktc-facts">
    <div id="facts-label"><div id="label-fact">Fast Fact:</div><div id="label-news">News Flash:</div></div>
    <div id="facts-listing">
        <?php foreach ($element['facts'] as $fact): ?>
            <?php if (isset($fact->text)): ?>
                <div class="ktc-fact fact-<?php print $fact->index; ?>" type="<?php print $fact->type; ?>"><div class="fact-text"><?php print $fact->text;  ?></div></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
