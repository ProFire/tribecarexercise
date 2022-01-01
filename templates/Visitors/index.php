<h1>Visitor Log of Unit <?= $flatUnitEntity->unit ?> of <?= $flatUnitEntity->flat_block->block ?></h1>
<?= $this->Html->link("<< Back to Unit " . $flatUnitEntity->unit, ["controller" => "FlatUnits", 'action' => 'view', $flatUnitEntity->id]) ?><br />
<?= $this->Html->link("+ Add a new visitor", ['action' => 'add', $flatUnitEntity->id]) ?>
<table>
    <tr>
        <th><?php echo $this->Paginator->sort("name", "Name"); ?></th>
        <th><?php echo $this->Paginator->sort("contact", "Contact Number"); ?></th>
        <th><?php echo $this->Paginator->sort("nric", "NRIC last 3 digits"); ?></th>
        <th><?php echo $this->Paginator->sort("check_in", "Check In"); ?></th>
        <th><?php echo $this->Paginator->sort("check_out", "Check Out"); ?></th>
        <th>Actions</th>
    </tr>

    <?php foreach ($visitorEntities as $visitoryEntity): ?>
    <tr>
        <td>
            <?= $this->Html->link($visitoryEntity->name, ['action' => 'view', $visitoryEntity->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($visitoryEntity->contact, ['action' => 'view', $visitoryEntity->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($visitoryEntity->nric, ['action' => 'view', $visitoryEntity->id]) ?>
        </td>
        <td>
            <?= $visitoryEntity->check_in->format(DATE_RFC850) ?>
        </td>
        <td>
            <?php if (!empty($visitoryEntity->check_out)) {
                echo $visitoryEntity->check_out->format(DATE_RFC850);
            } ?>
        </td>
        <td>
            <?= $this->Html->link("View More Info", ['action' => 'view', $visitoryEntity->id]) ?><br />
            <?= $this->Html->link("Edit Visitor details", ['action' => 'edit', $visitoryEntity->id]) ?><br />
            <?= $this->Form->postLink(
                'Delete Visitor',
                ['action' => 'delete', $visitoryEntity->id],
                ['confirm' => 'Proceed with extreme caution! Are you sure?'])
            ?>
            <?php if ($visitoryEntity->isCheckedOut() == false) { ?>
                <br />
                <?= $this->Html->link("Checkout Visitor", ['action' => 'checkOut', $visitoryEntity->id]) ?>
            <?php } ?>
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