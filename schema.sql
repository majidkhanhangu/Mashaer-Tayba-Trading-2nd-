
-- schema.sql
-- Mashaer Tayebah Paint & Showroom — database schema


CREATE DATABASE IF NOT EXISTS mashaer_paints_db
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE mashaer_paints_db;


-- Table: services

CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(100) NOT NULL
) ENGINE=InnoDB;


-- Table: gallery

CREATE TABLE gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    category VARCHAR(100) NOT NULL,
    image_url VARCHAR(255) NOT NULL
) ENGINE=InnoDB;


-- Table: inquiries

CREATE TABLE inquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(150) NOT NULL,
    client_phone VARCHAR(30) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- Dummy data: services

INSERT INTO services (title, description, category) VALUES
('Profile Texture', 'Hand-applied textured profiles that bring depth and character to interior and exterior walls.', 'Texture'),
('American Spray', 'A smooth, factory-grade spray finish for an even, flawless coat on walls and ceilings.', 'Spray'),
('Plastic & Glass Paint', 'Specialist coatings formulated to bond and last on plastic surfaces and glass panels.', 'Specialty'),
('Roof Thermal Insulation', 'Reflective thermal coatings that reduce heat and protect roofing from weather damage.', 'Insulation');


-- Dummy data: gallery

INSERT INTO gallery (title, category, image_url) VALUES
('Showroom', 'Showroom', 'showroom.jpg'),
('Colour Match', 'Colour', 'colour-match.jpg'),
('Texture', 'Texture', 'texture-work.jpg'),
('Quality Work', 'Finish', 'quality-work.jpg'),
('Product Range', 'Products', 'product-range.jpg'),
('Profile Work', 'Texture', 'profile-work.jpg');
