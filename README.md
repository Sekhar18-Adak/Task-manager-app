# Task-manager-app
Created by-Sekhar Adak
<br>
# Overview
The Task Manager Application is a powerful yet simple web-based tool designed to help users efficiently manage their tasks. Built using Laravel for the backend and Bootstrap with custom JavaScript for the frontend, this application ensures a seamless and intuitive user experience.Additionally, it includes an integrated mailing system that notifies users whenever a task is created, updated, or marked as completed. For testing emails, Mailtrap is used, ensuring a smooth email workflow before deploying to production.<br>
<b> Tech Stack </b> <br>
Frontend: Bootstrap 5, Custom JavaScript<br>
Backend: Laravel<br>
Database: MySQL<br>
Mailing System: Laravel Mail (SMTP with Mailtrap for testing)<br>
Queue Management: Laravel Queues (for efficient email processing)<br>
# Key Features
<b> 1.Task Creation & Management </b> <br>
Users can create, edit, and delete tasks effortlessly.
Each task has details such as description, owner, estimated completion time, and status.<br>
<b> 2. Task Status Management</b> <br>
Users can mark a task as completed with a single click.
The interface visually distinguishes pending and completed tasks.<br>
<b> 3. Mailing System (SMTP Integration using Mailtrap for Testing) </b> <br>
When a task is created, updated, or marked as done, an automated email notification is sent to the assigned user.
Uses Laravel's Mail system with SMTP for reliable email delivery.
Email sending is handled via queues to improve performance and prevent delays.
Mailtrap is used for testing to ensure emails work correctly before going live.<br>
<b> 4. Real-time UI Updates with JavaScript </b> <br>
Tasks update dynamically in the UI without needing a full page refresh.
Smooth user experience with AJAX-based operations.<br>
<b> 5. Database Optimization </b> <br>
Uses Eloquent ORM for efficient database interactions.<br>
<b> 6.Performance Enhancements </b> <br>
Optimized queries and caching techniques for faster data retrieval.
Queue system offloads email processing, reducing app load time.
Lazy loading used to improve query efficiency.
