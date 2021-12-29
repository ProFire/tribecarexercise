<h1>Add new Block</h1>
<?php echo $this->Form->create($flatBlockEntity); ?>
<?php echo $this->Form->control("block", [
    "label" => "Block",
    "placeholder" => "Ex: 102",
]); ?>
<?php echo $this->Form->submit("Add Block"); ?>
<?php echo $this->Form->end(); ?>