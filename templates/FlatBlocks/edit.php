<h1>Edit of Block <?php echo $flatBlockEntity->block; ?></h1>
<?php echo $this->Html->link("<< Back to Block listings", "/flat-blocks/index/"); ?>
<?php echo $this->Form->create($flatBlockEntity); ?>
<?php echo $this->Form->control("id"); ?>
<?php echo $this->Form->control("block", [
    "label" => "Block",
    "placeholder" => "Ex: 102",
]); ?>
<?php echo $this->Form->submit("Edit Block"); ?>
<?php echo $this->Form->end(); ?>