<h1>Details of Unit <?php echo $flatUnitEntity->unit; ?></h1>
<?php echo $this->Html->link("<< Back to Block Details", ["controller" => "FlatBlocks", "action" => "view", $flatUnitEntity->flat_block->id]); ?>
<table>
    <tr>
        <th>Unit</th>
        <td><?php echo $flatUnitEntity->unit; ?></td>
    </tr>
    <tr>
        <th>Created</th>
        <td><?php echo $flatUnitEntity->created->format(DATE_RFC850); ?></td>
    </tr>
    <tr>
        <th>Modified</th>
        <td><?php echo $flatUnitEntity->modified->format(DATE_RFC850); ?></td>
    </tr>
</table>