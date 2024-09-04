use eventease;
CREATE TABLE Admins (
    AdminID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE Users (
    userID INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    user_password VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    fullName VARCHAR(100) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL
);


CREATE TABLE Auditoriums (
    AuditoriumID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Address VARCHAR(255) NOT NULL,
    Capacity INT NOT NULL,
    SeatingArrangement VARCHAR(100),
    ParkingCapacity INT,
    ParkingPictureURL VARCHAR(255),
    FoodSectionCapacity INT,
    FoodSectionPictureURL VARCHAR(255),
    IndoorPictureURL VARCHAR(255),
    Description TEXT,
    Auditorium_Phone VARCHAR(20) NOT NULL,
    Auditorium_Email VARCHAR(100) NOT NULL
);


CREATE TABLE Reservations (
    ReservationID INT PRIMARY KEY AUTO_INCREMENT,
    AuditoriumID INT,
    AuditoriumName VARCHAR(255),
    UserID INT,
    ReservationDate DATE NOT NULL,
    StartTime TIME NOT NULL,
    EndTime TIME NOT NULL,
    Status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending',
    ReservationTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (AuditoriumID) REFERENCES Auditoriums(AuditoriumID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);


CREATE TABLE AuditoriumAdmins (
    AdminID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    AuditoriumID INT,
    FOREIGN KEY (AuditoriumID) REFERENCES Auditoriums(AuditoriumID)
);

CREATE TABLE Feedback (
    FeedbackID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    AuditoriumID INT,
    Rating INT,
    Comment TEXT,
    FeedbackDate DATE,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (AuditoriumID) REFERENCES Auditoriums(AuditoriumID)
);

CREATE TABLE Reservation_Info (
    ReservationID INT PRIMARY KEY,
    AuditoriumID INT,
    UserID INT,
    Username VARCHAR(50),
    ReservationDate DATE,
    StartTime TIME,
    EndTime TIME,
    Status ENUM('Pending', 'Confirmed', 'Cancelled'),
    ReservationTime TIMESTAMP,
    FeedbackID INT,
    FOREIGN KEY (ReservationID) REFERENCES Reservations(ReservationID),
    FOREIGN KEY (AuditoriumID) REFERENCES Auditoriums(AuditoriumID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (FeedbackID) REFERENCES Feedback(FeedbackID)
);
