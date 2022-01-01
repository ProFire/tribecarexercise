<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterAutoIncrements extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('flat_blocks');
        $table->changeColumn('id', 'tinyinteger', [
            'autoIncrement' => true,
        ]);
        $table->update();
        
        $table = $this->table('flat_units');
        $table->changeColumn('id', 'smallinteger', [
            'autoIncrement' => true,
        ]);
        $table->update();
    }
}
