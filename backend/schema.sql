CREATE DATABASE caregiver_website;

USE caregiver_website;

CREATE TABLE Members (
    MemberID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Email VARCHAR(100) UNIQUE,
    Phone VARCHAR(15),
    Address TEXT,
    PasswordHash VARCHAR(255),
    CareMoneyBalance INT DEFAULT 2000,
    MaxAvailableHoursPerWeek INT,
    Rating DECIMAL(3, 2) DEFAULT 0
);

CREATE TABLE Parents (
    ParentID INT AUTO_INCREMENT PRIMARY KEY,
    MemberID INT,
    Name VARCHAR(100),
    Age INT,
    HealthStatus TEXT,
    Address TEXT,
    FOREIGN KEY (MemberID) REFERENCES Members(MemberID) ON DELETE CASCADE
);

CREATE TABLE Contracts (
    ContractID INT AUTO_INCREMENT PRIMARY KEY,
    MemberID INT,
    CaregiverID INT,
    ParentID INT,
    StartDate DATE,
    EndDate DATE,
    TotalHours INT,
    HourlyRate INT DEFAULT 30,
    FOREIGN KEY (MemberID) REFERENCES Members(MemberID),
    FOREIGN KEY (CaregiverID) REFERENCES Members(MemberID),
    FOREIGN KEY (ParentID) REFERENCES Parents(ParentID)
);

CREATE TABLE Payments (
    PaymentID INT AUTO_INCREMENT PRIMARY KEY,
    ContractID INT,
    Amount INT,
    PaymentDate DATE,
    FOREIGN KEY (ContractID) REFERENCES Contracts(ContractID)
);

CREATE TABLE Reviews (
    ReviewID INT AUTO_INCREMENT PRIMARY KEY,
    ContractID INT,
    ReviewerID INT,
    CaregiverID INT,
    Rating INT CHECK (Rating BETWEEN 1 AND 5),
    Comment TEXT,
    FOREIGN KEY (ContractID) REFERENCES Contracts(ContractID),
    FOREIGN KEY (ReviewerID) REFERENCES Members(MemberID),
    FOREIGN KEY (CaregiverID) REFERENCES Members(MemberID)
);

CREATE TABLE CareDollarTransactions (
    TransactionID INT AUTO_INCREMENT PRIMARY KEY,
    MemberID INT,
    TransactionType ENUM('credit', 'debit'),
    Amount INT,
    TransactionDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (MemberID) REFERENCES Members(MemberID)
);
