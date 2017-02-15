<?php

use Phinx\Migration\AbstractMigration;

class PostFulltext extends AbstractMigration {

	public function change() {
		 $this->table('posts_fulltext', [
				'id' => false,
				'primary_key' => ['post_id'],
				])
			->addColumn('post_id', 'integer')
			->addColumn('fulltext', 'text')
			->addIndex('fulltext', ['type' => 'fulltext'])
			->create();
	}
}
