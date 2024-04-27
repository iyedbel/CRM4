-- Table client
CREATE TABLE client (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(100),
    telephone VARCHAR(20),
    password VARCHAR(20)
);
INSERT INTO `client` (`id`, `nom`, `prenom`,`email`,`telephone`,`password`) VALUES
(1, 'client', 'client','chennoufwail@gmail.com','0754591689','wail');
-- Table vendeur
CREATE TABLE vendeur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(100),
    telephone VARCHAR(20),
    password VARCHAR(20)

);
INSERT INTO `vendeur` (`id`, `nom`, `prenom`, `email`, `telephone`, `password`) VALUES (2, 'vendeur', 'vendeur', 'yahiabdelhak7@gmail.com', '0754506598', 'wail');

-- Table chef de bureau
CREATE TABLE chef_de_bureau (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(100),
    telephone VARCHAR(20),
    bureau VARCHAR(100),
    password VARCHAR(20)

);
INSERT INTO `chef_de_bureau` (`id`, `nom`, `prenom`,`email`,`telephone`,`bureau`,`password`) VALUES
(3, 'chef', 'chef','iyedbelm@gmail.com','0531587541','alger','wail');
-- Table Employé
CREATE TABLE employe (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(100),
    telephone VARCHAR(20),
    password VARCHAR(20)

);
INSERT INTO `employe` (`id`, `nom`, `prenom`,`email`,`telephone`,`password`) VALUES
(4, 'employe', 'employe','akramaymen7@gmail.com','0754591689','wail');
-- Table commande
CREATE TABLE commande (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_client INT,
    id_vendeur INT,
    date_commande DATE,
    montant DECIMAL(10, 2),
    FOREIGN KEY (id_client) REFERENCES client(id),
    FOREIGN KEY (id_vendeur) REFERENCES vendeur(id)
);

-- Table comptable
CREATE TABLE comptable (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(100),
    telephone VARCHAR(20),
    bureau VARCHAR(100),
    password VARCHAR(20)

);
INSERT INTO `comptable` (`id`, `nom`, `prenom`, `email`, `telephone`, `bureau`, `password`) 
VALUES (5, 'compt', 'compt', 'chennoufwail01@gmail.com', '075786564', 'alger', 'wail');

-- Table livreur
CREATE TABLE livreur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(20)
);
INSERT INTO `livreur` (`id`, `nom`, `prenom`, `email`, `password`) 
VALUES (6, 'ivreur', 'livreur', 'chennoufwail03@gmail.com','wail');

-- Table produit
CREATE TABLE produit (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    prix VARCHAR(100)
);
INSERT INTO `produit` (`id`, `nom`, `prix`) 
VALUES (7, 'prod', '2000');