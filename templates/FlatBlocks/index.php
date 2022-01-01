<h1>Blocks</h1>
<?= $this->Html->link("+ Add a new block", "/flat-blocks/add/") ?>
<table>
    <tr>
        <th><?php echo $this->Paginator->sort("block", "Block Number"); ?></th>
        <th><?php echo $this->Paginator->sort("created", "Created"); ?></th>
        <th><?php echo $this->Paginator->sort("modified", "Modified"); ?></th>
        <th>Actions</th>
    </tr>

    <?php foreach ($flatBlockEntities as $flatBlockEntity): ?>
    <tr>
        <td>
            <?= $this->Html->link($flatBlockEntity->block, "/flat-blocks/view/" . $flatBlockEntity->id) ?>
        </td>
        <td>
            <?= $flatBlockEntity->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $flatBlockEntity->modified->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Html->link("View More Info", "/flat-blocks/view/" . $flatBlockEntity->id) ?><br />
            <?= $this->Html->link("Edit Block details", "/flat-blocks/edit/" . $flatBlockEntity->id) ?><br />
            <?= $this->Form->postLink(
                'Delete Block and its units',
                "/flat-blocks/delete/" . $flatBlockEntity->id,
                ['confirm' => 'Proceed with extreme caution! Deleting Blocks will also delete its units, tenants, and visitors. Are you sure?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>

    <tr>
        <td colspan=4>
            <?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}') ?>
            <ul><?php echo $this->Paginator->prev(' << ' . __('previous page')) . $this->Paginator->numbers() . $this->Paginator->next(' >> ' . __('next page'));?></ul>
        </td>
    </tr>
</table>