<?php
//dpm($element);
?>

<div class="documents-title">
    <h1 class="title">Featured Documents</h1>
    <div class="title-sub">Find documents by clicking on the left column <b>TOPIC LIST</b> or <b>RESOURCE TYPE.</b></div>
</div>

<div class="documents-categories">
    
    <h3 class="document-taxonomy-title headroom">Topic List</h3>
    <ul class="document-taxonomy">
        <?php foreach ($element['topics'] as $topic): ?>
        <li class="document-topic"><?php print l($topic->name, 'document-browse/' . $topic->tid);  ?></li>
        <?php endforeach; ?>
    </ul>

    <h3 class="document-taxonomy-title headroom">Resource Type</h3>
    <ul class="document-taxonomy">
        <?php foreach ($element['resourcetypes'] as $resourcetype): ?>
        <li class="document-resource-type"><?php print l($resourcetype->name, 'document-browse/' . $resourcetype->tid);  ?></li>
        <?php endforeach; ?>
    </ul>

</div>

<?php if ($element['show_results']): ?>
<div class="documents-list">
    <div class="documents-list-inner">
        <h3 class="document-results-header">Results: <?php print $element['category_name']; ?></h3>
        <?php print $element['docs']; ?>
    </div>
</div>
<?php endif; ?>