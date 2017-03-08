<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170306101743 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contact_template (id CHAR(36) NOT NULL COMMENT \'(DC2Type:template_id)\', street VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE default_template (id CHAR(36) NOT NULL COMMENT \'(DC2Type:template_id)\', content VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template (id CHAR(36) NOT NULL COMMENT \'(DC2Type:template_id)\', page_translation_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:page_translation_id)\', template VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_97601F832D301871 (page_translation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_template ADD CONSTRAINT FK_D458314BF396750 FOREIGN KEY (id) REFERENCES template (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE default_template ADD CONSTRAINT FK_91242FCDBF396750 FOREIGN KEY (id) REFERENCES template (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE template ADD CONSTRAINT FK_97601F832D301871 FOREIGN KEY (page_translation_id) REFERENCES page_translation (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact_template DROP FOREIGN KEY FK_D458314BF396750');
        $this->addSql('ALTER TABLE default_template DROP FOREIGN KEY FK_91242FCDBF396750');
        $this->addSql('DROP TABLE contact_template');
        $this->addSql('DROP TABLE default_template');
        $this->addSql('DROP TABLE template');
    }
}
