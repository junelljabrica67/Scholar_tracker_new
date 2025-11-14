-- USERS TABLE: Handles login credentials and roles
CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL CHECK (role IN ('student', 'admin')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ADMIN TABLE: Connecting table for admin and user
CREATE TABLE administrator (
    admin_id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL UNIQUE, 
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- PROGRAMS TABLE: List of scholarship programs
CREATE TABLE program (
    program_id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    year_level VARCHAR(50) NOT NULL
);

-- STUDENTS TABLE: Personal, filled after signup
CREATE TABLE students (
    student_id SERIAL PRIMARY KEY,
    user_id INTEGER NOT NULL UNIQUE, 
    birth_date DATE NOT NULL,
    address VARCHAR(255) NOT NULL,
    school VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- STUDENT PROGRAM: Connecting the programs and student
CREATE TABLE student_program (
    student_program_id SERIAL PRIMARY KEY,
    student_id INTEGER NOT NULL,
    program_id INTEGER NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (program_id) REFERENCES program (program_id),
    UNIQUE (student_id, program_id)
);

-- GRADES TABLE: Academic performance
CREATE TABLE student_grades (
    grade_id SERIAL PRIMARY KEY,
    student_id INTEGER NOT NULL,
    term INTEGER NOT NULL,
    gwa NUMERIC(4,2) NOT NULL,
    recorded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);

-- REQUIREMENTS TABLE: Requirements posted by admins
CREATE TABLE requirements (
    requirement_id SERIAL PRIMARY KEY,
    created_by INTEGER NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    required_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES administrator(admin_id)
);

-- STUDENT REQUIREMENTS TABLE: Track submission and approval
CREATE TABLE student_requirements (
    student_requirement_id BIGSERIAL PRIMARY KEY,
    student_id INTEGER NOT NULL,
    approved_by INTEGER,
    requirement_id INTEGER NOT NULL,
    submitted BOOLEAN NOT NULL DEFAULT FALSE,
    approved BOOLEAN NOT NULL DEFAULT FALSE,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (approved_by) REFERENCES administrator(admin_id),
    FOREIGN KEY (requirement_id) REFERENCES requirements(requirement_id),
    UNIQUE (student_id, requirement_id)
);

-- FUND RELEASE TABLE: Records scholarship fund distributions
CREATE TABLE fund_releases (
    release_id SERIAL PRIMARY KEY,
    released_by INTEGER NOT NULL,
    released_to INTEGER NOT NULL,
    release_date DATE NOT NULL DEFAULT CURRENT_DATE,
    amount_released NUMERIC(10,2) NOT NULL,
    FOREIGN KEY (released_by) REFERENCES administrator(admin_id),
    FOREIGN KEY (released_to) REFERENCES students(student_id)
);
