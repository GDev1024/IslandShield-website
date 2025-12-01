# IslandShield Security - PostgreSQL Database Schema

```mermaid
erDiagram
    users ||--o{ services : "has"
    users ||--o{ cameras : "owns"
    users ||--o{ alerts : "receives"
    users ||--o{ event_bookings : "books"
    cameras ||--o{ alerts : "triggers"

    users {
        SERIAL user_id PK
        VARCHAR(50) first_name
        VARCHAR(50) last_name
        VARCHAR(100) email UK
        VARCHAR(20) phone
        VARCHAR(200) address
        VARCHAR(50) parish
        VARCHAR(50) property_type
        VARCHAR(255) password_hash
        TIMESTAMP created_at
        TIMESTAMP last_login
        VARCHAR(20) status "active|inactive|suspended"
    }

    contact_messages {
        SERIAL message_id PK
        VARCHAR(100) name
        VARCHAR(100) email
        VARCHAR(20) phone
        VARCHAR(50) service
        VARCHAR(200) subject
        TEXT message
        TIMESTAMP created_at
        VARCHAR(20) status "new|read|responded|archived"
        TEXT admin_notes
    }

    services {
        SERIAL service_id PK
        INTEGER user_id FK
        VARCHAR(20) service_type "cctv|personnel|event|emergency"
        VARCHAR(100) package_name
        VARCHAR(20) status "active|inactive|pending|cancelled"
        DATE start_date
        DATE end_date
        DECIMAL(10,2) monthly_cost
        TIMESTAMP created_at
    }

    cameras {
        SERIAL camera_id PK
        INTEGER user_id FK
        VARCHAR(100) camera_name
        VARCHAR(200) location
        VARCHAR(20) status "online|offline|maintenance"
        TIMESTAMP last_online
    }

    alerts {
        SERIAL alert_id PK
        INTEGER user_id FK
        INTEGER camera_id FK
        VARCHAR(20) alert_type "motion|unauthorized|system|other"
        VARCHAR(200) title
        TEXT message
        VARCHAR(20) severity "info|warning|critical"
        BOOLEAN is_read
        TIMESTAMP created_at
    }

    event_bookings {
        SERIAL booking_id PK
        INTEGER user_id FK
        VARCHAR(200) event_name
        VARCHAR(100) event_type
        DATE event_date
        VARCHAR(200) event_location
        INTEGER guest_count
        VARCHAR(100) security_package
        VARCHAR(20) status "pending|confirmed|completed|cancelled"
        DECIMAL(10,2) total_cost
        TIMESTAMP created_at
    }
```

## Database Features

### Tables
- **users**: Customer accounts with authentication
- **contact_messages**: Contact form submissions (standalone)
- **services**: Active security service subscriptions
- **cameras**: CCTV camera inventory per user
- **alerts**: Security notifications and events
- **event_bookings**: Event security service requests

### Indexes
- Email lookup: `idx_users_email`
- User status: `idx_users_status`
- Contact status: `idx_contact_status`
- Service queries: `idx_services_user`, `idx_services_status`, `idx_services_user_status`
- Camera queries: `idx_cameras_user`, `idx_cameras_user_status`
- Alert queries: `idx_alerts_user`, `idx_alerts_read`, `idx_alerts_created`, `idx_alerts_user_date`
- Booking queries: `idx_bookings_user`, `idx_bookings_date`

### Triggers
- `trigger_update_camera_last_online`: Auto-updates camera last_online timestamp

### Views
- `user_dashboard_summary`: Aggregated dashboard statistics per user

### Functions
- `get_user_services(user_id)`: Returns all services for a user
- `get_recent_alerts(user_id, limit)`: Returns recent alerts with camera details

### Relationships
- Users → Services (1:N, CASCADE DELETE)
- Users → Cameras (1:N, CASCADE DELETE)
- Users → Alerts (1:N, CASCADE DELETE)
- Users → Event Bookings (1:N, CASCADE DELETE)
- Cameras → Alerts (1:N, SET NULL on delete)

### Constraints
- Email uniqueness on users table
- CHECK constraints on status/type enums
- Foreign key constraints with referential integrity
- NOT NULL constraints on required fields
