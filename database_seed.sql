
-- Tablas mínimas (ajusta tipos según tu motor, por ejemplo MySQL)
CREATE TABLE IF NOT EXISTS usuarios (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  correo_electronico VARCHAR(150) UNIQUE NOT NULL,
  contraseña VARCHAR(255) NOT NULL,
  rol ENUM('administrador','agente','cliente') NOT NULL
);

-- Usuarios de ejemplo (contraseña: 123456)
INSERT INTO usuarios (nombre, correo_electronico, contraseña, rol) VALUES
('Admin', 'admin@demo.local', '$2y$10$6jI5m0wzY0b1P5Kp3QfDJu3c5iZK1lUu5j3mOqF3o1OQzj0gFqT0e', 'administrador'),
('Agente Demo', 'agente@demo.local', '$2y$10$6jI5m0wzY0b1P5Kp3QfDJu3c5iZK1lUu5j3mOqF3o1OQzj0gFqT0e', 'agente'),
('Cliente Demo', 'cliente@demo.local', '$2y$10$6jI5m0wzY0b1P5Kp3QfDJu3c5iZK1lUu5j3mOqF3o1OQzj0gFqT0e', 'cliente');
