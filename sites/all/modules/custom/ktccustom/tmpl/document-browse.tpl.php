<?php
//dpm($element);
?>

<div class="documents-categories">
    
    <ul>
        <?php foreach ($element['topics'] as $topic): ?>
        <li class="document-topic"><?php print l($topic->name, 'document-browse/' . $topic->tid);  ?></li>
        <?php endforeach; ?>
    </ul>

    <ul>
        <?php foreach ($element['audience'] as $audience): ?>
        <li class="document-audience"><?php print l($audience->name, 'document-browse/' . $audience->tid);  ?></li>
        <?php endforeach; ?>
    </ul>

    <ul>
        <?php foreach ($element['resourcetypes'] as $resourcetype): ?>
        <li class="document-resource-type"><?php print l($resourcetype->name, 'document-browse/' . $resourcetype->tid);  ?></li>
        <?php endforeach; ?>
    </ul>

</div>


<div class="documents-list">
    
    <?php print $element['docs']; ?>
    
</div>