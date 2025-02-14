CREATE TABLE Clients (
                         client_id INT AUTO_INCREMENT PRIMARY KEY,
                         first_name VARCHAR(50) NOT NULL,
                         last_name VARCHAR(50) NOT NULL,
                         phone_number VARCHAR(15) UNIQUE,
                         email VARCHAR(100) UNIQUE NOT NULL,
                         isAdmin BOOLEAN DEFAULT 0
);

