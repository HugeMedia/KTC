<div id="ktc-facts">
    <div id="facts-label"><div id="label-fact">Fast Fact:</div><div id="label-news">News Flash:</div></div>
    <div id="facts-listing">
        <?php foreach ($element['facts'] as $fact): ?>
            <?php //dd($fact); ?>
            <?php if (isset($fact->text)): ?>
                <div class="ktc-fact fact-<?php print $fact->index; ?>" type="<?php print $fact->type; ?>"><div class="fact-text"><?php print $fact->text;  ?></div>
                <div class="ktc-learn-more"><?php print l('Learn More', $fact->url); ?></div><div class="ktc-fact-tweet"> <a href="http://twitter.com/share?url=<?php print $fact->url; ?>" target="_blank">Tweet this.</a></div></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
