# PHP Forum

A simple yet functional forum application built with PHP and MySQL, featuring user authentication, topic management, and a responsive design.

## 🎯 Project Objective

This project aims to provide a lightweight, easy-to-use forum system where users can:
- Register and authenticate securely
- Create and participate in topic discussions
- Organize conversations by categories
- Share thoughts with rich text formatting
- Build a community through user profiles and interactions

## ✨ Features

### User Management
- **User Registration**: Secure account creation with email validation
- **User Authentication**: Login/logout functionality with session management
- **User Profiles**: Customizable profiles with avatar upload and "About Me" sections
- **Password Security**: Bcrypt password hashing for enhanced security

### Forum Functionality
- **Topic Creation**: Users can create new discussion topics with rich text content
- **Category System**: Organize topics into different categories for better navigation
- **Reply System**: Users can respond to topics and engage in discussions
- **Rich Text Editor**: CKEditor integration for formatted content creation
- **Topic Browsing**: View topics by category or user profile
- **Forum Statistics**: Display total users, topics, and categories

### User Interface
- **Responsive Design**: Bootstrap-powered responsive layout for all devices
- **Clean Interface**: Intuitive navigation and user-friendly design
- **Avatar System**: User profile pictures with default fallback images
- **Real-time Timestamps**: Dynamic time display (e.g., "2 hours ago", "3 days ago")

### Security Features
- **Input Sanitization**: XSS protection with proper HTML escaping
- **Authentication Guards**: Route protection for authenticated-only features
- **SQL Injection Prevention**: PDO prepared statements for database security
- **Session Management**: Secure user session handling

## 🛠️ Technologies Used

### Backend
- **PHP 7.4+**: Server-side scripting language
- **MySQL**: Relational database management system
- **PDO (PHP Data Objects)**: Database abstraction layer for secure database interactions

### Frontend
- **HTML5**: Modern markup language
- **CSS3**: Styling and layout
- **Bootstrap 3.x**: Responsive CSS framework
- **JavaScript/jQuery**: Client-side interactivity

### Third-party Libraries
- **CKEditor 4**: WYSIWYG rich text editor for content creation
- **Bootstrap**: Responsive design framework
- **jQuery**: JavaScript library for DOM manipulation

### Development Tools
- **MAMP/XAMPP**: Local development environment
- **Git**: Version control system

## 📋 Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or local development environment (MAMP/XAMPP)

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/chinmoybiswas93/php-forum.git
   cd php-forum
   ```

2. **Database Setup**
   - Create a MySQL database named `forum`
   - The application will automatically create the required tables on first run

3. **Configuration**
   - Open `config/config.php`
   - Update database connection settings:
     ```php
     $servername = "localhost";
     $username = "your_db_username";
     $password = "your_db_password";
     $dbname = "forum";
     $port = 3306; // or your MySQL port
     ```
   - Update the `BASE_URL` to match your local setup:
     ```php
     define('BASE_URL', "http://localhost/php-forum/");
     ```

4. **File Permissions**
   - Ensure the `img/` directory is writable for avatar uploads:
     ```bash
     chmod 755 img/
     ```

5. **Web Server Setup**
   - Point your web server document root to the project directory
   - Ensure PHP and MySQL services are running
   - Access the application via your configured URL

### Database Schema

The application automatically creates these tables:

- **users**: User account information and profiles
- **categories**: Forum categories for topic organization
- **topics**: Discussion topics created by users
- **replies**: Responses to topics

## 🚀 Usage

### Getting Started
1. **Access the Forum**: Navigate to your configured URL
2. **Register an Account**: Click "Register" to create a new user account
3. **Login**: Use your credentials to access the forum features
4. **Explore Categories**: Browse existing topic categories
5. **Create Topics**: Start new discussions in relevant categories
6. **Participate**: Reply to existing topics and engage with the community

### User Journey
1. **Registration**: New users create accounts with email, username, and optional avatar
2. **Login**: Authenticated users gain access to forum features
3. **Topic Creation**: Users can create new topics with rich text content
4. **Discussion**: Participate in conversations through the reply system
5. **Profile Management**: Users can view their own topics and manage their profile

## 📁 Project Structure

```
php-forum/
├── auth/                   # Authentication system
│   ├── login.php          # User login functionality
│   ├── register.php       # User registration
│   └── logout.php         # User logout
├── config/                # Configuration files
│   └── config.php         # Database and application settings
├── css/                   # Stylesheets
│   ├── bootstrap.css      # Bootstrap framework
│   └── custom.css         # Custom styling
├── img/                   # User uploaded images and avatars
├── includes/              # Reusable components
│   ├── header.php         # Common header and navigation
│   ├── footer.php         # Common footer
│   ├── sidebar.php        # Category listing and statistics
│   └── templates/         # Template components
│       └── topic-loop.php # Topic display template
├── js/                    # JavaScript libraries
│   ├── bootstrap.js       # Bootstrap JavaScript
│   └── ckeditor/          # CKEditor rich text editor
├── index.php              # Homepage - topic listing
├── create.php             # Topic creation page
├── topic.php              # Individual topic view and replies
└── README.md              # Project documentation
```

## 🎯 Project Outcomes

### Achieved Goals
- **Functional Forum System**: Complete forum with user authentication and topic management
- **Security Implementation**: Secure user authentication and data handling
- **Responsive Design**: Cross-device compatibility with Bootstrap
- **Rich Content Creation**: CKEditor integration for enhanced user experience
- **Database Automation**: Self-initializing database schema for easy deployment

### Technical Achievements
- **Clean Architecture**: Modular design with separation of concerns
- **Security Best Practices**: Input sanitization, prepared statements, password hashing
- **User Experience**: Intuitive interface with responsive design
- **Extensibility**: Well-structured codebase for future enhancements

### Learning Outcomes
- PHP web development best practices
- Database design and relationships
- User authentication and session management
- Frontend-backend integration
- Security considerations in web applications

## 🔧 Development Notes

### Key Components
- **Session Management**: Secure user sessions with proper authentication checks
- **Database Layer**: PDO-based database interactions with prepared statements
- **Template System**: Modular PHP templates for consistent UI
- **Error Handling**: Comprehensive error reporting and user feedback

### Future Enhancements
- Email notifications for replies
- Advanced moderation features
- Search functionality
- User reputation system
- API endpoints for mobile app integration

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request. For major changes, please open an issue first to discuss what you would like to change.

## 📞 Support

If you encounter any issues or have questions about the project, please open an issue on the GitHub repository.

---

**Built with ❤️ using PHP, MySQL, and Bootstrap**