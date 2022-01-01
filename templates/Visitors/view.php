<h1>Details of Tenant <?php echo $visitorEntity->name; ?></h1>
<?php echo $this->Html->link("<< Back to Unit Details", ["controller" => "FlatUnits", "action" => "view", $visitorEntity->flat_unit->id]); ?>
<table>
    <tr>
        <th>Name</th>
        <td><?php echo $visitorEntity->name; ?></td>
    </tr>
    <tr>
        <th>Contact Number</th>
        <td><?php echo $visitorEntity->contact; ?></td>
    </tr>
    <tr>
        <th>NRIC last 3 digits</th>
        <td><?php echo $visitorEntity->nric; ?></td>
    </tr>
    <tr>
        <th>Visiting</th>
        <td>Unit <?php echo $this->Html->link($visitorEntity->flat_unit->unit, ["controller" => "FlatUnits", "action" => "view", $visitorEntity->flat_unit->id]); ?> of Block <?php echo $this->Html->link($visitorEntity->flat_unit->flat_block->block, ["controller" => "FlatBlocks", "action" => "view", $visitorEntity->flat_unit->flat_block->id]); ?></td>
    </tr>
    <tr>
        <th>Check In</th>
        <td><?php echo $visitorEntity->check_in->format(DATE_RFC850); ?></td>
    </tr>
    <tr>
        <th>Check Out</th>
        <td><?php echo $visitorEntity->check_out->format(DATE_RFC850); ?></td>
    </tr>
    <tr>
        <th>Created</th>
        <td><?php echo $visitorEntity->created->format(DATE_RFC850); ?></td>
    </tr>
    <tr>
        <th>Modified</th>
        <td><?php echo $visitorEntity->modified->format(DATE_RFC850); ?></td>
    </tr>
</table>