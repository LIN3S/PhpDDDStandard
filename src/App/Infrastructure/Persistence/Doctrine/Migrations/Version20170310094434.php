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

class Version20170310094434 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE menu (id CHAR(36) NOT NULL COMMENT \'(DC2Type:menu_id)\', created_on DATETIME NOT NULL, updated_on DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_item (id CHAR(36) NOT NULL COMMENT \'(DC2Type:menu_item_id)\', menu_translation_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:menu_translation_id)\', created_on DATETIME NOT NULL, updated_on DATETIME NOT NULL, parent_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:menu_item_id)\', label VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_D754D5508560DE01 (menu_translation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_translation (id CHAR(36) NOT NULL COMMENT \'(DC2Type:menu_translation_id)\', menu_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:menu_id)\', locale VARCHAR(12) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_DC955B23CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:user_id)\', created_on DATETIME NOT NULL, last_login DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:user_roles)\', updated_on DATETIME NOT NULL, confirmation_token_token VARCHAR(36) DEFAULT NULL, confirmation_token_created_on DATETIME DEFAULT NULL, email VARCHAR(60) NOT NULL, invitation_token_token VARCHAR(36) DEFAULT NULL, invitation_token_created_on DATETIME DEFAULT NULL, password VARCHAR(60) DEFAULT NULL, salt VARCHAR(60) DEFAULT NULL, remember_password_token_token VARCHAR(36) DEFAULT NULL, remember_password_token_created_on DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id CHAR(36) NOT NULL COMMENT \'(DC2Type:page_id)\', created_on DATETIME NOT NULL, updated_on DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_translation (id CHAR(36) NOT NULL COMMENT \'(DC2Type:page_translation_id)\', page_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:page_id)\', locale VARCHAR(12) NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, seo_meta_title VARCHAR(100) NOT NULL, seo_meta_description VARCHAR(280) DEFAULT NULL, seo_robots_index SMALLINT NOT NULL, seo_robots_follow SMALLINT NOT NULL, INDEX IDX_A3D51B1DC4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_template (id CHAR(36) NOT NULL COMMENT \'(DC2Type:template_id)\', street VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE default_template (id CHAR(36) NOT NULL COMMENT \'(DC2Type:template_id)\', content VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template (id CHAR(36) NOT NULL COMMENT \'(DC2Type:template_id)\', page_translation_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:page_translation_id)\', template VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_97601F832D301871 (page_translation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_item ADD CONSTRAINT FK_D754D5508560DE01 FOREIGN KEY (menu_translation_id) REFERENCES menu_translation (id)');
        $this->addSql('ALTER TABLE menu_translation ADD CONSTRAINT FK_DC955B23CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE page_translation ADD CONSTRAINT FK_A3D51B1DC4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE contact_template ADD CONSTRAINT FK_D458314BF396750 FOREIGN KEY (id) REFERENCES template (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE default_template ADD CONSTRAINT FK_91242FCDBF396750 FOREIGN KEY (id) REFERENCES template (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE template ADD CONSTRAINT FK_97601F832D301871 FOREIGN KEY (page_translation_id) REFERENCES page_translation (id)');
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menu_translation DROP FOREIGN KEY FK_DC955B23CCD7E912');
        $this->addSql('ALTER TABLE menu_item DROP FOREIGN KEY FK_D754D5508560DE01');
        $this->addSql('ALTER TABLE page_translation DROP FOREIGN KEY FK_A3D51B1DC4663E4');
        $this->addSql('ALTER TABLE template DROP FOREIGN KEY FK_97601F832D301871');
        $this->addSql('ALTER TABLE contact_template DROP FOREIGN KEY FK_D458314BF396750');
        $this->addSql('ALTER TABLE default_template DROP FOREIGN KEY FK_91242FCDBF396750');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_item');
        $this->addSql('DROP TABLE menu_translation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_translation');
        $this->addSql('DROP TABLE contact_template');
        $this->addSql('DROP TABLE default_template');
        $this->addSql('DROP TABLE template');
    }
}
