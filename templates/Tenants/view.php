<h1>Details of Tenant <?php echo $tenantEntity->name; ?></h1>
<?php echo $this->Html->link("<< Back to Unit Details", ["controller" => "FlatUnits", "action" => "view", $tenantEntity->flat_unit->id]); ?>
<table>
    <tr>
        <th>Name</th>
        <td><?php echo $tenantEntity->name; ?></td>
    </tr>
    <tr>
        <th>Contact Number</th>
        <td><?php echo $tenantEntity->contact; ?></td>
    </tr>
    <tr>
        <th>Stays in</th>
        <td>Unit <?php echo $this->Html->link($tenantEntity->flat_unit->unit, ["controller" => "FlatUnits", "action" => "view", $tenantEntity->flat_unit->id]); ?> of Block <?php echo $this->Html->link($tenantEntity->flat_unit->flat_block->block, ["controller" => "FlatBlocks", "action" => "view", $tenantEntity->flat_unit->flat_block->id]); ?></td>
    </tr>
    <tr>
        <th>Created</th>
        <td><?php echo $tenantEntity->created->format(DATE_RFC850); ?></td>
    </tr>
    <tr>
        <th>Modified</th>
        <td><?php echo $tenantEntity->modified->format(DATE_RFC850); ?></td>
    </tr>
</table>