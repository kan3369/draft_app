CREATE TABLE IF NOT EXISTS doc (
    id INT PRIMARY KEY AUTO_INCREMENT,
    maker VARCHAR(255) NOT NULL,
    -- image VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    contents TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    doc_num  INT(11) NOT NULL,
    team  VARCHAR(255) NOT NULL,
    post  VARCHAR(255) NOT NULL
);
