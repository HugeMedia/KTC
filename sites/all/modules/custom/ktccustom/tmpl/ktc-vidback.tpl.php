<div id="video-player-wrapper">
    <div id="video-close"><a id="youtube-close">X</a></div>
    <div id="video-player">
        You need Flash player 8+ and JavaScript enabled to view this video.
    </div>
</div>

<div id="videos-top">
    
    <div id="vids-by-cat">
        <?php foreach ($element['vids_by_cat'] as $cattid => $cat_view): ?>
            <div class="vids-by-cat-view cat-<?php print $cattid; ?>">
                <div class="vids-controls vids-controls-<?php print $cattid; ?>"><a class="vid-next"></a><div class="vid-counter">1/9</div><a class="vid-prev"></a></div>
                <?php print $cat_view; ?>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div id="video-cats">
        <?php print $element['video_cats']; ?>
    </div>
     
     
    <div id="body-left"></div>
    <div id="body-right"></div>
    <div class="clearfix">&nbsp;</div>
</div>

<div id="videos-bottom">

    <div id="most-watched-videos">
        <h4>Most Watched</h4>
        <?php print $element['most_watched']; ?>
    </div>
    
    <div id="tell-story">
        <a href="/soda-stories"><img src="/sites/all/themes/ktc/images/tell-story.png" /></a>
    </div>
    
    <div class="clearfix">&nbsp;</div>
    
</div>