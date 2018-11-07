<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181106194418 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comentario ADD autor_id INT NOT NULL');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E70214D45BBE FOREIGN KEY (autor_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_4B91E70214D45BBE ON comentario (autor_id)');
        $this->addSql('ALTER TABLE blog_post ADD autor_id INT NOT NULL, DROP autor');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01D14D45BBE FOREIGN KEY (autor_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_BA5AE01D14D45BBE ON blog_post (autor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01D14D45BBE');
        $this->addSql('DROP INDEX IDX_BA5AE01D14D45BBE ON blog_post');
        $this->addSql('ALTER TABLE blog_post ADD autor VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP autor_id');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E70214D45BBE');
        $this->addSql('DROP INDEX IDX_4B91E70214D45BBE ON comentario');
        $this->addSql('ALTER TABLE comentario DROP autor_id');
    }
}
