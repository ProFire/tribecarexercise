<h1>Blocks</h1>
<?= $this->Html->link("+ Add a new block", ['action' => 'add']) ?>
<table>
    <tr>
        <th>Block Number</th>
        <th>Created</th>
        <th>Modified</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($flatBlockEntities as $flatBlockEntity): ?>
    <tr>
        <td>
            <?= $this->Html->link($flatBlockEntity->block, ['action' => 'view', $flatBlockEntity->id]) ?>
        </td>
        <td>
            <?= $flatBlockEntity->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $flatBlockEntity->modified->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Html->link("View More Info", ['action' => 'view', $flatBlockEntity->id]) ?><br />
            <?= $this->Html->link("Edit Block details", ['action' => 'edit', $flatBlockEntity->id]) ?><br />
            <?= $this->Form->postLink(
                'Delete Block and its units',
                ['action' => 'delete', $flatBlockEntity->id],
                ['confirm' => 'Proceed with extreme caution! Deleting Blocks will also delete its units, tenants, and visitors. Are you sure?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>