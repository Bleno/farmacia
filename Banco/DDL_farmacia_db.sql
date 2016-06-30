SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `farmacia_db` ;
CREATE SCHEMA IF NOT EXISTS `farmacia_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `farmacia_db` ;

-- -----------------------------------------------------
-- Table `farmacia_db`.`tb_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `farmacia_db`.`tb_usuario` ;

CREATE TABLE IF NOT EXISTS `farmacia_db`.`tb_usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `dt_cadastro` DATETIME NULL,
  `dt_update` VARCHAR(45) NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
COMMENT = 'Login de usuários e cadastro de usuário.';


-- -----------------------------------------------------
-- Table `farmacia_db`.`tb_categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `farmacia_db`.`tb_categoria` ;

CREATE TABLE IF NOT EXISTS `farmacia_db`.`tb_categoria` (
  `idtb_categoria` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `slug` VARCHAR(45) NOT NULL,
  `dt_cadastro` DATETIME NOT NULL,
  `dt_update` DATETIME NOT NULL,
  `fk_usuario` INT NOT NULL,
  PRIMARY KEY (`idtb_categoria`),
  UNIQUE INDEX `idtb_categoria_UNIQUE` (`idtb_categoria` ASC),
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
  `idtb_produto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `slug` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(45) NOT NULL,
  `fk_categoria` INT NOT NULL,
  `dt_cadastro` DATETIME NOT NULL,
  `dt_update` DATETIME NOT NULL,
  `fk_usuario` INT NOT NULL,
  `imagem` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtb_produto`),
  UNIQUE INDEX `idtb_produto_UNIQUE` (`idtb_produto` ASC),
  INDEX `fk_tb_produto_tb_categoria_idx` (`fk_categoria` ASC),
  INDEX `fk_tb_produto_tb_usuario1_idx` (`fk_usuario` ASC),
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC),
  CONSTRAINT `fk_tb_produto_tb_categoria`
    FOREIGN KEY (`fk_categoria`)
    REFERENCES `farmacia_db`.`tb_categoria` (`idtb_categoria`)
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
