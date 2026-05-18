-- Tạo cơ sở dữ liệu và sử dụng
CREATE DATABASE IF NOT EXISTS my_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE my_store;

-- 1. Bảng danh mục
CREATE TABLE IF NOT EXISTS category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
);

-- 2. Bảng sản phẩm
CREATE TABLE IF NOT EXISTS product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL CHECK (price > 0),
    image VARCHAR(255) DEFAULT NULL,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE
);

-- 3. Chèn danh mục (an toàn, bỏ qua nếu đã tồn tại)
INSERT IGNORE INTO category (name, description) VALUES
('Điện thoại', 'Danh mục các loại điện thoại'),
('Laptop', 'Danh mục các loại laptop'),
('Máy tính bảng', 'Danh mục các loại máy tính bảng'),
('Phụ kiện', 'Danh mục phụ kiện điện tử'),
('Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro');

-- 4. Chèn sản phẩm mẫu
INSERT IGNORE INTO product (name, description, price, category_id) VALUES
-- Điện thoại (1)
('iPhone 15 Pro Max', 'Chip A17 Pro, màn hình 6.7 inch, camera 48MP, 256GB', 29990000, 1),
('Samsung Galaxy S24 Ultra', 'Bút S Pen, camera 200MP, Snapdragon 8 Gen 3, 6.8 inch', 27990000, 1),
('Xiaomi 14 Ultra', 'Camera Leica 50MP, Snapdragon 8 Gen 3, sạc 120W', 22990000, 1),
('OPPO Find X7 Ultra', 'Camera Hasselblad, Snapdragon 8 Gen 3, 6.82 inch', 24990000, 1),
('Vivo X100 Pro', 'Camera Zeiss 50MP, Dimensity 9300, pin 5400mAh', 19990000, 1),
('Google Pixel 8 Pro', 'Camera AI, Tensor G3, Android thuần, 6.7 inch', 18990000, 1),
('iPhone 14', 'Chip A15, camera kép 12MP, 6.1 inch, 128GB', 18990000, 1),
('Samsung Galaxy A55', 'Exynos 1480, camera 50MP, pin 5000mAh, Super AMOLED', 9990000, 1),

-- Laptop (2)
('MacBook Pro 16 M3 Max', 'M3 Max 16-core, RAM 36GB, SSD 1TB, 16.2 inch', 89990000, 2),
('Dell XPS 15', 'i7-13700H, RTX 4060, RAM 32GB, SSD 1TB, OLED 15.6 inch', 52990000, 2),
('ASUS ROG Zephyrus G14', 'Ryzen 9 7940HS, RTX 4070, RAM 16GB, 14 inch 165Hz', 45990000, 2),
('Lenovo ThinkPad X1 Carbon', 'i7-1365U, RAM 16GB, SSD 512GB, siêu nhẹ 1.12kg', 38990000, 2),
('HP Spectre x360', 'i7-1355U, RAM 16GB, SSD 1TB, cảm ứng OLED 13.5 inch', 35990000, 2),
('MacBook Air 15 M2', 'Chip M2, RAM 8GB, SSD 256GB, 15.3 inch', 32990000, 2),
('Acer Predator Helios 16', 'i9-13900HX, RTX 4080, RAM 32GB, SSD 2TB, 240Hz', 68990000, 2),
('MSI Stealth 14 Studio', 'i7-13700H, RTX 4060, RAM 16GB, mỏng 1.7kg', 42990000, 2),

-- Máy tính bảng (3)
('iPad Pro 12.9 M2', 'Chip M2, Liquid Retina XDR 12.9 inch, 256GB', 28990000, 3),
('Samsung Galaxy Tab S9 Ultra', '14.6 inch AMOLED, Snapdragon 8 Gen 2, S Pen, 256GB', 27990000, 3),
('iPad Air 10.9 M1', 'Chip M1, Liquid Retina 10.9 inch, 64GB', 14990000, 3),
('Xiaomi Pad 6', 'Snapdragon 870, 11 inch 144Hz, pin 8840mAh, 128GB', 7990000, 3),
('Lenovo Tab P12 Pro', '12.6 inch AMOLED, Snapdragon 870, bút cảm ứng, 256GB', 12990000, 3),
('OPPO Pad 2', 'Dimensity 9000, 11.61 inch 144Hz, sạc 67W, 256GB', 9990000, 3),

-- Phụ kiện (4)
('AirPods Pro 2', 'Chống ồn chủ động, chip H2, âm thanh không gian', 5990000, 4),
('Sạc Anker 735 GaNPrime 65W', '3 cổng, công nghệ GaN, tương thích MacBook/iPhone', 1290000, 4),
('Ốp lưng iPhone 15 Pro Max', 'Silicone cao cấp, chống sốc, bảo vệ camera', 490000, 4),
('Cáp USB-C to Lightning', 'Chính hãng Apple, 1m, sạc nhanh, truyền dữ liệu', 590000, 4),
('Miếng dán cường lực iPhone', 'Kính 9H, chống trầy, chống vân tay', 190000, 4),
('Đế sạc MagSafe', 'Sạc không dây 15W, nam châm mạnh, iPhone 12+', 1190000, 4),
('Bao da iPad Pro 12.9', 'Tự động wake/sleep, khe để Apple Pencil', 890000, 4),
('Galaxy Buds2 Pro', 'Chống ồn, âm thanh 360, pin 8h, IPX7', 3990000, 4),

-- Thiết bị âm thanh (5)
('Loa Marshall Stanmore III', 'Bluetooth 80W, âm thanh rock, thiết kế vintage', 12990000, 5),
('Sony WH-1000XM5', 'Chống ồn hàng đầu, pin 30h, Hi-Res, mic AI', 8990000, 5),
('JBL Charge 5', 'Di động, IP67, pin 20h, bass mạnh', 3990000, 5),
('Bose QuietComfort Ultra', 'Chống ồn cao cấp, âm thanh không gian, pin 24h', 9990000, 5),
('Harman Kardon Aura Studio 3', 'Bluetooth 360°, thiết kế trong suốt, 8 loa', 6990000, 5),
('Beats Studio Pro', 'Chống ồn, chip H1, pin 40h, bass đặc trưng', 7990000, 5),
('Soundbar Samsung HW-Q990C', '11.1.4 channel, Dolby Atmos, sub không dây, 656W', 24990000, 5),
('Micro Shure SM7B', 'Thu âm chuyên nghiệp, chống ồn, podcast/streaming', 10990000, 5);