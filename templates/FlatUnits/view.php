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
    <tr>
        <th>Current Visitors</th>
        <td><?= $visitorCheckInCount ?><br /><?php echo $this->Html->link("Show Visitors Log", "/visitors/index/" . $flatUnitEntity->id); ?></td>
    </tr>
    <tr>
        <th>Tenants in the Unit</th>
        <td>
            <?php echo $this->Html->link("+ Add new tenant", "/tenants/add/" . $flatUnitEntity->id); ?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Actions</th>
                </tr>

                <?php foreach ($flatUnitEntity->tenants as $tenant) { ?>
                    <tr>
                        <td><?php echo $this->Html->link($tenant->name, "/tenants/view/" . $tenant->id); ?></td>
                        <td><?php echo $this->Html->link($tenant->contact, "/tenants/view/" . $tenant->id); ?></td>
                        <td><?php echo $tenant->created->format(DATE_RFC850); ?></td>
                        <td><?php echo $tenant->modified->format(DATE_RFC850); ?></td>
                        <td>
                            <?= $this->Html->link("View More Info", "/tenants/view/" . $tenant->id) ?><br />
                            <?= $this->Html->link("Edit Tenant details", "/tenants/edit/" . $tenant->id) ?><br />
                            <?= $this->Form->postLink(
                                'Delete tenant',
                                "/tenants/delete/" . $tenant->id,
                                ['confirm' => 'Proceed with extreme caution! Are you sure?'])
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
</table>