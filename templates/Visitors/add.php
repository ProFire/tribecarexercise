<?php echo $this->Form->create($visitorEntity); ?>
<?php echo $this->Form->control("flat_unit_id", ["value" => $flatUnitId, "type" => "hidden"]); ?>
<?php echo $this->Form->control("name", [
    "label" => "Name",
    "placeholder" => "Ex: John Doe",
]); ?>
<?php echo $this->Form->control("contact", [
    "label" => "Contact Number",
    "placeholder" => "Ex: +65 1234 5678",
]); ?>
<?php echo $this->Form->control("nric", [
    "label" => "NRIC last 3 digits",
    "placeholder" => "Ex: 836",
]); ?>
<?php echo $this->Form->control("check_in", [
    "label" => "Check in datetime (optional)",
]); ?>
<?php echo $this->Form->control("check_out", [
    "label" => "Check out datetime (optional)",
]); ?>
<?php echo $this->Form->submit("Add Visitor to Unit"); ?>
<?php echo $this->Form->end(); ?>