<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241003155210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice_product DROP FOREIGN KEY FK_2193327E2989F1FD');
        $this->addSql('ALTER TABLE invoice_product DROP FOREIGN KEY FK_2193327E4584665A');
        $this->addSql('ALTER TABLE invoice_product ADD id INT AUTO_INCREMENT NOT NULL, ADD quantity INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE invoice_product ADD CONSTRAINT FK_2193327E2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE invoice_product ADD CONSTRAINT FK_2193327E4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice_product MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE invoice_product DROP FOREIGN KEY FK_2193327E2989F1FD');
        $this->addSql('ALTER TABLE invoice_product DROP FOREIGN KEY FK_2193327E4584665A');
        $this->addSql('DROP INDEX `PRIMARY` ON invoice_product');
        $this->addSql('ALTER TABLE invoice_product DROP id, DROP quantity');
        $this->addSql('ALTER TABLE invoice_product ADD CONSTRAINT FK_2193327E2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invoice_product ADD CONSTRAINT FK_2193327E4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invoice_product ADD PRIMARY KEY (invoice_id, product_id)');
    }
}
