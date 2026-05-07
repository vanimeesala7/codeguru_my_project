# codeguru_my_project

# 💻 CodeGuru - Online Code Editor

CodeGuru is a web-based online code editor that allows users to write, run, save, and manage code snippets in multiple programming languages — all from the browser.

---

## 🚀 Features

- 🔐 **User Authentication** — Sign up, log in, and log out securely with hashed passwords
- 👨‍💻 **Online Code Editor** — Write and run code directly in the browser
- 🌐 **Multi-Language Support** — Python, Java, C, C++, JavaScript, PHP, Swift, Ruby, Kotlin, Go
- 💾 **Save Code Snippets** — Save your code and access it anytime
- 📜 **Code History** — View previously executed code with timestamps
- 🏆 **Leaderboard** — See top users ranked by score
- 👤 **Profile Management** — Update your name and profile photo
- 🛡️ **Admin Panel** — Admin dashboard to manage users and view statistics

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Frontend | HTML, CSS, JavaScript |
| Backend | PHP |
| Database | MySQL |
| Server | XAMPP (Apache + MySQL) |

---

## 📁 Project Structure

```
CodeGuru/
│
├── index.php           # Landing / Home page
├── login.php           # User login
├── signup.php          # User registration
├── logout.php          # Session logout
├── dashboard.php       # User dashboard
├── new_code.php        # Code editor page
├── run_code.php        # Executes code server-side
├── save.php            # View saved codes
├── save_code.php       # Save code to database
├── history.php         # Code execution history
├── update.php          # Update user profile
├── leaderboard.php     # User leaderboard
├── admin.php           # Admin dashboard
├── admin_login.php     # Admin login
├── db.php              # Database connection
├── style.css           # Main stylesheet
├── styles.css          # Form styles
└── styl.css            # Extra styles
```

---

## ⚙️ Installation & Setup

### Requirements
- XAMPP (or any Apache + PHP + MySQL environment)
- PHP 7.4+
- MySQL

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/codeguru_my_project.git
   ```

2. **Move to XAMPP's htdocs folder**
   ```
   C:\xampp\htdocs\CodeGuru
   ```

3. **Start XAMPP**
   - Start **Apache** and **MySQL** from the XAMPP Control Panel

4. **Create the Database**
   - Open `http://localhost/phpmyadmin`
   - Create a new database named `codeguru`
   - Import the SQL file (if provided) or create tables manually

5. **Database Tables Required**

   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL,
       password VARCHAR(255) NOT NULL,
       profile_photo VARCHAR(255),
       role ENUM('user', 'admin') DEFAULT 'user',
       score INT DEFAULT 0
   );

   CREATE TABLE code_snippets (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT,
       title VARCHAR(100),
       language VARCHAR(50),
       content TEXT,
       created_at DATETIME,
       FOREIGN KEY (user_id) REFERENCES users(id)
   );
   ```

6. **Run the project**
   - Open your browser and go to:
   ```
   http://localhost/CodeGuru/
   ```

---

## 👤 Default Admin Setup

To create an admin account, register a user normally, then update the role in the database:

```sql
UPDATE users SET role = 'admin' WHERE username = 'your_username';
```

Then log in via: `http://localhost/CodeGuru/admin_login.php`

---

## 📸 Screenshots

<img width="1914" height="887" alt="Screenshot 2026-05-07 151958" src="https://github.com/user-attachments/assets/b3ea577b-5f06-49b6-8006-01a28c09b2d8" />

<img width="1899" height="766" alt="image" src="https://github.com/user-attachments/assets/32c4982c-7dd9-4870-b4df-3d8900966b5d" />

<img width="1276" height="799" alt="Screenshot 2026-05-07 151717" src="https://github.com/user-attachments/assets/0ec93e4b-8394-4338-a334-c113d0ce402f" />

<img width="1751" height="487" alt="Screenshot 2026-05-07 151742" src="https://github.com/user-attachments/assets/e2f3eabf-75a7-4671-8ed2-6bb52ba12d1f" />
---

## 🙌 Developed By

**Code Captain ----- Vani Meesala** 

---

## 📄 License

This project is for educational purposes.
