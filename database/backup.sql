-- Táº¡o báº£ng UserRole
CREATE TABLE UserRole (
    userRoleID INT PRIMARY KEY AUTO_INCREMENT,
    roleName VARCHAR(50) NOT NULL
);

-- Táº¡o báº£ng User
CREATE TABLE User (
    userID INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    avatar VARCHAR(255),
    userRoleID INT,
    FOREIGN KEY (userRoleID) REFERENCES UserRole(userRoleID)
);

-- Táº¡o báº£ng Customer
CREATE TABLE Customer (
    customerID INT PRIMARY KEY AUTO_INCREMENT,
    customerName VARCHAR(100) NOT NULL,
    phoneNumber VARCHAR(15),
    address TEXT,
    userID INT,
    FOREIGN KEY (userID) REFERENCES User(userID)
);

-- Táº¡o báº£ng Topic
CREATE TABLE Topic (
    topicID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    createdBy INT,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (createdBy) REFERENCES User(userID)
);

-- Táº¡o báº£ng Post
CREATE TABLE Post (
    postID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    content TEXT,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255),
    userID INT,
    topicID INT,
    FOREIGN KEY (userID) REFERENCES User(userID),
    FOREIGN KEY (topicID) REFERENCES Topic(topicID)
);

-- Táº¡o báº£ng Comment
CREATE TABLE Comment (
    commentID INT PRIMARY KEY AUTO_INCREMENT,
    content TEXT NOT NULL,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255),
    parentCommentID INT,
    userID INT,
    postID INT,
    FOREIGN KEY (parentCommentID) REFERENCES Comment(commentID),
    FOREIGN KEY (userID) REFERENCES User(userID),
    FOREIGN KEY (postID) REFERENCES Post(postID)
);

-- Táº¡o báº£ng Message
CREATE TABLE Message (
    messageID INT PRIMARY KEY AUTO_INCREMENT,
    content TEXT NOT NULL,
    sentAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    isRead BOOLEAN DEFAULT FALSE,
    senderID INT NOT NULL,
    receiverID INT NOT NULL,
    FOREIGN KEY (senderID) REFERENCES User(userID),
    FOREIGN KEY (receiverID) REFERENCES User(userID)
);

-- Táº¡o báº£ng Article
CREATE TABLE Article (
    articleID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200),
    content TEXT NOT NULL,
    image VARCHAR(255),
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    userID INT,
    FOREIGN KEY (userID) REFERENCES User(userID)
);

-- Táº¡o báº£ng Brand
CREATE TABLE Brand (
    brandID INT PRIMARY KEY AUTO_INCREMENT,
    brandName VARCHAR(100) NOT NULL,
    country VARCHAR(100)
);

-- Táº¡o báº£ng Category
CREATE TABLE Category (
    categoryID INT PRIMARY KEY AUTO_INCREMENT,
    categoryName VARCHAR(100) NOT NULL
);

-- Táº¡o báº£ng Product
CREATE TABLE Product (
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
    FOREIGN KEY (brandID) REFERENCES Brand(brandID),
    FOREIGN KEY (categoryID) REFERENCES Category(categoryID)
);

-- Táº¡o báº£ng Discount_Type
CREATE TABLE Discount_Type (
    discountTypeID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL
);

-- Táº¡o báº£ng Promotion
CREATE TABLE Promotion (
    promotionID INT PRIMARY KEY AUTO_INCREMENT,
    promotionName VARCHAR(200) NOT NULL,
    discountValue DECIMAL(10, 2) NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    productID INT,
    discountTypeID INT,
    FOREIGN KEY (productID) REFERENCES Product(productID),
    FOREIGN KEY (discountTypeID) REFERENCES Discount_Type(discountTypeID)
);

-- Táº¡o báº£ng Voucher
CREATE TABLE Voucher (
    code VARCHAR(50) PRIMARY KEY,
    minOrderValue DECIMAL(10, 2),
    discountValue DECIMAL(10, 2) NOT NULL,
    maxAmount DECIMAL(10, 2),
    startDate DATE NOT NULL,
    endDate DATE NOT NULL
);

-- Táº¡o báº£ng Customer_Voucher
CREATE TABLE Customer_Voucher (
    customerVoucherID INT PRIMARY KEY AUTO_INCREMENT,
    isUsed BOOLEAN DEFAULT FALSE,
    customerID INT,
    code VARCHAR(50),
    FOREIGN KEY (customerID) REFERENCES Customer(customerID),
    FOREIGN KEY (code) REFERENCES Voucher(code)
);

-- Táº¡o báº£ng Order
CREATE TABLE `Order` (
    orderID INT PRIMARY KEY AUTO_INCREMENT,
    guestEmail VARCHAR(100),
    guestPhoneNumber VARCHAR(15),
    shippingAddress TEXT,
    paymentMethod VARCHAR(50),
    totalAmount DECIMAL(10, 2) NOT NULL,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    customerID INT,
    code VARCHAR(50),
    FOREIGN KEY (customerID) REFERENCES Customer(customerID),
    FOREIGN KEY (code) REFERENCES Voucher(code)
);

-- Táº¡o báº£ng Order_Status
CREATE TABLE Order_Status (
    orderStatusID INT PRIMARY KEY AUTO_INCREMENT,
    statusName VARCHAR(50) NOT NULL,
    orderID INT,
    FOREIGN KEY (orderID) REFERENCES `Order`(orderID)
);

-- Táº¡o báº£ng Order_Item
CREATE TABLE Order_Item (
    orderItemID INT PRIMARY KEY AUTO_INCREMENT,
    quantity INT NOT NULL,
    unitPrice DECIMAL(10, 2) NOT NULL,
    subTotal DECIMAL(10, 2) NOT NULL,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    orderID INT,
    productID INT,
    FOREIGN KEY (orderID) REFERENCES `Order`(orderID),
    FOREIGN KEY (productID) REFERENCES Product(productID)
);

-- Táº¡o báº£ng Cart
CREATE TABLE Cart (
    cartID INT PRIMARY KEY AUTO_INCREMENT,
    customerID INT,
    FOREIGN KEY (customerID) REFERENCES Customer(customerID)
);

-- Táº¡o báº£ng Cart_Item
CREATE TABLE Cart_Item (
    cartItemID INT PRIMARY KEY AUTO_INCREMENT,
    quantity INT NOT NULL,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    cartID INT,
    productID INT,
    FOREIGN KEY (cartID) REFERENCES Cart(cartID),
    FOREIGN KEY (productID) REFERENCES Product(productID)
);

-- Táº¡o báº£ng Review
CREATE TABLE Review (
    reviewID INT PRIMARY KEY AUTO_INCREMENT,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    createAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    productID INT,
    customerID INT,
    FOREIGN KEY (productID) REFERENCES Product(productID),
    FOREIGN KEY (customerID) REFERENCES Customer(customerID)
);
