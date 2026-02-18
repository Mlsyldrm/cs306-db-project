# cs306-db-project
## Project Overview

This project implements a hybrid database system integrating MySQL, MongoDB, and a PHP web interface running on XAMPP. The system manages factory production data, warehouse assignments, machine usage, and a support ticket workflow using triggers and stored procedures.

## Database Features

### Triggers

- Inventory Management — Updates raw material stock automatically during production.
- Machine Usage Tracking — Tracks machine usage counts for maintenance planning.
- Workforce Distribution — Updates warehouse employee counts when assignments change.

### Stored Procedures

- Material Requirement Calculation — Computes materials needed for a product.
- Machine Production Tracking — Lists products manufactured by a machine.
- Employee Warehouse Assignments — Displays warehouses where an employee works.

## Support Ticket System

### User Workflow

- Create a support ticket
- Describe issues
- Submit requests

### Admin Workflow

- View active tickets
- Add comments to tickets
- Deactivate resolved tickets

## PHP Web Interface

### User Side

- create_ticket.php — Create new ticket
- tickets.php — View tickets
- ticket_details.php — Ticket details

### Admin Side

- index.php — Active ticket dashboard
- ticket_details.php — Manage ticket status and comments
