CREATE TABLE locations (
  location_id INT NOT NULL AUTO_INCREMENT,
  region VARCHAR(100),
  ctyName VARCHAR(100),
  PRIMARY KEY(location_id)
);

CREATE TABLE teachers (
  teacher_id INT NOT NULL AUTO_INCREMENT,
  avatar VARCHAR(10),
  tchName VARCHAR(100),
  tchSurname VARCHAR(100),
  schoolName VARCHAR(150),
  tchEmail VARCHAR(150),
  contact VARCHAR (50),
  qualification VARCHAR(200),
  address VARCHAR(100),
  tchPwd VARCHAR(250),
  location_id INT,
  PRIMARY KEY(teacher_id),
  CONSTRAINT fk_teachers FOREIGN KEY(location_id) REFERENCES locations(location_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE users (
  user_id INT NOT NULL AUTO_INCREMENT,
  userName VARCHAR(100),
  userSurname VARCHAR(100),
  userEmail VARCHAR(100),
  userPwd VARCHAR(250),
  userContact VARCHAR(50),
  userAddress VARCHAR(100),
  status VARCHAR(50),
  location_id INT,
  PRIMARY KEY (user_id),
  FOREIGN KEY (location_id) REFERENCES locations(location_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE subjects (
  subject_id INT NOT NULL AUTO_INCREMENT,
  sbtName VARCHAR(50),
  category VARCHAR(200),
  teacher_id INT,
  PRIMARY KEY(subject_id),
  FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE rating (
  rate_id INT NOT NULL AUTO_INCREMENT,
  teacher_id INT,
  rate INT,
  RDate DATE,
  comments VARCHAR(250),
  user_id INT REFERENCES users(user_id),
  PRIMARY KEY(rate_id),
  FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE booking (
  booking_id INT NOT NULL AUTO_INCREMENT,
  bkDate DATE,
  user_id INT,
  PRIMARY KEY(booking_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE subjects_teachers (
  id INT NOT NULL AUTO_INCREMENT,
  subject_id INT,
  teacher_id INT,
  PRIMARY KEY(id),
  FOREIGN KEY (subject_id) REFERENCES subjects(subject_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE administrator (
  admin_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  adminName VARCHAR(100),
  adminSurname VARCHAR(100),
  adminEmail VARCHAR(150),
  adminPwd VARCHAR(250)
);

CREATE TABLE categories (
  category_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  category VARCHAR(150)
);

ALTER TABLE subjects
ADD CONSTRAINT FK_categories
FOREIGN KEY (category_id)
REFERENCES categories(category_id) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE uers_categories (
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  user_id INT,
  category_id INT,
  FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(category_id) REFERENCES categories(category_id) ON DELETE CASCADE ON UPDATE CASCADE
);