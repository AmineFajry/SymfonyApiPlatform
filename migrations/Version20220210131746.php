<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220210131746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message ADD store_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FB092A811 FOREIGN KEY (store_id) REFERENCES store (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FB092A811 ON message (store_id)');
        $this->addSql('ALTER TABLE `order` ADD user_id INT DEFAULT NULL, ADD appointment_date DATETIME NOT NULL, ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F5299398A76ED395 ON `order` (user_id)');
        $this->addSql('ALTER TABLE order_article ADD order__id INT DEFAULT NULL, ADD quantity INT NOT NULL, ADD amount DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE order_article ADD CONSTRAINT FK_F440A72D251A8A50 FOREIGN KEY (order__id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_F440A72D251A8A50 ON order_article (order__id)');
        $this->addSql('ALTER TABLE store ADD user_id INT DEFAULT NULL, ADD title VARCHAR(255) NOT NULL, ADD zipcode VARCHAR(255) NOT NULL, ADD adress VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL, ADD image_url VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF575877A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FF575877A76ED395 ON store (user_id)');
        $this->addSql('ALTER TABLE user ADD cart_id INT DEFAULT NULL, ADD email VARCHAR(255) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6491AD5CDBF ON user (cart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_url image_url VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FB092A811');
        $this->addSql('DROP INDEX IDX_B6BD307FB092A811 ON message');
        $this->addSql('ALTER TABLE message DROP store_id, CHANGE content content LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE subject subject VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('DROP INDEX IDX_F5299398A76ED395 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP user_id, DROP appointment_date, DROP status');
        $this->addSql('ALTER TABLE order_article DROP FOREIGN KEY FK_F440A72D251A8A50');
        $this->addSql('DROP INDEX IDX_F440A72D251A8A50 ON order_article');
        $this->addSql('ALTER TABLE order_article DROP order__id, DROP quantity, DROP amount');
        $this->addSql('ALTER TABLE store DROP FOREIGN KEY FK_FF575877A76ED395');
        $this->addSql('DROP INDEX IDX_FF575877A76ED395 ON store');
        $this->addSql('ALTER TABLE store DROP user_id, DROP title, DROP zipcode, DROP adress, DROP description, DROP image_url, DROP city');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491AD5CDBF');
        $this->addSql('DROP INDEX UNIQ_8D93D6491AD5CDBF ON user');
        $this->addSql('ALTER TABLE user DROP cart_id, DROP email, DROP roles, DROP firstname, DROP lastname, DROP password');
    }
}
