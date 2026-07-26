CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  net_price DECIMAL(10,2) NOT NULL,
  reduced_rate BOOLEAN DEFAULT FALSE
  );

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_email VARCHAR(255) NOT NULL,
  reverse_charge BOOLEAN DEFAULT FALSE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );

CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id),
  FOREIGN KEY (product_id) REFERENCES products(id)
  );
