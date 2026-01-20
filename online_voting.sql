-- =========================================
-- ONLINE VOTING SYSTEM DATABASE STRUCTURE
-- =========================================

-- 1) Create Database
CREATE DATABASE IF NOT EXISTS online_voting;
USE online_voting;
CREATE TABLE voters (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  phone VARCHAR(15),
  nid VARCHAR(20) UNIQUE,
  password VARCHAR(255),
  voted INT DEFAULT 0
);

CREATE TABLE candidates (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  party VARCHAR(100),
  slogan VARCHAR(255),
  votes INT DEFAULT 0,
  status ENUM('pending','approved') DEFAULT 'pending'
);

CREATE TABLE admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255)
);
INSERT INTO admin (email, password) VALUES
('admin@vote.com', '$2y$10$wQ7n9w9vYbQJZ6YxBvQfhe2Qh2Fj2Zc9Vx2vPqO7w9cO0F8kQxD6G'); 
-- password = admin123

INSERT INTO candidates (name, party, slogan, status) VALUES
('Candidate A','Party A','Better Future','approved'),
('Candidate B','Party B','Strong Nation','approved'),
('Candidate C','Party C','Progress & Peace','approved'),
('Candidate D','Party D','Unity & Growth','approved'),
('Candidate E','Party E','Hope & Change','approved');

-- 5) Insert Sample Candidates
INSERT INTO candidates (name, party, slogan) VALUES
('Candidate A', 'Party A', 'Better Future'),
('Candidate B', 'Party B', 'Strong Nation'),
('Candidate C', 'Party C', 'Progress & Peace'),
('Candidate D', 'Party D', 'Unity & Growth'),
('Candidate E', 'Party E', 'Hope & Change');

-- 6) Insert Admin
INSERT INTO admin (email, password) VALUES
('admin@vote.com', 'admin123');

UPDATE candidates SET image='candidate_a.png' WHERE name='Candidate A';
UPDATE candidates SET image='candidate_b.png' WHERE name='Candidate B';
UPDATE candidates SET image='candidate_c.png' WHERE name='Candidate C';
UPDATE candidates SET image='candidate_d.png' WHERE name='Candidate D';
UPDATE candidates SET image='candidate_e.png' WHERE name='Candidate E';

UPDATE candidates SET email = 'candidateA@gmail.com' WHERE id = 1;
UPDATE candidates SET email = 'candidateB@gmail.com' WHERE id = 2;
UPDATE candidates SET email = 'candidateC@gmail.com' WHERE id = 3;
UPDATE candidates SET email = 'candidateD@gmail.com' WHERE id = 4;
UPDATE candidates SET email = 'candidateE@gmail.com' WHERE id = 5;


CREATE TABLE candidate_delete_log (
  id INT AUTO_INCREMENT PRIMARY KEY,
  candidate_id INT NOT NULL,
  candidate_name VARCHAR(255) NOT NULL,
  reason TEXT NOT NULL,
  deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE voters ADD COLUMN status VARCHAR(20) NOT NULL DEFAULT 'pending';
UPDATE voters SET status = 'approved' WHERE id = 1;
