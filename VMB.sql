CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tạo bảng Airlines
CREATE TABLE Airlines (
    airline_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    contact_info VARCHAR(255)
);

-- Tạo bảng Flights
CREATE TABLE Flights (
    flight_id INT PRIMARY KEY AUTO_INCREMENT,
    flight_number VARCHAR(10) NOT NULL,
    departure_airport VARCHAR(100) NOT NULL,
    arrival_airport VARCHAR(100) NOT NULL,
    departure_time DATETIME NOT NULL,
    arrival_time DATETIME NOT NULL,
    airline_id INT,
    seat_capacity INT,
    adult_price DECIMAL(10, 2) NOT NULL,
    child_price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (airline_id) REFERENCES Airlines(airline_id)
);

-- Tạo bảng Bookings
CREATE TABLE Bookings (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NULL,
    flight_id INT NOT NULL,
    booking_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    number_of_adult_tickets INT NOT NULL,
    number_of_child_tickets INT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (flight_id) REFERENCES Flights(flight_id)
);

-- Tạo bảng Passengers
CREATE TABLE Passengers (
    passenger_id INT PRIMARY KEY AUTO_INCREMENT,
    booking_id INT NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    passport_number VARCHAR(20),
    nationality VARCHAR(50),
    email VARCHAR(100),
    phone_number VARCHAR(20),
    FOREIGN KEY (booking_id) REFERENCES Bookings(booking_id)
);

-- Tạo bảng Payments
CREATE TABLE Payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    booking_id INT NOT NULL,
    payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    amount DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    status VARCHAR(20) NOT NULL,
    FOREIGN KEY (booking_id) REFERENCES Bookings(booking_id)
);


INSERT INTO Users (username, password, email, phone_number) VALUES
('user1', 'hashed_password_1', 'user1@example.com', '0912345678'),
('user2', 'hashed_password_2', 'user2@example.com', '0923456789'),
('user3', 'hashed_password_3', 'user3@example.com', '0934567890');

INSERT INTO Airlines (name, contact_info) VALUES
('Vietnam Airlines', 'contact@vietnamairlines.com'),
('Bamboo Airways', 'contact@bambooairways.com'),
('VietJet Air', 'contact@vietjetair.com');

INSERT INTO Flights (flight_number, departure_airport, arrival_airport, departure_time, arrival_time, airline_id, seat_capacity, adult_price, child_price) VALUES
('VN123', 'Hanoi', 'Ho Chi Minh', '2024-12-01 08:00:00', '2024-12-01 10:00:00', 1, 180, 150.00, 75.00),
('BL456', 'Da Nang', 'Hanoi', '2024-12-02 12:00:00', '2024-12-02 14:00:00', 2, 200, 100.00, 50.00),
('VJ789', 'Ho Chi Minh', 'Nha Trang', '2024-12-03 15:00:00', '2024-12-03 16:30:00', 3, 150, 120.00, 60.00);

INSERT INTO Bookings (user_id, flight_id, booking_date, number_of_adult_tickets, number_of_child_tickets, total_price) VALUES
(1, 1, '2024-11-15 10:00:00', 2, 1, (150.00 * 2 + 75.00 * 1)),  -- User 1 đặt vé cho chuyến bay VN123
(2, 2, '2024-11-14 11:00:00', 1, 0, (100.00 * 1));                -- User 2 đặt vé cho chuyến bay BL456
INSERT INTO Bookings (user_id, flight_id, booking_date, number_of_adult_tickets, number_of_child_tickets, total_price) VALUES
(NULL, 3, '2024-11-13 12:00:00', 0, 1, (60.00 * 1));               -- Đặt vé không có tài khoản cho User 3

INSERT INTO Passengers (booking_id, first_name, last_name, date_of_birth, gender, passport_number, nationality, email, phone_number) VALUES
(1, 'Nguyễn', 'Thị A', '1990-01-15', 'Female', 'P123456789', 'Vietnam', 'a.nguyen@example.com', '0912345678'),
(1, 'Trần', 'Văn B', '2012-05-20', 'Male', 'P987654321', 'Vietnam', 'b.tran@example.com', '0987654321'),
(2, 'Lê', 'Thị C', '1988-05-20', 'Female', 'P123456788', 'Vietnam', 'c.le@example.com', '0901234567'),
(3, 'Hoàng', 'Văn D', '2012-07-10', 'Male', 'P111111111', 'Vietnam', 'd.hoang@example.com', '0912345679');

INSERT INTO Payments (booking_id, amount, payment_method, status) VALUES
(1, 375.00, 'Bank Transfer', 'Completed'),  -- Thanh toán cho booking ID 1
(2, 100.00, 'Bank Transfer', 'Completed'),   -- Thanh toán cho booking ID 2
(3, 60.00, 'Bank Transfer', 'Completed'); 