SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `farmacia_db`.`tb_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `farmacia_db`.`tb_usuario` ;

CREATE TABLE IF NOT EXISTS `farmacia_db`.`tb_usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `sobrenome` VARCHAR(45) NULL,
  `email` VARCHAR(45) NOT NULL,
  `ultimo_login` DATETIME NULL,
  `senha` VARCHAR(45) NOT NULL,
  `dt_cadastro` DATETIME NOT NULL,
  `dt_update` DATETIME NOT NULL,
  `ativo` TINYINT NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
COMMENT = 'Login de usuários e cadastro de usuário.';


-- -----------------------------------------------------
-- Table `farmacia_db`.`tb_categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `farmacia_db`.`tb_categoria` ;

CREATE TABLE IF NOT EXISTS `farmacia_db`.`tb_categoria` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `slug` VARCHAR(45) NOT NULL,
  `dt_cadastro` DATETIME NOT NULL,
  `dt_update` DATETIME NOT NULL,
  `ativo` TINYINT NOT NULL,
  `fk_usuario` INT NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE INDEX `idtb_categoria_UNIQUE` (`id_categoria` ASC),
  INDEX `fk_tb_categoria_tb_usuario1_idx` (`fk_usuario` ASC),
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC),
  CONSTRAINT `fk_tb_categoria_tb_usuario1`
    FOREIGN KEY (`fk_usuario`)
    REFERENCES `farmacia_db`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'cadastro de categoria do produto';


-- -----------------------------------------------------
-- Table `farmacia_db`.`tb_produto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `farmacia_db`.`tb_produto` ;

CREATE TABLE IF NOT EXISTS `farmacia_db`.`tb_produto` (
  `id_produto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `slug` VARCHAR(45) NOT NULL,
  `argumento` VARCHAR(45) NULL,
  `descricao` LONGTEXT NOT NULL,
  `dt_cadastro` DATETIME NOT NULL,
  `dt_update` DATETIME NOT NULL,
  `imagem` VARCHAR(45) NOT NULL,
  `valor_venda` DECIMAL NOT NULL,
  `valor_compra` DECIMAL NULL,
  `ativo` TINYINT NOT NULL,
  `fk_categoria` INT NOT NULL,
  `fk_usuario` INT NOT NULL,
  PRIMARY KEY (`id_produto`),
  UNIQUE INDEX `idtb_produto_UNIQUE` (`id_produto` ASC),
  INDEX `fk_tb_produto_tb_categoria_idx` (`fk_categoria` ASC),
  INDEX `fk_tb_produto_tb_usuario1_idx` (`fk_usuario` ASC),
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC),
  CONSTRAINT `fk_tb_produto_tb_categoria`
    FOREIGN KEY (`fk_categoria`)
    REFERENCES `farmacia_db`.`tb_categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_produto_tb_usuario1`
    FOREIGN KEY (`fk_usuario`)
    REFERENCES `farmacia_db`.`tb_usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Tabela para cadastrar produto';


-- -----------------------------------------------------
-- Table `farmacia_db`.`tb_contato`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `farmacia_db`.`tb_contato` ;

CREATE TABLE IF NOT EXISTS `farmacia_db`.`tb_contato` (
  `id_contato` INT NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `receita` VARCHAR(45) NULL COMMENT 'imagem da receita',
  `comantario` TEXT NOT NULL,
  PRIMARY KEY (`id_contato`),
  UNIQUE INDEX `id_contato_UNIQUE` (`id_contato` ASC))
ENGINE = InnoDB
COMMENT = 'tabela para contato e email php mail';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
