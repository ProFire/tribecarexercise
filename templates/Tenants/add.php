<?php echo $this->Form->create($tenantEntity); ?>
<?php echo $this->Form->control("flat_unit_id", ["value" => $flatUnitId, "type" => "hidden"]); ?>
<?php echo $this->Form->control("name", [
    "label" => "Name",
    "placeholder" => "Ex: John Doe",
]); ?>
<?php echo $this->Form->control("contact", [
    "label" => "Contact Number",
    "placeholder" => "Ex: +65 1234 5678",
]); ?>
<?php echo $this->Form->submit("Add Tenant to Unit"); ?>
<?php echo $this->Form->end(); ?>