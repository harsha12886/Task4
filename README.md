# Internship Blog Project

A simple and secure PHP + MySQL based blog system developed as part of the Internship Program.

## 📁 Folder: `Internship`

This project allows registered users to create, read, update, and delete blog posts. It includes authentication, validation, pagination, search, and security enhancements.

---

## ✅ Features Implemented

### Task 1: Environment Setup
- XAMPP local server
- MySQL database setup
- Project folder initialized with Git
- GitHub repository created and synced

### Task 2: Basic CRUD Application
- ✅ User registration (`Account_registration.php`)
- ✅ User login/logout (`login.php`, `logout.php`)
- ✅ Add new blog posts (`add.php`)
- ✅ View all posts (`index.php`)
- ✅ Edit existing posts (`edit.php`)
- ✅ Delete posts (`delete.php`)

### Task 3: Advanced Features
- 🔍 Search blog posts by title/content
- 📄 Pagination (5 posts per page)
- 🎨 Basic CSS styling using `style.css`

### Task 4: Security Enhancements
- ✅ Input validation & sanitization
- ✅ Output escaping (`htmlspecialchars()`)
- ✅ Session handling & access control
- ✅ Client-side form validation (`required`, `maxlength`)

---

## 🔐 Security Features

- Prepared statements to prevent SQL injection
- Escaped output to block XSS
- Session-based access control
- HTML5 form validation