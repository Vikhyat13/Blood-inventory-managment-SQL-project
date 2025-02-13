-- Create the Database
CREATE DATABASE IF NOT EXISTS BloodInventoryDB;
USE BloodInventoryDB;

-- UserAdmin Table
CREATE TABLE UserAdmin (
    UserID VARCHAR(10) PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    UserMobile VARCHAR(15) UNIQUE NOT NULL
);

-- BloodBank Table
CREATE TABLE BloodBank (
    BankID VARCHAR(10) PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Location VARCHAR(100) NOT NULL,
    -- BloodGroup VARCHAR(5) NOT NULL,
    AdminID VARCHAR(10),
    AvailableBloodGroupNo TEXT,
    FOREIGN KEY (AdminID) REFERENCES UserAdmin(UserID)
);
CREATE TABLE admin_info (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_username VARCHAR(50) NOT NULL,
    admin_password VARCHAR(50) NOT NULL
);
/*  insert admin data into admin_info table*/
insert into admin_info(admin_name,admin_username,admin_password)
values("Labdhi","labdhi68",123);

-- Hospital Table
CREATE TABLE Hospital (
    HospitalID VARCHAR(10) PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Location VARCHAR(100) NOT NULL,
    BloodBankID VARCHAR(10),
    FOREIGN KEY (BloodBankID) REFERENCES BloodBank(BankID)
);

-- Donor Table
CREATE TABLE Donor (
    DonorID VARCHAR(10) PRIMARY KEY,
    DonorName VARCHAR(100) NOT NULL,
    DonorMobile VARCHAR(15) UNIQUE NOT NULL,
    DonorMail VARCHAR(100) UNIQUE NOT NULL,
    Age INT,
    Gender VARCHAR(10),
    DonorBloodGroup VARCHAR(5) NOT NULL,
    DonorAddress VARCHAR(255)
);

-- Patient Table
CREATE TABLE Patient (
    PatientID VARCHAR(10) PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Gender VARCHAR(10),
    Contact VARCHAR(15),
    DateOfReg DATE,
    Address VARCHAR(255),
    BloodGroup VARCHAR(5) NOT NULL
);

-- Blood Table
CREATE TABLE Blood (
    BloodID VARCHAR(10) PRIMARY KEY,
    BloodGroup VARCHAR(5) NOT NULL,
    DonorID VARCHAR(10),
    PatientID VARCHAR(10),
    BloodBankID VARCHAR(10),
    FOREIGN KEY (DonorID) REFERENCES Donor(DonorID),
    FOREIGN KEY (PatientID) REFERENCES Patient(PatientID),
    FOREIGN KEY (BloodBankID) REFERENCES BloodBank(BankID)
);

CREATE TABLE ManagesHospitalBloodbank (
    HospitalID VARCHAR(10),
    BloodBankID VARCHAR(10),
    PRIMARY KEY (HospitalID, BloodBankID), -- Composite Primary Key
    FOREIGN KEY (HospitalID) REFERENCES Hospital(HospitalID),
    FOREIGN KEY (BloodBankID) REFERENCES BloodBank(BankID)
);

INSERT INTO UserAdmin (UserID, Name, UserMobile)
VALUES
('U001', 'Rajesh Kumar', '9876543210'),
('U002', 'Anita Singh', '9958432100'),
('U003', 'Amit Sharma', '9934567890'),
('U004', 'Priya Patel', '9812345678'),
('U005', 'Suresh Yadav', '9798765432');

-- Insert Data into BloodBank Table
INSERT INTO BloodBank (BankID, Name, Location,  AvailableBloodGroupNo, AdminID)
VALUES
('B101', 'Delhi BloodBank', 'New Delhi', 'A+:50, A-:50', 'U001'),
('B102', 'Mumbai BloodBank', 'Mumbai', 'B+:45, B-:45', 'U001'),
('B103', 'Bangalore BloodBank', 'Bangalore', 'O+:60, O-:60', 'U002'),
('B104', 'Chennai BloodBank', 'Chennai', 'AB+:30, AB-:30', 'U003'),
('B105', 'Hyderabad BloodBank', 'Hyderabad', 'A-:40', 'U003'),
('B106', 'Kolkata BloodBank', 'Kolkata', 'B-:35', 'U004'),
('B107', 'Pune BloodBank', 'Pune', 'O-:25', 'U005'),
('B108', 'Jaipur BloodBank', 'Jaipur', 'AB-:20', 'U005'),
('B109', 'Chandigarh BloodBank', 'Chandigarh', 'A+:15, O-:15', 'U005'),
('B110', 'Surat BloodBank', 'Surat', 'B+:10, B-:10', 'U002');

INSERT INTO Patient (PatientID, Name, Gender, Contact, DateOfReg, Address, BloodGroup) VALUES
('P001', 'Ramesh Gupta', 'Male', '9876543210', '2025-01-01', 'Delhi, India', 'A+'),
('P002', 'Priya Sharma', 'Female', '9765432109', '2025-01-02', 'Mumbai, India', 'B+'),
('P003', 'Arun Verma', 'Male', '9856732198', '2025-01-03', 'Bangalore, India', 'O+'),
('P004', 'Sunita Singh', 'Female', '9785432101', '2025-01-04', 'Chennai, India', 'AB+'),
('P005', 'Manoj Yadav', 'Male', '9876432100', '2025-01-05', 'Hyderabad, India', 'A-'),
('P006', 'Suman Joshi', 'Female', '9865432101', '2025-01-06', 'Kolkata, India', 'B-'),
('P007', 'Vikram Mehta', 'Male', '9756432102', '2025-01-07', 'Pune, India', 'O-'),
('P008', 'Kavita Reddy', 'Female', '9845432103', '2025-01-08', 'Jaipur, India', 'AB-'),
('P009', 'Deepak Mishra', 'Male', '9835432104', '2025-01-09', 'Chandigarh, India', 'A+'),
('P010', 'Neha Patil', 'Female', '9825432105', '2025-01-10', 'Surat, India', 'B-'),
('P011', 'Anil Kumar', 'Male', '9816543211', '2025-01-11', 'Lucknow, India', 'A-'),
('P012', 'Meena Kapoor', 'Female', '9796543212', '2025-01-12', 'Indore, India', 'B-'),
('P013', 'Rajesh Reddy', 'Male', '9786543213', '2025-01-13', 'Nagpur, India', 'O-'),
('P014', 'Shalini Gupta', 'Female', '9776543214', '2025-01-14', 'Patna, India', 'AB-'),
('P015', 'Ajay Tiwari', 'Male', '9766543215', '2025-01-15', 'Guwahati, India', 'A-'),
('P016', 'Rekha Sinha', 'Female', '9756543216', '2025-01-16', 'Ahmedabad, India', 'B-'),
('P017', 'Suresh Malhotra', 'Male', '9746543217', '2025-01-17', 'Shimla, India', 'A-'),
('P018', 'Poonam Bansal', 'Female', '9736543218', '2025-01-18', 'Kanpur, India', 'B-'),
('P019', 'Naveen Joshi', 'Male', '9726543219', '2025-01-19', 'Thiruvananthapuram, India', 'O-'),
('P020', 'Anita Rao', 'Female', '9716543220', '2025-01-20', 'Jammu, India', 'AB-');


INSERT INTO Donor (DonorID, DonorName, Gender, DonorMobile, DonorMail, Age, DonorBloodGroup, DonorAddress)
VALUES
('D001', 'Suresh Kumar', 'Male', '9876543210', 'suresh.kumar@example.com', 30, 'A+', 'Delhi, India'),
('D002', 'Anjali Verma', 'Female', '9765432109', 'anjali.verma@example.com', 28, 'B+', 'Mumbai, India'),
('D003', 'Rahul Sharma', 'Male', '9856732198', 'rahul.sharma@example.com', 35, 'O+', 'Bangalore, India'),
('D004', 'Neha Gupta', 'Female', '9785432101', 'neha.gupta@example.com', 29, 'AB+', 'Chennai, India'),
('D005', 'Vikram Yadav', 'Male', '9876432100', 'vikram.yadav@example.com', 32, 'A-', 'Hyderabad, India'),
('D006', 'Rekha Patil', 'Female', '9865432101', 'rekha.patil@example.com', 27, 'B-', 'Kolkata, India'),
('D007', 'Nitin Mehta', 'Male', '9756432102', 'nitin.mehta@example.com', 34, 'O-', 'Pune, India'),
('D008', 'Aishwarya Reddy', 'Female', '9845432103', 'aishwarya.reddy@example.com', 26, 'AB-', 'Jaipur, India'),
('D009', 'Manoj Mishra', 'Male', '9835432104', 'manoj.mishra@example.com', 40, 'A+', 'Chandigarh, India'),
('D010', 'Sanya Patel', 'Female', '9825432105', 'sanya.patel@example.com', 24, 'B-', 'Surat, India'),
('D011', 'Amit Rathi', 'Male', '9816543211', 'amit.rathi@example.com', 33, 'A-', 'Lucknow, India'),
('D012', 'Priya Joshi', 'Female', '9796543212', 'priya.joshi@example.com', 25, 'B-', 'Indore, India'),
('D013', 'Rajeev Kapoor', 'Male', '9786543213', 'rajeev.kapoor@example.com', 31, 'O-', 'Nagpur, India'),
('D014', 'Sunita Bansal', 'Female', '9776543214', 'sunita.bansal@example.com', 29, 'AB-', 'Patna, India'),
('D015', 'Arvind Sinha', 'Male', '9766543215', 'arvind.sinha@example.com', 38, 'O-', 'Guwahati, India'),
('D016', 'Pooja Gupta', 'Female', '9756543216', 'pooja.gupta@example.com', 23, 'B-', 'Ahmedabad, India'),
('D017', 'Ashok Kumar', 'Male', '9746543217', 'ashok.kumar@example.com', 36, 'A-', 'Shimla, India'),
('D018', 'Madhuri Joshi', 'Female', '9736543218', 'madhuri.joshi@example.com', 29, 'B-', 'Kanpur, India'),
('D019', 'Pradeep Mehta', 'Male', '9726543219', 'pradeep.mehta@example.com', 37, 'O-', 'Thiruvananthapuram, India'),
('D020', 'Neelam Rao', 'Female', '9716543220', 'neelam.rao@example.com', 27, 'AB-', 'Jammu, India');

INSERT INTO Blood (BloodID, BloodGroup, DonorID, PatientID, BloodBankID) VALUES
('B001', 'A+', 'D001', 'P001', 'B101'),
('B002', 'B+', 'D002', 'P002', 'B102'),
('B003', 'O+', 'D003', 'P003', 'B103'),
('B004', 'AB+', 'D004', 'P004', 'B104'),
('B005', 'A-', 'D005', 'P005', 'B105'),
('B006', 'B-', 'D006', 'P006', 'B106'),
('B007', 'O-', 'D007', 'P007', 'B107'),
('B008', 'AB-', 'D008', 'P008', 'B108'),
('B009', 'A+', 'D009', 'P009', 'B109'),
('B010', 'B-', 'D010', 'P010', 'B110'),
('B011', 'A-', 'D011', 'P011', 'B101'),
('B012', 'B-', 'D012', 'P012', 'B102'),
('B013', 'O-', 'D013', 'P013', 'B103'),
('B014', 'AB-', 'D014', 'P014', 'B104'),
('B015', 'A-', 'D015', 'P015', 'B105'),
('B016', 'B-', 'D016', 'P016', 'B106'),
('B017', 'A-', 'D017', 'P017', 'B107'),
('B018', 'B-', 'D018', 'P018', 'B108'),
('B019', 'O-', 'D019', 'P019', 'B109'),
('B020', 'AB-', 'D020', 'P020', 'B110');


INSERT INTO Hospital (HospitalID, Name, Location, BloodBankID)
VALUES
('H001', 'AIIMS Delhi', 'New Delhi', NULL),
('H002', 'Lilavati Hospital', 'Mumbai', NULL),
('H003', 'Manipal Hospital', 'Bangalore', NULL),
('H004', 'Apollo Hospital', 'Chennai', NULL),
('H005', 'Care Hospital', 'Hyderabad', NULL),
('H006', 'AMRI Hospital', 'Kolkata', NULL),
('H007', 'Ruby Hall Clinic', 'Pune', NULL),
('H008', 'Jaipur Golden Hospital', 'Jaipur', NULL),
('H009', 'PGIMER Chandigarh', 'Chandigarh', NULL),
('H010', 'Sunshine Hospital', 'Surat', NULL),
('H011', 'Fortis Hospital', 'New Delhi', NULL),
('H012', 'Hinduja Hospital', 'Mumbai', NULL),
('H013', 'Sparsh Hospital', 'Bangalore', NULL),
('H014', 'Billroth Hospital', 'Chennai', NULL),
('H015', 'KIMS Hospital', 'Hyderabad', NULL);

INSERT INTO ManagesHospitalBloodbank (HospitalID, BloodBankID)
VALUES
-- Existing relationships
('H001', 'B101'),
('H011', 'B101'),
('H002', 'B102'),
('H012', 'B102'),
('H003', 'B103'),
('H013', 'B103'),
('H004', 'B104'),
('H014', 'B104'),
('H005', 'B105'),
('H015', 'B105'),
('H006', 'B106'),
('H007', 'B107'),
('H008', 'B108'),
('H009', 'B109'),
('H010', 'B110'),

-- New relationships to show one hospital contacting multiple blood banks
('H001', 'B102'), -- AIIMS Delhi linked to B102
('H001', 'B103'), -- AIIMS Delhi linked to B103
('H002', 'B101'), -- Lilavati Hospital linked to B101
('H003', 'B105'), -- Manipal Hospital linked to B105
('H004', 'B106'), -- Apollo Hospital linked to B106
('H005', 'B103'), -- Care Hospital linked to B103
('H005', 'B107'), -- Care Hospital linked to B107
('H006', 'B105'), -- AMRI Hospital linked to B105
('H007', 'B109'), -- Ruby Hall Clinic linked to B109
('H007', 'B110'), -- Ruby Hall Clinic linked to B110
('H008', 'B106'), -- Jaipur Golden Hospital linked to B106
('H009', 'B104'), -- PGIMER Chandigarh linked to B104
('H010', 'B108'), -- Sunshine Hospital linked to B108
('H010', 'B109'), -- Sunshine Hospital linked to B109
('H015', 'B108'); -- KIMS linked to another blood bank

