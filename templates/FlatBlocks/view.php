<h1>Details of Block <?php echo $flatBlockEntity->block; ?></h1>
<?php echo $this->Html->link("<< Back to Block listings", ["action" => "index"]); ?>
<table>
    <tr>
        <th>Block</th>
        <td><?php echo $flatBlockEntity->block; ?></td>
    </tr>
    <tr>
        <th>Created</th>
        <td><?php echo $flatBlockEntity->created->format(DATE_RFC850); ?></td>
    </tr>
    <tr>
        <th>Modified</th>
        <td><?php echo $flatBlockEntity->modified->format(DATE_RFC850); ?></td>
    </tr>
    <tr>
        <th>Units in the Block</th>
        <td>
            <?php echo $this->Html->link("+ Add new unit", ["controller" => "FlatUnits", "action" => "add", $flatBlockEntity->id]); ?>
            <table>
                <tr>
                    <th>Unit</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Actions</th>
                </tr>

                <?php foreach ($flatBlockEntity->flat_units as $flatUnit) { ?>
                    <tr>
                        <td><?php echo $this->Html->link($flatUnit->unit, ["controller" => "FlatUnits", 'action' => 'view', $flatUnit->id]); ?></td>
                        <td><?php echo $flatUnit->created->format(DATE_RFC850); ?></td>
                        <td><?php echo $flatUnit->modified->format(DATE_RFC850); ?></td>
                        <td>
                            <?= $this->Html->link("View More Info", ["controller" => "FlatUnits", 'action' => 'view', $flatUnit->id]) ?><br />
                            <?= $this->Html->link("Edit Unit details", ["controller" => "FlatUnits", 'action' => 'edit', $flatUnit->id]) ?><br />
                            <?= $this->Form->postLink(
                                'Delete unit',
                                ["controller" => "FlatUnits", 'action' => 'delete', $flatUnit->id],
                                ['confirm' => 'Proceed with extreme caution! Deleting Units will also delete its tenants and visitors. Are you sure?'])
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
</table>