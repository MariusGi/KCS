Database structure:

DB name: math_games

Tables:
    users: id int(11) auto_increment, username varchar(255), ip_address varchar(255),   created timestamp, current_timestamp.
    
    scores: id int(11) auto_increment, user_id int(11), score int(11).
    
! Make sure to edit host credential in /config/Database.php class.