# 🔐 Secure File Vault System

A secure and user-friendly web application that allows users to register, log in, upload, manage, and preview various file types in a private vault. Built with **PHP**, **MySQL**, **HTML**, and **CSS**, the system ensures file safety, session-based access, and a clean interface for file interaction.

---

## 🚀 Features

- 🔑 **User Authentication**
  - Secure registration with hashed passwords
  - Session-based login/logout

- 📁 **File Upload System**
  - Uploads images, PDFs, videos, text files, and more
  - Restricts upload size and allowed formats

- 👁️ **On-Click File Preview**
  - Image preview (JPG, PNG, GIF)
  - Video preview (MP4)
  - PDF and text file viewer
  - Audio playback (MP3, WAV)

- 📥 **File Download**
  - Download any uploaded file securely

- 🎨 **Responsive UI**
  - Clean, intuitive design
  - Styled using custom CSS

---

## 🛠️ Technologies Used

- **Frontend:** HTML5, CSS3
- **Backend:** PHP (Procedural)
- **Database:** MySQL
- **Tools:** XAMPP, VS Code

---

## 📂 Project Structure

```

Secure-File-Vault/
│
├── config/
│   └── db.php              # DB connection file
│
├── css/
│   └── style.css           # Main CSS file
│
├── uploads/                # All uploaded files are stored here
│
├── register.php            # User signup page
├── index.php               # Login page
├── dashboard.php           # Main user dashboard
├── upload.php              # Handles file uploads
├── logout.php              # Logs user out
└── preview\.php             # Displays files for preview

````

---

## ⚙️ Setup Instructions

1. **Clone the repo:**

   ```bash
   git clone https://github.com/SrijanGupta0-0/Secure-File-Vault.git
````

2. **Start your server (e.g., XAMPP)**

   * Place the folder inside `htdocs` (e.g., `C:/xampp/htdocs/`)

3. **Import the SQL database:**

   * Open `phpMyAdmin`
   * Create a new DB (e.g., `vault`)
   * Import the included `.sql` file (if provided) or run:

   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(100) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL
   );

   CREATE TABLE files (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       filename VARCHAR(255) NOT NULL,
       original_name VARCHAR(255),
       uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

4. **Update DB Credentials in `/config/db.php`**:

   ```php
   $conn = new mysqli("localhost", "root", "", "vault");
   ```

5. **Run the App:**
   Open in browser:
   `http://localhost/Secure-File-Vault/index.php`

---

## 🔒 Security Notes

* Passwords are stored using `password_hash()`
* File access is tied to session login
* Uploads restricted by MIME type and file size
* SQL queries use prepared statements (prevents injection)

---


## 📣 Author

**Srijan Kumar**
Final Year BCA Student
[LinkedIn Profile](https://www.linkedin.com/in/srijan-kumar-174921326) • [GitHub](https://github.com/SrijanGupta0-0)

---
