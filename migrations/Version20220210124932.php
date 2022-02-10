<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220210124932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD store_id INT DEFAULT NULL, ADD title VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL, ADD quantity INT NOT NULL, ADD price DOUBLE PRECISION NOT NULL, ADD image_url VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66B092A811 FOREIGN KEY (store_id) REFERENCES store (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66B092A811 ON article (store_id)');
        $this->addSql('ALTER TABLE cart_article ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart_article ADD CONSTRAINT FK_F9E0C6617294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_F9E0C6617294869C ON cart_article (article_id)');
        $this->addSql('ALTER TABLE message ADD content LONGTEXT NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD subject VARCHAR(255) NOT NULL, ADD status TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE order_article ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE order_article ADD CONSTRAINT FK_F440A72D7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_F440A72D7294869C ON order_article (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66B092A811');
        $this->addSql('DROP INDEX IDX_23A0E66B092A811 ON article');
        $this->addSql('ALTER TABLE article DROP store_id, DROP title, DROP description, DROP quantity, DROP price, DROP image_url');
        $this->addSql('ALTER TABLE cart_article DROP FOREIGN KEY FK_F9E0C6617294869C');
        $this->addSql('DROP INDEX IDX_F9E0C6617294869C ON cart_article');
        $this->addSql('ALTER TABLE cart_article DROP article_id');
        $this->addSql('ALTER TABLE message DROP content, DROP email, DROP subject, DROP status');
        $this->addSql('ALTER TABLE order_article DROP FOREIGN KEY FK_F440A72D7294869C');
        $this->addSql('DROP INDEX IDX_F440A72D7294869C ON order_article');
        $this->addSql('ALTER TABLE order_article DROP article_id');
    }
}
