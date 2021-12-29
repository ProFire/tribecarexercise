<?php echo $this->Form->create($flatUnitEntity); ?>
<?php echo $this->Form->control("flat_block_id", ["value" => $flatBlockId, "type" => "hidden"]); ?>
<?php echo $this->Form->control("unit", [
    "label" => "Unit",
    "placeholder" => "Ex: 01-02, Function Room",
]); ?>
<?php echo $this->Form->submit("Add Unit to Block"); ?>
<?php echo $this->Form->end(); ?>