# 🏥 Hospital Management System (CI3 + Docker)

This project includes 3 CodeIgniter 3 apps:

- **Admin**
- **Staff**
- **Patient**

All apps share a single Docker environment with Apache, PHP 8.1, MySQL 5.7, and phpMyAdmin.

---

## 📁 Folder Structure

```
hospital-mngt/
├── admin/
├── staff/
├── patient/
├── Dockerfile
├── docker-compose.yml
└── README.md
```

---

## 🚀 Getting Started

### 1. ✅ Requirements

- [Docker Desktop](https://www.docker.com/products/docker-desktop) (required)
- Git (or download ZIP)

---

### 2. 📥 Clone the Repository

```bash
git clone https://github.com/Umairi54321/908758-umair-muhammad.git
cd hospital-mngt
```

---

### 3. 🐳 Run Docker

Start all services (Apache, MySQL, phpMyAdmin, and your apps):

```bash
docker-compose up -d
```

---

### 4. 🧪 Access Applications

| App        | URL                   |
|------------|------------------------|
| Admin      | http://localhost:8001 |
| Staff      | http://localhost:8002 |
| Patient    | http://localhost:8003 |
| phpMyAdmin | http://localhost:9090 |

> **phpMyAdmin Login:**
> - User: `root`
> - Password: `root`
> - DB: `hospital_manage`

---

### 5. 🗃 Import Database

- Open http://localhost:9090
- Login using root/root
- Select the `hospital_manage` database (or create it)
- Import your `.sql` file

---

### 6. ✅ Stopping Services

```bash
docker-compose down
```

---

## 🐳 Docker Configuration

### 📦 `Dockerfile`

```Dockerfile
FROM php:8.1-apache

RUN docker-php-ext-install mysqli
RUN a2enmod rewrite

COPY . /var/www/html/

EXPOSE 80
```

---

### 📦 `docker-compose.yml`

```yaml
version: "3.8"

services:
  web:
    build: .
    ports:
      - "8001:80"
    volumes:
      - ./admin:/var/www/html/admin
      - ./staff:/var/www/html/staff
      - ./patient:/var/www/html/patient
    depends_on:
      - db
    networks:
      - app-network

  staff:
    build: .
    ports:
      - "8002:80"
    volumes:
      - ./staff:/var/www/html
    depends_on:
      - db
    networks:
      - app-network

  patient:
    build: .
    ports:
      - "8003:80"
    volumes:
      - ./patient:/var/www/html
    depends_on:
      - db
    networks:
      - app-network

  db:
    image: mysql:5.7
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: hospital_manage
      MYSQL_USER: user
      MYSQL_PASSWORD: password
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql
    networks:
      - app-network

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    restart: always
    ports:
      - "9090:80"
    environment:
      PMA_HOST: db
      MYSQL_ROOT_PASSWORD: root
    networks:
      - app-network

volumes:
  db_data:

networks:
  app-network:
```

---

## 💡 Notes

- You only need Docker installed — **no XAMPP, no manual server setup**.
- Each service runs independently — if one fails, others still work.
- Make sure your local ports (8001, 8002, 8003, 9090) are free.

---

## 📄 License

MIT – free for personal and commercial use.