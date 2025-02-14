CREATE TABLE Clients (
                         client_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                         first_name VARCHAR(255) NOT NULL CHECK (LENGTH(first_name) >= 3),
                         last_name VARCHAR(255) NOT NULL CHECK (LENGTH(last_name) >= 3),
                         phone_number VARCHAR(10) NOT NULL,
                         email VARCHAR(255) NOT NULL UNIQUE CHECK (email LIKE '%_@_%._%'),
                         username VARCHAR(40) NOT NULL,
                         password VARCHAR(255) NOT NULL,
                         is_admin INT,
                         role INT CHECK (role >= 0)
);

CREATE TABLE Courses (
                         course_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                         discipline VARCHAR(40) NOT NULL CHECK (LENGTH(discipline) >=3),
                         type VARCHAR(40)  NOT NULL CHECK ( LENGTH(type) >= 3),
                         course_description TEXT NOT NULL CHECK (LENGTH(course_description) >=10),
                         image_link VARCHAR(255),
                         section INT CHECK (section >= 0)
);

CREATE TABLE Registration (
                              registration_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                              client_id INT NOT NULL, FOREIGN KEY(client_id) REFERENCES Clients(client_id) ON DELETE CASCADE,
                              course_id INT NOT NULL, FOREIGN KEY (course_id) REFERENCES Courses(course_id) ON DELETE CASCADE
);

CREATE TABLE PrivateLessons (
                                private_lesson_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                date DATE NOT NULL,
                                status INT CHECK (status >= 0),
                                price FLOAT NOT NULL,
                                course_id INT NOT NULL, FOREIGN KEY (course_id) REFERENCES Courses(course_id) ON DELETE CASCADE
);

CREATE TABLE Stage (
                       stage_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                       date DATE NOT NULL,
                       max_partecipants INT CHECK (max_partecipants > 0),
                       price FLOAT NOT NULL CHECK (price >= 0),
                       course_id INT NOT NULL, FOREIGN KEY (course_id) REFERENCES Courses(course_id) ON DELETE CASCADE
);

CREATE TABLE UserFiles (
                           id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                           file_name VARCHAR(255) NOT NULL CHECK (LENGTH(file_name) > 3),
                           file_path VARCHAR(255) NOT NULL CHECK (LENGTH(file_path) > 3),
                           created_at DATETIME NOT NULL,
                           start_time DATE NOT NULL,
                           end_time DATE NOT NULL,
                           plan_description TEXT NOT NULL,
                           client_id INT NOT NULL, FOREIGN KEY (client_id) REFERENCES Clients(client_id) ON DELETE CASCADE
);

CREATE TABLE Reviews (
                         review_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                         rating INT NOT NULL CHECK (rating >= 0),
                         comment TEXT NOT NULL CHECK (LENGTH(comment) >= 3),
                         response TEXT NOT NULL CHECK (LENGTH(response) >= 3),
                         is_response INT CHECK (is_response >= 0),
                         client_id INT NOT NULL, FOREIGN KEY (client_id) REFERENCES Clients(client_id) ON DELETE CASCADE
);

CREATE TABLE Schedules (
                           schedule_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                           start_time DATE NOT NULL,
                           end_time DATE NOT NULL,
                           day_of_week INT NOT NULL,
                           client_id INT NOT NULL, FOREIGN KEY (client_id) REFERENCES Clients(client_id) ON DELETE CASCADE
);

CREATE TABLE Events (
                        event_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        event_name VARCHAR(40) NOT NULL CHECK (LENGTH(event_name) > 3),
                        type VARCHAR(40) NOT NULL CHECK (LENGTH(type) > 3),
                        event_description TEXT NOT NULL CHECK (LENGTH(event_description) > 20),
                        date DATE NOT NULL,
                        location VARCHAR(45) NOT NULL CHECK (LENGTH(location) > 0),
                        time TIME NOT NULL
);

CREATE TABLE Participation (
                               participation_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                               client_id INT NOT NULL, FOREIGN KEY (client_id) REFERENCES Clients(client_id) ON DELETE CASCADE,
                               event_id INT NOT NULL, FOREIGN KEY (event_id) REFERENCES Events(event_id) ON DELETE CASCADE
);

CREATE TABLE EventGallery (
                              event_gallery_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                              type VARCHAR(40) NOT NULL CHECK (LENGTH(type) > 0),
                              link VARCHAR(255) NOT NULL CHECK (LENGTH(link) > 0),
                              event_id INT NOT NULL, FOREIGN KEY (event_id) REFERENCES Events(event_id) ON DELETE CASCADE
);
