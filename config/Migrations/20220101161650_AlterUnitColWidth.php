<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterUnitColWidth extends AbstractMigration
{
    public function change()
    {
        
        $table = $this->table('flat_units');
        $table->changeColumn('unit', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ]);
        $table->update();
    }
}
