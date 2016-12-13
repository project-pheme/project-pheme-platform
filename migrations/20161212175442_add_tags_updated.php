<?php

use Phinx\Migration\AbstractMigration;

// Pheme specific
class AddTagsUpdated extends AbstractMigration
{
    public function change()
    {
        $this->table('tags')
            ->addColumn('updated', 'integer', ['default' => 0])
            ->update()
            ;
    }
}
