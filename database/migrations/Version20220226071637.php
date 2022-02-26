<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20220226071637 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customers ADD email VARCHAR(100) NOT NULL, ADD username VARCHAR(100) NOT NULL, ADD gender VARCHAR(10) NOT NULL, ADD country VARCHAR(50) NOT NULL, ADD city VARCHAR(100) NOT NULL, ADD phone VARCHAR(50) NOT NULL, CHANGE lastname lastname VARCHAR(100) NOT NULL, CHANGE firstname firstname VARCHAR(100) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customers DROP email, DROP username, DROP gender, DROP country, DROP city, DROP phone, CHANGE lastname lastname VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE firstname firstname VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
