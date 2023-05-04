/*
    Name: Bonita
    File name: contacts.sql
    Course code: SYST10199
    Date file was created: April 9, 2022
*/

DROP TABLE IF EXISTS contacts;
CREATE TABLE contacts(
    email_address VARCHAR(255) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    phone_number VARCHAR(25) NOT NULL,
    created_on DATE NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO contacts(email_address, first_name, last_name, phone_number, created_on)
    VALUES('Muath.alzghool@mail.com', 'Muath', 'Alzghool', '(123)456-7890', CURRENT_TIMESTAMP());
INSERT INTO contacts(email_address, first_name, last_name, phone_number, created_on)
    VALUES('libon@sheridancollege.ca', 'Bonita', 'Li', '(098)765-4321', CURRENT_TIMESTAMP());



