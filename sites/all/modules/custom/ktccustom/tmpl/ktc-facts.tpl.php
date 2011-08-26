<div id="ktc-facts">
    
    <?php foreach ($element['facts'] as $fact): ?>
        <?php if (isset($fact->text)): ?>
            <div class="ktc-fact fact-<?php print $fact->index; ?>"><div class="facts-label">Fast Fact:</div><div class="fact-text"><?php print $fact->text;  ?></div></div>
        <?php endif; ?>
    <?php endforeach; ?>
    
</div>
