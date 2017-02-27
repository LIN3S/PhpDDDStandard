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
class Version20170227090955 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE menu (id CHAR(36) NOT NULL COMMENT \'(DC2Type:menu_id)\', created_on DATETIME NOT NULL, updated_on DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_item (id CHAR(36) NOT NULL COMMENT \'(DC2Type:menu_item_id)\', menu_translation_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:menu_translation_id)\', created_on DATETIME NOT NULL, updated_on DATETIME NOT NULL, parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:menu_item_id)\', label VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_D754D5508560DE01 (menu_translation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_translation (id CHAR(36) NOT NULL COMMENT \'(DC2Type:menu_translation_id)\', menu_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:menu_id)\', locale VARCHAR(12) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_DC955B23CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:user_id)\', created_on DATETIME NOT NULL, last_login DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:user_roles)\', updated_on DATETIME NOT NULL, confirmation_token_token VARCHAR(36) DEFAULT NULL, confirmation_token_created_on DATETIME DEFAULT NULL, email VARCHAR(60) NOT NULL, invitation_token_token VARCHAR(36) DEFAULT NULL, invitation_token_created_on DATETIME DEFAULT NULL, password VARCHAR(60) DEFAULT NULL, salt VARCHAR(60) DEFAULT NULL, remember_password_token_token VARCHAR(36) DEFAULT NULL, remember_password_token_created_on DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_item ADD CONSTRAINT FK_D754D5508560DE01 FOREIGN KEY (menu_translation_id) REFERENCES menu_translation (id)');
        $this->addSql('ALTER TABLE menu_translation ADD CONSTRAINT FK_DC955B23CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menu_translation DROP FOREIGN KEY FK_DC955B23CCD7E912');
        $this->addSql('ALTER TABLE menu_item DROP FOREIGN KEY FK_D754D5508560DE01');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_item');
        $this->addSql('DROP TABLE menu_translation');
        $this->addSql('DROP TABLE user');
    }
}
