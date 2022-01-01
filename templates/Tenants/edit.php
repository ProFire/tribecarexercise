<?php echo $this->Form->create($flatUnitEntity); ?>
<?php echo $this->Form->control("id"); ?>
<?php echo $this->Form->control("flat_unit_id", ["type" => "hidden"]); ?>
<?php echo $this->Form->control("name", [
    "label" => "Name",
    "placeholder" => "Ex: John Doe",
]); ?>
<?php echo $this->Form->control("contact", [
    "label" => "Contact Number",
    "placeholder" => "Ex: +65 1234 5678",
]); ?>
<?php echo $this->Form->submit("Edit Tenant"); ?>
<?php echo $this->Form->end(); ?>