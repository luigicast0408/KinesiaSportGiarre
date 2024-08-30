CREATE TABLE Clients
(
    client_id    INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name   VARCHAR(255) NOT NULL,
    last_name    VARCHAR(255) NOT NULL,
    phone_number VARCHAR(255) NOT NULL,
    email        VARCHAR(255) NOT NULL,
    username     VARCHAR(255) NOT NULL,
    password     VARCHAR(255) NOT NULL
);
ALTER TABLE Clients
    AUTO_INCREMENT = 1;

CREATE TABLE Registrations
(
    registration_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    client_id       INT NOT NULL,
    course_id       INT NOT NULL,
    FOREIGN KEY (client_id) REFERENCES Clients (client_id),
    FOREIGN KEY (course_id) REFERENCES Courses (course_id)
);
ALTER TABLE Registrations
    AUTO_INCREMENT = 1;

CREATE TABLE Courses
(
    course_id          INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
    type               VARCHAR(255) NOT NULL,
    discipline         VARCHAR(255) NOT NULL,
    price              FLOAT        NOT NULL,
    course_description TEXT NOT NULL,
    image              VARCHAR(255),
    section INT
);
ALTER TABLE Courses
    AUTO_INCREMENT = 1;

CREATE TABLE ContactUs (
                           contact_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                           type VARCHAR(255) NOT NULL, -- REVIEW / CONTACT
                           message VARCHAR(255) NOT NULL,
                           response VARCHAR(255),
                           client_id INT NOT NULL,
                           FOREIGN KEY (client_id) REFERENCES Clients(client_id)
);
ALTER TABLE ContactUs AUTO_INCREMENT = 1;

CREATE TABLE ClientEvents (
                              client_event_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                              client_id INT NOT NULL,
                              event_id INT NOT NULL,
                              FOREIGN KEY (client_id) REFERENCES Clients(client_id),
                              FOREIGN KEY (event_id) REFERENCES Events(event_id)
);
ALTER TABLE ClientEvents AUTO_INCREMENT = 1;

CREATE TABLE Events (
                        event_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        event_name VARCHAR(255) NOT NULL,
                        type VARCHAR(255) NOT NULL,
                        event_description VARCHAR(255) NOT NULL,
                        date DATE NOT NULL,
                        location VARCHAR(255) NOT NULL,
                        image VARCHAR(255),
                        time TIME NOT NULL
);
ALTER TABLE Events AUTO_INCREMENT = 1;

CREATE TABLE Gallery (
                         gallery_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                         type VARCHAR(10) NOT NULL,
                         link VARCHAR(255) NOT NULL,
                         course_id INT,
                         event_id INT,
                         FOREIGN KEY (course_id) REFERENCES Courses(course_id),
                         FOREIGN KEY (event_id) REFERENCES Events(event_id)
);
ALTER TABLE Gallery AUTO_INCREMENT = 1;

CREATE TABLE Instructors (
                             instructor_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                             first_name VARCHAR(255) NOT NULL,
                             last_name VARCHAR(255) NOT NULL,
                             description VARCHAR(225) NOT NULL,
                             phone_number VARCHAR(255) NOT NULL,
                             email VARCHAR(255) NOT NULL,
                             image_link VARCHAR(255) NOT NULL,
                             course_id INT NOT NULL,
                             FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);
ALTER TABLE Instructors AUTO_INCREMENT = 1;

CREATE TABLE TrainingPlans (
                               plan_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                               client_id INT NOT NULL,
                               plan_description VARCHAR(50) NOT NULL,
                               start_date DATETIME NOT NULL,
                               end_date DATETIME NOT NULL,
                               FOREIGN KEY (client_id) REFERENCES Clients(client_id)
);
ALTER TABLE TrainingPlans AUTO_INCREMENT = 1;