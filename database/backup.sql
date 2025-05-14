-- Tạo bảng UserRoles
CREATE TABLE UserRoles (
    userRoleID INT PRIMARY KEY AUTO_INCREMENT,
    roleName VARCHAR(50) NOT NULL,
    isActive BOOLEAN DEFAULT TRUE
);

-- Tạo bảng Users
CREATE TABLE Users (
    userID INT PRIMARY KEY AUTO_INCREMENT,
    userName VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    avatar VARCHAR(255),
    userRoleID INT,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (userRoleID) REFERENCES UserRoles(userRoleID)
);

-- Tạo bảng Customers
CREATE TABLE Customers (
    customerID INT PRIMARY KEY,
    customerName VARCHAR(100) NOT NULL,
    phoneNumber VARCHAR(15),
    address TEXT,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (customerID) REFERENCES Users(userID)
);

-- Tạo bảng Topics
CREATE TABLE Topics (
    topicID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    createdBy INT,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (createdBy) REFERENCES Users(userID)
);

-- Tạo bảng Posts
CREATE TABLE Posts (
    postID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    content TEXT,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255),
    userID INT,
    topicID INT,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (userID) REFERENCES Users(userID),
    FOREIGN KEY (topicID) REFERENCES Topics(topicID)
);

-- Tạo bảng Comments
CREATE TABLE Comments (
    commentID INT PRIMARY KEY AUTO_INCREMENT,
    content TEXT NOT NULL,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255),
    parentCommentID INT,
    userID INT,
    postID INT,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (parentCommentID) REFERENCES Comments(commentID),
    FOREIGN KEY (userID) REFERENCES Users(userID),
    FOREIGN KEY (postID) REFERENCES Posts(postID)
);

-- Tạo bảng Messages
CREATE TABLE Messages (
    messageID INT PRIMARY KEY AUTO_INCREMENT,
    content TEXT NOT NULL,
    sentAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    isRead BOOLEAN DEFAULT FALSE,
    senderID INT NOT NULL,
    receiverID INT NOT NULL,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (senderID) REFERENCES Users(userID),
    FOREIGN KEY (receiverID) REFERENCES Users(userID)
);

-- Tạo bảng Articles
CREATE TABLE Articles (
    articleID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200),
    content TEXT NOT NULL,
    image VARCHAR(255),
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    userID INT,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (userID) REFERENCES Users(userID)
);

-- Tạo bảng Brands
CREATE TABLE Brands (
    brandID INT PRIMARY KEY AUTO_INCREMENT,
    brandName VARCHAR(100) NOT NULL,
    country VARCHAR(100),
    isActive BOOLEAN DEFAULT TRUE
);

-- Tạo bảng Category
CREATE TABLE Category (
    categoryID INT PRIMARY KEY AUTO_INCREMENT,
    categoryName VARCHAR(100) NOT NULL,
    isActive BOOLEAN DEFAULT TRUE
);

-- Tạo bảng Products
CREATE TABLE Products (
    productID INT PRIMARY KEY AUTO_INCREMENT,
    productName VARCHAR(200) NOT NULL,
    title VARCHAR(255),
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stockQuantity INT NOT NULL DEFAULT 0,
    image VARCHAR(255),
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    brandID INT,
    categoryID INT,
    ageFrom INT,
    ageTo INT,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (brandID) REFERENCES Brands(brandID),
    FOREIGN KEY (categoryID) REFERENCES Category(categoryID)
);

-- Tạo bảng Discount_Types
CREATE TABLE Discount_Types (
    discountTypeID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    isActive BOOLEAN DEFAULT TRUE
);

-- Tạo bảng Promotions
CREATE TABLE Promotions (
    promotionID INT PRIMARY KEY AUTO_INCREMENT,
    promotionName VARCHAR(200) NOT NULL,
    discountValue DECIMAL(10, 2) NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    productID INT,
    discountTypeID INT,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (productID) REFERENCES Products(productID),
    FOREIGN KEY (discountTypeID) REFERENCES Discount_Types(discountTypeID)
);

-- Tạo bảng Vouchers
CREATE TABLE Vouchers (
    code VARCHAR(50) PRIMARY KEY,
    minOrderValue DECIMAL(10, 2),
    discountValue DECIMAL(10, 2) NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    isActive BOOLEAN DEFAULT TRUE
);

-- Tạo bảng Customer_Voucher
CREATE TABLE Customer_Voucher (
    customerVoucherID INT PRIMARY KEY AUTO_INCREMENT,
    isUsed BOOLEAN DEFAULT FALSE,
    customerID INT,
    code VARCHAR(50),
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (customerID) REFERENCES Customers(customerID),
    FOREIGN KEY (code) REFERENCES Vouchers(code)
);

-- Tạo bảng Orders
CREATE TABLE `Orders` (
    orderID INT PRIMARY KEY AUTO_INCREMENT,
    guestEmail VARCHAR(100),
    guestName VARCHAR(100) NOT NULL,
    guestPhoneNumber VARCHAR(15),
    shippingAddress TEXT,
    paymentMethod VARCHAR(50),
    totalAmount DECIMAL(10, 2) NOT NULL,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    customerID INT,
    code VARCHAR(50),
    isActive BOOLEAN DEFAULT TRUE,
    orderStatusID INT,
    FOREIGN KEY (orderStatusID) REFERENCES Order_Status(orderStatusID),
    FOREIGN KEY (customerID) REFERENCES Customers(customerID),
    FOREIGN KEY (code) REFERENCES Vouchers(code)
);

-- Tạo bảng Order_Status
CREATE TABLE Order_Status (
    orderStatusID INT PRIMARY KEY AUTO_INCREMENT,
    statusName VARCHAR(50) NOT NULL,
    isActive BOOLEAN DEFAULT TRUE,
);

-- Tạo bảng Order_Item
CREATE TABLE Order_Item (
    orderItemID INT PRIMARY KEY AUTO_INCREMENT,
    quantity INT NOT NULL,
    unitPrice DECIMAL(10, 2) NOT NULL,
    subTotal DECIMAL(10, 2) NOT NULL,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    orderID INT,
    productID INT,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (orderID) REFERENCES `Orders`(orderID),
    FOREIGN KEY (productID) REFERENCES Products(productID)
);

-- Tạo bảng Cart
CREATE TABLE Carts (
    cartID INT PRIMARY KEY AUTO_INCREMENT,
    customerID INT,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (customerID) REFERENCES Customers(customerID)
);

-- Tạo bảng Cart_Item
CREATE TABLE Cart_Item (
    cartItemID INT PRIMARY KEY AUTO_INCREMENT,
    quantity INT NOT NULL,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    cartID INT,
    productID INT,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (cartID) REFERENCES Carts(cartID),
    FOREIGN KEY (productID) REFERENCES Products(productID)
);

-- Tạo bảng Reviews
CREATE TABLE Reviews (
    reviewID INT PRIMARY KEY AUTO_INCREMENT,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    productID INT,
    customerID INT,
    isActive BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (productID) REFERENCES Products(productID),
    FOREIGN KEY (customerID) REFERENCES Customers(customerID)
);

-- Tạo bảng Product_gallery
CREATE TABLE product_gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    productID INT NOT NULL,
    imagePath VARCHAR(255) NOT NULL,
    uploadedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (productID) REFERENCES products(productID) ON DELETE CASCADE
);

ALTER TABLE category ADD COLUMN code varchar(255) not null UNIQUE
alter table Brands add COLUMN brandCode varchar(255) not null UNIQUE

