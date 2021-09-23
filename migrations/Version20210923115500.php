<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210923115500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe ADD classes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF969E225B24 FOREIGN KEY (classes_id) REFERENCES prof (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF969E225B24 ON classe (classes_id)');
        $this->addSql('ALTER TABLE eleve ADD appartenir_id INT NOT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7E977E148 FOREIGN KEY (appartenir_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7E977E148 ON eleve (appartenir_id)');
        $this->addSql('ALTER TABLE matiere ADD prof_id INT NOT NULL');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574AABC1F7FE FOREIGN KEY (prof_id) REFERENCES prof (id)');
        $this->addSql('CREATE INDEX IDX_9014574AABC1F7FE ON matiere (prof_id)');
        $this->addSql('ALTER TABLE note ADD evaluer_id INT NOT NULL, ADD obtenir_id INT NOT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1455A18BD3 FOREIGN KEY (evaluer_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14BE8D6DA2 FOREIGN KEY (obtenir_id) REFERENCES eleve (id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA1455A18BD3 ON note (evaluer_id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14BE8D6DA2 ON note (obtenir_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF969E225B24');
        $this->addSql('DROP INDEX IDX_8F87BF969E225B24 ON classe');
        $this->addSql('ALTER TABLE classe DROP classes_id');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7E977E148');
        $this->addSql('DROP INDEX IDX_ECA105F7E977E148 ON eleve');
        $this->addSql('ALTER TABLE eleve DROP appartenir_id');
        $this->addSql('ALTER TABLE matiere DROP FOREIGN KEY FK_9014574AABC1F7FE');
        $this->addSql('DROP INDEX IDX_9014574AABC1F7FE ON matiere');
        $this->addSql('ALTER TABLE matiere DROP prof_id');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1455A18BD3');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14BE8D6DA2');
        $this->addSql('DROP INDEX IDX_CFBDFA1455A18BD3 ON note');
        $this->addSql('DROP INDEX IDX_CFBDFA14BE8D6DA2 ON note');
        $this->addSql('ALTER TABLE note DROP evaluer_id, DROP obtenir_id');
    }
}
